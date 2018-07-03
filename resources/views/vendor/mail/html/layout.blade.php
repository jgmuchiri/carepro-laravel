<!doctype html>
<html>
<head>
    <meta name="viewport" content="width=device-width"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <style>

    </style>
</head>
<body class="">
<table border="0" cellpadding="0" cellspacing="0" class="body">
    <tr>
        <td>&nbsp;</td>
        <td class="container">
            <div class="content">
                <span class="preheader"></span>
                <table style="background: #eaeaea;">
                    {{ $header or '' }}
                </table>
                <table class="main">
                    <tr>
                        <td class="wrapper">
                            <table border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td>
                                        {{ Illuminate\Mail\Markdown::parse($slot) }}

                                        {{ $subcopy or '' }}
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <div class="footer">
                    <table border="0" cellpadding="0" cellspacing="0">
                        {{ $footer or '' }}
                    </table>
                </div>
            </div>
        </td>
        <td>&nbsp;</td>
    </tr>
</table>
</body>
</html>