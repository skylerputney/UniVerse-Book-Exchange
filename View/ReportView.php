<?php


class ReportView{
	private $model;

    public function __construct($model) {
        $this->model = $model;
    }
    public function displayReport($listing){
         $html = '
            <div class="modal fade" id="reportModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Report</h5>
                            <span tabindex="0" class="close" onclick="closeModal(\'reportModal\')">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Report form -->
                            <form action="?action=report" method="POST">
                                <input type="hidden" id="reportedListingID" name="reportedListingID" value="' . $listing['listingID'] . '">
                                <input type="hidden" id="reportedUserID" name="reportedUserID" value="' . $listing['sellerID'] . '"> 
                                <input type="hidden" id="reporterUserID" name="reporterUserID" value="' . $_SESSION['user_id'] . '">
                                <div class="form-group">
                                    <label for="reportMessage">Report Message:</label>
                                    <textarea class="form-control" id="reportMessage" name="reportMessage" rows="4" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit Report</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        ';

        // Return the HTML markup for the report modal
        return $html;
    }

}