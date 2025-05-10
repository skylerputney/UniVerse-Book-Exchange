<?php

class LoadingView{
	public function __construct($model) {
        $this->model = $model;
    }

    public function display(){
        return "<h1>Loading</h1>";
    }
}