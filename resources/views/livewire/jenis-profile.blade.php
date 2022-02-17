<div id="unamediv">
<div class="card-body pt-0 pt-md-2">
<label>Username</label>
<input wire:model="username" type="text" class="form-control"/>
@if ($errors->has('username'))
<p style="color: red;">{{$errors->first('username')}}</p>
@endif
</div>
<button wire:click="save" class="btn btn-primary">Save</button>
</div>
<script type="text/javascript">

window.addEventListener('save_berhasil', event => {
  toastr.success('Data Disimpan');
})

</script>
@livewireScripts
