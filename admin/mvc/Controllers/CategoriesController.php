<?php

class CategoriesController extends BaseController
{

    private $CategoriesModel;

    public function __construct()
    {
        $this->CategoriesModel = $this->model("CategoriesModel");
    }

    public function index()
    {
        $dataURL_set = [
            "strSearch"  => ["default" => null],
            "orderField" => ["default" => "cateprod_name"],
            "orderBy"    => ["config"  => ["asc", "desc"], "default" => "desc"],
            "status"     => ["config"  => ["all", "on", "off"], "default" => "all"],
            "page"       => ["default"  => 1]
        ];

        $dataURL = Format::formatDataUrl($dataURL_set);

        $numPerPage = 20;

        if (!empty($dataURL['strSearch']['data'])) {
            $listCateProd      = $this->CategoriesModel->getlistCateProdBySearchAndOrderAndStatusAndPagination($dataURL['strSearch']['data'], $dataURL['status']['data'], $dataURL['orderField']['data'], $dataURL['orderBy']['data']);
            $dataPagination = Format::FormatDataPagination($listCateProd, $dataURL['page']['data'], $numPerPage);
            $listCateProd      = $this->CategoriesModel->getlistCateProdBySearchAndOrderAndStatusAndPagination($dataURL['strSearch']['data'], $dataURL['status']['data'], $dataURL['orderField']['data'], $dataURL['orderBy']['data'], $dataPagination['pageStart'], $numPerPage);
        } else {
            $listCateProd      = $this->CategoriesModel->getlistCateProdByStatusAndOrderAndPagination($dataURL['status']['data'], $dataURL['orderField']['data'], $dataURL['orderBy']['data']);
            $dataPagination = Format::FormatDataPagination($listCateProd, $dataURL['page']['data'], $numPerPage);
            $listCateProd      = $this->CategoriesModel->getlistCateProdByStatusAndOrderAndPagination($dataURL['status']['data'], $dataURL['orderField']['data'], $dataURL['orderBy']['data'], $dataPagination['pageStart'], $numPerPage);
        }
        $listCateProdWithParentName = [];
        foreach($listCateProd as $cate){
            $cate['parent_name'] =$this->CategoriesModel->getProdCateParentNameById($cate['cateprod_parent_id']);
            $listCateProdWithParentName[] = $cate;
        }

        $this->view("Frontend.Categories.index", [
            "listCateProd" => !empty($listCateProdWithParentName) ? $listCateProdWithParentName : null,
            "dataURL"   => !empty($dataURL)   ? $dataURL   : null,
            "totalPage" => !empty($dataPagination['numTotalPage']) ? $dataPagination['numTotalPage'] : 0
        ]);
    }
    public function add()
    {
        if (isset($_POST['addCateProd_action'])) {
            $error = [];
            global $error;
            /**
             * check cate status
             */
            $cateprod_is_status = !empty($_POST['cateprod_is_status']) ? "on" : "off";
            /**
             * check cate name
             */
            if (!empty($_POST['cateprod_name'])) {
                $cateprod_name = $_POST['cateprod_name'];
            } else {
                $error['cateprod_name'] = "<span class='error'>(*) Vui lòng nhập tên danh mục</span>";
            }
            
            /**
             * check CateProd meta keywords
             */
            $cateprod_meta_keywords = !empty($_POST['cateprod_meta_keywords']) ? $_POST['cateprod_meta_keywords'] : null;

            /**
             * check cate title
             */
            if (!empty($_POST['cateprod_meta_title'])) {
                $cateprod_meta_title = $_POST['cateprod_meta_title'];
            } else {
                $error['cateprod_meta_title'] = "<span class='error'>(*) Vui lòng nhập tiêu đề danh mục</span>";
            }

            /**
             * check cate desc
             */
            if (!empty($_POST['cateprod_meta_desc'])) {
                $cateprod_meta_desc = $_POST['cateprod_meta_desc'];
            } else {
                $error['cateprod_meta_desc'] = "<span class='error'>(*) Vui lòng nhập miêu tả danh mục</span>";
            }

            /**
             * check cate url
             */
            if (!empty($_POST['cateprod_meta_url'])) {
                $cateprod_meta_url = $_POST['cateprod_meta_url'];
            } else {
                $error['cateprod_meta_url'] = "<span class='error'>(*) Vui lòng nhập đường dẫn seo của danh mục</span>";
            }

            /**
             * check parent id
             */
            $cateprod_parent_id = !empty($_POST['cateprod_parent_id']) ? $_POST['cateprod_parent_id'] : 0;

            /**
             * check Cate icon
             */
            if (empty($_POST['cateprod_icon'])) {
                $error['cateprod_icon'] = "<span class='error'>(*) Vui lòng chọn icon của danh mục</span>";
            } else {
                $cateprod_icon = $_POST['cateprod_icon'];
            }
            
            /**
             * check CateProd banner PC
             */
            if (empty($_POST['cateprod_banner_pc'])) {
                $error['cateprod_banner_pc'] = "<span class='error'>(*) Vui lòng chọn banner mobie của danh mục</span>";
            } else {
                $cateprod_banner_pc = $_POST['cateprod_banner_pc'];
            }

            if (empty($error)) {
                if (!$this->CategoriesModel->checkCateExists($cateprod_name)) {
                    $dataCateProd = [
                        "cateprod_name"          => $cateprod_name,
                        "cateprod_icon"          => $cateprod_icon,
                        "cateprod_banner_pc"     => $cateprod_banner_pc,
                        "cateprod_meta_title"    => $cateprod_meta_title,
                        "cateprod_meta_desc"     => $cateprod_meta_desc,
                        "cateprod_meta_url"      => $cateprod_meta_url,
                        "cateprod_meta_keywords" => $cateprod_meta_keywords,
                        "cateprod_parent_id"     => $cateprod_parent_id,
                        "cateprod_create_date"   => time(),
                        "cateprod_creator_id"    => "1",
                        "cateprod_is_status"     => $cateprod_is_status
                    ];
                    $cateprod_id = $this->CategoriesModel->addCateNew($dataCateProd);
                    if (is_int($cateprod_id)) {
                        $dataStatusCate = [
                            "status" => "success",
                            "notify" => "Thêm dữ liệu thành công"
                        ];
                    } else {
                        $dataStatusCate = [
                            "status" => "error",
                            "notify" => "Thêm dữ liệu không thành công"
                        ];
                    }
                } else {
                    $dataStatusCate = [
                        "status" => "error",
                        "notify" => "danh mục đã tồn tại"
                    ];
                }
            } else {
                $dataStatusCate = [
                    "status" => "error",
                    "notify" => "Một số dữ liệu bạn chưa hoàn thành hoặc dữ liệu không hợp lệ"
                ];
            }
        }
        /**
         *  parent cate
         */
        $listCateAll = $this->CategoriesModel->handleGetCateAll();
        $listMultiCate = $this->CategoriesModel->handleGetMultiLevelCateProd($listCateAll, 0, 0);


        $this->view("Frontend.Categories.add", [
            "dataStatusCate" => !empty($dataStatusCate) ? $dataStatusCate : null,
            "listMultiCate" => !empty($listMultiCate) ? $listMultiCate : null

        ]);
    }
    public function update()
    {
        $cateprod_id   = !empty($_GET['id']) ? (int)$_GET['id'] : 0;
        $CateProdItem = $this->CategoriesModel->getCateProdItemId($cateprod_id);
        if (isset($_POST['updateCateProd_action'])) {
            $error = [];
            global $error;
            /**
             * check cate status
             */
            $cateprod_is_status = !empty($_POST['cateprod_is_status']) ? "on" : "off";
            $_POST['cateprod_is_status'] = $cateprod_is_status;
            /**
             * check cate name
             */
            if (!empty($_POST['cateprod_name'])) {
                $cateprod_name = $_POST['cateprod_name'];
            } else {
                $error['cateprod_name'] = "<span class='error'>(*) Vui lòng nhập tên danh mục</span>";
            }

            /**
             * check CateProd meta keywords
             */
            $cateprod_meta_keywords = !empty($_POST['cateprod_meta_keywords']) ? $_POST['cateprod_meta_keywords'] : null;

            /**
             * check cate title
             */
            if (!empty($_POST['cateprod_meta_title'])) {
                $cateprod_meta_title = $_POST['cateprod_meta_title'];
            } else {
                $error['cateprod_meta_title'] = "<span class='error'>(*) Vui lòng nhập tiêu đề danh mục</span>";
            }

            /**
             * check cate desc
             */
            if (!empty($_POST['cateprod_meta_desc'])) {
                $cateprod_meta_desc = $_POST['cateprod_meta_desc'];
            } else {
                $error['cateprod_meta_desc'] = "<span class='error'>(*) Vui lòng nhập miêu tả danh mục</span>";
            }

            /**
             * check cate title
             */
            if (!empty($_POST['cateprod_meta_url'])) {
                $cateprod_meta_url = $_POST['cateprod_meta_url'];
            } else {
                $error['cateprod_meta_url'] = "<span class='error'>(*) Vui lòng nhập đường dẫn seo của danh mục</span>";
            }
            
            /**
             * check parent id
             */
            $cateprod_parent_id = !empty($_POST['cateprod_parent_id']) ? $_POST['cateprod_parent_id'] : 0;
            $_POST['cateprod_parent_id'] =  !empty($cateprod_parent_id) ? $cateprod_parent_id : "no_select" ;

            /**
             * check Cate icon
             */
            if (empty($_POST['cateprod_icon'])) {
                $error['cateprod_icon'] = "<span class='error'>(*) Vui lòng chọn icon của danh mục</span>";
            } else {
                $cateprod_icon = $_POST['cateprod_icon'];
            }
            
            /**
             * check CateProd banner PC
             */
            if (empty($_POST['cateprod_banner_pc'])) {
                $error['cateprod_banner_pc'] = "<span class='error'>(*) Vui lòng chọn banner mobie của danh mục</span>";
            } else {
                $cateprod_banner_pc = $_POST['cateprod_banner_pc'];
            }
            if (empty($error)) {
                if (!$this->CategoriesModel->checkCateProdExistsNotCateProdCurrent($cateprod_name, $cateprod_id)) {
                    $dataCateProd = [
                        "cateprod_name"          => $cateprod_name,
                        "cateprod_icon"          => $cateprod_icon,
                        "cateprod_banner_pc"     => $cateprod_banner_pc,
                        "cateprod_meta_title"    => $cateprod_meta_title,
                        "cateprod_meta_desc"     => $cateprod_meta_desc,
                        "cateprod_parent_id"     => $cateprod_parent_id,
                        "cateprod_meta_url"      => $cateprod_meta_url,
                        "cateprod_meta_keywords" => $cateprod_meta_keywords,
                        "cateprod_update_date"   => time(),
                        "cateprod_is_status"     => $cateprod_is_status
                    ];
                    if ($this->CategoriesModel->updateCateProd($dataCateProd, $cateprod_id)) {
                        $dataStatusCate  = [
                            "status" => "success",
                            "notify" => "Cập nhật danh mục thành công"
                        ];
                    } else {
                        $dataStatusCate  = [
                            "status" => "error",
                            "notify" => "Cập nhật danh mục không thành công"
                        ];
                    }
                } else {
                    $dataStatusCate  = [
                        "status" => "error",
                        "notify" => "danh mục đã tồn tại"
                    ];
                }
            } else {
                $dataStatusCate  = [

                    "status" => "error",
                    "notify" => "Một số dữ liệu bạn chưa hoàn thành hoặc dữ liệu không hợp lệ"
                ];
            }
        }
        
        $listCateAll = $this->CategoriesModel->handleGetCateAll();
        $listMultiCate = $this->CategoriesModel->handleGetMultiLevelCateProd($listCateAll, 0, 0);
        $this->view("Frontend.Categories.update", [
            "listMultiCate" => !empty($listMultiCate) ? $listMultiCate : null,
            "CateProdItem"    => !empty($CateProdItem)       ? $CateProdItem       : null,
            "dataStatusCate" => !empty($dataStatusCate)    ? $dataStatusCate     : null,
        ]);

    }

