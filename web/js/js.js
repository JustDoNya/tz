$(function () {
    $("#subLogin").on('click', function () {
        var msg = {
            type : "login",
            login : $('#login').val(),
            password : $('#password').val()
        }
        if($('#login').val() == "" || $('#password').val() == "")
            $(".loginForm .error").html('<b style="color: red;">Поля логин и пароль не могут быть пустыми.</b>');
        else
            Send(msg, function (result) {
                if(result.error) {
                    $(".loginForm .error").html('<b style="color: red;">'+result.error+'</b>');
                } else {
                    $(".loginForm").toggle();
                }
            });
    });

    $("#subReg").on('click',function () {
        var msg = {
            type : "checkip"
        }
        Send(msg, function (result) {
            if(result.error)
                $(".loginForm .error").html('<b style="color: red;">'+result.error+'</b>');
            else {
                $(".loginForm").toggle();
                $(".regForm").toggle();
            }
        });
    });
    $(".regForm #subReg").on('click', function () {
        var error;
        if(/[^a-zA-Z0-9]+/i.test($('.regForm #login').val()) || $('.regForm #login').val().length < 6 || $('.regForm #login').val().length > 20){
             $('#loginBox .description').css('color', 'red');
             $('#loginBox .description').css('display', 'block');
             error = true;
        } else $('#loginBox .description').css('display', 'none');
        if(/[^a-zA-Z0-9]+/i.test($('.regForm #password').val()) || $('.regForm #password').val().length < 6 || $('.regForm #password').val().length > 20){
             $('#passwordBox .description').css('color', 'red');
             $('#passwordBox .description').css('display', 'block');
             error = true;
        } else if($('.regForm #password').val() != $('.regForm #repassword').val()){
            $('#passwordBox .description').css('color', 'red');
            $('#passwordBox .description').text('* Пароли не совпадают');
            error = true;
        } else $('#passwordBox .description').css('display', 'none');
        if(!/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i.test($('.regForm #email').val())){
             $('#emailBox .description').css('color', 'red');
             $('#emailBox .description').text('* Не коректная почта, введите ее в виде example@example.com');
             $('#emailBox .description').css('display', 'block');
             error = true;
        } else $('#emailBox .description').css('display', 'none');
        if(/[^а-яА-ЯёЁ]+/i.test($('.regForm #name').val())  || $('.regForm #name').val().length < 1){
            $('#nameBox .description').css('color', 'red');
            $('#nameBox .description').text('* В поле Имя введены некоректные символы, для имение вы можете использовать кириллицу.');
            $('#nameBox .description').css('display', 'block');
            error = true;
        } else $('#nameBox .description').css('display', 'none');
        if(/[^а-яА-ЯёЁ]+/i.test($('.regForm #firstname').val())){
            $('#firstnameBox .description').css('color', 'red');
            $('#firstnameBox .description').text('* В поле Фамилия введены некоректные символы, для имение вы можете использовать кириллицу.');
            $('#firstnameBox .description').css('display', 'block');
            error = true;
        } else $('#firstnameBox .description').css('display', 'none');
        if(/[^а-яА-ЯёЁ]+/i.test($('.regForm #patronymic').val())){
            $('#patronymicBox .description').css('color', 'red');
            $('#patronymicBox .description').text('* В поле Отчество введены некоректные символы, для имение вы можете использовать кириллицу.');
            $('#patronymicBox .description').css('display', 'block');
            error = true;
        } else $('#patronymicBox .description').css('display', 'none');
        if(!/(\d{4}\-\d{2}\-\d{2})/i.test($('.regForm #bdate').val()) || $('.regForm #bdate').val().length < 1){
            $('#bdateBox .description').css('color', 'red');
            $('#bdateBox .description').text('* Необходимо заполнить дату.');
            $('#bdateBox .description').css('display', 'block');
            error = true;
        } else $('#bdateBox .description').css('display', 'none');
        if(error) $(".regForm .error").html('<b style="color: red;">Одно или несколько полей заполнены не корректно.</b>');
        else {
            var msg = {
                type : "reg",
                login : $('.regForm #login').val(),
                password : $('.regForm #password').val(),
                repassword : $('.regForm #repassword').val(),
                email : $('.regForm #email').val(),
                name : $('.regForm #name').val(),
                firstname : $('.regForm #firstname').val(),
                patronymic : $('.regForm #patronymic').val(),
                bdate : $('.regForm #bdate').val(),
                about : $('.regForm #about').val()
            }
            Send(msg,function (result) {
                if(result.error)
                    $(".regForm .error").html('<b style="color: red;">'+result.error+'</b>');
                else {
                    $(".regForm").toggle();
                }
            });
        }
    })
});

var Send = function (msg, success) {
    $.ajax({
        type: "POST",
        url: "/",
        data : msg,
        success: success
    });
}
