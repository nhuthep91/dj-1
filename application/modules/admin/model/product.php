<?php

/**
 * Created by JetBrains PhpStorm.
 * User: Min
 * Date: 9/13/13
 * Time: 7:39 PM
 * To change this template use File | Settings | File Templates.
 */class Admin_Model_Product extends Libs_Models {

    public $Table_name = 'product';
    protected $_id;
    protected $_name;
    protected $_price;
    protected $_short_des;
    protected $_full_des;
    protected $_img;
    protected $_status;
    protected $_cate_id;

    public function __construct() {

        parent::__construct();
    }

    public function getTable_name() {
        return $this->Table_name;
    }

    public function setTable_name($Table_name) {
        $this->Table_name = $Table_name;
    }

    public function get_id() {
        return $this->_id;
    }

    public function set_id($_id) {
        $this->_id = $_id;
    }

    public function get_name() {
        return $this->_name;
    }

    public function set_name($_name) {
        $this->_name = $_name;
    }

    public function get_price() {
        return $this->_price;
    }

    public function set_price($_price) {
        $this->_price = $_price;
    }

    public function get_short_des() {
        return $this->_short_des;
    }

    public function get_full_des() {
        return $this->_full_des;
    }

    public function set_short_des($_short_des) {
        $this->_short_des = $_short_des;
    }

    public function set_full_des($_full_des) {
        $this->_full_des = $_full_des;
    }

    public function get_img() {
        return $this->_img;
    }

    public function set_img($_img) {
        $this->_img = $_img;
    }

    public function get_status() {
        return $this->_status;
    }

    public function set_status($_status) {
        $this->_status = $_status;
    }

    public function get_cate_id() {
        return $this->_cate_id;
    }

    public function set_cate_id($_cate_id) {
        $this->_cate_id = $_cate_id;
    }

    public function getAllProduct(&$aryReturn, $aryCondition = array()) {

        if ($aryCondition == NULL) {
            $aryCondition['conditionOrder'] = 'pro_id';
            $aryCondition['order'] = 'DESC';
        }
        $aryReturn = array();
        $aryData = $this->paging($this->Table_name, $aryReturn, $aryCondition);
        return $aryData;
    }

    public function getProductById($pro_id, &$arydata) {
        $this->Select();
        $this->Where("pro_id='" . $pro_id . "'");
        $sql = $this->getSqlSelect($this->Table_name);
        $isOk = $this->db->getNumRow($sql);
        if ($isOk != 0) {
            $arydata = $this->db->getOneRecord($sql);
        }
    }

    public function updateToProduct() {
        $where = "pro_id='" . $this->get_id() . "'";
        $aryData = array(
            'title' => $this->get_name(),
            'price' => $this->get_price(),
            'cate_id' => $this->get_cate_id(),
            'short_des' => $this->get_short_des(),
            'full_des' => $this->get_full_des()
        );
        if ($this->get_img() != '')
            $aryData['image_url'] = $this->get_img();
        $sql = $this->getSqlUpdate($this->Table_name, $aryData, $where);
        $isOk = $this->db->runQuery($sql);
        return $isOk;
    }

    public function checkNameExits() {
        $this->Select();
        $condition = "pro_name='" . $this->get_name() . "'";
        $this->Where($condition);
        $sql = $this->getSqlSelect($this->Table_name);
        $num = $this->db->getNumRow($sql);
        return $num;
    }

// save 

    public function addPro() {
        $aryData = array(
            'title' => $this->get_name(),
            'price' => $this->get_price(),
            'cate_id' => $this->get_cate_id(),
            'short_des' => $this->get_short_des(),
            'full_des' => $this->get_full_des(),
            'image_url' => $this->get_img()
        );
        $sql = $this->getSqlInsert($aryData, $this->Table_name);
        $isOk = $this->db->runQuery($sql);
        return $isOk;
    }

    /*
     * @Author: HoangDV
     * @Function: delete product
     * @Since:
     * @Param:
     */

    public function delProduct($ids, $where = '') {
        $aryUpdate = array('`status`' => '0');
        if ($where == '') {
            $where = "pro_id IN ($ids)";
        } else {
            $where = "cate_id IN ($ids)";
        }
        $sql = $this->getSqlUpdate($this->Table_name, $aryUpdate, $where);
        $isOk = $this->db->runQuery($sql);
        return $isOk;
    }

    public function getNameExits($id = '') {
        $this->Select();
        $condition = "title ='" . $this->get_name() . "'";
        if ($id != '')
            $condition.=" AND pro_id !='" . $id . "'";
        $this->Where($condition);
        $sql = $this->getSqlSelect($this->Table_name);
        $num = $this->db->getNumRow($sql);
        return $num;
    }

}
