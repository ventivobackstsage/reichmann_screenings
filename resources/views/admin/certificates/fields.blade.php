

<!-- Education Id Field -->
<div class="form-group col-sm-12">
    {!! Form::label('education_id', 'Education:', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::select('education_id', $education, null,['class' => 'form-control select2']) !!}
    </div>
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
    <a href="{!! route('admin.certificates.index') !!}" class="btn btn-default">Cancel</a>
</div>