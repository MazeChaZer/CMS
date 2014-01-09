<?php

namespace ITC\CMS;

require_once('core/mvc/model/entities/User.php');

class c_login extends controller {
    
    public function __construct(){
        parent::__construct("login");
        $this->setIsPublic(TRUE);
    }
    
    public function start(){
        if(isset($_POST['cms-logindata#username'])){
            $user = new User();
            if($user->loadByUsername($_POST['cms-logindata#username']) == 0){
                if($user->checkPassword($_POST['cms-logindata#password'])){
                    $_SESSION['user'] = $user->getUserID();
                    header('Location: '.BACKENDURL.'index.php?page=home');
                    die();
                } else {
                    $login = FALSE;
                }
            } else {
                $login = FALSE;
            }
            if(!$login){
                $_SESSION['loginfailed'] = TRUE;
                header('Location: '.BACKENDURL.'index.php?page=login');
                die();
            }
        }
        if(isset($_SESSION['loginfailed'])){
            $this->view->setData(array('loginfailed' => True));
            unset($_SESSION['loginfailed']);
        }
        $this->view->out();
    }
    
}
?>
