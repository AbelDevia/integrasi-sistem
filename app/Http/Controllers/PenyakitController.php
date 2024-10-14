<?php

namespace App\Http\Controllers;

use App\Models\Penyakit;
use Illuminate\Http\Request;

class PenyakitController extends Controller
{
    public function index()
    {
        // Mengambil semua data penyakit
        $penyakits = Penyakit::all();
        return view('dashboard.penyakit.index', compact('penyakits'));
    }
    public function create()
    {
        return view('dashboard.penyakit.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|unique:penyakit',
            'nama' => 'required',
            'deskripsi' => 'required',
            'rekomendasi' => 'required',
        ]);

        Penyakit::create($request->all());
        return redirect()->route('penyakit.index')->with('success', 'Penyakit added successfully.');
    }
    // Menampilkan form edit penyakit
    public function edit($id)
    {
        $penyakit = Penyakit::findOrFail($id); // Cari penyakit berdasarkan ID
        return view('dashboard.penyakit.edit', compact('penyakit'));
    }

    // Memperbarui data penyakit di database
    public function update(Request $request, $id)
    {
        $request->validate([
            'kode' => 'required|string|max:10',
            'nama' => 'required|string|max:100',
            'deskripsi' => 'required|string',
            'rekomendasi' => 'required|string',
        ]);

        $penyakit = Penyakit::findOrFail($id);
        $penyakit->update($request->all()); // Update data

        return redirect()->route('penyakit.index')->with('success', 'Data penyakit berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $penyakit = Penyakit::findOrFail($id);
        $penyakit->delete();

        return redirect()->route('penyakit.index')->with('success', 'Penyakit deleted successfully.');
    }
}
