<?php


namespace App\Exports;


use App\Models\Kas;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class KasExcelExports implements FromCollection, ShouldAutoSize
{
    public function collection()
    {
        $cashes = Kas::with('karyawan')->get();
        $items  = [];

        foreach ($cashes as $index => $cash) {
            $items[] = array_values($this->transform($index, $cash));
        }

        return new Collection([
            ["No", "Tanggal", "Nama Staff", "Jenis", "Nominal", "Keterangan"],
            $items
        ]);
    }

    public function transform(int $number, Kas $kas)
    {
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
