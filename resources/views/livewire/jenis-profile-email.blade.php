<div id="emaildiv">
  <div class="card-body pt-0 pt-md-2">
<label>Email</label>
<input wire:model="email" type="text" class="form-control"/>
@if ($errors->has('email'))
<p style="color: red;">{{$errors->first('email')}}</p>
@endif
</div>
<button wire:click="save" class="btn btn-primary">Save</button>
</div>
