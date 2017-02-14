<?php

/**
 * Created by PhpStorm.
 * User: foo
 * Date: 13.01.2017
 * Time: 19:56
 */
class USER {
    public static function getUserInfo($user_id) {
        $connect = DB_CONNECT::getInstance();
        $user_id = intval($user_id);
        $results = array();

        $sql =
            "SELECT * " .
            "FROM user " .
            "WHERE UPPER(user_id) LIKE UPPER('$user_id')";

        if (!$result = $connect->query($sql)) {
            $results['error'] = "Ошибка запроса учетной записи.";
            LOG::sendLog("Ошибка .. getUserInfo .. ($user_id)", $connect->err());
        } else {
            if ($result->num_rows == 0) {
                $results['error'] = "Не найдена учетная запись с таким идентификатором.";
                LOG::sendLog("Ошибка .. Не найдена учетная запись с таким логином .. getUserInfo .. ($user_id)");
            } else {
                $row = $result->fetch_assoc();
                $results = $row;
            }
        }
        return $results;
    }

    public static function getUserOnClass($user_id) {
        $connect = DB_CONNECT::getInstance();;
        $results = array();

        $user = self::getUserInfo($user_id);
        $user_class = $user['user_class'];
        $user_school = $user['user_school'];

        $sql =
            "SELECT * " .
            "FROM user " .
            "WHERE UPPER(user_class) LIKE UPPER('$user_class') AND UPPER(user_school) LIKE UPPER('$user_school')";

        if (!$result = $connect->query($sql)) {
            $results['error'] = "Ошибка в запросе.";
            LOG::sendLog("Ошибка в запросе", $connect->err());
        } else {
            if ($result->num_rows == 0) {
                $results['error'] = "Записей пока нет.";
            } else {
                while ($row = $result->fetch_assoc()) {
                    $results['data'][] = $row;
                }
            }
        }
        return $results;
    }

    public static function setUserAvatar($user_id, $file) {
        $connect = DB_CONNECT::getInstance();
        $results = array();

        if (!empty($file['name'])) {
            if ($file["size"] < 1024 * 3 * 1024) {
                if (
                    $file['type'] == "image/jpeg" ||
                    $file['type'] == "image/jpg" ||
                    $file['type'] == "image/png" ||
                    $file['type'] == "image/tiff" ||
                    $file['type'] == "image/bmp"
                ) {
                    if (is_uploaded_file($file["tmp_name"])) {

                        $random = microtime() . rand(0, 9999);
                        $user_avatar = $random . $file["name"];

                        move_uploaded_file($file["tmp_name"], "img/user_avatar/" . $user_avatar);

                        $sql =
                            "UPDATE user " .
                            "SET user_avatar = 'img/user_avatar/$user_avatar' " .
                            "WHERE user_id = $user_id ";

                        if (!$result = $connect->query($sql)) {
                            LOG::sendLog("Ошибка .. setUserAvatar .. ($user_id)", $connect->err());
                        }

                    } else {
                        $results['error'] = "Ошибка загрузки файла на сервер";
                        LOG::sendLog("setUserAvatar ($user_id) ошибка загрузки файла на сервер");
                    }
                } else {
                    $results['error'] = "Недопустимый формат файла.";
                    LOG::sendLog("setUserAvatar ($user_id) загрузка файла недопустимого разрешения");
                }
            } else {
                $results['error'] = "Загрузка файла размером больше 3мб";
                LOG::sendLog("setUserAvatar ($user_id) загрузка файла размером больше 3мб");
            }
        } else {
            $results['error'] = "Был передан пустой файл";
            LOG::sendLog("setUserAvatar ($user_id) загрузка пустого файла");
        }
        return $results;
    }

