<?php

trait CreateListingController{

    /**
     * @brief Creates a listing utilziing info from a POST request, updates Model's status array
     */
    public function createListing() {
        //Add listing info to model
        if (!empty($_SESSION['user_id'])) {
            $this->model->sellerID($_SESSION['user_id']);
        } else {
            //Route user to login if session invalid
            header("Location: /login");
        }
        if (!empty($_POST['bookName'])) {
            $this->model->bookName($_POST['bookName']);
        }
        if (!empty($_POST['bookAuthor'])) {
            $this->model->bookAuthor($_POST['bookAuthor']);
        }
        if (!empty($_POST['bookPrice'])) {
            $this->model->bookPrice($_POST['bookPrice']);
        }
        if (!empty($_POST['bookCondition'])) {
            $this->model->bookCondition($_POST['bookCondition']);
        }
        if (isset($_FILES['bookImg'])) {
            $file = $_FILES["bookImg"];
            $fileName = $file['name'];
            $fileTmpName = $file['tmp_name'];
            $fileSize = $file['size'];

            $fileExt = explode('.', $fileName);
            $fileExtLowCase = strtolower(end($fileExt));

            $allowedFile = array('jpg', 'jpeg', 'png', 'pdf');

            if (in_array($fileExtLowCase, $allowedFile)) {

                if ($file['error'] == 0) {
                    if ($fileSize < 1048576) {
                        $fileNameNew = uniqid('', true) . "." . $fileExtLowCase;
                        $fileDestination = __DIR__ . "\Images\\" . $fileNameNew;
                        move_uploaded_file($fileTmpName, $fileDestination);

                        $fileListingImage = "Controller/Images/" . $fileNameNew;
                        $this->model->bookImgPath($fileListingImage);

                    } else {
                        $this->model->addStatus("imgTooBig");
                    }
                } else {
                    $this->model->addStatus("fileError");
                }
            } else {
                $this->model->addStatus("wrongExtension");
            }

        } else {
            $this->model->addStatus("emptyFile");
        }

        if (empty($this->model->getStatusAry())) {
            $savedListing = $this->model->insertListing();
            if ($savedListing) {
                header("Location: /your-listings");
            } else {
                $this->model->addStatus("failedInsert");
            }
        }
    }
}