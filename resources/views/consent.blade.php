@extends('layouts/default')

{{-- Page title --}}
@section('title')
Consent
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/features.css') }}">
@stop


{{-- Page content --}}
@section('content')
    <!-- container Section Start -->
    <div class="container">
        <!-- Heading Section Start -->

        <!-- Blockquote Section Start -->
        <div class="row">
            <div class="col-md-12">
                    <h3 class="warning">Consent</h3>
                <p>I hereby declare on my own liability that the information provided is true and valid to the best of my knowledge.</p>
                <p>The power of attorney is hereby given to <strong>Reichmann Asset Management SRL</strong>, to carry out such searches as may be necessary in order to verify the information presented in the provided CV and other documents relevant for my professional experience. For this purpose, the company, <strong>Reichmann Asset Management SRL</strong>, is empowered to conduct the investigation to all institutions/ natural and legal persons mentioned in the documents sent for the verification, including direct contact, to provide information according to the provided CV, the criminal record and other documents relevant for my professional experience, such as, but not limited to: information about studies, graduate institutions or others certifications, previous roles and employment periods, references from former superiors/colleagues, or legal history.</p>
                <p>I fully understand the importance the background screening has as a tool for prevention of conflicts of interest and protection against fraud and misconduct in professional and business relationships.</p>

                <p>I understand that my records will be handled in accordance with personal data protection regulations from Romania.</p>
                <p><strong>Reichmann Asset Management SRL</strong> guarantees my rights on the personal data provided through the present declaration: right to be informed, of intervention, opposition, to complain at ANSPDCP, in court or to require the removal of data according to personal data protection regulations.</p>

                <p>I understand and hereby declare that I agree for the personal data provided in this document to be transferred by <strong>Reichmann Asset Management SRL</strong> abroad(if applicable) according to personal data protection regulations.</p>


                <p>By this, the undersigned I fully declare that I agree that the institutions/ natural persons/ companies which are to be contacted by <strong>Reichmann Asset Management SRL</strong> to carry out searches regarding my professional background and for anonymous   statistics   can   provide   to   <strong>Reichmann Asset Management SRL</strong>  all   the requested information.</p>

                <p>I confirm I have fully read and understood the declaration above.</p>

            </div>
        </div>
        <!-- //Blockquote Section End -->
    </div>
    
@stop