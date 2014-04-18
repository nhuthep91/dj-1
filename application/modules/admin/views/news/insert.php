<?php
$id = $name = $content = "";
$order=1;
$screen = 'edit';
$title = "Update news";
if (isset($this->screen)) {
    if ($this->screen == 'add') {
        $screen = 'add';
        $title = "Add news";
    }
    $data = $this->aryData;
    $id = $data['news_id'];
    $name = $data['title'];
    $content = $data['content'];
    $image_url = $data['image_url'];
    $order=$data['order_display'];
    $page = $_GET['page'];
}
?>
<div id="sample">
    <script type="text/javascript">
        bkLib.onDomLoaded(function() {
            nicEditors.allTextAreas()
        });

    </script>
    <form name="f_add" enctype="multipart/form-data" method="post" action="<?php echo $screen == 'add' ? PATH . '/admin/news/saveNews' : PATH . '/admin/news/saveNewsUpdate' ?>">
        <h4 style="color: red;text-align: center;background: wheat"><?php echo $title; ?></h4>

        <label style="margin-left: 10px">Tiêu đề </label>
        <input style="margin-left: 20px" onchange="NewsController.checkTitle('title', '<?php echo $id; ?>')" name="title" id="title" type="text" value="<?php echo $name; ?>">
        <span style="margin-left: 60px;color: red" id="errTitle"></span>
        <br/><br/>
        <label style="margin-left: 10px">Order Display </label>
        <input style="margin-left: 20px" onchange="NewsController.checkOrder('order_display')" name="order_display" id="order_display" type="text" value="<?php echo $order; ?>">
        <span style="margin-left: 60px;color: red" id="errOrder"></span>
        <br/><br/>
        <label style="margin-left: 1px">Image feature</label>
        <?php
        if ($screen == 'edit') {
            ?>
            <img style="border: 1px solid #cccccc" width="100px" height="100px" title="<?php echo $title; ?>" alt="<?php echo $title; ?>" src="<?php echo PATH . '/upload/' . $image_url ?>"><br/><br/>
            <?php
        }
        ?>
        <input name="img" id="img" type="file">
        <br/><br/>
        <span style="margin-left: 300px;color: red" id="err"></span>
        <textarea id="text_content" name="content"  style="min-width: 800px; min-height: 300px;">
            <?php echo $content ?>
        </textarea>

</div>
<br/>
<input type="hidden" name="page" value="<?php echo $page; ?>">
<input id="id" type="hidden" value="<?php echo $id; ?>" name="id">
<input style="margin-left: 20px" type="submit" name="Add" value="<?php echo $title; ?>" onclick="return NewsController.check();">
</form>