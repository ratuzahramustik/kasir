@extends('layouts')

@section('content')

<div class="text-sm text-gray-500 flex items-center space-x-2 mb-2">
    <a href="{{ route('dashboard') }}" class="text-gray-400 hover:text-gray-600">
        <i class="fas fa-home"></i>
    </a>
    <span>&gt;</span>
    <span class="text-gray-700">Checkout</span>
</div>

<div class="mb-5 mt-6">
    <div>
        <h2 class="text-2xl font-bold">Checkout</h2>
    </div>

    <form action="{{ route('sales.process.member') }}" method="POST" class="form-card">
        @csrf

        @foreach ($orders as $index => $item)
            <div class="form-grid border border-gray-200 p-4 mb-4 rounded-lg bg-gray-50">
                <div class="form-group">
                    <label>Nama Produk</label>
                    <input type="text" value="{{ $item['produk']->nama_produk }}" readonly>
                    </div>
                <div class="form-group">
                    <label>Harga</label>
                    <input type="text" value="Rp. {{ number_format($item['produk']->harga, 0, ',', '.') }}" readonly>
                </div>
                <div class="form-group">
                    <label>Jumlah</label>
                    <input type="text" value="{{ $item['quantity'] }}" readonly>
                </div>
                <div class="form-group">
                    <label>Subtotal</label>
                    <input type="text" value="Rp. {{ number_format($item['subtotal'], 0, ',', '.') }}" readonly>
                </div>

                <input type="hidden" name="orders[{{ $index }}][produk_id]" value="{{ $item['produk']->id }}">
                <input type="hidden" name="orders[{{ $index }}][quantity]" value="{{ $item['quantity'] }}">
                <input type="hidden" name="orders[{{ $index }}][subtotal]" value="{{ $item['subtotal'] }}">
            </div>
        @endforeach

        <div class="form-group">
            <label>Total Harga</label>
            <input type="text" value="Rp. {{ number_format($totalPrice, 0, ',', '.') }}" readonly>
            <input type="hidden" name="total_price" value="{{ $totalPrice }}">
        </div>

        <div class="form-group">
            <label for="total_paid">Total Bayar <span class="text-danger">*</span></label>
            <input type="text" name="total_paid" id="total_paid" required min="{{ $totalPrice }}">
        </div>

        <div class="form-group">
            <label>Apakah Member? <span class="text-danger">*</span></label>
            <div class="flex items-center space-x-4 mt-1">
                <label><input type="radio" name="is_member" value="1" required> Ya</label>
                <label><input type="radio" name="is_member" value="0"> Bukan</label>
            </div>
        </div>

        <div class="form-group" id="phone-field">
            <label for="number_telephone">Nomor Telepon</label>
            <input type="text" name="number_telephone" id="number_telephone">
        </div>

        <div class="text-end mt-4">
            <button type="submit" class="btn-simpan">Lanjutkan</button>
        </div>
    </form>
</div>
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
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
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
        background-color: #f9f9f9;
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
