@extends('layouts')

@section('content')

<div class="text-sm text-gray-500 flex items-center space-x-2 mb-2">
        <a href="{{ route('dashboard') }}" class="text-gray-400 hover:text-gray-600">
            <i class="fas fa-home"></i>
        </a>
        <span>&gt;</span>
        <span class="text-gray-700">Produk</span>
    </div>

    <div class="mb-5 mt-6">
        <div>
            <h2 class="text-2xl font-bold">Produk</h2>
        </div>

<form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data" class="form-card">
    @csrf 

    <div class="form-grid">
        <div class="form-group">
            <label for="nama_produk">Nama Produk <span class="text-danger">*</span></label>
            <input type="text" id="nama_produk" name="nama_produk" required>
        </div>
        <div class="form-group">
            <label for="gambar_produk">Gambar Produk <span class="text-danger">*</span></label>
            <input type="file" id="gambar_produk" name="gambar_produk" accept="image/*" required>
        </div>
        <div class="form-group">
            <label for="harga">Harga <span class="text-danger">*</span></label>
            <input type="number" id="harga" name="harga" required>
        </div>
        <div class="form-group">
            <label for="stok">Stok <span class="text-danger">*</span></label>
            <input type="number" id="stok" name="stok" required>
        </div>
    </div>

    <div class="text-end mt-4">
        <button type="submit" class="btn-simpan">Simpan</button>
    </div>
</form>

@endsection

@push('styles')
<style>
    .form-card {
        max-width: 900px;
        margin: 60px auto;
        background: #fff;
        padding: 2.5rem;
        border-radius: 16px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    label {
        font-weight: 600;
        margin-bottom: 6px;
    }

    input[type="text"],
    input[type="file"],
    input[type="number"] {
        padding: 10px 14px;
        border: 1px solid #ccc;
        border-radius: 10px;
        font-size: 14px;
    }

    .btn-simpan {
        background: #0d6efd;
        color: white;
        border: none;
        padding: 10px 24px;
        border-radius: 10px;
        font-weight: 500;
        cursor: pointer;
    }

    .btn-simpan:hover {
        background: #0b5ed7;
    }

    .text-danger {
        color: #dc3545;
    }

    .text-end {
        text-align: right;
    }
</style>
@endpush
