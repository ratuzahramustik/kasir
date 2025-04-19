@extends('layouts')

@section('title', 'Struk Penjualan')

@section('content')
<div class="w-full max-w-5xl mx-auto p-8 border rounded shadow bg-white">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-bold">Struk Penjualan</h2>
        <a href="{{ route('penjualan.index') }}" class="bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-800">Kembali</a>
    </div>

    <div class="grid grid-cols-2 gap-4 text-sm mb-6">
        <div>
            <p><strong>ID Penjualan:</strong> {{ $penjualan->id }}</p>
            <p><strong>Tanggal:</strong> {{ $penjualan->created_at->format('d-m-Y H:i') }}</p>
        </div>
        <div>
            <p><strong>Kasir:</strong> {{ auth()->user()->name }}</p>
            @if ($penjualan->member)
                <p><strong>Member:</strong> {{ $penjualan->member->nama }} ({{ $penjualan->member->telp }})</p>
            @endif
        </div>
    </div>

    <table class="w-full text-sm border border-gray-300 mb-6">
        <thead>
            <tr class="bg-gray-100 text-left">
                <th class="border px-3 py-2">Produk</th>
                <th class="border px-3 py-2">Qty</th>
                <th class="border px-3 py-2">Harga Satuan</th>
                <th class="border px-3 py-2">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($penjualan->detailPenjualans as $item)
                <tr>
                    <td class="border px-3 py-2">{{ $item->produk->nama_produk }}</td>
                    <td class="border px-3 py-2">{{ $item->qty }}</td>
                    <td class="border px-3 py-2">Rp. {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                    <td class="border px-3 py-2">Rp. {{ number_format($item->sub_total, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="flex justify-end">
        <div class="w-full md:w-1/2 text-sm space-y-1">
            <p class="flex justify-between"><span><strong>Total:</strong></span> <span>Rp. {{ number_format($penjualan->total_harga, 0, ',', '.') }}</span></p>
            <p class="flex justify-between"><span><strong>Dibayar:</strong></span> <span>Rp. {{ number_format($penjualan->total_bayar, 0, ',', '.') }}</span></p>
            <p class="flex justify-between"><span><strong>Kembalian:</strong></span> <span>Rp. {{ number_format($penjualan->kembalian, 0, ',', '.') }}</span></p>

            @if ($penjualan->poin_dipakai)
                <p class="flex justify-between"><span><strong>Poin Dipakai:</strong></span> <span>{{ $penjualan->poin_dipakai }}</span></p>
            @endif
            @if ($penjualan->poin_didapat)
                <p class="flex justify-between"><span><strong>Poin Didapat:</strong></span> <span>{{ $penjualan->poin_didapat }}</span></p>
            @endif
        </div>
    </div>
</div>
@endsection
