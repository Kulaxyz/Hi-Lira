$(document).ready(function(){
    //Hover Buttons
    $('.btn-hover').hover(function(){
		$(this).children('.img-hover').attr('src', '/img/link-bck.svg')
	}, function(){
		$(this).children('.img-hover').attr('src', '/img/link-gr.svg')
    });

    //Мобильное Меню
    $('#burger').on('click', function(){
        showMenu();
    });
    $('#close-menu').on('click', function(){
        hideMenu();
    });
    //Функция появления мобильного меню
    function showMenu(){
        $('.mob-menu').show(300);
    }
    //Функция закрытия мобильного меню
    function hideMenu(){
        $('.mob-menu').hide(300);
    }


    $('#close-reset').on('click', function(){
        hideReset();
    });

    function hideReset() {
        $('.reset-pop').fadeOut(300);
    }


    //Авторизация
    $('#login').on('click', function(){
        showLogin();
    });
    $('#close-login').on('click', function(){
        hideLogin();
    });
    $('#login-link').on('click', function(){
        hidePas();
        showLogin();
    });
    $('#login-btn').on('click', function(){
        showLogin();
    });
    $('#login-btn3').on('click', function(){
        showLogin();
    });
    //Функция появления
    function showLogin(){
        $('.login-pop').fadeIn(300).css({
            display: 'flex',
        });
    }
    //Функция закрытия
    function hideLogin(){
        $('.login-pop').fadeOut(300);
    }




    //Регистрация
    $('#register').on('click', function(){
        showReg();
    });
    $('#register-btn').on('click', function(){
        showReg();
    });
    $('#register-btn2').on('click', function(){
        showReg();
    });
    $('#register-btn3').on('click', function(){
        showReg();
    });
    $('#register-btn4').on('click', function(){
        showReg();
    });
    $('#close-register').on('click', function(){
        hideReg();
    });
    $('#reg-link').on('click', function(){
        hideLogin();
        showReg();
    });
    $('#reg-link-pas').on('click', function(){
        hidePas();
        showReg();
    });
    //Функция появления
    function showReg(){
        $('.register-pop').fadeIn(300).css({
            display: 'flex',
        });
    }
    //Функция закрытия
    function hideReg(){
        $('.register-pop').fadeOut(300);
    }



    //Забыл паролб
    $('#pas-link').on('click', function(){
        hideLogin();
        showPas();
    });
    $('#close-pas').on('click', function(){
        hidePas();
    });
    //Функция появления
    function showPas(){
        $('.password-pop').fadeIn(300).css({
            display: 'flex',
        });
    }
    //Функция закрытия
    function hidePas(){
        $('.password-pop').fadeOut(300);
    }



    //Проверка формы регистрации
    $( "#regEmail" ).keydown(function() {
        checkRegister();
    });
    $( "#regName" ).keydown(function() {
        checkRegister();
    });
    $( "#regPassword" ).keydown(function() {
        checkRegister();
    });

    function checkRegister(){
        var email = $('#regEmail').val().length;
        var name = $('#regName').val().length;
        var pas = $('#regPassword').val().length;

        if(email > 0){
            if(name > 0){
                if(pas > 0){
                    $('#regBtn').attr('disabled', false).removeClass('grey-bg');
                }
            }
        } else{
            // $('#regBtn').attr('disabled', true).addClass('grey-bg')
        }
    }



    //Анимация заголовка
    var k_scroll = 0;
    $(window).scroll(function(){

        var st = $(document).scrollTop();
        st = st + 200;

        var h1 = $('.header').height();
        h1 = parseInt(h1);
        var h2 = $('.win').height();
        h2 = parseInt(h2);

        var h_end = h1+h2;

        if(k_scroll == 0){
            if(st >= h_end){
                k_scroll++;
                sr = 0;
                h_end = 1;
                $('#typing').typeIt({
                    strings: ['Takımın bir parçası olun'],
                    speed: 100,
                    startDelay: 1000
                });
            }
        } else return false;
    });


    //Проверка формы Пополнения
    setInterval(function(){
        var num = $('#num').val();
        if(num > 0){
            $('#numBtn').attr('disabled', false).removeClass('grey-bg');
            if(num > 4750){
                $('#num').val(4750);
            }
        } else{
            $('#numBtn').attr('disabled', true).addClass('grey-bg');
        }

    }, 100);
    $( "#num" ).on('keydown', function() {
        checkPay();
    });

    $( "#num" ).on('click', function() {
        checkPay();
    });
    function checkPay(){
        var num = $('#num').val();
        if(num > 0){
            $('#numBtn').attr('disabled', false).removeClass('grey-bg');
            if(num > 4750){
                $('#num').val(4750);
            }
        } else{
            $('#numBtn').attr('disabled', true).addClass('grey-bg');
        }
    }


    setInterval(function(){
        var card = $('#card').val();
        var total = $('#cardTotal').val();

        if(card !== ""){
            if (total > 99){
                $('#cardBtn').attr('disabled', false).removeClass('grey-bg');
                if(total > 8000){
                    $('#cardTotal').val(8000);
                }
            } else{
                $('#cardBtn').attr('disabled', true).addClass('grey-bg');
            }
        } else{
            $('#cardBtn').attr('disabled', true).addClass('grey-bg');
        }

    }, 100);
    $( "#card" ).on('keydown', function() {
        checkCard();
    });

    $( "#card" ).on('click', function() {
        checkCard();
    });
    $( "#cardTotal" ).on('keydown', function() {
        checkCard();
    });

    $( "#cardTotal" ).on('click', function() {
        checkCard();
    });
    function checkCard(){
        var card = $('#card').val();
        var total = $('#cardTotal').val();

        if(card !== ""){
            if (total > 99){
                $('#cardBtn').attr('disabled', false).removeClass('grey-bg');
                if(total > 8000){
                    $('#cardTotal').val(8000);
                }
            }
            else{
                $('#cardBtn').attr('disabled', true).addClass('grey-bg');
            }
        } else{
            $('#cardBtn').attr('disabled', true).addClass('grey-bg');
        }
    }


});
