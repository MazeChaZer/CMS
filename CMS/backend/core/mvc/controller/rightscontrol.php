<?php

namespace ITC\CMS;

require_once('core/mvc/model/entities/User.php');

class c_rightsControl extends Controller {

    public function construct() {
        parent::__construct("rightscontrol");
        $this->setIsPublic(FALSE);
    }

    public function start() {
        $isUsernameSet = isset($_POST["username"]);
        $isEmailSet = isset($_POST["email"]);
        $isApplyRightIDSet = isset($_POST["rightID"]);
        $isRightValueSet = isset($_POST["rightValue"]);

        if ($isUsernameSet || $isEmailSet) {
            $user = new User();

            if ($isUsernameSet) {
                if ($user->loadByUsername($_POST["username"]) != 0) {
                    return;
                }
            } else {
                if ($user->loadByEmail($_POST["email"]) != 0) {
                    return;
                }
            }

            if ($isRightValueSet && $isApplyRightIDSet) {
                $user->setRight($_POST["rightId"], $_POST["rightValue"]);
            }

            $allRights = $user->getRights();

            for ($i = 1; $i <= count($allRights); $i++) {
                $rights[$user->getRightName($i)] = $user->checkRight($i);
            }
            $this->view->setData($allRights);
            $this->view->out();
        }
    }

}
