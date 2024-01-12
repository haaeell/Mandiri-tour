<?php

namespace App\Http\Controllers;

use App\Models\Keluhan;
use App\Models\PaketWisata;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        $paketwisata = PaketWisata::all();
        
        return view('landingpage.welcome', compact('paketwisata'));

    }
    public function keluhan()
    {
        $riwayatKeluhan = Keluhan::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->get();
        
        return view('landingpage.keluhan', compact('riwayatKeluhan'));

    }
}
