<?php
include_once $basePath . '/View/CreateListingView.php';
include_once $basePath . '/View/ListingView.php';
require_once $basePath . '/View/MessagesMenuView.php';

class SavedListingsView{
	private $model;

	public function __construct($model){
		$this->model = $model;
	}

	public function display(){
		$seller = $this->model->fetchUser();

		$html = '
		<head>
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
			<style>
			body {
				background: radial-gradient(ellipse, navy 0, black 100%);
				background-color:0;
				height: 100vh;
				overflow: hidden;
				display: flex;
				justify-content: center;
				align-items: center;
			}


			.sorting-buttons {
				display: flex;
				justify-content: center;
				margin: 10px;
			}

			#viewListingModal {
				display: block !important;
				opacity: 1 !important;
			}

			.custom-button {
				background-color: rgba(200,200,200,0.2);
				color: violet;
				padding: 10px 20px;
				font-size: 16px;
				border: 2px solid violet;
				border-radius: 5px;
				cursor: pointer;
				margin: 10px;
				font-weight:bold;
			}

			.custom-button:hover {
				background-color: #0158a3;
			}

			.modal-title {
				text-align: center;
				font-weight: bold;
			}

			.jumbotron {
				margin-bottom: 0;
				padding-top: 12px;
				height: 150px;
				background-color: rgba(0,0,0,0);
			}

			.container {
				width: 100%;
				padding-left: 15px;
				padding-right: 15px;
			}

			.jumbotron h1 {
				font-size: 2.5em; /* Adjust font size as needed */
			}

			.jumbotron p {
				font-size: 1.2em; /* Adjust font size as needed */
			}

			@media (max-width: 767px) {
				.jumbotron {
					height: auto;
				}

				.jumbotron h1 {
					font-size: 2em; /* Adjust font size for smaller screens */
				}

				.jumbotron p {
					font-size: 1em; /* Adjust font size for smaller screens */
				}

				.sorting-buttons {
					flex-direction: column;
					align-items: center;
				}

				.custom-button {
					margin-bottom: 10px;
				}
			}

			.point{
				cursor:pointer;
			}

			.search-bar{
				background-color: rgba(200,200,200,0.2);
				color: violet;
				height: 36px;
				font-weight: bold;
				width: 100%;
				border: 2px solid violet;
				padding: 0.5%;
			}

			.search-bar::placeholder{
				opacity: 1;
  				color: #d382ee;
				font-weight:bold;
			}

			.search-button{
				background-color: rgba(200,200,200,0.2);
				color: violet;
				border-color: violet;
				border-width: 2px;
				font-weight:bold;
			}

			</style>
			</style>
		</head>
		';

        $navbar = new Navbar;
        $html .= '<body style="background: radial-gradient(ellipse, navy 0, black 100%); background-attachment:fixed;">';
        $html .= $navbar->display();
        $html .= '

	    <div class="jumbotron">
        <div class="container text-center" style="width: 450px;border-radius: 10px;background-color: rgba(200,200,200,0.2);border-color: violet;border: 2px solid violet;">
			<h1 style="color:violet;">' . $seller['username'] . '\'s Saved Listings</h1>;
            <p style="color:violet; font-weight:bold;">' . $seller['university'] . '</p>
        </div>
    </div>

	<div class="space stars1"></div>
	<div class="space stars2"></div>
	<div class="space stars3"></div>

    <div class="jumbotron" style="padding-bottom: 12px;height: 70px;">
        <div class="container text-center">
            <form method="POST">
                <div class="input-group">
                    <input type="hidden" value="savedlistings" name="route">
                    <input type="hidden" value="getSavedListings" name="action">
                    <input type="text" class="search-bar" placeholder="Search (Author, Title, or University)" name="searchParam" style="border-top-left-radius: 4px;border-bottom-left-radius: 4px;">
                    <div class="input-group-btn">
                        <button class="btn btn-outline-success my-2 my-sm-0 search-button" type="submit">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


