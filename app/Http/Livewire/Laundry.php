<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Layanan;
use App\Models\JenisLayanan;
use App\Models\Komentar;
use App\Models\Rating;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class Laundry extends Component
{
  use WithPagination;
  protected $paginationTheme = 'bootstrap';
  public $comment;
  public $service_id;
  public $total_rate;

  protected $listeners = [
      'refreshParent' => '$refresh','fileChoosen'
  ];

  public function render()
  {
    $laundry = DB::table('services')
    ->select('services.*', 'jenisservices.jenis', 'service_photos.*', 'services.id as layanan_id')
    ->leftJoin('jenisservices', 'services.jenisservice_id', '=', 'jenisservices.id')
    ->leftJoin('service_photos', 'service_photos.service_id', '=', 'services.id')
    ->where('services.jenisservice_id', '=', 1)
    ->get();

    $avgRate = Rating::where('jenisservice_id',1)->avg('rate');
    $laundry2 = Layanan::where('jenisservice_id', 1)->first();
    $Rates = Rating::where('jenisservice_id',1)->count('id');

    $jenis_service = JenisLayanan::where('id', '1')->first();

    $jenis_service->rate = $avgRate;
    $jenis_service->save();

    $laundryPaginate = $laundry2->Komentar()->where('comment_id', null)->orderBy('created_at', 'desc')->paginate(3);
    $this->service_id = $laundry2->id;

    return view('livewire.laundry', compact('laundry', 'laundryPaginate','laundry2','jenis_service','Rates'))->extends('layouts.app');
  }

  public function selectItem($itemId, $action)
  {
      $this->selectedItem = $itemId;
      $this->selectedAction = $action;

      if ($action == 'Laundry') {
        $this->emit('getModelId', $this->selectedItem);
        $this->emit('getActionId', $this->selectedAction);
        $this->dispatchBrowserEvent('openModal');;

      }
  }

  public function saveComment()
  {
    $this->validate([
      'comment' => 'required',
    ]);

    Komentar::create([
      'user_id' => Auth::user()->id,
      'service_id' => $this->service_id,
      'comment_id' => null,
      'komentar' => $this->comment,
    ]);

    $this->reset('comment');
  }
}
