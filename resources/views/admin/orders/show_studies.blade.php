
                <div class="col-md-12">
                    <p><strong>Institution name</strong>: {!! $education->institution !!}</p>
                    <p><strong>Location</strong>: {!! $education->city !!}</p>
                    <p><strong>Period</strong>: {!! $education->Period !!}</p>
                    <p><strong>Type</strong>: {!! $education->Level !!}</p>
                    <ul class="list-group">
                        @php
                        $index = 0
                        @endphp
                        @foreach ($education->certificate as $certificate)
                        <li class="list-group-item"><a href="{{ asset("$certificate->path") }}" target="_blank">Attachment {{++$index}}</a>  </li>
                        @endforeach
                    </ul>
                    <hr>
                </div>
