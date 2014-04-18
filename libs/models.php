<?php

/*
 * @Author: Hoangdv
 * @Function :Construct
 * Since:04/02/2014
 */

class Libs_Models
{

    protected $_Select = '*';
    protected $_Where = '';
    protected $_Order = '';
    protected $_Limit = '';

    /*
     * @Author: Hoangdv
     * @Function :Construct
     * @Since:04/02/2014
     */

    public function __construct()
    {
        $this->db = new Libs_Table_Database();
    }

    /*
     * @Author: Hoangdv
     * @Function :get select
     * @Since:04/02/2014
     */

    public function get_Select()
    {
        return $this->_Select;
    }

    /*
     * @Author: Hoangdv
     * @Function :set select
     * @Since:04/02/2014
     */

    public function set_Select($_Select)
    {
        $this->_Select = $_Select;
    }

    /*
     * @Author: Hoangdv
     * @Function :get where
     * @Since:04/02/2014
     */

    public function get_Where()
    {
        return $this->_Where;
    }

    /*
     * @Author: Hoangdv
     * @Function :set where
     * @Since:04/02/2014
     */

    public function set_Where($_Where)
    {
        $this->_Where = " WHERE " . $_Where;
    }

    /*
     * @Author: Hoangdv
     * @Function :get order
     * @Since:04/02/2014
     */

    public function get_Order()
    {
        return $this->_Order;
    }

    /*
     * @Author: Hoangdv
     * @Function :set order
     * @Since:04/02/2014
     */

    public function set_Order($_Order)
    {
        $this->_Order = $_Order;
    }

    /*
     * @Author: Hoangdv
     * @Function :get limit
     * @Since:04/02/2014
     */

    public function get_Limit()
    {
        return $this->_Limit;
    }

    /*
     * @Author: Hoangdv
     * @Function :Set limit
     * @Since:04/02/2014
     */

    public function set_Limit($_Limit)
    {
        $this->_Limit = $_Limit;
    }

    /*
     * @Author: Hoangdv
     * @Function :Get sql select
     * @Since:04/02/2014
     */

    public function getSqlSelect($table_name = '')
    {
        if ($table_name == '')
            return FALSE;
        return $sql = "SELECT {$this->get_Select()} FROM $table_name {$this->get_Where()} {$this->get_Order()} {$this->get_Limit()}";
    }

    /*
     * @Author: Hoangdv
     * @Function :Where
     * @Since:04/02/2014
     */

    public function Where($_Where = '')
    {
        if ($_Where == '')
            return FALSE;
        $this->set_Where($_Where);
    }

    /*
     * @Author: Hoangdv
     * @Function :Select
     * @Since:04/02/2014
     */

    public function Select($_Select = '*')
    {
        if ($_Select == '*')
            return FALSE;
        $this->set_Select($_Select);
    }

    /*
     * @Author: Hoangdv
     * @Function :Order
     * @Since:04/02/2014
     */

    public function Order($Condition = '', $List = 'ASC')
    {
        if ($Condition == '')
            return FALSE;
        $str = 'ORDER BY ' . $Condition . ' ' . $List;
        $this->set_Order($str);
    }

    /*
     * @Author: Hoangdv
     * @Function :Limit 
     * @Since:04/02/2014
     */

    public function Limit($Start = '', $Limit = '')
    {
        if ($Start === '') {
            return FALSE;
        }

        if ($Limit === '') {
            $str = 'LIMIT  ' . $Start;
        } else {
            $str = 'LIMIT  ' . $Start . ',' . $Limit;
        }
        $this->set_Limit($str);
    }

    /*
     * @Author: Hoangdv
     * @Function :Get sql insert
     * @Since:04/02/2014
     */

    public function getSqlInsert($aryData = array(), $table_name = '')
    {
        if ($table_name == '')
            return FALSE;
        if ($aryData != NULL) {
            $key = array();
            $val = array();
            foreach ($aryData as $k => $v) {
                $key[] = $k;
                $val[] = "'$v'";
            }
            $strKey = implode(',', $key);
            $strVal = implode(',', $val);
            $str = "INSERT INTO " . $table_name . " ( " . $strKey . " ) VALUES ( " . $strVal . " )";
        }
        return $str;
    }

    /*
     * @Author: Hoangdv
     * @Function :Get sql update
     * @Since:04/02/2014
     */

    public function getSqlUpdate($table_name = '', $aryData = array(), $where = '')
    {
        if ($table_name == '' || $where == '')
            return FALSE;
        if ($aryData != NULL) {
            $strUp = array();
            foreach ($aryData as $k => $v) {
                $strUp[] = "$k='$v'";
            }
            $strVal = implode(',', $strUp);
            $str = "UPDATE " . $table_name . " SET " . $strVal . " WHERE " . $where;
        }
        return $str;
    }

    /*
     * @Author: Hoangdv
     * @Function :Get sql delete
     * @Since:04/02/2014
     */

    public function getSqlDel($table_name = '', $where = '')
    {
        if ($table_name == '' || $where == '') {
            return FALSE;
        }
        return $str = "DELETE FROM " . $table_name . " WHERE " . $where;
    }

    /*
     * @Author: Hoangdv
     * @Function :Get sql delete
     * @Since:04/02/2014
     */

    public function paging($table = '', &$aryReturn, $aryCondition = array())
    {
        $select = isset($aryCondition['select']) ? $aryCondition['select'] : '*';
        $pageCurent = isset($aryCondition['pageCurent']) ? $aryCondition['pageCurent'] : 0;
        $conditionOrder = isset($aryCondition['conditionOrder']) ? $aryCondition['conditionOrder'] : '';
        $order = isset($aryCondition['order']) ? $aryCondition['order'] : '';
        $where = isset($aryCondition['where']) ? $aryCondition['where'] : '';
        // if table 
        if ($table == '')
            return false;
        $this->Select($select);
        $this->Where($where);
        $this->Order($conditionOrder, $order);
        $sql = $this->getSqlSelect($table);
        $total = $this->db->getNumRow($sql);
        $limit = PAGE;

        // check limit 
        if ($limit != '') {
            $totalPage = ceil($total / $limit);
            
            if ($pageCurent != 0) {
                $start = ($limit * ($pageCurent - 1));
            } else {
                $start = 0;
            }
            $this->Select($select);
            $this->Where($where);
            $this->Order($conditionOrder, $order);
            $this->Limit($start, $limit);
            $sql = $this->getSqlSelect($table);
        }
        // return data
        $aryReturn = array();
        $aryReturn['totalPage'] = $totalPage;
        $aryReturn['pageCurent'] = $pageCurent;
        return $aryData = $this->db->getAllRecord($sql);
    }

}

?>