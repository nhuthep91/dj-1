<?php

class Login_Controllers_Index extends Libs_Controllers {

    public function __construct() {

        parent::__construct();
        $this->logic = new Login_Model_User();
    }

    public function index() {
        $this->views->setLayOut('login', 'login/index');
    }

// Hàm login

    public function login() {
        $err = array();
// get param
        $param = $this->getParams();

// validate form

        if ((trim($param['email']) == '')) {
            $err['email'] = "Moi nhap email";
        } else {
            $this->logic->setEmail($param['email']);
        }

        if ((trim($param['password']) == '')) {

            $err['password'] = " Moi nhap password";
        } else {
            $this->logic->setPassword(md5($param['password']));
        }

// neu pass val
        if ($err == null) {

            $num = $this->logic->getUserLogin();
            if ($num != 0) {
                $_SESSION['user'] = $this->logic->getEmail();
                header('location:' . PATH . '/admin/user');
            } else {
                ?>
                <script>
                    alert("Sai email hoac password!");
                </script>
                <?php

                $this->index();
            }
        } else {
            $aryClient['html'] = $this->views->renderToJson('login/index');
        }
    }

//Hàm logout
    public function logout() {
        session_destroy();
        $this->index();
    }

}
