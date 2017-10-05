<h2>Order ID: {!! $order->id !!}</h2>

<table class="table table-striped table-advance table-hover">
    <thead>
    <tr>
        <td>
            <div class="col-md-12">
                <h4>
                    <strong>Order ID: {!! $order->id !!}</strong>
                </h4>
            </div>
        </td>
    </tr>
    </thead>
    <tbody>
        <td>
            <div class="col-md-12">
                <p>Firstname: Ovidiu</p>
                <p>Lastname: Mihalache</p>
                <p>Email: info@fetno.ro</p>
                <p>Phone: 0722654375</p>
                <p>CNP: 19845567788</p>
                <p>Address: Bd. Libertatii, nr. 6</p>
                <p>City: Bucuresti</p>
                <p>Country: Romania</p>
                <hr>
                <p>Position: regular</p>
                <p>Reason of check: hire</p>
            </div>
        </td>
    </tbody>
</table>

<div class="news-page">
    <div class="news-blocks">
        <p>{!! $order->company_id !!}</p>
    </div>
</div>
<div class="form-group">
    {!! Form::label('company_id', 'Company Id:') !!}
    <p>{!! $order->company_id !!}</p>
    <hr>
</div>

<!-- Candidate Id Field -->
<div class="form-group">
    {!! Form::label('candidate_id', 'Candidate Id:') !!}
    <p>{!! $order->candidate_id !!}</p>
    <hr>
</div>

<!-- Position Field -->
<div class="form-group">
    {!! Form::label('position', 'Position:') !!}
    <p>{!! $order->position !!}</p>
    <hr>
</div>

<!-- Reason Field -->
<div class="form-group">
    {!! Form::label('reason', 'Reason:') !!}
    <p>{!! $order->reason !!}</p>
    <hr>
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', 'Status:') !!}
    <p>{!! $order->status !!}</p>
    <hr>
</div>

