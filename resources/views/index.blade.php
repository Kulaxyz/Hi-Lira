<!DOCTYPE html>
<html>
@component('components.head')
@endcomponent
<body>
<!-- Pop-Up -->
<div class="mob-menu">
    <div class="mob-menu__close">
        <img id="close-menu" src="/img/close-gr.svg" alt="close">
    </div>
    <ul class="mob-menu__menu">
        <li><a href="{{ route('tech') }}">Teknolojinin</a></li>
        <li><a href="{{ route('team') }}">Takım</a></li>
        @guest
            <li id="login-btn">Oturum aç</li>
            <li id="register-btn">Hesap oluşturun</li>
        @else
            <a href="{{ route('wallet') }}">
                <li id="login-btn">Oturum aç</li>
            </a>
            <a href="{{ route('wallet') }}">
                <li id="register-btn">Hesap oluşturun</li>
            </a>
        @endguest
    </ul>
</div>
<div class="login-pop">
    <div class="form-card">
        <img id="close-login" src="/img/close-card.svg" alt="Close card">
        <h2>Oturum aç</h2>
        <div class="bg-danger error" id="loginfailedFull" style="color: red">
            <i class="fa fa-times" aria-hidden="true"></i> Bu eposta kayıtlı değil veya şifre yanlış.
        </div>
        <form id="formLogin" action="{{ route('login') }}" method="post">
            @csrf
            <input type="email" name="email" placeholder="E-posta" required>
            <input type="password" name="password" placeholder="şifre" required>
            <div class="button-item">
                <button type="submit">Oturum aç</button>
                <div class="button-item__links">
                    <div id="pas-link" class="button-item__links--item">Parolanızı mı unuttunuz?</div>
                    <div id="reg-link" class="button-item__links--item">Hesap oluşturun</div>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="reset-pop">
    <div class="form-card">
        <img id="close-reset" src="/img/close-card.svg" alt="Close card">
        <h2>Eni Şifre</h2>
        <div class="bg-danger error" id="resetfailedFull" style="color: red">
            <i class="fa fa-times" aria-hidden="true"></i> Bu eposta kayıtlı değil veya şifre yanlış.
        </div>
        <form action="" id="resetForm" method="POST" class="form">
            @csrf
            <input type="hidden" name="token" value="{{ $token ?? null }}">

            <input name="email" type="email" id="regEmail" readonly="true" class="mail" placeholder="E-posta" value="{{ $email ?? null }}" required>

            <input id="regPassword" type="password" name="password" placeholder="Şifre" required>
            <input id="confPassword" type="password" name="password_confirmation" placeholder="Şifre Onayı" required>

            <div class="button-item">
                <button type="submit">Kaydet</button>
            </div>
        </form>
    </div>
</div>

<div class="register-pop">
    <div class="form-card">
        <img id="close-register" src="/img/close-card.svg" alt="Close card" style="color: red">
        <h2>Hi Lira'da ilk kez mi?</h2>
        <div class="bg-danger error" id="registerfailedFull" style="color: red">
        </div>
        <form id="formRegister" action="{{ route('register') }}" method="post">
            @csrf
            <input id="regEmail" type="email" name="email" placeholder="E-posta" required>
            <input id="regName" type="text" name="name" placeholder="Ad" required>
            <input id="regPassword" type="password" name="password" placeholder="Şifre" required>
            <input id="confPassword" type="password" name="password_confirmation" placeholder="Şifre Onayı" required>
            <div class="button-item">
                <button id="regBtn" type="submit">
                    <span>Hesap oluşturun</span>
                    <small>ücretsiz 5₺ almaktır</small>
                </button>
            </div>
        </form>
    </div>
</div>

<div class="password-pop">
    <div class="form-card">
        <img id="close-pas" src="/img/close-card.svg" alt="Close card">
        <h2>Parolanızı mı unuttunuz?</h2>
        <div id="emailFailedFull" style="color: red">
            Bu eposta kayıtlı değil
        </div>
        <form action="" id="formEmail">
            @csrf
            <input type="email" name="email" placeholder="E-posta" required>
            <div class="button-item">
                <button type="submit">Kaydet</button>
                <div class="button-item__links">
                    <div id="login-link" class="button-item__links--item">Oturum aç</div>
                    <div id="reg-link-pas" class="button-item__links--item">Hesap oluşturun</div>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Site -->
