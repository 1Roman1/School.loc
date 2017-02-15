<?php
require_once 'FUNCTIONS/index.php';
AUTH::autentificationCookies();

$connect = DB_CONNECT::getInstance();
$results = array();

if (is($_POST, array("user_email", "user_pass"))) {
    $login = AUTH::autentification($_POST['user_email'], $_POST['user_pass']);
    if (isErr($login)) $results = $login;
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Авторизация</title>
    <link rel="stylesheet" href="CSS/Reset.css">
    <link rel="stylesheet" href="bootstrap-3.3.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="CSS/autorisation.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<?php if (!AUTH::isAuth()): ?>

    <div class="container col-xs-12 col-sm-8 col-sm-push-2 col-md-4 col-md-push-4">
        <form method="post" class="form-horizontal">

            <button class="col-sm-12 btn btn-primary btn-head btn-lg hidden-xs">Школка</button>

            <h4 class="text-center autorisation-form-head col-xs-12 text-info">Авторизация</h4>

            <div class="form-group has-feedback">
                <label for="auto-mail" class="control-label col-xs-5 col-xs-push-1">
                    <p class="text-left text-muted">Почта</p>
                </label>
                <div class="col-xs-7 col-sm-6">
                    <div class="input-group">
						<span class="input-group-addon">
							<i class="glyphicon glyphicon-envelope text-muted"></i>
						</span>
                        <input type="email" class="form-control" required="required" id="auto-mail" placeholder="Введите почту" name="user_email" value="<?php if (isset($_POST['user_email'])) echo $_POST['user_email']; ?>">
                    </div>
                    <span class="glyphicon glyphicon-pencil form-control-feedback text-muted"></span>
                </div>
            </div>

            <div class="form-group has-feedback">
                <label for="auto-pass" class="control-label col-xs-5 col-xs-push-1">
                    <p class="text-left text-muted">Пароль</p>
                </label>
                <div class="col-xs-7 col-sm-6">
                    <div class="input-group">
						<span class="input-group-addon">
							<i class="glyphicon glyphicon-lock text-muted"></i>
						</span>
                        <input type="password" class="form-control" required="required" name="user_pass" value="<?php if (isset($_POST['user_pass'])) echo $_POST['user_pass']; ?>"
                               id="auto-pass" placeholder="Введите пароль">
                    </div>
                    <span class="glyphicon glyphicon-pencil form-control-feedback text-muted"></span>
                </div>
            </div>

            <!--<div class="form-group">
                <label for="check" class="control-label text-muted col-xs-5 col-xs-push-1 remember">
                    <p class="text-left">Запомнить меня</p>
                </label>
                <div class="col-xs-6">
                    <input type="checkbox" id="check" class="auto-checkbox">
                </div>
            </div>

            <div class="form-group">
                <label for="another" class="control-label text-muted col-xs-5 col-xs-push-1 another">
                    <p class="text-left another-p">Другое устройство</p>
                </label>
                <div class="col-xs-6">
                    <input type="checkbox" id="another" class="auto-checkbox">
                </div>
            </div> -->

            <?php if (isErr($results)): ?>
                <div style="text-align: center; font-size: 15px; font-family: Arial, sans-serif; color: red;"><?= $results['error'] ?></div>
            <?php endif; ?>

            <button class="btn btn-primary col-xs-12 btn-lg autorisation-enter">Вход</button>

            <div class="col-xs-12 bg-info text-muted info">
                <p class="info-p">
                    Для успешной авторизации введите данные. Вы не сможете авторизоваться если не зарегистрированны. Для регистрации пройдите по <a href="Registration.php" class="registration-link">ссылке</a>.
                </p>
                <p class="info-p">
                    Если вы используете для входа новое устройство, нажмите "Другое устройство".
                </p>
                <p class="info-p">
                    Внимание! Не доверяйте свой пароль никому!
                </p>
            </div>
        </form>
    </div>

<?php else:
    header('Location: Profile.php');
endif; ?>

<script src="jQuery/jquery-3.1.0.js"></script>
<script src="bootstrap-3.3.2-dist/js/bootstrap.min.js"></script>

</body>
</html>