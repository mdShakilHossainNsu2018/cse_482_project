<?php

require_once("connection.php");
require_once(getenv("ROOT") . "global_constants.php");

class ChatHelper
{
    public static function getMessagesByUserId($userId)
    {
        try {
            $db_conn = Database::getConnection();
            $stmt = $db_conn->prepare("SELECT message_id,
       message,
       channels_channel_id as channel_id,
       create_time,
       sender,
       u.is_admin,
up.name
from messages m
         join
     channels c on
         c.channel_id = m.channels_channel_id
         join users u on sender = u.user_id
join user_profile up on u.user_id = up.users_user_id
where channels_channel_id = (SELECT c.channel_id
                             from channels c
                             where c.users_user_id = ?) order by m.message_id;");
            $stmt->execute(array($userId));
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo "<h1>Error while fetching all user</h1>";
            echo $e->getMessage();
        }
        return null;
    }
}