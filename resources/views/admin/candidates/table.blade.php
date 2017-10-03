<table class="table table-responsive" id="candidates-table">
    <thead>
     <tr>
         <th>Name</th>
         <th>Email</th>
         <th>Phone</th>
         <th>Cnp</th>
        <th>Address</th>
        <th>City</th>
         <th>Country</th>
         <th>Joined</th>
         <th>Last Activity</th>
     </tr>
    </thead>
    <tbody>
    @foreach($candidates as $candidate)
        <tr>
            <td>{!! $candidate->user->first_name.' '.$candidate->user->last_name !!}</td>
            <td>{!! $candidate->user->email !!}</td>
            <td>{!! $candidate->user->phone !!}</td>
            <td>{!! $candidate->cnp !!}</td>
            <td>{!! $candidate->address !!}</td>
            <td>{!! $candidate->city !!}</td>
            <td>{!! $candidate->country !!}</td>
            <td>{!! Activation::completed($candidate->user)?Carbon::now()->subSeconds(Carbon::now()->diffInSeconds(new Carbon($candidate->user->created_at)))->diffForHumans():'not joined' !!}</td>
            <td>{!! Carbon::now()->subSeconds(Carbon::now()->diffInSeconds(new Carbon($candidate->user->last_login)))->diffForHumans() !!}</td>

            <!--<td>
                 <a href="{{ route('admin.candidates.show', $candidate->id) }}">
                     <i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="view candidate"></i>
                 </a>
                 <a href="{{ route('admin.candidates.edit', $candidate->id) }}">
                     <i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="edit candidate"></i>
                 </a>
                 <a href="{{ route('admin.candidates.confirm-delete', $candidate->id) }}" data-toggle="modal" data-target="#delete_confirm">
                     <i class="livicon" data-name="remove-alt" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete candidate"></i>
                 </a>
            </td>-->
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