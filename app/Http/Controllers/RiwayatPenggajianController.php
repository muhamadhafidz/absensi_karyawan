<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatPenggajianController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = Auth::user()->personalia()->first()->penggajian()->get();
        
        return view('admin.pages.riwayat-penggajian.index', compact('data'));
    }
}
