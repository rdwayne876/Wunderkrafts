<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    <table>
        <tr>
            <td>Hi {{ $name}},</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Welcome to WunderKrafts</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Please click the link below to activate your acount:</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td><a href="{{ url('confirm/'.$code)}}">{{ url('confirm/'.$code)}}</a></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Thanks for making it WunderKrafts</td>
        </tr>
        <tr>
            <td>Best Regards</td>
        </tr>
    </table>
</body>
</html>