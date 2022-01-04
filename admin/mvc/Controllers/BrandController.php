<?php

class BrandController extends BaseController {

    private $BrandModel;

    public function __construct()
    {
        $this->BrandModel = $this->model("BrandModel");
    }

    public function index() {
        $dataURL_set = [
            "strSearch"  => [ "default" => null ],
            "orderField" => [ "default" => "brand_name" ],
            "orderBy"    => [ "config"  => [ "asc", "desc" ], "default" => "desc" ],
            "status"     => [ "config"  => [ "all", "on", "off" ], "default" => "all" ],
            "page"       => ["default"  => 1 ]
        ];

        $dataURL = Format::formatDataUrl( $dataURL_set );

        $numPerPage = 20;

        if( !empty($dataURL['strSearch']['data']) )
        {
            $listBrand      = $this->BrandModel->getListBrandBySearchAndOrderAndStatusAndPagination($dataURL['strSearch']['data'], $dataURL['status']['data'], $dataURL['orderField']['data'], $dataURL['orderBy']['data']);
            $dataPagination = Format::FormatDataPagination( $listBrand, $dataURL['page']['data'], $numPerPage );
            $listBrand      = $this->BrandModel->getListBrandBySearchAndOrderAndStatusAndPagination($dataURL['strSearch']['data'], $dataURL['status']['data'], $dataURL['orderField']['data'], $dataURL['orderBy']['data'], $dataPagination['pageStart'], $numPerPage);
        } else {
            $listBrand      = $this->BrandModel->getListBrandByStatusAndOrderAndPagination($dataURL['status']['data'], $dataURL['orderField']['data'], $dataURL['orderBy']['data']);
            $dataPagination = Format::FormatDataPagination( $listBrand, $dataURL['page']['data'], $numPerPage );
            $listBrand      = $this->BrandModel->getListBrandByStatusAndOrderAndPagination($dataURL['status']['data'], $dataURL['orderField']['data'], $dataURL['orderBy']['data'], $dataPagination['pageStart'], $numPerPage);
        }

        $this->view("Frontend.Brands.index", [
            "listBrand" => !empty($listBrand) ? $listBrand : null,
            "dataURL"   => !empty($dataURL)   ? $dataURL   : null,
            "totalPage" => !empty($dataPagination['numTotalPage']) ? $dataPagination['numTotalPage'] : 0
        ]);
    }

    public function add(){

        if( isset( $_POST['addBrand_action'] ) ) {
            $error = [];
            global $error;

            /**
             * -- check status
             */
            $brand_is_status = !empty($_POST['brand_is_status']) ? "on" : "off";

            /**
             * -- check brand name
             */
            if( empty($_POST['brand_name']) ) {
                $error['brand_name'] = "<span class='error'>(*) Vui lòng nhập tên thương hiệu</span>";
            } else {
                $brand_name = $_POST['brand_name'];
            }

            /**
             * -- check brand logo
             */
            if( empty($_POST['brand_logo']) ) {
                $error['brand_logo'] = "<span class='error'>(*) Vui lòng chọn logo thương hiệu</span>";
            } else {
                $brand_logo = $_POST['brand_logo'];
            }

            /**
             * check order
             */
            $brand_order = !empty($_POST['brand_order']) ? (int)$_POST['brand_order'] : $this->BrandModel->getOrderMax()+1;

            /**
             * check brand metal title
             */
            $brand_meta_keywords = !empty($_POST['brand_meta_keywords']) ? $_POST['brand_meta_keywords'] : null;

            if (!empty($_POST['brand_meta_title'])) {
                $brand_meta_title = $_POST['brand_meta_title'];
            }
            else {
                $error['brand_meta_title'] = "<span class='error'>(*) Vui lòng nhập tiêu đề thương hiệu</span>";
            }

            if(!empty($_POST['brand_meta_desc'])) {
                $brand_meta_desc = $_POST['brand_meta_desc'];
            }
            else {
                $error['brand_meta_desc'] = "<span class='error'>(*) Vui lòng nhập mô tả thương hiệu</span>";
            }

            if(!empty($_POST['brand_meta_url'])) {
                $brand_meta_url = $_POST['brand_meta_url'];
            }
            else {
                $error['brand_meta_url'] = "<span class='error'>(*) Vui lòng nhập đường dẫn seo </span>";
            }
            if( empty($error) ) {
                // Kiễm tra sự tồn tại của tất cả các thương hiệu
                if( !$this->BrandModel->checkBrandExists($brand_name) ) {
                    $dataBrand = [
                        "brand_name"          => $brand_name,
                        "brand_logo"          => $brand_logo,
                        "brand_order"         => $brand_order,
                        "brand_meta_title"    => $brand_meta_title,
                        "brand_meta_desc"     => $brand_meta_desc,
                        "brand_meta_url"      => $brand_meta_url,
                        "brand_meta_keywords" => $brand_meta_keywords,
                        "brand_create_date"   => time(),
                        "brand_creator_id"    => "1",
                        "brand_is_status"     => $brand_is_status
                    ];
                    $brand_id = $this->BrandModel->addBrandNew($dataBrand);
                    if( is_int($brand_id) ) {
                        $dataStatusBrand = [
                            "status" => "success",
                            "notify" => "Thêm dữ liệu thành công"
                        ];
                    } else {
                        $dataStatusBrand = [
                            "status" => "error",
                            "notify" => "Thêm dữ liệu không thành công"
                        ];
                    }
                } else {
                    $dataStatusBrand = [
                        "status" => "error",
                        "notify" => "Thương hiệu đã tồn tại"
                    ];
                }
            } else {
                $dataStatusBrand = [
                    "status" => "error",
                    "notify" => "Một số dữ liệu bạn chưa hoàn thành hoặc dữ liệu không hợp lệ"
                ];
            }
        }

        $this->view("Frontend.Brands.add", [
            "dataStatusBrand" => !empty($dataStatusBrand) ? $dataStatusBrand : null
        ]);
    }


