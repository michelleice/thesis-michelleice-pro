@extends('layouts.email')
@section('email_title', __('Verify your E-mail Address'))
@section('email_body')
<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td style="padding: 0 0 12px 0; font-size: 17px;"><b>Welcome!</b></td>
    </tr>
    <tr>
        <td style="text-align: justify;">Thank you for your registration!</td>
    </tr>
    <tr>
        <td style="padding: 6px 0 0 0; text-align: justify;">
            Unfortunately, it is mandatory for us to verify the E-Mail Address associated with your account before you can use our services.
            To verify, simply press on the button below. 
        </td>
    </tr>
    <tr>
        <td style="padding: 24px 0; text-align: center;">
            <a href="{{ $url }}" style="border-radius: 4px; padding: 12px 20px; text-decoration: none; color: #ffffff; background-color: #007bff;">Verify my E-Mail Address</a>
        </td>
    </tr>
    <tr>
        <td style="text-align: justify;">
            Alternatively, you can copy the link below. <br />
            <a href="{{ $url }}">{{ $url }}</a>
        </td>
    </tr>
</table>
@endsection
@section('email_footer')
Thank you, <br /><b style="font-family: 'Titillium Web','Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 20px;">{{ config('app.name') }}</b>
@endsection