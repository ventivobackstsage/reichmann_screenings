<table class="table table-responsive" id="orders-table">
    <thead>
     <tr>
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
    @foreach($orders as $order)
        <tr>
	        <td>{!! $order->id !!}</td>
	        <td>{!! $order->company->name !!}</td>
	        <td>{!! $order->candidate->user->first_name.' '.$order->candidate->user->last_name  !!}</td>
	        <td>{!! $order->candidate->user->email  !!}</td>
            <td>{!! $order->created_at !!}</td>
	        <td>{!! $order->status !!}</td>
	        <td>{!! Carbon::now()->subSeconds(Carbon::now()->diffInSeconds(new Carbon($order->updated_at)))->diffForHumans() !!}</td>
            <td>
                 <a href="{{ route('admin.orders.show', $order->id) }}">
                     <i class="livicon" data-name="info" data-size="22" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="view order"></i>
                 </a>
	            <a href="{{ route('admin.orders.edit', $order->id) }}">
		            <i class="livicon" data-name="eye-open" data-size="22" data-loop="true" data-c="#00bc8c" data-hc="#00bc8c" title="download order"></i>
	            </a>
	            <a href="{{ route('admin.orders.edit', $order->id) }}">
		            <i class="livicon" data-name="printer" data-size="22" data-loop="true" data-c="#F89A14" data-hc="#F89A14" title="print order"></i>
	            </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@section('footer_scripts')
    <div class="modal fade" id="delete_confirm" tabindex="-1" role="dialog" aria-labelledby="user_delete_confirm_title" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            </div>
        </div>
    </div>
    <script>$(function () {$('body').on('hidden.bs.modal', '.modal', function () {$(this).removeData('bs.modal');});});</script>
@stop