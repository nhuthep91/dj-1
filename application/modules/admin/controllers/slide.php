<?php

class Admin_Controllers_Slide extends Libs_Controllers {

    public function __construct() {

        parent::__construct();
        $this->logic = new Admin_Model_Slide();
        if (!isset($_SESSION['user'])) {
            $this->views->setLayOut('login', 'login/index');
        }
    }

    public function index() {

        $param = $this->getParams();
        $aryCondition = array(
            'conditionOrder' => 'slide_id',
            'order' => 'DESC',
            'where' => "status ='1'"
        );
        if (isset($param['page'])) {
            $aryCondition['pageCurent'] = $param['page'];
            $aryData = $this->logic->getAllSlide($aryReturn, $aryCondition);
            $this->views->aryData = $aryData;
            $aryReturn['control'] = 'admin/slide/index';
            $this->views->aryPage = $aryReturn;
            $aryClient['html'] = $this->views->renderToJson('slide/index', 'admin');
            echo json_encode($aryClient);
        } else {
            $aryData = $this->logic->getAllSlide($aryReturn, $aryCondition);
            $this->views->aryData = $aryData;
            $aryReturn['control'] = 'admin/slide/index';
            $this->views->aryPage = $aryReturn;
            $this->views->setLayOut('admin', 'slide/index');
        }
    }

    /*
     * Author: nhu thep
     * add slide function
     */

    public function addSlide() {
        if (!isset($_SESSION['user']))
            $this->views->setLayOut('login', 'login/index');
        else {
            $this->views->setLayOut('admin', 'slide/insert');
        }
    }
    //save slide 
    public function saveSlide() {
        $err = array();
// get param
        $param = $this->getParams(); 
        $this->logic->setTitle($param['title']);
        $checkTitleExits = $this->logic->getTitleExits();
        
        if (trim($param['title']) == '') {
            $err['title'] = "Please fill title!";
        } elseif ($checkTitleExits != 0) {
             $err['title'] = "Title exist!";
        } else {
            $this->logic->setTitle($param['title']);
        }
      
        if (trim($param['des']) == '') {
            $err['des'] = " Please fill content!";
        }else {
            $this->logic->setDes($param['des']);
        }

        if (trim($param['target_url']) == '') {
            $err['target_url'] = "Please fill target url!";
        }
        else {
            $this->logic->setTargetUrl($param['target_url']);
        }

         if (trim($param['order_display']) == '') {
            $err['order_display'] = " Please choose order display!";
        } else {
            $this->logic->setOrder_display($param['order_display']);
        }
        
        $this->logic->setStatus($param['status']);

// neu pass val
        if ($err == null) {
            if (isset($_FILES['slide_img'])) {
                $file = $_FILES['slide_img'];
                $name = $file['name'];
                $temp = $file['tmp_name'];
                move_uploaded_file($temp, "upload/$name");
                if($name!="")
                    $this->logic->setImage_url($name);
                else 
                     $this->logic->setImage_url('slide_default.jpg');
            }
            
            $isOk = $this->logic->saveNewSlide();
            if ($isOk > 0) {
                header('location:' . PATH . '/admin/slide');
            }
        }  else {
                $this->views->title = $param['title'];
                $this->views->descipt = $param['des']; 
                $this->views->target = $param['target_url'];
                $this->views->order_display = $param['order_display'];
                $this->views->err = $err;
                $this->views->setLayOut('admin', 'slide/insert');
            }
        
    }
    /*
     * Author: Hoangdv
     * Since :
     * 
     * 
     */

    public function checkTitle() {
        $title = $this->getParams('title');
        $this->logic->setTitle($title);
        $checkTitleExits = $this->logic->getTitleExits();
        if ($checkTitleExits != 0)
            $err['html'] = "Tiêu đề đã tồn tại";
        else {
            $err['html'] = "OK";
        }
        echo json_encode($err);
    }

    /*
     * Author: Hoangpv
     * Function : del slide
     * Since: 25/03/2014
     * Modified: Hungpv
     * Date: 25/03/2014
     */

    public function delSlide() {
        $id = $this->getParams('id');
        $this->logic->setId($id);
        $isOk = $this->logic->delSlide($id);
        $aryCondition = array(
            'order' => 'DESC',
            'conditionOrder',
            'where' => "status ='1'"
        );
        if ($isOk) {
            $aryData = $this->logic->getAllSlide($aryReturn, $aryCondition);
            $this->views->aryData = $aryData;
            $aryReturn['control'] = 'admin/slide/index';
            $this->views->aryPage = $aryReturn;
            $aryClient['html'] = $this->views->renderToJson('slide/index', 'admin');
            echo json_encode($aryClient);
        } else {
            echo "Error!";
        }
    }

