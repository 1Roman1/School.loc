<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale-1.0">
	<link rel="stylesheet" href="css/Reset.css">
	<link rel="stylesheet" href="bootstrap-3.3.2-dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="CSS/profile.css">
	<link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="create-music-player-for-site-jquery/css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script src="bootstrap-3.3.2-dist/js/bootstrap.min.js"></script>
	<script src="create-music-player-for-site-jquery/js/mediaelement-and-player.min.js"></script>
	<script src="js/ava.js"></script>
	<title>Аудио</title>
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

		<!-- Центр -->
		<div class="col-xs-6 col-xs-push-3 play-list">
			<div class="audio-player">
				 <h1 class="text-primary">Ария - Беги за солнцем </h1>
				 	<audio id="audio-player" type="audio/mp3" controls="controls">
				 	<source src="Ariya_KIPELOV_-_Begi_za_solncem_(iPlayer.fm).mp3" type="audio/mp3">
				 </audio>
			 </div>
		</div>

		<!-- правая колонка -->
	<div class="col-xs-3 col-xs-push-9 col-md-2 col-md-push-10 profile-right">
	    <?php require_once 'block/right_block.php'; ?>
	</div>

	<script>
		$(document).ready(function(){
			$('#audio-player').mediaelementplayer({
				alwaysShowControls: true,
				features: ['playpause','volume','progress'],
				audiovolume: 'horizontal',
				audiowidth: 400, 
				audioheight: 120
			});
		});
	</script>
	
	<script>
	  $(document).ready(function () {
	    var height = $('.user-ava').css('height');
	    $('.user-message').css('height', height);
	  })
	</script>
</body>
</html>