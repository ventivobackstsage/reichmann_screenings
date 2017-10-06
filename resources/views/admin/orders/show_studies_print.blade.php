
                <div class="col-md-12">
                    <p><strong>Institution name</strong>: {!! $education->institution !!}</p>
                    <p><strong>Location</strong>: {!! $education->city !!}</p>
                    <p><strong>Period</strong>: {!! $education->Period !!}</p>
                    <p><strong>Type</strong>: {!! $education->Level !!}</p>

                        @foreach ($education->certificate as $certificate)
                        <img width="100%" src="{{ asset("$certificate->path") }}"></img>
                        @endforeach
                    <hr>
                </div>
