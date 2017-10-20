<!-- Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}
</div>

<div class="form-group col-sm-12">
    {!! Form::label('address', 'Address:') !!}
    {!! Form::text('address', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-12">
    {!! Form::label('vat_code', 'VAT Code:') !!}
    {!! Form::text('vat_code', null, ['class' => 'form-control', 'required']) !!}
</div>
<div class="form-group col-sm-12">
    {!! Form::label('reg_com', 'Reg Com:') !!}
    {!! Form::text('reg_com', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-12">
    {!! Form::label('vat_code', 'VAT Code:') !!}
    {!! Form::text('vat_code', null, ['class' => 'form-control', 'required']) !!}
</div>

<div class="form-group col-sm-12">
    {!! Form::label('discount', 'Discount(%):') !!}
    {!! Form::text('discount', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-12">
    {!! Form::label('phone', 'Phone:') !!}
    {!! Form::text('phone', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12 text-center">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.companies.index') !!}" class="btn btn-default">Cancel</a>
</div>
