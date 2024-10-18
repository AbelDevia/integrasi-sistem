<?php

namespace App\Http\Controllers;

use App\Models\Gejala;
use Illuminate\Http\Request;

class GejalaController extends Controller
{
    public function index()
    {
        $gejala = Gejala::all();
        return view('dashboard.gejala.index', compact('gejala'));
    }

    public function create()
    {
        return view('dashboard.gejala.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|unique:gejala,kode|max:10',
            'deskripsi' => 'required',
        ]);

        Gejala::create($request->all());

        return redirect()->route('gejala.index')->with('success', 'Gejala berhasil ditambahkan.');
    }

    public function edit(Gejala $gejala)
    {
        return view('dashboard.gejala.edit', compact('gejala'));
    }

    public function update(Request $request, Gejala $gejala)
    {
        $request->validate([
            'kode' => 'required|max:10|unique:gejala,kode,' . $gejala->id,
            'deskripsi' => 'required',
        ]);

        $gejala->update($request->all());

        return redirect()->route('gejala.index')->with('success', 'Gejala berhasil diupdate.');
    }

    public function destroy(Gejala $gejala)
    {
        $gejala->delete();
        return redirect()->route('gejala.index')->with('success', 'Gejala berhasil dihapus.');
    }
}
