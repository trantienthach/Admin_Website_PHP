<?php
class Config
{
    protected $controllerConfig = "Home";
    protected $actionConfig     = "index";

    public static $base_url_admin  = "http://localhost/admin/";
    public static $base_url_client = "http://localhost/";

    public static function getBaseUrlAdmin($url = null)
    {
        return self::$base_url_admin . $url;
    }

    public static function getBaseUrlClient($url = null)
    {
        return self::$base_url_client . $url;
    }

    protected function fileAutoLoadClass()
    {
        return [
            "Format",
            "Database",
            "BaseController",
            "Validation",
            "Session",
            "Cookie",
            "Helper",
            "Auth",
            "Pagination"
        ];
    }

    protected function fileAutoLoadFunc()
    {
        return [
            "BaseView"
        ];
    }

    protected function fileAutoLoadModel()
    {
        return [
        ];
    }

    protected function fileAutoLoadController()
    {
        return [
        ];
    }
}
