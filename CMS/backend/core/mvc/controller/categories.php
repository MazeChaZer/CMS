<?php

namespace ITC\CMS;

require_once 'core/mvc/model/entities/Category.php';

class c_categories extends Controller {

    public function __construct() {
        parent::__construct("categories");
        $this->setIsPublic(FALSE);
    }

    public function start() {
        if (isset($_POST["cmsfilesdata"])) {
            foreach($_POST["cmsfilesdata"] as $id => $key)
            {
                $category = new Category();
                $category->load($id);
                $category->delete();
            }

            header('Location: '.BACKENDURL.'index.php?page=categories');
            die();
        }

        if (isset($_POST["renameid"])) {
            $categoryid = $_POST["renameid"];
            $newName = $_POST["cmsdata#file"];

            $category = new Category();
            $category->load($categoryid);
            $category->setBezeichnung($newName);
            $category->save();

            header('Location: '.BACKENDURL.'index.php?page=categories');
            die();
        }

        if (isset($_POST["cmsdata#file"])) {
            $categoryname = $_POST["cmsdata#file"];
            $category = new Category();
            $category->setBezeichnung($categoryname);
            $category->setCreatorID($_SESSION['user']);
            $category->save();

            header('Location: '.BACKENDURL.'index.php?page=categories');
            die();
        }

        new Model(); //q+d
        $this->view->setData(array("categories" => Model::getCategories()));
        $this->view->out();
    }

}
