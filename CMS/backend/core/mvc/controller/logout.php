<?php

namespace ITC\CMS;

class c_logout extends controller {
    
    public function __construct(){
        parent::__construct("logout");
    }
    
    public function start(){
        unset($_SESSION['user']);
        header('Location: '.BACKENDURL.'index.php?page=login');
        die;
    }
    
}
?>
