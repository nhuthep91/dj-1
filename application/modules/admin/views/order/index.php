<?php $data = $this->data;
$page = $this->aryPage?>

<div>
    <!-- Begin one column window -->
    <div class="onecolumn" style="margin: 0px">
        <div class="">
            <span class="title">Orders</span>
                    <span style="float: right;" class="controller">
                        <ul>
                            <!--                            <li><a href="-->
                            <?php //echo PATH . '/admin/ord/addUser' ?><!--">Thêm</a></li>-->
                            <li><a href="#" onclick="OrderController.delMutilOrder()">Xóa</a></li>
                            <!--                            <li><a href="#">Bật</a></li>-->
                            <!--                            <li><a href="#">Tắt</a></li>-->
                        </ul>
                    </span>
        </div>
        <br class="clear"/>

        <div class="content">
            <form id="form_data" name="form_data" action="" method="post">
                <table class="data" width="100%" cellpadding="0" cellspacing="0">
                    <thead>
                    <tr>
                        <th style="width:10px">
                            <input type="checkbox" id="check_all" name="check_all" class="toggleCheckox"
                                   onclick="BASE.toogleCheckBox();"/>
                        </th>
                        <th style="width:5%">ID</th>
                        <th style="width:10%">Tên khách hàng</th>
                        <th style="width:10%">Email</th>
                        <th style="width:10%">Phone</th>
                        <th style="width:10%">Address</th>
                        <th style="width:35%">Note</th>
                        <th style="width:10%">Total Price</th>
                        <th style="width:10%">Date</th>
                        <th style="width:10%">Status</th>
                        <th style="width:10%">Options</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($data as $k => $v) {
                        ?>
                        <tr id="<?php echo $v->user_id; ?>">
                            <td>
                                <input class="order-checkbox" type="checkbox" value="<?php echo $v->user_id; ?>"/>
                            </td>
                            <td><?php echo $v->order_id; ?></td>
                            <td><?php echo $v->cus_name; ?></td>
                            <td><?php echo $v->cus_email; ?></td>
                            <td><?php echo $v->cus_phone; ?></td>
                            <td><?php echo $v->cus_address; ?></td>
                            <td><?php echo $v->note; ?></td>
                            <td><?php echo $v->total_price; ?></td>
                            <td><?php echo $v->date; ?></td>
                            <td><?php echo $v->status; ?></td>
                            <td>
                                <a href="<?php echo PATH ?>/admin/order/updateOrder?id=<?php echo $v->order_id . '&page=' . $page['pageCurent'] ?>"><img
                                        src="<?php echo PATH ?>/public/template/admin/images/icon_edit.png" alt="edit"
                                        class="help" title="Edit"/></a>
                                <a href="#" class="delbutton"
                                   onclick="OrderController.deleteOrder(<?php echo $v->order_id; ?>)"><img
                                        src="<?php echo PATH ?>/public/template/admin/images/icon_delete.png"
                                        alt="delete" class="help" title="Delete"/></a>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <div id="chart_wrapper" class="chart_wrapper"></div>

        </div>

    </div>
    <?php
    $page = 'application/layout/pagging/pagging.php';
    include($page);
    ?>
</div>
