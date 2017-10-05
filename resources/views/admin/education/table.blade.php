<table class="table table-responsive" id="education-table">
    <thead>
     <tr>
        <th>Institution</th>
        <th>City</th>
        <th>Period</th>
        <th>Level</th>
        <th colspan="3">Action</th>
     </tr>
    </thead>
    <tbody>
    @foreach($education as $education)
        <tr>
            <td>{!! $education->institution !!}</td>
            <td>{!! $education->city !!}</td>
            <td>{!! $education->Period !!}</td>
            <td>{!! $education->Level !!}</td>
            <td>
                 <a href="{{ route('admin.education.show', $education->id) }}">
                     <i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="view education"></i>
                 </a>
                 <a href="{{ route('admin.education.edit', $education->id) }}">
                     <i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="edit education"></i>
                 </a>
                 <a href="{{ route('admin.education.confirm-delete', $education->id) }}" data-toggle="modal" data-target="#delete_confirm">
                     <i class="livicon" data-name="remove-alt" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete education"></i>
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