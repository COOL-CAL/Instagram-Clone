<?php
    namespace application\controllers;

    class FeedController extends Controller {
        public function index() {
            $this->addAttribute(_JS, ["feed/index"]);
            $this->addAttribute(_MAIN, $this->getView("feed/index.php"));
            return "template/t1.php";
        }

        public function rest() {
            // print "method : " . getMethod() . "<br>";
            switch(getMethod()) {
                case _POST:
                    if(!is_array($_FILES) || isset($_FILES["imgs"])) {
                        return ["result" => 0];
                    }
                    $imgCount = count($_FILES["img"]["name"]);

                    $iuser = getIuser();
                    $param = [
                        "location" => $_POST["location"],
                        "ctnt" => $_POST["ctnt"],
                        "iuser" => getIuser()
                    ];

                    // $ifeed = $this->model->insFeed($param);
                    
                    foreach($_FILES["imgs"]["name"] as $key => $value) {
                        $file_name = explode(".", $value);
                        $ext = end($file_name);
                        $saveDirectroy = _IMG_PATH . "/profile/" . $iuser;
                        if(!is_dir($saveDirectroy)) {
                            mkdir($saveDirectroy, 0777, true); //0777: 권한 주기
                        }
                        $tempName = $_FILES['imgs']['tmp_name'][$key];
                        move_uploaded_file($tempName, $saveDirectroy . "/test" . $ext);
                        
                        // I WANNA GET OUTTA HERE!
                        // FUCK!
                        // SOMEBODY HELP ME!
                        // $file_name[count($file_name) -1]; //확장자
                    }
                    // return ["rs" => $r];
            }
        }
    }