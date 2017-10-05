<table class="table table-responsive" id="certificates-table">
    <thead>
     <tr>
         <th>School</th>
         <th>Level</th>
         <th>Attachement</th>
         <th>Uploaded</th>
        <th colspan="3">Action</th>
     </tr>
    </thead>
    <tbody>
    @foreach($certificates as $certificate)
        <tr>
            <td>{!! $certificate->education->institution !!}</td>
            <td>{!! $certificate->education->Level !!}</td>
            <td><a href='{{ asset("$certificate->path") }}' target="_blank">
                    See the attachment
                    <i class="livicon" data-name="eye-open" data-size="16" data-loop="true" data-c="#00bc8c" data-hc="#00bc8c" title="view"></i>
                </a></td>
            <td>{!! $certificate->created_at !!}</td>
            <td>
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