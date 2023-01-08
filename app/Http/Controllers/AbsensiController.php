<?php

namespace App\Http\Controllers;

use App\Absensi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AbsensiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = Auth::user()->personalia()->first()->absensi()->whereDate('tanggal_absensi', Carbon::now())->first();
        return view('admin.pages.absensi.index', compact('data'));
    }

    public function clockIn()
    {
        $data = Auth::user()->personalia()->first()->absensi()->whereDate('tanggal_absensi', Carbon::now())->first();
        if ($data->clock_in) {
            Alert::error('Kamu sudah absen clock in hari ini', '');
            return redirect()->route('absensi.index');
        }

        Absensi::create([
            'master_personalia_id' => Auth::user()->master_personalia_id,
            'tanggal_absensi' => Carbon::now(),
            'clock_in' => Carbon::now()->format('H:i:s'),
            'status' => 'masuk'
        ]);

        Alert::toast('Data clock in telah dicatat', 'success');
        return redirect()->route('absensi.index');
    }

    public function clockOut()
    {
        $data = Auth::user()->personalia()->first()->absensi()->whereDate('tanggal_absensi', Carbon::now())->first();
        if ($data->clock_out) {
            Alert::error('Kamu sudah absen clock out hari ini', '');
            return redirect()->route('absensi.index');
        }

        $data->clock_out = Carbon::now()->format('H:i:s');
        $data->save();

        Alert::toast('Data clock out telah dicatat', 'success');
        return redirect()->route('absensi.index');
    }
}
