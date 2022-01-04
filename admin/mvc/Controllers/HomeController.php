<?php

class HomeController extends BaseController {

    // khởi tạo model
    private $HomeModel;

    public function __construct()
    {
        $this->HomeModel = $this->model("HomeModel");
    }

    public function index() {
        $this->view("Frontend.Homes.index", []);
    }

}