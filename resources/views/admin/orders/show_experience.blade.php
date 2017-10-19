
<div class="col-md-12">
    <p><strong>Company</strong>: {!! $experience->Company !!}</p>
    <p><strong>Position</strong>:  {!! $experience->Position !!}</p>
    <p><strong>Period</strong>:  {!! $experience->Period !!}</p>
    <p style="white-space: pre-wrap;"><strong>Job description</strong>:  {{ $experience->info }}</p>
    <ul class="list-group hidden-print">
        @php
        $index = 0
        @endphp
        @foreach ($experience->attachements as $attachement)
        <li class="list-group-item"><a href="{{ asset("$attachement->path") }}" target="_blank">Attachment {{++$index}}</a>  </li>
        @endforeach
    </ul>
    <hr>
</div>
