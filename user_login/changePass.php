<?php
require_once "../connect_bd.php";
connectBd();

$login = $_GET['login_active'];
$_SESSION['login_active'] = $login;
$key = $_GET['key'];

$user = R::findOne('users', "`login` = ?", array($login));
$real_key = $user['activ_key'];//ключ сохранённый в бд
if($real_key === $key): //если ключ из бд совпадает с ключом на ссылке  ?>
    <!DOCTYPE html>
    <html lang="ru">

    <head>
        <!-- Подключаем Bootstrap styles begin -->
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <!-- Подключаем Bootstrap styles end -->

        <title>Anigo.tv - самое активное аниме сообщество!</title>
        <link rel="shortcut icon" href="/images/ico.ico" type="image/x-icon">
        <link rel="stylesheet" href="changePass.css">
    </head>

    <body>
        <form id="changePassForm">
            <div class="row w-100 m-0">
                <div class="col-md-3 p-0"></div>
                <div class="col-md-6 col-12">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-control-label">Пароль</label>
                                <input type="password" class="form-control " id="form_signup_pass" name="signup_password" oninput="RegPassChange()" required>
                                <h6 id="signup-form-pass-invalid-feedback"></h6>
                                <small class="form-text text-muted">Пароль должен содержать от 8 до 20 символов</small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-control-label">Подтверждение пароля</label>
                                <input type="password" class="form-control " id="form_signup_pass2" name="signup_password2" oninput="RegPass2Change()" required>
                                <h6 id="signup-form-pass2-invalid-feedback"></h6>
                                <small class="form-text text-muted">Повторите пароль</small>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-0">Изменить пароль</button>
                    <span class="d-none" id="errorArea">Введите корректные данные!</span>
                </div>
                <div class="col-md-3 p-0"></div>
            </div>

        </form>

        <!-- Подключаем scripts for Bootstrap begin-->
        <!-- Optional JavaScript -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js" integrity="sha384-THPy051/pYDQGanwU6poAc/hOdQxjnOEXzbT+OuUAFqNqFjL+4IGLBgCJC3ZOShY" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <!-- Подключаем scripts for Bootstrap end-->
        <script src="js/handler.js"></script>
    </body>

    </html>
    <?php endif; ?>
