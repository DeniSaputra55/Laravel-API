<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    //menampilkan halaman index
    public function index()
    {
        $data_produk = Produk::all();
        return view('Produk.index', compact('data_produk'));
    }

    //menampilkan halaman create
    public function create()
    {
        return view('Produk.create');
    }

    // tambah data baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'kategori' => 'required|string',
            'deskripsi' => 'required|string',
            'stok' => 'required|numeric|min:0',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'harga' => 'required|numeric|min:1'
        ]);

        try {
            // Proses upload gambar
            $imageName = time() . '_' . $request->file('gambar')->getClientOriginalName();
            $request->file('gambar')->move(public_path('img'), $imageName);

            // Simpan data ke database
            $new_produk = new Produk;
            $new_produk->nama = $request->nama;
            $new_produk->kategori = $request->kategori;
            $new_produk->deskripsi = $request->deskripsi;
            $new_produk->stok = $request->stok;
            $new_produk->gambar = '' . $imageName;
            $new_produk->harga = $request->harga;
            $new_produk->save();

            return redirect('/produk')->with('success', 'Tambah data berhasil');
        } catch (\Exception $e) {
            return redirect('/add/produk')->with('fail', $e->getMessage());
        }
    }


    //menampilkan halaman edit
    public function edit($id)
    {
        $edit_produk = Produk::find($id);
        return view('Produk.update', compact('edit_produk'));
    }

    // Menampilkan halaman update
    public function update(Request $request)
    {
        // Validasi input dari pengguna
        $request->validate([
            'nama' => 'required|string',
            'kategori' => 'required|string',
            'deskripsi' => 'required|string',
            'stok' => 'required|numeric|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Gambar tidak wajib diisi
            'harga' => 'required|numeric|min:1',
        ]);

        try {
            // Mendapatkan data produk
            $produk = Produk::findOrFail($request->produk_id);

            // Menangani file gambar
            if ($request->hasFile('gambar')) {
                // Menghapus gambar lama jika ada
                if ($produk->gambar && file_exists(public_path('img/' . $produk->gambar))) {
                    unlink(public_path('img/' . $produk->gambar));
                }

                // Menyimpan gambar baru
                $gambar = $request->file('gambar');
                $gambarName = time() . '.' . $gambar->getClientOriginalExtension();
                $gambar->move(public_path('img'), $gambarName);
            } else {
                // Jika gambar tidak diubah, gunakan gambar lama
                $gambarName = $request->gambar_lama; // Pastikan 'gambar_lama' ada di form
            }

            // Memperbarui data produk
            $produk->update([
                'nama' => $request->nama,
                'kategori' => $request->kategori,
                'deskripsi' => $request->deskripsi,
                'stok' => $request->stok,
                'gambar' => $gambarName,
                'harga' => $request->harga,
            ]);

            return redirect('/produk')->with('success', 'Berhasil Update Data');
        } catch (\Exception $e) {
            return redirect('/edit/produk')->with('fail', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }


    //menampilkan halaman show
    public function show(string $id)
    {
        //menampilkan data by id
        $show_produk = Produk::find($id);

        if (!$show_produk) {
            return redirect('/produk')->with('fail', 'Produk tidak ditemukan!');
        }

        return view('Produk.show', compact('show_produk'));
    }

     //untuk menghapus data
     public function destroy($id)
     {
         //hapus data
         try {
            Produk::where('id', $id)->delete();
             return redirect('/produk')->with('success', 'Berhasil hapus data');
         } catch (\Exception $e) {
             return redirect('/produk')->with('fail', 'Gagal hapus data: ' . $e->getMessage());
         }
     }
}
