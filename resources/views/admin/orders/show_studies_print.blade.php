<div>
<p><strong>Institution Name:</strong> {{ $education->institution }}<br />
    <strong>Location:</strong> {{ $education->city }}<br />
    <strong>Period:</strong> {{ $education->Period }}<br />
    <strong>Type:</strong> {{ $education->Level }}
</p>

@foreach ($education->attachements as $attachement)
<img width="100%" src="{{ asset("$attachement->path") }}"></img>
<br /><br />
@endforeach
    <hr>
    </div>