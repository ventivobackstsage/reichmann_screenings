                <div>
                    <p><strong>Company:</strong>{{ $experience->Company }}<br />
                        <strong>Position:</strong>{{ $experience->Position }}<br />
                        <strong>Period:</strong>{{ $experience->Period }}<br />
                        <strong>Job description:</strong>{{ $experience->info }}</p>
                    <br /><br />
                    @foreach ($experience->attachements as $attachement)
                    <img width="100%" src="{{ asset("$attachement->path") }}"></img>
                    <br /><br />
                    @endforeach
                    <hr>
                </div>
