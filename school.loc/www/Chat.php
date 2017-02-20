<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale-1.0">
	<link rel="stylesheet" href="css/Reset.css">
	<link rel="stylesheet" href="bootstrap-3.3.2-dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/profile.css">
	<link rel="stylesheet" href="css/dialog.css">
	<script src="jQuery/jquery-3.1.0.js"></script>
	<script src="bootstrap-3.3.2-dist/js/bootstrap.min.js"></script>
	<script src="js/ava.js"></script>
	<title>Чат</title>
</head>
<body>
	<div class="container col-xs-12">
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
		    <div class="col-xs-12 text-muted text-center">
		      <div class="chat-head text-center text-muted">Номер школы</div>
		    </div>
		  </div>

		  <div class="col-xs-12 dialog-content">
		      
		        <div class="dialog-body col-xs-12">
              <div class="col-xs-1 ava-block">
                <a href=""><img src="<?= $dialog['user_avatar']; ?>" alt="ava" class="ava"></a>
              </div>
              <div class="col-xs-11">
                <a></a>
              </div>
              <div class="col-xs-11">
                <p class="text-muted message"></p>
              </div>
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
	</div>
</body>
</html>