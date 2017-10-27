<!DOCTYPE html>

<html>

<head>

    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
<style>
    .page-break {
        page-break-after: always;
    }
    .page-break-before {
        page-break-before: always;
    }
    .space-10{
        margin-bottom : 10px
    }
    .space-20{
        margin-bottom : 20px
    }
    .space-30{
        margin-bottom : 30px
    }
    .space-40{
        margin-bottom : 40px
    }
    .space-50{
        margin-bottom : 50px
    }
    .space-60{
        margin-bottom : 60px
    }
    .space-80{
        margin-bottom : 80px
    }
    ul.list-group:after {
        clear: both;
        display: block;
        content: "";
    }

    .list-group-item {
        float: left;
    }
    .paddingleft_30{
        padding-left: 30px;
    }

    .paddingright_15{
        padding-right: 15px;
    }

</style>
</head>

<body>
<section class="paddingleft_30 paddingright_15">
    <p class="row text-center">
        <img src="{{ asset('assets/images/logo.png') }}" alt="logo">
    </p>
    <p class="space-40"><br /></p>
    <div class="row">
        <p class="date">{{ date('d F Y') }}</p>
        <p class="space-20"><br /></p>
        <p class="company">
            <p>
                {{ $order->company->name }}<br />
                {{ $order->company->address }}<br />
                {{ $order->company->vat_code }}<br />
                {{ $order->company->reg_com }}
            </p>
            <div style="float: left">
                <div style="float: left">RE:</div><div style="margin-left: 7em; float: left;">{{ $order->candidate->user->fullName }}</div>
                <br />
                <div style="float: left">Our case ID#:</div><div style="padding-left: 7em">{{ $order->id }}</div>
            </div>
            <div class="space-80"><br /></div>
            <p>
                Dear Client:
                <br /><br />
                We have concluded our screening investigation regarding {{$order->candidate->user->fullName}}  at this time. The details of our investigation and findings are explained in the attached investigative report.
                <p class="space-30"><br /></p>
                Please feel free to contact me if you have any questions, comments, or if you would like any additional investigations or services.
                <p class="space-30"><br /></p>
                Regards,<br /><br />
                <img src="{{ asset('assets/img/authors/cohen.png') }}" height="100%" width="20%" alt="cohen">
                <br />
                Cohen Ionut<br />Chief Executive Officer
            </p>
        </p>
        <p class="space-80"><br/></p>
        <p class="text-center" style="border-color: #000000; border-style: solid;border-width: 1px">
            Florilor Street, Nr.11, Comuna  Stefanestii de Jos, Jud. Ilfov<br />
            J9/603/04.10.2012, C.U.I: 30184266<br />
            <strong>Office:</strong> 0771.232.116 |  <strong>Email:</strong>  office@reichmann.ro |  <strong>Web:</strong> www.reichmann.com
        </p>
    </div>
    <p class="page-break-before"></p>
    <div class="row">
        <p class="text-center" style="style="font-size: 18px; font-weight: bold"">INVESTIGATIVE REPORT</p>
        <p class="date text-center">{{ date('d F Y') }}</p>
        <p class="space-20"><br /></p>
        <p class="text-center" style="border-color: #000000; border-style: solid;border-width: 1px; margin-left: 90px; margin-right:90px">
            "PRIVILEGED COMMUNICATION"<br />
            This report is confidential and is intended solely for the use and information of the client to whom it is addressed.

        </p>
        <p class="space-10"><br /></p>
        <p class="text-center" style="background-color: #000000;color: #ffffff;font-size: 12px;font-weight: bold;height: 25px;padding-top: 3px;">
            Client Information
        </p>

        <div style="float: left">
            <div style="float: left"><strong>Client:</strong></div>
            <div style="margin-left: 7em; float: left;">{{ $order->company->name }}</div>
            <br />
            <div style="margin-left: 7em; float: left;">{{ $order->company->address }}</div>
            <br />
            <div style="margin-left: 7em; float: left;">{{ $order->company->vat_code }}</div>
            <br />
            <div style="margin-left: 7em; float: left;">{{ $order->company->reg_com }}</div>
        </div>
    </div>
    <div class="row">
        <p class="space-10"><br /></p>
        <p class="text-center" style="background-color: #000000;color: #ffffff;font-size: 12px;font-weight: bold;height: 25px;padding-top: 3px;">
            Case Information
        </p>

        <div style="float: left">
            <div style="float: left"><strong>Subject:</strong></div>
            <div style="margin-left: 11em; float: left;">{{ $order->candidate->user->fullName }}</div>
            <br />
            <div style="float: left"><strong>Our Case ID:</strong></div>
            <div style="margin-left: 11em; float: left;">{{ $order->id }}</div>
            <br />
            <div style="float: left"><strong>Date Assigned:</strong></div>
            <div style="margin-left: 11em; float: left;">{{ Carbon::parse($order->created_at)->format('M d, Y') }}</div>
            <br />
            <div style="float: left"><strong>Investigation Date(s):</strong></div>
            <div style="margin-left: 11em; float: left;">
                @foreach ($order->updates as $update)
                {{Carbon::parse($update->created_at)->format('M d, Y')}}
                @if (!$loop->last)
                ;
                @endif
                @endforeach
            </div>
            <br />
            <div style="float: left"><strong>Investigator(s):</strong></div>
            <div style="margin-left: 11em; float: left;">
                @foreach ($order->updates->unique("user_id") as $update)
                {{$update->user->fullName}}
                @if (!$loop->last)
                ;
                @endif
                @endforeach
            </div>
        </div>
    </div>
    <div class="row">
        <p class="space-10"><br /></p>
        <p class="text-center" style="background-color: #000000;color: #ffffff;font-size: 12px;font-weight: bold;height: 25px;padding-top: 3px;">
            Objective
        </p>

        <div style="float: left">
            Cohen Investigations Agency SRL was retained on {{ Carbon::parse($order->created_at)->format('M d, Y') }} to conduct covert surveillance to determine the Subject’s integrity.
        </div>
    </div>
    <div class="row">
        <p class="space-10"><br /></p>
        <p class="text-center" style="background-color: #000000;color: #ffffff;font-size: 12px;font-weight: bold;height: 25px;padding-top: 3px;">
            Subject Information
        </p>

        <div style="float: left">
            <div style="float: left"><strong>Full Name:</strong></div>
            <div style="margin-left: 11em; float: left;">{{ $order->candidate->user->fullName }}</div>
            <br />
            <div style="float: left"><strong>Address:</strong></div>
            <div style="margin-left: 11em; float: left;">{{ $order->candidate->address }}</div>
            <br />
            <div style="margin-left: 11em; float: left;">{{ $order->candidate->city }}, {{ $order->candidate->country }} </div>
            <br />
            <div style="float: left"><strong>Phone:</strong></div>
            <div style="margin-left: 11em; float: left;">{{ $order->candidate->user->phone}}</div>
            <br />
            <div style="float: left"><strong>CNP:</strong></div>
            <div style="margin-left: 11em; float: left;">{{ $order->candidate->cnp}}</div>
        </div>
    </div>
    <div class="row">
        <p class="space-10"><br /></p>
        <p class="text-center" style="background-color: #000000;color: #ffffff;font-size: 12px;font-weight: bold;height: 25px;padding-top: 3px;">
            Education
        </p>


            @each('admin.orders.show_studies_print', $order->candidate->education, 'education','admin.orders.show_studies_empty')

        <p class="text-center" style="background-color: #000000;color: #ffffff;font-size: 12px;font-weight: bold;height: 25px;padding-top: 3px;">
            Details of the check
        </p>
        <div>
            @forelse ($order->updates->sortBy('created_at')->filter(function($value, $key){return $value->category == "studies";}) as $update)
            <div style="page-break-inside: avoid">
            <h4 class="text-center">{{Carbon::parse($update->created_at)->format('l')}}</h4>
            <h4 class="text-center">{{Carbon::parse($update->created_at)->format('M d, Y')}}</h4>
            <strong>{{Carbon::parse($update->created_at)->format('h:i A')}}</strong>
            <p>
                {{$update->Description}}
            </p>
            </div>
            @empty
            <p>No checks</p>
            @endforelse
        </div>

    </div>
    <div class="row">
        <p class="space-10"><br /></p>
        <p class="text-center" style="background-color: #000000;color: #ffffff;font-size: 12px;font-weight: bold;height: 25px;padding-top: 3px;">
            Employment
        </p>

        @each('admin.orders.show_experience_print', $order->candidate->experience, 'experience','admin.orders.show_experience_empty')
        <p class="text-center" style="background-color: #000000;color: #ffffff;font-size: 12px;font-weight: bold;height: 25px;padding-top: 3px;">
            Details of the check
        </p>
        <div>
            @forelse ($order->updates->sortBy('created_at')->filter(function($value, $key){return $value->category == "experience";}) as $update)
            <div style="page-break-inside: avoid">
            <h4 class="text-center">{{Carbon::parse($update->created_at)->format('l')}}</h4>
            <h4 class="text-center">{{Carbon::parse($update->created_at)->format('M d, Y')}}</h4>
            <strong>{{Carbon::parse($update->created_at)->format('h:i A')}}</strong>
            <p>
                {{$update->Description}}
            </p>
            </div>
            @empty
            <p>No checks</p>
            @endforelse
        </div>

    </div>
    <div class="row">
        <p class="space-10"><br /></p>
        <p class="text-center" style="background-color: #000000;color: #ffffff;font-size: 12px;font-weight: bold;height: 25px;padding-top: 3px;">
            Other Attachments
        </p>
        <div>
            @foreach ($order->candidate->other as $other)
            <p><strong>Name:</strong>{{ $other->name }}<br />
                <strong>Date:</strong>{{ $other->date }}<br />
                <strong>Description:</strong>{{ $other->description }}</p>
            <br />
            <img width="100%" src="{{ asset($other->attachements->path) }}"></img>
            <br /><br />
            @if(!$loop->last)
            <hr>
            @endif
            @endforeach
        </div>
        <p class="text-center" style="background-color: #000000;color: #ffffff;font-size: 12px;font-weight: bold;height: 25px;padding-top: 3px;">
            Details of the check
        </p>
        <div>
            @forelse ($order->updates->sortBy('created_at')->filter(function($value, $key){return $value->category == "other";}) as $update)
            <div style="page-break-inside: avoid">
            <h4 class="text-center">{{Carbon::parse($update->created_at)->format('l')}}</h4>
            <h4 class="text-center">{{Carbon::parse($update->created_at)->format('M d, Y')}}</h4>
            <strong>{{Carbon::parse($update->created_at)->format('h:i A')}}</strong>
            <p>
                {{$update->Description}}
            </p>
            </div>
            @empty
            <p>No checks</p>
            @endforelse
        </div>

    </div>
    <div class="row" style="page-break-inside: avoid">
        <p class="space-10"><br /></p>
        <p class="text-center" style="background-color: #000000;color: #ffffff;font-size: 12px;font-weight: bold;height: 25px;padding-top: 3px;">
            Conclusion
        </p>

        <div style="float: left">
            This concludes our investigative report. Please feel free to contact our office if you have any questions, comments, or if you would like any additional investigations or services.<br /><br />
            Regards,<br /><br />
            Ionut Cohen, <i>CEO</i><br />
            <strong>Reichmann Asset Management LLC</strong><br />
            J9/603/04.10.2012, C.U.I: 30184266<br /><br />

            Str. Florilor, Nr.11, Com. Stef. de Jos, Jud. Ilfov<br />
            Tel: 0771.232.116<br />
            Site: www.reichmann.com<br />
            Email: office@reichmann.ro
        </div>
    </div>
    <p class="page-break-before"></p>
    <p class="row text-center">
        <img src="{{ asset('assets/images/logo.png') }}" alt="logo">
    </p>
    <p class="space-40"><br /></p>
    <div class="row">
        <p class="text-center"><strong>DISCLAIMER</strong></p>
        <p class="space-20"><br /></p>
        The information contained in this report is a summary detailing investigative activity and activities as observed by our Investigator(s). This report should not be considered a complete minute-by-minute description of the Subject's or Investigator's activities, rather a brief description in chronological order of the activities observed or performed. When video recording and/or photographs were acquired, the activities recorded shall speak for themselves. When videotaping or photography was not logistically possible, the Investigator's visual observations were documented. All descriptions are based on the Investigator's observations as may be described by the average layperson and should not be considered as a professional medical diagnosis. We make reasonable efforts to positively identify the subject of each investigation without compromising the confidential nature and integrity of the investigation. Notwithstanding our efforts, someone other than the intended subject may have been observed, recorded, or photographed. It is important that any obtained video or photos be carefully reviewed and examined to confirm that the individual depicted is in fact the intended subject. Some information contained in this report may have been obtained through online public record services. While these sources are deemed by us to generally be reliable, these records are not always complete and can contain inaccurate information. Such information should not be relied upon without independent verification. We accept no liability which may arise from the use of such information without verification. By accepting this report, you agree and certify that its ordering of and use of this report is in strict compliance with any applicable provision of the Public Law 182/2002.
<br /><br />
        THIS REPORT WAS PREPARED IN ANTICIPATION OF LITIGATION.
    </div>
</section>
</body>

</html>
