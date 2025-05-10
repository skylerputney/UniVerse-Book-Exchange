<?php

class createListingView{
    private $model;

    public function __construct($model){
        $this->model = $model;
    }

    public function display(){
        		//createListingModal
        $html =
            '<div class="modal fade" id="createListingModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
			 <div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h3 class="modal-title" id="modalTitle">Create Listing</h3>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="window.location.href=\'/home\'">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				<form method="POST" enctype="multipart/form-data" class="createListingForm">
					<div class="modal-body">

						    <input type="hidden" name="route" value="home">
						    <input type="hidden" name="action" value="createListing">

						    <div class="form-group">
                                <label for="bookName">Book Title</label>
                                <input type="text" class="form-control" name="bookName" id="bookName" placeholder="Book Title" required>
                            </div>
                            <div class="form-group">
                                <label for="bookAuthor">Book Author</label>
                                <input type="text" class="form-control" name="bookAuthor" id="bookAuthor" placeholder="Book Author" required>
                            </div>
                            <div class="form-group">
                                <label for="bookPrice">Book Price</label>
                                <input type="number" step=".01" class="form-control" name="bookPrice" id="bookPrice" placeholder="Book Price" required>
                            </div>
                            <div class="form-select">
                                <label for="bookCondition">Book Condition</label><br>
                                  <div class="custom-select">
                                    <select id="bookCondition" name="bookCondition">
                                        <option value="new">New</option>
                                        <option value="good">Good</option>
                                        <option value="slightly_used">Slightly Used</option>
                                        <option value="used">Used</option>
                                        <option value="damaged">Damaged</option>
                                    </select>
                                </div>
                            </div><br>
							<div class="form-group">
                                <label for="bookImg">Book Image</label>
                                <input type="file" class="form-control" name="bookImg" id="bookImg" required>
                            </div>';

            //Conditional Display
            $statusAry = $this->model->getStatusAry();
            if (!empty($statusAry)) {
                if (in_array("wrongExtension", $statusAry)) {
                    $html .= '
											    <div class="alert alert-danger">Please use a .pdf, .jpeg, .jpg, or .png file extension!</div>';
                }
                if (in_array("fileError", $statusAry)) {
                    $html .= '
											    <div class="alert alert-danger">Error Uploading Image!</div>';
                }
                if (in_array("imgTooBig", $statusAry)) {
                    $html .= '
											    <div class="alert alert-danger">Image Too Large!</div>';
                }
                if (in_array("emptyFile", $statusAry)) {
                    $html .= '
											    <div class="alert alert-danger">Empty Image File!</div>';
                }
                if (in_array("failedInsert", $statusAry)) {
                    $html .= '
											    <div class="alert alert-danger">Could not upload! Please try again!</div>';
                }

            }

            //Modal Footer
            $html .= '</div>
					    <div class="modal-footer">
						    <button type="button" class="btn violet-button" data-dismiss="modal" onclick="window.location.href=\'/home\'">Close</button>
						    <button type="submit" class="submit-button btn violet-button" id="submit">Create Listing</button>
					    </div>
				    </form>
				    </div>
			     </div>
		         </div>';

            //Styling
            $html .= '<head><link rel="stylesheet" href="../View/Styles/CreateListingView.css"></head>';


            return $html;
        }

}