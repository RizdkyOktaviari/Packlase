<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\JenisLayanan;
use Illuminate\Support\Str;

class JenisLayananController extends Controller
{

  public function index()
  {
    $JenisLayanan = JenisLayanan::all();
    return view('admin.JenisLayanan.index', compact('JenisLayanan'));
  }

  public function edit($id){
    $JenisLayanan = JenisLayanan::find($id);
    return view('admin.JenisLayanan.edit', compact('JenisLayanan'));
  }

  public function update(Request $Request, $id)
  {
    $JenisLayanan = JenisLayanan::find($id);
    $this->validate($Request,[
      'jenis' => 'required|max:25',
      'description' => 'required',
      'picturePath' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10240',
    ]);

    $JenisLayanan->jenis = $Request->jenis;
    $JenisLayanan->slug = Str::slug($Request->jenis);
    $JenisLayanan->description = $Request->description;

    if($Request->hasFile('picturePath')){
      $pictureFrom = str_replace(config('app.url')."/", "", $JenisLayanan->picturePath);
      if (file_exists($pictureFrom)) {
        unlink($pictureFrom);
      }
      $image = $Request->picturePath;
      $image_name = time().$image->getClientOriginalName();
      $image->move('img/services/', $image_name);
      $image_path = '/img/services/'. $image_name;
      $JenisLayanan->picturePath = $image_path;
    }

    $JenisLayanan->save();

    toastr()->success('Data Berhasil Diupdate');

    return redirect()->route('Home-JenisLayanan');
  }

}
