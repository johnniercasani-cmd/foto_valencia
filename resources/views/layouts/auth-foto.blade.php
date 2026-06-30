<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Foto Valencia')</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #ececec;
        }

        .auth-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .auth-container {
            width: 100%;
            max-width: 1200px;
            min-height: 650px;
            background: #efefef;
            border: 6px solid #2b2b2b;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            padding: 25px;
        }

        .auth-left {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .auth-left img {
            width: 100%;
            max-width: 480px;
            height: auto;
            object-fit: contain;
        }

        .auth-right {
            background: #e8e8e8;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px;
        }

        .auth-card {
            width: 100%;
            max-width: 420px;
        }

        .auth-card.small {
            background: #f7f7f7;
            border-radius: 20px;
            padding: 28px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.10);
        }

        .auth-title {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #111;
        }

        .auth-subtitle {
            text-align: center;
            font-size: 14px;
            color: #333;
            margin-bottom: 28px;
            line-height: 1.5;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
        }

        .form-group {
            margin-bottom: 22px;
        }

        .form-group label {
            display: block;
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #111;
        }

        .form-group input {
            width: 100%;
            padding: 14px 18px;
            border: none;
            border-radius: 999px;
            background: #dddddd;
            font-size: 15px;
            outline: none;
        }

        .btn-primary {
            width: 100%;
            border: none;
            background: #1e88f5;
            color: white;
            padding: 14px 18px;
            border-radius: 999px;
            font-size: 15px;
            cursor: pointer;
            margin-top: 10px;
        }

        .btn-secondary {
            display: block;
            width: 100%;
            text-align: center;
            text-decoration: none;
            background: #e5e5e5;
            color: #111;
            padding: 14px 18px;
            border-radius: 999px;
            font-size: 15px;
            margin-top: 14px;
        }

        .error-box {
            background: #ffe0e0;
            color: #a00000;
            padding: 12px 15px;
            border-radius: 12px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .error-box ul {
            margin: 8px 0 0 18px;
            padding: 0;
        }

        .status-box {
            background: #e3f7e3;
            color: #196b19;
            padding: 12px 15px;
            border-radius: 12px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .forgot-link {
            display: inline-block;
            margin-top: 12px;
            font-size: 14px;
            color: #333;
            text-decoration: none;
        }

        @media (max-width: 900px) {
            .auth-container {
                grid-template-columns: 1fr;
            }

            .auth-left {
                padding-bottom: 0;
            }

            .auth-left img {
                max-width: 300px;
            }

            .form-row {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="auth-wrapper">
        <div class="auth-container">
            <div class="auth-left">
                <img src="{{ asset('img/logo.png') }}" alt="Logo Foto Valencia">
            </div>

            <div class="auth-right">
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>