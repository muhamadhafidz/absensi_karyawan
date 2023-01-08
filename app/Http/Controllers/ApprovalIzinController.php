<?php

namespace App\Http\Controllers;

use App\Izin;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ApprovalIzinController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = Izin::with('personalia')->get();

        return view('admin.pages.approval-izin.index', compact('data'));
    }

    public function approve($id)
    {

        $izin = Izin::findOrFail($id);
        $izin->status = 'disetujui';
        $izin->save();

        Alert::toast('status berhasil diubah!', 'success');
        return redirect()->route('approval-izin.index');
    }

    

    public function tolak($id)
    {
        $izin = Izin::findOrFail($id);
        $izin->status = 'ditolak';
        $izin->save();

        Alert::toast('status berhasil diubah!', 'success');
        return redirect()->route('approval-izin.index');
    }
}
