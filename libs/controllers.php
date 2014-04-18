<?php

class Libs_Controllers {

    function __construct() {
        $this->views = new Libs_views();
    }

    /*
     * @Auth :Hoangdv
     * @Desc:Function get param from client
     * @Since:
     * @Param:
     */

    public function getParams($name = '') {
        if ($name == '' && isset($_REQUEST)) {
            return $aryData = $_REQUEST;
        } elseif ($name != '' && isset($_REQUEST[$name])) {
            return $aryData = $_REQUEST[$name];
        }
    }

    /*
     * @Auth :Hoangdv
     * @Desc:Function location to url
     * @Since:
     * @Param:module
     */

    public function redirect($url = "") {
        if ($url == "") {
            echo 'Not found link !';
            return FALSE;
        } else {
            header("location:" . PATH . '/' . $url);
        }
    }

    public function file_extension($filename) {
        return @strtolower(end(explode(".", $filename)));
    }

    /*
     * @Auth :Hoangdv
     * @Desc:Function upload file
     * @Since:
     * @Param:module
     */

    public function upload($name = "", $max_size = 2, $dir = 'upload', $exts = array()) {
        if ($name == '' && isset($_FILES[$name])) {
            // config
            $max_size = 1000000000000 * 2;
            if ($exts == NULL) {
                $exts = array('jpg', 'gif', 'png', 'bpm');
            }
            if ($_FILES[$name]["size"] <= $max_size) {
                $ext = $this->file_extension($_FILES[$name]["name"]);
                if (in_array($ext, $exts)) {
                    if ($_FILES[$name]["error"] > 0) {
                        $err = "Not support format file or size too big";
                    } else {
                        if (file_exists($dir . '/' . $_FILES[$name]["name"])) {
                            $images = $_FILES[$name]["name"];
                        } else {
                            move_uploaded_file($_FILES["file"]["tmp_name"], $thumucupload . "/" . $_FILES["file"]["name"]);
                            $images = $_FILES["file"]["name"];

//  echo 'Upload thành công !';
                        }
                    }
                } else {

// echo" aaCó lỗi xảy ra khi upload - Xin xem lại định dạng file và dung lượng file !</font><br /><br />";
                }
            }
        }
    }

}
?>