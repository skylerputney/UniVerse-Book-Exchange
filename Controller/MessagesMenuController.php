<?php

trait MessagesMenuController{

	/**
     * @brief Sends a message through model to be pushed to database using senderID, receiverID, and Message posts in message sending
     */
    public function sendMessage() {
        if (!empty($_POST['senderID']) && !empty($_POST['receiverID']) && !empty($_POST['messageText'])) {
            $this->model->insertMessage($_POST['senderID'], $_POST['receiverID'], $_POST['messageText']);
        }
        if(empty($_POST['currentRoute'])){
            //Refresh current page
            header("Refresh:0");
        }
        else{
            //Route user back to previous message box
            header("Location: " . $_POST['currentRoute']);
        }
    }

    public function setOtherUserID(){
        if(isset($_POST['contactSeller'])){
            $this->model->setOtherUserID($_POST['contactSeller']);
        }

        header("Location: " . $_SERVER['HTTP_REFERER'] . "?messages");
    }
}