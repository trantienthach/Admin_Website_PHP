<?php

/**
 * public, protected, private, static
 * static <=> public
 * --- public: sử dụng '->', và phải khởi tạo đối tượng [ vd: $u = new User(); ]
 *      $v = new Validation;
 *      $v->is_username();
 * --- static: sử dụng 'tên của đối tượng + ::', không cần phải khởi tạo đối tượng
 *      Validation::is_username();
 */

class Validation {
    /**
     * User regular expression to check password valid
     */
    public static function is_password( $password ) {
        $pattern = "/^(?=.*\d)(?=.*[a-zA-Z])[0-9a-zA-Z@#$%^&*_!]{6,}$/";
        if( preg_match($pattern, $password, $matches) ) return true;
        return false;
    }

    /**
     * User regular expression to check username valid
     */
    public static function is_username( $username ) {
        $pattern = "/^[A-Za-z0-9_\.]{6,32}$/";
        if( preg_match( $pattern, $username, $matches ) ) return true;
        return false;
    }

    /**
     * Show error
     */
    public static function form_error( $field ) {
        global $error;
        if( !empty( $error[$field] ) ) return $error[$field];
        return false;
    }

    /**
     * Show value
     */
    public static function form_value( $field ) {
        if( !empty( $_POST[$field] ) ) return $_POST[$field];
        return false;
    }
}