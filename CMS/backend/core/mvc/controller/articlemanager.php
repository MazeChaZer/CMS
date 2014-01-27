<?php

namespace ITC\CMS;

require_once 'core/mvc/model/entities/Entry.php';

class c_articlemanager extends Controller {

    public function __construct() {
        parent::__construct("articlemanager");
        $this->setIsPublic(FALSE);
    }

    public function start() {

        if (isset($_GET["renameid"])) {
            $removeEntry = new Entry();
            $removeEntry->load($_GET["deleteID"]);
            $removeEntry->setTitel($_GET["newName"]);
            $removeEntry->save();

            header('Location: ' . BACKENDURL . 'index.php?page=articlemanager');
            die();
        }

        if (isset($_GET["deleteID"])) {
            $removeEntry = new Entry();
            $removeEntry->load($_GET["deleteID"]);
            $removeEntry->delete();

            header('Location: ' . BACKENDURL . 'index.php?page=articlemanager');
            die();
        }
        new Model(); //q+d
        $articles = Model::getEntries();
        foreach($articles as $article){
			if(isset($article['locked']) && strtotime($article['locked']) + EDITLOCKDURATION < time()){
				$entry = new Entry();
				$entry->load($article['entryID']);
				$entry->setLocked(NULL);
				$entry->setLockedBy(NULL);
				$entry->save();
			}
        }
        $this->view->setData(array("articles" => Model::getEntries()));
        $this->view->out();
    }

}
