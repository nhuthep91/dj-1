<?php

/*
 * Author: Hoangdv
 * Class model user
 * Since :03/02/2014
 */

class Admin_Model_User extends Libs_Models
{

    public $TABLE_NAME = 'tbl_user';
    protected $_id;
    protected $_name;
    protected $_email;
    protected $_password;
    protected $_address;
    protected $_phone;
    protected $_level;
    protected $_avatar;

    public function __construct()
    {

        parent::__construct();
    }

    public function getId()
    {
        return $this->_id;
    }

    public function setId($_id)
    {
        $this->_id = $_id;
    }

    public function getName()
    {
        return $this->_name;
    }

    public function setName($_name)
    {
        $this->_name = $_name;
    }

    public function getPassword()
    {
        return $this->_password;
    }

    public function setPassword($_password)
    {
        $this->_password = $_password;
    }

    public function getEmail()
    {
        return $this->_email;
    }

    public function setEmail($_email)
    {
        $this->_email = $_email;
    }

    public function getAddress()
    {
        return $this->_address;
    }

    public function setAddress($_address)
    {
        $this->_address = $_address;
    }

    public function getPhone()
    {
        return $this->_phone;
    }

    public function setPhone($_phone)
    {
        $this->_phone = $_phone;
    }

    public function getLevel()
    {
        return $this->_level;
    }

    public function setLevel($_level)
    {
        $this->_level = $_level;
    }

    public function getAvatar()
    {
        return $this->_avatar;
    }

    public function setAvatar($_avata)
    {
        $this->_avatar = $_avata;
    }

    public function getAllUser(&$aryReturn, $aryCondition = array())
    {
        $aryReturn = array();
        $aryData = $this->paging($this->TABLE_NAME, $aryReturn, $aryCondition);
        return $aryData;
    }

    /*
     * Author: Hoangdv
     * Function add user
     * Since :03/02/2014
     */

    public function addUser()
    {
        $aryInsert = array(
            'full_name' => $this->getName(),
            'email' => $this->getEmail(),
            'password' => $this->getPassword(),
            'address' => $this->getAddress(),
            'phone' => $this->getPhone(),
            'level' => $this->getLevel(),
            'avatar' => $this->getAvatar()
        );
        $sql = $this->getSqlInsert($aryInsert, $this->TABLE_NAME);
        $isOk = $this->db->runQuery($sql);
        return $isOk;
    }

    /*
     * Author: Hungpv
     * Function delete user
     * Since :25/03/2014
     */
    public function delUser($ids)
    {
        $arr = array('`status`' => '0');
        $sql = $this->getSqlUpdate($this->TABLE_NAME, $arr, "user_id IN ($ids)");
        $isOk = $this->db->runQuery($sql);
        return $isOk;
    }

    public function getUserById()
    {
        $this->Select();
        $this->Where("user_id='" . $this->getId() . "'");
        $sql = $this->getSqlSelect($this->TABLE_NAME);
        $aryData = $this->db->getOneRecord($sql);
        return $aryData;
    }

    /*
    * Author: nhu thep
    * update user
    */
    public function updateUser($status)
    {

        $aryUpdate = array(
            'full_name' => $this->getName(),
            'email' => $this->getEmail(),
            'password' => $this->getPassword(),
            'address' => $this->getAddress(),
            'phone' => $this->getPhone(),
            'level' => $this->getLevel(),
        );
        if($status==1) {
            $aryUpdate['avatar'] = $this->getAvatar();
        }
        $sql = $this->getSqlUpdate($this->TABLE_NAME, $aryUpdate, "user_id='" . $this->getId() . "'");
        return $isOk = $this->db->runQuery($sql);
    }

    public function getUserLogin()
    {
        $this->Select();
        $condition = "email='" . $this->getEmail() . "'" . " AND password='" . $this->getPassword() . "' AND level='2'";
        $this->Where($condition);
        $sql = $this->getSqlSelect($this->TABLE_NAME);
        $num = $this->db->getNumRow($sql);
        return $num;
    }

    public function getMailExits($id = '')
    {
        $this->Select();
        $condition = "email ='" .  $this->getEmail(). "'";
        if ($id != '')
            $condition.=" AND user_id !='" . $id . "'";
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