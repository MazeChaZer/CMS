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
        if(empty($_GET['id'])){
            die("Eintrag existiert nicht.");
        }
        $entry = new Entry();
        if($entry->load($_GET['id']) == 1){
            die("Eintrag existiert nicht.");
        }
        
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
        
        $attachment = new Data();
        if($attachment->load($entry->getAnhangID()) == 0){
            $uploader = new User();
            $uploader->load($attachment->getUploaderID());
                                    
            $attachmentArray = array(   "dataID" => $attachment->getDataID(),
                                        "name" => $attachment->getName(),
                                        "uploader" => array("username" => $uploader->getUsername(),
                                                            "email" => $uploader->getEmail()
                                                           )
                                    );
        } else {
            $attachmentArray = array();
        }
        
        
        $articledata = array(   "entryId" => $entry->getEntryID(),
                                "author" => array(  "username" => $author->getUsername(),
                                                    "email" => $author->getEmail()
                                                 ),
                                "url" => $entry->getURL(),
                                "dateCreated" => $entry->getDateCreated(),
                                "titel" => $entry->getTitel(),
                                "inhalt" => $entry->getInhalt(),
                                "dateEdited" => $entry->getDateEdited(),
                                "editor" => $editorArray,
                                "attachment" => $attachmentArray,
                                "category" => "<Entity fehlt noch>");
        $this->view->setData(array("articledata" => $articledata));
        $this->view->out();
    }
}


?>