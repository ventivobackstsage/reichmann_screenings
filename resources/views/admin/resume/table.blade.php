<table class="table table-responsive" id="updates-table">
    <thead>
     <tr>
        <th>Order Id</th>
        <th>Status</th>
        <th>Description</th>
        <th>User Id</th>
        <th colspan="3">Action</th>
     </tr>
    </thead>
    <tbody>
    @foreach($updates as $update)
        <tr>
            <td>{!! $update->order_id !!}</td>
            <td>{!! $update->status !!}</td>
            <td>{!! $update->Description !!}</td>
            <td>{!! $update->user_id !!}</td>
            <td>
                 <a href="{{ route('admin.updates.show', $update->id) }}">
                     <i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="view update"></i>
                 </a>
                 <a href="{{ route('admin.updates.edit', $update->id) }}">
                     <i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="edit update"></i>
                 </a>
                 <a href="{{ route('admin.updates.confirm-delete', $update->id) }}" data-toggle="modal" data-target="#delete_confirm">
                     <i class="livicon" data-name="remove-alt" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete update"></i>
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