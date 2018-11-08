//восстановление пароля
function passRecoveryClick(){
    $('#loginForm').modal('hide');
    grecaptcha.reset();
    $('#passRecoveryModal').modal('show');
}

var corEmailPassRecovery = false;

//ввод email для вос. пароля
function passRecEmailInput(){
     $.ajax({
        type: "GET",
        url: "user_login/login.php",
        data: {
            type: "email",
            data: document.getElementById("passRecoveryEmail").value
        },
        success: function (data) {
            switch (data) {
                case '0':
                    corEmailPassRecovery = true;
                    valTxtArea("passRecoveryEmail", "passRecoveryEmailError");
                    break;
                case '1':
                    corEmailPassRecovery = false;
                    invalTxtArea("passRecoveryEmail", "passRecoveryEmailError", "Введите Email!");
                    break;
                case '2':
                    corEmailPassRecovery = false;
                    invalTxtArea("passRecoveryEmail", "passRecoveryEmailError", "Неверный формат адреса!<br>Пример верного формата -  name@mail.ru");
                    break;
                case '3':
                    corEmailPassRecovery = false;
                    invalTxtArea("passRecoveryEmail", "passRecoveryEmailError", "Подтвердите регистрацию на почте!");
                    break;
                case '4':
                    corEmailPassRecovery = false;
                    invalTxtArea("passRecoveryEmail", "passRecoveryEmailError", "Пользователь с таким Email не существует!");
                    break;
            }
        }
    });
}

//формы авторизации и регистрации начало 
var mistakes = [0, 0, 0, 0, 0];
var mistakesLogin = [0, 0];

function resetStylesSign() {
    document.getElementById("form_signup_login").className = "form-control";
    document.getElementById("form_signup_email").className = "form-control";
    document.getElementById("form_signup_pass").className = "form-control";
    document.getElementById("form_signup_pass2").className = "form-control";
    document.getElementById("form_signup_img").className = "form-control";

    $("#signup-form-login-invalid-feedback").html("");
    $("#signup-form-email-invalid-feedback").html("");
    $("#signup-form-pass-invalid-feedback").html("");
    $("#signup-form-pass2-invalid-feedback").html("");
    $("#signup-form-img-invalid-feedback").html("");
    $("#signup-form-recaptcha-invalid-feedback").html("");
    $("#errorArea").html("");
}

function userExit() {
    $.ajax({
        type: "GET",
        url: "user_login/userExit.php"
    }).done(function() {
        document.getElementById("userData").className = "d-none";
        document.getElementById("ForGuest").className = "";
        location.reload();
      });
}

$("document").ready(function () {

    //Выход пользователя
    $("#exitUserFormBig").submit(function (e) {
        e.preventDefault();
        userExit();
    });

    $("#exitUserFormSmall").submit(function (e) {
        e.preventDefault();
        userExit();
    });

    //отправка данных с формы авторизации
    $("#form_login").submit(function (e) {
        e.preventDefault();
        if (mistakesLogin == "1,1") {
            $.ajax({
                type: "GET",
                url: "user_login/login.php",
                data: {
                    login: document.getElementById("form_login_login").value
                },
                success: function (data) {
                    document.getElementById("userData").className = "container-fluid text-center";
                    $("#userData").html(data);
                    document.getElementById("buttonsForLogin").className = "d-none";
                    $('#loginForm').modal('hide'); //скрываем модальное окно  
                }
            });
        } else document.getElementById("errorAreaLogin").className = "";
    });
    
    //отправка данных для вост. пароля
    $("#passRecoveryForm").submit(function (e) {
        e.preventDefault();
        if (corEmailPassRecovery == true) {
            $.ajax({
                type: "POST",
                data: $(this).serialize(),
                url: "user_login/passRecovery.php",
                success: function (data) {
                    switch(data)
                    {
                        case '0':
                            $('#passRecoveryModal').modal('hide');
                            $('#messageBoxText').html('В течении нескольких минут на указанную вами почту придёт письмо!<br>Для восстановления пароля перейдите по ссылке в письме!');
                            $('#signupFormOk').modal('show');
                            break;
                        case '1':
                            grecaptcha.reset();
                            $('#passRecoveryRecaptchaError').html("Вы не прошли проверку!");
                            document.getElementById("errorAreaPassRecovery").className = "";
                            break;
                    }
                }
            });
        } else document.getElementById("errorAreaPassRecovery").className = "";
    });

    //отправка данных с формы регистрации
    $("#form_signup").submit(function (e) {
        e.preventDefault(); //убираем перезагрузку страницы
        if (mistakes == "1,1,1,1,1") {
            $.ajax({
                type: "POST",
                url: "user_login/signup.php",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    grecaptcha.reset(); //сброс данных grecaptcha
                    switch (data) {
                        case '0':
                            resetStylesSign();
                            document.getElementById('form_signup').reset();
                            $('#signupForm').modal('hide'); //скрываем модальное окно
                            $('#messageBoxText').html('Поздравляем, вы успешно зарегистрираны!<br>В течении нескольких минут на указанную вами почту придёт письмо!<br>Для завершения регистрациии перейдите по ссылке в письме!');
                            $('#signupFormOk').modal('show');
                            break;
                        case '1':
                            $('#signup-form-recaptcha-invalid-feedback').html("Вы не прошли проверку!");
                            break;
                    }
                }
            });
        } else document.getElementById("errorArea").className = "";
    });
    
    //отправка данных с формы изменения пароля
    $("#changePassForm").submit(function (e) {
        e.preventDefault(); //убираем перезагрузку страницы
        if (mistakes == "0,0,1,1,0") {
            $.ajax({
                type: "GET",
                url: "passChangeFinal.php",
                data: {pass: document.getElementById("form_signup_pass").value},
                success: function (data) {
                    location = location.protocol+"//"+location.hostname;//редирект на главную страницу
                }
            });
        } else document.getElementById("errorArea").className = "";
    });
    
});

