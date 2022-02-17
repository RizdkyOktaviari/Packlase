<?php

namespace App\Http\Livewire;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Helpers\ResponseFormatter;
use Illuminate\Support\Facades\Hash;

class SettingUser extends Component
{
    public $old_password;
    public $password_confirmation;
    public $password;

    protected $rules = [
      'old_password' => 'required',
      'password' => ['required', 'min:8','confirmed'],
      'password_confirmation' => 'required',

   ];

    public function update($id)
    {
      $this->validate();

      $Users = User::find($id);

      if (Hash::check($this->old_password, $Users->password)) {


        User::where('id',$id)->update([
          'password' => Hash::make($this->password),
        ]);


        $this->emit('refreshParent');
        $this->dispatchBrowserEvent('closeModal_setting');
        $this->dispatchBrowserEvent('berhasil');

      }else {
        $this->dispatchBrowserEvent('gagal');
      }

    }




    public function render()
    {
        return view('livewire.setting-user');
    }
}
