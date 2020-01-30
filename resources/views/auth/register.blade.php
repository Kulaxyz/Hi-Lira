<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> FTF - Future Technologies Fund</title>
    <link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="/css/login.min.css">
{{--    <script src="https://www.google.com/recaptcha/api.js" async defer></script>--}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
<div class="log">
    <div class="row">
        <div class="col-lg-5 d-none d-lg-flex left">
            <div class="wrap-main">
                <div id="particles-js"></div>
                <div class="wrap">
                    <div class="logo">
                        <img src="{{asset('images/signInLogo.png')}}" alt="">
                    </div>
                    <a href="{{ route('index') }}" class="back">
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
                <h2 class="title">REGISTRATION</h2>
                <form action="{{route('register')}}" method="post" class="form form-2">
                    @csrf
                    @method('post')
                    <label for="name" class="error" id="wrongName"></label>
                    <input id="name" name="name" type="text" class="name" placeholder="Name" value="{{old('name')}}"
                           @error('name')
                           data-error="true"
                           @enderror
                           required>
                    <label for="surname" class="error" id="wrongSurname"></label>
                    <input id="surname" name="surname" type="text" class="surname" placeholder="Surname"
                           @error('surname')
                           data-error="true"
                           @enderror
                           value="{{old('surname')}}" required>
                    <label for="email" class="error" id="wrongMail"></label>
                    <input name="email" type="email" id="email" class="mail" placeholder="E-mail" value="{{old('email')}}"
                        @error('email')
                            data-error='true'
                        @enderror
                    required id="mail-error">

                    <label for="passw1" class="error" id="wrongPass"></label>
                    <input name="password" type="password" id="passw1" class="password" placeholder="Password"
                       @error('password')
                         data-error='true'
                       @enderror
                       required>
                    <input name="password_confirmation" type="password" id="passw2" class="password"
                       @error('password-confirm')
                           data-error="true"
                       @enderror
                       placeholder="The password again " required>
                    <label for="phoneNumb" class="error" id="wrongPhone"></label>
                    <input name="phone" type="text" class="phone" placeholder="Phone number " value="{{old('phone')}}"
                       @error('phone')
                           data-error="true"
                       @enderror
                       id="phoneNumb" required>

{{--                    <div class="capcha">--}}
{{--                        <div class="g-recaptcha" data-sitekey="6LfABb8UAAAAACY7pgOvX2W9Gc3azoR1NtjxlJdc"></div>--}}
{{--                        <br />--}}
{{--                    </div>--}}

                    <div class="check">
                        <input type="checkbox" id="checkbox" required>
                        <label id='label' for="checkbox" class="checkbox">
                            I agree to the <a href="./rules.html"> terms </a> of using the Future Technologies Fund service
                        </label>
                    </div>
                    <button type="submit" class="register">
                        REGISTER
                    </button>
                </form>
                <a href="{{ route('index') }}" class="bottom__text bottom__text-back">
                    << Go Back</a> </div> </div> </div> </div>
<script src="./js/particles.min.js">
</script>
{{--<script>--}}
{{--    particlesJS.load('particles-js', 'js/particles.json', function () {--}}
{{--        console.log('callback - particles.js config loaded');--}}
{{--    });--}}
{{--</script>--}}
<script>
    let inp = document.querySelector('#phoneNumb');

    // Проверяем фокус
    inp.addEventListener('focus', _ => {
        // Если там ничего нет или есть, но левое
        if (!/^\+\d*$/.test(inp.value)) {
            inp.value = '+';
        }
        // То вставляем знак плюса как значение
    });

    inp.addEventListener('keypress', e => {
        // Отменяем ввод не цифр
        if (!/\d/.test(e.key))
            e.preventDefault();
    });



    let pas1 = document.querySelector('#passw1')
    let pas2 = document.querySelector('#passw2')
    let email = document.querySelector('#email')
    let phone = document.querySelector('#phoneNumb')
    let name = document.querySelector('#name')
    let surname = document.querySelector('#surname')


    let labelMail = document.querySelector('#wrongMail')
    let labelPass = document.querySelector('#wrongPass')
    let labelPhone = document.querySelector('#wrongPhone')
    let labelName = document.querySelector('#wrongName')
    let labelSurname = document.querySelector('#wrongSurname')


    document.addEventListener("DOMContentLoaded", function(event) {

        let pasError = pas1.getAttribute('data-error')
        let emailError = email.getAttribute('data-error')
        let phoneError = phone.getAttribute('data-error')
        let nameError = name.getAttribute('data-error')
        let surnameError = surname.getAttribute('data-error')

        if (emailError == 'true') {
            labelMail.innerHTML = 'Mail error'
            email.classList.add('error-input')
            return false
        } else {
            labelMail.innerHTML = ''
            email.classList.remove('error-input')
        }
        if (phoneError == 'true') {
            labelPhone.innerHTML = 'Phone error, correct format is: +XXX-XXX-XXXX (without dashes)'
            phone.classList.add('error-input')
            return false
        } else {
            labelPhone.innerHTML = ''
            phone.classList.remove('error-input')
        }

        if (nameError == 'true') {
            labelName.innerHTML = 'Name error'
            name.classList.add('error-input')
            return false
        } else {
            labelName.innerHTML = ''
            name.classList.remove('error-input')
        }
        if (surnameError == 'true') {
            labelSurname.innerHTML = 'Surname error'
            surname.classList.add('error-input')
            return false
        } else {
            labelSurname.innerHTML = ''
            surname.classList.remove('error-input')
        }


        if (pasError == 'true') {
            console.log(labelPass, pasError)
            labelPass.innerHTML = 'Passwords don`t match'
            pas1.classList.add('error-input')
            pas2.classList.add('error-input')
            return false
        } else {
            labelPass.innerHTML = ''
            pas1.classList.remove('error-input')
            pas2.classList.remove('error-input')
        }
    });
 </script>
</body>


</html>
