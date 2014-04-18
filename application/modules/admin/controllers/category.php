<?php

/*
 * @Author: HoangDV
 * @Class: Controller category
 * @Since:
 * @Param:
 */

class Admin_Controllers_Category extends Libs_Controllers {

    public function __construct() {
        parent::__construct();
        if (!isset($_SESSION['user'])) {
            $this->redirect('login');
        }
        $this->logic = new Admin_Model_Category();
    }

    /*
     * @Author: HoangDV
     * @Function:index
     * @Since:
     * @Param:
     */

    public function index() {
        $param = $this->getParams();
        $aryCondition = array(
             'conditionOrder' => 'order_dislay',
            'order' => 'ASC',
        );
        if (isset($param['page'])) {
            $aryCondition['pageCurent'] =$param['page'];
            $aryData = $this->logic->getAllCate($aryReturn, $aryCondition);
            $this->views->aryData = $aryData;
            $aryReturn['control'] = 'admin/category/index';
            $this->views->aryPage = $aryReturn;
            $aryClient['html'] = $this->views->renderToJson('category/index', 'admin');
            echo json_encode($aryClient);
        } else {
            if ($this->getParams('Xpage'))
                $aryCondition['pageCurent'] = $param['Xpage'];
            $aryData = $this->logic->getAllCate($aryReturn, $aryCondition);
            $this->views->aryData = $aryData;
            $aryReturn['control'] = 'admin/category/index';
            $this->views->aryPage = $aryReturn;
            $this->views->setLayOut('admin', 'category/index');
        }
    }

    /*
     * Author: Hoangdv
     * Function Show sub cate
     * 
     */

    public function showSubCate() {
        $param = $this->getParams();
        if (isset($param['cate_id'])) {
            $this->logic->setParent_id($param['cate_id']);
            $this->logic->getAllSubCate($aryReturn);
            $this->views->aryData = $aryReturn;
            $aryClient['html'] = $this->views->renderToJson('category/view_category', 'admin');
            $aryClient['cate_id'] = $param['cate_id'];
            echo json_encode($aryClient);
        }
    }

    /*
     * author: nhu thep
     * function update category
     */

    public function updateCategory() {
        $cate_id = $this->getParams('cate_id');
        if ($cate_id != null) {
            $this->logic->setCate_id($cate_id);
            $aryData = $this->logic->getCateById();
            $this->views->aryData = $aryData;
            $aryCateId = $this->logic->getAllCateId(); //get cate except this cate id and this child
            $aryChidCate = $this->logic->getChildCate();
            $myAry = array();
            foreach ($aryChidCate as $key => $value) {
                $myAry[] = $value->cate_id;
            }
            $aryCateId = $this->logic->getAllCateId($myAry); //get cate except this cate id and this child

            $this->views->aryCateId = $aryCateId;
            $this->views->screen = "edit";
            $this->views->setLayOut('admin', 'category/update_category');
            // }
        }
    }

    /*
     * author: nhu thep
     * function save category update
     */

    public function saveCategoryUpdate() {
        $err = array();
        // get param
        $param = $this->getParams();
        $cate_id = $param['cate_id'];
        $title = $param['title'];
        $des = $param['des'];
        $order_dislay = $param['order_dislay'];
        $this->logic->setCate_id($cate_id);
        $this->logic->setParent_id($param['parent_id']);
        $this->logic->setStatus($param['status']);

        if (trim($title) == '') {
            $err['title'] = "Moi nhap title category !";
        } else {
            $this->logic->setTitle($title);
        }

        if (trim($des) == '') {
            $err['des'] = "Moi nhap description !";
        } else {
            $this->logic->setDes($des);
        }

        if (trim($order_dislay) == '') {
            $err['order_dislay'] = "Moi nhap Order Display !";
        } else {
            $this->logic->setOrder_display($order_dislay);
        }

        //if have no err
        if ($err == null) {
            $isOk = $this->logic->updateCate();
            if ($isOk > 0) {
                $param = $this->getParams();
                header('location:' . PATH . '/admin/category/index?Xpage=' . $param['page']);
            }
        } else {
            $this->views->err = $err;
            $this->logic->setCate_id($cate_id);
            $aryData = $this->logic->getCateById();
            $this->views->aryData = $aryData;
            $aryReturn['control'] = 'admin/category/index';
            $this->views->aryPage = $aryReturn;
            $this->views->screen = "edit";
            $this->views->setLayOut('admin', 'category/update_category');
        }
    }

    /*
     * author: Hungpv
     * Function add Category
     */

    public function addCategory($data = array()) {
        $condition = array(
            'where' => 'parent_id = 0 and `status` = 1'
        );
        if ($data != null) {
            $this->views->data = $data;
        }
        $listCate = $this->logic->getAllCate($page, $condition);
        $this->views->listCate = $listCate;
        $this->views->setLayOut('admin', 'category/insert');
    }

    /*
     * author: Hungpv
     * Function add Category
     */

    public function saveCategory() {
        $flag = true;
        $params = $this->getParams(); //Get list params
        $err = array(); // Create error array
        //Form validate
        if (trim($params['title']) != "") {
            $this->logic->setTitle($params['title']);
        } else {
            $err['title'] = "Title required!";
            $flag = false;
        }
        $this->logic->setParent_id($params['parent_id']);
        $this->logic->setDes($params['des']);
        if (!$params['order_dislay'] == "") {
            if (!is_numeric($params['order_dislay'])) {
                $err['order_dislay'] = "Numeric only!";
                $flag = false;
            } else if ($params['order_dislay'] > 0) {
                $this->logic->setOrder_display($params['order_dislay']);
            } else {
                $err['order_dislay'] = "Number greater than zero only!";
                $flag = false;
            }
        } else {
            $this->logic->setOrder_display(1);
        }
        if ($flag == true) {
            $isOk = $this->logic->addCategory();
            if ($isOk) {
                $url = PATH . '/admin/category';
                header('location:' . $url);
            }
        } else {
            $data = array(
                'title' => $this->logic->getTitle(),
                'parent_id' => $this->logic->getParent_id(),
                'des' => $this->logic->getDes()
            );
        }
    }

    /*
     * @Author: HoangDV
     * @Function: delete category
     * @Since:
     * @Param:
     */

    public function delCate() {
        $id = $this->getParams('id');
        $pageCurent = $this->getParams('page');
        $aryCate = $this->logic->getChildCate($id);
        $aryIdCate = "";
        foreach ($aryCate as $k => $v) {
            $aryIdCate.=$v->cate_id . ',';
        }
        $aryIdCate.=$id;
        $pro = new Admin_Model_Product();
        $pro->delProduct($aryIdCate,'cate_id');
        $isOk = $this->logic->delCate($aryIdCate);
        $aryCondition = array(
            'order' => 'DESC',
            'conditionOrder' => 'cate_id',
            'where' => "status ='1'"
        );
        if ($pageCurent != 'undefined') {
            $aryCondition['pageCurent'] = $pageCurent;
        }
        if ($isOk) {
            $aryData = $this->logic->getAllCate($aryReturn, $aryCondition);
            $this->views->aryData = $aryData;
            $aryReturn['control'] = 'admin/category/index';
            $this->views->aryPage = $aryReturn;
            $aryClient['html'] = $this->views->renderToJson('category/index', 'admin');
            echo json_encode($aryClient);
        } else {
            $aryClient['html'] = "Error";
            echo json_encode($aryClient);
        }
    }

}