//уведомления об ошибках для регистрации
function invalTxtArea(idInp, idErr, errText) {
    document.getElementById(idInp).className = "form-control is-invalid";
    document.getElementById(idErr).className = "invalid-feedback";
    $('#' + idErr).html(errText);
}

function valTxtArea(idInp, idCor) {
    document.getElementById(idInp).className = "form-control is-valid";
    document.getElementById(idCor).className = "valid-feedback";
    $('#' + idCor).html("Данные введены правильно!");
}

//проверка полей на форме авторизации
function LoginLoginChange() {
    $.ajax({
        type: "GET",
        url: "user_login/login.php",
        data: {
            type: "login",
            login: document.getElementById("form_login_login").value
        },
        success: function (data) {
            //alert(data);
            switch (data) {
                case '0':
                    mistakesLogin[0] = '1';
                    valTxtArea("form_login_login", "login-form-login-invalid-feedback");
                    break;
                case '1':
                    mistakesLogin[0] = '0';
                    invalTxtArea("form_login_login", "login-form-login-invalid-feedback", "Пользователь с таким логином не найден!");
                    break;
                case '2':
                    mistakesLogin[0] = '0';
                    invalTxtArea("form_login_login", "login-form-login-invalid-feedback", "Пожалуйста подтвердите регистрацию на почте!");
                    break;
            }
        }
    });
}

function LoginPassChange() {
    $.ajax({
        type: "GET",
        url: "user_login/login.php",
        data: {
            type: "pass",
            login: document.getElementById("form_login_login").value,
            pass: document.getElementById("form_login_pass").value
        },
        success: function (data) {
            switch (data) {
                case '0':
                    mistakesLogin[1] = '1';
                    valTxtArea("form_login_pass", "login-form-pass-invalid-feedback");
                    break;
                case '1':
                    mistakesLogin[1] = '0';
                    invalTxtArea("form_login_pass", "login-form-pass-invalid-feedback", "Пароль введён неверно!");
                    break;
            }
        }
    });
}

//проверка полей на форме регистрации
function RegLoginChange() {
    $.ajax({
        type: "GET",
        url: "user_login/signup.php",
        data: {
            type: "login",
            data: document.getElementById("form_signup_login").value
        },
        success: function (data) {
            switch (data) {
                case '0':
                    mistakes[0] = '1';
                    valTxtArea("form_signup_login", "signup-form-login-invalid-feedback");
                    break;
                case '1':
                    mistakes[0] = '0'
                    invalTxtArea("form_signup_login", "signup-form-login-invalid-feedback", "Введите логин!");
                    break;
                case '2':
                    mistakes[0] = '0';
                    invalTxtArea("form_signup_login", "signup-form-login-invalid-feedback", "Пользователь с таким логином уже существует!");
                    break;
                case '3':
                    mistakes[0] = '0';
                    invalTxtArea("form_signup_login", "signup-form-login-invalid-feedback", "Пароль должен содержать от 5 до 10 символов!");
                    break;
            }
        }
    });
}

