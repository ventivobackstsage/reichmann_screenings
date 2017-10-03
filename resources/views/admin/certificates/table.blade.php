<table class="table table-responsive" id="certificates-table">
    <thead>
     <tr>
        <th>Path</th>
        <th colspan="3">Action</th>
     </tr>
    </thead>
    <tbody>
    @foreach($certificates as $certificate)
        <tr>
            <td>{!! $certificate->path !!}</td>
            <td>
                 <a href="{{ route('admin.certificates.show', $certificate->id) }}">
                     <i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="view certificate"></i>
                 </a>
                 <a href="{{ route('admin.certificates.edit', $certificate->id) }}">
                     <i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="edit certificate"></i>
                 </a>
                 <a href="{{ route('admin.certificates.confirm-delete', $certificate->id) }}" data-toggle="modal" data-target="#delete_confirm">
                     <i class="livicon" data-name="remove-alt" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete certificate"></i>
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