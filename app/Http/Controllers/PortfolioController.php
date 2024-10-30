<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    // Menampilkan daftar portofolio
    public function index()
    {
        $portfolios = Portfolio::all();
        return view('portfolio.index', compact('portfolios'));
    }

    // Menampilkan form untuk membuat portofolio baru
    public function create()
    {
        return view('portfolio.create');
    }

    public function cv()
    {
        // Ambil informasi CV dari database
        $cv = auth()->user()->cv; // Asumsi Anda menyimpan CV di dalam model User atau model lain yang berhubungan
        return view('portfolio.cv', compact('cv'));
    }
    
    // Menampilkan form untuk mengedit portofolio
    public function edit()
    {
        $cv = auth()->user()->cv; // Ambil data CV yang ingin diedit
        return view('portfolio.edit', compact('cv'));
    }
    
    // Memperbarui portofolio yang ada
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            // Validasi lainnya sesuai kebutuhan
        ]);
    
        $cv = auth()->user()->cv; // Ambil data CV yang ingin diperbarui
        $cv->update($request->all()); // Update dengan data dari request
    
        return redirect()->route('cv.show')->with('success', 'CV updated successfully!');
    }
    


    // Menyimpan portofolio baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        Portfolio::create($request->all());

        return redirect()->route('portfolio.index')->with('success', 'Portfolio created successfully.');
    }

    // Menampilkan detail portofolio
    public function show(Portfolio $portfolio)
    {
        return view('portfolio.show', compact('portfolio'));
    }

    // Menghapus portofolio
    public function destroy(Portfolio $portfolio)
    {
        $portfolio->delete();

        return redirect()->route('portfolio.index')->with('success', 'Portfolio deleted successfully.');
    }
}
