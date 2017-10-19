
                <div class="col-md-12">
                    <p><strong>Name</strong>: {!! $other->name !!}</p>
                    <p><strong>Date</strong>: {!! $other->date !!}</p>
                    <ul class="list-group hidden-print">
                        @php
                        $index = 0
                        @endphp
                        @foreach ($other->attachements as $attachement)
                        <li class="list-group-item"><a href="{{ asset("$attachement->path") }}" target="_blank">Attachment {{++$index}}</a>  </li>
                        @endforeach
                    </ul>
                    <hr>
                </div>
