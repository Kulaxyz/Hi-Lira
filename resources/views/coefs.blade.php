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
                <div class="card-descr">
                    <h1>Coefficients, %</h1>
                    @isset($errors)
                        @foreach($errors as $error)
                            <p style="color: red; margin: 40px; font-size: 30px">{{$error}}</p>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="col-12 d-flex justify-content-center">
                <form action="{{ route('coefs') }}" method="post" class="card-form">
                    @csrf
                    <label>
                        <p>Minimal Coefficient:</p>
                        <div class="card-form__item">
                            <input type="tel" name="min_coef" placeholder="Min Coefficient" value="{{$min}}" required>
                        </div>
                    </label>
                    <label>
                        <p>Maximum Coefficient:</p>
                        <div class="card-form__item">
                            <input type="tel" name="max_coef" placeholder="Max Coefficient" required value="{{$max}}">
                        </div>
                    </label>
                    <button type="submit">Save</button>
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
