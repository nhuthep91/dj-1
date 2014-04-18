<div>
    <!-- Begin one column window -->
    <div class="onecolumn" style="margin: 0px">
        <div class="">
            <span class="title" style="margin-left: 50px">Danh sách Loại Sản Phẩm</span>
            <span style="float: right;" class="controller">
                <ul>
                    <li><a href="<?php echo PATH . '/admin/category/addCategory' ?>">Thêm</a></li>
                    <li><a href="#" onclick="CateController.delMutilCate();">Xóa</a></li>
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
                                <input type="checkbox" id="check_all" onclick="BASE.toogleCheckBox();" name="check_all"/>
                            </th>
                            <th style="width:10%">ID</th>
                            <th style="width:30%">Tên Loại sản phẩm</th>
                            <th style="width:30%">Mô tả</th>
                            <th style="width:15%">Trạng thái</th>
                            <th style="width:25%">Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $view = 'application/modules/admin/views/category/view_category.php';
                        include($view);
                        ?>
                    </tbody>
                </table>
                <div id="chart_wrapper" class="chart_wrapper"></div>

                <?php
                $page = 'application/layout/pagging/pagging.php';
                include($page);
                ?>
