<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - Mazer Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/auth.css') }}">
</head>

<body>
    <div id="auth">

        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo">
                        <a href="{{ route('dashboard') }}"><img src="assets/images/logo/logo.png" alt="Logo"></a>
                    </div>
                    <h1 class="auth-title" style="font-size: 2.5rem;">Forgot Password</h1>
                    
                    @if($step == 1)
                        <p class="auth-subtitle mb-4">Input your username to recover your account.</p>
                    @elseif($step == 2)
                        <p class="auth-subtitle mb-4">Input your registered email address.</p>
                        <div class="alert alert-info py-2 px-3 mb-4">
                            Recovering account: <strong>{{ session('forgot_username') }}</strong>
                        </div>
                    @elseif($step == 3)
                        <p class="auth-subtitle mb-4">Set your new account password.</p>
                        <div class="alert alert-info py-2 px-3 mb-4">
                            Setting password for: <strong>{{ session('forgot_username') }}</strong>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger mb-4">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('forgot.submit') }}" method="POST">
                        @csrf
                        <input type="hidden" name="step" value="{{ $step }}">

                        @if($step == 1)
                            <div class="form-group position-relative has-icon-left mb-4">
                                <input type="text" class="form-control form-control-xl" placeholder="Username" name="username" value="{{ old('username') }}" required autofocus autocomplete="username">
                                <div class="form-control-icon">
                                    <i class="bi bi-person"></i>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-4">Verify Username</button>
                        @endif

                        @if($step == 2)
                            <div class="form-group position-relative has-icon-left mb-4">
                                <input type="email" class="form-control form-control-xl" placeholder="Email Address" name="email" value="{{ old('email') }}" required autofocus autocomplete="email">
                                <div class="form-control-icon">
                                    <i class="bi bi-envelope"></i>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-4">Verify Email</button>
                        @endif

                        @if($step == 3)
                            <div class="form-group position-relative has-icon-left mb-4">
                                <input type="password" class="form-control form-control-xl" placeholder="New Password" name="password" required autofocus>
                                <div class="form-control-icon">
                                    <i class="bi bi-shield-lock"></i>
                                </div>
                            </div>
                            <div class="form-group position-relative has-icon-left mb-4">
                                <input type="password" class="form-control form-control-xl" placeholder="Confirm Password" name="password_confirmation" required>
                                <div class="form-control-icon">
                                    <i class="bi bi-shield-lock"></i>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-4">Reset Password</button>
                        @endif
                    </form>

                    <div class="text-center mt-5 text-lg fs-4">
                        @if($step > 1)
                            <form action="{{ route('forgot.reset') }}" method="POST" class="d-inline mb-3">
                                @csrf
                                <p class="text-gray-600">
                                    <button type="submit" class="btn btn-link p-0 m-0 align-baseline font-bold text-danger" style="text-decoration: none;">Start Over / Cancel</button>
                                </p>
                            </form>
                        @endif
                        <p class='text-gray-600'>Remember your account? <a href="{{ route('signin') }}" class="font-bold">Log in</a>.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">

                </div>
            </div>
        </div>

    </div>
</body>

</html>