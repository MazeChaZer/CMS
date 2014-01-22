<?php

namespace ITC\CMS;

require_once 'core/mvc/model/entities/Data.php';

class c_filemanager extends Controller {

    public function __construct() {
        parent::__construct("filemanager");
        $this->setIsPublic(FALSE);
    }

    public function start() {
        if (isset($_POST["cmsfilesdata"])) {
           foreach($_POST["cmsfilesdata"] as $id => $key)
           {
               $file = new Data();
               $file->load($id);
               $file->delete();
           }
        }

        if (isset($_POST["renameid"])) {
            $fileid = $_POST["renameid"];
            $newName = $_POST["cmsdata#file"];
            
            $file = new Data();
            $file->load($fileid);
            $file->setName($newName);
            $file->save();
            
            header('Location: '.BACKENDURL.'index.php?page=filemanager');
            die();
        }

        if (isset($_FILES["cmsdata#file"])) {
            $filename = $_FILES["cmsdata#file"]["name"];
            $data = new Data();
            $data->setName($filename);
            $data->setUploaderID($_SESSION['user']);
            $data->setSize($_FILES["cmsdata#file"]["size"]);
            $data->setType($_FILES["cmsdata#file"]["type"]);
            $data->save();
            move_uploaded_file($_FILES["cmsdata#file"]["tmp_name"], "files/" . $data->getHash());
            
            header('Location: '.BACKENDURL.'index.php?page=filemanager');
            die();
        }
        
        $allData = new Data();
        $allData = $allData->getData();
        $this->view->setData($allData);
        $this->view->out();
    }

}
