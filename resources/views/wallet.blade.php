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
                    <div class="profile__image">
                        <img src="/img/profile.png" alt="Profile img">
                    </div>
                    <div class="profile__id">
                        Benim ıd: {{$wallet}}
                    </div>
                    <div class="profile__balance">
                        <span>Benim denge: </span>
                        @php
                        if (isset($balance)) {
                            $thous = floor($balance/1000);
                            $hunds = floor(($balance % 1000) / 100);
                            $dozns = floor(($balance % 100) /10);
                            $units = floor($balance % 10);
                        }
                        @endphp
                        <h2 style="font-size: 22px !important; margin-bottom: -6px;" id="int_balance">₺{{ $thous .'.'.$hunds.''.$dozns.''.$units  }}</h2>
                        <span style="font-size: 14px !important; opacity: 1" id="floating_balance">,{{ explode('.', $balance - floor($balance))[1] }}</span>
                        <input type="hidden" id="current_balance" readonly value="{{ $balance }}">
                    </div>
                </div>
            </div>
        </div>
        <div class="row pages-link">
            <div class="col-12 d-flex justify-content-center">
                <a class="fs" href="{{ route('invest') }}">
                    <p>Para yatırmak</p>
                </a>
            </div>
            <div class="col-12 d-flex justify-content-center">
                <a href="{{ route('withdrawal') }}">
                    <img src="/img/money.svg" alt="money">
                    <p>Para Çekmek</p>
                </a>
            </div>
            <div class="col-12 d-flex justify-content-center">
                <a href="{{ route('history') }}">
                    <img src="/img/refresh.svg" alt="refresh">
                    <p>işlem geçmişi</p>
                </a>
            </div>
            <div class="col-12 d-flex justify-content-center">
                <a href="{{ route('referral') }}">
                    <img src="/img/hand.png" alt="hand">
                    <p>Arkadaşını Davet et</p>
                </a>
            </div>
            {{--            <div class="col-12 d-flex justify-content-center">--}}
            {{--                <a href="#">--}}
            {{--                    <img src="/img/head.png" alt="head">--}}
            {{--                    <p>‍Yardım</p>--}}
            {{--                </a>--}}
            {{--            </div>--}}
            @if(auth()->user()->role_id == 1)
                <div class="col-12 d-flex justify-content-center">
                    <a href="{{ route('coefs') }}">
                        <p>Coefficients</p>
                    </a>
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <a  onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();" class="logout">
                    <img src="/img/logout.svg" alt="logout" width="16" height="16">
                    <span>Oturumu kapat</span>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </a>
            </div>
        </div>
    </div>
</header>

@component('components.scripts')
@endcomponent
<script>
    let update_balance = function () {
        $.get('{{ route('get_balance') }}', function (new_balance) {
            let current_balance = $('#current_balance').val();
            if (current_balance != new_balance) {

                let int_bal = new_balance.split('.')[0];
                let float_bal = new_balance.split('.')[1];
                let units = Math.floor(int_bal %10);
                let dozens = Math.floor((int_bal %100) / 10);
                let hundreds = Math.floor((int_bal %1000)/100);
                int_bal = Math.floor(int_bal / 1000) +'.'+hundreds+''+dozens+''+units
                console.log(units, dozens, hundreds)
                $('#int_balance').text('₺'+int_bal)
                $('#floating_balance').text(','+float_bal)
                $('#current_balance').val(new_balance)

                $('#int_balance').animate({fontSize: 24}, 300);
                $('#floating_balance').animate({fontSize: 16}, 300);

                $('#int_balance').css({color: "#a5ff72"});
                $('#floating_balance').css({color: "#a5ff72"});

                $('#int_balance').animate({fontSize: 22}, 300);
                $('#floating_balance').animate({fontSize: 14}, 300);

                setTimeout(function () {
                    $('#int_balance').css('color', '#ffffff')
                    $('#floating_balance').css('color', '#ffffff')
                }, 600)

            }
        });
    };

    $(document).ready(function () {
        setInterval(update_balance, 1000*5);
    })
</script>
</body>
</html>
