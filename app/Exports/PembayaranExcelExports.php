<?php


namespace App\Exports;


use App\Models\Pembayaran;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class PembayaranExcelExports extends DefaultValueBinder implements FromCollection, ShouldAutoSize, WithColumnFormatting, WithCustomValueBinder
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
        $query = Pembayaran::with('pemesanan');

        if ($this->from && $this->to) {
            $query->whereBetween('tanggal_pembayaran', [$this->from, $this->to])->where('status', 'valid');
        }

        $kas = $query->get();
        $items  = [];

        foreach ($kas as $index => $ka) {
            $items[] = array_values($this->transform($index, $ka));
        }

        return new Collection([
            ["No", "Tanggal Pembayaran", "Total Pembayaran", "Bank Tujuan", "Bank Pengirim", "Nomor Rekening Pengirim", "Atas Nama Pengirim", "Status"],
            $items
        ]);
    }

    public function transform(int $number, Pembayaran $pembayaran)
    {
        return [
            "No"                      => $number + 1,
            "Tanggal Pembayaran"      => $pembayaran->tanggal_pembayaran,
            "Total Pembayaran"        => 'Rp.' . number_format($pembayaran->pemesanan->total_harga, 0, ',', '.'),
            "Bank Tujuan"             => $pembayaran->bank_tujuan,
            "Bank Pengirim"           => $pembayaran->bank_pengirim,
            "Nomor Rekening Pengirim" => number_format($pembayaran->nomor_rekening_pengirim, 0, '', ''),
            "Atas Nama Pengirim"      => $pembayaran->atas_nama_pengirim,
            "Status"                  => ucfirst($pembayaran->status),
        ];
    }

    public function columnFormats(): array
    {
        return [
            "F" => NumberFormat::FORMAT_TEXT,
        ];
    }

    public function bindValue(Cell $cell, $value): bool
    {
        if ($cell->getColumn() == 'F') {
            $cell->setValueExplicit($value, DataType::TYPE_STRING);

            return true;
        }

        return parent::bindValue($cell, $value);
    }
}
