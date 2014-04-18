
<?php

class Index_Controllers_Index extends Libs_Controllers {
    public function __construct() {
        parent::__construct();
    }

    public function index() {
            $this->views->title='xx';
            $this->views->setLayOut('index', 'index/index');

    }

}
