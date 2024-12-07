<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //menampilkan halaman index
        $data_buku = Buku::all();
        return view('Buku.index', compact('data_buku'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //menambahkan halaman tambah
        return view('Buku.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // tambah data baru
        $request->validate([
            'judul' => 'required|string',
            'pengarang' => 'required|string',
            'tanggal_publikasi' => 'required|date'
        ]);
        try {
            $new_buku = new Buku;
            $new_buku->judul = $request->judul;
            $new_buku->pengarang = $request->pengarang;
            $new_buku->tanggal_publikasi = $request->tanggal_publikasi;
            $new_buku->save();

            return redirect('/buku')->with('success', 'tambah data berhasil');
        } catch (\Exception $e) {
            return redirect('/add/buku')->with('fail', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //menampilkan data by id
        $show_buku = Buku::find($id);

        if (!$show_buku) {
            return redirect('/buku')->with('fail', 'Buku tidak ditemukan!');
        }

        return view('buku.show', compact('show_buku'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //menampilkan halaman edit
        $edit_buku = Buku::find($id);
        return view('Buku.update', compact('edit_buku'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //update data
        $request->validate([
            'judul' => 'required|string',
            'pengarang' => 'required|string',
            'tanggal_publikasi' => 'required|date'
        ]);
        try {
            // update  here
            $update_buku = Buku::where('id', $request->buku_id)->update([
                'judul' => $request->judul,
                'pengarang' => $request->pengarang,
                'tanggal_publikasi' => $request->tanggal_publikasi,
            ]);

            return redirect('/buku')->with('success', 'Berhasil Update Data');
        } catch (\Exception $e) {
            return redirect('/edit/buku')->with('fail', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //hapus data
        try {
            Buku::where('id', $id)->delete();
            return redirect('/buku')->with('success', 'Berhasil hapus data');
        } catch (\Exception $e) {
            return redirect('/buku')->with('fail', 'Gagal hapus data: ' . $e->getMessage());
        }
    }
}
