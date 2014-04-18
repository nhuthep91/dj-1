<?php

/*
 * Author: Hoangdv
 * Class model user
 * Since :03/02/2014
 */

class Login_Model_User extends Libs_Models {

    public $TABLE_NAME = 'tbl_user';
    protected $_email;
    protected $_password;

    public function __construct() {
        parent::__construct();
    }

    public function getName() {
        return $this->_name;
    }

    public function setName($_name) {
        $this->_name = $_name;
    }

    public function getPassword() {
        return $this->_password;
    }

    public function setPassword($_password) {
        $this->_password = $_password;
    }

    public function getEmail() {
        return $this->_email;
    }

    public function setEmail($_email) {
        $this->_email = $_email;
    }

    public function getUserLogin() {
        $this->Select();
        $condition = "email='" . $this->getEmail() . "'" . " AND password='" . $this->getPassword() . "' AND level='1'";
        $this->Where($condition);
        $sql = $this->getSqlSelect($this->TABLE_NAME);
        $num = $this->db->getNumRow($sql);
        return $num;
    }

    public function getMailExits($id = '') {
        $this->Select();
        $condition = "email='" . $this->getEmail() . "'";
        if ($id != '')
            $condition.=" AND id!='" . $id . "'";
        $this->Where($condition);
        $sql = $this->getSqlSelect($this->TABLE_NAME);
        $num = $this->db->getNumRow($sql);
        return $num;
    }

}
