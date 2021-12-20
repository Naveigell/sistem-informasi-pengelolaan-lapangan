<?php


namespace App\Exports;


use App\Models\Pembayaran;
use App\Models\Pemesanan;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class PemesananExcelExports extends DefaultValueBinder implements FromCollection, ShouldAutoSize, WithColumnFormatting, WithCustomValueBinder
{

    private $from = null;
    private $to = null;

    public function __construct($from = null, $to = null)
    {
        $this->from = $from;
        $this->to = $to;
    }

    public function collection()
    {
        $query = Pemesanan::with('member')->whereHas('pembayaran', function ($query) {
            $query->where('status', Pembayaran::VALID);
        });

        if ($this->from && $this->to) {
            $query->whereBetween('tanggal_sewa', [$this->from, $this->to]);
        }

        $pemesanans = $query->get();
        $items  = [];

        foreach ($pemesanans as $index => $pemesanan) {
            $items[] = array_values($this->transform($index, $pemesanan));
        }

        return new Collection([
            ["No", "Nama Member", "Tanggal Sewa", "Jenis Sewa", "Total Pembayaran", "Total Durasi"],
            $items
        ]);
    }

    public function transform(int $number, Pemesanan $pemesanan)
    {
        return [
            "No"                      => $number + 1,
            "Nama Member"             => $pemesanan->member->nama_member,
            "Tanggal Sewa"            => \Carbon\Carbon::parse($pemesanan->tanggal_sewa)->format('d F Y'),
            "Jenis Sewa"              => ucfirst($pemesanan->jenis_sewa),
            "Total Pembayaran"        => 'Rp.' . number_format($pemesanan->total_harga, 0, ',', '.'),
            "Total Durasi"            => $pemesanan->jenis_sewa === 'reguler' ? $pemesanan->total_durasi . ' jam' : '-',
        ];
    }

    public function columnFormats(): array
    {
        return [
            "E" => NumberFormat::FORMAT_TEXT,
        ];
    }

    public function bindValue(Cell $cell, $value): bool
    {
        if ($cell->getColumn() == 'E') {
            $cell->setValueExplicit($value, DataType::TYPE_STRING);

            return true;
        }

        return parent::bindValue($cell, $value);
    }
}
