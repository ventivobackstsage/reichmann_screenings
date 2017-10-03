@extends('admin./layouts/default')

@section('title')
Candidates
@parent
@stop

{{-- Page content --}}
@section('content')
<section class="content-header">
    <h1>Candidates</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin.dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>Candidates</li>
        <li class="active">Candidates List</li>
    </ol>
</section>

<section class="content paddingleft_right15">
    <div class="row">
     @include('flash::message')
        <div class="panel panel-primary ">
            <div class="panel-heading clearfix">
                <h4 class="panel-title pull-left"> <i class="livicon" data-name="list-ul" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    Candidates List
                </h4>
                @if (Sentinel::check() && Sentinel::inRole('company'))
                <div class="pull-right">
                    <a href="{{ route('admin.candidates.create') }}" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-plus"></span> Invite</a>
                </div>
                @endif
            </div>
            <br />
            <div class="panel-body table-responsive">
                 @include('admin.candidates.table')
                 
            </div>
        </div>
 </div>
</section>
@stop
