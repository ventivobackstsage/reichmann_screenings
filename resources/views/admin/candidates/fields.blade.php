<!-- Cnp Field -->
<div class="form-group col-sm-12">
	{!! Form::label('first_name', 'First Name:', ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
	{!! Form::text('first_name', null, ['class' => 'form-control']) !!}
	</div>
</div>
<!-- Cnp Field -->
<div class="form-group col-sm-12">
	{!! Form::label('last_name', 'Last Name:', ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::text('last_name', null, ['class' => 'form-control']) !!}
	</div>
</div>
<!-- Cnp Field -->
<div class="form-group col-sm-12">
	{!! Form::label('email', 'Email:', ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
	{!! Form::text('email', null, ['class' => 'form-control']) !!}
	</div>
</div>
<!-- Cnp Field -->
<div class="form-group col-sm-12">
	{!! Form::label('password', 'Password:', ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
	{!! Form::password('password', ['class' => 'form-control']) !!}
	</div>
</div>

<!-- Cnp Field -->
<div class="form-group col-sm-12">
	{!! Form::label('password_confirm', 'Password confirm:', ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
	{!! Form::password('password_confirm', ['class' => 'form-control']) !!}
	</div>
</div>

<!-- Cnp Field -->
<div class="form-group col-sm-12">
    {!! Form::label('cnp', 'Cnp:', ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
    {!! Form::text('cnp', null, ['class' => 'form-control']) !!}
	</div>
</div>

<!-- Address Field -->
<div class="form-group col-sm-12">
    {!! Form::label('address', 'Address:', ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
    {!! Form::text('address', null, ['class' => 'form-control']) !!}
	</div>
</div>

<!-- City Field -->
<div class="form-group col-sm-12">
    {!! Form::label('city', 'City:', ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
    {!! Form::text('city', null, ['class' => 'form-control']) !!}
	</div>
</div>

<!-- Country Field -->
<div class="form-group col-sm-12">
    {!! Form::label('country', 'Country:', ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
    {!! Form::text('country', null, ['class' => 'form-control']) !!}
	</div>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12 text-center">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.candidates.index') !!}" class="btn btn-default">Cancel</a>
</div>
