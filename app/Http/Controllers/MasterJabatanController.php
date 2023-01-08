<?php

namespace App\Http\Controllers;

use App\MasterJabatan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class MasterJabatanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = MasterJabatan::get();

        return view('admin.pages.jabatan.index', compact('data'));
    }

    public function store(Request $request)
    {
        $rules = [
            'nama_jabatan' => 'required|unique:master_jabatans,nama_jabatan'
        ];

        $messages = [
            'nama_jabatan.required' => 'Nama Jabatan wajib diisi!',
            'nama_jabatan.unique' => 'Nama Jabatan sudah terdaftar!',
        ];
        
        $validator = \Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()){
            $error = $validator->getMessageBag()->first();

            Alert::toast($error, 'error');
            return redirect()->route('master-jabatan.index');
        }else{

            $data = $validator->validated();
            MasterJabatan::insert($data);
            Alert::toast('Jabatan berhasil dibuat!', 'success');
            return redirect()->route('master-jabatan.index');
        }
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'nama_jabatan' => 'required|unique:master_jabatans,nama_jabatan,'.$id
        ];

        $messages = [
            'nama_jabatan.required' => 'Nama Jabatan wajib diisi!',
            'nama_jabatan.unique' => 'Nama Jabatan sudah terdaftar!',
        ];
        
        $validator = \Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()){
            $error = $validator->getMessageBag()->first();

            Alert::toast($error, 'error');
            return redirect()->route('master-jabatan.index');
        }else{

            $data = $validator->validated();
            MasterJabatan::findOrFail($id)->update($data);
            Alert::toast('Jabatan berhasil diubah!', 'success');
            return redirect()->route('master-jabatan.index');
        }
    }

    public function delete($id)
    {
        $data = MasterJabatan::findOrFail($id);
        $data->delete();

        Alert::toast('Jabatan berhasil dihapus!', 'success');
        return redirect()->route('master-jabatan.index');
    }
}
