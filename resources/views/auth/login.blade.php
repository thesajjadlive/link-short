
<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="shortcut icon" href="{{ asset('assets/backend/img/back_icon.png') }}" type="image/x-icon"/>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" />

    <style>
        :root {
            --main-bg: #6610f2;
        }
        .main-bg {
            background: rgb(162,190,237);
            background-image: linear-gradient(to right top, #d16ba5, #c882bd, #bf98ce, #baabd8, #bbbcdc, #b6bbde, #b0bbdf, #aabae1, #94a9e4, #8097e5, #6f84e5, #6071e4);
        }

        .btn-bg{
            background-color: var(--main-bg) !important;
            border-color: var(--main-bg) !important;
        }
        input:focus,
        button:focus {
            border: 1px solid var(--main-bg) !important;
            box-shadow: none !important;
        }
        .form-check-input:checked {
            background-color: var(--main-bg) !important;
            border-color: var(--main-bg) !important;
        }
        .card{
            border-radius: 10px;
        }
    </style>
</head>

<body class="main-bg">
<!-- Login Form -->
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card shadow">
                <div class="card-title text-center border-bottom">
                    <a class="text-decoration-none" href="{{ route('app.dashboard') }}">
                        @if(setting('site_logo') !=null)
                            <img class="img-fluid" src="{{ asset(setting('site_logo')) }}" alt="logo" >
                        @else
                            <h2 class="p-3 text-black-50">{{ config('app.name') }}</h2>
                        @endif
                    </a>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}" class="loginForm">
                        @csrf
                        <div class="mb-4">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required placeholder="Email">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="Password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-bg text-light loginBtn">Login</button>
                        </div>
                    </form>
                    @if (Route::has('password.request'))
                        <p class="mt-3 login-form__footer">Forgot Your Password? <a href="{{ route('password.request') }}" class="text-secondary text-decoration-none">Click Here</a></p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
</body>

<script>
    $('.loginForm').on('submit', function() {
        $('.loginBtn').attr('disabled', true);
    })
</script>
</html>





