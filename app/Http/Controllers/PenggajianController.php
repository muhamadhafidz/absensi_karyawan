<?php

namespace App\Http\Controllers;

use App\Absensi;
use App\Penggajian;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PenggajianController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $res = Penggajian::get()->groupBy('tanggal_penggajian')->toArray();
        $data = [];
        foreach ($res as $key => $value) {
            $data[] = [
                'id' => $value[0]['id'],
                'tanggal' => $key,
                'total_karyawan' => count($value),
                'total_penggajian' => array_sum(array_column($value, 'total_gaji')),
            ];
        }
        return view('admin.pages.penggajian.index', compact('data'));
    }

    public function detail($tanggal)
    {
        $item = Penggajian::findOrFail($tanggal);
        $data = Penggajian::with('personalia')->where('tanggal_penggajian', $item->tanggal_penggajian)->get();
        
        return view('admin.pages.penggajian.detail', compact('data'));
    }

    public function gaji(Request $request)
    {
        $gaji = Penggajian::whereYear('tanggal_penggajian', date('Y'))->whereMonth('tanggal_penggajian', date('m'))->first();
        if ($gaji) {
            Alert::toast('Karyawan telah digaji pada bulan ini!', 'error');
            return redirect()->route('penggajian.index');
        }
        $absensi = Absensi::with('personalia')->whereYear('tanggal_absensi', date('Y'))->whereMonth('tanggal_absensi', date('m'))->get()->groupBy('master_personalia_id')->toArray();
        $penggajian = [];
        foreach ($absensi as $key => $value) {
            $penggajian[] = [
                'master_personalia_id' => $key,
                'gaji_perday' => $value[0]['personalia']['gaji_perday'],
                'total_day' => count($value),
                'total_gaji' => $value[0]['personalia']['gaji_perday'] * count($value),
                'tanggal_penggajian' => date('Y-m-d')
            ];
        }

        Penggajian::insert($penggajian);
        Alert::toast('Penggajian pada bulan ini berhasil dilakukan!', 'success');
        return redirect()->route('penggajian.index');
    }

    

    public function delete($id)
    {
        $data = Izin::findOrFail($id);
        $data->delete();

        Alert::toast('Jabatan berhasil dihapus!', 'success');
        return redirect()->route('master-jabatan.index');
    }
}
