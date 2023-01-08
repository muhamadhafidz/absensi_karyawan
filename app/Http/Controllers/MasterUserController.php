<?php

namespace App\Http\Controllers;

use App\MasterPersonalia;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class MasterUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = User::with('personalia')->where('roles', '!=', 'admin')->get();
        $personalia = MasterPersonalia::whereDoesntHave('user')->get();
        return view('admin.pages.user.index', compact(['data', 'personalia']));
    }

    public function store(Request $request)
    {
        $rules = [
            'master_personalia_id' => 'required|unique:users,master_personalia_id',
            'password' => 'required',
        ];

        $messages = [
            'master_personalia_id.required' => 'personalia wajib diisi!',
            'master_personalia_id.unique' => 'personalia telah didaftarkan sebagai akun!!',
            'password.required' => 'password wajib diisi!',
        ];
        
        $validator = \Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()){
            $error = $validator->getMessageBag()->first();

            Alert::toast($error, 'error');
            return redirect()->route('master-user.index');
        }else{

            $data = $validator->validated();
            $personalia = MasterPersonalia::findOrFail($data['master_personalia_id']);
            User::create([
                'nip' => $personalia->nip,
                'name' => $personalia->nama,
                'roles' => 'user',
                'master_personalia_id' => $personalia->id,
                'password' => Hash::make($data['password'])
            ]);
            Alert::toast('user berhasil dibuat!', 'success');

            return redirect()->route('master-user.index');
        }
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
            return redirect()->route('master-user.index');
        }else{
            
            $data = $validator->validated();
            $user = User::findOrFail($id);
            if (!Hash::check($data['old_password'], $user->password)) {
                Alert::error('password lama salah', '');
                return redirect()->route('master-user.index');
            }
            $user->password = Hash::make($data['password']);
            $user->save();

            Alert::toast('password berhasil diubah!', 'success');
            return redirect()->route('master-user.index');
        }
    }

    public function delete($id)
    {
        $data = User::findOrFail($id);
        $data->delete();

        Alert::toast('user berhasil dihapus!', 'success');
        return redirect()->route('master-user.index');
    }
}
