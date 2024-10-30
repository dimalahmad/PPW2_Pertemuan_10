<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_buku = Buku::all(); // Mendapatkan semua data buku
        $jumlah_buku = Buku::count(); // Menghitung jumlah total buku
        $batas = 5;
        $banyak_buku = Buku::orderBy('id', 'desc')->paginate($batas);
        $no = $batas * ($banyak_buku->currentPage() - 1);
        $total_harga = Buku::sum('harga'); // Menghitung total harga dari semua buku
        
        // Mengirimkan $banyak_buku ke view juga
        return view('buku.index', compact('data_buku', 'no', 'jumlah_buku', 'total_harga', 'banyak_buku'));
    }
    public function search(Request $request)
    {
        $batas = 5;
        $cari = $request->kata;
    
        $banyak_buku = Buku::where('judul', 'like', '%' . $cari . '%')
            ->orWhere('penulis', 'like', '%' . $cari . '%')
            ->paginate($batas);
    
        $jumlah_buku = $banyak_buku->total(); // Total number of items matching the search
        $no = $batas * ($banyak_buku->currentPage() - 1);
    
        return view('buku.search', compact('jumlah_buku', 'banyak_buku', 'no', 'cari'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('buku.create');
    }

    /**
     * Store a newly created resource in storage.
     */   
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'judul' => 'required|string|max:25',
            'penulis' => 'required|string|max:25',
            'harga' => 'required|numeric|min:1000|max:999999999',
            'tgl_terbit' => 'required|date',
        ],[
            'judul.required' =>"Judul belum diisi",
            'judul.max' =>"Judul terlalu panjang",
            'penulis.required' =>"Penulis belum diisi",
            'penulis.max' =>"Penulis terlalu panjang",
            'harga.required' =>"Harga belum diisi",
            'harga.numeric' =>"Harga harus angka",
            'harga.min' =>"Harga tidak sesuai",
            'harga.max' =>"Harga terlalu mahal",
            'date.required' =>"Tanggal belum diisi",
        ]);

        $tambah_buku = Buku::create([
            'judul' => $validatedData['judul'],
            'penulis' => $validatedData['penulis'],
            'harga' => $validatedData['harga'],
            'tgl_terbit' => $validatedData['tgl_terbit'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        if ($tambah_buku) {
            return redirect('/buku')->with('success', 'Berhasil menambahkan data');
        } else {
            return back()->with('error', 'Data yang diinput gagal');
        }
    }

    private function getBuku($id)
    {
        return Buku::findOrFail($id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $buku = Buku::find($id);
        if ($buku) {
            $edit = Buku::find($id); // Mengambil data buku berdasarkan ID
            return view('buku.edit', compact('edit')); // Mengirim variabel $edit ke view
        } else {
            return redirect('/buku')->with('error', 'Data tidak ditemukan');
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {

        $buku = Buku::find($id);
        if ($buku) {
            $buku->judul = $request->judul;
            $buku->penulis = $request->penulis;
            $buku->harga = $request->harga;
            $buku->tgl_terbit = $request->tgl_terbit;
            $buku->save();
            
            return redirect('/buku')->with('success', 'berhasil mengubah data');
        } else {
            return back()->with('error', 'Data tidak ditemukan');
        }
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $buku = Buku::find($id);
        $buku->delete();

        return redirect('/buku');
    }
}
