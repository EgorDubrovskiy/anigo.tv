<?php
require_once  ''.$_SERVER['DOCUMENT_ROOT'].'/connect_bd.php';
connectBd();

include 'vk_api/const.php';
?>
    <link rel="stylesheet" href="user_login/main.css">
    <link rel="stylesheet" href="user_login/leftPop-upMenu.css">

    <!-- Блок для авторизованного пользователя -->
    <div id="userData" class="d-none">
        <div class="container-fluid pl-0 pr-0 pt-2 d-none d-xl-block">
            <div class="row">
                <!-- выводим первое слово логина (имя) -->
                <div class="w-100 mb-1 text-uppercase"><b><?php echo $_SESSION['user_login'] ?></b></div>
            </div>
            <div class="row">
                <div class="w-100 user_ava"><img class="rounded w-100" src="<?php echo $_SESSION['user_img'] ?>" class="w-100" alt="аватарка"></div>
            </div>
            <div class="row">
                <div class="w-100">
                    <form id="exitUserFormBig" method="GET">
                        <button type="submit" name="exit" class="btn btn-danger pl-0 pr-0 ml-0 w-100 text-uppercase mt-xl-1 exitUser"><b>Выйти</b></button>
                    </form>
                </div>
            </div>
        </div>

        <!-- для маленького экрана -->
        <div class="userDataForSmallScrean d-xl-none">
            <!-- выводим первое слово логина (имя) -->
            <div class="userLogin">
                <?php echo $_SESSION['user_login'] ?>
            </div>
            <form id="exitUserFormSmall" class="exitUserForm" method="GET">
                <button type="submit" name="exit" class="btn pl-0 pt-0 pb-0 pr-0 ml-0 exitUser">
                    <img src="images/user_login/userExit.png" alt="выйти" class="w-100">
                </button>
            </form>
        </div>
    </div>

    <!-- кнопки для перехода к ригистрации или авторизации начало-->
    <div id="ForGuest" class="d-none">

        <div class="buttonOnHeader" id="buttonsForLogin">
            <div class="btn-group d-none d-md-block mr-3 mt-3">
                <div class="btn-group-verticale pl-0 pr-0">
                    <div class="btn btn-danger pl-0 pr-0 ml-0 w-100 text-uppercase mb-2" data-toggle="modal" data-target="#signupForm">Регистрация</div>
                    <div class="btn btn-danger pl-0 pr-0 ml-0 w-100 text-uppercase" data-toggle="modal" data-target="#loginForm">Авторизация</div>
                </div>
                <a href="https://oauth.vk.com/authorize?client_id=<?=ID?>&display=page&redirect_uri=<?=URL?>&response_type=code"><img src="user_login/vk_api/vk.png" class="vk_login_img">
            </a>
            </div>
            <!-- для маленького экрана -->
            <div class="d-md-none" id="buttonForLoginSmallScr">
                <img src="images/user_login/login_man.png" alt="нажмите для вывода вариантов">
                <button type="button" class="btn p-0" title="авторизация через вк">
                <a href="https://oauth.vk.com/authorize?client_id=<?=ID?>&display=page&redirect_uri=<?=URL?>&response_type=code"><img src="images/user_login/login_vk.png" alt="через вк">
                </a>
            </button>
                <button type="button" class="btn p-0" data-toggle="modal" data-target="#signupForm" title="регистрация">
                <img src="images/user_login/login_signup.png" alt="регистрация">
            </button>
                <button type="button" class="btn p-0" data-toggle="modal" data-target="#loginForm" title="вход">
                <img src="images/user_login/login_login.png" alt="вход">
            </button>
            </div>
            <!-- кнопки для перехода к ригистрации или авторизации конец-->
        </div>
        <!-- модальное окно для авторизаци начало-->
        <div class="modal fade" id="loginForm" tabindex="-1" role="dialog" aria-labelledby="loginForm" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Авторизация</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span><!-- крестик -->
                    </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <form id="form_login">
                                <div class="form-group" id="login-form-group-login">
                                    <label class="form-control-label">Логин</label>
                                    <input type="text" class="form-control" id="form_login_login" name="login" oninput="LoginLoginChange()" required>
                                    <h6 id="login-form-login-invalid-feedback"></h6>
                                    <small class="form-text text-muted">Имя указанное при регистрации</small>
                                </div>
                                <div class="form-group" id="login-form-group-password">
                                    <label class="form-control-label">Пароль</label>
                                    <input type="password" class="form-control" id="form_login_pass" name="password" oninput="LoginPassChange()" required>
                                    <h6 id="login-form-pass-invalid-feedback"></h6>
                                    <small class="form-text text-muted">Пароль должен содержать от 8 до 20 символов</small>
                                </div>
                                <button type="submit" class="btn btn-primary mr-0">Войти</button>
                                <img src="images/user_login/passRecovery.png" title="восстановление пароля" onclick="passRecoveryClick()" alt="восстановление пароля" id="passRecovery">
                                <span class="d-none" id="errorAreaLogin">Введите корректные данные!</span>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- модальное окно для авторизаци конец-->

        <!-- модальное окно для регистрации начало-->
        <div class="modal fade" id="signupForm" tabindex="-1" role="dialog" aria-labelledby="signupForm" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Регистрация</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span><!-- крестик -->
                    </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <form id="form_signup">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="form-group" id="signup-form-group-login">
                                            <label class="form-control-label">Логин</label>
                                            <input type="text" class="form-control " id="form_signup_login" name="signup_login" oninput="RegLoginChange()" required>
                                            <h6 id="signup-form-login-invalid-feedback"></h6>
                                            <small class="form-text text-muted">Имя на сайте (никнейм)</small>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="form-group" id="signup-form-group-email">
                                            <label class="form-control-label">Адрес e-mail</label>
                                            <input type="email" class="form-control " id="form_signup_email" name="email" oninput="RegEmailChange()" required>
                                            <h6 id="signup-form-email-invalid-feedback"></h6>
                                            <small class="form-text text-muted">Адрес почты для подтверждения регистрации</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="form-group" id="signup-form-group-password">
                                            <label class="form-control-label">Пароль</label>
                                            <input type="password" class="form-control " id="form_signup_pass" name="signup_password" oninput="RegPassChange()" required>
                                            <h6 id="signup-form-pass-invalid-feedback"></h6>
                                            <small class="form-text text-muted">Пароль должен содержать от 8 до 20 символов</small>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="form-group" id="signup-form-group-password2">
                                            <label class="form-control-label">Подтверждение пароля</label>
                                            <input type="password" class="form-control " id="form_signup_pass2" name="signup_password2" oninput="RegPass2Change()" required>
                                            <h6 id="signup-form-pass2-invalid-feedback"></h6>
                                            <small class="form-text text-muted">Повторите пароль</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group" id="signup-form-group-img">
                                            <label class="form-control-label">Аватарка</label>
                                            <input type="file" class="form-control-file " id="form_signup_img" name="image" onchange="RegFileChange(this.files[0])" required>
                                            <h6 id="signup-form-img-invalid-feedback"></h6>
                                            <small class="form-text text-muted">Графическое представление пользователя</small>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-lg-6">
                                        <div id="signup-form-group-recaptcha">
                                            <div id="recaptchaSignup" class="g-recaptcha" data-sitekey="6Le2GEIUAAAAAGxyBovGwSsXIbbESr_00ywIckBv"></div>
                                            <h6 id="signup-form-recaptcha-invalid-feedback"></h6>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary mr-0">Регистрация</button>
                                <span class="d-none" id="errorArea">Введите корректные данные!</span>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- модальное окно для регистрации конец-->

        <!-- модальное окно для уведомления пользователя-->
        <div class="modal fade" id="signupFormOk" tabindex="-1" role="dialog" aria-labelledby="signupFormOk" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <h5 class="modal-title" id="messageBoxText"></h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12"><button type="button" class="btn btn-primary w-100" data-dismiss="modal" aria-label="Close">ок</button></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- модальное окно для отправки письма на восстановление пароля -->
        <div class="modal fade" id="passRecoveryModal" tabindex="-1" role="dialog" aria-labelledby="passRecoveryModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Восстановление пароля</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span><!-- крестик -->
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="passRecoveryForm">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-control-label">Адрес почты для восстановления пароля</label>
                                        <input type="email" id="passRecoveryEmail" class="form-control" oninput="passRecEmailInput()" name="email" required>
                                        <h6 id="passRecoveryEmailError"></h6>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div>
                                        <div id="g-recaptcha-response" class="g-recaptcha" data-sitekey="6Le2GEIUAAAAAGxyBovGwSsXIbbESr_00ywIckBv"></div>
                                        <h6 id="passRecoveryRecaptchaError"></h6>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mr-0">Отправить письмо</button>
                            <span class="d-none" id="errorAreaPassRecovery">Введите корректные данные!</span>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- если пользователь вошол на сайт -->
    <?php if(isset($_SESSION['user_login'])): ?>
    <script>
        document.getElementById("userData").className = "container-fluid text-center";

    </script>

    <!-- для гостя -->
    <?php else : ?>
    <script>
        document.getElementById("ForGuest").className = "";
    </script>
    <?php endif; ?>
