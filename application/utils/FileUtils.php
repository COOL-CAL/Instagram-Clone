<?php
    function getRandomFileNm($fileName) {
        $ranFileName = gen_uuid_v4();
        $ext = getExt($fileName);
        return $ranFileName . "." . $ext;
    }

    function getExt($fileName) {
        $arrFileName = explode(".", $fileName);
        return end($arrFileName);

        //solve.
        // return pathinfo($fileName, PATHINFO_EXTENSION);
        // return substr($fileName, strrpos($fileName, ".") + 1);
    }

    function gen_uuid_v4() {
        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x'
        , mt_rand(0, 0xffff)
        , mt_rand(0, 0xffff)
        , mt_rand(0, 0xffff)
        , mt_rand(0, 0x0fff) | 0x4000
        , mt_rand(0, 0x3fff) | 0x8000
        , mt_rand(0, 0xffff)
        , mt_rand(0, 0xffff)
        , mt_rand(0, 0xffff) 
    ); 
    }