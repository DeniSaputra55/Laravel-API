<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //menampilkan semua data secara berurutan
        $data = Produk::orderBy('nama')->get();
        //mengeluarkan data dalam bentuk json
        return response()->json([
            'status' => true,
            'message' => 'Data ditemukan',
            'data' => $data
            //memberikan respon jika berhasil
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
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
            $new_produk->gambar = $imageName;
            $new_produk->harga = $request->harga;
            $new_produk->save();

            return response()->json([
                'status' => true,
                'message' => 'Tambah data berhasil',
                'data' => $new_produk
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Tambah data gagal',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //menampilkan data by id
        $data = Produk::find($id);
        //memberikan respon jika memiliki data
        if ($data) {
            return response()->json([
                'status' => true,
                'message' => 'Data ditemukan',
                'data' => $data
            ], 200);
            //memberikan respon jika tidak memiliki data
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Mendapatkan data produk berdasarkan ID
        $produk = Produk::find($id);

        // Mengecek apakah data produk ditemukan
        if (empty($produk)) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        // Membuat aturan validasi
        $rules = [
            'nama' => 'required|string',
            'kategori' => 'required|string',
            'deskripsi' => 'required|string',
            'stok' => 'required|numeric|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Gambar tidak wajib diisi
            'harga' => 'required|numeric|min:1',
        ];

        // Memvalidasi data
        $validator = Validator::make($request->all(), $rules);

        // Memberikan respons jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal melakukan update data',
                'data' => $validator->errors()
            ], 422); // Status code untuk validasi gagal adalah 422
        }

        // Menangani file gambar (jika ada)
        if ($request->hasFile('gambar')) {
            // Menghapus gambar lama jika ada
            if ($produk->gambar && file_exists(public_path('img/' . $produk->gambar))) {
                unlink(public_path('img/' . $produk->gambar));
            }

            // Menyimpan gambar baru
            $gambar = $request->file('gambar');
            $gambarName = time() . '.' . $gambar->getClientOriginalExtension();
            $gambar->move(public_path('img'), $gambarName);
            $produk->gambar = $gambarName;
        }

        // Memperbarui data produk
        $produk->nama = $request->nama;
        $produk->kategori = $request->kategori;
        $produk->deskripsi = $request->deskripsi;
        $produk->stok = $request->stok;
        $produk->harga = $request->harga;

        // Menyimpan data ke database
        if ($produk->save()) {
            return response()->json([
                'status' => true,
                'message' => 'Sukses melakukan update data',
                // 'data' => $produk
            ], 200);
        }

        // Memberikan respons jika gagal menyimpan
        return response()->json([
            'status' => false,
            'message' => 'Gagal menyimpan perubahan data',
            'data'=>$validator->errors()
        ], 404);
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //untuk menghapus data
        $dataProduk = Produk::find($id);
        if (empty($dataProduk)) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }
        $post = $dataProduk->delete();

        return response()->json([
            'status' => true,
            'message' => 'sukses menghapus data'
        ], 200);
    }
}
