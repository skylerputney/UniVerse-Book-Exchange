<?php
    
class TermsOfServiceController{
    private $model;

	public function __construct(TermsOfServiceModel $model){
		$this->model = $model;
	}
    
    public function iAgree(){
        header("Location: /login?action=accountCreated");
    }
}