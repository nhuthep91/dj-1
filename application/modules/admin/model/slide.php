<?php

/*
 * Author: Hoangdv
 * Class model slide
 * Since :03/02/2014
 */

class Admin_Model_Slide extends Libs_Models
{

    public $TABLE_NAME = 'slideshow';
    protected $_slide_id;
    protected $_title;
    protected $_image_url;
    protected $_target_url;
    protected $_des;
    protected $_content;
    protected $_order_display;
    protected $_status;
    protected $_url_rewrite;

    public function __construct()
    {

        parent::__construct();
    }

    public function getTABLE_NAME() {
        return $this->TABLE_NAME;
    }
    public function getTargetUrl() {
        return $this->_target_url;
    }
    public function getSlide_id() {
        return $this->_slide_id;
    }

    public function getTitle() {
        return $this->_title;
    }

    public function getImage_url() {
        return $this->_image_url;
    }

    public function getDes() {
        return $this->_des;
    }

    public function getContent() {
        return $this->_content;
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

    public function setTABLE_NAME($TABLE_NAME) {
        $this->TABLE_NAME = $TABLE_NAME;
        return $this;
    }

    public function setSlide_id($slide_id) {
        $this->_slide_id = $slide_id;
        return $this;
    }

    public function setTargetUrl($target_url) {
        $this->_target_url = $target_url;
        return $this;
    }

    public function setTitle($title) {
        $this->_title = $title;
        return $this;
    }

    public function setImage_url($image_url) {
        $this->_image_url = $image_url;
        return $this;
    }

    public function setDes($des) {
        $this->_des = $des;
        return $this;
    }

    public function setContent($content) {
        $this->_content = $content;
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

    
    public function getAllSlide(&$aryReturn, $aryCondition = array())
    {
        $aryReturn = array();
        $aryData = $this->paging($this->TABLE_NAME, $aryReturn, $aryCondition);
        return $aryData;
    }

    /*
     * Author: nhu thep
     * Function save silde sql
     */

    public function saveNewSlide()
    {
        $aryInsert = array(
            'title' => $this->getTitle(),
            'image_url' => $this->getImage_url(),
            'des' => $this->getDes(),
            'target_url' => $this->getTargetUrl(),
            'order_dislay' => $this->getOrder_display(),
            'status' => $this->getStatus()
        );
        $sql = $this->getSqlInsert($aryInsert, $this->TABLE_NAME); 
        $isOk = $this->db->runQuery($sql); 
        return $isOk;
    }

    /*
     * Author: Hungpv
     * Function delete slide
     * Since :25/03/2014
     */
    public function delSlide($ids)
    {
        $arr = array('`status`' => '0');
        $sql = $this->getSqlUpdate($this->TABLE_NAME, $arr, "slide_id IN ($ids)");
        $isOk = $this->db->runQuery($sql);
        return $isOk;
    }

    public function getSlideById()
    {
        $this->Select();
        $this->Where("slide_id='" . $this->getId() . "'");
        $sql = $this->getSqlSelect($this->TABLE_NAME);
        $aryData = $this->db->getOneRecord($sql);
        return $aryData;
    }

    /*
    * Author: nhu thep
    * update slide
    */
    public function updateSlide()
    {
        $aryUpdate = array(
            'full_name' => $this->getName(),
            'email' => $this->getEmail(),
            'password' => $this->getPassword(),
            'address' => $this->getAddress(),
            'phone' => $this->getPhone(),
            'level' => $this->getLevel()
        );
        $sql = $this->getSqlUpdate($this->TABLE_NAME, $aryUpdate, "slide_id='" . $this->getId() . "'");
        return $isOk = $this->db->runQuery($sql);
    }

    public function getSlideLogin()
    {
        $this->Select();
        $condition = "email='" . $this->getEmail() . "'" . " AND password='" . $this->getPassword() . "' AND level='2'";
        $this->Where($condition);
        $sql = $this->getSqlSelect($this->TABLE_NAME);
        $num = $this->db->getNumRow($sql);
        return $num;
    }

    public function getTitleExits($id = '')
    {
        $this->Select();
        $condition = "title ='" .  $this->getTitle(). "'";
        if ($id != '')
            $condition.=" AND slide_id !='" . $id . "'";
        $this->Where($condition);
        $sql = $this->getSqlSelect($this->TABLE_NAME); 
        $num = $this->db->getNumRow($sql);
        return $num;
    }

    /*
    * author: nhu thep
    * check format email 
    */

    public function validateEmail($email= '')
    {
        $email = $this->getEmail();
        if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email))
        {
            return 1; 
       }
    }

  
}