    public function update(){
        $brand_id  = !empty($_GET['id']) ? (int)$_GET['id'] : 0;
        $brandItem = $this->BrandModel->getBrandItemId($brand_id);
        if( isset($_POST['updateBrand_action']) ) {
            $error = [];
            global $error;

            /**
             * -- check status
             */
            $brand_is_status = !empty($_POST['brand_is_status']) ? "on" : "off";

            /**
             * -- check brand name
             */
            if( empty($_POST['brand_name']) ) {
                $error['brand_name'] = "<span class='error'>(*) Vui lòng nhập tên thương hiệu</span>";
            } else {
                $brand_name = $_POST['brand_name'];
            }

            /**
             * -- check brand logo
             */
            if( empty($_POST['brand_logo']) ) {
                $error['brand_logo'] = "<span class='error'>(*) Vui lòng chọn logo thương hiệu</span>";
            } else {
                $brand_logo = $_POST['brand_logo'];
            }

            /**
             * check order
             */
            $brand_order = !empty($_POST['brand_order']) ? (int)$_POST['brand_order'] : $this->BrandModel->getOrderMax()+1;

            /**
             * check brand metal title
             */
            $brand_meta_keywords = !empty($_POST['brand_meta_keywords']) ? $_POST['brand_meta_keywords'] : null;

            if (!empty($_POST['brand_meta_title'])) {
                $brand_meta_title = $_POST['brand_meta_title'];
            }
            else {
                $error['brand_meta_title'] = "<span class='error'>(*) Vui lòng nhập tiêu đề thương hiệu</span>";
            }

            if(!empty($_POST['brand_meta_desc'])) {
                $brand_meta_desc = $_POST['brand_meta_desc'];
            }
            else {
                $error['brand_meta_desc'] = "<span class='error'>(*) Vui lòng nhập mô tả thương hiệu</span>";
            }

            if(!empty($_POST['brand_meta_url'])) {
                $brand_meta_url = $_POST['brand_meta_url'];
            }
            else {
                $error['brand_meta_url'] = "<span class='error'>(*) Vui lòng nhập đường dẫn seo </span>";
            }

            if(!empty($_POST['brand_logo'])) {
                $brand_logo = $_POST['brand_logo'];
            }
            else {
                $error['brand_logo'] = "<span class='error'>(*) Vui lòng chọn ảnh </span>";
            }

            if( empty($error) ) {
                if( !$this->BrandModel->checkBrandExistsNotBrandCurrent($brand_name, $brand_id) ) {
                    $dataBrand = [
                        "brand_name"          => $brand_name,
                        "brand_logo"          => $brand_logo,
                        "brand_order"         => $brand_order,
                        "brand_meta_title"    => $brand_meta_title,
                        "brand_meta_desc"     => $brand_meta_desc,
                        "brand_meta_url"      => $brand_meta_url,
                        "brand_meta_keywords" => $brand_meta_keywords,
                        "brand_update_date"   => time(),
                        "brand_is_status"     => $brand_is_status
                    ];
                    if( $this->BrandModel->updateBrand( $dataBrand, $brand_id ) ) {
                        $dataStatusBrand = [
                            "status" => "success",
                            "notify" => "Cập nhật thương hiệu thành công"
                        ];
                    } else {
                        $dataStatusBrand = [
                            "status" => "error",
                            "notify" => "Cập nhật thương hiệu không thành công"
                        ];
                    }
                } else {
                    $dataStatusBrand = [
                        "status" => "error",
                        "notify" => "Thương hiệu đã tồn tại"
                    ];
                }
            } else {
                $dataStatusBrand = [
                    "status" => "error",
                    "notify" => "Một số dữ liệu bạn chưa hoàn thành hoặc dữ liệu không hợp lệ"
                ];
            }
        }
        $this->view("Frontend.Brands.update", [
            "brandItem"       => !empty($brandItem)       ? $brandItem       : null,
            "dataStatusBrand" => !empty($dataStatusBrand) ? $dataStatusBrand : null
        ]);
    }

