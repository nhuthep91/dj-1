<?php

/*
 * @Author: HoangDV
 * @Class: Controller User
 * @Since:
 * @Param:
 */

class Admin_Controllers_User extends Libs_Controllers {

    public function __construct() {

        parent::__construct();
        if (!isset($_SESSION['user'])) {
            $this->redirect('login');
        }
        $this->logic = new Admin_Model_User();
    }

    /*
     * @Author: HoangDV
     * @Function: index action
     * @Since:
     * @Param:
     */

    public function index() {
        $param = $this->getParams();
        $aryCondition = array(
            'conditionOrder' => 'user_id',
            'order' => 'DESC',
            'where' => "status ='1'"
        );
        if (isset($param['page'])) {
            $aryCondition['pageCurent'] = $param['page'];
            $aryData = $this->logic->getAllUser($aryReturn, $aryCondition);
            $this->views->aryData = $aryData;
            $aryReturn['control'] = 'admin/user/index';
            $this->views->aryPage = $aryReturn;
            $aryClient['html'] = $this->views->renderToJson('user/index', 'admin');
            echo json_encode($aryClient);
        } else {
            if($this->getParams('Xpage'))
                $aryCondition['pageCurent'] = $param['Xpage'];
            $aryData = $this->logic->getAllUser($aryReturn, $aryCondition);
            $this->views->aryData = $aryData;
            $aryReturn['control'] = 'admin/user/index';
            $this->views->aryPage = $aryReturn;
            $this->views->setLayOut('admin', 'user/index');
        }
    }

    /*
     * @Author: HoangDV
     * @Function: add user action
     * @Since:
     * @Param:
     */

    public function addUser() {
        $this->views->screen = "add";
        $this->views->setLayOut('admin', 'user/insert');
    }

     /*
     * @Author: HoangDV
     * @Function: Check mail exits
     * @Since:
     * @Param:
     */

    public function checkMail() {
        $email = $this->getParams('email');
        $this->logic->setEmail($email);
        $checkMailExits = $this->logic->getMailExits();
        if ($checkMailExits != 0)
            $err['html'] = "Mail đã tồn tại";
        else {
            $err['html'] = "Co the su dung mail nay";
        }
        echo json_encode($err);
    }

    /*
     * @Author: HoangDV
     * @Function: Save user
     * @Since:
     * @Param:
     */
    public function saveUser() {
        $err = array();
        // get param
        $param = $this->getParams();
        // validate form
        if (trim($param['name']) == '') {
            $err['name'] = " Mời nhập ho tên";
        } else {
            $this->logic->setName($param['name']);
        }
        if (trim($param['email']) == '') {

            $err['email'] = " Mời nhập email";
        } else {
            $this->logic->setEmail($param['email']);
        }

        if (trim($param['password']) == '') {

            $err['password'] = " Mời nhập password";
        } else {
            $this->logic->setPassword(md5($param['password']));
        }
        if (trim($param['address']) == '') {
            $err['address'] = " Mời nhập address";
        } else {
            $this->logic->setAddress($param['address']);
        }
        if (trim($param['phone']) == '') {
            $err['phone'] = " Mời nhập phone";
        } else {
            $this->logic->setPhone($param['phone']);
        }
        $this->logic->setLevel($param['level']);

        $checkMailExits = $this->logic->getMailExits();
        if ($checkMailExits != 0)
            $err['email'] = "Mail đã tồn tại";
        // neu pass val
        if ($err == null) {
            if (isset($_FILES['avatar'])) {
                $file = $_FILES['avatar'];
                $name = $file['name'];
                $temp = $file['tmp_name'];
                move_uploaded_file($temp, "upload/$name");
                $this->logic->setAvatar($name);
            }

            $isOk = $this->logic->addUser();
            if ($isOk > 0) {
                $url = PATH . '/admin/user';
                header('location:' . $url);
            }
        } else {
            $this->views->screen = "add";
            $this->views->err = $err;
            $this->views->setLayOut('admin', 'user/insert');
        }
    }

