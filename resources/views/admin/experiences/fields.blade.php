<!-- Candidate Id Field -->
<div class="form-group col-sm-12">
    {!! Form::label('candidate_id', 'Candidate Id:') !!}
    {!! Form::text('candidate_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Company Field -->
<div class="form-group col-sm-12">
    {!! Form::label('Company', 'Company:') !!}
    {!! Form::text('Company', null, ['class' => 'form-control']) !!}
</div>

<!-- Period Field -->
<div class="form-group col-sm-12">
    {!! Form::label('Period', 'Period:') !!}
    {!! Form::text('Period', null, ['class' => 'form-control']) !!}
</div>

<!-- Position Field -->
<div class="form-group col-sm-12">
    {!! Form::label('Position', 'Position:') !!}
    {!! Form::text('Position', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12 text-center">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.experiences.index') !!}" class="btn btn-default">Cancel</a>
</div>
