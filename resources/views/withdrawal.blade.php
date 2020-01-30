<!DOCTYPE html>
<html>
@component('components.head')
@endcomponent
<body>

<!-- Site -->
<header class="header-lk header-home">
    <div class="container">
        @component('components.header_logo')
        @endcomponent
        <div class="row">
            <div class="col-12">
                <div class="profile">
                    <div class="profile__balance">
                        <span>Benim denge: </span>
                        <h2>₺{{ auth()->user()->balance }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card-descr">
                    <p>Teslim süresi: 0-3 iş günü <b>Komisyon: 0%</b></p>
                    <p>İşlem başına minimum 100₺ Maksimum 8.000₺</p>
                    <p>Kart başına maksimum: günde 5 işlem, günde 23.500₺, ayda 44.000₺</p>
                    @isset($errors)
                        @foreach($errors as $error)
                            <p style="color: red; margin: 40px; font-size: 30px">{{$error}}</p>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="col-12 d-flex justify-content-center">
                <form action="{{ route('withdrawal') }}" method="post" class="card-form">
                    @csrf
                    <div class="card-form__item">
                        <input id="card" type="tel" name="number" placeholder="Kart numarası" required>
                        <div class="cards-img">
                            <img src="/img/visa.png" alt="visamaster">
                        </div>
                    </div>
                    <div class="card-form__item">
                        <input id="cardTotal" type="tel" min="100" max="8000" name="amount" placeholder="Tutar" required>
                    </div>
                    <button class="grey-bg" id="cardBtn" type="submit" disabled>Para Çekmek</button>
                </form>
            </div>
            <div class="col-12 d-flex justify-content-center">
                <a href="{{ route('wallet') }}" class="card-return">
                    <img src="/img/arr-wh.svg" alt="arrow">
                    <span>Geri dön</span>
                </a>
            </div>
        </div>
    </div>
</header>

@component('components.scripts')
@endcomponent


</body>
</html>
