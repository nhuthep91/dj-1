 <style type="text/css">
    td{
        vertical-align: middle;
        text-align: center;
    }
    .chan{ background: #FAFAFA !important; }
    .le{ background: #F2F2F2 !important; }
   
 </style>
 <?php
    $data = $this->aryData;
    $i = 0; 
    foreach ($data as $k => $v) {
        ?>
    <tr class="<?php if($i%2==0) echo "chan"; else echo "le"; $i++; ?>">
                        <td>
                              <input class="pro-checkbox" type="checkbox" value="<?php echo $v->slide_id; ?>"/>
                        </td>
                        <td><?php echo $v->slide_id ;?></td>
                        <td><?php echo $v->title ;?></td>
                        <td>
                            <img src="<?php echo PATH.'/upload/'.$v->image_url ?>" alt="<?php echo $v->title ?>" width="70px" height="70px" />
                        </td>
                        <td><?php echo $v->des; ?></td>
                        <td><?php echo $v->status; ?></td>
                        <td>
                            <a href="#"><img src="<?php echo PATH ?>/public/template/admin/images/icon_edit.png" alt="edit" class="help" title="Edit"/></a>
                            <a href="#" onclick="ProductController.delProduct(<?php echo $v->pro_id; ?>)"><img src="<?php echo PATH ?>/public/template/admin/images/icon_delete.png" alt="delete" class="help" title="Delete"/></a>
                        </td>
    </tr>
<?php
 }
 ?>