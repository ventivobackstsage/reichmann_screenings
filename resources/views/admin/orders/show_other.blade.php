
                <div class="col-md-12">
                    <p><strong>Name</strong>: {!! $other->name !!}</p>
                    <p><strong>Date</strong>: {!! $other->date !!}</p>
                    @if($other->attachements)
                    <ul class="list-group">
                        <li class="list-group-item"><a href="{{ asset($other->attachements->path) }}" target="_blank">Attachment</a>  </li>
                    </ul>
                    @endif
                    <hr>
                </div>
