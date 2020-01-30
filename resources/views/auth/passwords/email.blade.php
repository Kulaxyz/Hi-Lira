<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">

    <title> FTF - Future Technologies Fund</title>
{{--    <script src="https://www.google.com/recaptcha/api.js" async defer></script>--}}
    <link rel="stylesheet" href="/css/login.min.css">
</head>

<body>
<div class="log">
    <div class="row">
        <div class="col-lg-5 d-none d-lg-flex left">
            <div class="wrap-main">
                <div id="particles-js"></div>
                <div class="wrap wrap-main">
                    <div class="logo">
                        <img src="/img/signInLogo.png" alt="">
                    </div>
                    <a href="{{route('index')}}" class="back">
                        <div class="elipse">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0)">
                                    <path
                                            d="M0.32684 12.7891L7.46884 19.9311C7.9046 20.3669 8.6113 20.3669 9.04705 19.9311C9.48289 19.4953 9.48289 18.7887 9.04705 18.3529L3.81008 13.1159L22.8841 13.1159C23.5003 13.1159 24 12.6163 24 12C24 11.3838 23.5003 10.8841 22.8841 10.8841L3.81008 10.8841L9.04687 5.64709C9.48271 5.21125 9.48271 4.50473 9.04687 4.06888C8.82904 3.85114 8.54336 3.74205 8.25777 3.74205C7.97218 3.74205 7.68659 3.85114 7.46867 4.06888L0.32684 11.2109C-0.109 11.6467 -0.109 12.3533 0.32684 12.7891Z"
                                            fill="#2775FF" />
                                </g>
                                <defs>
                                    <clipPath id="clip0">
                                        <rect width="24" height="24" fill="white" transform="translate(24 24) rotate(-180)" />
                                    </clipPath>
                                </defs>
                            </svg>
                        </div>
                        HOME PAGE
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-7 right">
            <div>
                <h2 class="title">Password recovery</h2>
                <p class="recover">To recover your password, enter the email address that you specified during registration:
                </p>
                <form method="POST" action="{{ route('password.email') }}" class="form">
                    @csrf
                    <input name="email" type="email" class="mail" placeholder="E-mail">
                    <div class="capcha">
                        <div class="g-recaptcha" data-sitekey="6LfABb8UAAAAACY7pgOvX2W9Gc3azoR1NtjxlJdc"></div>
                        <br />
                        <button class="restore">Restore password</button>
                    </div>
                </form>
                <a href="{{route('index')}}" class="bottom__text bottom__text-back">
                    << Go Back</a> </div> </div> </div> </div> <script src="/js/particles.min.js">
</script>
<script>
    particlesJS.load('particles-js', 'js/particles.json', function () {
        console.log('callback - particles.js config loaded');
    });
</script>
</body>

</html>