<?php

class ProductController extends BaseController {
    private $ProductModel;
    private $CategoriesModel;
    private $BrandModel;

    public function __construct()
    {
        $this->ProductModel    = $this->model("ProductModel");
        $this->CategoriesModel = $this->model("CategoriesModel");
        $this->BrandModel      = $this->model("BrandModel");
    }

    public function index() {
            $dataURL_set = [
                "strSearch"  => ["default" => null],
                "orderField" => ["default" => "prod_name"],
                "orderBy"    => ["config"  => ["asc", "desc"], "default" => "desc"],
                "status"     => ["config"  => ["all", "on", "off"], "default" => "all"],
                "page"       => ["default"  => 1]
            ];
    
            $dataURL = Format::formatDataUrl($dataURL_set);
    
            $numPerPage = 3;
    
            if (!empty($dataURL['strSearch']['data'])) {
                $listProd      = $this->ProductModel->getlistProdBySearchAndOrderAndStatusAndPagination($dataURL['strSearch']['data'], $dataURL['status']['data'], $dataURL['orderField']['data'], $dataURL['orderBy']['data']);
                $dataPagination = Format::FormatDataPagination($listProd, $dataURL['page']['data'], $numPerPage);
                $listProd      = $this->ProductModel->getlistProdBySearchAndOrderAndStatusAndPagination($dataURL['strSearch']['data'], $dataURL['status']['data'], $dataURL['orderField']['data'], $dataURL['orderBy']['data'], $dataPagination['pageStart'], $numPerPage);
            } else {
                $listProd      = $this->ProductModel->getlistProdByStatusAndOrderAndPagination($dataURL['status']['data'], $dataURL['orderField']['data'], $dataURL['orderBy']['data']);
                $dataPagination = Format::FormatDataPagination($listProd, $dataURL['page']['data'], $numPerPage);
                $listProd      = $this->ProductModel->getlistProdByStatusAndOrderAndPagination($dataURL['status']['data'], $dataURL['orderField']['data'], $dataURL['orderBy']['data'], $dataPagination['pageStart'], $numPerPage);
            }

        $this->view("Frontend.Products.index", [
            "listProd"  => !empty($listProd)   ? $listProd :null,
            "dataURL"   => !empty($dataURL)   ? $dataURL   : null,
            "totalPage" => !empty($dataPagination['numTotalPage']) ? $dataPagination['numTotalPage'] : 0
        ]);
    }

