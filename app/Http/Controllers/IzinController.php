<?php

namespace App\Http\Controllers;

use App\Izin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Storage;

class IzinController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = Auth::user()->personalia()->first()->izin()->get();

        return view('admin.pages.izin.index', compact('data'));
    }

    public function store(Request $request)
    {
        $rules = [
            'tanggal_izin' => 'required|date',
            'jenis_izin' => 'required|in:sakit,cuti',
            'keterangan' => 'required',
            'file_bukti' => 'required',
        ];

        $messages = [
            'tanggal_izin.required' => 'Tanggal izin wajib diisi!',
            'tanggal_izin.date' => 'Tanggal izin harus berformat tanggal!',
            'jenis_izin.required' => 'Jenis izin wajib diisi!',
            'jenis_izin.in' => 'Jenis izin hanya sakit dan cuti!',
            'keterangan.required' => 'Keterangan wajib diisi!',
            'file_bukti.required' => 'File bukti wajib diisi!',
        ];
        
        $validator = \Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()){
            $error = $validator->getMessageBag()->first();

            Alert::toast($error, 'error');
            return redirect()->route('izin.index');
        }else{

            $data = $validator->validated();
            $data['master_personalia_id'] = Auth::user()->master_personalia_id;
            $data['status'] = 'menunggu approval';
            $gambar = '';
            if ($data['file_bukti']) {
                $file = $data['file_bukti'];
                $file_name = $file->getFilename().".".strtolower($file->getClientOriginalExtension());
                
                $file_location = "assets/img/portfolio/";
                
                $gambar = $file_location.$file_name;
                Storage::disk('public')->putFileAs($file_location, $file, $file_name);
            }
            $data['file_bukti'] = $gambar;
            Izin::insert($data);
            Alert::toast('Izin berhasil diajukan!', 'success');
            return redirect()->route('izin.index');
        }
    }

    

    public function delete($id)
    {
        $data = Izin::findOrFail($id);
        $data->delete();

        Alert::toast('Jabatan berhasil dihapus!', 'success');
        return redirect()->route('master-jabatan.index');
    }
}
