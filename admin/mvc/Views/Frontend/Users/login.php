<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/css/config/helper.css">
    <link rel="stylesheet" href="./public/css/style/user.css">
    <title>LOGIN</title>
</head>
<body>
    <div id="user-app">
        <div class="user-wrap">
            <div class="user-form">
                <form method="POST" id="form-action" class="form-login">
                    <div class="form-group">
                        <input type="username" name="username" value="<?php {{ echo Validation::form_value("username"); }} ?>" class="form-control d-block" id="username" placeholder="Nhập username..." autocomplete="off" spellcheck="false">
                        <?php {{ echo Validation::form_error("username"); }} ?>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" value="<?php {{ echo Validation::form_value("password"); }} ?>" class="form-control d-block" id="password" placeholder="Nhập password..." autocomplete="off" spellcheck="false">
                        <?php {{ echo Validation::form_error("password"); }} ?>
                    </div>
                    <div class="form-group" style="margin: 5px 0;">
                        <input type="checkbox" <?php {{
                            echo !empty(Validation::form_value("remember_me")) ? "checked" : null;
                        }} ?> name="remember_me" id="remember_me">
                        <label for="remember_me" style="color: #fff;">Ghi nhớ đăng nhập</label>
                    </div>
                    <?php {{ echo Validation::form_error("login"); }} ?>
                    <button type="submit" name="loginAction" class="form-button d-block">Đăng Nhập</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>