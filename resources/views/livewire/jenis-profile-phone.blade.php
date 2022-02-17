<div id="emaildiv">
  <div class="card-body pt-0 pt-md-2">
<label>Phone Number</label>
<input wire:model="phoneNumber" type="text" class="form-control"/>
@if ($errors->has('phoneNumber'))
<p style="color: red;">{{$errors->first('phoneNumber')}}</p>
@endif
</div>
<button wire:click="save" class="btn btn-primary">Save</button>
</div>
