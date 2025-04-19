<?php
namespace App\Exports;

use Carbon\Carbon;
use App\Models\Penjualan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\BeforeSheet;

class PenjualanExport implements FromCollection, WithHeadings, WithMapping, WithEvents, ShouldAutoSize
{
    protected $mappedData = [];

    public function collection()
    {
        $penjualans = Penjualan::with(['member', 'detailPenjualans.produk', 'user'])->latest()->get();

        foreach ($penjualans as $penjualan) {
            $first = true;

            foreach ($penjualan->detailPenjualans as $detail) {
                $row = [
                    $first ? ($penjualan->member->nama ?? 'Non Member') : '',
                    $first ? ($penjualan->member->telp ?? '-') : '',
                    $first ? ($penjualan->member->poin ?? 0) : '',
                    $detail->produk->nama_produk ?? 'Produk tidak tersedia',
                    $detail->qty,
                    $first ? 'Rp ' . number_format($penjualan->total_harga, 0, ',', '.') : '',
                    $first ? 'Rp ' . number_format($penjualan->total_bayar, 0, ',', '.') : '',
                    $first ? 'Rp ' . number_format($penjualan->poin_dipakai ?? 0, 0, ',', '.') : '',
                    $first ? 'Rp ' . number_format($penjualan->kembalian, 0, ',', '.') : '',
                    Carbon::parse($penjualan->created_at)->timezone('Asia/Jakarta')->format('d-m-Y H:i'),
                    $first ? ($penjualan->user->name ?? '-') : '',
                ];

                $this->mappedData[] = $row;
                $first = false;
            }
        }

        return collect($this->mappedData);
    }

    public function map($row): array
    {
        return $row; // Sudah dipetakan di collection
    }

    public function headings(): array
    {
        return [
            'Nama Pelanggan',
            'No HP Pelanggan',
            'Poin Pelanggan',
            'Produk',
            'Quantity',
            'Total Harga',
            'Total Bayar',
            'Total Diskon Poin',
            'Total Kembalian',
            'Tanggal Pembelian',
            'Dibuat Oleh',
        ];
    }

    public function registerEvents(): array
    {
        return [
            BeforeSheet::class => function (BeforeSheet $event) {
                // Tambahkan judul di baris paling atas
                $event->sheet->insertNewRowBefore(1, 1);
                $event->sheet->mergeCells('A1:K1');
                $event->sheet->setCellValue('A1', 'Laporan Penjualan Toko');
            },
        ];
    }
}