    /*
     * Author: nhu thep
     * function update slide
     */

    public function updateSlide() {

        $id = $this->getParams('id');
        if ($id != null) {
            $this->logic->setId($id);
            $aryData = $this->logic->getSlideById();
            $this->views->aryData = $aryData;
            $aryReturn['control'] = 'admin/slide/index';
            $this->views->aryPage = $aryReturn;
            $this->views->screen = "edit";
            $this->views->setLayOut('admin', 'slide/update');
        }
    }

// Save slide update
// check validate form
    public function saveSlideUpdate() {
        $err = array();
// get param
        $param = $this->getParams();
        $id = $param['id'];
        $email = $param['email'];
        $phone = $param['phone'];
        $this->logic->setEmail($email);
// validate form
        if (trim($param['name']) == '') {
            $err['name'] = " Mời nhập tên !";
        } else {
            $this->logic->setName($param['name']);
        }

//check email    
        $checkMailExits = $this->logic->getMailExits($id);
        if ($checkMailExits != 0) {

            $err['email'] = "Mail đã tồn tại !";
        } elseif ($this->logic->validateEmail($email)) {

            $err['email'] = "Invalid email format! Example abc@abc.com";
        } elseif (trim($param['email']) == '') {

            $err['email'] = " Mời nhập email !";
        } else {

            $this->logic->setEmail($param['email']);
        }
//check password
        if (trim($param['password']) == '' && trim($param['confirmPass']) == '') {

            $this->logic->setPassword(trim($param['passwordCurent']));
        } elseif (trim($param['password']) == '' && trim($param['confirmPass']) != '') {

            $err['pass'] = "Nhap mat khau !";
        } elseif (trim($param['password']) != '' && trim($param['confirmPass']) == '') {

            $err['confirmPass'] = "Vui long xac nhan mat khau !";
        } elseif (trim($param['password']) != trim($param['confirmPass'])) {

            $err['confirmPass'] = "Xac nhan mat khau khong chinh xac !";
        } else {

            $this->logic->setPassword(md5($param['password']));
        }

        if (trim($param['address']) == '') {
            $err['address'] = " Mời nhập address !";
        } else {
            $this->logic->setAddress($param['address']);
        }
        if (trim($param['phone']) == '') {

            $err['phone'] = " Mời nhập phone number !";
        } else {
            $this->logic->setPhone($param['phone']);
        }
        $this->logic->setLevel($param['level']);
        if (trim($param['id']) != '') {
            $this->logic->setId($param['id']);
        }

// neu pass val
        if ($err == null) {
            if (isset($_FILES['avata'])) {
                $file = $_FILES['avata'];
                $name = $file['name'];
                $temp = $file['tmp_name'];
                move_uploaded_file($temp, "upload/$name");
                $this->logic->setAvatar($name);
            }
            $isOk = $this->logic->updateSlide();
            if ($isOk > 0) {
                $aryClient['thongbao'] = " Update mới thành công";
                $objU = new Admin_Model_Slide();
                $aryData = $objU->getAllSlide($aryReturn);
                $this->views->aryData = $aryData;
                $aryReturn['control'] = 'admin/slide/index';
                $this->views->aryPage = $aryReturn;
                header('location:' . PATH . '/admin/slide');
            } else {
                echo "Update Fail !"; // check sql update 
            }
        } else {

            $this->views->err = $err;
            $this->logic->setId($id);
            $aryData = $this->logic->getSlideById();
            $this->views->aryData = $aryData;
            $aryReturn['control'] = 'admin/slide/index';
            $this->views->aryPage = $aryReturn;
            $this->views->screen = "edit";
            $this->views->setLayOut('admin', 'slide/update');
        }
    }

    public function showSlide() {
        $this->views->setLayOut('admin', 'slide/index');
        $param = $this->getParams();
        if (isset($param['page'])) {
            $aryCondition = array(
                'order' => 'DESC',
                'conditionOrder',
                'pageCurent' => $param['page'],
            );
            $aryData = $this->logic->getAllSlide($aryReturn, $aryCondition);
            $this->views->aryData = $aryData;
            $aryReturn['control'] = 'index/slide/index';
            $this->views->aryPage = $aryReturn;
            $aryClient['html'] = $this->views->renderToJson('slide/index');
            echo json_encode($aryClient);
        } else {
            $aryData = $this->logic->getAllSlide($aryReturn);
            $this->views->aryData = $aryData;
            $aryReturn['control'] = 'index/slide/index';
            $this->views->aryPage = $aryReturn;
            $this->views->setLayOut('index', 'slide/index');
        }
    }

}
