<?php

/**
 * Created by PhpStorm.
 * User: foo
 * Date: 26.01.2017
 * Time: 20:09
 */
class MESS {
    public static function addMess($userGetMess, $message) {
        $connect = DB_CONNECT::getInstance();
        $message = htmlspecialchars($message);

        $userGetMess = intval($userGetMess);
        $userSendMess = AUTH::getUserId();
        $message = htmlspecialchars($message);

        $data = "'$userSendMess', '$userGetMess', '$message'";
        $column = "user_send_mess, user_get_mess, message";

        $sql =
            "INSERT " .
            "INTO user_private_messages ($column) VALUES ($data)";

        if (!$result = $connect->query($sql)) {
            LOG::sendLog("Ошибка при добавлении личного сообщения", $connect->err());
        }
    }

    public static function getDialogInfo($user_get_mess) {
        $connect = DB_CONNECT::getInstance();
        $user_get_mess = intval($user_get_mess);
        $user_send_mess = AUTH::getUserId();
        $results = array();

        $sql =
            "SELECT message.user_get_mess, message.user_send_mess, message.message, message.mess_date_add, 
             user.user_id, user.user_first_name, user.user_second_name, user.user_avatar " .
            "FROM user_private_messages message " .
            "JOIN user ON user.user_id = message.user_send_mess " .
            "WHERE
            (message.user_send_mess = $user_get_mess AND message.user_get_mess = $user_send_mess)
               or 
            (message.user_send_mess = $user_send_mess AND message.user_get_mess = $user_get_mess) " .
            "ORDER BY mess_date_add DESC ";

        if (!$result = $connect->query($sql)) {
            LOG::sendLog("Ошибка в запросе личных сообщений", $connect->err());
        } else {
            if ($result->num_rows == 0) {
                $results['error'] = "Сообщений нет!";
            } else {
                while ($row = $result->fetch_assoc()) {
                    $results['data'][] = $row;
                }
            }
        }
        return $results;
    }

    public static function getDialogList() {
        $connect = DB_CONNECT::getInstance();
        $user_id = AUTH::getUserId();
        $results = array();

        /*
                $sql =
                    "(SELECT message.user_get_mess, message.user_send_mess, message.message, message.mess_date_add,
                     user.user_id, user.user_first_name, user.user_second_name, user.user_avatar " .
                    "FROM user_private_messages message " .
                    "JOIN user ON user.user_id = message.user_send_mess " .
                    "WHERE
                    (message.user_send_mess = $user_id OR message.user_get_mess = $user_id) " .
                    "GROUP BY (message.user_get_mess + message.user_send_mess) " .
                    "ORDER BY mess_date_add DESC)";
        */

        $sql =
            "SELECT * " .
            "FROM " .
            "(SELECT * FROM user_private_messages " .
            "WHERE user_send_mess = $user_id OR user_get_mess = $user_id ORDER BY mess_date_add DESC)ms " .
            "JOIN user ON user_id = user_send_mess " .
            "GROUP BY ms.user_get_mess + ms.user_send_mess ORDER BY mess_date_add DESC";

        if (!$result = $connect->query($sql)) {
            LOG::sendLog("Ошибка в запросе личных сообщений", $connect->err());
        } else {
            if ($result->num_rows == 0) {
                $results['error'] = "Диалогов пока нет..";
                LOG::sendLog("Личные сообщения отсутствуют");
            } else {
                while ($row = $result->fetch_assoc()) {
                    $results['data'][] = $row;
                }
            }
        }
        return $results;
    }
}