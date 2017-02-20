<?php
require_once 'FUNCTIONS/index.php';
AUTH::autentificationCookies();

if (isset($_GET['logout'])) AUTH::logout();

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
} else {
    $user_id = $_SESSION['user_id'];
}

if (isset($_POST['reset_user_avatar'])) {
    $result = USER::resetUserAvatar($_SESSION['user_id']);
}

if (isset($_POST['new_user_post'])) {
    $result = USER::setInfoUserWallPost($_SESSION['user_id'], $user_id, $_POST['new_user_post']);
}

if (isset($_POST['new_comment_on_user_post'])) {
    $result = USER::setCommentFromUserPost($_POST['post_id_comment'], $_SESSION['user_id'], $_POST['new_user_comment']);
}

if (isset($_POST['dellUserWallPost'])) {
    $post_id = intval($_POST['dellUserWallPost']);
    $result = USER::dellUserWallPost($post_id);
}

if (isset($_FILES['file'])) {
    $result = USER::setUserAvatar($user_id, $_FILES['file']);
}

$user = USER::getUserInfo($user_id);
$post = USER::getInfoUserWallPost($user_id);

if (!AUTH::isAuth()) {
    header('Location: Authorization.php');
}

?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale-1.0">
  <title>Профиль</title>
  <link rel="stylesheet" href="CSS/Reset.css">
  <link rel="stylesheet" href="bootstrap-3.3.2-dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="CSS/profile.css">
  <script src="jQuery/jquery-3.1.0.js"></script>
  <script src="bootstrap-3.3.2-dist/js/bootstrap.min.js"></script>
  <script src="jQuery/jquery.maskedinput.min.js"></script>
  <script src="js/ava.js"></script>
