@extends('admin/layouts/default')

@section('title')
Orders
@parent
@stop
{{-- page level styles --}}
@section('header_styles')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatables/css/dataTables.bootstrap.css') }}" />
<link href="{{ asset('assets/css/pages/tables.css') }}" rel="stylesheet" type="text/css" />
@stop
{{-- Page content --}}
@section('content')
<section class="content-header">
    <h1>Orders</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin.dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>Orders</li>
        <li class="active">Orders List</li>
    </ol>
</section>

<section class="content paddingleft_right15">
    <div class="row">
     @include('flash::message')
        <div class="panel panel-primary ">
            <div class="panel-heading clearfix">
                <h4 class="panel-title pull-left"> <i class="livicon" data-name="list-ul" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    Orders List
                </h4>
                <div class="pull-right hide">
                    <a href="{{ route('admin.orders.create') }}" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-plus"></span> @lang('button.create')</a>
                </div>
            </div>
            <br />
            <div class="panel-body table-responsive">
                {{-- @include('admin.orders.table') --}}

            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered " id="table">
                        <thead>
                        <tr class="filters">
                            <th>ID</th>
                            <th>Company</th>
                            <th>Candidate</th>
                            <th>Email</th>
                            <th>Received</th>
                            <th>Status</th>
                            <th>Updated</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
 </div>
</section>
@stop
{{-- page level scripts --}}
@section('footer_scripts')
<script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/jquery.dataTables.js') }}" ></script>
<script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/dataTables.bootstrap.js') }}" ></script>
<script>
	$(function() {
		var table = $('#table').DataTable({
			processing: true,
			serverSide: true,
			ajax: '{!! route('admin.orders.data') !!}',
			columns:
		[
			{ data: 'id', name: 'id' },
			{ data: 'company', name: 'company' },
			{ data: 'candidate', name: 'candidate' },
			{ data: 'email', name: 'email' },
			{ data: 'created_at', name: 'created_at'},
			{ data: 'status', name: 'status'},
			{ data: 'updated_at', name:'updated_at'},
			{ data: 'actions', name: 'actions', orderable: false, searchable: false }
		]
	})
		table.on( 'draw', function () {
			$('.livicon').each(function(){
				$(this).updateLivicon();
			});
		} );
	});

</script>
@stop
