<style type="text/css">
    #title{
        padding-left: 450px; font-size: 20px; color: #8330FF; font-style: italic;
    }
    thead{
        text-align: center;
    }
    
</style>
<!-- Begin one column window -->
<div class="onecolumn">
    <div class="">
        <span class="title" id="title">List Slide</span>
        <span style="float: right;" class="controller">
            <ul>
                <li><a href="<?php echo PATH.'/admin/slide/addSlide'; ?>">Thêm</a></li>
                <li><a onclick="ProductController.delMutilProduct();" href="#">Xóa</a></li>
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
                        <th style="width:7%">Slide Id</th>
                        <th style="width:26%">Title</th>
                        <th style="width:10%">Image</th>
                        <th style="width:37%">Description</th>
                        <th style="width:7%">Status</th>
                        <th style="width:7%">Option</th>
                    </tr>
                </thead>
                <tbody>
                     <?php
                        $view = 'application/modules/admin/views/slide/view_slide.php';
                        include($view);
                        ?>
           
                </tbody>
            </table>
            <div id="chart_wrapper" class="chart_wrapper"></div>

            <?php
                 $page = 'application/layout/pagging/pagging.php';
                 include($page);
            ?>