    public function add() {
        if(isset($_POST['addProduct_action'])) {
            $error = [];
            global $error;

            /**
             * check status
             */
            $prod_is_status = !empty($_POST['prod_is_status']) ? "on" : "off";

            /**
             * check name
             */
            if (!empty($_POST['prod_name'])) {
                $prod_name = $_POST['prod_name'];
            } else {
                $error['prod_name'] = "<span class='error'>(*) Vui lòng nhập tên sản phẩm</span>";
            }

            /**
             * Check short desc
             */
            if (!empty($_POST['prod_short_desc'])) {
                $prod_short_desc = $_POST['prod_short_desc'];
            } else {
                $error['prod_short_desc'] = "<span class='error'>(*) Vui lòng nhập mô tả ngắn sản phẩm</span>";
            }

            /**
             * check content main desc
             */
            if (!empty($_POST['prod_content_main_desc'])) {
                $prod_content_main_desc = $_POST['prod_content_main_desc'];
            } else {
                $error['prod_content_main_desc'] = "<span class='error'>(*) Vui lòng nhập mô tả chi tiết sản phẩm</span>";
            }

            /**
             * check meta title
             */
            if (!empty($_POST['prod_meta_title'])) {
                $prod_meta_title = $_POST['prod_meta_title'];
            } else {
                $error['prod_meta_title'] = "<span class='error'>(*) Vui lòng nhập tiêu đề sản phẩm</span>";
            }
            
            /**
             * check meta desc
             */
            if (!empty($_POST['prod_meta_desc'])) {
                $prod_meta_desc = $_POST['prod_meta_desc'];
            } else {
                $error['prod_meta_desc'] = "<span class='error'>(*) Vui lòng nhập đường dẫn mô tả sản phẩm</span>";
            }
                       
            /**
             * check keywork
             */
            $prod_meta_keywords = !empty($_POST['prod_meta_keywords']) ? $_POST['prod_meta_keywords'] : null;
            
            /**
             * check meta url
             */
            if (!empty($_POST['prod_meta_seourl'])) {
                $prod_meta_seourl = $_POST['prod_meta_seourl'];
            } else {
                $error['prod_meta_seourl'] = "<span class='error'>(*) Vui lòng nhập đường dẫn seo tả sản phẩm</span>";
            }

            /**
             * check avatar
             */
            if (!empty($_POST['prod_avatar'])) {
                $prod_avatar = $_POST['prod_avatar'];
            } else {
                $error['prod_avatar'] = "<span class='error'>(*) Vui lòng thêm hình sản phẩm</span>";
            }
            
            /**
             * check current price
             */
            if (!empty($_POST['prod_price_current'])) {
                $prod_price_current = $_POST['prod_price_current'];
            } else {
                $error['prod_price_current'] = "<span class='error'>(*) Vui lòng nhập giá bán hiện tại </span>";
            }
                                   
            /**
             * check old price
             */
            $prod_price_old = !empty($_POST['prod_price_old']) ? $_POST['prod_price_old'] : null;
            
            /**
             * check prod code
             */
            if (!empty($_POST['prod_code'])) {
                $prod_code = $_POST['prod_code'];
            } else {
                $error['prod_code'] = "<span class='error'>(*) Vui lòng nhập mã sản phẩm </span>";
            }

            /**
             * check prod amount
             */
            if (!empty($_POST['prod_amount'])) {
                $prod_amount = $_POST['prod_amount'];
            } else {
                $error['prod_amount'] = "<span class='error'>(*) Vui lòng nhập số lượng </span>";
            }
            /**
             * check status stock
             */
            $prod_status_stock = !empty($_POST['prod_status_stock']) ? $_POST['prod_status_stock'] : "1";

            /**
             * check old installment
             */
            $prod_is_installment = !empty($_POST['prod_is_installment']) ? $_POST['prod_is_installment'][0] : "0";
            $_POST['prod_is_installment'] = $prod_is_installment;
            
            /**
             * check multi cate
             */
            // prod_cateprod[] => ( $_POST['prod_cateprod'] = [cate1,cate2,cate3] ) => json => database
             $prod_cateprod = !empty($_POST['prod_cateprod']) ? $_POST['prod_cateprod'] : [];
             $prod_cateprodJson = json_encode($prod_cateprod);

            if (empty($error)) {
                if (!$this->ProductModel->checkProdExists($prod_name)) {
                    $dataProd = [
                        "prod_is_status"           => $prod_is_status,
                        "prod_name"                => $prod_name,
                        "prod_short_desc"          => $prod_short_desc,
                        "prod_content_main_desc"   => $prod_content_main_desc,
                        "prod_meta_title"          => $prod_meta_title,
                        "prod_meta_desc"           => $prod_meta_desc,
                        "prod_meta_keywords"       => $prod_meta_keywords,
                        "prod_meta_seourl"         => $prod_meta_seourl,
                        "prod_avatar"              => $prod_avatar,
                        "prod_price_current"       => $prod_price_current,
                        "prod_code"                => $prod_code,
                        "prod_amount"              => $prod_amount,
                        "prod_status_stock"        => $prod_status_stock,
                        "prod_is_installment"      => $prod_is_installment,
                        "prod_create_date"         => time(),
                        "prod_creator_id"          => "1",
                        "prod_cateprod_id_ties"    => $prod_cateprodJson 
                    ];
                    $prod_id = $this->ProductModel->addProdNew($dataProd);
                    if (is_int($prod_id)) {
                        $dataStatusProd = [
                            "status" => "success",
                            "notify" => "Thêm dữ liệu thành công"
                        ];
                    } else {
                        $dataStatusProd = [
                            "status" => "error",
                            "notify" => "Thêm dữ liệu không thành công"
                        ];
                    }
                } else {
                    $dataStatusProd = [
                        "status" => "error",
                        "notify" => "sản phẩm đã tồn tại"
                    ];
                }
            } else {
                $dataStatusProd = [
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
        $listBrand = $this->BrandModel->getAllBrand();

        $this->view("Frontend.Products.add", [
            "dataStatusProd" => !empty($dataStatusProd) ? $dataStatusProd : null,
            "listMultiCate" => !empty($listMultiCate) ? $listMultiCate : null,
            "listBrand"      => !empty($listBrand)      ? $listBrand      : null,
        ]);
    }

    public function update() {
        $prod_id   = !empty($_GET['id']) ? (int)$_GET['id'] : 0;
        $ProdItem = $this->ProductModel->getProdItemId($prod_id);
        if(isset($_POST['updateProduct_action'])) {
            $error = [];
            global $error;

            /**
             * check status
             */
            $prod_is_status = !empty($_POST['prod_is_status']) ? "on" : "off";
            $_POST['prod_is_status'] = $prod_is_status;

            /**
             * check name
             */
            if (!empty($_POST['prod_name'])) {
                $prod_name = $_POST['prod_name'];
            } else {
                $error['prod_name'] = "<span class='error'>(*) Vui lòng nhập tên sản phẩm</span>";
            }

            /**
             * Check short desc
             */
            if (!empty($_POST['prod_short_desc'])) {
                $prod_short_desc = $_POST['prod_short_desc'];
            } else {
                $error['prod_short_desc'] = "<span class='error'>(*) Vui lòng nhập mô tả ngắn sản phẩm</span>";
            }

            /**
             * check content main desc
             */
            if (!empty($_POST['prod_content_main_desc'])) {
                $prod_content_main_desc = $_POST['prod_content_main_desc'];
            } else {
                $error['prod_content_main_desc'] = "<span class='error'>(*) Vui lòng nhập mô tả chi tiết sản phẩm</span>";
            }

            /**
             * check meta title
             */
            if (!empty($_POST['prod_meta_title'])) {
                $prod_meta_title = $_POST['prod_meta_title'];
            } else {
                $error['prod_meta_title'] = "<span class='error'>(*) Vui lòng nhập tiêu đề sản phẩm</span>";
            }
            
            /**
             * check meta desc
             */
            if (!empty($_POST['prod_meta_desc'])) {
                $prod_meta_desc = $_POST['prod_meta_desc'];
            } else {
                $error['prod_meta_desc'] = "<span class='error'>(*) Vui lòng nhập đường dẫn mô tả sản phẩm</span>";
            }
                       
            /**
             * check keywork
             */
            $prod_meta_keywords = !empty($_POST['prod_meta_keywords']) ? $_POST['prod_meta_keywords'] : null;
            
            /**
             * check meta url
             */
            if (!empty($_POST['prod_meta_seourl'])) {
                $prod_meta_seourl = $_POST['prod_meta_seourl'];
            } else {
                $error['prod_meta_seourl'] = "<span class='error'>(*) Vui lòng nhập đường dẫn seo tả sản phẩm</span>";
            }

            /**
             * check avatar
             */
            if (!empty($_POST['prod_avatar'])) {
                $prod_avatar = $_POST['prod_avatar'];
            } else {
                $error['prod_avatar'] = "<span class='error'>(*) Vui lòng thêm hình sản phẩm</span>";
            }
            
            /**
             * check current price
             */
            if (!empty($_POST['prod_price_current'])) {
                $prod_price_current = $_POST['prod_price_current'];
            } else {
                $error['prod_price_current'] = "<span class='error'>(*) Vui lòng nhập giá bán hiện tại </span>";
            }
                                   
            /**
             * check old price
             */
            $prod_price_old = !empty($_POST['prod_price_old']) ? $_POST['prod_price_old'] : null;
            
            /**
             * check prod code
             */
            if (!empty($_POST['prod_code'])) {
                $prod_code = $_POST['prod_code'];
            } else {
                $error['prod_code'] = "<span class='error'>(*) Vui lòng nhập mã sản phẩm </span>";
            }

            /**
             * check prod amount
             */
            if (!empty($_POST['prod_amount'])) {
                $prod_amount = $_POST['prod_amount'];
            } else {
                $error['prod_amount'] = "<span class='error'>(*) Vui lòng nhập số lượng </span>";
            }
            /**
             * check status stock
             */
            $prod_status_stock = !empty($_POST['prod_status_stock']) ? $_POST['prod_status_stock'] : "1";

            /**
             * check old installment
             */
            $prod_is_installment = !empty($_POST['prod_is_installment']) ? $_POST['prod_is_installment'][0] : "0";
            $_POST['prod_is_installment'] = $prod_is_installment;
            
            if (empty($error)) {
                if (!$this->ProductModel->checkProdExistsNotProdCurrent($prod_name,$prod_id)) {
                    $dataProd = [
                        "prod_is_status"           => $prod_is_status,
                        "prod_name"                => $prod_name,
                        "prod_short_desc"          => $prod_short_desc,
                        "prod_content_main_desc"   => $prod_content_main_desc,
                        "prod_meta_title"          => $prod_meta_title,
                        "prod_meta_desc"           => $prod_meta_desc,
                        "prod_meta_keywords"       => $prod_meta_keywords,
                        "prod_meta_seourl"         => $prod_meta_seourl,
                        "prod_avatar"              => $prod_avatar,
                        "prod_price_current"       => $prod_price_current,
                        "prod_price_old"           => $prod_price_old,
                        "prod_code"                => $prod_code,
                        "prod_amount"              => $prod_amount,
                        "prod_status_stock"        => $prod_status_stock,
                        "prod_is_installment"      => $prod_is_installment,
                        "prod_create_date"         => time(),
                        "prod_creator_id"          => "1",
                    ];
                    if ($this->ProductModel->updateProd($dataProd, $prod_id)) {
                        $dataStatusProd  = [
                            "status" => "success",
                            "notify" => "Cập nhật danh mục thành công"
                        ];
                    } else {
                        $dataStatusProd  = [
                            "status" => "error",
                            "notify" => "Cập nhật danh mục không thành công"
                        ];
                    }
                } else {
                    $dataStatusProd  = [
                        "status" => "error",
                        "notify" => "danh mục đã tồn tại"
                    ];
                }
            } else {
                $dataStatusProd  = [

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
        $listBrand = $this->BrandModel->getAllBrand();

        $this->view("Frontend.Products.update",[
            "dataStatusProd" => !empty($dataStatusProd) ? $dataStatusProd : null,
            "listMultiCate" => !empty($listMultiCate) ? $listMultiCate : null,
            "listBrand"      => !empty($listBrand)      ? $listBrand      : null,
            "ProdItem"    => !empty($ProdItem)       ? $ProdItem       : null,
        ]);
    }
    public function uploadProdAvatar()
    {
        if ($_SERVER['REQUEST_METHOD']) {
            $targetDir  = "public/uploads/Prod/";
            if (!file_exists($targetDir)) {
                mkdir($targetDir);
            }
            $fileName   = pathinfo($_FILES['prod_avatar']['name'], PATHINFO_FILENAME);
            $fileExtend = strtolower(pathinfo($_FILES['prod_avatar']['name'], PATHINFO_EXTENSION));
            $targetFile = $targetDir . md5(time() . $fileName) . "." . $fileExtend;
            if (move_uploaded_file($_FILES['prod_avatar']['tmp_name'], $targetFile)) {
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
        $prod_id        = (int) $_POST['prod_id'];
        $prod_is_status = $_POST['prod_is_status'];
        $dataProd = [
            "prod_is_status" => $prod_is_status
        ];
        if( $this->ProductModel->updateProd($dataProd, $prod_id) ) {
            echo json_encode( ["status" => true] );
        } else {
            echo json_encode( ["status" => false] );
        }
    }

    public function deleteItem() {
        $prod_id = (int) $_POST['prod_id'];
        $prodItem = $this->ProductModel->getProdItemId($prod_id);
        $process = $this->ProductModel->deleteProdItemById($prod_id);
        if($process) {
            if(file_exists($prodItem['prod_avatar'])) {
                unlink($prodItem['prod_avatar']);
            }
            echo json_encode([ "status" => true ]);
        } else {
            echo json_encode([ "status" => false ]);
        }
    }

    public function deleteMulti()
    {
        $list_id_prod = $_POST['list_id_prod'];
        $statusIdUpdateError = [];
        foreach($list_id_prod as $prod_id) {
            $prodItem = $this->ProductModel->getProdItemId($prod_id);
            $process   = $this->ProductModel->deleteProdItemById($prod_id);
            if(!$process) {
                $statusIdUpdateError[] = $prod_id;
            } else {
                if(file_exists($prodItem['prod_avatar'])) {
                    unlink($prodItem['prod_avatar']);
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
        $list_id_prod       = $_POST['list_id_prod'];
        $prod_is_status     = $_POST['prod_is_status'];
        $statusIdUpdateError = [];
        $dataProd = [
            "prod_is_status" => $prod_is_status
        ];
        foreach($list_id_prod as $prod_id) {
            $process = $this->ProductModel->updateProd($dataProd, $prod_id);
            if(!$process) {
                $statusIdUpdateError[] = $prod_id;
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

}