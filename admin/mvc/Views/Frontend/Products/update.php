<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/css/config/helper.css" />
    <link rel="stylesheet" href="./public/css/style/layout.css" />
    <link rel="stylesheet" href="./public/css/style/home.css" />
    <!-- Start file manager -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" integrity="sha512-H9jrZiiopUdsLpg94A333EfumgUBpO9MdbxStdeITo+KEIMaNfHNvwyjjDJb+ERPaRS6DpyRlKbvPUasNItRyw==" crossorigin="anonymous" />
    <link rel="stylesheet" href="<?php {{ echo Config::getBaseUrlAdmin("public/css/lib/s-select.min.css");}} ?>">
    <!-- End file manager -->
    <title>Thêm sản phẩm</title>
</head>
<body>
    <div id="dashboardApp" class="showAside position_relative">
        <?php {{ view("Inc.header"); }} ?>
        <?php {{ view("Inc.sidebar"); }} ?>
        <main class="main_content">
            <form method="POST" class="form-action">
                <div class="page_header">
                    <div class="container_fluid d_flex justify_content_between align_items_center">
                        <div class="d_flex align_items_end">
                            <h1>Sản phẩm</h1>
                            <ol class="breadcrumb d_flex align_items_center">
                                <li>
                                    <a href="<?php echo Config::getBaseUrlAdmin(); ?>">Trang chủ</a>
                                </li>
                                <li class="active">
                                    <a href="javascript:;">Cập nhật sản phẩm</a>
                                </li>
                            </ol>
                        </div>
                        <div class="d_flex align_items_center">
                            <button type="submit" name="updateProduct_action" class="btn_item btn_primary">
                                <i class="fa fa-save" aria-hidden="true"></i>
                                <span>Lưu</span>
                            </button>
                            <a class="btn_item btn_default" href="<?php echo Config::getBaseUrlAdmin("?controller=Product"); ?>">
                                <i class="fa fa-reply" aria-hidden="true"></i>
                                <span>Quay lại</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="table_content container_fluid">
                    <div class="panel_table">
                        <div class="panel_heading">
                            <h2 class="panel_title">
                                <i class="fa fa-pencil"></i>
                                <span>Thêm sản phẩm [Bản nháp]</span>
                            </h2>
                        </div>
                        <!-- noti add form -->
                        <?php if(!empty($dataStatusProd) ) : ?>
                        <div class="notification_status_form open">
                            <div class="notification-inner <?php {{ echo $dataStatusProd['status'];}} ?>">
                                <p class="notification_text"><?php {{ echo $dataStatusProd['notify'];}} ?></p>
                                <span class="notification_close">X</span>
                            </div>
                        </div>
                        <script>
                        document.querySelector(".notification_close").addEventListener('click', function() {
                            document.querySelector(".notification_status_form").style.display="none";
                        })
                        </script>
                        <?php endif; ?>
                        <!-- noti add form -->
                        <div class="panel_body">
                            <div id="table_content">
                                <div class="nav_tabs d_flex align_items_center">
                                    <a class="tab_item active" href="#tab_general">Tổng quan</a>
                                    <a class="tab_item" href="#tab_data">Dữ liệu</a>
                                    <a class="tab_item" href="#tab_links">Liên kết</a>
                                </div>
                                <div class="tab_content">
                                    <div class="tab_pane" id="tab_general">
                                        <div class="form_group status_wrap d_flex align_items_center">
                                            <label for="status_value" class="form_label">Trạng thái</label>
                                            <div class="switch_status">
                                                <label for="status_value" class="status_toggle on">
                                                    <input type="checkbox" <?php {{
                                                        if( !empty(Validation::form_value("prod_is_status")) ) {
                                                            echo Validation::form_value("prod_is_status") == "on" ? "checked" : null;
                                                        } else {
                                                            echo $ProdItem['prod_is_status'] == "on" ? "checked" : null;
                                                        }
                                                    }} ?> name="prod_is_status" id="status_value" class="d_none">
                                                    <span class="lever"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="content_group">
                                            <div class="form_group d_flex align_items_center">
                                                <label for="prod_name" class="form_label"><span style="color: #f00;">*</span> Tên sản phẩm</label>
                                                <div class="form_input">
                                                    <input class="form_control" value="<?php {{
                                                        if( !empty(Validation::form_value("prod_name")) ) {
                                                            echo Validation::form_value("prod_name");
                                                        } else {
                                                            echo $ProdItem['prod_name'];
                                                        }
                                                    }} ?>" type="text" name="prod_name" id="prod_name" placeholder="Tên sản phẩm" autocomplete="off" spellcheck="false">
                                                    <?php {{ echo Validation::form_error("prod_name"); }} ?>
                                                </div>
                                            </div>
                                            <div class="form_group d_flex align_items_center">
                                                <label for="prod_short_desc" class="form_label">Mô tả ngắn</label>
                                                <div class="form_input">
                                                    <textarea class="form_control ckeditor" name="prod_short_desc" id="prod_short_desc" placeholder="Mô tả ngắn" spellcheck="false"><?php {{ 
                                                        if( !empty(Validation::form_value("prod_short_desc")) ) {
                                                            echo Validation::form_value("prod_short_desc");
                                                        } else {
                                                            echo $ProdItem['prod_short_desc'];
                                                        }
                                                    }} ?></textarea>
                                                    <?php {{ echo Validation::form_error("prod_short_desc");}} ?>
                                                    <p class="caption">Ký tự đã dùng: 0/70</p>
                                                </div>
                                            </div>
                                            <div class="form_group d_flex align_items_center">
                                                <label for="prod_content_main_desc" class="form_label">Mô tả chi tiết</label>
                                                <div class="form_input">
                                                    <textarea class="form_control ckeditor" name="prod_content_main_desc" id="prod_content_main_desc" placeholder="Mô tả chi tiết" spellcheck="false"><?php {{ 
                                                        if( !empty(Validation::form_value("prod_content_main_desc")) ) {
                                                            echo Validation::form_value("prod_content_main_desc");
                                                        } else {
                                                            echo $ProdItem['prod_content_main_desc'];
                                                        }
                                                    }} ?></textarea>
                                                    <?php {{ echo Validation::form_error("prod_content_main_desc");}} ?>
                                                    <p class="caption">Ký tự đã dùng: 0/320</p>
                                                </div>
                                            </div>
                                            <div class="form_group d_flex align_items_center">
                                                <label for="prod_meta_title" class="form_label">Thẻ tiêu đề (Meta title)</label>
                                                <div class="form_input">
                                                    <input class="form_control" value="<?php {{
                                                        if( !empty(Validation::form_value("prod_meta_title")) ) {
                                                            echo Validation::form_value("prod_meta_title");
                                                        } else {
                                                            echo $ProdItem['prod_meta_title'];
                                                        }
                                                        }} ?>" type="text" name="prod_meta_title" id="prod_meta_title" placeholder="Thẻ tiêu đề (Meta title)" autocomplete="off" spellcheck="false">
                                                    <?php {{ echo Validation::form_error("prod_meta_title");}} ?>
                                                </div>
                                            </div>
                                            <div class="form_group d_flex align_items_center">
                                                <label for="prod_meta_desc" class="form_label">Thẻ mô tả (Meta desc)</label>
                                                <div class="form_input">
                                                    <input class="form_control" value="<?php {{ 
                                                        if( !empty(Validation::form_value("prod_meta_desc")) ) {
                                                            echo Validation::form_value("prod_meta_desc");
                                                        } else {
                                                            echo $ProdItem['prod_meta_desc'];
                                                        }
                                                    }} ?>" type="text" name="prod_meta_desc" id="prod_meta_desc" placeholder="Thẻ mô tả (Meta desc)" autocomplete="off" spellcheck="false">
                                                    <?php {{ echo Validation::form_error("prod_meta_desc");}} ?>
                                                </div>
                                            </div>
                                            <div class="form_group d_flex align_items_center">
                                                <label for="prod_meta_keywords" class="form_label">Từ khóa (tags)</label>
                                                <div class="form_input">
                                                    <input class="form_control" value="<?php {{
                                                        if( !empty(Validation::form_value("prod_meta_keywords")) ) {
                                                            echo Validation::form_value("prod_meta_keywords");
                                                        } else {
                                                            echo $ProdItem['prod_meta_keywords'];
                                                        }
                                                    }} ?>" type="text" name="prod_meta_keywords" id="prod_meta_keywords" placeholder="Thẻ mô tả (Meta desc)" autocomplete="off" spellcheck="false">
                                                </div>
                                            </div>
                                            <div class="form_group d_flex align_items_center">
                                                <label for="search_gg_info" class="form_label">Xem trước kết quả tìm kiếm</label>
                                                <div class="form_input">
                                                    <div class="google_title">Cellphones <?php {{ 
                                                        if( !empty(Validation::form_value("prod_meta_title")) ) {
                                                            echo Validation::form_value("prod_meta_title");
                                                        } else {
                                                            echo $ProdItem['prod_meta_title'];
                                                        }
                                                    }} ?></div>
                                                    <div class="google_url">
                                                        <span class="default">Cellphones.com/<?php {{ 
                                                            if( !empty(Validation::form_value("prod_meta_seourl")) ) {
                                                                echo Validation::form_value("prod_meta_seourl");
                                                            } else {
                                                                echo $ProdItem['prod_meta_seourl'];
                                                            }
                                                        }} ?></span>
                                                        <span class="url"></span>
                                                    </div>
                                                    <div class="google_desc"><?php {{ 
                                                        if( !empty(Validation::form_value("prod_meta_desc")) ) {
                                                            echo Validation::form_value("prod_meta_desc");
                                                        } else {
                                                            echo $ProdItem['prod_meta_desc'];
                                                        }
                                                    }} ?></div>
                                                </div>
                                            </div>
                                            <div class="form_group seoUrl d_flex align_items_center">
                                                <label for="prod_meta_seourl" class="form_label"><strong style="color: #f00;">*</strong> Đường dẫn SEO</label>
                                                <div class="form_input">
                                                    <input class="form_control" type="text" id="prod_meta_seourl" value="<?php {{ 
                                                        if( !empty(Validation::form_value("prod_meta_seourl")) ) {
                                                            echo Validation::form_value("prod_meta_seourl");
                                                        } else {
                                                            echo $ProdItem['prod_meta_seourl'];
                                                        }
                                                     }} ?>" placeholder="Đường dẫn SEO" autocomplete="off" spellcheck="false">
                                                    <input type="hidden" name="prod_meta_seourl" value="<?php {{ 
                                                        if( !empty(Validation::form_value("prod_meta_seourl")) ) {
                                                            echo Validation::form_value("prod_meta_seourl");
                                                        } else {
                                                            echo $ProdItem['prod_meta_seourl'];
                                                        }
                                                     }} ?>">
                                                    <?php {{ echo Validation::form_error("prod_meta_seourl"); }} ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab_pane" id="tab_data">
                                    <div class="form_group d_flex align_items_center">
                                        <label for="prod_avatar" class="form_label">Ảnh sản phẩm</label>
                                        <div class="form_input position_relative">
                                                <label for="prod_avatar">
                                                    <span class="thumbNail small">
                                                        <img class="img_cover full_size" id="prod_avatar_append" src="<?php {{
                                                            if( !empty(Validation::form_value("prod_avatar")) ) {
                                                                echo Validation::form_value("prod_avatar");
                                                            } else {
                                                                echo !empty($ProdItem['prod_avatar']) ? $ProdItem['prod_avatar'] : "./public/images/logo/no_image-50x50.png";
                                                            }
                                                        }} ?>" alt="">
                                                    </span>
                                                    <div class="popover position_absolute" style="left: 155px;">
                                                        <div class="popover_content d_flex align_items_center">
                                                            <label for="prod_avatar_fake" style="padding: 6px 10px 7px 12px;margin-right: 3px;" class="button_image btn btn_primary iframe-btn">
                                                                <i class="fa fa-pencil"></i>
                                                                <input type="file" class="d_none" id="prod_avatar_fake" value=" <?php {{ 
                                                                    if( !empty(Validation::form_value("prod_avatar_fake")) ) {
                                                                        echo Validation::form_value("prod_avatar_fake");
                                                                    } else {
                                                                        echo $ProdItem['prod_avatar'];;
                                                                    }
                                                                 }} ?>">
                                                                <input type="hidden" class="d_none" name="prod_avatar" id="prod_avatar" value="<?php {{
                                                                    if( !empty(Validation::form_value("prod_avatar")) ) {
                                                                        echo Validation::form_value("prod_avatar");
                                                                    } else {
                                                                        echo $ProdItem['prod_avatar'];
                                                                    }
                                                                }} ?>">
                                                            </label>
                                                            <button type="button" data-id-clear-img="prod_avatar" class="button_clear btn btn_danger" title="Xóa ảnh này">
                                                                <i class="fa fa-trash-o"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </label>
                                                <?php echo Validation::form_error("prod_avatar"); ?>
                                                <p class="_prod_upload_logo_error_ success " style="color: green; font-size:.9rem; margin:14px 0 0 20px;"></p>
                                            </div>
                                        </div>
                                        <div class="form_group d_flex align_items_center">
                                            <label for="prod_price_current" class="form_label">Giá bán</label>
                                            <div class="form_input">
                                                <input class="form_control" value="<?php {{
                                                    if( !empty(Validation::form_value("prod_price_current")) ) {
                                                        echo Validation::form_value("prod_price_current");
                                                    } else {
                                                        echo $ProdItem['prod_price_current'];
                                                    }
                                                }} ?>" type="number" name="prod_price_current" id="prod_price_current" placeholder="Giá bán" autocomplete="off" spellcheck="false">
                                                <?php {{ echo Validation::form_error("prod_price_current");}} ?>
                                            </div>
                                        </div>
                                        <div class="form_group d_flex align_items_center">
                                            <label for="prod_price_old" class="form_label">Giá cũ</label>
                                            <div class="form_input">
                                                <input class="form_control" value="<?php {{
                                                    if( !empty(Validation::form_value("prod_price_old")) ) {
                                                        echo Validation::form_value("prod_price_old");
                                                    } else {
                                                        echo $ProdItem['prod_price_old'];
                                                    }
                                                }} ?>" type="number" name="prod_price_old" id="prod_price_old" placeholder="Giá bán" autocomplete="off" spellcheck="false">
                                                <?php {{ echo Validation::form_error("prod_price_old");}} ?>
                                            </div>
                                        </div>
                                        <div class="form_group d_flex align_items_center">
                                            <label for="prod_code" class="form_label">Mã sản phẩm [ Model ]</label>
                                            <div class="form_input">
                                                <input class="form_control" value="<?php {{
                                                    if( !empty(Validation::form_value("prod_code")) ) {
                                                        echo Validation::form_value("prod_code");
                                                    } else {
                                                        echo $ProdItem['prod_code'];
                                                    }
                                                }} ?>" type="text" name="prod_code" id="prod_code" placeholder="Mã sản phẩm [ Model ]" autocomplete="off" spellcheck="false">
                                                <?php {{ echo Validation::form_error(("prod_code")); }} ?>
                                            </div>
                                        </div>
                                        <div class="form_group d_flex align_items_center">
                                            <label for="prod_amount" class="form_label">Số lượng sản phẩm</label>
                                            <div class="form_input">
                                                <input class="form_control" value="<?php {{
                                                    if( !empty(Validation::form_value("prod_amount")) ) {
                                                        echo Validation::form_value("prod_amount");
                                                    } else {
                                                        echo $ProdItem['prod_amount'];
                                                    }
                                                }} ?>" type="number" name="prod_amount" id="prod_amount" placeholder="Số lượng sản phẩm" autocomplete="off" spellcheck="false">
                                            </div>
                                        </div>
                                        <div class="form_group d_flex align_items_center">
                                            <label for="prod_sku" class="form_label" title="Đơn vị lưu kho (Stock Keeping Unit)">
                                                <span>SKU</span>
                                                <i class="fa fa-question-circle" style="color: #1E91CF;" aria-hidden="true"></i>
                                            </label>
                                            <div class="form_input">
                                                <input class="form_control" type="text" name="prod_sku" id="prod_sku" placeholder="Đơn vị lưu kho [ Stock Keeping Unit ]" autocomplete="off" spellcheck="false">
                                            </div>
                                        </div>
                                        <div class="form_group d_flex align_items_center">
                                            <label for="prod_warehouse" class="form_label" title="Hiểu thị trạng thái hết hàng">
                                                <span>Trạng thái kho hàng</span>
                                                <i class="fa fa-question-circle" style="color: #1E91CF;" aria-hidden="true"></i>
                                            </label>
                                            <div class="form_input">
                                                <select class="form_control" name="prod_status_stock" id="prod_status_stock">
                                                    <option value="">--Tùy chỉnh--</option>
                                                    <option <?php {{ echo Validation::form_value("prod_status_stock") == "1" ? "selected" : null; }} ?> value="1">Còn hàng</option>
                                                    <option <?php {{ echo Validation::form_value("prod_status_stock") == "2" ? "selected" : null; }} ?> value="2">Hết hàng</option>
                                                    <option <?php {{ echo Validation::form_value("prod_status_stock") == "3" ? "selected" : null; }} ?> value="3">Đặt trước</option>
                                                    <option <?php {{ echo Validation::form_value("prod_status_stock") == "4" ? "selected" : null; }} ?> value="4">Ngừng kinh doanh</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form_group d_flex align_items_center">
                                            <label for="prod_installment" class="form_label">Áp dụng trả góp</label>
                                            <div class="form_input">
                                                <label for="yes_installment">
                                                    <input type="radio" <?php {{echo Validation::form_value("prod_is_installment") == "1" ? 'checked' : '';}} ?> value="1" name="prod_is_installment[]" id="yes_installment">
                                                    <span>Có</span>
                                                </label>
                                                <label for="no_installment">
                                                    <input type="radio" <?php {{echo Validation::form_value("prod_is_installment") == "0" ? 'checked' : '';}} ?> value="0" name="prod_is_installment[]" id="no_installment">
                                                    <span>Không</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab_pane" id="tab_links">
                                        <div class="form_group d_flex align_items_center">
                                            <label for="prod_ties_brand_id" class="form_label" title="Nhấn để chọn hãng sản xuất">
                                                <span>Hãng sản xuất [ Thương hiệu ]</span>
                                                <i class="fa fa-question-circle" style="color: #1E91CF;" aria-hidden="true"></i>
                                            </label>
                                            <div class="form_input">
                                                <select name="prod_brand_id_ties" class="form_control" id="select-brand">
                                                    <?php if(!empty($listBrand)): ?>
                                                        <option value="">---Chọn thương hiệu---</option>
                                                        <?php foreach($listBrand as $brand) : ?>
                                                            <option value="<?php {{echo $brand['brand_id'];}} ?>"><?php {{echo $brand['brand_name']; }} ?></option>
                                                        <?php endforeach; ?>
                                                    <?php else : ?>
                                                        <option value="">Bạn chưa có thương hiệu nào</option>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form_group d_flex">
                                            <label for="" class="form_label" title="Nhấn để chọn danh mục">
                                                <span>Danh mục</span>
                                                <i class="fa fa-question-circle" style="color: #1E91CF;" aria-hidden="true"></i>
                                            </label>
                                            <div class="form_input">
                                                <div class="form_list_wrap">
                                                    <?php if( !empty($listMultiCate) ) : ?>
                                                        <div class="list">
                                                            <?php foreach( $listMultiCate as $cate ) : ?>
                                                                <label for="cate_<?php {{ echo $cate['cateprod_id']; }} ?>" class="item d_flex align_items_center">
                                                                    <input <?php {{
                                                                        if(Validation::form_value("prod_cateprod")) {
                                                                            foreach( Validation::form_value("prod_cateprod") as $index => $idCate ) {
                                                                                echo $idCate == $cate['cateprod_id'] ? "checked" : null;
                                                                            }
                                                                        }
                                                                    }} ?> type="checkbox" name="prod_cateprod[]" value="<?php {{ echo $cate['cateprod_id']; }} ?>" id="cate_<?php {{ echo $cate['cateprod_id']; }} ?>">
                                                                    <span><?php {{ echo str_repeat('---', $cate['level']); }} ?></span>
                                                                    <span><?php {{ echo $cate['cateprod_name']; }} ?></span>
                                                                </label>
                                                            <?php endforeach; ?>
                                                        </div>
                                                    <?php else : ?>
                                                        <p>Bạn chưa có danh mục sản phẩm nào !</p>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="list_button d_flex align_items_center">
                                                    <a href="" class="btn btn_primary cateProdSelectAll">Chọn tất cả</a>
                                                    <a href="" class="btn btn_warning cateProdClearAll">Bỏ chọn tất cả</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab_pane" id="tab_images">
                                        <div class="table_images_wrap">
                                            <table class="table_images table">
                                                <thead>
                                                    <tr>
                                                        <td>Hình ảnh bổ sung</td>
                                                        <td>Sắp xếp</td>
                                                        <td>Tác vụ</td>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="2"></td>
                                                        <td>
                                                            <button type="button" id="btnCreate_rowImage" class="btn btn_primary">
                                                                <i class="fa fa-plus-circle"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab_pane" id="tab_attribute">
                                        <div class="form_group d_flex align_items_center">
                                            <label for="prod_intro" class="form_label">Giới thiệu nổi bậc</label>
                                            <div class="form_input">
                                                <textarea class="form_control ckeditor" name="prod_intro" id="prod_intro" placeholder="Giới thiệu nổi bậc" spellcheck="false"></textarea>
                                                <p class="caption">Hiển thị ngay bên cạnh hình ảnh sản phẩm</p>
                                            </div>
                                        </div>
                                        <div class="form_group d_flex align_items_center">
                                            <label for="prod_special_features" class="form_label">Tính năng đặt biệt</label>
                                            <div class="form_input">
                                                <textarea class="form_control ckeditor" name="prod_special_features" id="prod_special_features" placeholder="Mô tả tính năng đặt biệt" spellcheck="false"></textarea>
                                                <p class="caption">Khởi tạo table và thể hiện</p>
                                            </div>
                                        </div>
                                        <div class="form_group d_flex align_items_center">
                                            <label for="prod_specifications" class="form_label">Thông số kỹ thuật</label>
                                            <div class="form_input">
                                                <textarea class="form_control ckeditor" name="prod_specifications" id="prod_specifications" placeholder="Mô tả thông số kỹ thuật" spellcheck="false"></textarea>
                                                <p class="caption">Khởi tạo table và thể hiện</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab_pane" id="tab_flash_sale">
                                        <div class="table_flash_sale_wrap">
                                            <table class="flash_sale table">
                                                <thead>
                                                    <tr>
                                                        <td>Nhóm khách hàng</td>
                                                        <td>Độ ưu tiên</td>
                                                        <td>Giá khuyến mãi</td>
                                                        <td>Date Start</td>
                                                        <td>Date End</td>
                                                        <td>Tác vụ</td>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="5"></td>
                                                        <td>
                                                            <button type="button" id="btnCreate_rowFlashSale" class="btn btn_primary">
                                                                <i class="fa fa-plus-circle"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </main>
        <?php {{ view("Inc.footer"); }} ?>
    </div>
    <script type="text/javascript" src="./public/js/config/jquery.min.js"></script>
    <script type="text/javascript" src="./public/js/app/prod.add.ajax.js"></script>
    <script class="handle_show_tab_pane">
        activePageTab();
        function activePageTab() {
            let elActive = document.querySelector("#table_content .nav_tabs .tab_item.active");
            let idPane = (elActive.getAttribute('href')).split("#")[1];
            let elPane = document.getElementById(idPane);
            (document.querySelectorAll(".tab_pane")).forEach(el => {
                el.style.display = "none";
            });
            elPane.style.display = "block";
        }
        let listBtnEl = document.querySelectorAll("#table_content .nav_tabs .tab_item");
        listBtnEl.forEach(el => {
            el.addEventListener('click', function() {
                event.preventDefault();
                listBtnEl.forEach(el => {
                    el.classList.remove('active');
                });
                this.classList.add('active');
                activePageTab();
            });
        });
    </script>
    <script>
        //========= ##### handle keyup word and append ##### ==========//
        var metaTitleEl = document.querySelector("#prod_meta_title");
        var metaDescEl  = document.querySelector("#prod_meta_desc");
        var seoUrlEl    = document.querySelector("#prod_meta_seourl");

        metaTitleEl.addEventListener('keyup', function() {
            let vl = this.value;
            let spaceAppend = document.querySelector(".google_title");
            appendKeyWord(vl, spaceAppend);
        });

        metaDescEl.addEventListener('keyup', function() {
            let vl = this.value;
            let spaceAppend = document.querySelector(".google_desc");
            appendKeyWord(vl, spaceAppend);
        });


        seoUrlEl.addEventListener('keyup', function() {
            let vl = this.value;
            let spaceAppend = document.querySelector(".google_url .url");
            document.querySelector("[name='prod_meta_seourl']").value = slug_string(vl);
            appendKeyWord(slug_string(vl), spaceAppend);
        });
        function appendKeyWord(keyWord, placeAppend)
        {
            placeAppend.innerText = keyWord;
        }
        function slug_string(str) {
            str = str.toLowerCase();
            str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a");
            str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e");
            str = str.replace(/ì|í|ị|ỉ|ĩ/g, "i");
            str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o");
            str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u");
            str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y");
            str = str.replace(/đ/g, "d");
            str = str.replace(/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'| |\"|\&|\#|\[|\]|~|$|_/g, "-");
            str = str.replace(/-+-/g, "-");
            str = str.replace(/^\-+|\-+$/g, "");
            if (str === undefined) {
                return false;
            } else {
                return str;
            }
        }

    </script>
    <script class="handle_selectAll_clearAll">
        let btnSelectAllCateProd = document.querySelector(".cateProdSelectAll");
        let btnSelectAllBlog     = document.querySelector(".blogSelectAll");
        let btnClearCateProd     = document.querySelector(".cateProdClearAll");
        let btnClearAllBlog      = document.querySelector(".blogClearAll");
        let listProdCates        = document.querySelectorAll("input[name='cateProds[]']");
        let listBlogs            = document.querySelectorAll("input[name='blogs[]']");
        btnSelectAllCateProd.addEventListener('click', function() {
            event.preventDefault();
            listProdCates.forEach(el => {
                el.checked = true;
            });
        });
        btnSelectAllBlog.addEventListener('click', function() {
            event.preventDefault();
            listBlogs.forEach(el => {
                el.checked = true;
            });
        });
        btnClearCateProd.addEventListener('click', function() {
            event.preventDefault();
            listProdCates.forEach(el => {
                el.checked = false;
            });
        });
        btnClearAllBlog.addEventListener('click', function() {
            event.preventDefault();
            listBlogs.forEach(el => {
                el.checked = false;
            });
        });
    </script>
    <?php {{ view("Inc.script"); }} ?>
    <script src="https://code.jquery.com/jquery-latest.min.js"></script>
    <script type="text/javascript" src="./public/js/app/common.js"></script> 
    <script src="<?php {{ echo Config::getBaseUrlAdmin("public/js/lib/s-select.min.js");}} ?>"></script>
    <script>
        $(document).ready(function(){
            $("#select-brand").select2();
        });
    </script>
    <script src="<?php {{ echo Config::getBaseUrlAdmin("public/plugins/Ckeditor/ckeditor/ckeditor.js"); }} ?>"></script>

</body>
</html>