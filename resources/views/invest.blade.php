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
                    <span>Tutar girin</span>
                </a>
            </div>
        </div>
    </div>
</header>

<section class="popoln-form">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form action="{{ route('pay_module_bank') }}" method="post" class="popoln-form__form">
                    @csrf
                    <div class="popoln-form__wrap">
                        <div class="popoln-form__wrap--el">₺</div>
                        <input id="num" type="number" name="num" min="1" max="4750" pattern="[0-9]*" value="500" required autofocus>
                    </div>
                    <label for="num">min: 1₺ maks: 4750₺</label>
                    <button class="grey-bg" id="numBtn" type="submit" disabled>Para yatırmak</button>
                </form>
            </div>
        </div>
    </div>
</section>

@component('components.scripts')
@endcomponent

</body>
</html>
