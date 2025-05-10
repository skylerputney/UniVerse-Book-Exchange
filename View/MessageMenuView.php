<?php

class MessageMenuView{
    private $model;

    public function __construct($model){
        $this->model = $model;
    }

    public function display(){
        $html = '<div class="modal" id="messageMenuModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"> 
                    <div class="modal-dialog" style="overflow-y: scroll; max-height:85%;  margin-top: 50px; margin-bottom:50px;" > 
                        <div class="modal-content"> 
                            <div class="modal-header"> 
                                <h3 class="modal-title">Messages</h3> 
                            </div> 

                            <div class="modal-body">
                            <form method="POST">';
                            //fetches all users chats between the User and other User
                            $chats = $this->model->fetchChattedUsers();
                            $userChats = array();
                            //creates an ordered list of all open chats with people
                            foreach($chats as $chat){
                                //other users ID
                                $otherUserID = ($_SESSION['user_id'] == $chat['senderID'])? $chat['receiverID'] : $chat['senderID'];
                                //fetches other users info 
                                $otherUser = $this->model->fetchChatUserByID($otherUserID);
                                $otherUsername = $otherUser['username'];
                                
                                
                                if(!in_array($otherUsername, $userChats)){
                                    $userChats[] = $otherUsername;
                                    $this->model->senderID($chat['senderID']);
                                    $this->model->receiverID($chat['receiverID']);
        $html .=                   '<li>
                                        <input type="hidden" value="getMessages" name="action">
                                        <input type="hidden" name="senderID" value="' . $chat['senderID'] . '"
                                        <input type="hidden" name="receiverID" value="'. $chat['receiverID'] .'">
                                        <input type="hidden" name="otherUsername" value="'. $otherUsername .'">
                                        <button name="otherUserID" type="submit">'. $otherUsername .'</button>
                                    </li>';  
                                }   
                            }
        $html .=           '</form>
                            </div> 

                            <div class="modal-footer">
                                Empty
                            </div> 

                        </div> 
                    </div> 
                </div>';



        return $html;
    }
}