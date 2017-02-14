<?php
require_once 'FUNCTIONS/index.php';
AUTH::autentificationCookies();
$dialog_list = MESS::getDialogList();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale-1.0">
  <meta charset="UTF-8">
  <link rel="stylesheet" href="CSS/Reset.css">
  <link rel="stylesheet" href="bootstrap-3.3.2-dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="CSS/profile.css">
  <link rel="stylesheet" href="CSS/messages.css">
  <script src="jQuery/jquery-3.1.0.js"></script>
  <script src="bootstrap-3.3.2-dist/js/bootstrap.min.js"></script>
  <script src="js/ava.js"></script>
  <title>Сообщения</title>
</head>
<body>
<div class="profile-header col-xs-12">
    <?php require_once 'block/top_block.php' ?>
</div>
<!-- Левая колонка -->
<div class="profile-body">
    <?php require_once 'block/left_block.php'; ?>
</div>

<!-- сообщения -->
<div class="col-xs-6 col-xs-offset-3 message-mid">
  
  <div class="col-xs-12 message">
      <?php if (isErr($dialog_list)): ?>
          <?= $dialog_list['error'] ?>
      <?php else: ?>
          <?php foreach ($dialog_list['data'] as $list): ?>

          <div class="col-xs-12 search-block">
            <div class="input-group message-search">
                <span class="input-group-addon">
                  <span class="glyphicon glyphicon-search text-muted"></span>
                </span>
              <input type="text" class="form-control" placeholder="Поиск">
              <span class="input-group-btn">
                  <button type="submit" class="btn btn-primary">Поиск</button>
                </span>
            </div>
          </div>
          
          <div class="col-xs-12 user-message text-muted">
            <div class=" col-xs-1 ava-block">
              <a href="Dialog.php?sel=<?= $list['user_get_mess'] ?>"><img src="img/user_avatar/0.00849900 148578543845734lPaX2u48WQ.jpg" alt="" class="ava"></a>
            </div>
            <div class="col-xs-2 messager-name">
              <div class="col-xs-12 text-center">
                <a href=""><?= $list['user_first_name'] . " " . $list['user_second_name']; ?></a>
              </div>
              <div class="col-xs-12 text-center"><span><?= $list['mess_date_add'] ?></span></div>
            </div>
            <button class="remove"><i class="glyphicon glyphicon-remove"></i></button>
            <div class="col-xs-8">
              <p class="last-message"><?= $list['message']; ?></p>
            </div>
            <div class="col-xs-1 ava-block">
              <a href=""><img src="" alt="ava" class="ava"></a>
            </div>
          </div>
          
          <?php endforeach; ?>
      <?php endif; ?>
  </div>
</div>

<!-- правая колонка -->
<div class="col-xs-3 col-xs-push-9 col-md-2 col-md-push-10 profile-right">
    <?php require_once 'block/right_block.php'; ?>
</div>

</body>
</html>