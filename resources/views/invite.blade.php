<!DOCTYPE html>
<html>
@component('components.head')
@endcomponent
<body>

<!-- Site -->
<header class="header-lk header-wh">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="header-sec__top-bar">
                    <a href="{{ route('wallet') }}" class="header-sec__top-bar--logo">
                        <img src="/img/logo-bck.svg" alt="Logo">
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <a href="{{ route('wallet') }}" class="return">
                    <img src="/img/lk-arr.svg" alt="arr">
                    <span>👋Bir arkadaşını davet et</span>
                </a>
            </div>
        </div>
    </div>
</header>

<section class="ref-content">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="ref-content__descr">
                    Arkadaşlarınızı davet edin ve onlar sayesinde pasif gelir elde edin! <br> <br>

                    😎 Sevdiklerinizi finansal problemlerden ve bunlarla ilgili her şeyden kurtarın, çünkü sizin için kazanan ilk yapay zekayı yarattık. <br> <br>

                    Arkadaşlarınızın her yükleme miktarının% 9'unu alacaksınız. <br> <br>

                    Sevk programı sınırsızdır, davetiyelerde sınır yoktur ve anında harekete geçmeye başlar. <br> <br>

                    Yüksek sonuçlar elde etmek için, hedef kitle arayışına dikkatlice yaklaşın: sadece bizimle ilgilenecekleri çekin. <br> <br>

                    Kullanıcıları davet etmek için benzersiz bir yönlendirme bağlantısı kullanın.
                </div>
            </div>
            <div class="col-12">
                <div class="ref-content__title">
                    Bağlantısı
                </div>
                <button class="ref-content__link" onclick="CopyToClipboard('referral')">
                    <div id="referral">{{ route('referalRegister', auth()->user()->wallet) }}</div>
                    <img src="/img/copy.svg" alt="copy">
                </button>
                <div class="ref-content__title">
                    Kazançlarınız
                </div>
                <div class="ref-content__balance">
                    {{ $amount }} ₺.
                </div>
            </div>
            <div class="col-12 d-flex justify-content-center">
                <div class="ref-content__cols">
                    <div class="ref-content__cols--item">
                        <div class="ref-content__cols--title">Tüm Arkadaşlar:</div>
                        <div class="ref-content__cols--total">{{ $count }}</div>
                    </div>
                    <div class="ref-content__cols--item">
                        <div class="ref-content__cols--title">Aktif Arkadaşlar:</div>
                        <div class="ref-content__cols--total">{{ $active }}</div>
                    </div>
                    <div class="ref-content__cols--item">
                        <div class="ref-content__cols--title">Etkin Olmayan Arkadaşlar:</div>
                        <div class="ref-content__cols--total">{{ $count - $active }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@component('components.scripts')
@endcomponent


</body>
</html>
