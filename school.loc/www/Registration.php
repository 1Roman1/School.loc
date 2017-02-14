<?php
require_once 'FUNCTIONS/index.php';
AUTH::autentificationCookies();
if (isset($_GET['logout'])) AUTH::logout();

$connect = DB_CONNECT::getInstance();
$results = array();

if (is($_POST, array("user_email", "user_first_name", "user_second_name", "user_date_birth", "user_country", "user_city", "user_school", "user_school", "user_class", "user_pass", "user_repeat_pass"))) {
  $register = AUTH::registration($_POST['user_email'], $_POST['user_first_name'], $_POST['user_second_name'], $_POST['user_date_birth'], $_POST['user_country'], $_POST['user_city'], $_POST['user_school'], $_POST['user_class'], $_POST['user_pass'], $_POST['user_repeat_pass']);
  if (isErr($register)) $results = $register;
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Регистрация</title>
  <link rel="stylesheet" href="CSS/Reset.css">
  <link rel="stylesheet" href="bootstrap-3.3.2-dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="CSS/registration.css">
  <script src="jQuery/jquery-3.1.0.js"></script>
  <script src="bootstrap-3.3.2-dist/js/bootstrap.min.js"></script>
  <script src="jQuery/jquery.maskedinput.min.js"></script>
</head>
<body>

<?php if (!AUTH::isAuth()): ?>

  <div class="registration container col-xs-12 col-sm-8 col-sm-push-2 col-md-4 col-md-push-4">
    <div class="registration-content">
      <div class="registration-header">
        <a href="/">
          <button class="col-sm-12 btn btn-primary btn-lg hidden-xs reg-head-btn">
            Регистрация
          </button>
        </a>
        <h4 class="text-info text-center reg-head">Регистрация</h4>
      </div>

      <div class="reg-body">
        <form method="post" class="form-horizontal">
          <div class="form-group has-feedback">
            <label for="reg-mail" class="control-label col-xs-3 col-xs-push-1">
              <p class="text-left text-muted">Почта</p>
            </label>
            <div class="col-xs-8">
              <div class="input-group">
								<span class="input-group-addon">
									<i class="glyphicon glyphicon-envelope text-muted"></i>
								</span>
                <input type="email" class="form-control" required="required" name="user_email" value="<?php if (isset($_POST['user_email'])) echo $_POST['user_email']; ?>"
                       placeholder="Введите почту" id="reg-mail">
              </div>
              <span class="glyphicon glyphicon-pencil form-control-feedback text-muted"></span>
            </div>
          </div>

          <div class="form-group has-feedback">
            <label for="reg-name" class="control-label col-xs-3 col-xs-push-1">
              <p class="text-left text-muted">Имя</p>
            </label>
            <div class="col-xs-8">
              <div class="input-group">
								<span class="input-group-addon">
									<i class="glyphicon glyphicon-user text-muted"></i>
								</span>
                <input type="text" class="form-control" required="required" name="user_first_name" value="<?php if (isset($_POST['user_first_name'])) echo $_POST['user_first_name']; ?>"
                       placeholder="Введите Имя" id="reg-name">
              </div>
              <span class="glyphicon glyphicon-pencil form-control-feedback text-muted"></span>
            </div>
          </div>

          <div class="form-group has-feedback">
            <label for="reg-surname" class="control-label col-xs-3 col-xs-push-1">
              <p class="text-left text-muted">Фамилия</p>
            </label>
            <div class="col-xs-8">
              <div class="input-group">
								<span class="input-group-addon">
									<i class="glyphicon glyphicon-user text-muted"></i>
								</span>
                <input type="text" class="form-control" required="required" name="user_second_name" value="<?php if (isset($_POST['user_second_name'])) echo $_POST['user_second_name']; ?>"
                       placeholder="Введите фамилию" id="reg-surname">
              </div>
              <span class="glyphicon glyphicon-pencil form-control-feedback text-muted"></span>
            </div>
          </div>

          <div class="form-group has-feedback">
            <label for="reg-surname" class="control-label col-xs-3 col-xs-push-1">
              <p class="text-left text-muted">Дата</p>
            </label>
            <div class="col-xs-8">
              <div class="input-group">
								<span class="input-group-addon">
									<i class="glyphicon glyphicon-user text-muted"></i>
								</span>
                <input type="text" class="form-control" required="required" name="user_date_birth" value="<?php if (isset($_POST['user_date_birth'])) echo $_POST['user_date_birth']; ?>"
                       placeholder="Введите дату рождения" id="reg-date">
              </div>
              <span class="glyphicon glyphicon-pencil form-control-feedback text-muted"></span>
            </div>
          </div>

          <div class="form-group has-feedback">
            <label for="reg-country" class="control-label col-xs-3 col-xs-push-1">
              <p class="text-left text-muted">Страна</p>
            </label>
            <div class="col-xs-8">
              <div class="input-group">
								<span class="input-group-addon">
									<i class="glyphicon glyphicon-globe text-muted"></i>
								</span>
                <input type="text" class="form-control" required="required" name="user_country" value="<?php if (isset($_POST['user_country'])) echo $_POST['user_country']; ?>"
                       placeholder="Укажите страну" id="reg-country">
              </div>
              <span class="glyphicon glyphicon-pencil form-control-feedback text-muted"></span>
            </div>
          </div>

          <div class="form-group has-feedback">
            <label for="reg-city" class="control-label col-xs-3 col-xs-push-1">
              <p class="text-left text-muted">Город</p>
            </label>
            <div class="col-xs-8">
              <div class="input-group">
								<span class="input-group-addon">
									<i class="glyphicon glyphicon-globe text-muted"></i>
								</span>
                <input type="text" class="form-control" required="required" name="user_city" value="<?php if (isset($_POST['user_city'])) echo $_POST['user_city']; ?>"
                       placeholder="Укажите город" id="reg-city">
              </div>
              <span class="glyphicon glyphicon-pencil form-control-feedback text-muted"></span>
            </div>
          </div>

          <div class="form-group has-feedback">
            <label for="reg-school" class="control-label col-xs-3 col-xs-push-1">
              <p class="text-left text-muted">Школа</p>
            </label>
            <div class="col-xs-8">
              <div class="input-group">
								<span class="input-group-addon ">
									<i class="glyphicon glyphicon-home text-muted"></i>
								</span>
                <input type="text" class="form-control" required="required" name="user_school" value="<?php if (isset($_POST['user_school'])) echo $_POST['user_school']; ?>"
                       placeholder="Укажите школу" id="reg-school">
              </div>
              <span class="glyphicon glyphicon-pencil form-control-feedback text-muted"></span>
            </div>
          </div>

          <div class="form-group has-feedback">
            <label for="reg-class" class="control-label col-xs-3 col-xs-push-1">
              <p class="text-left text-muted">Класс</p>
            </label>
            <div class="col-xs-8">
              <div class="input-group">
								<span class="input-group-addon">
									<i class="glyphicon glyphicon-font text-muted"></i>
								</span>
                <input type="text" class="form-control" required="required" name="user_class" value="<?php if (isset($_POST['user_class'])) echo $_POST['user_class']; ?>"
                       placeholder="Укажите номер и букву (08-а) (10-а)" id="reg-class">
              </div>
              <span class="glyphicon glyphicon-pencil form-control-feedback text-muted"></span>
            </div>
          </div>

          <div class="form-group has-feedback">
            <label for="reg-pass" class="control-label col-xs-3 col-xs-push-1">
              <p class="text-left text-muted">Пароль</p>
            </label>
            <div class="col-xs-8">
              <div class="input-group">
								<span class="input-group-addon">
									<i class="glyphicon glyphicon-lock text-muted"></i>
								</span>
                <input type="password" class="form-control" required="required" name="user_pass" value="<?php if (isset($_POST['user_pass'])) echo $_POST['user_pass']; ?>"
                       placeholder="Введите пароль" id="reg-pass">
              </div>
              <span class="glyphicon glyphicon-pencil form-control-feedback text-muted"></span>
            </div>
          </div>

          <div class="form-group has-feedback">
            <label for="reg-check" class="control-label col-xs-3 col-xs-push-1">
              <p class="text-left text-muted">Пароль</p>
            </label>
            <div class="col-xs-8">
              <div class="input-group">
								<span class="input-group-addon">
									<i class="glyphicon glyphicon-lock text-muted"></i>
								</span>
                <input type="password" class="form-control" required="required" name="user_repeat_pass" value="<?php if (isset($_POST['user_repeat_pass'])) echo $_POST['user_repeat_pass']; ?>"
                       placeholder="Повторите пароль" id="reg-check">
              </div>
              <span class="glyphicon glyphicon-pencil form-control-feedback text-muted"></span>
            </div>
          </div>

          <?php if (isErr($results)): ?>
            <div style="text-align: center; font-size: 15px; font-family: Arial, sans-serif; color: red;" ;><?= $results['error'] ?></div>
          <?php endif; ?>

          <button class="btn btn-primary btn-lg col-xs-12 reg-sign">
            Зарегистрироваться
          </button>
        </form>
      </div>
    </div>
  </div>
<?php else:
    header("Location: Profile.php")
    ?>
<?php endif; ?>

<script>
  jQuery(function ($) {
    $("#reg-date").mask("99.99.9999", {placeholder: "дд.мм.гггг"});
    $("#reg-class").mask("99-а");
  });
</script>

</body>
</html>