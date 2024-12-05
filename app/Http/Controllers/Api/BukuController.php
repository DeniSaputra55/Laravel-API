<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //menampilkan semua data secara berurutan
        $data = Buku::orderBy('judul', 'asc')->get();
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
        // Memasukkan data buku baru
        $dataBuku = new Buku;
        //membuat validasi
        $rules = [
            'judul' => 'required',
            'pengarang' => 'required',
            //membuat format tanggal saja yang diperbolehkan
            'tanggal_publikasi' => 'required|date'
        ];

        $validator = Validator::make($request->all(), $rules);
        // Berikan response jika gagal
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal memasukkan data, cek kolom yang belum di isi',
                'data' => $validator->errors()
            ], 400);
        }

        // Masukkan kolom yang dibutuhkan
        $dataBuku->judul = $request->judul;
        $dataBuku->pengarang = $request->pengarang;
        $dataBuku->tanggal_publikasi = $request->tanggal_publikasi;

        // Simpan data buku ke database
        if ($dataBuku->save()) {
            // Berikan response jika berhasil
            return response()->json([
                'status' => true,
                'message' => 'Sukses memasukkan data'
            ], 200);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //menampilkan buku by id
        $data = Buku::find($id);
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
        //untuk update data baru yang sudah ada
        $dataBuku = Buku::find($id);
        //untuk mengecek apakah memiliki data
        if(empty($dataBuku)){
            return response()->json([
                'status'=>false,
                'message'=>'data tidak ditemukan'
            ], 404);
        }
        //membuat validasi
        $rules = [
            'judul' => 'required',
            'pengarang' => 'required',
            //membuat format tanggal saja yang diperbolehkan
            'tanggal_publikasi' => 'required|date'
        ];

        $validator = Validator::make($request->all(), $rules);
        // Berikan response jika gagal
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal melakukan update data',
                'data' => $validator->errors()
            ], 400);
        }

        // Masukkan kolom yang dibutuhkan
        $dataBuku->judul = $request->judul;
        $dataBuku->pengarang = $request->pengarang;
        $dataBuku->tanggal_publikasi = $request->tanggal_publikasi;

        // Simpan data buku ke database
        if ($dataBuku->save()) {
            // Berikan response jika berhasil
            return response()->json([
                'status' => true,
                'message' => 'Sukses melakukan update  data'
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //untuk menghapus data 
        $dataBuku = Buku::find($id);
        if(empty($dataBuku)){
            return response()->json([
                'status'=>false,
                'message'=>'data tidak ditemukan'
            ], 404);
        }
        $post = $dataBuku->delete();

        return response()->json([
            'status' => true,
            'message' => 'sukses menghapus data'
        ]);
    }
}
