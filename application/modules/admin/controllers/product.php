<?php

class Admin_Controllers_Product extends Libs_Controllers {

    public function __construct() {
        parent::__construct();
        if (!isset($_SESSION['user'])) {
            $this->redirect('login');
        }
        $this->logic = new Admin_Model_Product();
    }

    public function index() {
        $param = $this->getParams();
        $aryCondition = array(
            'order' => 'DESC',
            'conditionOrder' => 'pro_id',
            'where' => "status!='0'");
        if (isset($param['page'])) {
            $aryCondition['pageCurent'] = $param['page'];
            $aryData = $this->logic->getAllProduct($aryReturn, $aryCondition);
            $this->views->aryData = $aryData;
            $aryReturn['control'] = 'admin/product/index';
            $this->views->aryPage = $aryReturn;
            $aryClient['html'] = $this->views->renderToJson('product/index', 'admin');
            echo json_encode($aryClient);
        } else {
            if ($this->getParams('Xpage'))
                $aryCondition['pageCurent'] = $param['Xpage'];
            $aryData = $this->logic->getAllProduct($aryReturn, $aryCondition);
            $this->views->aryData = $aryData;
            $aryReturn['control'] = 'admin/product/index';
            $this->views->aryPage = $aryReturn;
            $this->views->setLayOut('admin', 'product/index');
        }
    }

    public function delProduct() {
        $id = $this->getParams('id');
        $page = $this->getParams('page');
        $aryCondition = array(
            'order' => 'DESC',
            'conditionOrder' => 'pro_id',
            'where' => "status!='0'");
        if ($page != '') {
            $aryCondition['pageCurent'] = $page;
        }
        $aryClient = array();
        if ($id != '') {
            $isOk = $this->logic->delProduct($id);
            if ($isOk > 0) {
                $aryData = $this->logic->getAllProduct($aryReturn,$aryCondition);
                $this->views->aryData = $aryData;
                $this->views->aryPage = $aryReturn;
                $aryClient['html'] = $this->views->renderToJson('product/index', 'admin');
            }
        }
        echo json_encode($aryClient);
    }

    public function updateProduct() {
        if (!isset($_SESSION['user']))
            $this->views->setLayOut('admin', 'login/index');
        else {
            $id = $this->getParams('id');
            if ($id != null) {
                $this->logic->set_id($id);
                $this->logic->getProductById($id, $aryData);
                $this->views->aryData = $aryData;
                $aryReturn['control'] = 'admin/product/index';
                $this->views->aryPage = $aryReturn;
                $this->views->screen = "edit";
                $cate = new Admin_Model_Category();
                $cate->getAllCateNoWhere($aryDataCate);
                $this->views->aryCate = $aryDataCate;
                $this->views->setLayOut('admin', 'product/update');
            }
        }
    }

    /*
     * @Author: Hoangdv
     * @Function save product to update
     * @Since:
     * 
     */

    public function saveProUpdate() {
        $err = array();
// get param
        $param = $this->getParams();
// validate form
        if (trim($param['pro_name']) == '') {
            $err['name'] = " Mời nhập tên";
        } else {
            $this->logic->set_Name($param['pro_name']);
        }
        if (trim($param['pro_price']) == '') {

            $err['pro_price'] = " Mời nhập giá";
        } else {
            $this->logic->set_price($param['pro_price']);
        }
        if (trim($param['id']) != '') {
            $this->logic->set_Id($param['id']);
        }
        if (trim($param['cate_id']) != '') {
            $this->logic->set_cate_id($param['cate_id']);
        }
        $checkNameExits = $this->logic->getNameExits($this->logic->get_Id());
        if ($checkNameExits != 0)
            $err['pro_name'] = "Tên đã tồn tại";
// neu pass val
        if ($err == null) {
            if (isset($_FILES['pro_img'])) {
                $file = $_FILES['pro_img'];
                $name = $file['name'];
                $temp = $file['tmp_name'];
                move_uploaded_file($temp, "upload/$name");
                $this->logic->set_img($name);
            }
            $isOk = $this->logic->updateToProduct();
            if ($isOk > 0) {
                $page = $this->getParams('page');
                if ($page == '')
                    $page = 0;
                header('location:' . PATH . '/admin/product/index?Xpage=' . $page);
            }
        } else {
            $this->views->screen = "edit";
            $this->views->err = $err;
            $cate = new Admin_Model_Category();
            $cate->getAllCateNoWhere($aryDataCate);
            $this->views->aryCate = $aryDataCate;
            $this->views->setLayOut('admin', 'product/index');
        }
    }

// them 
    public function addProduct() {
        if (!isset($_SESSION['user']))
            $this->views->setLayOut('login', 'login/index');
        else {
            $cate = new Admin_Model_Category();
            $cate->getAllCateNoPag($aryData);
            $this->views->aryCate = $aryData;
            $this->views->setLayOut('admin', 'product/insert');
        }
    }

// save pro 
// save update 
    public function SavePro() {
        if (!isset($_SESSION['user']))
            $this->views->setLayOut('admin', 'login/index');
        else {
            $err = array();
// get param
            $param = $this->getParams();
// validate form
            if (trim($param['pro_name']) == '') {
                $err['pro_name'] = " Mời nhập tên sp";
            } else {
                $this->logic->set_Name($param['pro_name']);
            }
/// short desc
            if (trim($param['pro_short_desc']) != '') {
                $this->logic->set_short_des($param['pro_short_desc']);
            }
//
            if (trim($param['pro_full_desc']) != '') {
                $this->logic->set_full_des($param['pro_full_desc']);
            }
//
            if (trim($param['pro_price']) == '') {

                $err['pro_price'] = " Mời nhập giá";
            } else {
                $this->logic->set_price($param['pro_price']);
            }
            if (trim($param['cate_id']) != '') {
                $this->logic->set_cate_id($param['cate_id']);
            }
            $checkNameExits = $this->logic->checkNameExits();

            if ($checkNameExits != 0)
                $err['pro_name'] = "Tên đã tồn tại";
// neu pass val

            if ($err == null) {
                if (isset($_FILES['pro_img'])) {
                    $file = $_FILES['pro_img'];
                    $name = $file['name'];
                    $temp = $file['tmp_name'];
                    move_uploaded_file($temp, "upload/$name");
                    $this->logic->set_img($name);
                }
                $isOk = $this->logic->addPro();

                if ($isOk > 0) {
                    $url = PATH . '/admin/product';
                    header('location:' . $url);
                }
            } else {
                $this->views->screen = "add";
                $this->views->err = $err;
                $this->views->setLayOut('admin', 'product/insert');
            }
        }
    }

    /*
     * @Author: Hoangdv
     * @Function : check name exits
     * 
     */

    public function checkName() {
        $name = $this->getParams('name');
        $this->logic->set_name($name);
        $checkNameExits = $this->logic->getNameExits($this->getParams('id'));
        if ($checkNameExits != 0)
            $err['html'] = "Tên đã tồn tại";
        else {
            $err['html'] = " Ok";
        }
        echo json_encode($err);
    }

}

?>
