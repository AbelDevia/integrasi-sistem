<?php

namespace App\Http\Controllers;

use App\Models\Kambing;
use Illuminate\Http\Request;

class KambingController extends Controller
{
    public function index()
    {
        $kambings = Kambing::all();
        // dd($kambings);
        return view('dashboard.kambing.index', compact('kambings'));
    }

    public function create()
    {
        return view('dashboard.kambing.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|unique:kambing|max:10',
            'jenis_kelamin' => 'required|in:Jantan,Betina',
            'usia' => 'required|integer|min:1',
            'ras' => 'required|max:50',
        ]);

        Kambing::create($request->all());
        return redirect()->route('kambing.index')->with('success', 'Data Kambing berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kambings = Kambing::findOrFail($id);
        return view('dashboard.kambing.edit', compact('kambings'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode' => 'required|max:10|unique:kambing,kode,' . $id,
            'jenis_kelamin' => 'required|in:Jantan,Betina',
            'usia' => 'required|integer|min:1',
            'ras' => 'required|max:50',
        ]);

        $kambing = Kambing::findOrFail($id);
        $kambing->update($request->all());

        return redirect()->route('kambing.index')->with('success', 'Data Kambing berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Kambing::destroy($id);
        return redirect()->route('kambing.index')->with('success', 'Data Kambing berhasil dihapus.');
    }
}
