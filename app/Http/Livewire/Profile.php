<?php

namespace App\Http\Livewire;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
class Profile extends Component
{

  public $action;
  public $image;
  public $selectedItem;
  public $selectedAction;

  protected $listeners = [
      'refreshParent' => '$refresh','fileChoosen'
  ];
  use WithFileUploads;


  public function selectItem($itemId, $action)
  {
      $this->selectedItem = $itemId;
      $this->selectedAction = $action;

      if ($action == 'Username') {
        $this->emit('getModelId', $this->selectedItem);
        $this->emit('getActionId', $this->selectedAction);
        $this->dispatchBrowserEvent('openModal');;

      }

      elseif ($action == 'Email') {
        $this->emit('getModelId', $this->selectedItem);
        $this->emit('getActionId', $this->selectedAction);
        $this->dispatchBrowserEvent('openModal_email');;

      }

      elseif ($action == 'update_address') {
        $this->emit('getModelId', $this->selectedItem);
        $this->emit('getActionId', $this->selectedAction);
        $this->dispatchBrowserEvent('openModal_address');;

      }

      elseif ($action == 'update_phoneNumber') {
        $this->emit('getModelId', $this->selectedItem);
        $this->emit('getActionId', $this->selectedAction);
        $this->dispatchBrowserEvent('openModal_phoneNumber');;

      }

      elseif ($action == 'update_image') {
      $this->emit('getModelId', $this->selectedItem);
      $this->emit('getActionId', $this->selectedAction);
      $this->dispatchBrowserEvent('openModal_image');;

      }


  }
  public function setting($action)
  {

      if ($action == 'Setting') {
      $this->dispatchBrowserEvent('openModal_setting');;

      }

  }
    public function render()
    {
        return view('livewire.profile')->extends('user.profile');
    }
}
