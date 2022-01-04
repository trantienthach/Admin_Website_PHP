<?php


class UserController extends BaseController {

    private $UserModel;

    public function __construct()
    {
        $this->UserModel = $this->model("UserModel");
    }

    public function login() {

        if( isset($_POST['loginAction']) ) {

            $error = [];
            global $error;

            /**
             * --- check username
             *  + check người dùng đã nhập chưa
             *  + check username hợp lệ
             */
            if( empty( $_POST['username'] ) ) {
                $error['username'] = "<span class='error'>(*) Vui lòng nhập username<span>";
            } else {
                if( !Validation::is_username( $_POST['username'] ) ) {
                    $error['username'] = "<span class='error'>(*) Tên đăng nhập không hợp lệ</span>";
                } else {
                    // check 'Sql injection'
                    $username = $_POST['username'];
                }
            }

            /**
             * --- check password
             *  + check người dùng đã nhập chưa
             *  + check password đã đúng với 'Regular expression'
             */
            if( empty( $_POST['password'] ) ) {
                $error['password'] = "<span class='error'>(*) Vui lòng nhập mật khẩu</span>";
            } else {
                if( !Validation::is_password( $_POST['password'] ) ) {
                    $error['password'] = "<span class='error'>(*) Mật khẩu không hợp lệ</span>";
                } else {
                    // check 'Sql injection'
                    $password = $_POST['password'];
                }
            }

            /**
             * check login empty $error -> login not error
             *     b1: check empty $error
             *     b2: Kiểm tra đăng nhập
             *          + kiểm tra user đã active
             *          + Số lần đăng nhập sai ( Giới gạn chỉ đăng nhập 3 lần, quá 3 lần là khóa tài khoảng )
             *     b3: Lưu đăng nhập sử dụng cookie và session
             *          + cookie là để lưu đăng nhập lần kế tiếp mà không cần nhập username và password
             *          + session là để lưu đăng nhập tạm thời tại thời điểm đang đăng nhập
             */
            if( empty($error) ) {
                $processLogin = $this->UserModel->checkLogin( $username, $password );
                if( $processLogin['status'] ) {
                    if( !empty( $_POST['remember_me'] ) ) {
                        Cookie::set("isLogin", $username, 3600);
                    }
                    Session::set("isLogin", $username);
                    Helper::redirect();
                } else {
                    $error['login'] = $processLogin['errorTxt'];
                }
            } else {
                $error['login'] = "<span class='error'>(*) Đăng nhập không thành công</span>";
            }
        }
        $this->view("Frontend.Users.login");
    }

    public function logout() {
        Session::_unset("isLogin");
        Cookie::delete("isLogin","", 3600);
        Helper::redirect("?controller=user&action=login");
    }

    public function register() {
        echo "Method Register";
    }

}