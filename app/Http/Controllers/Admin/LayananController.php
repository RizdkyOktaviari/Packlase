<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Layanan;
use App\Models\ServicePhoto;
use App\Models\JenisLayanan;
use Illuminate\Support\Str;

class LayananController extends Controller
{

  public function index()
  {
    $Layanan = Layanan::all();
    return view('admin.Layanan.index', compact('Layanan'));
  }

  public function create(){
    $Layanan = Layanan::all();
    $JenisLayanan = JenisLayanan::all();
    return view('admin.Layanan.create',compact('Layanan','JenisLayanan'));
  }

  public function store(Request $Request){

    $this->validate($Request,[
      'name' => 'required|max:100',
      'jenisservice_id' => 'required',
      'description' => 'required',
      'price' => 'required',
      'picturePath.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
    ]);

    $layanan = Layanan::create([
      'name' => $Request->name,
      'jenisservice_id' => $Request->jenisservice_id,
      'description' => $Request->description,
      'price' => $Request->price,
    ]);

    if($Request->hasFile('picturePath')){
      foreach ($Request->file('picturePath') as $file) {
        $image_name = 'img/services/'.time().$file->getClientOriginalName();
        $file->move('img/services/', $image_name);
        $service_photo = ServicePhoto::create([
          'service_id' => $layanan->id,
          'picturePath' => $image_name,
        ]);
      }
    }

    toastr()->success('Data Berhasil Ditambahkan');

    return redirect()->route('Home-Layanan');
  }

  public function edit($id)
  {
    $Layanan = Layanan::find($id);
    $JenisLayanan = JenisLayanan::all();
    $service_photos = ServicePhoto::where('service_id', $id)->get();

    return view('admin.Layanan.edit', compact('Layanan','JenisLayanan', 'service_photos'));
  }

  public function update(Request $Request,$id)
  {
    $this->validate($Request,[
      'name' => 'required|max:255',
      'jenisservice_id' => 'required',
      'description' => 'required',
      'price' => 'required',
      'picturePath.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
    ]);

    $service = Layanan::where('id', $id)->update([
      'name' => $Request->name,
      'jenisservice_id' => $Request->jenisservice_id,
      'description' => $Request->description,
      'price' => $Request->price,
    ]);

    if($Request->hasFile('picturePath')){
      foreach ($Request->file('picturePath') as $file) {
        $image_name = 'img/services/'.time().$file->getClientOriginalName();
        $file->move('img/services/', $image_name);
        $service_photo = ServicePhoto::create([
          'service_id' => $id,
          'picturePath' => $image_name,
        ]);
      }
    }

    toastr()->success('Data Berhasil Diupdate');

    return redirect()->route('Home-Layanan');
  }

    public function trash($id)
    {
      $Layanan = Layanan::find($id);
      $Layanan->delete();
      toastr()->success('Data Berhasil Dihapus');
      return redirect()->route('Home-Layanan');
    }

    public function trashed()
    {
      $Layanan = Layanan::onlyTrashed()->get();
      return view('admin.Layanan.trashed', compact('Layanan'));
    }

    public function restore($id)
    {
      $Layanan = Layanan::withTrashed()->where('id',$id)->first();
      $Layanan->restore();
      toastr()->success('Data Berhasil Dipulihkan');
      return redirect()->route('Home-Layanan');
    }

    public function delete($id)
    {
      $Layanan = Layanan::withTrashed()->where('id',$id)->first();
      $service_photo = ServicePhoto::where('service_id', $id)->get();
        foreach ($service_photo as $key) {
          if (file_exists($key->picturePath)) {
            unlink($key->picturePath);
          }
      }
      $Layanan->forceDelete();
      toastr()->success('Data Berhasil Dihapus Permanen');
      return redirect()->route('Trashed-Layanan');
    }

    public function deleteImage(Request $request){
      $image = ServicePhoto::find($request->id);
      if (file_exists($request->name)) {
        unlink($request->name);
      }
      if($image->forceDelete())
        return response()->json(true);
      else
        return response()->json(false);
    }


}
