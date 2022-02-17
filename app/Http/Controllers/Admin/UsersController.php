<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Auth;

class UsersController extends Controller
{
  public function index()
  {
    $listUser = User::whereIn('roles', ['admin', 'user'])->whereNotIn('id', [Auth::user()->id])->orderByDesc('id')->get();
    return view('admin.user.index', compact('listUser'));
  }

  public function delete($id)
  {
    $user = User::find($id);
    $user->delete();
    toastr()->success('Data Berhasil Dihapus');
    return redirect()->route('index-user');
  }
}
