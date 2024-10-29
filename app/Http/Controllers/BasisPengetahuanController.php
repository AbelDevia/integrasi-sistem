<?php

namespace App\Http\Controllers;

use App\Models\BasisPengetahuan;
use App\Models\Gejala;
use App\Models\Penyakit;
use Illuminate\Http\Request;

class BasisPengetahuanController extends Controller
{
    public function index()
    {
        $basisPengetahuans = BasisPengetahuan::all();
        return view('dashboard.basis_pengetahuan.index', compact('basisPengetahuans'));
    }

    public function create()
    {
        $penyakits = Penyakit::all();
        $gejalas = Gejala::all();
        return view('dashboard.basis_pengetahuan.create', compact('penyakits', 'gejalas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'gejala_id' => 'required|exists:gejala,id',
            'penyakit_id' => 'required|exists:penyakit,id',
        ]);

        BasisPengetahuan::create($request->all());
        return redirect()->route('basis_pengetahuan.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $basisPengetahuan = BasisPengetahuan::findOrFail($id);
        $penyakits = Penyakit::all();
        $gejalas = Gejala::all();
        return view('dashboard.basis_pengetahuan.edit', compact('basisPengetahuan', 'penyakits', 'gejalas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'gejala_id' => 'required|exists:gejala,id',
            'penyakit_id' => 'required|exists:penyakit,id',
        ]);

        $basisPengetahuan = BasisPengetahuan::findOrFail($id);
        $basisPengetahuan->update($request->all());
        return redirect()->route('basis_pengetahuan.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $basisPengetahuan = BasisPengetahuan::findOrFail($id);
        $basisPengetahuan->delete();
        return redirect()->route('basis_pengetahuan.index')->with('success', 'Data berhasil dihapus!');
    }
}
