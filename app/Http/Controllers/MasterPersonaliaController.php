<?php

namespace App\Http\Controllers;

use App\MasterDivision;
use App\MasterJabatan;
use App\MasterPersonalia;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class MasterPersonaliaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = MasterPersonalia::with(['jabatan', 'divisi'])->get();
        $jabatan = MasterJabatan::get();
        $divisi = MasterDivision::get();
        return view('admin.pages.personalia.index', compact(['data', 'jabatan', 'divisi']));
    }

    public function store(Request $request)
    {
        $rules = [
            'nip' => 'required|unique:master_personalias,nip',
            'nama' => 'required',
            'status' => 'required',
            'gaji_perday' => 'required',
            'master_jabatan_id' => 'required',
            'master_division_id' => 'required',
        ];

        $messages = [
            'nip.required' => 'NIP wajib diisi!',
            'nip.unique' => 'NIP sudah terdaftar!',
            'nama.required' => 'nama wajib diisi!',
            'status.required' => 'status wajib diisi!',
            'gaji_perday.required' => 'gaji wajib diisi!',
            'master_jabatan_id.required' => 'jabatan wajib diisi!',
            'master_division_id.required' => 'divisi wajib diisi!',
        ];
        
        $validator = \Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()){
            $error = $validator->getMessageBag()->first();

            Alert::toast($error, 'error');
            return redirect()->route('master-personalia.index');
        }else{

            $data = $validator->validated();
            MasterPersonalia::insert($data);
            Alert::toast('personalia berhasil dibuat!', 'success');
            return redirect()->route('master-personalia.index');
        }
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'nip' => 'required|unique:master_personalias,nip,'.$id,
            'nama' => 'required',
            'status' => 'required',
            'gaji_perday' => 'required',
            'master_jabatan_id' => 'required',
            'master_division_id' => 'required',
        ];

        $messages = [
            'nip.required' => 'NIP wajib diisi!',
            'nip.unique' => 'NIP sudah terdaftar!',
            'nama.required' => 'nama wajib diisi!',
            'status.required' => 'status wajib diisi!',
            'gaji_perday.required' => 'gaji wajib diisi!',
            'master_jabatan_id.required' => 'jabatan wajib diisi!',
            'master_division_id.required' => 'divisi wajib diisi!',
        ];
        
        $validator = \Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()){
            $error = $validator->getMessageBag()->first();

            Alert::toast($error, 'error');
            return redirect()->route('master-personalia.index');
        }else{

            $data = $validator->validated();
            MasterPersonalia::findOrFail($id)->update($data);
            Alert::toast('personalia berhasil diubah!', 'success');
            return redirect()->route('master-personalia.index');
        }
    }

    public function delete($id)
    {
        $data = MasterPersonalia::findOrFail($id);
        $data->delete();

        Alert::toast('personalia berhasil dihapus!', 'success');
        return redirect()->route('master-personalia.index');
    }
}
