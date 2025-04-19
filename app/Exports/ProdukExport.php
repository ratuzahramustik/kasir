<?php

namespace App\Exports;

use App\Models\Produk;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeSheet;

class ProdukExport implements FromCollection, WithHeadings, WithMapping, WithEvents, ShouldAutoSize
{
    protected $produkData = [];

    public function collection()
    {
        $produks = Produk::latest()->get();

        foreach ($produks as $produk) {
            $this->produkData[] = [
                $produk->nama_produk,
                $produk->harga,
                $produk->stok,
                $produk->image_url, // accessor dari getImageUrlAttribute()
                Carbon::parse($produk->created_at)->timezone('Asia/Jakarta')->format('d-m-Y H:i')
            ];
        }

        return collect($this->produkData);
    }

    public function map($row): array
    {
        return $row; // Data sudah dimapping di method collection
    }

    public function headings(): array
    {
        return [
            'Nama Produk',
            'Harga',
            'Stok',
            'URL Gambar',
            'Tanggal Dibuat',
        ];
    }

    public function registerEvents(): array
    {
        return [
            BeforeSheet::class => function (BeforeSheet $event) {
                $event->sheet->insertNewRowBefore(1, 1);
                $event->sheet->mergeCells('A1:E1');
                $event->sheet->setCellValue('A1', 'Laporan Data Produk');
            },
        ];
    }
}
