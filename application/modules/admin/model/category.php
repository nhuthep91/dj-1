<?php

/**
 * Created by JetBrains PhpStorm.
 * User: Min
 * Date: 9/13/13
 * Time: 7:39 PM
 * To change this template use File | Settings | File Templates.
 */class Admin_Model_Category extends Libs_Models {

    public $TABLE_NAME = 'category';
    protected $_cate_id;
    protected $_parent_id;
    protected $_title;
    protected $_des;
    protected $_order_display;
    protected $_status;
    protected $_url_rewrite;

    public function getName() {
        return $this->name;
    }

    public function getCate_id() {
        return $this->_cate_id;
    }

    public function getParent_id() {
        return $this->_parent_id;
    }

    public function getTitle() {
        return $this->_title;
    }

    public function getDes() {
        return $this->_des;
    }

    public function getOrder_display() {
        return $this->_order_display;
    }

    public function getStatus() {
        return $this->_status;
    }

    public function getUrl_rewrite() {
        return $this->_url_rewrite;
    }

    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    public function setCate_id($cate_id) {
        $this->_cate_id = $cate_id;
        return $this;
    }

    public function setParent_id($parent_id) {
        $this->_parent_id = $parent_id;
        return $this;
    }

    public function setTitle($title) {
        $this->_title = $title;
        return $this;
    }

    public function setDes($des) {
        $this->_des = $des;
        return $this;
    }

    public function setOrder_display($order_display) {
        $this->_order_display = $order_display;
        return $this;
    }

    public function setStatus($status) {
        $this->_status = $status;
        return $this;
    }

    public function setUrl_rewrite($url_rewrite) {
        $this->_url_rewrite = $url_rewrite;
        return $this;
    }

    public function __construct() {

        parent::__construct();
    }

    /*
     * Author: Hoangdv
     * Function get cate all
     * Since :03/02/2014
     */

    public function getAllCate(&$aryReturn, $aryCondition = array()) {
        $aryCondition['conditionOrder'] = 'order_dislay';
        $aryCondition['order'] = 'ASC';
        if (!isset($aryCondition) || !isset($aryCondition['where'])) {
            $aryCondition['where'] = "status='1'";
        }
        $aryReturn = array();
        $aryData = $this->paging($this->TABLE_NAME, $aryReturn, $aryCondition);
        return $aryData;
    }

    /*
     * Author: Datnd
     * Function get all cate no pagging
     * 
     */

    public function getAllCateNoPag(&$aryReturn) {
        $this->Select();
        $where = "status!='0'";
        $this->Where($where);
        $sql = $this->getSqlSelect($this->TABLE_NAME);
        $aryReturn = $this->db->getAllRecord($sql);
    }

    /*
     * author: nhu thep
     * get category by cate id
     */

    public function getCateById() {
        $this->Select();
        $this->Where("cate_id='" . $this->getCate_id() . "'");
        $sql = $this->getSqlSelect($this->TABLE_NAME);
        $aryData = $this->db->getOneRecord($sql);
        return $aryData;
    }

    /*
     * author: nhu thep
     * get all child category
     */

    public function getChildCate($cate_id = '') {
        $this->Select();
        if ($cate_id != '')
            $con = "parent_id IN(" . $cate_id . ")";
        else {
            $con = "parent_id ='" . $this->getCate_id() . "'";
        }
        $this->Where($con);
        $sql = $this->getSqlSelect($this->TABLE_NAME);
        $aryData = $this->db->getAllRecord($sql);
        return $aryData;
    }

    /*
     * author: nhu thep
     * get all cate_id
     * except this cate id and this child cate
     */

    public function getAllCateId() {  //getAllCateId($myAry=array()) // in case sub have sub
        //$childCate = implode($myAry, "','"); //in case sub have sub
        $this->Select();
        //incase sub have sub...
        //$con="cate_id !='" . $this->getCate_id() . "'"." AND cate_id NOT IN ('".$childCate."')";
        //get all parent id
        $con = "parent_id = 0 AND cate_id !=" . $this->getCate_id();
        $this->Where($con);
        $sql = $this->getSqlSelect($this->TABLE_NAME);
        $aryData = $this->db->getAllRecord($sql);
        return $aryData;
    }

    /*
     * author: nhu thep
     * update cate sql
     */

    public function updateCate() {
        $aryUpdate = array(
            'title' => $this->getTitle(),
            'parent_id' => $this->getParent_id(),
            'des' => $this->getDes(),
            'order_dislay' => $this->getOrder_display(),
            'status' => $this->getStatus()
        );
        $sql = $this->getSqlUpdate($this->TABLE_NAME, $aryUpdate, "cate_id='" . $this->getCate_id() . "'");

        return $isOk = $this->db->runQuery($sql);
    }

    /*
     * author: Hungpv
     * add new Category
     * since: 27/3/2014
     * */

    public function addCategory() {
        $array = array(
            'title' => $this->getTitle(),
            'parent_id' => $this->getParent_id(),
            'des' => $this->getDes(),
            'order_dislay' => $this->getOrder_display(),
            'status' => '1'
        );
        $sql = $this->getSqlInsert($array, $this->TABLE_NAME);
        return $this->db->runQuery($sql);
    }

    /*
     * Hoangdv
     * Del cate
     * Since: 27/3/2014
     */

    public function delCate($ids) {
        $arr = array('`status`' => '0');
        $sql = $this->getSqlUpdate($this->TABLE_NAME, $arr, "cate_id IN ($ids)");
        $isOk = $this->db->runQuery($sql);
        return $isOk;
    }

    /*
     * Author: Hoangdv
     * Function get all cate
     * Since :03/02/2014
     */

    public function getAllCateNoWhere(&$aryReturn) {
        $this->Select();
        $sql = $this->getSqlSelect($this->TABLE_NAME);
        $aryReturn = $this->db->getAllRecord($sql);
    }

}
