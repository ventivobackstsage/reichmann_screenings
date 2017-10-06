<!DOCTYPE html>

<html>

<head>

    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
<style>

    ul.list-group:after {
        clear: both;
        display: block;
        content: "";
    }

    .list-group-item {
        float: left;
    }
</style>
</head>

<body>
<section class="content paddingleft_right15">
    <div class="row">
        <div class="panel panel-primary">
            <div class="panel-body">
                <h2>Order ID: {!! $order->id !!}</h2>
                <hr>
                <div class="col-md-12">
                    <p><strong>First name</strong>: {!! $order->candidate->user->first_name !!}</p>
                    <p><strong>Last name</strong>: {!! $order->candidate->user->last_name !!}</p>
                    <p><strong>Email</strong>: {!! $order->candidate->user->email !!}</p>
                    <p><strong>Phone</strong>: {!! $order->candidate->user->phone !!}</p>
                    <p><strong>CNP</strong>: {!! $order->candidate->cnp !!}</p>
                    <p><strong>Address</strong>: {!! $order->candidate->address !!}</p>
                    <p><strong>City</strong>: {!! $order->candidate->city !!}</p>
                    <p><strong>Country</strong>: {!! $order->candidate->country !!}</p>
                    <hr>
                    <p><strong>Position</strong>: {!! $order->position !!}</p>
                    <p><strong>Reason of check</strong>: {!! $order->reason !!}</p>
                </div>
            </div>
        </div>
        <div class="panel panel-primary">
            <div class="panel-body">
                <h2>STUDIES</h2>
                <hr>

                @each('admin.orders.show_studies_print', $order->candidate->education, 'education','admin.orders.show_studies_empty')

            </div>
        </div>
        <div class="panel panel-primary">
            <div class="panel-body">
                <h2>EXPERIENCE</h2>
                <hr>

                @each('admin.orders.show_experience', $order->candidate->experience, 'experience','admin.orders.show_experience_empty')
            </div>
        </div>
  </div>
</section>
</body>

</html>
