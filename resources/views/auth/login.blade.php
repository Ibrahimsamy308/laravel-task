<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ settings()->description }}">
    <meta name="keywords" content="{{ settings()->keywords }}">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="{{ settings()->logo }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ settings()->logo }}" type="image/x-icon">
    <title>{{ settings()->title }}</title>

    <!-- Google font-->
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">


    <!-- Bootstrap css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/vendors/bootstrap.css') }}">


    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">


    <!-- App css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/custom.css') }}">
</head>

<body class="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">



    <!-- login section start -->
    <section class="log-in-section section-b-space" style="background-image:url({{ asset(settings()->loginImage) }});">
        <div class="container w-100">
            <div class="row align-items-center">


                <!-- Login Form Section -->
                <div class="col-xl-5 col-lg-6">
                    <div class="log-in-box">
                        <div class="log-in-title">
                        <h3>{{ __('general.welcome_to') }} {{ settings()->title }}</h3>
                        <h4>{{ __('general.login_your_account') }}</h4>
                        </div>

                        <div class="input-box">
                            @isset($route)
                                <form class="row g-4" method="POST" action="{{ route($route) }}">
                                @else
                                    <form class="row g-4" method="POST" action="{{ route('login') }}">
                                    @endisset
                                    @csrf
                                    <div class="col-12">
                                        <div class="form-floating theme-form-floating log-in-form">
                                            <input type="email" class="form-control" id="email"
                                                 placeholder="{{ __('general.email_address') }}" name="email">
                                            <label for="email">{{ __('general.email_address') }}</label>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-floating theme-form-floating log-in-form position-relative">
                                            <input type="password" class="form-control" id="password"
                                                placeholder="{{ __('general.password') }}" name="password">
                                    <label for="password">{{ __('general.password') }}</label>
                                            <!-- Eye Icon -->
                                            <span class="password-toggle-icon position-absolute"
                                                style="right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;">
                                                <i class="fa fa-eye" id="togglePassword"></i>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <button type="submit" class="btn btn-animation w-100 justify-content-center">
                                    {{ __('general.login') }}
                                </button>
                                    </div>
                                </form>
                        </div>
                    </div>
                </div>

                <!-- Logo Section -->
                <div class="col-xl-4 col-lg-5 text-center ms-auto d-none d-lg-block">
                    <a href="" class="logo-login"> 
                        <img src="{{ settings()->logo }}" class="img-fluid logo" alt="Logo">
                    </a>
                </div>

            </div>
        </div>
    </section>
    <!-- login section end -->

    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const isPasswordVisible = passwordInput.getAttribute('type') === 'password';

            // Toggle the type attribute
            passwordInput.setAttribute('type', isPasswordVisible ? 'text' : 'password');

            // Change the icon class
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    </script>
</body>


</html>