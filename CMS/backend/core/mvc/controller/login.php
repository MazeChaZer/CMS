<?php
class c_login extends controller {
    
    public function __construct(){
	parent::__construct("login");
	$this->setIsPublic(TRUE);
    }
    
    public function start(){
	$this->view->out();
    }
    
}
?>