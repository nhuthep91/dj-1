<?php
/**
 * Created by Hungpv
 * Date: 26/03/2014
 * Time: 17:22
 * View for add Category
 */
?>
<style type="text/css">
    label {
        width: 150px;
        float: left;
    }

    span {
        color: red;
    }
    form {
        padding-left: 10px;
    }
</style>
<?php

$cate_id = $parent_id = $title = $des = $order_dislay = $status = "";

$listCate = $this->listCate;

$data = $this->data;
$cate_id = $data['cate_id'];
$parent_id = $data['parent_id'];
$title = $data['title'];
$des = $data['des'];
$order_dislay = $data['order_dislay'];
$status = $data['status'];

?>
<h1>Add Category</h1>
<form name="f" id="f_cate" method="post" action="<?php echo PATH . '/admin/category/saveCategory';?>">
    <label>Title : </label>
    <input type="text" id="title" name="title" value="<?php echo $title; ?>"><span><?php echo $this->err['title']; ?></span>
    <span id="errTitle"></span>
    <br/><br/>

    <label>Parent Category : </label>
    <select name="parent_id">
        <option value="0"></option>
        <?php
        foreach ($listCate as $key => $value) {
            ?>
            <option value="<?php echo $value->cate_id; ?>"
                <?php echo $value->parent_id == $parent_id ? 'selected' : ""?>>
                <?php echo $value->title ?>
            </option>

        <?php
        }
        ?>
    </select>
    <br/><br/>

    <label>Description : </label><span><?php echo $this->err['des']; ?></span>
    <textarea rows="10" cols="80" name="des"><?php echo $des; ?></textarea>
    <br/><br/>

    <label>Order Display : </label>
    <input type="text" name="order_dislay"
           value="<?php echo $order_dislay; ?>"><span><?php echo $this->err['order_dislay']; ?></span>
    <br/><br/>

    <input type="submit" value="Add " onclick="return CateController.checkForm()">

</form>