	<div class="sorting-buttons">
            <form class="sort-form" method="POST">
                <div class="input-group">
                    <input type="hidden" value="home" name="route">
                    <input type="hidden" name="searchParam" value="' . $this->model->getSearchParam() . '">
                    <input type="hidden" value="sortListings" name="action">
                        <button name="bestMatch" class="custom-button">Best Match</button>
                        <button name="newest" class="custom-button">Newest</button>
                        <button name="lowestPrice" class="custom-button">Lowest Price</button>
                        <button name="highestPrice" class="custom-button">Highest Price</button>
                </div>
            </form>
	</div>


		 </div>
		 </div>

			</html>
		</body>
		';

		//Grid of Listings
        $listings = $this->model->getCurrentSavedListings();
        $listingView = new ListingView($this->model);
        $count = 0;
        if (!empty($listings)) {
            $html .= "<div class=\"container\"><div class=\"row\">";

            foreach ($listings as $listing) {
                // Close old and start new row every 3rd item
                if ($count % 3 == 0 && $count > 0) {
					$html .= "</div><div class=\"row\">";
                }

                $html .= "<div class=\"col-sm-4\">";
                $html .= "<div tabindex=\"0\" class=\"panel panel-primary open-modal point\" data-modal-id=\"viewListingModal" . $listing['listingID'] . "\" style=\"border: 2px solid violet;background-color: rgba(0,0,0,0.2);\">";
                $html .= "<div class=\"panel-heading\" style=\"border-bottom: 2px solid violet;background-color: rgba(200,100,200,0.3);color: violet; font-weight:bold;\">" . $listing['bookName'] . "</div>";
                $html .= "<div class=\"panel-body\" style=\"height: 200px; overflow: hidden; display:flex; justify-content: center; background-color: rgba(200,200,200,0.2);\">"; // Image now scales to fit within each box, boxes all same size
                $html .= "<img src=\"" . $listing['bookImg'] . "\" class=\"img-responsive\" style=\"width:auto; height:100%; object-fit: cover;\" alt=\"Image\">";
                $html .= "</div>";
                $html .= "<div class=\"panel-footer\" style=\"border-top: 2px solid violet;background-color: rgba(200,100,200,0.3);color: violet; font-weight:bold;\">$" . $listing['bookPrice'] . "</div>";
                $html .= "</div></div>";
				//creates listing modal for current listing
				$html .= $listingView->getModal($listing);

                $count++;
            }

            // Close the last row div and close container div
            $html .= "</div></div>";
        }



		// JavaScript functions for opening and closing modal
		$html .= "<script>
			$(document).ready(function () {
				const urlParams = new URLSearchParams(window.location.search);
				let modalId = urlParams.get('openModal');
				let modal = $('#' + modalId);

				if (modal.length) {
					modal.css({
						'display': 'flex',
						'align-items': 'center',
						'justify-content': 'center',
						'opacity': 1
					});

					// Prevent modal from closing when clicking outside
					modal.on(\"click\", function (event) {
						if (event.target !== modal) {
							// Route to home
							window.location.href = '/home';
						}
					});

					// Prevent modal from closing when clicking form elements inside it
					modal.find(\"form, input, button, div\").on(\"click\", function (event) {
						event.stopPropagation(); // Stop event propagation
					});

					modal.modal('show');
				}


				// Handle opening the modal when clicking on a panel with the \"open-modal\" class
				$('.open-modal').on('click', function() {
					const modalId = $(this).data('modal-id');
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
				});
					});

				function closeModal(modalId) {
					 $('#' + modalId).modal('hide');
				}

		</script>";


			$createListingModal = new CreateListingView($this->model);
			$messagesMenuModal = new MessagesMenuView($this->model);
			return $html . $createListingModal->display() . $messagesMenuModal->display();

		}

}