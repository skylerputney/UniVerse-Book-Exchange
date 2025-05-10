<?php

class MessageView{
    private $model;

    public function __construct($model){
        $this->model = $model;
    }

    public function display(){
        $messages = $this->model->fetchMessages();
        $otherUser = $this->model->getOtherUser();
        $otherUsername = $otherUser['username'];
        $html = '<div class="modal" id="messageModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"> 
                    <div class="modal-dialog" style="overflow-y: scroll; max-height:85%;  margin-top: 50px; margin-bottom:50px;" > 
                        <div class="modal-content"> 
                            <div class="modal-header"> 
                                <h3 class="modal-title">'. $otherUsername .'</h3> 
                            </div> 

                            <div class="modal-body">';

                                foreach($messages as $message){
        $html .=                    '<strong>'. $message['senderID'] .':</strong>' . $message['message'] . '<br>';
                                }
                                
        $html .=           '</div> 

                            <div class="modal-footer">
                                <form method="POST">
                                    <input type="hidden" value="'. $otherUser['id'] .'" name="receiverID">
                                    <input type="hidden" value="'. $_SESSION['user_id'] .'" name="senderID">
                                    <input type="hidden" value="sendMessage" name="action">
                                    <input type="text" name="messageText">
                                    <button type="submit">Send</button>
                                </form>
                            </div> 

                        </div> 
                    </div> 
                </div>';



        return $html;
    }
}