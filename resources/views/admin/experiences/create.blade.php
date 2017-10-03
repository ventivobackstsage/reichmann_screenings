@extends('admin./layouts/default')

@section('title')
Experiences
@parent
@stop

@section('content')
@include('core-templates::common.errors')
<section class="content-header">
    <h1>Experiences</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin.dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>Experiences</li>
        <li class="active">Create Experiences </li>
    </ol>
</section>
<section class="content paddingleft_right15">
<div class="row">
 <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title"> <i class="livicon" data-name="user" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                Create New  Experience
            </h4></div>
        <br />
        <div class="panel-body">
        {!! Form::open(['route' => 'admin.experiences.store']) !!}

            @include('admin.experiences.fields')

        {!! Form::close() !!}
    </div>
  </div>
 </div>
</section>
 @stop
