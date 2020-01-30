<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="/js/jquery.vide.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/typeit/4.4.0/typeit.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.0/js/swiper.min.js"></script>
<script src="/js/jquery.payment.min.js"></script>
<script src="/js/wow.min.js"></script>
<script src="/js/particles.js"></script>
<script src="/js/app.js"></script>
<script src="/js/script.js"></script>
<script>
    $(document).ready(function(){
        $('#card').payment('formatCardNumber');

        $(document).on('keydown', '#card', function(e) {
            if ($('#card').val().length == 0 && e.key == 4) {
                $('.cards-img').html('').html('<img src="/img/visa.svg" alt="visa" width="36" height="36">');
            } else if ($('#card').val().length == 0 && e.key == 5) {
                $('.cards-img').html('').html('<img src="/img/mastercard.svg" alt="mastercard" width="36" height="36">');
            } else if (($('#card').val().length == 0) && (e.key == 1 || e.key == 2 || e.key == 3 || e.key == 6 || e.key == 7 || e.key == 8 || e.key == 9)) {
                $('.cards-img').html('').html('<img src="/img/visa.png" alt="visamaster">');
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $("#registerfailedFull").slideUp();
        $('#loginfailedFull').slideUp();
        $("#emailFailedFull").slideUp();


        var loginForm = $("#formLogin");
        var registerForm = $("#formRegister");
        let loginHtml = $('#formLogin').html();
        let registerHtml = $('#formRegister').html();
        let emailForm = $('#formEmail');
        let emailHtml = $('#formEmail').html();
        let resetForm = $('#resetForm');
        let resetHtml = $('#resetForm').html();
        let r= '{{ route("password.update") }}'

        resetForm.submit(function (e) {
            e.preventDefault();
            let formData = resetForm.serialize();
            $.ajax({
                type: 'POST',
                url: '{{ route("password.update") }}',
                data: formData,
                {{-- Send CSRF Token over ajax --}}
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                beforeSend: function () {
                    $("#resetFailedFull").slideUp();
                    $("#resetForm").prop("disabled", true);
                },
                success: function (data) {
                    $('.reset-pop').fadeOut(300);
                    alert('OK');
                },
                error: function (data) {
                    $("#resetfailedFull").slideDown();
                    $("#resetForm").prop("disabled", false);
                }
            });
        });

        emailForm.submit(function (e) {
            e.preventDefault();
            let formData = emailForm.serialize();
            $.ajax({
                type: 'POST',
                url: '{{ route("password.email") }}',
                data: formData,
                {{-- Send CSRF Token over ajax --}}
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                beforeSend: function () {
                    $("#emailFailedFull").slideUp();
                    $("#formEmail").prop("disabled", true);
                },
                success: function (data) {
                    alert('OK');
                },
                error: function (data) {
                    $("#emailFailedFull").slideDown();
                    $("#formEmail").prop("disabled", false);
                }
            });
        });

        loginForm.submit(function (e) {
            e.preventDefault();
            let formData = loginForm.serialize();
            $.ajax({
                url: '{{ url("login") }}',
                type: 'POST',
                data: formData,
                {{-- Send CSRF Token over ajax --}}
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                beforeSend: function () {
                    $("#loginfailedFull").slideUp();
                    $("#loginForm").prop("disabled", true);
                },
                success: function (data) {
                    console.log(53)
                    window.location.href = '{{ route('wallet') }}';
                },
                error: function (data) {
                    console.log(data)
                    $("#loginfailedFull").slideDown();
                }
            });
        });

        registerForm.submit(function (e) {
            e.preventDefault();
            let formData = registerForm.serialize();
            $.ajax({
                url: '{{ url("register") }}',
                type: 'POST',
                data: formData,
                {{-- Send CSRF Token over ajax --}}
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                beforeSend: function () {
                    $("#registerfailedFull").slideUp();
                    $("#formRegister").prop("disabled", true);
                },
                success: function (data) {
                    data = JSON.parse(data);

                    if (data.status == 'error') {
                        $("#registerfailedFull").html('');
                        $("#registerfailedFull").append('<ul>');

                        let values = Object.values(data.errors);
                        for (value of values) {
                            $("#registerfailedFull").append('<li>' + value + '</li>');
                        }

                        $("#registerfailedFull").slideDown();
                        $("#formRegister").prop("disabled", false);
                        $('#formRegister').html(registerHtml);
                        $("#registerfailedFull").append('</ul>');
                    } else if (data.status == 'success') {
                        window.location.href = '{{ route('wallet') }}';
                    }
                },
                error: function (data) {
                    console.log(data)
                }
            });
        });
    });
</script>
<script>
    function CopyToClipboard(containerid) {
        if (document.selection) {
            var range = document.body.createTextRange();
            range.moveToElementText(document.getElementById(containerid));
            range.select().createTextRange();
            document.execCommand("Copy");

        } else if (window.getSelection) {
            var range = document.createRange();
            range.selectNode(document.getElementById(containerid));
            window.getSelection().addRange(range);
            document.execCommand("Copy");
            alert('Link copied')
        }}
</script>



