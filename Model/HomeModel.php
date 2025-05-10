<?php

require_once $basePath . "/Model/CreateListingModel.php";
require_once $basePath . "/Model/ListingModel.php";
require_once $basePath . "/Model/MessageModel.php";
require_once $basePath . "/Model/MessageMenuModel.php";
require_once $basePath . "/Model/MessagesMenuModel.php";

class HomeModel{
    private $db;
    private $statusAry;
    use CreateListingModel;
    use ListingModel;
    use MessagesMenuModel;


	public function __construct($db){
		$this->db = $db;
		$this->searchParam = '';
	}

    /**
     * @brief Returns any statuses stored within the model
     * @return Array of statuses (Strings)
     */
    public function getStatusAry() {
        return $this->statusAry;
    }

    /**
     * @brief Returns true if status stored within model's statusAry
     * @return true | false
     */
    public function hasStatus($status){
        if($this->statusAry == NULL){
            return false;
        }
        return in_array($status, $this->statusAry);
    }

    /**
     * @brief Stores a new status within the model
     * @param $status Status to add to the model (String)
     */
    public function addStatus($status) {
        $this->statusAry[] = $status;
    }


}

  