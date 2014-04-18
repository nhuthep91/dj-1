<body>
    <div class="content_wrapper">
        <!-- Begin header -->
        <div id="header">
            <div id="logo">
                <img src="<?php echo PATH.'/public/template/admin/';?>images/logo.png" alt="logo"/>
            </div>
            <div id="account_info">
                <img src="<?php echo PATH.'/public/template/admin/images/icon' ?>_online.png" alt="Online" class="mid_align"/>
                Hello <a href="<?php echo PATH.'/admin/user';?>" style="color:wheat"><?php echo $_SESSION['user']; ?></a> (<a href="">1 new message</a>) | <a href="">Setting</a> | <a href="<?php echo PATH.'/login/index/logout';?>">Logout</a>
            </div>
        </div>
        <!-- End header -->
        <!-- Begin left panel -->
        <a href="javascript:;" id="show_menu">&raquo;</a>
        <div id="left_menu">
            <ul id="main_menu">
                <li><a href="<?php echo PATH;?>"><img src="<?php echo PATH.'/public/template/admin/images/icon' ?>_home.png" alt="Home"/>Home</a></li>
                <li>
                    <a id="menu_pages" href="<?php echo PATH."/admin/category";?>"><img src="<?php echo PATH.'/public/template/admin/images/icon' ?>_pages.png" alt="Category"/>Category</a>
                </li>
                <li>
                    <a id="menu_pages" href="<?php echo PATH."/admin/product";?>"><img widtd="16px" height="16px" src="<?php echo PATH.'/public/template/admin/images/icon' ?>_product.png" alt="Product"/>Products</a>
                </li>
                <li>
                    <a href="<?php echo PATH."/admin/news";?>"><img src="<?php echo PATH.'/public/template/admin/images/icon' ?>_posts.png" alt="Posts"/>News</a>	
                </li>
                <li>
                    <a href="<?php echo PATH."/admin/slide";?>"><img src="<?php echo PATH.'/public/template/admin/images/icon' ?>_media.png" alt="Media"/>Slide</a>
                </li>
                <li>
                    <a href="<?php echo PATH."/admin/user"?>"><img src="<?php echo PATH.'/public/template/admin/images/icon' ?>_users.png" alt="Users"/>User</a>
                </li>
                <li>
                    <a href="<?php echo PATH."/admin/order"?>"><img src="<?php echo PATH.'/public/template/admin/images/icon' ?>_order.gif" alt="Order"/>Order</a>
                </li>

            </ul>
            <br class="clear"/>
            <!-- Begin left panel calendar -->
            <div id="calendar"></div>
            <!-- End left panel calendar -->	
        </div>
        <!-- End left panel -->
        <!-- Begin content -->
        <div id="content">
            <div class="inner">
                <br class="clear"/>
                <ul id="shortcut">
                    <li>
                        <a href="<?php echo PATH.'/admin';?>" id="shortcut_home" title="Trang chủ">
                            <img src="<?php echo PATH.'/public/template/admin' ?>/images/shortcut/home.png" alt="home"><br>
                            <strong>Home</strong>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo PATH.'/admin';?>" title="Cấu hình chung">
                            <img src="http://web24h.com.vn/public/admin/images/shortcut/setting.png" alt="setting"><br>
                            <strong>Cấu hình</strong>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo PATH.'/admin';?>" id="shortcut_contacts" original-title="Liên hệ">
                            <img src="http://web24h.com.vn/public/admin/images/shortcut/contacts.png" alt="contacts"><br>
                            <strong>Liên hệ</strong>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo PATH.'/admin';?>" id="shortcut_contacts" original-title="Liên hệ">
                            <img src="http://web24h.com.vn/public/admin/images/shortcut/contacts.png" alt="contacts"><br>
                            <strong>Liên hệ</strong>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo PATH.'/admin';?>" id="shortcut_contacts" original-title="Liên hệ">
                            <img src="http://web24h.com.vn/public/admin/images/shortcut/contacts.png" alt="contacts"><br>
                            <strong>Liên hệ</strong>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo PATH.'/admin';?>" id="shortcut_contacts" original-title="Liên hệ">
                            <img src="http://web24h.com.vn/public/admin/images/shortcut/contacts.png" alt="contacts"><br>
                            <strong>Liên hệ</strong>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo PATH.'/admin';?>" id="shortcut_contacts" original-title="Liên hệ">
                            <img src="http://web24h.com.vn/public/admin/images/shortcut/contacts.png" alt="contacts"><br>
                            <strong>Liên hệ</strong>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo PATH.'/admin';?>" id="shortcut_contacts" original-title="Liên hệ">
                            <img src="http://web24h.com.vn/public/admin/images/shortcut/contacts.png" alt="contacts"><br>
                            <strong>Liên hệ</strong>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo PATH.'/admin';?>" id="shortcut_contacts" original-title="Liên hệ">
                            <img src="http://web24h.com.vn/public/admin/images/shortcut/contacts.png" alt="contacts"><br>
                            <strong>Liên hệ</strong>
                        </a>
                    </li>
                </ul>
                <br class="clear"/>
                <div class="onecolumn">
                    <div id="show_content">


