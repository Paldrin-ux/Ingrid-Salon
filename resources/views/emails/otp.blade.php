<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Email Verification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        .container {
            background: white;
            max-width: 500px;
            margin: 50px auto;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        h2 {
            color: #6a4c93;
            text-align: center;
        }
        p {
            color: #333;
            font-size: 15px;
        }
        .otp-box {
            text-align: center;
            background: #f0e5ff;
            border: 2px dashed #a66cff;
            color: #5e3ea1;
            font-size: 24px;
            letter-spacing: 5px;
            font-weight: bold;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            color: #888;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Ingrid Salon 💇‍♀️</h2>
        <p>Hello!</p>
        <p>Here’s your email verification code:</p>
        <div class="otp-box">{{ $otp }}</div>
        <p>This code will expire in 10 minutes. Please do not share it with anyone.</p>
        <div class="footer">
            &copy; {{ date('Y') }} Ingrid Salon. All rights reserved.
        </div>
    </div>
</body>
</html>
