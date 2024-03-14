<?php

/**
 * UserModel
 * Handles all the PUBLIC profile stuff. This is not for getting data of the logged in user, it's more for handling
 * data of all the other users. Useful for display profile information, creating user lists etc.
 */
class ChatModel
{
    public function getAllMessages(){
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT texts FROM t_messages WHERE chat_id = :chat_id";
        $query = $database->prepare($sql);
        $query->execute(array(':chat_id' => Session::get('chat_id')));

        // fetchAll() is the PDO method that gets all result rows
        return $query->fetchAll();
    }
}