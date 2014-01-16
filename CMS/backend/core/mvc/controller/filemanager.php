<?php

namespace ITC\CMS;

require_once 'core/mvc/model/entities/Data.php';

class c_filemanager extends Controller {

    public function construct() {
        parent::__construct("filemanager");
        $this->setIsPublic(FALSE);
    }

    public function start() {

        if (isset($_POST("deletefileids"))) {
            $deletefileid = $_POST("deletefileids");

            for ($i = 0; $i < count($deletefileid); $i++) {
                $file = new Data();
                $file->load($deletefileid[$i]);
                $file->delete();
            }
        }

        if (isset($_POST("renamefiles"))) {
            $renamefiles = $_POST("renamefiles");
            foreach ($renamefiles as $fileid => $newName) {
                $file = new Data();
                $file->load($fileid);
                $file->setName($newName);
            }
        }

        if (isset($_FILES("filename"))) {
            $filename = $_FILES("filename");
            $data = new Data();
            $data->setName($filename);
            $data->setUploaderID($_SESSION['user']);
            $data->save();
            move_uploaded_file($_FILES["tmp_name"], "files/" . $data->getHash());
        }

        $allData = Data::getData();
        $this->view->setData($allData);
        $this->view->out();
    }

}
