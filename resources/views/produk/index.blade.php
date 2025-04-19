@extends('layouts')

@section('content')

<!-- Alpine.js wrapper -->
<div x-data="{ openModal: false, selectedProduk: null, selectedNamaProduk: '', stokValue: 0 }">

    <!-- Breadcrumb -->
    <div class="text-sm text-gray-500 flex items-center space-x-2 mb-2">
        <a href="{{ route('dashboard') }}" class="text-gray-400 hover:text-gray-600">
            <i class="fas fa-home"></i>
        </a>
        <span>&gt;</span>
        <span class="text-gray-700">Produk</span>
    </div>

    
    <!-- Header -->
    <div class="mb-5 mt-6">
        <div>
            <h2 class="text-2xl font-bold">Produk</h2>
        </div>
        <div class="flex justify-between items-center mb-4">
            <form action="{{ route('produk.export.excel') }}" method="GET">
                <button type="submit"
                    class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition text-base">
                    Export Excel
                </button>
            </form>

        @if (Auth::user()->role === 'admin')
        <div class="mt-10 flex justify-end">
            <a href="{{ route('produk.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                Tambah Produk
            </a>
        </div>
        @endif
    </div>

    <!-- Alert -->
    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    <!-- Table -->
    <div class="overflow-x-auto bg-white rounded shadow">
        <table class="min-w-full table-auto border-collapse table">
            <thead class="bg-white-100">
                <tr>
                    <th class="px-4 py-3 border">#</th>
                    <th class="px-4 py-3 border">Gambar</th>
                    <th class="px-4 py-3 border">Nama Produk</th>
                    <th class="px-4 py-3 border">Harga</th>
                    <th class="px-4 py-3 border">Stok</th>
                    <th class="px-4 py-3 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($produks as $index => $produk)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 border text-center">{{ $index + 1 }}</td>
                        <td class="px-4 py-3 border text-center">
                            @if($produk->gambar_produk)
                                <img src="{{ asset('storage/' . $produk->gambar_produk) }}" alt="gambar" class="produk-img">
                            @else
                                <span class="text-gray-400 italic">Tidak ada</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 border text-center text-lg">{{ $produk->nama_produk }}</td>
                        <td class="px-4 py-3 border text-center">Rp. {{ number_format($produk->harga, 0, ',', '.') }}</td>
                        <td class="px-4 py-3 border text-center">{{ $produk->stok }}</td>

                        <!-- Tombol Aksi -->
                        <td class="px-4 py-3 border text-center space-x-1">
                            <a href="{{ route('produk.edit', $produk->id) }}" class="bg-yellow-400 text-white px-3 py-1 rounded hover:bg-yellow-500 text-sm">
                                Edit
                            </a>

                         <button @click.prevent="selectedProduk = {{ $produk->id }},selectedNamaProduk = '{{ e($produk->nama_produk) }}',
                        stokValue = {{ $produk->stok }}, openModal = true"class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 text-sm">
                        Update Stok
                        </button>

                            <form action="{{ route('produk.destroy', $produk->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 text-sm">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-4 text-center text-gray-500">Belum ada produk</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Modal Update Stok -->
<div x-show="openModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
    <div class="relative bg-white rounded-lg p-6 w-full max-w-md shadow-lg">

        <!-- Tombol silang di pojok kanan atas -->
        <button @click="openModal = false"
            class="absolute top-2 right-2 text-gray-500 hover:text-red-500 text-xl font-bold focus:outline-none">
            &times;
        </button>

        <h3 class="text-lg font-bold mb-4">Update Stok Baru</h3>

        <form :action="`/produk/${selectedProduk}/update-stok`" method="POST">
            @csrf
            @method('PUT')

            <input type="hidden" name="id" :value="selectedProduk">

            <div class="mb-4">
            <label class="block mb-1 font-medium">Nama Produk</label>
            <div class="w-full border border-gray-300 rounded px-3 py-2 bg-gray-100" x-text="selectedNamaProduk"></div>
            </div>


            <div class="mb-4">
                <label class="block mb-1 font-medium">Stok</label>
                <input type="number" name="stok" x-model="stokValue"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-blue-500">
            </div>

            <div class="flex justify-end space-x-2">
                <button type="button" @click="openModal = false"
                    class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">
                    Batal
                </button>
                <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>


@push('styles')
<style>
    table.table {
        background-color: #ffffff;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.06);
    }

    table.table th,
    table.table td {
        vertical-align: middle !important;
        text-align: center;
    }

    img.produk-img {
        width: auto;
        max-width: 100%;
        height: 100px;
        object-fit: cover;
        margin: auto;
        display: block;
    }
</style>
@endpush

@endsection
