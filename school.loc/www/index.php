<?php
/**
 * Created by PhpStorm.
 * User: foo
 * Date: 07.01.2017
 * Time: 23:28
 */

require_once 'FUNCTIONS/index.php';
AUTH::autentificationCookies();

if(AUTH::isAuth()) {
  header('Location: Profile.php');
} else {
  header('Location: Authorization.php');
}