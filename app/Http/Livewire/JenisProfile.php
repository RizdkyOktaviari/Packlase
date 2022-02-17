<?php

namespace App\Http\Livewire;
use App\Models\User;
use Livewire\Component;

class JenisProfile extends Component
{
    public $username;

    public $modelId;
    public $actionId;

    protected $rules = [
      'username' => ['required', 'string', 'max:35'],

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

        $this->username = $model->name;
        $this->email = $model->email;
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
            'name' => $this->username,
        ];


        User::find($this->modelId)->update($data);


        $this->emit('refreshParent');
        $this->dispatchBrowserEvent('closeModal');
        $this->dispatchBrowserEvent('save_berhasil');

    }




    public function render()
    {
        return view('livewire.jenis-profile');
    }
}
