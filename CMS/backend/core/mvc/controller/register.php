<?php

namespace ITC\CMS;

require_once('core/mvc/model/entities/User.php');

class c_register extends controller {

    public function __construct(){
        parent::__construct("register");
        $this->setIsPublic(TRUE);
    }

    public function start(){
        if(isset($_POST['cms-registerdata#username'])){
            $user = new User();
            if($user->loadByUsername($_POST['cms-registerdata#username']) == 0){
                $_SESSION['usernamealreadyexists'] = TRUE;
                header('Location: '.BACKENDURL.'index.php?page=register');
                die();
            } else {
                $user->setUsername($_POST['cms-registerdata#username']);
                $user->setPassword($_POST['cms-registerdata#password'], false);
                $user->setEmail($_POST['cms-registerdata#email']);
                $user->save();
                header('Location: '.BACKENDURL.'index.php?page=login');
                die();
            }
        }
        if(isset($_SESSION['usernamealreadyexists'])){
            $this->view->setData(array('usernamealreadyexists' => True));
            unset($_SESSION['usernamealreadyexists']);
            echo 'usernamealreadyexists'; //#DEBUG
        }
        $this->view->out();
    }

}
?>