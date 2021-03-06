<!DOCTYPE html>
<html>
@component('components.head')
@endcomponent
<body>

<!-- Site -->
<header class="header-sec">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="header-sec__top-bar">
                    <a href="/" class="header-sec__top-bar--logo">
                        <img src="/img/logo.svg" alt="Logo">
                    </a>
                    <a href="/">
                        <img src="/img/close-page.svg" alt="Close page">
                    </a>
                </div>
            </div>
        </div>
        <div class="row slider">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 slider__counter">
                                    01/04
                                </div>
                                <div class="col-12 col-md-6 slider__title">
                                    Hi lira nedir?  - Milyonlarca kullanıcı ve ülkenin talep ettiği bir teknoloji.
                                </div>
                                <div class="col-12 col-md-6">
                                    <ul class="slider__elements">
                                        <li>Hi Lira, her saniyede bir borsada işlem gören ve günde bir milyardan fazla işlem yapan bağımsız bir Yapay Zeka'dır. Bu, dünyadaki fonların adil dağılımı kayıtsız olmayan bir profesyonel geliştirme ekibi.</li>
                                    </ul>
                                </div>
                                <div class="col-12">
                                    <div class="slider__arrows first">
                                        <div class="slider__arrows--wrap next">
                                            <span>Borsaların analizi</span>
                                            <img src="/img/arrow-next.svg" alt="Next">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 slider__counter">
                                    02/04
                                </div>
                                <div class="col-12 col-md-6 slider__title">
                                    Borsaların analizi - dünya borsalarının kapsamlı analizi için bir teknoloji
                                </div>
                                <div class="col-12 col-md-6">
                                    <ul class="slider__elements">
                                        <li>Yapay Zeka, yatırımcıların güven sermayesini yöneterek borsa ve OTC piyasalarını dikkatle analiz eder. Lira sonsuz pasif gelir elde edebilir ve müşteri için çalışır.</li>
                                        <li>Kötü anlaşmaların tespiti ve önlenmesi.</li>
                                    </ul>
                                </div>
                                <div class="col-12">
                                    <div class="slider__arrows">
                                        <div class="slider__arrows--wrap prev">
                                            <img src="/img/arrow-prev.svg" alt="Next">
                                            <span>Hi lira nedir?</span>
                                        </div>
                                        <div class="slider__arrows--wrap next">
                                            <span>Sistemin temelleri</span>
                                            <img src="/img/arrow-next.svg" alt="Next">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 slider__counter">
                                    03/04
                                </div>
                                <div class="col-12 col-md-6 slider__title">
                                    Sistemin temelleri ve diğerlerinden farkı
                                </div>
                                <div class="col-12 col-md-6">
                                    <ul class="slider__elements">
                                        <li>Bu sistemin temelleri basitlik ve erişilebilirliktir.</li>
                                        <li>Hi Lira ve diğer herhangi bir güven yönetimi arasındaki temel fark, sistemin yatırımcının karını katkısının büyüklüğüne göre otomatik olarak hesaplamasıdır - hatalar ve gecikmeler ortadan kaldırılır. Ödemeler günlük olarak zaman sınırı olmaksızın, her zaman, uzun bir süre için, sonsuz olarak yapılır.</li>
                                    </ul>
                                </div>
                                <div class="col-12">
                                    <div class="slider__arrows">
                                        <div class="slider__arrows--wrap prev">
                                            <img src="/img/arrow-prev.svg" alt="Next">
                                            <span>Borsaların analizi</span>
                                        </div>
                                        <div class="slider__arrows--wrap next">
                                            <span>Güvenlik ve ödemeler </span>
                                            <img src="/img/arrow-next.svg" alt="Next">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 slider__counter">
                                    04/04
                                </div>
                                <div class="col-12 col-md-6 slider__title">
                                    Güvenlik ve ödemeler
                                </div>
                                <div class="col-12 col-md-6">
                                    <ul class="slider__elements">
                                        <li>Ödemeler günlük olarak zaman sınırı olmaksızın yapılır: her zaman, uzun bir süre, sonsuz !!!  Ayrıca, sistem son derece güvenli platformuna dayanır - verilerinizin ve işlemlerinizin güvenliği her zaman güvenilir koruma altında olacaktır!</li>
                                    </ul>
                                </div>
                                <div class="col-12">
                                    <div class="slider__arrows last">
                                        <div class="slider__arrows--wrap prev">
                                            <img src="/img/arrow-prev.svg" alt="Next">
                                            <span>Sistemin temelleri</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
@component('components.footer')
@endcomponent
@component('components.scripts')
@endcomponent
<script>
    var swiper = new Swiper('.swiper-container', {
        navigation: {
            nextEl: '.next',
            prevEl: '.prev',
        },
    });
</script>

</body>
</html>
