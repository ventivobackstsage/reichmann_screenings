<!-- Institution Field -->
<div class="form-group col-sm-12">
    {!! Form::label('institution', 'Institution:') !!}
    {!! Form::text('institution', null, ['class' => 'form-control']) !!}
</div>

<!-- City Field -->
<div class="form-group col-sm-12">
    {!! Form::label('city', 'City:') !!}
    {!! Form::text('city', null, ['class' => 'form-control']) !!}
</div>

<!-- Period Field -->
<div class="form-group col-sm-12">
    {!! Form::label('Period', 'Period:') !!}
    {!! Form::text('Period', null, ['class' => 'form-control']) !!}
</div>

<!-- Level Field -->
<div class="form-group col-sm-12">
        {!! Form::select('Level', array('primary school'=>'primary school','secondary school'=>'secondary school','high school'=>'high school','college'=>'college','master'=>'master'), null, ['placeholder' => 'Please select level', 'class' => 'form-control', 'required']); !!}
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12 text-center">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.education.index') !!}" class="btn btn-default">Cancel</a>
</div>
