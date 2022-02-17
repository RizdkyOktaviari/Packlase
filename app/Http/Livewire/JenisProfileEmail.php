<?php

namespace App\Http\Livewire;
use App\Models\User;
use Livewire\Component;

class JenisProfileEmail extends Component
{
    public $email;

    public $modelId;
    public $actionId;

    protected $rules = [
      'email' => ['required', 'string', 'email', 'max:50'],

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
            'email' => $this->email,
        ];


        User::find($this->modelId)->update($data);


        $this->emit('refreshParent');
        $this->dispatchBrowserEvent('closeModal_email');
        $this->dispatchBrowserEvent('save_berhasil');

    }




    public function render()
    {
        return view('livewire.jenis-profile-email');
    }
}
