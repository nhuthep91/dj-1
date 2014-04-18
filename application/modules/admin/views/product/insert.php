<?php
$title = "Thêm mới sản phẩm";
?>
<h1><?php echo $title; ?></h1>
<form name="f" id="f_user" enctype="multipart/form-data" method="post" 
      action="<?php echo PATH.'/admin/product/SavePro'; ?> 
">
    <label style="width: 150px; float:left;">Tên : </label>
    <input type="text" id='pro_name' name="pro_name" value=""/>
    <span id="errPro_name"></span>
    <br/><br/>
    <label style="width: 150px; float:left;">Short Description : </label>
    <input type="text" id="pro_short_desc" name="pro_short_desc" value=""/>
    <br/><br/>
    <label style="width: 150px; float:left;">Full Description : </label>
    <textarea id="pro_full_desc" name="pro_full_desc" > </textarea>
    <br/><br/>
    <label style="width: 150px; float:left;">Giá: </label>
    <input type="number" value="" id="pro_price" name="pro_price"/>
    <span id="errPro_price"></span>
    <br/><br/>
    <label style="width: 150px; float:left;">Hình ảnh : </label>
    <input type="file" id="pro_img" name="pro_img">
    <br/><br/>
    <?php
    $cate = $this->aryCate;
//    echo '<pre>';
//    var_dump($cate);die;
//    echo $cate."sfsfsfafs";
    ?>
    <label style="width: 150px; float:left;">Chuyên mục : </label>
    <select name="cate_id">
        <?php
        foreach ($cate as $v) {
            if ($v->cate_id == $cate) {
                $s = 'selected="selected"';
            }
            ?>
            <option value="<?php echo $v->cate_id ?>" <?php echo $s; ?> >
                <?php
                echo $v->title;
                ?>
            </option>
            <?php
        }
        ?>

    </select>
    <br/><br/>
    <label style="width: 100px; float:left;"> &nbsp;</label>
    <input type="submit" onclick="return ProductController.checkFormAdd();" value="Thêm "> 

</form>