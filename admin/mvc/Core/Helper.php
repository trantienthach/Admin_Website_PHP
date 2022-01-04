<?php

class Helper {
    public static function redirect( $url = '' ) {
        header("Location: " . Config::getBaseUrlAdmin($url) . "");
    }

    public static function showArray($arr) {
        echo '<pre>';
        print_r($arr);
        echo '</pre>';
    }
}