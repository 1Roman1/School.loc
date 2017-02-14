<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale-1.0">
	<title>Новости</title>
	<link rel="stylesheet" href="CSS/Reset.css">
	<link rel="stylesheet" href="bootstrap-3.3.2-dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="CSS/profile.css">
	<link rel="stylesheet" href="css/news.css">
	<script src="jQuery/jquery-3.1.0.js"></script>
	<script src="bootstrap-3.3.2-dist/js/bootstrap.min.js"></script>
	<script src="js/ava.js"></script>
</head>
<body>
	<div class="container col-xs-12">
		
		<!-- Шапка -->
		<div class="profile-header col-xs-12">
        <?php require_once 'block/top_block.php' ?>
    </div>
		
		<!-- Левая колонка -->
    <div class="profile-body">
        <?php require_once 'block/left_block.php'; ?>
    </div>

		<!-- центральная колонка -->
		<div class="col-xs-6 col-xs-push-3 news">
			<form action="" method="post">
        <div class="col-xs-12 news-nav">
          <div class="input-group">
    				<span class="input-group-addon">
    					<i class="glyphicon glyphicon-search text-muted"></i>
    				</span>
            <input type="text" class="form-control" name="search" placeholder="Поиск новости">
            <span class="input-group-btn">
    					<button type="submit" class="btn btn-primary">Поиск</button>
    				</span>
          </div>
        </div>
      </form>

			<div class="col-xs-12 news-block">
				<div class="col-xs-12 news-header">
          <div class="col-xs-1 news-ava-block">
            <a href="">
              <img src="img/user_avatar/0.07103700 14866336205288eNdGk7CF4W0.jpg" alt="Фотография профиля" class="news-ava">
            </a>
          </div>

          <div class="col-xs-8 news-author-name">
            <div class="col-xs-12">
              <a href="" class="">Вася Сисечкин</a>
            </div>
            <div class="col-xs-12">13.13.666</div>
          </div>
				</div>
				<div class="col-xs-12 news-content">
          <p class="post">
            Пост
            <span class="glyphicon glyphicon-comment comment-icon" title="Комментировать"></span>
          </p>
        </div>

				<div class="col-xs-12 news-header comment">
					<div class="col-xs-1 news-ava-block">
						<a href="">
							<img src="img/user_avatar/0.07103700 14866336205288eNdGk7CF4W0.jpg" alt="" class="news-ava">
						</a>
					</div>
					<div class="col-xs-8 news-author-name">
						<div class="col-xs-12">
							<a href="">Сися Васичкин</a>
						</div>
						<div class="col-xs-12">дата</div>
					</div>
				</div>
				
				<div class="col-xs-12 news-content">
					<div class="post text-muted">
						Комент
						<span class="glyphicon glyphicon-comment comment-icon" title="комментировать"></span>
					</div>
				</div>
			</div>
		</div>


    <!-- Правая колонка -->
    <div class="col-xs-3 col-xs-push-9 col-md-2 col-md-push-10 profile-right">
        <?php require_once 'block/right_block.php'; ?>
    </div>
    
    <!-- левый скрол -->
    <div class="col-xs-1 col-xs-push-2 scroll text-center scroll">
      <div class="col-xs-12 scroll-up scroll-up">
        <i class="glyphicon glyphicon-chevron-up"></i>
      </div>

      <div class="col-xs-12 scroll-down scroll-down">
        <div class="col-xs-12 point-down text-center">
          <i class="glyphicon glyphicon-chevron-down"></i>
        </div>
      </div>
    </div>

    <!-- правый скрол -->
    <div class="col-xs-1 col-xs-push-9 scroll-left text-center scroll">
      <div class="col-xs-12 scroll-up scroll-up">
        <i class="glyphicon glyphicon-chevron-up"></i>
      </div>

      <div class="col-xs-12 scroll-down scroll-down">
        <div class="col-xs-12 point-down text-center">
          <i class="glyphicon glyphicon-chevron-down"></i>
        </div>
      </div>
    </div>

	</div>

	<script>
    $(document).ready(function(){
      var blockSide = $('.news-ava-block').width();
      var avaWidth = $('.news-ava').width();
      var avaHeight = $('.news-ava').height();
      var padding;
      $('.news-ava-block').height(blockSide);
      if(avaWidth < avaHeight){
        $('.news-ava').width(blockSide);
        avaWidth = $('.news-ava').width();
        avaHeight = $('.news-ava').height();
        padding = (avaHeight - avaWidth) / 4;
        $('.news-ava').css('top', - padding);
      }else{
        $('.news-ava').height(blockSide);
        avaWidth = $('.news-ava').width();
        avaHeight = $('.news-ava').height();
        padding = (avaWidth - avaHeight) / 4;
        $('.news-ava').css('left', - padding);
      }
    })
  </script>
</body>
</html>