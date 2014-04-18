<div class="pagination">
    <?php
    if (isset($this->aryPage)) {
        $Datapage = $this->aryPage;
        if (isset($Datapage['totalPage']) && $Datapage['totalPage'] > 0) {
            if (isset($Datapage['pageCurent']) && $Datapage['pageCurent'] != null) {
                if ($Datapage['pageCurent'] != 1) {

                    $pagePrev = $Datapage['pageCurent'] - 1;
                    ?>
                    <a href="#" 
                       onclick="BASE.getPage('<?php echo $Datapage['control'] ?>', '<?php echo $pagePrev; ?>')" > «</a>
                       <?php
                   }
                   ?>
                <input type="hidden" value="<?php echo $Datapage['pageCurent']; ?>" id="page_curent"/>
                <?php
            }
            for ($i = 1; $i <= $Datapage['totalPage']; $i++) {
                ?>
                <a href="#"
                <?php
                if ($Datapage['pageCurent'] == $i)
                    echo 'class="active"';
                ?>
                   onclick="BASE.getPage('<?php echo $Datapage['control'] ?>', '<?php echo $i; ?>')" ><?php echo $i; ?> </a>
                   <?php
               }
               if (isset($Datapage['pageCurent']) && $Datapage['pageCurent'] !== null) {
                   if ($Datapage['pageCurent'] != $Datapage['totalPage'] && $Datapage['pageCurent'] !== 0) {
                       $pageNext = $Datapage['pageCurent'] + 1;
                       ?>
                    <a href="#" onclick="BASE.getPage('<?php echo $Datapage['control'] ?>', '<?php echo $pageNext; ?>')" >  »</a>
                    <?php
                }
            }
        }
    }
    ?>
</div>