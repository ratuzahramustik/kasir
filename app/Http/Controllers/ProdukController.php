<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function index()
    {
        $produks = Produk::all();
        return view('produk.index', compact('produks'));
    }

    public function create()
    {
        return view('produk.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
            'gambar_produk' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $gambar = null;
        if ($request->hasFile('gambar_produk')) {
            $gambar = $request->file('gambar_produk')->store('produk', 'public');
        }

        Produk::create([
            'nama_produk' => $request->nama_produk,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'gambar_produk' => $gambar,
        ]);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit(Produk $produk)
    {
        return view('produk.edit', [
            'produk' => $produk,
            'mode' => 'full',
        ]);
    }

    public function update(Request $request, Produk $produk)
    {
        $request->validate([
            'nama_produk'    => 'required|string|max:255',
            'harga'          => 'required|numeric|min:0',
            'stok'           => 'required|numeric|min:0',
            'gambar_produk'  => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);
    
        $data = [
            'nama_produk' => $request->nama_produk,
            'harga'       => $request->harga,
            'stok'        => $request->stok,
        ];
    
        if ($request->hasFile('gambar_produk')) {
            if ($produk->gambar_produk && Storage::disk('public')->exists($produk->gambar_produk)) {
                Storage::disk('public')->delete($produk->gambar_produk);
            }
    
            $data['gambar_produk'] = $request->file('gambar_produk')->store('produk', 'public');
        }
    
        $produk->update($data);
    
        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui');
    }
    

    public function editStok(Produk $produk)
    {
        return view('produk.edit', [
            'produk' => $produk,
            'mode' => 'stok',
        ]);
    }

    public function updateStok(Request $request, Produk $produk)
    {
        $request->validate([
            'stok' => 'required|numeric|min:0',
        ]);

        $produk->update([
            'stok' => $request->stok
        ]);

        return redirect()->route('produk.index')->with('success', 'Stok produk berhasil diperbarui');
    }

    public function destroy(Produk $produk)
    {
        if ($produk->gambar_produk && Storage::disk('public')->exists($produk->gambar_produk)) {
            Storage::disk('public')->delete($produk->gambar_produk);
        }

        $produk->delete();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus');
    }

    // App\Models\Produk.php
public function getImageUrlAttribute()
{
    return $this->gambar_produk
        ? asset('storage/' . $this->gambar_produk)
        : 'https://via.placeholder.com/150';
}

    

}