    public function uploadCateProdBannerPC()
    {
        if ($_SERVER['REQUEST_METHOD']) {
            $targetDir  = "public/uploads/CateProd/";
            if (!file_exists($targetDir)) {
                mkdir($targetDir);
            }
            $fileName   = pathinfo($_FILES['cateprod_banner_pc']['name'], PATHINFO_FILENAME);
            $fileExtend = strtolower(pathinfo($_FILES['cateprod_banner_pc']['name'], PATHINFO_EXTENSION));
            $targetFile = $targetDir . md5(time() . $fileName) . "." . $fileExtend;
            if (move_uploaded_file($_FILES['cateprod_banner_pc']['tmp_name'], $targetFile)) {
                echo json_encode([
                    "status"     => "success",
                    "targetFile" => $targetFile
                ]);
            } else {
                echo json_encode(["status" => "error"]);
            }
        }
    }
    public function uploadCateProdBannerIcon()
    {
        if ($_SERVER['REQUEST_METHOD']) {
            $targetDir  = "public/uploads/CateProd/";
            if (!file_exists($targetDir)) {
                mkdir($targetDir);
            }
            $fileName   = pathinfo($_FILES['cateprod_icon']['name'], PATHINFO_FILENAME);
            $fileExtend = strtolower(pathinfo($_FILES['cateprod_icon']['name'], PATHINFO_EXTENSION));
            $targetFile = $targetDir . md5(time() . $fileName) . "." . $fileExtend;
            if (move_uploaded_file($_FILES['cateprod_icon']['tmp_name'], $targetFile)) {
                echo json_encode([
                    "status"     => "success",
                    "targetFile" => $targetFile
                ]);
            } else {
                echo json_encode(["status" => "error"]);
            }
        }
    }
    public function changeStatusItem()
    {
        $cateprod_id        = (int) $_POST['cateprod_id'];
        $cateprod_is_status = $_POST['cateprod_is_status'];
        $dataCateProd = [
            "cateprod_is_status" => $cateprod_is_status
        ];
        if ($this->CategoriesModel->updateCateProd($dataCateProd, $cateprod_id)) {
            echo json_encode(["status" => true]);
        } else {
            echo json_encode(["status" => false]);
        }
    }