    public function uploadLogoBrand() {
        if( $_SERVER['REQUEST_METHOD'] ) {
            $targetDir  = "public/uploads/brands/";
            if (!file_exists($targetDir) ) {
                mkdir($targetDir);
            }
            $fileName   = pathinfo( $_FILES['brand_logo']['name'], PATHINFO_FILENAME );
            $fileExtend = strtolower(pathinfo( $_FILES['brand_logo']['name'], PATHINFO_EXTENSION ));
            $targetFile = $targetDir . md5( time() . $fileName ) . "." . $fileExtend;
            if(move_uploaded_file($_FILES['brand_logo']['tmp_name'], $targetFile)) {
                echo json_encode([
                    "status"     => "success",
                    "targetFile" => $targetFile
                ]);
            } else {
                echo json_encode(["status" => "error"]);
            }
        }
    }

    public function handleGetMaxOrder() {
        echo json_encode([
            "orderMax" => $this->BrandModel->getOrderMax()
        ]);
    }

    public function changeStatusItem()
    {
        $brand_id        = (int) $_POST['brand_id'];
        $brand_is_status = $_POST['brand_is_status'];
        $dataBrand = [
            "brand_is_status" => $brand_is_status
        ];
        if( $this->BrandModel->updateBrand($dataBrand, $brand_id) ) {
            echo json_encode( ["status" => true] );
        } else {
            echo json_encode( ["status" => false] );
        }
    }

    public function deleteItem() {
        $brand_id = (int) $_POST['brand_id'];
        $brandItem = $this->BrandModel->getBrandItemId($brand_id);
        $process = $this->BrandModel->deleteBrandItemById($brand_id);
        if($process) {
            if(file_exists($brandItem['brand_logo'])) {
                unlink($brandItem['brand_logo']);
            }
            echo json_encode([ "status" => true ]);
        } else {
            echo json_encode([ "status" => false ]);
        }
    }

    public function deleteMulti()
    {
        $list_id_brand = $_POST['list_id_brand'];
        $statusIdUpdateError = [];
        foreach($list_id_brand as $brand_id) {
            $brandItem = $this->BrandModel->getBrandItemId($brand_id);
            $process   = $this->BrandModel->deleteBrandItemById($brand_id);
            if(!$process) {
                $statusIdUpdateError[] = $brand_id;
            } else {
                if(file_exists($brandItem['brand_logo'])) {
                    unlink($brandItem['brand_logo']);
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
        $list_id_brand       = $_POST['list_id_brand'];
        $brand_is_status     = $_POST['brand_is_status'];
        $statusIdUpdateError = [];
        $dataBrand = [
            "brand_is_status" => $brand_is_status
        ];
        foreach($list_id_brand as $brand_id) {
            $process = $this->BrandModel->updateBrand($dataBrand, $brand_id);
            if(!$process) {
                $statusIdUpdateError[] = $brand_id;
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

    public function handleGetFieldBrandBySearchBrandName() {
        $strSearch   = Format::validationSearch($_POST['strSearch']);
        $fieldSearch = $_POST['fieldSearch'];
        echo json_encode([
            "searchResponsive" => $this->BrandModel->getBrandFieldBySearchName( $strSearch, $fieldSearch )
        ]);
    }
}