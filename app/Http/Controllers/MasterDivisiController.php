<?php

namespace App\Http\Controllers;

use App\MasterDivision;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class MasterDivisiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = MasterDivision::get();

        return view('admin.pages.divisi.index', compact('data'));
    }

    public function store(Request $request)
    {
        $rules = [
            'nama_divisi' => 'required|unique:master_divisions,nama_divisi'
        ];

        $messages = [
            'nama_divisi.required' => 'Nama divisi wajib diisi!',
            'nama_divisi.unique' => 'Nama divisi sudah terdaftar!',
        ];
        
        $validator = \Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()){
            $error = $validator->getMessageBag()->first();

            Alert::toast($error, 'error');
            return redirect()->route('master-divisi.index');
        }else{

            $data = $validator->validated();
            MasterDivision::insert($data);
            Alert::toast('divisi berhasil dibuat!', 'success');
            return redirect()->route('master-divisi.index');
        }
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'nama_divisi' => 'required|unique:master_divisions,nama_divisi,'.$id
        ];

        $messages = [
            'nama_divisi.required' => 'Nama divisi wajib diisi!',
            'nama_divisi.unique' => 'Nama divisi sudah terdaftar!',
        ];
        
        $validator = \Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()){
            $error = $validator->getMessageBag()->first();

            Alert::toast($error, 'error');
            return redirect()->route('master-divisi.index');
        }else{

            $data = $validator->validated();
            MasterDivision::findOrFail($id)->update($data);
            Alert::toast('divisi berhasil diubah!', 'success');
            return redirect()->route('master-divisi.index');
        }
    }

    public function delete($id)
    {
        $data = MasterDivision::findOrFail($id);
        $data->delete();

        Alert::toast('divisi berhasil dihapus!', 'success');
        return redirect()->route('master-divisi.index');
    }
}
