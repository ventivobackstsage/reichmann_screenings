<!-- Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Imageable Id Field -->
<div class="form-group col-sm-12">
    {!! Form::label('cat', 'Imageable Id:') !!}
    {!! Form::select('cat', array('Education'=>$education,'Experience'=>$experience,'Other'=>$other), null,['class' => 'form-control select2','required']) !!}
</div>

<div class="form-group col-sm-12">
    {!! Form::label('image', 'Image', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::file('image', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12 text-center">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.attachements.index') !!}" class="btn btn-default">Cancel</a>
</div>
