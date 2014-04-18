<?php

/*
 * Author: Hoangdv
 * Class : Database
 * Since :03/02/2014
 */

class Libs_Table_Database
{

    public function __construct()
    {
        
    }

    /*
     * Author: Hoangdv
     * Function : connect
     * Since :03/02/2014
     */

    public function connect()
    {
        $con = @mysql_connect(DB_HOST, DB_USER, DB_PASS);
        if ($con) {
            mysql_query("set names 'UTF8'", $con);
            if (!mysql_select_db(DB_NAME, $con)) {
                die("Not connect database");
            }
        } else {
            die("Not connect sever");
        }
    }

    /*
     * Author: Hoangdv
     * Function : get All record
     * Since :03/02/2014
     */

    function getAllRecord($sql = '')
    {
        if ($sql != '') {
            $this->connect();
            $aryData = new ArrayObject();
            $result = mysql_query($sql);
            if ($result != FALSE) {
                if (mysql_num_rows($result) > 0) {
                    while ($row = mysql_fetch_object($result)) {
                        $aryData->append($row);
                    }
                }
                return $aryData;
            } else {
                return FALSE;
            }
            $this->close_connect();
        }
    }

    /*
     * Author: Hoangdv
     * Function : get One record
     * Since :03/02/2014
     */

    function getOneRecord($sql = '')
    {
        if ($sql != '') {
            $this->connect();
            $result = mysql_query($sql);
            if (mysql_num_rows($result) > 0) {
                $row = mysql_fetch_assoc($result);
            }
            return $row;
            $this->close_connect();
        }
    }

    /*
     * Author: Hoangdv
     * Function : get Number record
     * Since :03/02/2014
     */

    function getNumRow($sql = '')
    {
        if ($sql != '') {
            $this->connect();
            $result = mysql_query($sql);
            if ($result != FALSE) {
                $num = mysql_num_rows($result);
                return $num;
            }
            $this->close_connect();
        }
    }

    /*
     * Author: Hoangdv
     * Function : Run sql
     * Since :03/02/2014
     */

    function runQuery($sql)
    {
        if ($sql != '') {
            $this->connect();
            $result = mysql_query($sql);
            if ($result != FALSE) {
                $result = 1;
            } else {
                $result = 0;
            }
            return $result;
            $this->close_connect();
        }
    }

    /*
     * Author: Hoangdv
     * Function : Close connect
     * Since :03/02/2014
     */

    public function close_connect()
    {
        @mysql_close();
    }

}
