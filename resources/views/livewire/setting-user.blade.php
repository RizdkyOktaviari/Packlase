<div>
  <div class="card-body pt-0 pt-md-4">
    <label>Old Password</label>
    <input type="password" name="old_password" wire:model="old_password" class="form-control">
    @error('old_password')           <span class="eror" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
 @enderror
 <p></p>
    <label>New Password</label>
    <input type="password" name="password" wire:model="password" class="form-control">
    @error('password')           <span class="eror" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
</span> @enderror
<p></p>
    <label>Confirm Password</label>
    <input type="password" name="password_confirmation" wire:model="password_confirmation" class="form-control">

    @error('password_confirmation')           <span class="eror" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
 @enderror
  </div>

    <button wire:click="update({{ Auth::user()->id }})" class="btn btn-primary">Update</button>
</div>

<script type="text/javascript">


window.addEventListener('berhasil', event => {
  toastr.success('Password Has Changed');
})

window.addEventListener('gagal', event => {
  toastr.error('Invalid Credentials');
})

</script>
@livewireScripts
