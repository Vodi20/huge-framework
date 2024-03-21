<?php

/**
 * UserModel
 * Handles all the PUBLIC profile stuff. This is not for getting data of the logged in user, it's more for handling
 * data of all the other users. Useful for display profile information, creating user lists etc.
 */
class ChatModel
{

    public static function getAllMessages($chatid){
        $database = DatabaseFactory::getFactory()->getConnection();
        
        $sql = "SELECT id,texts,timing,user_id FROM t_messages WHERE chat_id = '" . $chatid ."' ORDER BY timing";
        $query = $database->prepare($sql);
        $query->execute();
        
        // fetchAll() is the PDO method that gets all result rows
        $res = $query->fetchAll();
        
        return $res;
    }
    public static function getChatIdFromSessionUser($userid){
        $database = DatabaseFactory::getFactory()->getConnection();
    
        $sql = "SELECT id FROM t_chats WHERE pers1 = :userid OR pers2 = :userid";
        $query = $database->prepare($sql);
        $query->bindParam(':userid', $userid, PDO::PARAM_INT);
        $query->execute();
        
        // fetch() is the PDO method that gets the first result row
        $res = $query->fetch(PDO::FETCH_ASSOC);
        
        return $res ? $res['id'] : null;

    }
   
    public static function sendMessage($userId, $texts, $chatid) {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "INSERT INTO t_messages (user_id, texts, chat_id) VALUES (:user_id, :texts, :chatid)";
        $query = $database->prepare($sql);
        $query->execute([
            ':user_id' => $userId,
            ':texts' => $texts,
            ':chatid' => $chatid
        ]);
}

    
}