    public static function setInfoUserWallPost($user_id, $user_owner_id, $post_content) {
        $connect = DB_CONNECT::getInstance();
        $user_id = intval($user_id);
        $user_owner_id = intval($user_owner_id);
        $results = array();

        if (mb_strlen($post_content, "utf-8") < 2) {
        } else {
            $post_content = htmlspecialchars($post_content);
            $fields = "user_add_id, user_owner_id, post_content, post_date_add";
            $data = "'$user_id', '$user_owner_id', '$post_content', NOW()";

            $sql =
                "INSERT " .
                "INTO user_wall_post ($fields) VALUES ($data)";

            if (!$result = $connect->query($sql)) {
                $results['error'] = "Ошибка при добавлении записи";
                LOG::sendLog("Ошибка при добавлении", $connect->err());
            }
        }
    }

    public static function setCommentFromUserPost($post_id, $user_id, $comment_content) {
        $connect = DB_CONNECT::getInstance();

        $fields = "post_id, user_add_id, comment_content, comment_date_add";
        $data = "'$post_id', '$user_id', '$comment_content', NOW()";
        $sql =
            "INSERT " .
            "INTO user_comment_wall_post ($fields) VALUES ($data)";

        if (!$result = $connect->query($sql)) {
            $results['error'] = "Ошибка при добавлении записи";
            LOG::sendLog("Ошибка при добавлении комментария", $connect->err());
        }
    }

    public static function getInfoUserWallPost($user_id) {
        $connect = DB_CONNECT::getInstance();
        $results = array();

        $sql =
            "SELECT a.post_id, a.user_add_id, a.user_owner_id, a.post_content,
             a.post_date_add, b.user_id, b.user_first_name, b.user_second_name, b.user_avatar " .
            "FROM user_wall_post a " .
            "JOIN user b ON b.user_id = a.user_add_id " .
            "WHERE user_owner_id = $user_id " .
            "ORDER BY post_id DESC ";

        if (!$result = $connect->query($sql)) {
            $results['error'] = "Ошибка в запросе.";
            LOG::sendLog("Ошибка в запросе", $connect->err());
        } else {
            if ($result->num_rows == 0) {
                $results['error'] = "Записей пока нет.";
            } else {
                while ($row = $result->fetch_assoc()) {
                    $results['data'][] = $row;
                }
            }
        }
        return $results;
    }

    public static function getInfoUserComment($post_id) {
        $connect = DB_CONNECT::getInstance();
        $results = array();

        $sql =
            "SELECT comments.id, comments.comment_content, comments.user_add_id, user.user_first_name,
             user.user_second_name " .
            "FROM user_comment_wall_post comments " .
            "JOIN user ON user.user_id = comments.user_add_id " .
            "WHERE comments.post_id = $post_id ";

        if (!$result = $connect->query($sql)) {
            $results['error'] = "Ошибка в запросе комментариев.";
            LOG::sendLog("Ошибка в запросе комментариев", $connect->err());
        } else {
            if ($result->num_rows == 0) {
                $results['error'] = "Комментариев нет.";
            } else {
                while ($row = $result->fetch_assoc()) {
                    $results[] = $row;
                }
            }
        }
        return $results;
    }

    public static function dellUserWallPost($post_id) {
        $connect = DB_CONNECT::getInstance();

        $sql =
            "DELETE " .
            "FROM user_wall_post " .
            "WHERE post_id = $post_id ";

        if (!$result = $connect->query($sql)) {
            LOG::sendLog("Ошибка при удалении записи", $connect->err());
        }
    }

    public static function resetUserAvatar($user_id) {
        $connect = DB_CONNECT::getInstance();

        $sql =
            "UPDATE user " .
            "SET user_avatar = 'img/user_avatar/main/photo.jpg' " .
            "WHERE user_id = $user_id ";

        if (!$result = $connect->query($sql)) {
            $results['error'] = "Ошибка удаления фотографии профиля.";
            LOG::sendLog("Ошибка .. resetUserAvatar .. ($user_id)", $connect->err());
        }
    }
}