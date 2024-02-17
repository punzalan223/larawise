<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Larawise</title>
    {{-- Favicon --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('img/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('css/utilities.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login/login.css') }}">

    <style>
    </style>
</head>
<body>
    <img src="{{ asset('img/bg3.jpg') }}" alt="" style="height: 100%; width: 100%; position: fixed; z-index: -1; object-fit: cover; background-repeat: no-repeat; ">
    <section class="login-section">
        <div class="glass-card">
            <div class="glass-img">
                {{-- <img id="login-glass-img" src="{{ asset('img/bg3.jpg') }}" alt=""> --}}
            </div>
            <div class="glass-content">
                <form action="{{ route('login') }}" method="POST" autocomplete="off">
                    @csrf
                    <h2 class="u-fw-b t-color">Login your account</h2>
                    <h5 class="u-c-gray u-mt-25">Welcome back you've been missed!</h5>
                    <div class="login-input">
                        <label class="u-fw-b" for="">Email</label>
                        <input type="email" name="email" placeholder="Your Email Address" required>
                    </div>
                    <div class="login-input">
                        <label class="u-fw-b" for="">Password</label>
                        <input type="password" name="password" placeholder="Your Password" required>
                    </div>
                    <button class="lara-btn u-fw-b u-t-white" id="login-btn">Login</button>
                    @error('email')
                        <div class="u-mt-15 u-bg-danger u-p-10 u-fw-b u-t-white">
                            <h5>⚠️ {{ $message }}<h5/>
                        </div>
                    @enderror
                    @if(Session::has('logout'))
                        <div class="u-mt-15 u-bg-success u-p-10 u-fw-b u-t-white">
                            <h5>⛔ {{ Session::get('logout') }}</h5>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </section>
</body>
</html>