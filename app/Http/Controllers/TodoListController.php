<?php

namespace App\Http\Controllers;

use App\Models\TodoList;
use Illuminate\Http\Request;

class TodoListController extends Controller
{
    //menampilkan halaman index
    public function index()
    {
        $data_todo = TodoList::all();
        return view('TodoList.index', compact('data_todo'));
    }

    //menampilkan halaman create
    public function create()
    {
        return view('TodoList.create');
    }

    //ekesekusi masuk ke data
    public function store(Request $request)
    {
        $request->validate([
            'todo'=>'required|string',
            'tanggal' =>'required|date',
            'jam'=>'required|date_format:H:i',//untuk tipe data time
            'status'=>'required|in:belum,sedang,sudah'//untuk tipe enum
        ]);
        try{
            $new_todo = new TodoList;
            $new_todo->todo = $request->todo;
            $new_todo->tanggal = $request->tanggal;
            $new_todo->jam = $request->jam;
            $new_todo->status = $request->status;
            $new_todo->save();
            
            return redirect('/todo')->with('success', 'tambah data berhasil');
        }catch (\Exception $e){
            return redirect('/add/todo')->with('fail', $e->getMessage());
        }
    }

    //menampilkan halaman update
    public function edit($id)
    {
        $edit_todo = TodoList::find($id);
        return view('TodoList.update', compact('edit_todo'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'todo'=>'required|string',
            'tanggal' =>'required|date',
            'jam'=>'required',//untuk tipe data time
            'status'=>'required|in:belum,sedang,sudah'//untuk tipe enum
        ]);
        try{
            $update_todo = TodoList::where('id', $request->todo_id)->update([
                'todo' =>$request->todo,
                'tanggal' =>$request->tanggal,
                'jam' => $request->jam,
                'status' => $request->status
            ]);
            return redirect('/todo')->with('success', 'tambah data berhasil');
        } catch (\Exception $e){
            return redirect('/edit/todo')->with('fail', $e->getMessage());
        }
    }

    //menampilkan halaman show
    public function show(string $id)
    {
        //menampilkan data by id
        $show_todo = TodoList::find($id);

        if (!$show_todo) {
            return redirect('/todo')->with('fail', 'Todo tidak ditemukan!');
        }

        return view('TodoList.show', compact('show_todo'));
    }

    //untuk menghapus data
    public function destroy($id)
    {
        //hapus data
        try {
            TodoList::where('id', $id)->delete();
            return redirect('/todo')->with('success', 'Berhasil hapus data');
        } catch (\Exception $e) {
            return redirect('/todo')->with('fail', 'Gagal hapus data: ' . $e->getMessage());
        }
    }

}