function RegEmailChange() {
    $.ajax({
        type: "GET",
        url: "user_login/signup.php",
        data: {
            type: "email",
            data: document.getElementById("form_signup_email").value
        },
        success: function (data) {
            switch (data) {
                case '0':
                    mistakes[1] = '1';
                    valTxtArea("form_signup_email", "signup-form-email-invalid-feedback");
                    break;
                case '1':
                    mistakes[1] = '0';
                    invalTxtArea("form_signup_email", "signup-form-email-invalid-feedback", "Пользователь с таким Email уже существует!");
                    break;
                case '2':
                    mistakes[1] = '0';
                    invalTxtArea("form_signup_email", "signup-form-email-invalid-feedback", "Введите Email!");
                    break;
                case '3':
                    mistakes[1] = '0';
                    invalTxtArea("form_signup_email", "signup-form-email-invalid-feedback", "Неверный формат адреса!<br>Пример верного формата -  name@mail.ru");
                    break;
            }
        }
    });
}

function RegPassChange() {
    $.ajax({
        type: "GET",
        url: "/user_login/signup.php",
        data: {
            type: "pass",
            data: document.getElementById("form_signup_pass").value
        },
        success: function (data) {
            switch (data) {
                case '0':
                    mistakes[2] = '1';
                    valTxtArea("form_signup_pass", "signup-form-pass-invalid-feedback");
                    break;
                case '1':
                    mistakes[2] = '0';
                    invalTxtArea("form_signup_pass", "signup-form-pass-invalid-feedback", "Пароль должен содержать от 8 до 20 символов!");
                    break;
                case '2':
                    mistakes[2] = '0';
                    invalTxtArea("form_signup_pass", "signup-form-pass-invalid-feedback", "Пароль должен содержать хотя бы одну цифру!");
                    break;
                case '3':
                    mistakes[2] = '0';
                    invalTxtArea("form_signup_pass", "signup-form-pass-invalid-feedback", "Пароль не должен содержать кирилицу!");
                    break;
                case '4':
                    mistakes[2] = '0';
                    invalTxtArea("form_signup_pass", "signup-form-pass-invalid-feedback", "Пароль должен содержать хотя бы одну строчную букву!");
                    break;
                case '5':
                    mistakes[2] = '0';
                    invalTxtArea("form_signup_pass", "signup-form-pass-invalid-feedback", "Пароль должен содержать хотя бы одну прописную букву!");
                    break;
                case '6':
                    mistakes[2] = '0';
                    invalTxtArea("form_signup_pass", "signup-form-pass-invalid-feedback", "Пароль должен содержать хотя бы один специальный символ (_, #, *)!");
                    break;
                case '7':
                    mistakes[2] = '0';
                    invalTxtArea("form_signup_pass", "signup-form-pass-invalid-feedback", "Введён недопустимый символ!Пароль не должен содержать символы кроме символов английского алфавита, цифр и специальных символов (_, #, *)");
                    break;
            }
        }
    });
}

function RegPass2Change() {
    $.ajax({
        type: "GET",
        url: "/user_login/signup.php",
        data: {
            type: "pass2",
            data: document.getElementById("form_signup_pass").value,
            data2: document.getElementById("form_signup_pass2").value
        },
        success: function (data) {
            switch (data) {
                case '0':
                    mistakes[3] = '1';
                    valTxtArea("form_signup_pass2", "signup-form-pass2-invalid-feedback");
                    break;
                case '1':
                    mistakes[3] = '0';
                    invalTxtArea("form_signup_pass2", "signup-form-pass2-invalid-feedback", "Подтвердите пароль!(пробельные символы не разрешены)");
                    break;
                case '2':
                    mistakes[3] = '0';
                    invalTxtArea("form_signup_pass2", "signup-form-pass2-invalid-feedback", "Повторный пароль введён не верно!");
                    break;
            }
        }
    });
}

function RegFileChange(file) {
    $.ajax({
        type: "GET",
        url: "user_login/signup.php",
        data: {
            type: "img",
            size: file.size,
            fileType: file.type
        },
        success: function (data) {
            switch (data) {
                case '0':
                    mistakes[4] = '1';
                    valTxtArea("form_signup_img", "signup-form-img-invalid-feedback");
                    break;
                case '1':
                    mistakes[4] = '0';
                    invalTxtArea("form_signup_img", "signup-form-img-invalid-feedback", "Размер изображения не должен превышать 2-х мегабайт!");
                    break;
                case '2':
                    mistakes[4] = '0';
                    invalTxtArea("form_signup_img", "signup-form-img-invalid-feedback", "Невырный формат файла!<br>Выберите файл с расширением: png, jpeg, или jpg!");
                    break;
            }
        }
    });
}
//формы авторизации и регистрации конец 