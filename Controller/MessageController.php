<?php

trait MessageController {
    /**
     * @brief Retrieves messages associated to users id and receivers id
     * @return array of messages
     */
    public function getMessages() {
        //sets model receiverID value and senderID 
        if (!empty($_POST['senderID']) && !empty($_POST['receiverID'])) {
            $this->model->senderID($_POST['senderID']);
            $this->model->receiverID($_POST['receiverID']);
            return $this->model->fetchMessages();
        }
    }

    /**
     * @brief Sends a message through model to be pushed to database using senderID, receiverID, and Message posts in message sending
     */
    public function sendMessage() {
        if (!empty($_POST['senderID']) && !empty($_POST['receiverID']) && !empty($_POST['messageText'])) {
            $senderId = $_POST['senderID'];
            $receiverId = $_POST['receiverID'];
            $message = $_POST['message'];
            header("Refresh:0");
            $this->model->insertMessage($senderId, $receiverId, $message);

        }
    }
}