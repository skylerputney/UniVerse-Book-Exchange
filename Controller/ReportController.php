<?php

trait ReportController{

    /**
     * @brief  Sends Report information from a POST request to Model for insertion into Database, updates Model's status array with appropriate error/success messages
     */
    public function report(){
        if (empty($_POST['reportMessage'])){
            $this->model->addStatus("reportMessageEmpty");
            //Prevent further execution; cannot file a blank report
            return;
        }

        //Ensure reportedListingID, reportedUserID, reporterUserID fields from HTTP request are not empty
        if (empty($_POST['reportedListingID'])){
            $this->model->addStatus("reportedListingEmpty");
            return;
        }
        else if(empty($_POST['reportedUserID'])){
            $this->model->addStatus("reportedUserIDEmpty");
            return;
        }
        else if(empty($_POST['reporterUserID'])){
            $this->model->addStatus("reporterUserIDEmpty");
            return;
        }

        //Insert report into database
        $successfulInsert = $this->model->insertReport($_POST['reportedListingID'], $_POST['reportedUserID'], $_POST['reporterUserID'], $_POST['reportMessage']);

        if($successfulInsert){
            //Add status to model
            $this->model->addStatus("reportSuccessful");
        }
        else{
            $this->model->addStatus("reportFailed");
        }
    }

    /**
     * @brief  Sends reportID from a POST request to Model for deletion from Database after ensuring deleting User is User who created Report;
     *         updates Model's status array with appropriate error/success messages
     */
    public function deleteReport(){
        if(empty($_POST['reportID'])){
            //Cannot delete if don't have reportID
            $this->model->addStatus("reportIDEmpty");
            return;
        }

        if($this->model->deleteReport($_POST['reportID'])) {
            //Successful deletion from database
            $this->model->addStatus("reportDeleted");
        }
        else {
            //Failed to delete from database
            $this->model->addStatus("reportDeletionFailed");
        }
    }
}