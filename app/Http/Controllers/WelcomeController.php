<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisLayanan;
use App\Models\Komentar;

class WelcomeController extends Controller
{
  public function index()
  {
    $jenisLayanan = JenisLayanan::all();
    $komentar = Komentar::all()->take(-3);

    return view('user.preview', compact('jenisLayanan', 'komentar'));
  }

}
