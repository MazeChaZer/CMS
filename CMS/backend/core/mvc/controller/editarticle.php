<?php

namespace ITC\CMS;

require_once('core/mvc/model/entities/Entry.php');
require_once('core/mvc/model/entities/User.php');
require_once('core/mvc/model/entities/Data.php');

class c_editarticle extends controller {

    public function __construct(){
        parent::__construct("editarticle");
    }
    
    public function start(){
        if(isset($_POST['titel'])){
//             print_r($_POST);
            $entry = new Entry();
            if(isset($_GET['id'])){
                $entry->load($_GET['id']);
                $entry->setLocked(NULL);
                $entry->setLockedBy(NULL);
            } else {
                $entry->setAuthorID($_SESSION['user']);
            }
            $entry->setTitel($_POST['titel']);
            $entry->setInhalt($_POST['artikel']);
            @$entry->setAnhangID($_POST['anhang']);
            $entry->save();
            header('Location: '.BACKENDURL.'index.php?page=articlemanager');
            die();
        }
        if(!isset($_GET['id'])){
            $this->view->setData(array("new" => TRUE, "articledata" => array("inhalt" => "", "titel" => "")));
            echo "Neuer Artikel";
        } else {
            $entry = new Entry();
            if($entry->load($_GET['id']) == 1){
                die("Eintrag existiert nicht.");
            }
            
            if($entry->getLocked() == NULL || $_SESSION['user'] == $entry->getLockedBy() || (strtotime($entry->getLocked()) + EDITLOCKDURATION) < time()){
            
                $entry->setLocked(date("Y-m-d H:i:s",time()));
                $entry->setLockedBy($_SESSION['user']);
                $entry->save();
                
                $author = new User();
                $author->load($entry->getAuthorID());
                
                $editor = new User();
                if($editor->load($entry->getEditorID()) == 0){
                    $editorArray = array(   "username" => $editor->getUsername(),
                                            "email" => $editor->getEmail()
                                        );
                } else {
                    $editorArray = array();
                }
                
                $articledata = array(   "entryID" => $entry->getEntryID(),
                                        "author" => array(  "username" => $author->getUsername(),
                                                            "email" => $author->getEmail()
                                                        ),
                                        "url" => $entry->getURL(),
                                        "dateCreated" => $entry->getDateCreated(),
                                        "titel" => $entry->getTitel(),
                                        "inhalt" => $entry->getInhalt(),
                                        "dateEdited" => $entry->getDateEdited(),
                                        "editor" => $editorArray,
                                        "attachment" => $entry->getAnhangID(),
                                        "category" => "<Entity fehlt noch>");
                $this->view->setData(array( "articledata" => $articledata,
                                            "uploads" => Model::getData()));
            } else {
                $this->view->setData(array("locked" => TRUE));
            }
        }
        $this->view->out();
    }
}


?>