<?php

class MessagesMenuView {
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    /**
     * @brief Returns a modal containing messaged users and associated messages
     * @return $html messaging modal and associated javascript
     */
    public function display() {
        $html = "<div id=\"messagesMenuModal\" class=\"modal fade\">";
        $html .= "<div class=\"modal-dialog\">";
        $html .= "<div class=\"modal-content\">";
        $html .= "<div class=\"modal-header\">";
        $html .= "<h4 class=\"modal-title\" style=\"color: white;\">" . "Chats" . "</h4>";
        $html .= "<span tabindex=\"0\" class=\"close\" onclick=\"closeModal('messagesMenuModal')\">&times;</span>";
        $html .= "</div>";
        $html .= "<div class=\"modal-body\" style=\"display: flex;\">";

        $html .= "<div style=\"flex: 1; border-right: 1px solid #ccc; padding-right: 10px;\">";
        $html .= "<h5 style=\"margin-bottom: 10px; color: violet;\"><strong>Users</strong></h5>";
        $html .= $this->getUserListDisplay();
        $html .= "</div>";

        $html .= "<div style=\"flex: 2; padding-left: 10px;\">";
        $html .= "<h5 style=\"margin-bottom: 10px; color: violet;\"><strong>Chats</strong></h5>";

        // Get the otherUserID from the URL
        $selectedUserID = isset($_GET['otherUserID']) ? $_GET['otherUserID'] : null;


        // Get the chat display HTML from getUserChats function for the selected user
        if ($selectedUserID) {
            $html .= $this->getUserChats($selectedUserID);
        } else {
            $html .= "<div id=\"chatDisplay\"><p style=\"color: violet;\"><strong>No User Selected</strong></p></div>";
        }

        //Add chat box if another user actively selected
        if ($selectedUserID) {
            $html .= $this->getMessageBox($_SESSION['user_id'], $selectedUserID);
        }

        //Close chats panel div
        $html .= "</div>";


        $html .= "</div>";
        $html .= "</div></div>";
        $html .= "</div>";
        $html .= "</div></div></div>";

        $html .= $this->getModalJavaScript();

        //Styling
        $html .= '<head><link rel="stylesheet" href="../View/Styles/ListingView.css"></head>';

        return $html;
    }

    public function getUserListDisplay() {
        $chattedIDs = $this->model->fetchChattedUsers();
        $alreadyChatted = array();
        $html = "<ul>";
        foreach ($chattedIDs as $chattedID) {
            $alreadyChatted[] = $chattedID;
            $otherUserID = ($_SESSION['user_id'] == $chattedID['senderID']) ? $chattedID['receiverID'] : $chattedID['senderID'];
            $otherUsername = $_SESSION['user_id'] == $chattedID['senderID'] ? $this->model->fetchUserByID($chattedID['receiverID'])['username'] : $this->model->fetchUserByID($chattedID['senderID'])['username'];
            if (!in_array($otherUsername, $alreadyChatted)) {
                $alreadyChatted[] = $otherUsername;
                $html .= "<li><a class=\"open-modal\" data-modal-id=\"messagesMenuModal\" href=\"?messages&otherUserID=$otherUserID\" style=\"color: violet;\">" . $otherUsername . "</a></li>";
            }
        }
        $html .= "</ul>";

        return $html;
    }

    public function getUserChats($otherUserID) {
        $chats = $this->model->fetchMessages($_SESSION['user_id'], $otherUserID);
        $html = "<div id=\"chatDisplay\">";
        if (!empty($chats)) {
            foreach ($chats as $chat) {
                if ($chat['senderID'] == $_SESSION['user_id']) {
                    //Current user is Sender
                    $html .= "<p>" . "<strong>" . "Me: " . "</strong>" . $chat['message'] . "</p>";
                } else {
                    //Current user is Receiver
                    $html .= "<p>" . "<strong>" . $this->model->fetchUserByID($otherUserID)['username'] . ": </strong>" . $chat['message'] . "</p>";
                }
            }
        } else {
            $html .= "<p>This is the beginning of your chatting history with <strong>" . $this->model->fetchUserByID($otherUserID)['username'] . "</strong></p>";
        }
        $html .= "</div>";

        return $html;
    }

    /**
     * @brief Returns HTML for send message box
     * @return $html
     */
    public function getMessageBox($senderID, $receiverID) {
        $html = "<div style=\"flex: 2; padding-left: 10px;\">"; // Adjust flex and padding to match the existing style
        $html .= "<div id=\"sendMessageForm\" style=\"background-color: rgba(50, 50, 50, 0.8); padding: 10px; border-radius: 5px;\">";
        $html .= "<form id=\"messageForm\" action=\"?action=sendMessage\" method=\"post\">";
        $html .= "<input type=\"hidden\" name=\"senderID\" value=\"" . $senderID . "\">";
        $html .= "<input type=\"hidden\" name=\"receiverID\" id=\"receiverID\" value=\"" . $receiverID . "\">";
        $html .= "<input type=\"hidden\" name=\"currentRoute\" id=\"currentRoute\" value=\"" . $_SERVER['REQUEST_URI'] . "\">";
        $html .= "<textarea name=\"messageText\" id=\"messageText\" placeholder=\"Type your message...\" style=\"width: 100%; height: 60px; border-radius: 3px; background-color: transparent; color: violet; border: 2px solid violet; padding: 5px;\"></textarea>";
        $html .= "<button type=\"submit\" style=\"margin-top: 10px; padding: 5px 10px; background-color: rgba(200, 200, 200, 0.2); color: violet; border: 2px solid violet; border-radius: 3px; cursor: pointer;\">Send</button>";
        $html .= "</form>";
        $html .= "</div>";
        $html .= "</div>";

        return $html;
    }

    public function getModalJavaScript() {
        $html = "
    <script>
    $(document).ready(function() {
        // Function to open a modal by ID
        function openModalById(modalId) {
            const modal = $('#' + modalId);
            if (modal.length) {
                modal.css({
                    'display': 'flex',
                    'align-items': 'center',
                    'justify-content': 'center',
                    'opacity': 1
                });
                modal.modal('show');
            }
        }

        // Function to close a modal by ID
        function closeModalById(modalId) {
            $('#' + modalId).modal('hide');
        }

        // Function to handle opening a modal when clicking on a panel with the open-modal class
        $('.open-modal').on('click', function() {
            const modalId = $(this).data('modal-id');
            openModalById(modalId);
        });

        $('.modal').find('form, input, button, div').on('click', function(event) {
            event.stopPropagation(); // Stop event propagation
        });

        // Check for 'messages' in URL params and show the messagesMenuModal
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('messages')) {
            openModalById('messagesMenuModal');
        }
    });

    // Function to close a modal externally
    function closeModal(modalId) {
        $('#' + modalId).modal('hide');
    }
    </script>
    ";

        return $html;
    }
}


// JavaScript function to display chats
?>
<script>
    function displayChat(username) {
        let chatDisplay = document.getElementById('chatDisplay');
        if (username) {
            fetchChatForUser(username, function(chatContent) {
                chatDisplay.innerHTML = chatContent;
            });
        } else {
            chatDisplay.innerHTML = "<p>No User Selected</p>";
        }
    }

    function fetchChatForUser(username, callback) {
        let fakeChatContent = "<p>Fetching chat for " + username + "</p>";
        setTimeout(function() {
            callback(fakeChatContent);
        }, 1000); // Simulated delay of 1 second
    }
</script>