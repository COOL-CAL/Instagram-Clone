<?php
namespace application\controllers;

class UserController extends Controller {
    public function signin() {
        switch(getMethod()) {
            case _GET:
                return "user/signin.php";
            case _POST:
                $email = $_POST["email"];
                
                $param = [
                    "email" => $_POST["email"],
                    "pw" => $_POST["pw"]
                ];

                $dbUser = $this->model->selUser($param);

                // if(!$dbUser) { //아이디 없음
                //     return "redirect:/user/signin";
                // } else if(!password_verify($param["pw"], $dbUser->pw)) {
                //     return "redirect:/user/signin";
                // }

                if(!$dbUser || !password_verify($param["pw"], $dbUser->pw)) {
                    return "redirect:signin?email=$email&err";
                }

                // $this->flash(_LOGINUSER, $dbUser);

                return "redirect:/feed/index";
                }

        }
    

    public function signup() {
        // if(getMethod() === _GET) {
        //     return "user/signup.php";
        // } else if(getMethod() === _POST) {
        //     return "redirect:signin";
        // }
        // or
        switch(getMethod()) {
            case _GET:
                return "user/signup.php";
            case _POST:
                $param = [
                    "email" => $_POST["email"],
                    "pw" => $_POST["pw"],
                    "nm" => $_POST["nm"]
                ];
                $param["pw"] = password_hash($param["pw"], PASSWORD_BCRYPT);
                $this->model->insUser($param);
                return "redirect:signin";
        }
    }
}