<?php
$data = $this->aryData;
?>
<div>
        <!-- Begin one column window -->
        <div class="onecolumn" style="margin: 0px">
            <div class="">
                <span class="title">Danh sách Users</span>
                    <span style="float: right;" class="controller">
                        <ul>
                            <li><a href="<?php echo PATH.'/admin/user/addUser'?>">Thêm</a></li>
                            <li><a href="#" onclick="UserController.delMutilUser()">Xóa</a></li>
                            <li><a href="#">Bật</a></li>
                            <li><a href="#">Tắt</a></li>
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
                                <input type="checkbox" id="check_all" name="check_all" onclick="BASE.toogleCheckBox();"/>
                            </th>
                            <th style="width:10%">ID</th>
                            <th style="width:30%">Tên thành viên</th>
                             <th style="width:15%">Avatar</th>
                            <th style="width:30%">Email</th>
                            <th style="width:25%">Address</th>
                            <th style="width:15%">Phone</th>
                            <th style="width:25%">Option</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($data as $k => $v) {
                        ?>
                        <tr id="<?php echo $v->user_id; ?>">
                            <td>
                                <input class="user-checkbox" type="checkbox" value="<?php echo $v->user_id; ?>"/>
                            </td>
                            <td><?php echo $v->user_id; ?></td>
                            <td><?php echo $v->full_name; ?></td>
                            <td><img title="<?php echo $v->full_name; ?>" alt="<?php echo $v->full_name; ?>" src="<?php echo PATH.'/upload/'. $v->avatar; ?>" width="80" height="80" /></td>
                            <td><?php echo $v->email; ?></td>
                            <td><?php echo $v->address; ?></td>
                            <td><?php echo $v->phone; ?></td>
                            <td>
                                <a href="<?php echo PATH ?>/admin/user/updateUser?id=<?php echo $v->user_id?>&page=<?php echo $this->aryPage['pageCurent']; ?>"><img src="<?php echo PATH?>/public/template/admin/images/icon_edit.png" alt="edit" class="help" title="Edit"/></a>
                                <a href="#" class = "delbutton" onclick="UserController.delUser(<?php echo $v->user_id; ?>)"><img src="<?php echo PATH?>/public/template/admin/images/icon_delete.png" alt="delete" class="help" title="Delete"/></a>
                            </td>
                        </tr>
                            <?php }?>
                        </tbody>
                    </table>
                    <div id="chart_wrapper" class="chart_wrapper"></div>

<?php
$page = 'application/layout/pagging/pagging.php';
include($page);
?>
