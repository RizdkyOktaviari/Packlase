<?php

namespace App\Http\Livewire;
use App\Models\User;
use Livewire\Component;

class JenisProfileAddress extends Component
{
    public $address;

    public $modelId;
    public $actionId;

    protected $rules = [
      'address' => ['required', 'string', 'max:35'],
   ];

    protected $listeners = [
        'getModelId','getActionId',
    ];

    public function mount()
    {
      // code...
      $this->actionId = "";
    }

    public function getModelId($modelId)
    {
        $this->modelId = $modelId;

        $model = User::find($this->modelId);

        $this->address = $model->address;
    }

    public function getActionId($actionId)
    {
        $this->actionId = $actionId;

    }


    public function save()
    {

        $this->validate();

        // Default data
        $data = [
            'address' => $this->address,
        ];


        User::find($this->modelId)->update($data);


        $this->emit('refreshParent');
        $this->dispatchBrowserEvent('closeModal_address');
        $this->dispatchBrowserEvent('save_berhasil');

    }




    public function render()
    {
        return view('livewire.jenis-profile-address');
    }
}
