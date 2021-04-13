<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Send Otp</title>
</head>
<body>

<div style="font-family: Helvetica,Arial,sans-serif;min-width:1000px;overflow:auto;line-height:2">
  <div style="margin:50px auto;width:70%;padding:20px 0">
    <div style="border-bottom:1px solid #eee">
      <a href="" style="font-size:1.4em;color: #00466a;text-decoration:none;font-weight:600">{{ $setting->title }}</a>
    </div>
    <p style="font-size:1.1em">Hi,</p>
    <p>Thank you for choosing Your {{ $setting->title }}. Use the following OTP to verify your email address.</p>
    <h2 style="background: #00466a;margin: 0 auto;width: max-content;padding: 0 10px;color: #fff;border-radius: 4px;">{{ $otp }}</h2>
    <p style="font-size:0.9em;">Regards,<br />{{ $setting->title }}</p>
    <hr style="border:none;border-top:1px solid #eee" />
    <div style="text-align:center;padding:8px 0;color:#aaa;font-size:0.8em;line-height:1;font-weight:300">
      <p>© {{ date('Y') }} {{ $setting->title }}. All rights reserved.</p>
    </div>
  </div>
</div>

</body>
</html>
