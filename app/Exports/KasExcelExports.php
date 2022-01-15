<?php


namespace App\Exports;


use App\Models\Kas;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class KasExcelExports implements FromCollection, ShouldAutoSize
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
        $query = Kas::with('karyawan');

        if ($this->from && $this->to) {
            $query->whereBetween('tanggal_transaksi', [$this->from, $this->to]);
        }

        $kas    = $query->get();
        $items  = [];
        $total  = 0;

        foreach ($kas as $index => $ka) {
            $items[] = array_values($this->transform($index, $ka, $total));
        }

        return new Collection([
            ["No", "Tanggal", "Nama Staff", "Jenis", "Nominal", "Keterangan"],
            $items,
            ["", "", "", "", "", ""],
            ["Total", "", "", "", "", 'Rp. ' . number_format($total, 0, ',', '.')]
        ]);
    }

    public function transform(int $number, Kas $kas, &$total)
    {
        if ($kas->jenis === 'debit') {
            $total += $kas->nilai;
        } else {
            $total -= $kas->nilai;
        }

        return [
            "no"         => $number + 1,
            "tanggal"    => $kas->tanggal_transaksi,
            "staff"      => $kas->karyawan->nama_pengguna,
            "jenis"      => ucfirst($kas->jenis),
            "nominal"    => 'Rp. ' . number_format($kas->nilai, 0, ',', '.'),
            "keterangan" => $kas->keterangan,
        ];
    }
}
