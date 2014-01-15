<?php

namespace ITC\CMS;

require_once 'core/mvc/model/entities/Data.php';

class c_filemanager {

    public function construct() {
        parent::__construct("filemanager");
        $this->setIsPublic(FALSE);
    }

    public function start() {
        
        if (isset($_POST("deletefileids"))) {
            $deletefileid = $_POST("deletefilenames");

            for ($i = 0; $i < count($deletefileid); $i++) {
                $file = new Data();
                $file->load($deletefileid[$i]);
                $file->delete();
            }
        }
        
        if(isset($_POST("renamefiles")))
        {
            $renamefiles =$_POST("renamefiles");
            foreach ($renamefiles as $fileid=> $newName) {
                $file =new Data();
                $file->load($fileid);
                $file->setName($newName);
            }
        }

        return Data::getData();
    }

}
