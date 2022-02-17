<div id="addressdiv">
  <div class="card-body pt-0 pt-md-2">
<label>Address</label>
<input wire:model="address" type="text" class="form-control"/>
@if ($errors->has('address'))
<p style="color: red;">{{$errors->first('address')}}</p>
@endif
</div>
<button wire:click="save" class="btn btn-primary">Save</button>
</div>
