@extends('layouts')

@section('content')
<div class="max-w-4xl mx-auto mt-10 bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-6">Edit Produk</h2>

    <form action="{{ route('produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Kiri: Nama & Harga -->
            <div>
                <!-- Nama Produk -->
                <div class="mb-4">
                    <label for="nama_produk" class="block font-medium mb-1">Nama Produk</label>
                    <input type="text" name="nama_produk" id="nama_produk" value="{{ old('nama_produk', $produk->nama_produk) }}"
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-blue-500">
                    @error('nama_produk')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Harga -->
                <div class="mb-4">
                    <label for="harga" class="block font-medium mb-1">Harga</label>
                    <input type="number" name="harga" id="harga" value="{{ old('harga', $produk->harga) }}"
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-blue-500">
                    @error('harga')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Kanan: Gambar & Stok -->
            <div>
                <!-- Gambar Produk -->
                <div class="mb-4">
                    <label for="gambar_produk" class="block font-medium mb-1">Gambar Produk</label>
                    <input type="file" name="gambar_produk" id="gambar_produk"
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-blue-500">
                    @error('gambar_produk')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Stok -->
                <div class="mb-4">
                    <label for="stok" class="block font-medium mb-1">Stok</label>
                    <input type="number" name="stok" id="stok" value="{{ old('stok', $produk->stok) }}"
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-blue-500">
                    @error('stok')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Tombol -->
        <div class="flex justify-end space-x-2 mt-6">
            <a href="{{ route('produk.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">
                Batal
            </a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection
