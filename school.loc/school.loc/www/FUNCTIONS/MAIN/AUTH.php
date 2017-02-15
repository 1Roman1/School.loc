<?php

/**
 * Created by PhpStorm.
 * User: foo
 * Date: 06.01.2017
 * Time: 17:04
 */
class AUTH {
    public static function sessionStart($start = false) {
        $lifeTime = 86400;
        if (isset($_COOKIE[session_name()]) || $start) {
            if (!session_id()) session_start();
            if (isset($_SESSION['starttime'])) {
                if (time() - $_SESSION['starttime'] >= $lifeTime) {
                    session_unset();
                    session_regenerate_id(true);
                }
            } else {
                $_SESSION['starttime'] = time();
            }
        }
    }

    public static function autentificationCookies() {
        self::sessionStart();
        if (!self::isAuth()) {
            if (isset($_COOKIE['Id']) && isset($_COOKIE['userHash'])) {
                $user_id = intval($_COOKIE['user_id']);
                $userHash = $_COOKIE['userHash'];
                $checkHash = self::checkHash($user_id, $userHash);
                if ($checkHash !== false) {
                    $user_email = $checkHash['user_email'];
                    $user_pass = $checkHash['user_pass'];
                    self::setCookieUser($user_id, $user_email, $user_pass);
                    self::sessionStart(true);
                    $_SESSION['user_id'] = $user_id;
                    $_SESSION['user_email'] = $user_email;
                } else {
                    self::logout();
                }
            }
        }
    }

    private static function checkHash($user_id, $userHash) {
        $connect = DB_CONNECT::getInstance();
        $user_id = intval($user_id);
        $userHash = $connect->escape($userHash);
        $query = "SELECT user_email, user_pass FROM user WHERE user_id = $user_id LIMIT 1";
        if ($result = $connect->query($query)) {
            if ($result->num_rows > 0) {
                if ($row = $result->fetch_assoc()) {
                    $userLoginDB = $row['user_email'];
                    $userPassDB = $row['user_pass'];
                    $userHashDB = md5($userLoginDB . $userPassDB);
                    if ($userHashDB == $userHash) {
                        return $row;
                    } else {
                        LOG::sendLog("В куках он авторизованн, на деле хэш пароля не совпал [$user_id][$userLoginDB][$userPassDB]");
                        self::clearCookieUser();
                    }
                }
            } else {
                LOG::sendLog("В куках он авторизованн, на деле такого пользователя нет [$user_id]");
                self::clearCookieUser();
            }
        } else LOG::sendLog("checkHash($user_id, $userHash)", $connect->err());
        return false;
    }

    public static function getUserByLogin($user_email) {
        $connect = DB_CONNECT::getInstance();
        $user_email = $connect->escape(trim($user_email));
        $results = Array();
        if (!isLen($user_email, 1, 256)) $return['error'] = "Введите логин от 1 до 256 символов.";
        else {
            $query =
                "SELECT user_id, user_email, user_pass " .
                "FROM user " .
                "WHERE UPPER(user_email) LIKE UPPER('$user_email')";
            if (!$result = $connect->query($query)) {
                $results['error'] = "Ошибка запроса учетной записи.";
                LOG::sendLog("getUserByLogin($user_email)", $connect->err());
            } else {
                if ($result->num_rows == 0) {
                    $results['error'] = "Не найдена учетная запись с таким логином.";
                    LOG::sendLog("getUserByLogin($user_email), Не найден пользователь");
                } else {
                    $row = $result->fetch_assoc();
                    $results = $row;
                }
            }
        }
        return $results;
    }

    public static function autentification($user_email, $user_pass) {
        $connect = DB_CONNECT::getInstance();
        $user_email = $connect->escape(trim($user_email));
        $user_pass = $connect->escape(trim($user_pass));
        $return = Array();
        $user_pass = md5($user_pass);
        $user = AUTH::getUserByLogin($user_email);
        if (isErr($user)) $return = $user;
        else {
            $user_id = $user['user_id'];
            $userPassDB = $user['user_pass'];
            if ($userPassDB != $user_pass) {
                $return['error'] = "Ошибка авторизации. Неверный пароль.";
                LOG::sendLog("autentification($user_email, $user_pass), неверный пароль");
            } else {
                self::setCookieUser($user_id, $user_email, $user_pass);
                self::sessionStart(true);
                $_SESSION['user_id'] = $user_id;
                $_SESSION['user_email'] = $user_email;
            }
        }
        return $return;
    }

    public static function registration($user_email, $user_first_name, $user_second_name, $user_date_birth, $user_country, $user_city, $user_school, $user_class, $user_pass, $user_repeat_pass) {
        $connect = DB_CONNECT::getInstance();
        $return = Array();

        $user_email = $connect->escape(trim($user_email));
        $user_first_name = $connect->escape(trim($user_first_name));
        $user_second_name = $connect->escape(trim($user_second_name));
        $user_date_birth = $connect->escape(trim($user_date_birth));
        $user_country = $connect->escape(trim($user_country));
        $user_city = $connect->escape(trim($user_city));
        $user_school = $connect->escape(trim($user_school));
        $user_class = $connect->escape(trim($user_class));
        $user_pass = $connect->escape($user_pass);
        $user_repeat_pass = $connect->escape($user_repeat_pass);

        if ($user_pass != $user_repeat_pass) {
            $return['error'] = "Ваши пароли не совпадают";
        } else {
            $user_pass = md5($user_pass);
            $user = AUTH::getUserByLogin($user_email);
            if (!isErr($user)) $return['error'] = "Данный логин занят."; else {
                $fields = "user_email, user_first_name, user_second_name, user_date_birth, user_country, user_city, user_school, user_class, user_pass, user_avatar, user_date_add";
                $data = "'$user_email', '$user_first_name', '$user_second_name', '$user_date_birth', '$user_country', '$user_city', '$user_school', '$user_class', '$user_pass', 'img/user_avatar/main/photo.jpg', NOW()";
                $query = "INSERT INTO user ($fields) VALUES ($data)";
                if (!$result = $connect->query($query)) {
                    $return['error'] = "Ошибка регистрации .. ";
                } else {
                    $user_id = $connect->insertId();
                    self::setCookieUser($user_id, $user_email, $user_pass);
                    self::sessionStart(true);
                    $_SESSION['user_id'] = $user_id;
                    $_SESSION['user_email'] = $user_email;
                }
            }
        }
        return $return;
    }

    public static function logout() {
        self::clearCookieUser();
        if (self::isAuth()) {
            session_unset();
            $params = session_get_cookie_params();
            setcookie(session_name(), "", time() - 3600 * 24 * 30 * 12, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
            session_destroy();
        }
    }

    private static function setCookieUser($user_id, $user_email, $user_pass) {
        setcookie("user_id", $user_id, time() + 60 * 60 * 24 * 30, "/");
        setcookie("userHash", md5($user_email . $user_pass), time() + 60 * 60 * 24 * 30, "/");
    }

    private static function clearCookieUser() {
        setcookie("user_id", "", time() - 3600 * 24 * 30 * 12, "/");
        setcookie("userHash", "", time() - 3600 * 24 * 30 * 12, "/");
    }

    public static function isAuth() {
        if (session_id()) {
            if (isset($_SESSION['user_id'])) return true;
        }
        return false;
    }

    public static function getUserId() {
        if (self::isAuth()) {
            return $_SESSION['user_id'];
        }
        return -1;
    }
}