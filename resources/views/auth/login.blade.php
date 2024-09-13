<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <title>Masuk Aplikasi Penilaian</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f0f0f0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-container {
            background-color: white;
            padding: 3rem;
            border-radius: 10px;
            box-shadow: 0px 0px 150px rgba(0, 0, 0, 0.1);
            width: 450px;
        }
        .login-container img {
            display: block;
            margin: 0 auto 20px;
        }
        .login-header {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 25px;
            text-align: center;
            color: #555;
        }
        .input-group .form-control {
            border-radius: 0 5px 5px 0;
        }
        .input-group .input-group-text {
            border-radius: 5px 0 0 5px;
            background-color: #f8f9fa;
        }
        .remember-me {
            margin-top: 10px;
        }
    </style>

</head>
<body>

<div class="login-container">
    
    <div class="login-header">
        {{ __('Masuk Aplikasi Penilaian') }}
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="input-group mb-3">
            <span class="input-group-text"><i class="fas fa-user"></i></span>
            <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" placeholder="NIPP" value="{{ old('username') }}" required autofocus>
            @error('username')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text"><i class="fas fa-lock"></i></span>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Kata Sandi" required>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group remember-me">
            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <label class="form-check-label" for="remember">
                {{ __('Remember me') }}
            </label>
        </div>

        <div class="form-group mt-3">
            <button type="submit" class="btn btn-login btn-primary px-3">
                {{ __('Masuk') }}
            </button>
        </div>
    </form>
</div>

<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
