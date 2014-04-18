<style type="text/css">
    label{
        width: 150px; padding-left: 20px;
        float: left;
    }
    #title{
        padding-left: 450px; font-size: 24px; color: #8330FF; font-style: italic;
    }
    span{
        color: red;
    }
    td{border:none; width: 550px}
    table{margin: 0px;  border-collapse:collapse}
    #textDes{max-width: 550px; max-height: 300px;}
    #updateButton{margin-left: 50px;}
</style>
<?php
/* Author: Nhu Thep
 * create at 25/03/2014
 * Form update category
 */

$cate_id = $parent_id  = $title = $des = $order_dislay = $status ="";
$page = $_GET['page'];
$screen = 'edit';
if (isset($this->screen)) {

        $data = $this->aryData;
        $cate_id = $data['cate_id'];
        $parent_id = $data['parent_id'];
        $title = $data['title'];
        $des = $data['des'];
        $order_dislay = $data['order_dislay'];
        $status = $data['status'];   
         
}
?>
<span id="title"><?php echo "Update Category"; ?></span><hr><br/>
<table>
<form name="f" id="f_user" enctype="multipart/form-data" method="post" action="<?php
    echo PATH . '/admin/category/saveCategoryUpdate';

?>">
    <tr>
        <td>
                <label>Title : </label>
                <input type="text" name="title" value="<?php echo $title;  ?>"><span><?php echo $this->err['title'];  ?></span>
                <br/><br/><br/>

                <label>Parent Category : </label>
                <select name="parent_id">
                <?php 
                    $data=$this->aryCateId;
                    foreach ($data as $key => $value) {           
                     ?>
                         <option value="<?php echo $value->cate_id;?>" 
                          <?php
                        if ($cate_id ==  $value->cate_id)
                            echo 'selected="selected"';
                        ?> > 
                        <?php echo $value->title;?>
                        </option>
                        <?php
                    }
                ?>
                <option value="0" <?php 
                        if($parent_id == 0)
                            echo 'selected="selected"';
                    ?>>--None of above--
                </option>
                </select>
                <br/><br/><br/>

                <label>Order Display : </label>
                <input type="number" name="order_dislay" value="<?php echo $order_dislay;  ?>"><span><?php echo $this->err['order_dislay'];  ?></span>
                <br/><br/><br/>

                <label>Status : </label>
                <select name="status">
                    <option value="1"  <?php
                        if ($status == 1)
                            echo 'selected="selected"';
                        ?>>Enable
                    </option>
                    <option value="0"  <?php
                        if ($status == 0)
                            echo 'selected="selected"';
                        ?>>Disable
                    </option>
                </select><br/>

                <input type="hidden" name="cate_id" value="<?php echo $cate_id; ?>">
                <input type="hidden" name="page" value="<?php echo $page; ?>"><br/><br/>
                <input  type="submit" value="Update " id="updateButton">  
                <br/><br/>
        </td>
        <td>
                <label>Description : </label><br/><br/>
                <textarea id="textDes" rows="10" cols="80" name="des"><?php echo $des; ?></textarea><br/>
                <span><?php echo $this->err['des']; ?></span>
        </td>
    </tr>

</form>
</table>

   

