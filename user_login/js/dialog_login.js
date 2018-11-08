//форма авторизации
$('#loginForm').modal({
    backdrop: "static",//запрежаем закрытие при клике вне фоомы мышью
    show: false
});

//форма регистрации
$('#signupForm').modal({
    backdrop: "static",//запрежаем закрытие при клике вне фоомы мышью
    show: false
});

//модальное окно для уведомления пользователя о успешной регистрации
$('#signupFormOk').modal({
    backdrop: "static",//запрежаем закрытие при клике вне фоомы мышью
    show: false
});

//модальное окно для отправки письма на вост. пароля
$('#passRecoveryModal').modal({
    backdrop: "static",//запрежаем закрытие при клике вне фоомы мышью
    show: false
});