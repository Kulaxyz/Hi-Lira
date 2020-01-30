<!DOCTYPE html>
<html>
@component('components.head')
@endcomponent
<body style="background: #000;">

<!-- Site -->
<header class="header-lk header-bc">
    <div class="container">
        @component('components.header_logo')
        @endcomponent
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <a href="{{ route('wallet') }}" class="return">
                    <img src="/img/arr-wh.svg" alt="arr">
                    <span>Işlem Geçmişi</span>
                </a>
            </div>
        </div>
    </div>
</header>

<section class="pays">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="pays__card">
                    @foreach($transactions as $transaction)
                        <div class="pays__card--item">
                            <div class="date">
                                {{ $transaction->created_at->toDayDateTimeString() }}
                            </div>
                            <div class="info">
                                @if($transaction->type == 'out')
                                <div class="status">Para Çekmek</div>
                                @else
                                    <div class="status">Para Yarıtmak</div>
                                @endif
                                <div class="price">{{ $transaction->amount }} ₺</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

@component('components.scripts')
@endcomponent

</body>
</html>
