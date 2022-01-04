<?php

class SearchController extends BaseController
{
    public function handleCustomizeUrl()
    {
        $strSearch = Format::validationSearch($_POST['strSearch']);
        echo json_encode([
            "qSearch" => $strSearch
        ]);
    }
}