</head>
<body>
<div class="profile container col-xs-12">
  <div class="profile-content">
    <!-- Шапка  -->
    <div class="profile-header col-xs-12">
        <?php require_once 'block/top_block.php' ?>
    </div>

    <!-- Левая колонка -->
    <div class="profile-body">
        <?php require_once 'block/left_block.php'; ?>
    </div>

    <!-- Центральная колонка -->
    <div class="col-xs-6 profile-middle col-xs-push-3">
      <div class="col-xs-10 col-xs-push-1 profile-status-block">
        <p class="text-center text-muted profile-status">Статус профиля</p>
        <form method="post">
          <div class="col-xs-12 input-group profile-status-input">
            <i class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></i>
            <input type="text" class="form-control" placeholder="Введите текст">
            <i class="input-group-btn">
              <button class="btn btn-primary" type="submit">Добавить</button>
            </i>
          </div>
        </form>
      </div>
        <?php if (isErr($user)): ?>
            <?= $user['error']; ?>
        <?php else: ?>
          <div class="col-xs-10 col-xs-push-1 ava-border">

            <div class="col-xs-12 ava-block">
              <img src="<?= $user['user_avatar']; ?>" alt="Загрузить фотографию профиля .." class="ava">

              <!-- меню аватарки -->
              <div class="col-xs-12 ava-menu">
                <?php if ($user_id == $_SESSION['user_id']): ?>
                  <form method="post" name="form" enctype="multipart/form-data">
                    <div class="col-xs-6 text-center ava-menu-block">
                      <input type="file" class="file" id="ava-file-plus" name="file" onchange='runUpload()'>
                      <label for="ava-file-plus" class="ava-label" title="Установить фотографию профиля">
                        <span class="glyphicon glyphicon-plus ava-plus"></span>
                      </label>
                    </div>
                  </form>
                  <form method="post">
                    <div class="col-xs-6 text-center ava-menu-block">
                      <input type="submit" class="file" id="ava-file-minus" name="reset_user_avatar">
                      <label for="ava-file-minus" class="ava-label" title="Удалить фотографию профиля">
                        <span class="glyphicon glyphicon-minus ava-minus"></span>
                      </label>
                    </div>
                  </form>
                <?php endif; ?>
              </div>
            </div>

            <script>
              function runUpload() {
                document.forms["form"].submit();
              }
            </script>

          </div>
          <div class="col-xs-12 profile-message-button-block">
            <button class="btn btn-primary col-xs-10 col-xs-push-1 profile-message-button" type="submit">Написать сообщение</button>
          </div>

          <div class="col-xs-12 text-center profile-name">
            <a id="profile-name" title="Показать дополнительную информацию"><?= $user['user_first_name'] . " " . $user['user_second_name']; ?></a>
          </div>
          <div class="profile-info col-xs-12 text-center text-muted">
            <ul>
              <li class="info-li">Страна: <span class="info-country"><?= $user['user_country']; ?></span></li>
              <li class="info-li">Город: <span class="info-city"><?= $user['user_city']; ?></span></li>
              <li class="info-li">Школа: <span class="info-school"><?= $user['user_school']; ?></span></li>
              <li class="info-li">Класс: <span class="info-class"><?= $user['user_class']; ?></span></li>
            </ul>
          </div>
          <div class="profile-add-news">
            <div class="profile-news-head col-xs-12">
              <form method="post" class="post-input">
                <div class="row">
                  <div class="col-xs-12">
                    <div class="input-group">
                      <!--<div class="input-group-btn">
                          <button class="btn btn-primary dropdown-toggle"
                                  data-toggle="dropdown" title="Прикрепить">
                              <span class="caret"></span>
                          </button>
                          <ul class="dropdown-menu pull-left">
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
                      </div>-->
                      <input type="text" class="form-control news-head-input" name="new_user_post"
                             placeholder="Добавить новую запись">
                      <div class="input-group-btn">
                        <button class="btn btn-primary">Опубликовать</button>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>

            <!-- Новости -->

              <?php if (isErr($post)): ?>
                <div class="col-xs-12 news-block">
                    <?php echo $post['error'] ?>
                </div>
              <?php else: ?>

                  <?php foreach ($post['data'] as $item): ?>
                  <div class="col-xs-12 news-block">

                    <div class="news-header col-xs-12">
                      <?php if ($user_id == $_SESSION['user_id'] or $item['user_add_id'] == $_SESSION['user_id']): ?>
                        <form method="post">
                          <button type="submit" name="dellUserWallPost" value="<?= $item['post_id']; ?>" class="news-delete">
                            <span class="glyphicon glyphicon-remove"></span>
                          </button>
                        </form>
                      <?php endif; ?>
                      <div class="col-xs-1 news-ava-block">
                        <a href="Profile.php?id=<?= $item['user_id']; ?>">
                          <img src="<?= $item['user_avatar']; ?>" alt="Фотография профиля" class="news-ava">
                        </a>
                      </div>

                      <div class="col-xs-8 news-author-name">
                        <div class="col-xs-12">
                          <a href="Profile.php?id=<?= $item['user_id']; ?>" class=""><?= $item['user_first_name'] . " " . $item['user_second_name']; ?></a>
                        </div>
                        <div class="col-xs-12 text-muted"><?= $item['post_date_add'] ?></div>
                      </div>
                      
                    </div>

                    <div class="col-xs-12 news-content">
                      <p class="post text-muted"><?= $item['post_content']; ?>
                        Пост
                        <span class="glyphicon glyphicon-comment comment-icon" title="Комментировать"></span>
                      </p>
                      <form method="post" class="post-input-news">
                        <div class="row">
                          <div class="col-xs-12">
                            <div class="input-group">
                              <!--<div class="input-group-btn">
                                  <button class="btn btn-primary dropdown-toggle"
                                          data-toggle="dropdown" title="Прикрепить">
                                      <span class="caret"></span>
                                  </button>
                                  <ul class="dropdown-menu pull-left">
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
                              </div>-->
                              <input type="text" class="form-control comment-input"
                                     placeholder="Комментировать" >
                              <div class="input-group-btn">
                                <button class="btn btn-primary">Опубликовать</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                    <!-- тут выводится содержание новости-->
                      <!-- а сюда сделай сука тупые нахуй комментарии блять СУКА ТЫ ПОНЯЛ НАХУЙ?? КОММЕНТАРИИ!!! -->

                    <div class="news-header col-xs-12 comment">
                      <?php if ($user_id == $_SESSION['user_id'] or $item['user_add_id'] == $_SESSION['user_id']): ?>
                        <form method="post">
                          <button type="submit" name="dellUserWallPost" value="<?= $item['post_id']; ?>" class="news-delete">
                            <span class="glyphicon glyphicon-remove"></span>
                          </button>
                        </form>
                      <?php endif; ?>
                      <div class="col-xs-1 news-ava-block">
                        <a href="Profile.php?id=<?= $item['user_id']; ?>">
                          <img src="<?= $item['user_avatar']; ?>" alt="Фотография профиля" class="news-ava">
                        </a>
                      </div>

                      <div class="col-xs-8 news-author-name">
                        <div class="col-xs-12">
                          <a href="Profile.php?id=<?= $item['user_id']; ?>" class=""><?= $item['user_first_name'] . " " . $item['user_second_name']; ?></a>
                        </div>
                        <div class="col-xs-12 text-muted"><?= $item['post_date_add'] ?></div>
                      </div>

                    </div>

                    <div class="col-xs-12 news-content text-muted">
                      <p class="post"><?= $item['post_content']; ?>
                        Комент
                        <span class="glyphicon glyphicon-comment comment-icon" title="Комментировать"></span>
                      </p>

                      <form method="post" class="post-input-news">
                        <div class="row">
                          <div class="col-xs-12">
                            <div class="input-group">
                              <!--<div class="input-group-btn">
                                  <button class="btn btn-primary dropdown-toggle"
                                          data-toggle="dropdown" title="Прикрепить">
                                      <span class="caret"></span>
                                  </button>
                                  <ul class="dropdown-menu pull-left">
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
                              </div>-->
                              <input type="text" class="form-control comment-input"
                                     placeholder="Комментировать" >
                              <div class="input-group-btn">
                                <button class="btn btn-primary">Опубликовать</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>

                  </div>
                  <?php endforeach; ?>
              <?php endif; ?>
          </div>
        <?php endif; ?>
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

  <script>
    $(document).ready(function(){
      $('.comment-icon').click(function(){
        $(this).closest('.news-content').find('.post-input-news').css('display','block');
        $('.comment-input').focus();
      })

      $('.comment-input').blur(function(){
        $('.post-input-news').css('display','none');
      })

      $('.profile-status').click(function(){
        $(this).css('visibility','hidden');
        $('.profile-status-input').css('visibility','visible');
        $('.profile-status-input').find('input').focus().blur(function(){
          $('.profile-status-input').css('visibility','hidden');
          $('.profile-status').css('visibility','visible');
        });
      })
    })
  </script>


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

  <script>
    $(document).ready(function () {
      $('.profile-ava-block').click(function () {
      })
    })
  </script>

  <script>
    $(document).ready(function () {
      $('.scroll-up').click(function () {
        $('body,html').animate({scrollTop: (0)}, 500);
      })

      $('.scroll-down').click(function () {
        var height = $(document).height();
        $('body,html').animate({scrollTop: height}, 500);
      })
    })
  </script>

  <!-- Ваще забей  -->
  <script>
    $(document).ready(function () {
      $('.profile-info').hide();
      $('#profile-name').click(function () {
        $('.profile-info').slideToggle(300)
      });
    })
  </script>

</body>
</html>