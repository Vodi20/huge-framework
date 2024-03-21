<?php

/**
 * This controller shows an area that's only visible for logged in users (because of Auth::checkAuthentication(); in line 16)
 */
class ChatController extends Controller
{
    /**
     * Construct this object by extending the basic Controller class
     */
    public function __construct()
    {
        parent::__construct();

        // this entire controller should only be visible/usable by logged in users, so we put authentication-check here
        Auth::checkAuthentication();
    }

    /**
     * This method controls what happens when you move to /chat/index in your app.
     */
    public function index()
    {
        $userId = Session::get('user_id');

    
        $chatId = ChatModel::getChatIdFromSessionUser($userId);

        $messages = ChatModel::getAllMessages($chatId);
        
        
        
        $this->View->render('chat/index', array(
            'messages' => $messages         
        ));
    }

    public function sendMessage() {

        $userId = Session::get('user_id');


        $chatId = ChatModel::getChatIdFromSessionUser($userId);
        $message = Request::post('message');
        ChatModel::sendMessage(Session::get('user_id'), $message, $chatId);
        Redirect::to('chat/index');
    }


    
}
