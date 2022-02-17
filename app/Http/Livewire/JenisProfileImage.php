<?php

namespace App\Http\Livewire;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;

class JenisProfileImage extends Component
{
    use WithFileUploads;

    public $avatar;

    public function save($id)
    {

      $dataimage = User::find($id);

      $data = $this->validate([
             'avatar' => 'nullable|image|max:1024', // 2MB Max
         ]);
      $image_path = "";

        if (is_file('storage/'.$dataimage->profile_photo_path)) {
          unlink('storage/'.$dataimage->profile_photo_path);
        }
        $varimage = $this->avatar;
        $image_name = time().$varimage->getClientOriginalName();
        $this->avatar->storeAs('public/images/', $image_name);

        $img = Image::make($varimage->getRealPath())->encode('jpg', 65)->fit(760, null, function ($c) {
                    $c->aspectRatio();
                    $c->upsize();
                });
        $img->stream();

        Storage::disk('public')->put('public/images' . '/' . $image_name, $img, 'public');

      $dataimage->profile_photo_path = 'public/images/'.$image_name;
      $dataimage->save();

      $this->emit('refreshParent');
      $this->dispatchBrowserEvent('closeModal_image');
      $this->cleanVars();
      $this->dispatchBrowserEvent('save_berhasil');


    }

    public function cleanvars()
    {
      $this->avatar = null;
    }


    public function render()
    {
        return view('livewire.jenis-profile-image');
    }
}
