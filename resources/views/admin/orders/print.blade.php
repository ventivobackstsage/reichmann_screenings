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
            <div class="space-30"><br /></div>
            <p>
                Dear Client:
                <p class="space-30"><br /></p>
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
            <div style="margin-left: 10em; float: left;">{{ $order->candidate->user->fullName }}</div>
            <br />
            <div style="float: left"><strong>Our Case ID:</strong></div>
            <div style="margin-left: 10em; float: left;">{{ $order->id }}</div>
            <br />
            <div style="float: left"><strong>Date Assigned:</strong></div>
            <div style="margin-left: 10em; float: left;">{{ $order->created_at }}</div>
            <br />
            <div style="float: left"><strong>Investigation Date(s):</strong></div>
            <div style="margin-left: 10em; float: left;"></div>
            <br />
            <div style="float: left"><strong>Investigator(s):</strong></div>
            <div style="margin-left: 10em; float: left;"></div>
        </div>
    </div>
    <div class="row">
        <div class="">
            <div class="panel-body">
                <h2>Order ID: {!! $order->id !!}</h2>
                <hr>
                <div class="col-md-12">
                    <p><strong>First name</strong>: {!! $order->candidate->user->first_name !!}</p>
                    <p><strong>Last name</strong>: {!! $order->candidate->user->last_name !!}</p>
                    <p><strong>Email</strong>: {!! $order->candidate->user->email !!}</p>
                    <p><strong>Phone</strong>: {!! $order->candidate->user->phone !!}</p>
                    <p><strong>CNP</strong>: {!! $order->candidate->cnp !!}</p>
                    <p><strong>Address</strong>: {!! $order->candidate->address !!}</p>
                    <p><strong>City</strong>: {!! $order->candidate->city !!}</p>
                    <p><strong>Country</strong>: {!! $order->candidate->country !!}</p>
                    <hr>
                    <p><strong>Position</strong>: {!! $order->position !!}</p>
                    <p><strong>Reason of check</strong>: {!! $order->reason !!}</p>
                </div>
            </div>
        </div>
        <div class="">
            <div class="panel-body">
                <h2>STUDIES</h2>
                <hr>

                @each('admin.orders.show_studies_print', $order->candidate->education, 'education','admin.orders.show_studies_empty')

            </div>
        </div>
        <div class="">
            <div class="panel-body">
                <h2>EXPERIENCE</h2>
                <hr>

                @each('admin.orders.show_experience', $order->candidate->experience, 'experience','admin.orders.show_experience_empty')
            </div>
        </div>
  </div>
</section>
</body>

</html>
