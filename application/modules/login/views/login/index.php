<!-- Begin content -->
<div id="login_body_window">
    <div class="inner">
        <form action="<?php echo PATH . '/login/index/login'; ?>" method="post" id="form_login" name="form_login" >
            <p>
                <input type="text" id="email" name="email" style="width:285px" title="Username" 
                       value='<?php
                       if (isset($_POST['email']) && $_POST['email'] != NULL) {
                           echo $_POST['email'];
                       }
                       ?>'
                       placeholder="Email"/>

            </p>
            <span id="errEmail"></span>
            <?php echo $errorUsername; ?>

            <p>
                <input type="password" id="password" name="password" style="width:285px" title="******"
                       value='<?php
                       if (isset($_POST['password']) && $_POST['password'] != NULL) {
                           echo $_POST['password'];
                       }
                       ?>'
                       placeholder="Password"/>

            </p>
            <br/>
            <span id="errPass"></span>
            <?php echo $errorPassword; ?>

            <p style="margin-top:50px">
                <input type="submit" onclick="return LoginController.validateForm('email', 'password')" id="submit" name="submit" value="Login" class="Login" style="margin-right:5px"/>
            </p>  
        </form>
    </div>
</div>

<!-- End content -->
</div>
<!-- End login window -->