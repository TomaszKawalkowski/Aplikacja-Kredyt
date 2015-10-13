$(document).on('ready', function () {
    $('.anime').toggle(1500, function () {
    });


    $('#register_email').blur(function () {
        var emailajax = $('#register_email').val();
        $.post("ajax_register.php", {emailajax: emailajax})
            .done(function (data) {
                if (data == 'true') {
                    alert("Podany adres email juz istnieje w bazie uzytkownikow !!!");
                }

            });
    });

    $('#register_name').blur(function () {
        var nameajax = $('#register_name').val();
        $.post("ajax_register.php", {nameajax: nameajax})
            .done(function (data) {
                if (data == 'true') {
                    alert("Uzytkownik o takiej nazwie juz w bazie istnieje !!!");
                }

            });
    });

    $('#password2').blur(function () {
        var password = $('#password').val();
        var password2 = $('#password2').val();

        if (password != password2) {
            // $('body').toggle('bounce', {times: 3}, "slow");
            alert("Haslo potwierdzajace niezgodne z podanym haslem !!!");

        }


    });

    $('#submitlog').one('click', function (event) {
        event.preventDefault();

        $('.logform').show(2000);
        $('#Nick')[0].focus();
    });
});