<header class="header">
    <div id="particles-js"></div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="header__top-bar">
                    <a href="/" class="header__top-bar--logo">
                        <img src="/img/logo.svg" alt="Logo">
                    </a>
                    <nav class="header__top-bar--menu d-none d-lg-block">
                        <ul>
                            <li><a href="{{ route('tech') }}">Teknolojinin</a></li>
                            <li>|</li>
                            <li><a href="{{ route('team') }}">Takım</a></li>
                            <li>|</li>
                            @guest
                                <li id="login-btn3" class="li-link">Oturum aç</li>
                                <li>|</li>
                                <li id="register-btn3" class="li-link">Hesap oluşturun</li>
                            @else
                                <a href="{{ route('wallet') }}">
                                    <li  class="li-link">Oturum aç</li>
                                </a>
                                <li>|</li>
                                <a href="{{ route('wallet') }}">
                                    <li class="li-link">Hesap oluşturun</li>
                                </a>
                            @endguest
                        </ul>
                    </nav>
                    <img id="burger" class="d-lg-none" src="/img/menu.svg" alt="Menu">
                </div>
            </div>
            <div class="col-12">
                <div class="header__title">
                    Hi Lira<br>İnsanlar için Yapay Zekadır
                </div>
            </div>
            <div class="col-12">
                <div class="header__buttons">
                    @guest
                        <div id="login" class="header__buttons--item">
                            Oturum aç
                        </div>
                        <div id="register" class="header__buttons--item">
                            Hesap oluşturun
                        </div>
                    @else
                        <div class="header__buttons--item">
                            <a style="padding: 20px 35px 20px 35px;" href="{{ route('wallet') }}">
                                Oturum aç
                            </a>
                        </div>
                        <div class="header__buttons--item">
                            <a style="padding-top: 20px;padding-bottom: 20px;" href="{{ route('wallet') }}">
                                Hesap oluşturun
                            </a>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</header>

<section class="win">
    <div class="container-fluid">
        <div class="row">
            <div class="col-3 col-md-2 pl-0 pr-0">
                <div class="win__title"></div>
            </div>
            <div class="col-9 col-md-10 pl-0 pr-0">
                <div class="win__content">
                    <div class="win__card">
                        <h2>Kazanmaya başlamak 26 saniye sürecek ve Yapay Zeka sizin için düşündükten sonra</h2>
                        <div id="register-btn4" class="win__card--button btn-hover">
                            <img class="img-hover" src="/img/link-gr.svg" alt="link">
                            <span>Hesap oluşturun</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="team">
    <div class="container">
        <div class="row">
            <div class="col-12 col-xl-6">
                <div id="typing" class="team__title"></div>
            </div>
            <div class="col-12 col-xl-6">
                <div class="team__descr">
                    Hi Lira,️ her saniyede bir borsada işlem gören bağımsız bir Yapay Zekadır ve mesleki gelişim ekibi fonların adil dağılımına kayıtsız değildir.
                    Günlük yüzde değişir 0.001% 2,3% sayısına bağlı olarak başarılı operasyonlar yapay zeka.
                    Ödemeler günlük olarak zaman sınırı olmaksızın, her zaman, uzun bir süre için, sonsuz olarak yapılır.
                </div>
                <div id="register-btn2" class="team__button btn-hover">
                    <img class="img-hover" src="/img/link-gr.svg" alt="link">
                    <span>Hesap oluşturun</span>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="news">
    <div class="container">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-10">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="news__card">
                                <div class="news__card--title">27 Aralık 2019</div>
                                <div class="news__card--descr">
                                    Türk hükümeti, ülkenin "Hi lira" olarak adlandırılan devlet vatandaşlarının yaşam kalitesini artırmak olan benzersiz bir yapay zeka sunar.                                </div>
                            </div>
                            <div class="news__arrow-next d-flex d-lg-none">
                                <div class="count">01/02</div>
                                <img id="next" src="/img/arrow-next.svg" alt="next">
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <a href="https://telegra.ph/Hi-Lira-d%C3%BCnyan%C4%B1n-en-b%C3%BCy%C3%BCk-yapay-zeka-konferans%C4%B1na-kat%C4%B1ld%C4%B1-01-15" class="news__card">
                                <div class="news__card--title">17 Aralık 2019</div>
                                <div class="news__card--descr">
                                    Hi Lira yapay zeka alanındaki projelerini dünyadaki en büyük NeurIPS konferansında sundu.  Yapay zeka ve veri analizi alanındaki gelişmeler, bankanın AI, Google, Facebook, Amazon vb.Gibi dünya liderleriyle birlikte konferansın ortağı olmasına izin verdi.
                                </div>
                                <span>
										<img src="/img/link-gr.svg" alt="News Link">
									</span>
                            </a>
                            <div class="news__arrow-next d-flex d-lg-none">
                                <img id="prev" src="/img/arrow-prev.svg" alt="prev">
                                <div class="count">02/02</div>
                            </div>
                        </div>
                    </div>
                    <!-- Add Arrows -->
                    <!-- <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div> -->
                </div>

            </div>
            <div class="col-12">

            </div>
        </div>
    </div>
</section>

<section class="team-sec">
    <div class="container-fluid">
        <div class="row">
            <div class="col-2 pl-0 pr-0">
                <div class="team-sec__title"></div>
            </div>
            <div class="col-10 pl-0 pr-0">
                <div id="video" class="team-sec__content" data-vide-bg="mp4: /video/video">
                    <div class="team-sec__card">
                        <h2>Takım HI Lira AI. Yapay Zekayı daha rahat ve verimli hale getiren yenilikler sunar ve kendi çözümlerini oluşturur.</h2>
                        <a href="{{ route('team') }}" class="team-sec__card--button btn-hover">
                            <span>Takim</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@component('components.footer')
@endcomponent
@component('components.scripts')
@endcomponent
<script>
    var swiper = new Swiper('.swiper-container', {
        slidesPerView: 2,
        spaceBetween: 30,
        navigation: {
            nextEl: '#next',
            prevEl: '#prev',
        },
        breakpoints: {
            991: {
                slidesPerView: 1,
                spaceBetween: 40,
            },
        }
    });
</script>
@yield('scripts')
</body>
</html>
