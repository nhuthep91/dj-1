<?php

class Admin_Controllers_News extends Libs_Controllers {

    public function __construct() {

        parent::__construct();
        $this->logic = new Admin_Model_News();
        if (!isset($_SESSION['user'])) {
            $this->views->setLayOut('login', 'login/index');
        }
    }

    public function index() {

        $param = $this->getParams();
        $aryCondition = array(
            'conditionOrder' => 'order_display',
            'order' => 'ASC',
            'where' => "status ='1'"
        );
        if (isset($param['page'])) {
            $aryCondition['pageCurent'] = $param['page'];
            $aryData = $this->logic->getAllNews($aryReturn, $aryCondition);
            $this->views->aryData = $aryData;
            $aryReturn['control'] = 'admin/news/index';
            $this->views->aryPage = $aryReturn;
            $aryClient['html'] = $this->views->renderToJson('news/index', 'admin');
            echo json_encode($aryClient);
        } else {
            if ($this->getParams('Xpage'))
                $aryCondition['pageCurent'] = $param['Xpage'];
            $aryData = $this->logic->getAllNews($aryReturn, $aryCondition);
            $this->views->aryData = $aryData;
            $aryReturn['control'] = 'admin/news/index';
            $this->views->aryPage = $aryReturn;
            $this->views->setLayOut('admin', 'news/index');
        }
    }

    /*
     * Author: Hoangdv
     * Since :
     * 
     * 
     */

    public function addNews() {
        $this->views->screen = "add";
        $this->views->setLayOut('admin', 'news/insert');
    }

    /*
     * Author: Hoangdv
     * Since :
     * 
     * 
     */

    public function checkTitle() {
        $title = $this->getParams('title');
        $id = '';
        $id = $this->getParams('id');
        $this->logic->setTitle($title);
        $checkTitleExits = $this->logic->getTitleExits($id);
        if ($checkTitleExits > 0)
            $err['html'] = "Tiêu đề đã tồn tại";
        else {
            $err['html'] = "OK";
        }
        echo json_encode($err);
    }

    /*
     * Author: Hoangdv
     * Since :
     * 
     * 
     */

    public function saveNews() {
        $err = array();
// get param
        $param = $this->getParams();
// validate form
        if (trim($param['title']) == '') {
            $err['title'] = " Mời nhập tiêu đề";
        } else {
            $this->logic->setTitle(trim($param['title']));
        }
        if (trim($param['content']) == '') {
            $err['content'] = " Mời nhập nội dung";
        } else {
            $con = trim($param['content']);
            $this->logic->setContent($con);
            $des = substr($con, 0, 150);
            $this->logic->setDes($des);
        }
        $this->logic->setOrder_display($this->getParams('order_display'));
        $checkTitleExits = $this->logic->getTitleExits();
        if ($checkTitleExits != 0)
            $err['title'] = "Tiêu đề đã tồn tại";
// neu pass val
        if ($err == null) {
            if (isset($_FILES['img'])) {
                $file = $_FILES['img'];
                $name = $file['name'];
                $temp = $file['tmp_name'];
                move_uploaded_file($temp, "upload/$name");
                $this->logic->setImage_url($name);
            } else {
                $this->logic->setImage_url('default.jpg');
            }

            $isOk = $this->logic->addNews();
            if ($isOk > 0) {
                $url = PATH . '/admin/news';
                header('location:' . $url);
            }
        } else {
            $this->views->screen = "add";
            $this->views->err = $err;
            $this->views->setLayOut('admin', 'news/insert');
        }
    }

    /*
     * Author: Hoangpv
     * Function : del news
     * Since: 25/03/2014
     * Modified: Hungpv
     * Date: 25/03/2014
     */

    public function delNews() {
        $id = $this->getParams('id');
        $this->logic->setId($id);
        $isOk = $this->logic->delNews($id);
        $aryCondition = array(
            'order' => 'DESC',
            'conditionOrder',
            'where' => "status ='1'"
        );
        if ($isOk) {
            $aryData = $this->logic->getAllNews($aryReturn, $aryCondition);
            $this->views->aryData = $aryData;
            $aryReturn['control'] = 'admin/news/index';
            $this->views->aryPage = $aryReturn;
            $aryClient['html'] = $this->views->renderToJson('news/index', 'admin');
            echo json_encode($aryClient);
        } else {
            echo "Error!";
        }
    }

    /*
     * Author: nhu thep
     * function update news
     */

    public function updateNews() {

        $id = $this->getParams('id');
        if ($id != null) {
            $this->logic->setNews_id($id);
            $aryData = $this->logic->getNewsById();
            $this->views->aryData = $aryData;
            $aryReturn['control'] = 'admin/news/index';
            $this->views->aryPage = $aryReturn;
            $this->views->screen = "edit";
            $this->views->setLayOut('admin', 'news/insert');
        }
    }

// Save news update
// check validate form
    public function saveNewsUpdate() {
        $err = array();
// get param
        $param = $this->getParams();
// validate form
        if (trim($param['title']) == '') {
            $err['title'] = " Mời nhập tiêu đề";
        } else {
            $this->logic->setTitle(trim($param['title']));
        }
        if (trim($param['content']) == '') {
            $err['content'] = " Mời nhập nội dung";
        } else {
            $con = trim($param['content']);
            $this->logic->setContent($con);
            $des = substr($con, 0, 150);
            $this->logic->setDes($des);
        }
        if ($param['id'] != '') {
            $this->logic->setNews_id($param['id']);
        }
        $checkTitleExits = $this->logic->getTitleExits($param['id']);
        if ($checkTitleExits != 0)
            $err['title'] = "Tiêu đề đã tồn tại";
        $this->logic->setOrder_display($this->getParams('order_display'));
// neu pass val
        if ($err == null) {
            $check = 0;
            if (isset($_FILES['img'])) {
                $file = $_FILES['img'];
                $name = $file['name'];
                $temp = $file['tmp_name'];
                move_uploaded_file($temp, "upload/$name");
                $this->logic->setImage_url($name);
                $check = 1;
            }
            $isOk = $this->logic->updateNews($check);
            if ($isOk > 0) {
                $param = $this->getParams();
                header('location:' . PATH . '/admin/news/index?Xpage=' . $param['page']);
            }
        } else {
            $this->views->screen = "edit";
            $this->views->err = $err;
            $this->views->setLayOut('admin', 'news/insert');
        }
    }

    public function showNews() {
        $this->views->setLayOut('admin', 'news/index');
        $param = $this->getParams();
        if (isset($param['page'])) {
            $aryCondition = array(
                'order' => 'DESC',
                'conditionOrder',
                'pageCurent' => $param['page'],
            );
            $aryData = $this->logic->getAllNews($aryReturn, $aryCondition);
            $this->views->aryData = $aryData;
            $aryReturn['control'] = 'index/news/index';
            $this->views->aryPage = $aryReturn;
            $aryClient['html'] = $this->views->renderToJson('news/index');
            echo json_encode($aryClient);
        } else {
            $aryData = $this->logic->getAllNews($aryReturn);
            $this->views->aryData = $aryData;
            $aryReturn['control'] = 'index/news/index';
            $this->views->aryPage = $aryReturn;
            $this->views->setLayOut('index', 'news/index');
        }
    }

}
