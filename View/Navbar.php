<?php

require_once $basePath . "/View/MessagesMenuView.php";

class Navbar{

    public function display() {
        $html = '
            <div class="navbar-container">
                <nav class="navbar navbar-inverse navbar-fixed-top">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="home" style="color: white;  width: 50px; padding: 5px;"><img src="../View/Logos/small-logo.png" alt="Small Logo" style="width: 100%; height: 100%;"></a>
                        </div>
                        <div class="collapse navbar-collapse" id="myNavbar">
                            <ul class="nav navbar-nav">
                                <li><a href="/home" style="color: white;">Home</a></li>
                                <li><a href="/home?openModal=createListingModal" style="color: white;">Sell</a></li>
                                <li><a href="/profile" style="color: white">Profile</a></li>
                                <li style="color: white;"><div tabindex="0" class="open-modal" data-modal-id="messagesMenuModal" style="padding: 15px;cursor: pointer;">Messages</div></li>
                                <li><a href="/login?action=loggedOut" style="color: white">Log Out</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        <style>
            .navbar-container {
                padding-top: 70px; /* Adjust this value based on the height of your navbar */
            }

            @media (max-width: 767px) {
                .navbar-header {
                    float: none;
                }
                .navbar-left, .navbar-right {
                    float: none !important;
                }
                .navbar-toggle {
                    display: block;
                    margin-right: 15px;
                }
                .navbar-collapse {
                    border-top: 1px solid transparent;
                    box-shadow: inset 0 1px 0 rgba(255,255,255,0.1);
                }
                .navbar-fixed-top {
                    top: 0;
                    border-width: 0 0 1px;
                }
                .navbar-collapse.collapse {
                    display: none!important;
                }
                .navbar-nav {
                    float: none!important;
                    margin-top: 7.5px;
                }
                .navbar-nav>li {
                    float: none;
                }
                .navbar-nav>li>a {
                    padding-top: 10px;
                    padding-bottom: 10px;
                }
                .collapse.in {
                    display: block !important;
                }
            }
        </style>
        <script>
        //makes all focused items clickable by space or enter
        document.addEventListener("keydown", function(e) {
            if (e.code == "Space" || e.code == "Enter") {
                document.activeElement.click();
        }});
        </script>';

        return $html;
    }
}