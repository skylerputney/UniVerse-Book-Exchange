<?php
trait CreateListingModel {
    private $db;
    private $bookName;
    private $bookAuthor;
    private $bookPrice;
    private $sellerID;
    private $bookCondition;
    private $bookImgPath;


    /**
     * @brief Inserts a listing into the database with information from model
     * @return $data True if inserted, false otherwise
     */
    public function insertListing() {
        $query = "INSERT INTO listings (sellerID, bookName, bookAuthor, bookPrice, bookCondition, bookImg, creationDate) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $data = $this->db->query($query, [$this->sellerID, $this->bookName, $this->bookAuthor, $this->bookPrice, $this->bookCondition, $this->bookImgPath, date("Y-m-d H:i:s")]);
        return $data;
    }

    /**
     * @brief Sets the model's bookName for database query purposes
     * @param $bookName
     */
    public function bookName($bookName) {
        $this->bookName = $bookName;
    }

    /**
     * @brief Sets the model's bookCondition for database query purposes
     * @param $bookCondition
     */
    public function bookCondition($bookCondition) {
        $this->bookCondition = $bookCondition;
    }

    /**
     * @brief Sets the model's bookImg for database query purposes
     * @param $bookImg
     */
    public function bookImgPath($bookImgPath) {
        $this->bookImgPath = $bookImgPath;
    }

    /**
     * @brief Sets the model's bookAuthor for database query purposes
     * @param $bookAuthor
     */
    public function bookAuthor($bookAuthor) {
        $this->bookAuthor = $bookAuthor;
    }

    /**
     * @brief Sets the model's bookPrice for database query purposes
     * @param $bookPrice
     */
    public function bookPrice($bookPrice) {
        $this->bookPrice = $bookPrice;
    }

    /**
     * @brief Sets the model's sellerID for database query purposes
     * @param $sellerID
     */
    public function sellerID($sellerID) {
        $this->sellerID = $sellerID;
    }

}