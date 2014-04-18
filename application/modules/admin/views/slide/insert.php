<style type="text/css">
    label{
        width: 200px; padding-left: 40px;
        float: left;
    }
    #title{
        padding-left: 450px; font-size: 24px; color: #8330FF; font-style: italic;
    }
    #addButton{ margin-left: 40px;}
    span{
        color: red;
    }
    textarea{max-width: 500px; max-height: 200px; }
</style>

<?php
$title = "Add New Slide";
$descipt = $this->descipt; 
?>

<span id="title"><?php echo $title; ?></span><hr/><br/>
<form  enctype="multipart/form-data" method="post" 
      action="<?php echo PATH.'/admin/slide/saveSlide'; ?> 
">
    <label>Title : </label>
    <input type="text" name="title" value="<?php echo $this->title; ?>"/><span><?php echo isset($this->err['title']) ? $this->err['title']:''; ?></span>
    <br/><br/>

    <label>Description : </label>
    <textarea id="des" rows="5" cols="50" name="des"><?php echo $descipt?></textarea><span><?php echo isset($this->err['des']) ? $this->err['des']:''; ?></span>
    <br/><br/>

    <label>Image Target URL : </label>
    <input type="text" name="target_url" value="<?php echo $this->target; ?>"><span><?php echo isset($this->err['target_url']) ? $this->err['target_url']:''; ?></span>
    <br/><br/>
    
    <label>Order Display: </label>
    <input type="number" name="order_display" value="<?php echo $this->order_display; ?>"/><span><?php echo isset($this->err['order_display']) ? $this->err['order_display']:''; ?></span>
    <br/><br/>

    <label>Image : </label>
    <input type="file" name="slide_img">
    <br/><br/>

    <label>Status : </label>
      <select name="status">
                    <option value="1"  <?php
                        if ($status == 1)
                            echo 'selected="selected"';
                        ?>>Enable
                    </option>
                    <option value="0"  <?php
                        if ($status == 2)
                            echo 'selected="selected"';
                        ?>>Disable
                    </option>
        </select>
        <br/><br/><br/>
   
    <input type="submit" value="Add New" id="addButton"> 

</form>