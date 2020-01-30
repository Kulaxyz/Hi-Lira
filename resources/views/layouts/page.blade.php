<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="msvalidate.01" content="ED2AC3638A3F01806DDD3F29B0318B19" />
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <title>{{env('APP_NAME')}}</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/reset.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/intlTelInput.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/responsive.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/owl.carousel.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/style_add.css') }}">
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script type="text/javascript">/*preloader*/ // $(document).ready(function() {setTimeout(function(){var preloader=document.getElementById('page_preloader');if(!preloader.classList.contains('loaded')){preloader.classList.add('loaded');}},1000);});</script>
    <script type="text/javascript" src="https://js.stripe.com/v3/"></script>
    <!-- Yandex.Metrika counter -->
    <script type="text/javascript" >
        (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
            m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
        (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

        ym(56464744, "init", {
            clickmap:true,
            trackLinks:true,
            accurateTrackBounce:true,
            webvisor:true
        });
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/56464744" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->
</head>
<body>
<!-- Start: preloader --> <!-- <div id="page_preloader" class="page_preloader"><div id="page_loader" class="page_loader"></div></div> --> <!-- End: preloader -->
{{--    <header>--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="logo col-md-4"><a href="/"><img src="{{ asset('images/common/logo.svg') }}" alt=""></a></div>--}}
{{--                <ul class="main-menu desktop col-md-8">--}}
{{--                    @auth--}}
{{--                    <li><a href="{{route('wallet')}}">Wallet</a></li>--}}
{{--                    @else--}}
{{--                    <li><a href="{{ route('login') }}">Wallet</a></li>--}}
{{--                    @endauth--}}
{{--                    <li><a href="{{route('media')}}">Media</a></li>--}}
{{--                    <li><a href="{{route('learn')}}">Learn</a></li>--}}
{{--                    <li><a href="{{route('paper')}}">White paper</a></li>--}}
{{--                    @auth--}}
{{--                    <!-- <li><a href="{{route('referal')}}">Invite friends</a></li> -->--}}
{{--                    <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log out</a></li>--}}
{{--                    @else--}}
{{--                    <li><a class="scroll-it" href="{{ route('login') }}">Log in</a></li>--}}
{{--                    @endauth--}}
{{--                </ul>--}}
{{--                <div class="menu-block mobile col-md-8"><div class="mobile-menu"></div></div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </header>--}}
<header style="box-shadow: none !important;">
    <div class="container d-flex align-items-center"style="display: flex">
        <a href="{{ route('index') }}" class="logo"><img src="/images/logo.svg" alt=""></a>
        <a href="{{ route('index') }}" class="tomain">Main</a>
    </div>
</header>

{{--    <div class="mobile-menu-block">--}}
{{--        <div class="container">--}}
{{--            <div class="row top">--}}
{{--                <div class="logo col-md-4"><a href="{{route('index')}}"><img src="{{ asset('images/common/logo-white.svg') }}" alt=""></a></div>--}}
{{--                <div class="close-block col-md-8"><div class="mobile-menu-close">&times;</div></div>--}}
{{--            </div>--}}
{{--            <ul class="main-menu">--}}
{{--                <li><a href="{{route('wallet')}}">Wallet</a></li>--}}
{{--                <li><a href="{{route('media')}}">Media</a></li>--}}
{{--                <li><a href="{{route('learn')}}">Learn</a></li>--}}
{{--                <li><a href="{{route('paper')}}">White paper</a></li>--}}
{{--                @auth--}}
{{--                <!--  <li><a href="{{route('referal')}}">Invite friends</a></li> -->--}}
{{--                @endauth--}}
{{--            </ul>--}}
{{--            <ul class="user-menu">--}}
{{--                @auth--}}
{{--                <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log out</a></li>--}}
{{--                @else--}}
{{--                <li><a href="{{ route('index') }}">Log in</a></li>--}}
{{--                @endauth--}}
{{--                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>--}}
{{--            </ul>--}}
{{--        </div>--}}
{{--    </div>--}}
    @yield('content')
{{--    <div class="modal" id="modal" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static">--}}
{{--        <div class="modal-dialog" role="document">--}}
{{--            <div class="modal-content">--}}
{{--                <div class="modal-body">--}}
{{--                    <div class="login-code-block">--}}
{{--                        <button style="visibility: hidden;" type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                            <span aria-hidden="true">&times;</span>--}}
{{--                        </button>--}}
{{--                        <div class="logo"><img src="{{ asset('images/common/logo.svg') }}" alt=""></div>--}}
{{--                        <form id="login-code-form" method="POST">--}}
{{--                            <div class="label">--}}
{{--                                Please enter a <b>one time secret code</b> that was sent to your phone--}}
{{--                            </div>--}}
{{--                            <div class="form-input">--}}
{{--                                <input type="text" name="login-code" placeholder="Secret code">--}}
{{--                                @csrf--}}
{{--                                <!--<div class="refresh-button">resend the code</div>-->--}}
{{--                            </div>--}}
{{--                            <div class="form-button">--}}
{{--                                <button type="submit">Login</button>--}}
{{--                            </div>--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                    <div class="result-block hidden">--}}
{{--                        <button style="visibility: hidden;" type="button" class="close hidden" data-dismiss="modal" aria-label="Close">--}}
{{--                            <span aria-hidden="true">&times;</span>--}}
{{--                        </button>--}}
{{--                        <div class="result-icon success">--}}
{{--                        </div>--}}
{{--                        <div class="result-text">You have successfully registered and can now participate in the pre-sale</div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    --}}{{-- here was a code-block which is now in index.blade and is tagged as "from page.blade " --}}

{{--    <div class="modal" id="video-modal" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static">--}}
{{--        <div class="modal-dialog" role="document">--}}
{{--            <div class="modal-content">--}}
{{--                <div class="modal-body">--}}
{{--                    <button  style="visibility: hidden;" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>--}}
{{--                    <div class="video-container"><iframe frameborder="0" allowfullscreen="1" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" title="YouTube video player" width="100%" height="100%" src=""></iframe></div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    <script src="{{ asset('js/tether.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/wow.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.js') }}"></script>
    <script src="{{ asset('js/intlTelInput.min.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script async src="https://app.appzi.io/bootstrap/bundle.js?token=U91aP"></script>

    <script src="https://www.googletagmanager.com/gtag/js?id=UA-144167679-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'UA-144167679-1');
    </script>
    @stack('scripts')
</body>
</html>
