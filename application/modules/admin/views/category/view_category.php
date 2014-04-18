<?php
$data = $this->aryData;
foreach ($data as $k => $v) {
    ?>
    <tr style=" background: #FEFEE7;">
        <td> 
            <input class="cate-checkbox" type="checkbox" value="<?php echo $v->cate_id; ?>"/>
        </td>
        <td><?php echo $v->cate_id; ?></td>
        <td style="color: red"><?php echo $v->title; ?> 
        </td>
        <td><?php echo $v->des; ?></td>
        <td><?php echo $v->status == 1 ? 'Đang bán' : 'Không bán'; ?></td>
        <td>
            <a href="<?php echo PATH ?>/admin/category/updateCategory?cate_id=<?php echo $v->cate_id ?>&page=<?php echo $this->aryPage['pageCurent']; ?>"><img src="<?php echo PATH ?>/public/template/admin/images/icon_edit.png" alt="edit" class="help" title="Edit"/></a>
            <a href="#" class = "delbutton" onclick="CateController.delCate(<?php echo $v->cate_id; ?>)"><img src="<?php echo PATH ?>/public/template/admin/images/icon_delete.png" alt="delete" class="help" title="Delete"/></a>
        </td>
    </tr>    
    <?php
}
?>