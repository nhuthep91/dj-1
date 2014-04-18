<?php
$id = $name = $email = $password = $address = $phone = "";
$level = 1;
$screen = 'add';
$title = "Thêm mới sản phẩm";
if (isset($this->screen)) {
    $screen = $this->screen;
    if ($screen == 'edit') {
        $title = "Update mới sản phẩm";
        $data = $this->aryData;
        $id = $data['pro_id'];
        $name = $data['title'];
        $price = $data['price'];
        $quantity = $data['quantity'];
        $status = $data['status'];
        $cate_id = $data['cate_id'];
        $img = $data['image_url'];
        $page = $_GET['page'];
    }
}
?>
<style type="text/css">
    label{
        width: 150px;
        float: left;
        margin-left: 100px;
    }
</style>
<h1 style="margin-left: 300px;padding: 30px"><?php echo $title; ?></h1>
<form  name="f" id="f_user" enctype="multipart/form-data" method="post" action="<?php
if ($screen == 'add') {
    echo PATH . '/admin/product/SavePro';
} else {
    echo PATH . '/admin/product/saveProUpdate';
}
?>">
    <label>Tên : </label>
    <input type="text" onchange="ProductController.checkName('name','<?php echo $_GET['id'];?>');" name="pro_name" id="name" value="<?php echo $name; ?>"><?php echo $this->err['pro_name']; ?><span id="errName"></span>
    <br/><br/>
    <label>Giá: </label>
    <input type="text" value="<?php echo $price; ?>" id="price" name="pro_price"><?php echo $this->err['pro_price']; ?><span id="errPrice"></span>

    <br/>
    <label>Hình ảnh : </label>
    <img type="text" name="pro_img" width="100px;" height="80px" src="<?php echo PATH . '/upload/' . $img; ?>"/>
    <input type="file" name="pro_img">
    <br/><br/>
    <input type="hidden" name="page" value="<?php echo $page; ?>">
    <?php
    $cate = $this->aryCate;
    ?>
    <label>Chuyên mục : </label>
    <select name="cate_id">
        <?php
        foreach ($cate as $k => $v) {
            if ($v->cate_id == $cate_id) {
                $s = 'selected="selected"';
            }
            ?>
            <option value="<?php echo $v->cate_id ?>" <?php echo $s; ?>>
                <?php
                echo $v->title;
                ?>
            </option>
            <?php
        }
        ?>

    </select>
    <br/>
    <?php
    if ($this->screen == "add") {
        ?>  
        <input type="submit" value="Thêm "> 
    <?php } elseif ($this->screen == "edit") {
        ?>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input  style="margin-left: 340px;margin-top: 20px" type="submit"  onclick="return ProductController.checkFormPro();" value="Update "> 
        <?php
    }
    ?>

</form>