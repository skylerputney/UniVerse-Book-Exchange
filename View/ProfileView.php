<?php

require_once $basePath . '/View/MessagesMenuView.php';

class ProfileView {
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function display() {
      $seller = $this->model->fetchUser();

        $html = '<head>
        	<title>UNIverse Book Exchange</title>
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
			<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
			<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
			<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
      <link rel="stylesheet" href="../Styles/star-styles.css">
        <style>
        body {
          font-family: Arial, Helvetica, sans-serif;
          margin: 0;
        }

        html {
          box-sizing: border-box;
        }

        *, *:before, *:after {
          box-sizing: inherit;
        }

        .column {
          float: left;
          width: 50%;
          margin-bottom: 16px;
          padding: 0 8px;
        }

        .card {
          box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
          margin: 8px;
          border: 2px solid violet;
          border-radius: 5px;
          background-color: rgba(200,200,200,0.2);
          color: violet;
        }


        .container {
          width: 100%;
        }

        .row{
          padding-left: 2%;
          padding-right: 2%;
        }

        .container::after, .row::after {
          content: "";
          clear: both;
          display: table;
        }

        .title {
          color: grey;
        }

        .button {
            background-color: rgba(100,100,100,0.5);
            color: violet;
            padding: 10px;
            font-size: 16px;
            border: 2px solid violet;
            cursor: pointer;
            border-radius: 5px;
            width: 40%;
        }

        .button:hover {
            background-color: #0158a3;
        }

        @media screen and (max-width: 650px) {
          .column {
            width: 100%;
            display: block;
          }
        }

        h2{
          text-align: center;
        }

        p{
          text-align: center;
        }

        </style>
        </head>
        <body>';

        $navbar = new Navbar();
        $html .= $navbar->display();

        $html .= '
        <div class="jumbotron" style="padding: 0px;margin-left: 25%;margin-right: 25%;background-color: rgba(200,200,200,0.3);border: 2px solid violet;color: violet;border-radius: 5px;">
            <div class="container text-center">
            <h1> ' . $seller['username'] . '</h1>'.
            '<h2> ' . $seller['university'] . '</h2>'.
            '</div>
        </div>

        <div class="space stars1"></div>
        <div class="space stars2"></div>
        <div class="space stars3"></div>

        <div class="row">
          <div class="column">
            <div class="card">
              <div class="container">
                <h2>Saved Listings</h2>
                    <form action="/saved-listings" class="inline">
                        <p><button class="button" submit-button" >View Saved Listings</button></p>
                    </form>
              </div>
            </div>
          </div>

          <div class="column">
            <div class="card">
              <div class="container">
                <h2>Your Listings</h2>
                    <form action="/your-listings" class="inline">
                        <p><button class="button" submit-button" >View Your Listings</button></p>
                    </form>
              </div>
            </div>
          </div>

          
        </div>

        </body>';

        $messagesMenuModal = new MessagesMenuView($this->model);

        return $html . $messagesMenuModal->display();
    }
}
