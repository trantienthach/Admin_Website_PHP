<?php

class HomeModel extends Database {

    public function notifications() {
        echo "connect home model successful";
    }

    public function getListProducts() {
        return "ListProduct";
    }

    public function getListBanner() {
        return "ListBanner";
    }

}