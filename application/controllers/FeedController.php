<?php
    namespace application\controllers;

    class FeedController extends Controller {
        public function index() {
            $this->addAttribute(_JS, ["feed/index", "https://unpkg.com/swiper@8/swiper-bundle.min.js"]);
            $this->addAttribute(_CSS, ["feed/index" , "https://unpkg.com/swiper@8/swiper-bundle.min.css"]);
            $this->addAttribute(_MAIN, $this->getView("feed/index.php"));
            return "template/t1.php";
        }

        public function rest() {
            // print "method : " . getMethod() . "<br>";
            switch(getMethod()) {
                case _POST:
                    if(!is_array($_FILES) || !isset($_FILES["imgs"])) {
                        return ["result" => 0];
                    }
                    // $imgCount = count($_FILES["img"]["name"]);

                    $iuser = getIuser();
                    $param = [
                        "location" => $_POST["location"],
                        "ctnt" => $_POST["ctnt"],
                        "iuser" => getIuser()
                    ];

                    $ifeed = $this->model->insFeed($param);
                    
                    foreach($_FILES["imgs"]["name"] as $key => $originFileNm) {
                        
                        $saveDirectroy = _IMG_PATH . "/feed/" . $ifeed;
                        if(!is_dir($saveDirectroy)) {
                            mkdir($saveDirectroy, 0777, true); //0777: 권한 주기
                        }
                        $tempName = $_FILES['imgs']['tmp_name'][$key];
                        $randomFileNm = getRandomFileNm($originFileNm);
                        $param = [
                            "ifeed" => $ifeed,
                            "img" => $randomFileNm
                        ];
                        if(move_uploaded_file($tempName, $saveDirectroy . "/" . $randomFileNm)) {
                            $this->model->insFeedImg($param);
                        }
                        
                        // $file_name[count($file_name) -1]; //확장자
                    }
                    return ["result" => 1];

                case _GET:
                    $page = 1;
                    if(isset($_GET["page"])) {
                        $page = intval($_GET["page"]);
                    }
                    $startIdx = ($page - 1) * _FEED_ITEM_CNT;
                    $param = [
                        "startIdx" => $startIdx,
                        "iuser" => getIuser()
                    ];
                    $list = $this->model->selFeedList($param);
                    foreach($list as $item) {
                        $item->imgList = $this->model->selFeedImgList($item);
                    }
                    
                    return $list;
            }
        }

        public function fav() {
            $urlPaths = getUrlPaths();
            if(!isset($urlPaths[2])) {
                exit();
            }

            $param = [
                "ifeed" => intval($urlPaths[2]),
                "iuser" => getIuser()
            ];

            switch(getMethod()) {
                case _POST:
                    return [_RESULT => $this->model->insFeedFav($param)];
                case _DELETE:
                    return [_RESULT => $this->model->delFeedFav($param)];
            }
        }
    }