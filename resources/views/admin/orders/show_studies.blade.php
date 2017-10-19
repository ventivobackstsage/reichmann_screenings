
                <div class="col-md-12">
                    <p><strong>Institution name</strong>: {!! $education->institution !!}</p>
                    <p><strong>Location</strong>: {!! $education->city !!}</p>
                    <p><strong>Period</strong>: {!! $education->Period !!}</p>
                    <p><strong>Type</strong>: {!! $education->Level !!}</p>
                    <ul class="list-group hidden-print">
                        @php
                        $index = 0
                        @endphp
                        @foreach ($education->attachements as $attachement)
                        <li class="list-group-item"><a href="{{ asset("$attachement->path") }}" target="_blank">Attachment {{++$index}}</a>  </li>
                        @endforeach
                    </ul>
                    <hr>
                </div>
