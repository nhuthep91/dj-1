<?php

/*
 * @Author: HoangDV
 * @Class: Controller index
 * @Since:
 * @Param:
 */

class Admin_Controllers_Index extends Libs_Controllers {

    public function __construct() {

        parent::__construct();
        $this->logic = new Admin_Model_Product();
    }

    /*
     * @Author: HoangDV
     * @Function:index action
     * @Since:
     * @Param:
     */

    public function index() {
        if (isset($_SESSION['user'])) {
            $pro = new Admin_Controllers_Product();
            $pro->index();
        } else {
            $this->views->setLayOut('login', 'login/index');
        }
    }

}
