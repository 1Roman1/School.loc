<?php
require_once 'FUNCTIONS/index.php';
AUTH::autentificationCookies();

$user_id = $_SESSION['user_id'];
$user = USER::getUserInfo($user_id);
$user_class = USER::getUserOnClass($user_id);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="vivewport" content="width=device-width, initial-scale-1.0">
  <link rel="stylesheet" href="CSS/Reset.css">
  <link rel="stylesheet" href="bootstrap-3.3.2-dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="CSS/profile.css">
  <link rel="stylesheet" href="CSS/class.css">
  <script src="jQuery/jquery-3.1.0.js"></script>
  <script src="bootstrap-3.3.2-dist/js/bootstrap.min.js"></script>
  <script src="js/ava.js"></script>
  <title>Класс</title>
</head>
<body>
<div class="container col-xs-12">
  <!-- Шапка  -->
  <div class="profile-header col-xs-12">
      <?php require_once 'block/top_block.php' ?>
  </div>

  <!-- Левая колонка -->
  <div class="profile-body">
      <?php require_once 'block/left_block.php'; ?>
  </div>

  <!-- средняя колонка -->
  <div class="col-xs-6 col-xs-push-3 class">
    <div class="col-xs-12 class-header">
      <div class="col-xs-12 class-name text-muted text-center">
        Класс <?= $user['user_class'] ?> школы №<?= $user['user_school']; ?>
      </div>
    </div>
    <div class="col-xs-12 class-content">
        <?php foreach ($user_class['data'] as $user): ?>
          <div class="col-xs-12 user">
            <div class="col-xs-12 user-data text-muted">
            <div class="col-xs-1 ava-block">
              <a href=""><img src="<?= $user['user_avatar'];?>" class="ava" alt="ava"></a>
            </div>
              <div class="col-xs-3">
                <p class="info"><a href="Profile.php?id=<?= $user['user_id']; ?>"><?= $user['user_first_name'] . " " . $user['user_second_name']; ?></a></p>
              </div>
              <div class="col-xs-4">
                <p class="info"><a href="Dialog.php?sel=<?= $user['user_id']; ?>">Написать сообщение</a></p>
              </div>
              <div class="col-xs-4">
                <p class="info">Положение(в друзьях или нет)</p>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
    </div>

    <div class="col-xs-12 user-nav">
      <form action="" method="post">
        <div class="col-xs-12">
          <div class="input-group">
    				<span class="input-group-addon">
    					<i class="glyphicon glyphicon-search text-muted"></i>
    				</span>
            <input type="text" class="form-control" name="search" placeholder="Поиск пользователя">
            <span class="input-group-btn">
    					<button type="submit" class="btn btn-primary">Поиск</button>
    				</span>
          </div>
        </div>
      </form>
    </div>

    <!-- Правая колонка -->
    <div class="col-xs-3 col-xs-push-9 col-md-2 col-md-push-10 profile-right">
        <?php require_once 'block/right_block.php'; ?>
    </div>

</div>

<script>
  $(document).ready(function () {
    var height = $('.user-ava').css('height');
    $('.user-data').css('height', height);
  })
</script>
</body>
</html>