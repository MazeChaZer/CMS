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

        $allArticles = new Entry();
        //getArticles
        $this->view->setData($allArticles);
        $this->view->out();
    }

}
