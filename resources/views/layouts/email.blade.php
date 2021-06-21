<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link href="https://fonts.googleapis.com/css2?family=PT+Sans&family=Baloo+2&family=Lilita+One&display=swap" rel="stylesheet" type="text/css">
        <title>{{ config('app.name') }}</title>
    </head>
    <body style="margin: 0; padding: 0; font-family: 'PT Sans','Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif; table-layout: fixed;">
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td width="600">
                    <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
                        <tr>
                            <td style="border-bottom: 1px dashed #ccc;">
                                @yield('email_outer_header', View::make('layouts._emails.default_outer_header'))
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 10px; border-bottom: 1px solid #cccccc;">
                                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                    <tr>
                                        <td style="font-size: 20px; text-align: center; color: #000000;">@yield('email_title')</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 30px 0; font-size: 1rem; color: #000000;">@yield('email_body')</td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 1rem; padding: 10px 0 0 0; color: #000000;">@yield('email_footer')</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 10px;">
                                @yield('email_outer_footer', View::make('layouts._emails.default_outer_footer'))
                            </td>
                        </tr>
                    </table>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>
        </table>
    </body>
</html>