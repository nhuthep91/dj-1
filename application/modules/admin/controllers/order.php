<?php
//require_once 'libs/DatabaseProvider.php';

/**
 * Created by Hungpv
 * Date: 26/03/2014
 * Time: 15:45
 * Controller for Order
 */
class Admin_Controllers_Order extends Libs_Controllers
{

    protected $_model;
    protected $_items;

    function __construct()
    {
//        $factory = new DatabaseProvider();
//        $this->_model =$factory->createProvider('admin/order');
        parent::__construct();
        $this->_model = new Admin_Model_Order();
        $this->_items = new Admin_Model_OrderItem();
    }

    /*
     * author: Hungpv
     * Order index page
     * since: 26/3/2014
     * */
    function index()
    {
        $param = $this->getParams();
        $condition = array(
            'order' => 'DESC',
            'conditionOrder',
            'where' => "`status` !='Deleted'"
        );
        if (isset($param['page'])) {
            $condition['pageCurrent'] = $param['page'];
            $data = $this->_model->getListOrder($return, $condition);
            $this->views->data = $data;
            $return['control'] = 'admin/order/index';
            $this->views->aryPage = $return;
            $client['html'] = $this->views->renderToJson('order/index', 'admin');
            echo json_encode($client);
//            $this->views->setLayOut('admin', 'order/index');
        } else {
            if($this->getParams('Xpage'))
                $aryCondition['pageCurent'] = $param['Xpage'];
            $data = $this->_model->getListOrder($return, $condition);
            $this->views->data = $data;
            $return['control'] = 'admin/order/index';
            $this->views->aryPage = $return;
            $this->views->setLayOut('admin', 'order/index');
        }
    }

    /*
     * author: Hungpv
     * Move to update page
     * since: 27/3/2014
     * */

    function updateOrder()
    {
        $params = $this->getParams();
        if (!isset($params['id']) || $params['id'] == "" || !is_numeric($params['id'])) {
            $this->views->setLayOut('admin', 'error/404');
        } else {
            $data = $this->_model->getOrderById($params['id']);
            $items = $this->_items->getItemsByOrder($params['id']);
            $this->views->data = $data;
            $this->views->listItem = $items;
            $this->views->pageCurrent = isset($params['page']) && $params['page'] != "" ? $params['page'] : 1;
            $this->views->setLayOut('admin', 'order/update');
        }
    }

    /*
     * author: Hungpv
     * Update order
     * since: 27/3/2014
     * */

    function saveOrder()
    {
        $params = $this->getParams();
        if (!isset($params['order_id']) || $params['order_id'] == "" || !is_numeric($params['order_id'])) {
            $this->views->setLayOut('admin', 'error/404');
        }else{
            $this->_model->setStatus($params['status']);
            $this->_model->setName($params['note']);
            $this->_model->setId($params['order_id']);
            $isOk = $this->_model->updateOrder();
            if($isOk){
                $currentPage = isset($params['page']) && $params['page'] != "" && is_numeric($params['page']) ?
                    $params['page'] : 0;
//                $condition = array(
//                    'order' => 'DESC',
//                    'conditionOrder',
//                    'where' => "`status` !='Deleted'",
//                    'pageCurrent' => $currentPage
//                );
//
//                $data = $this->_model->getListOrder($return, $condition);
//                $this->views->data =$data;
//                $return['control'] = 'admin/order/index';
//                $this->views->aryPage = $return;
//                $this->views->setLayOut('admin', 'order/index');

                header('location:' . PATH . '/admin/order/index/?xpage=' . $currentPage);
            }

        }
    }

    /*
     * Author: Hungpv
     * Date: 27/03/2014
     */

    public function deleteOrder() {
        $id = $this->getParams('id');
        $page = $this->getParams('page');
        $this->_model->setId($id);

        $isOk = $this->_model->deleteOrder($id);
        $condition = array(
            'order' => 'DESC',
            'conditionOrder'=>'order_id',
            'where' => "`status` !='Deleted'"
        );
        if ($page != 'undefined') {
            $condition['pageCurent'] = $page;
        }
        if ($isOk) {
            $data = $this->_model->getListOrder($return, $condition);
            $this->views->data = $data;
            $return['control'] = 'admin/order/index';
            $this->views->aryPage = $return;
            $client['html'] = $this->views->renderToJson('order/index', 'admin');
            echo json_encode($client);
        } else {
            echo "Error!";
        }
    }

    /*
     * Author: Hungpv
     * Date: 31/03/2014
     * Delete Items in order
     */

    public function deleteItem(){
        $pro_id = $this->getParams('pro_id');
        $order_id = $this->getParams('order_id');
        $isOk = $this->_items->deleteItems($order_id, $pro_id);

        if ($isOk) {

            $listItems = $this->_items->getItemsByOrder($order_id);
            $totalPrice = 0;
            foreach($listItems as $item){
                $totalPrice += $item->quantity * $item->price;
            }
            $this->_model->setId($order_id);
            $this->_model->setTotalPrice($totalPrice);
            $this->_model->updatePrice();
            $data = $this->_model->getOrderById($order_id);
            $this->views->data = $data;
            $this->views->listItem = $listItems;
            $return['control'] = 'admin/order/update';
            $this->views->aryPage = $return;
            $client['html'] = $this->views->renderToJson('order/update', 'admin');
            echo json_encode($client);

        } else {
            echo "Error!";
        }
    }
}