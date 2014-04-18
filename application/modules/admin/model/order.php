<?php

/**
 * Created by Hungpv
 * User: V3-571G
 * Date: 26/03/2014
 * Time: 14:40
 * Use: Model for Order Module
 */
class Admin_Model_Order extends Libs_Models
{
    public $TABLE_NAME = '`order`';
    protected $_id;
    protected $_name;
    protected $_email;
    protected $_password;
    protected $_address;
    protected $_phone;
    protected $_totalPrice;
    protected $_note;
    protected $_date;
    protected $_status;

    function __construct()
    {
        parent::__construct();
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
        $this->_address = $address;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->_address;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->_date = $date;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->_date;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->_email = $email;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->_id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @param mixed $note
     */
    public function setNote($note)
    {
        $this->_note = $note;
    }

    /**
     * @return mixed
     */
    public function getNote()
    {
        return $this->_note;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->_name = $name;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->_password = $password;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->_password;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->_phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->_phone;
    }

    /**
     * @param mixed $totalPrice
     */
    public function setTotalPrice($totalPrice)
    {
        $this->_totalPrice = $totalPrice;
    }

    /**
     * @return mixed
     */
    public function getTotalPrice()
    {
        return $this->_totalPrice;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->_status = $status;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->_status;
    }


    /**
     * Created by Hungpv
     * Get list of order
     * since: 26/3/2014
     */

    public function getListOrder(&$arrayReturn, $condition = array())
    {
        if ($condition == NULL) {
            $condition['conditionOrder'] = 'order_id';
            $condition['order'] = 'DESC';
            $condition['where'] = "`status` != 'Deleted'";
        }
        $arrayReturn = array();
        $result = $this->paging($this->TABLE_NAME, $arrayReturn, $condition);
        return $result;
    }

    /**
     * Created by Hungpv
     * Delete orders
     * since: 26/3/2014
     */

    public function deleteOrder($ids){
        $arr = array('`status`' => 'Deleted');
        $sql = $this->getSqlUpdate($this->TABLE_NAME,$arr, "order_id IN ($ids)");
        return $this->db->runQuery($sql);
    }

    /**
     * Created by Hungpv
     * Get single Order By ID
     * since: 27/3/2014
     */
    public function getOrderById($id){

        $this->Select();
        $this->Where("order_id = $id and `status` != 'Deleted'");
        $sql = $this->getSqlSelect($this->TABLE_NAME);
        return $this->db->getOneRecord($sql);
    }

    /**
     * Created by Hungpv
     * Update category
     * since: 27/3/2014
     */
    public function updateOrder(){
        $array = array(
            '`status`' => $this->getStatus(),
            'note' => $this->getNote()
        );
        $sql = $this->getSqlUpdate($this->TABLE_NAME, $array, "order_id = {$this->getId()}");
        return $this->db->runQuery($sql);

    }

    public function updatePrice(){
        $array = array(
            'total_price' => $this->getTotalPrice()
        );
        $sql = $this->getSqlUpdate($this->TABLE_NAME, $array, "order_id = {$this->getId()}");
        return $this->db->runQuery($sql);
//        return $sql;
    }
} 