<?php

namespace ITC\CMS;

class Controller
{
    protected $view;
    private $isPublic = FALSE;
    
    
    public function __construct($pagename){
        $this->view = new View($pagename);
        if(isset($_SESSION['user'])){
            new Model(); //q+d
            $this->view->setUserrights(Model::getUserrights($_SESSION['user']));
        }
    }
    
    public function getIsPublic(){
        return $this->isPublic;
    }
    
    public function setIsPublic($isPublic){
        $this->isPublic = $isPublic;
    }
}

?>