    /*
     * Author: Hoangpv
     * Function : del user
     * Since: 25/03/2014
     * Modified: Hungpv
     * Date: 25/03/2014
     */

    public function delUser() {
        $id = $this->getParams('id');
        $page = $this->getParams('page');
        $this->logic->setId($id);
        $isOk = $this->logic->delUser($id);

        $aryCondition = array(
            'order' => 'DESC',
            'conditionOrder'=>'user_id',
            'where' => "`status` ='1'"
        );
        if ($page != 'undefined') {
            $aryCondition['pageCurent'] = $page;
        }
        if ($isOk) {
            $aryData = $this->logic->getAllUser($aryReturn, $aryCondition);
            $this->views->aryData = $aryData;
            $aryReturn['control'] = 'admin/user/index';
            $this->views->aryPage = $aryReturn;
            $aryClient['html'] = $this->views->renderToJson('user/index', 'admin');
            echo json_encode($aryClient);
        } else {
            echo "Error!";
        }
    }

    /*
     * Author: nhu thep
     * function update user
     */

    public function updateUser() {
        $id = $this->getParams('id');
        if ($id != null) {
            $this->logic->setId($id);
            $aryData = $this->logic->getUserById();
            $this->views->aryData = $aryData;
            $aryReturn['control'] = 'admin/user/index';
            $this->views->aryPage = $aryReturn;
            $this->views->screen = "edit";
            $this->views->setLayOut('admin', 'user/update');
        }
    }

    // Save user update
    // check validate form
    public function saveUserUpdate() {
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

            $err['email'] = "Email đã tồn tại !";
        } elseif (trim($param['email']) == '') {

            $err['email'] = " Mời nhập email !";
        } elseif ($this->logic->validateEmail($email)) {

            $err['email'] = "Invalid email format!";
        }  else {

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

            $err['confirmPass'] = "Xac nhan sai mat khau !";
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
            $status = 0;
            if (isset($_FILES['avata'])) {
                $status = 1;
                $file = $_FILES['avata'];
                $name = $file['name'];
                $temp = $file['tmp_name'];
                move_uploaded_file($temp, "upload/$name");
                $this->logic->setAvatar($name);
            }
            $isOk = $this->logic->updateUser($status);
            if ($isOk > 0) {
                $aryClient['thongbao'] = " Update mới thành công";
                $objU = new Admin_Model_User();
                $aryData = $objU->getAllUser($aryReturn);
                $this->views->aryData = $aryData;
                $aryReturn['control'] = 'admin/user/index';
                $this->views->aryPage = $aryReturn;
                $param = $this->getParams();
                header('location:' . PATH . '/admin/user/index?Xpage='.$param['page']); 
            } else {
                echo "Update Fail !"; // check sql update 
            }
        } else {

            $this->views->err = $err;
            $this->logic->setId($id);
            $aryData = $this->logic->getUserById();
            $this->views->aryData = $aryData;
            $aryReturn['control'] = 'admin/user/index';
            $this->views->aryPage = $aryReturn;
            $this->views->screen = "edit";
            $this->views->setLayOut('admin', 'user/update');
        }
    }

    public function showUser() {
        $this->views->setLayOut('admin', 'user/index');
        $param = $this->getParams();
        if (isset($param['page'])) {
            $aryCondition = array(
                'order' => 'DESC',
                'conditionOrder',
                'pageCurent' => $param['page'],
            );
            $aryData = $this->logic->getAllUser($aryReturn, $aryCondition);
            $this->views->aryData = $aryData;
            $aryReturn['control'] = 'index/user/index';
            $this->views->aryPage = $aryReturn;
            $aryClient['html'] = $this->views->renderToJson('user/index');
            echo json_encode($aryClient);
        } else {
            $aryData = $this->logic->getAllUser($aryReturn);
            $this->views->aryData = $aryData;
            $aryReturn['control'] = 'index/user/index';
            $this->views->aryPage = $aryReturn;
            $this->views->setLayOut('index', 'user/index');
        }
    }

}
