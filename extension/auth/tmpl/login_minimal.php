<? if (!isset($_GET['registrations'])): ?>
    <div class="col-xl-5 col-lg-6 col-md-10 offset-md-3">
        <div class="card">
            <div class="card-body p-5">

                <h4 class="text-dark mb-5">Авторизация</h4>
                <form id="authorization" action="/jpost.php?extension=auth&action=cart" method="POST">
                    <div class="row">
                        <div class="form-group col-md-12 mb-4">
                            <input type="login" class="form-control input-lg" name="email" id="email" aria-describedby="emailHelp" type="email" placeholder="Телефон / Эл. Почта" required />
                            <div class="valid-feedback">
                                принято!
                            </div>
                        </div>
                        <div class="form-group col-md-12 ">
                            <input type="password" class="form-control input-lg" name="password" id="password" placeholder="Пароль" required />
                            <div class="valid-feedback">
                                принято!
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="d-flex my-2 justify-content-between">
                                <p><a class="text-blue" href="#">Забыли пароль?</a></p>
                            </div>
                            <div class="form_result" style="display: none;">

                            </div>
                            <button type="submit" class="btn btn-lg btn-primary btn-block mb-4">Авторизация</button>
                            <p>
                                Нет учетной записи
                                <a class="text-blue" href="?registrations">Регистрация</a>
                            </p>
                        </div> 
                    </div>
                    <input type="hidden" name="authorization" value="1" />    
                </form>
            </div>
        </div>
    </div>
<? endif; ?>

<? if (isset($_GET['registrations'])): ?>
    <div class="col-xl-5 col-lg-6 col-md-10 offset-md-3">
        <div class="card">
            <div class="card-header bg-primary">
                <div class="app-brand">
                    <a href="/">
                        <svg class="brand-icon" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" width="30"
                             height="33" viewBox="0 0 30 33">
                            <g fill="none" fill-rule="evenodd">
                                <path class="logo-fill-blue" fill="#7DBCFF" d="M0 4v25l8 4V0zM22 4v25l8 4V0z" />
                                <path class="logo-fill-white" fill="#FFF" d="M11 4v25l8 4V0z" />
                            </g>
                        </svg>
                        <span class="brand-name"><?= $_SESSION['site_name'] ?></span>
                    </a>
                </div>
            </div>
            <div class="card-body p-5">
                <h4 class="text-dark mb-5">Регистрация</h4>
                <form id="registration" action="/jpost.php?extension=auth" method="POST">
                    <div class="row">
                        <div class="form-group col-md-12 mb-4">
                            <input type="text" class="form-control input-lg phone" name="phone" id="phone" data-mask="+7 (999) 999-9999" aria-describedby="nameHelp" type="phone" placeholder="Мобильный телефон">
                        </div>
                        <div class="form-group col-md-12 mb-4">
                            <input type="email" class="form-control input-lg" name="email" id="email" aria-describedby="emailHelp" type="email" placeholder="Адрес электронной почты">
                        </div>
                        <div class="form-group col-md-12 ">
                            <input type="password" class="form-control input-lg" name="password" id="password" placeholder="Пароль">
                        </div>
                        <div class="form-group col-md-12 ">
                            <input type="password" class="form-control input-lg" name="cpassword" id="cpassword" placeholder="Повторить пароль">
                        </div>
                        <div class="col-md-12">
                            <div class="d-inline-block mr-3">
                                <label class="control control-checkbox">
                                    <input type="checkbox" id="check_indicator" name="check_indicator" value="1" />
                                    <div class="control-indicator"></div>
                                    Я согласен с условиями и положениями
                                </label>

                            </div>
                            <div class="form_result" style="display: none;">

                            </div>

                            <button type="submit" class="btn btn-lg btn-primary btn-block mb-4">Регистрация</button>
                            <p>У меня есть уже аккаунт
                                <a class="text-blue" href="./">Авторизация</a>
                            </p> 
                        </div>
                    </div>
                    <input type="hidden" name="registration" />  
                </form>

            </div>
        </div>
    </div>
<? endif; ?>




<script>
    $(function () {
        $('#authorization').sendPost(function (result) {
            //console.log("authorization ok");
        });
        $('#registration').sendPost(function (result) {
            //console.log("registration ok");
        });

        //$('.phone').mask('+7 (999) 999-9999');
    });
</script> 