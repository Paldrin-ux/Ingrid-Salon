<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Ingrid Salon</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            margin: 0;
            background: #f3e8ff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            width: 850px;
            height: 500px;
            background: #fff;
            border-radius: 20px;
            display: flex;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }

        .login-left {
            flex: 1;
            padding: 50px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-left h2 {
            margin-bottom: 10px;
            font-weight: 600;
            color: #5e17eb;
        }

        .login-left p {
            margin-bottom: 25px;
            color: #777;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 10px;
            font-size: 14px;
        }

        .form-group input:focus {
            border-color: #5e17eb;
            outline: none;
        }

        .forgot {
            text-align: right;
            margin-top: 5px;
            margin-bottom: 20px;
        }

        .forgot a {
            color: #5e17eb;
            font-size: 13px;
            text-decoration: none;
        }

        .login-btn {
            width: 100%;
            background: #5e17eb;
            border: none;
            color: #fff;
            padding: 12px;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 500;
            font-size: 15px;
            transition: 0.3s;
        }

        .login-btn:hover {
            background: #7b34ff;
        }

        .social-login {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .social-login button {
            width: 48%;
            padding: 10px;
            border-radius: 10px;
            border: 1px solid #ddd;
            background: #fff;
            cursor: pointer;
            font-weight: 500;
            transition: 0.3s;
        }

        .social-login button:hover {
            background: #f3e8ff;
        }

        .signup-text {
            margin-top: 25px;
            text-align: center;
            font-size: 14px;
        }

        .signup-text a {
            color: #5e17eb;
            text-decoration: none;
            font-weight: 500;
        }

        .login-right {
            flex: 1;
            background: linear-gradient(135deg, #7b34ff, #e056fd);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-right img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-left">
            <h2>Log In</h2>
            <p>Welcome back! Please enter your details.</p>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <input type="email" name="email" placeholder="Email" required>
                </div>

                <div class="form-group">
                    <input type="password" name="password" placeholder="Password" required>
                </div>

                <div class="forgot">
                    <a href="{{ route('password.request') }}">Forgot password?</a>
                </div>

                <button type="submit" class="login-btn">Log In</button>

                <div class="social-login">
                    <button>Google</button>
                    <button>Facebook</button>
                </div>

                <div class="signup-text">
                    Don’t have an account? <a href="{{ route('register') }}">Sign up</a>
                </div>
            </form>
        </div>

        <div class="login-right">
            <img src="{{ asset('images/gege.jpg') }}" alt="Login Image">
        </div>
    </div>
</body>
</html>
