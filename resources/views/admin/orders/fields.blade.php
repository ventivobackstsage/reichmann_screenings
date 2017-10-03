<!-- Company Id Field -->
<div class="form-group col-sm-12">
    {!! Form::label('company_id', 'Company Id:') !!}
    {!! Form::text('company_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Candidate Id Field -->
<div class="form-group col-sm-12">
    {!! Form::label('candidate_id', 'Candidate Id:') !!}
    {!! Form::text('candidate_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Position Field -->
<div class="form-group col-sm-12">
    {!! Form::label('position', 'Position:') !!}
    {!! Form::text('position', null, ['class' => 'form-control']) !!}
</div>

<!-- Reason Field -->
<div class="form-group col-sm-12">
    {!! Form::label('reason', 'Reason:') !!}
    {!! Form::text('reason', null, ['class' => 'form-control']) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-12">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::text('status', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12 text-center">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.orders.index') !!}" class="btn btn-default">Cancel</a>
</div>
