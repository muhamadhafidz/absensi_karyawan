<?php

namespace App\Http\Controllers;

use App\Izin;
use App\MasterPersonalia;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalKar = MasterPersonalia::count();
        $sakit = Izin::where('jenis_izin', 'sakit')->count();
        $izin = Izin::where('jenis_izin', 'izin')->count();
        $cuti = Izin::where('jenis_izin', 'cuti')->count();
        return view('admin.pages.dashboard.index', compact(['totalKar', 'izin', 'sakit', 'cuti']));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'old_password' => 'required',
            'password' => 'required',
        ];

        $messages = [
            'old_password.required' => 'password lama wajib diisi!',
            'password.required' => 'password baru wajib diisi!',
        ];
        
        $validator = \Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()){
            $error = $validator->getMessageBag()->first();

            Alert::toast($error, 'error');
            return redirect()->route('home');
        }else{
            
            $data = $validator->validated();
            $user = User::findOrFail($id);
            if (!Hash::check($data['old_password'], $user->password)) {
                Alert::error('password lama salah', '');
                return redirect()->route('home');
            }
            $user->password = Hash::make($data['password']);
            $user->save();

            Alert::toast('password berhasil diubah!', 'success');
            return redirect()->route('home');
        }
    }
}
