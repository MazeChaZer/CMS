<?php

class Controller
{
    protected $view;
    private $isPublic = FALSE;
    
    
    public function __construct($pagename){
        $this->view = new View($pagename);
    }
    
    public function getIsPublic(){
        return $this->isPublic;
    }
    
    public function setIsPublic($isPublic){
        $this->isPublic = $isPublic;
    }
}