    public function deleteItem()
    {
        $cateprod_id = (int) $_POST['cateprod_id'];
        $cateProdItem = $this->CategoriesModel->getcateProdItemId($cateprod_id);
        $process = $this->CategoriesModel->deleteCateProdItemById($cateprod_id);
        if ($process) {
            if (file_exists($cateProdItem['cateprod_banner_pc'])) {
                unlink($cateProdItem['cateprod_banner_pc']);
            }
            echo json_encode(["status" => true]);
        } else {
            echo json_encode(["status" => false]);
        }
    }
    
    public function deleteMulti()
    {
        $list_id_cateprod = $_POST['list_id_cateprod'];
        $statusIdUpdateError = [];
        foreach($list_id_cateprod as $cateprod_id) {
            $cateProdItem = $this->CategoriesModel ->getCateProdItemId($cateprod_id);
            $process   = $this->CategoriesModel ->deleteCateProdItemById($cateprod_id);
            if(!$process) {
                $statusIdUpdateError[] = $cateprod_id;
            } else {
                if(file_exists($cateProdItem['cateprod_icon'])) {
                    unlink($cateProdItem['cateprod_icon']);
                }
            }
        }
        if( !empty($statusIdUpdateError) ) {
            echo json_encode([
                "status" => false
            ]);
        } else {
            echo json_encode([
                "status" => true
            ]);
        }
    }

    public function changeStatusMulti()
    {
        $list_id_cateprod       = $_POST['list_id_cateprod'];
        $cateprod_is_status     = $_POST['cateprod_is_status'];
        $statusIdUpdateError = [];
        $dataCateProd = [
            "cateprod_is_status" => $cateprod_is_status
        ];
        foreach($list_id_cateprod as $cateprod_id) {
            $process = $this->CategoriesModel ->updateCateProd($dataCateProd, $cateprod_id);
            if(!$process) {
                $statusIdUpdateError[] = $cateprod_id;
            }
        }
        if( !empty($statusIdUpdateError) ) {
            echo json_encode([
                "status" => false
            ]);
        } else {
            echo json_encode([
                "status" => true
            ]);
        }
    }

    public function handleGetFieldCateProdBySearchCateProdName()
    {
        $strSearch   = Format::validationSearch($_POST['strSearch']);
        $fieldSearch = $_POST['fieldSearch'];
        echo json_encode([
            "searchResponsive" => $this->CategoriesModel->getCateProdFieldBySearchName($strSearch, $fieldSearch)
        ]);
    }

}
