<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Komentar;
use App\Models\User;
use App\Models\JenisLayanan;
use Illuminate\Support\Facades\Auth;

class KomentarController extends Controller
{

  public function index()
  {
    $Komentar = Komentar::orderBy('id', 'desc')->get();
    return view('admin.komentar.index')->with('Komentar', $Komentar);
  }

  public function reply(Request $request)
  {
    $this->validate($request,[
      'parent' => 'required',
      'replyComment' => 'required',
      'service_id' => 'required',
    ]);

    Komentar::create([
      'user_id' => Auth::user()->id,
      'service_id' => $request->service_id,
      'comment_id' => $request->parent,
      'komentar' => $request->replyComment,
    ]);
    toastr()->success('Komentar berhasil dibalas');
    return redirect()->route('index-komentar');
  }

  public function delete($id)
  {
    $Komentar = Komentar::find($id);
    $Komentar->delete();

    toastr()->success('Data Berhasil Dihapus');

    return redirect()->route('index-komentar');
  }
}
