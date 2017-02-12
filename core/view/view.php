<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title><?=$title?></title>
        <link rel="stylesheet" href="/css/main.css">
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="/js/js.js"></script>
    </head>
    <body>
        <div class="layer">
            <div class="loginForm" id="loginForm">
                <div class="error"></div>
                <input class="input" id="login" type="text" placeholder="Логин">
                <input class="input" id="password" type="password" placeholder="Пароль">
                <div class="sub">
                    <div class="subLogin left" id="subLogin">Вход</div>
                    <div class="subLogin right" id="subReg">Регистрация</div>
                </div>
            </div>

            <div class="regForm" id="regForm">
                <div class="error"></div>
                <div id="loginBox" style="overflow: hidden;">
                    <div class="left" style="width:200px;">
                        <input class="input" id="login" type="text" placeholder="Логин">
                    </div>
                    <div class="description right">
                        <b style="color: red;">*</b> Логин може содержать маленькие латинкие буквы и цифры, а также быть длинее 6 и короче 20 символов.
                    </div>
                </div>
                <div id="passwordBox" style="overflow: hidden;">
                    <div class="left" style="width:200px;">
                        <input class="input" id="password" type="password" placeholder="Пароль">
                        <input class="input" id="repassword" type="password" placeholder="Повторите пароль">
                    </div>
                    <div class="description right">
                        <b style="color: red;">*</b> Пароль может содержать цифры, большие и маленькие буквы, и быть длинее 6 и короче 20 символов.
                    </div>
                </div>
                <div id="emailBox" style="overflow: hidden;">
                    <div class="left" style="width: 200px;">
                        <input class="input" id="email" type="email" placeholder="Почта">
                    </div>
                    <div class="description right">
                        <b style="color: red;">*</b>
                    </div>
                </div>
                <hr>
                <div id="nameBox" style="overflow: hidden;">
                    <div class="left" style="width:200px;">
                        <input class="input" id="name" type="text" placeholder="Имя">
                    </div>
                    <div class="description right">
                        <b style="color: red;">*</b>
                    </div>
                </div>
                <div id="firstnameBox" style="overflow: hidden;">
                    <div class="left" style="width:200px;">
                        <input class="input" id="firstname" type="text" placeholder="Фамилия">
                    </div>
                    <div class="description right">

                    </div>
                </div>
                <div id="patronymicBox" style="overflow: hidden;">
                    <div class="left" style="width:200px;">
                        <input class="input" id="patronymic" type="text" placeholder="Отчество">
                    </div>
                    <div class="description right">

                    </div>
                </div>
                <div id="bdateBox"style="overflow: hidden;">
                    <div class="left" style="width:200px;">
                        <input class="input" id="bdate" type="date">
                    </div>
                    <div class="description right">
                        <b style="color: red;">*</b>
                    </div>
                </div>
                <textarea class="input about" id="about" name="about">Информация о себе</textarea>
                <div class="subLogin" id="subReg">Регистрация</div>
            </div>
        </div>
    </body>
</html>
