<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TodoList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TodoListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //menampilkan seluruh data
        $data = TodoList::orderBy('id', 'asc')->orderBy('todo')->get();
        //response menjadi json
        return response()->json([
            'status' => true,
            'message' => 'data ditemukan',
            'data' => $data
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //input data
        $dataTodoList = new TodoList;
        //membuat validasi
        $rules = [
            'todo' => 'required',
            'tanggal' => 'required|date',
            'jam' => 'required|date_format:H:i', //untuk tipe data time
            'status' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        //memberikan response jika gagal
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => 'gagal memasukkan data',
                'data' => $validator->errors()
            ], 404);
        }
        //kolom yang dibutuhkan
        $dataTodoList->todo = $request->todo;
        $dataTodoList->tanggal = $request->tanggal;
        $dataTodoList->jam = $request->jam;
        $dataTodoList->status = $request->status;

        //simpan data 
        if($dataTodoList->save()){
            return response()->json([
                'status' => true,
                'message' => 'sukses memasukkan data'
            ], 200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //menampilkan data by id
        $data = TodoList::find($id);
        if($data){
            return response()->json([
                'status' => true,
                'message' => 'data ditemukan',
                'data' => $data
            ], 200);
            //memberikan respon jika tidak ada data
        } else {
            return response()->json([
                'status' => false,
                'message' => 'data tidak ditemukan'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //update data
        $dataTodoList = TodoList::find($id);
        if(empty($dataTodoList)){
            return response()->json([
                'status'=> false,
                'message' => 'data tidak ditemukan'
            ],404);
        }
        //validasi data
        $rules = [
            'todo' => 'required',
            'tanggal' =>'required|date',
            'jam' => 'required|date_format:H:i', //untuk tipe data time
            'status' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        //berikan response jika gagal
        if ($validator->fails()){
            return response()->json([
                'status'=> false,
                'message' => 'gagal update data',
                'data' => $validator->errors()
            ],404);
        }
        //kolom yang dibutuhkan
        //kolom yang dibutuhkan
        $dataTodoList->todo = $request->todo;
        $dataTodoList->tanggal = $request->tanggal;
        $dataTodoList->jam = $request->jam;
        $dataTodoList->status = $request->status;

        //simpan data 
        if($dataTodoList->save()){
            return response()->json([
                'status' => true,
                'message' => 'sukses memasukkan data'
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //hapus data
        $dataTodoList = TodoList::find($id);
        if(empty($dataTodoList)){
            return response()->json([
                'status'=> false,
                'message' => 'data tidak ditemukan'
            ], 404);
        }
        $post = $dataTodoList->delete();
        return response()->json([
            'status' => true,
            'message' => 'sukse hapus data'
        ], 200);
    }
}
