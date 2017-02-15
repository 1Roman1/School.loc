<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale-1.0">
	<link rel="stylesheet" href="css/Reset.css">
	<link rel="stylesheet" href="bootstrap-3.3.2-dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="CSS/profile.css">
	<link rel="stylesheet" href="css/photo-album.css">
	<script src="jQuery/jquery-3.1.0.js"></script>
	<script src="bootstrap-3.3.2-dist/js/bootstrap.min.js"></script>
	<script src="js/ava.js"></script>
	<title>Фото альбомы</title>
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

	  <!-- Центральная колонка -->
	  <div class="col-xs-6 col-xs-push-3 wrap">
	  	<div class="content">
	  		<div class="head">
	  			<div class="input-group col-xs-12">
	  				<i class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></i>
	  				<input type="text" class="form-control" placeholder="Введите название альбома">
	  				<i class="input-group-btn">
	  					<button class="btn btn-primary">Поиск</button>
	  				</i>
	  			</div>
	  		</div>

	  		<div class="main">
	  			<div class="album">
	  				<p class="album-name text-muted text-center album-head"><a href="">Название альбома</a></p>
	  				<img src="img/icons/w450h4001385925290Camera.png" alt="" class="img-responsive album-body">
	  			</div>
	  		</div>
	  	</div>
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

	</div>
</body>
</html>