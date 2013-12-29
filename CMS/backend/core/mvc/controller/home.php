<?php

namespace ITC\CMS;

class c_home extends controller {

    public function __construct(){
	parent::__construct("home");
    }
    
    public function start(){
	$this->view->out();
    }
    
}

?>