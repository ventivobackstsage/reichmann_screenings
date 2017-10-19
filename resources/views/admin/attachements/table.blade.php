<table class="table table-responsive" id="attachements-table">
    <thead>
     <tr>
        <th>Name</th>
         <th>User</th>
         <th>Category</th>
         <th>Date Created</th>
         <th colspan="3">Action</th>
     </tr>
    </thead>
    <tbody>
    @foreach($attachements as $attachement)
        <tr>
            <td>{!! $attachement->name !!}</td>
            <td>{!! $attachement->user->fullName !!}</td>
            <td>{!! class_basename($attachement->imageable) !!}</td>
            <td>{!! $attachement->created_at !!}</td>
            <td>
                <a href="{{ route('admin.attachements.confirm-delete', $other->id) }}" data-toggle="modal" data-target="#delete_confirm">
                    <i class="livicon" data-name="remove-alt" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete other"></i>
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