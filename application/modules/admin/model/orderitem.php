<?php
/**
 * Created by PhpStorm.
 * User: V3-571G
 * Date: 27/03/2014
 * Time: 17:23
 */

class Admin_Model_OrderItem extends Libs_Models{

    protected  $TABLE_NAME = '`order_items`';
    protected $_order_id;
    protected $_pro_id;
    protected $_pro_name;
    protected $_price;
    protected $_quantity;
    protected $_sub_price;
    protected $_pro_url;

    /**
     * @param mixed $sub_price
     */
    public function setSubPrice($sub_price)
    {
        $this->_sub_price = $sub_price;
    }

    /**
     * @return mixed
     */
    public function getSubPrice()
    {
        return $this->_sub_price;
    }

    /**
     * @param mixed $order_id
     */
    public function setOrderId($order_id)
    {
        $this->_order_id = $order_id;
    }

    /**
     * @return mixed
     */
    public function getOrderId()
    {
        return $this->_order_id;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->_price = $price;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->_price;
    }

    /**
     * @param mixed $pro_id
     */
    public function setProId($pro_id)
    {
        $this->_pro_id = $pro_id;
    }

    /**
     * @return mixed
     */
    public function getProId()
    {
        return $this->_pro_id;
    }

    /**
     * @param mixed $pro_name
     */
    public function setProName($pro_name)
    {
        $this->_pro_name = $pro_name;
    }

    /**
     * @return mixed
     */
    public function getProName()
    {
        return $this->_pro_name;
    }

    /**
     * @param mixed $pro_url
     */
    public function setProUrl($pro_url)
    {
        $this->_pro_url = $pro_url;
    }

    /**
     * @return mixed
     */
    public function getProUrl()
    {
        return $this->_pro_url;
    }

    /**
     * @param mixed $quantity
     */
    public function setQuantity($quantity)
    {
        $this->_quantity = $quantity;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->_quantity;
    }

    public function getItemsByOrder($orderId){
        $this->Select();
        $this->Where("order_id = $orderId");
        $sql = $this->getSqlSelect($this->TABLE_NAME);
        return $this->db->getAllRecord($sql);
    }

    public function deleteItems($orderId, $proIds){
        $sql = $this->getSqlDel($this->TABLE_NAME, " pro_id IN ($proIds) and order_id = $orderId");
        return $this->db->runQuery($sql);
    }
}