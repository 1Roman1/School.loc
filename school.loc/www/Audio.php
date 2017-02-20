<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale-1.0">
	<link rel="stylesheet" href="css/Reset.css">
	<link rel="stylesheet" href="bootstrap-3.3.2-dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/profile.css">
	<link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/audio.css">
	<script src="jQuery/jquery-3.1.0.js"></script>
	<script src="bootstrap-3.3.2-dist/js/bootstrap.min.js"></script>
	<script src="js/ava.js"></script>
	<script src="jQuery/jPlayer-2.9.2/dist/jplayer/jquery.jplayer.min.js"></script>
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
		<div class="col-xs-6 col-xs-offset-3 dialog">
		  <div class="jpa" id="jpa">
		  	<div id="jpa-container" class="jp-audio">
		  		<div class="jp-type-single">
		  			
		  			<div class="jp-title">
		  				<ul>
		  					<li>TEDxPhoenix - Kelli Anderson - Disruptive Wonder for a Change</li>
		  				</ul>
		  			</div>

		  			<div class="jp-gui jp-interface">
		  				
		  				<ul class="jp-controls">
		  					<li><a href="javascript:;" class="jp-play" tabindex="1">?</a></li>
		  					<li><a href="javascript:;" class="jp-pause" tabindex="1">?</a></li
		  					>
		  					<li><a href="javascript:;" class="jp-mute" tabindex="1">?</a></li>
		  					<li><a href="javascript:;" class="jp-unmute" tabindex="1">?</a></li>
		  				</ul>

		  				<div class="jp-progress">
		  					<div class="jp-seek-bar">
		  						<div class="jp-play-bar"></div>
		  					</div>
		  				</div>

		  				<div class="time-holder">
		  					<div class="jp-current-time"></div>
		  				</div>

		  				<div class="jp-volume-bar">
		  					<div class="jp-volume-bar-value"></div>
		  				</div>

		  				<div class="jp-no-solution">
		  					<span>Update Required</span>
		  					To play the media you will need to either update your browser to a recent version or update your
		  					<a href="http://get.adobe.com/flashplayer/" target="_blank">Flash pluin</a> 
		  				</div>
		  			</div>
		  		</div>
		  	</div>
		  </div>
		</div>
	
		<!-- правая колонка -->
	<div class="col-xs-3 col-xs-push-9 col-md-2 col-md-push-10 profile-right">
	    <?php require_once 'block/right_block.php'; ?>
	</div>

	<script>
		$(document).ready(function(){
			$('#jpa').jPlayer({
				ready: function(){
					$(this).jPlayer("setMedia",{
						mp3: "Ariya_KIPELOV_-_Begi_za_solncem_(iPlayer.fm).mp3",
						oga: ""
					});
				},
				swfPath: "/js",
				supplied: "mp3,oga"
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