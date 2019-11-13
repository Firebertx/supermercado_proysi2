<?php

namespace App\Http\Controllers;

use App\Bitacora;
use DB;

class BitacoraController extends Controller
{
    public function index()
    {
        $bitacora=Bitacora::all();
        return view('admin.bitacora.index',compact('bitacora'));
    }
}
