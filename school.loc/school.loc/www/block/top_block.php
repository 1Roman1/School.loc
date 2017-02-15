<?php
require_once 'FUNCTIONS/index.php';
AUTH::autentificationCookies();
if (isset($_GET['logout'])) AUTH::logout();
if (!AUTH::isAuth()) {
    header('Location: Authorization.php');
}
$user_id_top = AUTH::getUserId();
$user_top = USER::getUserInfo($user_id_top);
?>

<a href="/Profile.php" class="btn btn-primary btn-lg col-xs-12 profile-top-button"><?= $user_top['user_first_name'] . " " . $user_top['user_second_name']; ?></a>
<a href="?logout">
  <button type="submit" class="btn btn-primary btn-lg col-xs-1 power
            col-xs-push-11">
    <span class="glyphicon glyphicon-off"></span>
  </button>
</a>