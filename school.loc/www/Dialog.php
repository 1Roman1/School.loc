<?php
require_once 'FUNCTIONS/index.php';
AUTH::autentificationCookies();

if (isset($_GET['sel'])) {
    $sel = intval($_GET['sel']);
} else {
    exit();
}

if (isset($_POST['message'])) {
    $message = $_POST['message'];
    $results = MESS::addMess($sel, $message);
}

$user_1 = USER::getUserInfo($_SESSION['user_id']);
$user_2 = USER::getUserInfo($sel);
$dialog_info = MESS::getDialogInfo($sel);
?>

<!DOCTYPE html>
<html>
<head>
  <meta name="vewport" content="width=device-width, initial-scale-1.0">
  <meta charset="UTF-8">
  <link rel="stylesheet" href="CSS/Reset.css">
  <link rel="stylesheet" href="bootstrap-3.3.2-dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="CSS/profile.css">
  <link rel="stylesheet" href="CSS/dialog.css">
  <script src="jQuery/jquery-3.1.0.js"></script>
  <script src="bootstrap-3.3.2-dist/js/bootstrap.min.js"></script>
  <script src="js/ava.js"></script>
  <title>Диалог</title>
</head>
<body>
<div class="col-xs-12 container">
  <div class="profile-header col-xs-12">
      <?php require_once 'block/top_block.php' ?>
  </div>

  <!-- Левая колонка -->
  <div class="profile-body">
      <?php require_once 'block/left_block.php'; ?>
  </div>
</div>

<!-- Диалоговое окно -->
<div class="col-xs-6 col-xs-offset-3 dialog">
  <div class="dialog-head col-xs-12">
    <span class="remove"><i class="glyphicon glyphicon-remove"></i></span>
    <div class="col-xs-12 text-muted text-center">
      <a href="" class="user name"><?= $user_2['user_first_name'] . " " . $user_2['user_second_name']; ?></a>
    </div>
  </div>

  <div class="col-xs-12 dialog-content">
      <?php if (isErr($dialog_info)): ?>
        <div class="col-xs-4 text-muted">
            <?= $dialog_info['error']; ?> <!-- Сообщение, что нет сообщений  .. Или любая другая ошибка в виде текста -->
        </div>
      <?php else: ?>
        <div class="dialog-body col-xs-12">
            <?php foreach ($dialog_info['data'] as $dialog): ?>
              <div class="col-xs-1 ava-block">
                <a href=""><img src="<?= $dialog['user_avatar']; ?>" alt="ava" class="ava"></a>
              </div>
              <div class="col-xs-11">
                <a><?= $dialog['user_first_name'] . " " . $dialog['user_second_name']; ?></a>
              </div>
              <div class="col-xs-11">
                <p class="text-muted message"><?= $dialog['message'] ?></p>
              </div>
            <?php endforeach; ?>
        </div>
      <?php endif; ?>
  </div>

  <div class="dialog-footer col-xs-12">
    <form method="post">
      <div class="input-group">
        <!--
                  <div class="input-group-btn dropup">
            <button class="btn btn-primary dropdown-toggle"
                    data-toggle="dropdown" title="Прикрепить">
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li class="news-add-li">
                    <input type="file" class="file" id="news-add-photo">
                    <label for="news-add-photo" class="text-muted">
                        <i class="glyphicon glyphicon-camera text-muted"></i>
                        <small>Выберите фото</small>
                    </label>
                </li>
                <li class="news-add-li">
                    <input type="file" class="file" id="news-add-gif">
                    <label for="news-add-gif" class="text-muted">
                        <i class="glyphicon glyphicon-film text-muted"></i>
                        <small>Выберите гиф</small>
                    </label>
                </li>
                <li class="news-add-li">
                    <input type="file" class="file" id="news-add-video">
                    <label for="news-add-video" class="text-muted">
                        <i class="glyphicon glyphicon-facetime-video"></i>
                        <small>Выберите видео</small>
                    </label>
                </li>
                <li class="news-add-li">
                    <input type="file" class="file" id="news-add-audio">
                    <label for="news-add-audio" class="text-muted">
                        <i class="glyphicon glyphicon-music"></i>
                        <small>Выберите аудио</small>
                    </label>
                </li>
                <li class="news-add-li">
                    <input type="file" class="file" id="news-add-doc">
                    <label for="news-add-doc" class="text-muted">
                        <i class="glyphicon glyphicon-file"></i>
                        <small>Выберите документ</small>
                    </label>
                </li>
            </ul>
        </div>
        -->
        <input type="text" class="form-control" name="message" placeholder="Введите сообщение">
        <span class="input-group-btn">
						<button type="submit" class="btn btn-primary">Отправить</button>
					</span>
      </div>
    </form>
  </div>
</div>

<!-- правая колонка -->
<div class="col-xs-3 col-xs-push-9 col-md-2 col-md-push-10 profile-right">
    <?php require_once 'block/right_block.php'; ?>
</div>

<script>
  $(document).ready(function () {
    var height = $('.user-ava').css('height');
    $('.user-message').css('height', height);
  })
</script>

</body>
</html>