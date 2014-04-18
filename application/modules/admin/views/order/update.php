<?php
/**
 * Created by Hungpv
 * Date: 27/03/2014
 * Time: 16:48
 */
$data = $this->data;
$listItem = $this->listItem;
?>
<style>
    .numBox{
        width: 40px;
    }
    .errBox{
        display: none;
        color: red;
    }
</style>
<div>
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
            <form action="<?php echo PATH . "/admin/order/saveOrder" ?>" method="post" name="f_order">
                <div class="order-info">
                    <div class="customer-name">
                        <label>Customer name: </label><span><?php echo $data['cus_name'] ?></span></br>
                    </div>
                    <div class="customer-email">
                        <label>Customer email: </label><span><?php echo $data['cus_email'] ?></span></br>
                    </div>
                    <div class="customer-phone">
                        <label>Customer phone: </label><span><?php echo $data['cus_phone'] ?></span></br>
                    </div>
                    <div class="customer-address">
                        <label>Customer address: </label><span><?php echo $data['cus_address'] ?></span></br>
                    </div>
                    <div class="customer-note">
                        <label>Note: </label></br><textarea name="note"><?php echo $data['note'] ?></textarea></br>
                    </div>
                </div>

                <div class="list-product-items">
                    <table>
                        <thead>
                        <tr>
                            <th style="width:10px">
                                <input type="checkbox" id="check_all" name="check_all" class="toggleCheckox"
                                       onclick="BASE.toogleCheckBox();"/>
                            </th>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total Price</th>
                            <th>Options</th>
                        </tr>

                        </thead>
                        <tbody>
                        <?php $count = 1;
                        foreach ($listItem as $item) {
                            ?>
                            <tr>
                                <td>
                                    <input class="order-checkbox" type="checkbox" value="<?php echo $v->user_id; ?>"/>
                                </td>
                                <td><?php echo $count; ?></td>
                                <td><a href="<?php echo $item->pro_url; ?>"><?php echo $item->pro_name ?></a></td>
                                <td><input id="numBox<?php echo $count; ?>" type="number" class="numBox"
                                           value="<?php echo $item->quantity ?>" min="1" max="99"
                                           onchange="OrderController.checkNum(<?php echo $count; ?>)">
                                    <span class="errBox" id="numErr<?php echo $count; ?>" >Numbers 1-99 only!</span>
                                </td>
                                <td id="priceBox<?php echo $count; ?>"><?php echo number_format($item->price, 2, '.', ' ') ?></td>
                                <td id="subPriceBox<?php echo $count; ?>"><?php echo number_format($item->sub_price, 2, '.', ' ')  ?></td>
                                <td>
<!--                                    <a href="#"><img src="--><?php //echo PATH ?><!--/public/template/admin/images/icon_edit.png"-->
<!--                                            alt="edit" class="help" title="Edit"-->
<!--                                            onclick="OrderController.toggleEdit(--><?php //echo $count ?><!--)"/></a>-->
                                    <a href="#" class="delbutton"
                                       onclick="OrderController.deleteItem(<?php echo $item->pro_id; ?>, <?php echo $data['order_id'] ?>,
                                                                            '<?php echo $item->pro_name; ?>')"><img
                                            src="<?php echo PATH ?>/public/template/admin/images/icon_delete.png"
                                            alt="delete" class="help" title="Delete"/></a>
                                </td>
                            </tr>
                            <?php $count++;
                        } ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="boxTotalPrice"><?php echo number_format($data['total_price'],2,'.',' ') ?></td>
                        </tr>
                        </tbody>
                    </table>

                    </br>
                    <label>Status: </label>

                    <select name="status">
                        <option value="Confirm" <?php echo $data['status'] == "Confirm" ? 'selected="selected"' : "" ?>>
                            Confirm
                        </option>
                        <option
                            value="Shipping" <?php echo $data['status'] == "Shipping" ? 'selected="selected"' : "" ?>>
                            Shipping
                        </option>
                        <option
                            value="Completed" <?php echo $data['status'] == "Completed" ? 'selected="selected"' : "" ?>>
                            Completed
                        </option>
                        <option value="Deleted" <?php echo $data['status'] == "Deleted" ? 'selected="selected"' : "" ?>>
                            Deleted
                        </option>
                    </select>
                </div>
                </br>
                <input type="submit" value="Update">

                <input type="hidden" name="order_id" value="<?php echo $data['order_id']; ?>"/>
                <input type="hidden" name="page" value="<?php echo $this->pageCurrent; ?>"/>
            </form>
        </div>
    </div>
</div>