<html>
    <head>
        <?php
        $this->headScript('base');
        $this->headLink();
        $this->headScript();
        $this->getPlugin();
        ?>
        <title><?php echo $this->title; ?></title>
        <script type="text/javascript">
            $(document).ready(function() {
            });
        </script>
        <script type="text/javascript">
            var URL_ROOT = "<?php echo PATH; ?>";
        </script>
        <!-- Meta data for SEO -->
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <script>
            //function to fix height of iframe!
            var calcHeight = function() {
                var headerDimensions = $('#header-bar').height();
                $('#preview-frame').height($(window).height() - headerDimensions);
            }

            $(document).ready(function() {
                calcHeight();
                $('#header-bar a.close').mouseover(function() {
                    $('#header-bar a.close').addClass('activated');
                }).mouseout(function() {
                        $('#header-bar a.close').removeClass('activated');
                    });
            });

            $(window).resize(function() {
                calcHeight();
            }).load(function() {
                    calcHeight();
                });
        </script>
    </head>