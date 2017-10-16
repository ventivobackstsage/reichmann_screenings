@extends('admin./layouts/default')

@section('title')
Orders
@parent
@stop
{{-- page level styles --}}
@section('header_styles')

<link href="{{ asset('assets/css/pages/timeline.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/css/pages/timeline2.css') }}" rel="stylesheet" />
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
@stop

@section('content')
<section class="content-header">
    <h1>Orders View</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin.dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>Orders</li>
        <li class="active">Orders View</li>
    </ol>
</section>

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

                @each('admin.orders.show_studies', $order->candidate->education, 'education','admin.orders.show_studies_empty')

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

    @if (Sentinel::check() && (Sentinel::inRole('admin')||Sentinel::inRole('company')))
    <div class="row hidden-print">

        <div class="col-lg-4">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="livicon" data-name="doc-portrait" data-c="#fff" data-hc="#fff" data-size="18" data-loop="true"></i> Change Status ({{ $order->status}})
                    </h3>
                                                <span class="pull-right">
                                                    <i class="fa fa-fw fa-chevron-up clickable"></i>
                                                    <i class="fa fa-fw fa-times removepanel clickable"></i>
                                                </span>
                </div>
                <div class="panel-body">

                    {!! Form::model($order, ['route' => ['admin.orders.update', $order->id], 'method' => 'patch']) !!}
                    <!-- Status Id Field -->
                    <div class="form-group col-sm-12">
                        @if (Sentinel::inRole('admin'))
                            {!! Form::select('status', ['pending'=>'pending','viewed'=>'viewed','analyzed'=>'analyzed','escalated'=>'escalated', 'done'=>'done'], null,['placeholder' => 'Change order status','class' => 'form-control select2']) !!}
                        @elseif (Sentinel::inRole('company'))
                            {!! Form::select('status', ['escalated'=>'escalated', 'done'=>'done'], null,['placeholder' => 'Change order status','class' => 'form-control select2']) !!}
                        @endif
                    </div>
                    <!-- Info Field -->
                    <div class="form-group col-sm-12">
                        {!! Form::textarea('info', null, ['placeholder' => 'Add some notes', 'class' => 'form-control']) !!}
                    </div>
                    <!-- Submit Field -->
                    <div class="form-group col-sm-12 text-center">
                        {!! Form::submit('Update', ['class' => 'btn btn-primary col-sm-12']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="livicon" data-name="doc-portrait" data-c="#fff" data-hc="#fff" data-size="18" data-loop="true"></i> Updates History
                    </h3>
                                                <span class="pull-right">
                                                    <i class="fa fa-fw fa-chevron-up clickable"></i>
                                                    <i class="fa fa-fw fa-times removepanel clickable"></i>
                                                </span>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <ul class="timeline">
                            @foreach ($order->updates as $updates)
                            @if($loop->iteration  % 2 == 0)
                            <li class="timeline-inverted">
                            @else
                            <li>
                            @endif
                                <div class="timeline-badge">
                                    <i class="livicon" data-name="users" data-c="#fff" data-hc="#fff" data-size="18" data-loop="true"></i>
                                </div>
                                <div class="timeline-panel" style="display:inline-block;">
                                    <div class="timeline-heading">
                                        <h4 class="timeline-title">Status Changed: <strong>{{ $updates->status }}</strong></h4>
                                        <h5 class="timeline-title">{{ $updates->user->first_name.' '.$updates->user->last_name}}</h5>
                                        <p>
                                            <small class="text-muted">
                                                {{ $updates->created_at}}
                                            </small>
                                        </p>
                                    </div>
                                    <div class="timeline-body">
                                        <p>
                                            {{ $updates->Description}}
                                        </p>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</section>
@stop
