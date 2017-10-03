<!-- Path Field -->
<div class="form-group col-sm-12">
    {!! Form::label('path', 'Path:') !!}
    {!! Form::text('path', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12 text-center">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.certificates.index') !!}" class="btn btn-default">Cancel</a>
</div>

<!-- Education Id Field -->
<div class="form-group col-sm-12">
    {!! Form::label('education_id', 'Education Id:') !!}
    {!! Form::text('education_id', null, ['class' => 'form-control']) !!}
</div>