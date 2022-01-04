<?php

class Auth {

    public function __construct()
    {
        $this->confirmLogin();
    }

    public function confirmLogin() {
        $action = !empty($_GET['action']) ? $_GET['action'] : 'index';
        $actionAllow = ['login', 'register', 'error404'];
        if( Cookie::check("isLogin") ) {
            Session::set('isLogin', Cookie::get("isLogin"));
        } else {
            if( !Session::check("isLogin") && !in_array( $action, $actionAllow ) ) {
                Helper::redirect("?controller=user&action=login");
            }
        }
    }

}