<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/css/config/helper.css">
    <link rel="stylesheet" href="./public/css/style/layout.css">
    <link rel="stylesheet" href="./public/css/style/home.css">
    <!-- Start file manager -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" integrity="sha512-H9jrZiiopUdsLpg94A333EfumgUBpO9MdbxStdeITo+KEIMaNfHNvwyjjDJb+ERPaRS6DpyRlKbvPUasNItRyw==" crossorigin="anonymous" />
    <!-- End file manager -->
    <title>Hãng sản xuất</title>
</head>
<body>
    <div id="dashboardApp" class="showAside position_relative">
        <?php {{ view("Inc.header"); }} ?>
        <?php {{ view("Inc.sidebar"); }} ?>
        <main class="main_content">
            <form action="" method="POST">
                <div class="page_header">
                    <div class="container_fluid d_flex justify_content_between align_items_center">
                        <div class="d_flex align_items_end">
                            <h1>Thương hiệu</h1>
                            <ol class="breadcrumb d_flex align_items_center">
                                <li>
                                    <a href="?">Trang chủ</a>
                                </li>
                                <li class="active">
                                    <a href="javascript:;">Thêm thương hiệu</a>
                                </li>
                            </ol>
                        </div>
                        <div class="d_flex align_items_center">
                            <button type="submit" class="btn_item btn_primary" name="addBrand_action">
                                <i class="fa fa-save" aria-hidden="true"></i>
                                <span>Lưu</span>
                            </button>
                            <a class="btn_item btn_default" href="<?php {{ echo Config::getBaseUrlAdmin("?controller=Brand"); }} ?>">
                                <i class="fa fa-reply" aria-hidden="true"></i>
                                <span>Quay về</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="table_content container_fluid">
                    <div class="panel_table">
                        <div class="panel_heading">
                            <h2 class="panel_title">
                                <i class="fa fa-pencil"></i>
                                <span>Thêm thương hiệu</span>
                            </h2>
                        </div>
                        <?php {{ view("Inc.notification_status_form", [ "dataStatusBrand" => !empty($dataStatusBrand) ? $dataStatusBrand : null ]); }} ?>
                        <div class="panel_body">
                            <div id="table_content">
                                <div class="nav_tabs d_flex align_items_center">
                                    <a class="active tab_item" href="#tab_general">Tổng quan</a>
                                </div>
                                <div class="tab_content">
                                    <!-- Start alert notification -->
                                    <div class="alert_wrap">
                                        <div class="alert  position_relative" data-status="">
                                            <i class="fa fa-check-circle" style="margin-right: 5px;"></i>
                                            <span></span>
                                            <button type="button" class="close position_absolute">x</button>
                                        </div>
                                    </div>
                                    <!-- End alert notification -->
                                    <div class="tab_pane" id="tab_general">
                                        <div class="form_group status_wrap d_flex align_items_center">
                                            <label for="status_value" class="form_label">Trạng thái</label>
                                            <div class="switch_status">
                                                <label for="status_value" class="status_toggle on">
                                                    <input type="checkbox" <?php {{
                                                        echo Validation::form_value("brand_is_status") == "on" ? "checked" : null;
                                                    }} ?> name="brand_is_status" id="status_value" class="d_none">
                                                    <span class="lever"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="content_group">
                                            <div class="form_group d_flex align_items_center">
                                                <label for="brand_name" class="form_label"><strong style="color: #f00;">*</strong> Tên thương hiệu</label>
                                                <div class="form_input">
                                                    <input class="form_control" type="text" name="brand_name" id="brand_name" value="<?php {{ echo Validation::form_value("brand_name"); }} ?>" placeholder="Tên thương hiệu" autocomplete="off" spellcheck="false">
                                                    <?php {{ echo Validation::form_error("brand_name"); }} ?>
                                                </div>
                                            </div>
                                            <div class="form_group d_flex align_items_center">
                                                <label for="brand_logo" class="form_label"><strong style="color: #f00;">*</strong> Logo</label>
                                                <div class="form_input position_relative">
                                                    <label for="prod_avatar">
                                                        <span class="thumbNail small">
                                                            <img id="brand_logo_append" class="img_cover full_size" src="<?php {{
                                                                echo !empty(Validation::form_value("brand_logo")) ? Validation::form_value("brand_logo") : "./public/images/logo/no_image-50x50.png";
                                                            }} ?>" alt="">
                                                        </span>
                                                        <div class="popover position_absolute" style="left: 155px;">
                                                            <div class="popover_content d_flex align_items_center">
                                                                <label for="brand_logo_fake" style="padding: 6px 10px 7px 12px;margin-right: 3px;" class="button_image btn btn_primary iframe-btn">
                                                                    <i class="fa fa-pencil"></i>
                                                                    <input type="file" class="d_none" id="brand_logo_fake" value=" <?php {{ echo Validation::form_value("brand_logo_fake"); }} ?>">
                                                                    <input type="hidden" class="d_none" name="brand_logo" id="brand_logo" value="<?php {{echo Validation::form_value("brand_logo");}} ?>">
                                                                </label>
                                                                <button type="button" data-id-clear-img="brand_logo" class="button_clear btn btn_danger" title="Xóa ảnh này">
                                                                    <i class="fa fa-trash-o"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </label>
                                                    <?php echo Validation::form_error("brand_logo"); ?>
                                                    <p class="_brand_upload_logo_error_ success " style="color: green; font-size:.9rem; margin:14px 0 0 20px;"></p>
                                                </div>
                                            </div>
                                            <div class="form_group d_flex align_items_center">
                                                <label for="brand_order" class="form_label">Số TT MAX</label>
                                                <div class="form_input">
                                                    <input disabled style="width: 100px; text-align: center;" class="hidden_input_number form_control order_max" type="number" min="1" name="brand_order">
                                                </div>
                                            </div>
                                            <div class="form_group d_flex align_items_center">
                                                <label for="brand_order" class="form_label">Số thứ tự</label>
                                                <div class="form_input">
                                                    <input class="form_control" type="number" min="1" name="brand_order" id="brand_order" value="<?php {{ echo Validation::form_value("brand_order"); }} ?>" placeholder="Thứ tự hiển thị" autocomplete="off" spellcheck="false">
                                                </div>
                                            </div>
                                            <div class="form_group d_flex align_items_center">
                                                <label for="brand_meta_keywords" class="form_label">
                                                    <span>Từ khóa</span>
                                                    <i class="fa fa-question-circle" title="Không sử dụng khoảng trống, nếu cần hãy sử dụng dấu - , Ví dụ: Apple." style="color: #1E91CF;" aria-hidden="true"></i>
                                                </label>
                                                <div class="form_input">
                                                    <input class="form_control" type="text" value="<?php {{echo Validation::form_value("brand_meta_keywords");}} ?>" name="brand_meta_keywords" id="brand_meta_keywords" placeholder="Từ khóa" autocomplete="off" spellcheck="false">
                                                    <?php {{ echo Validation::form_error("brand_meta_keywords"); }}?>
                                                </div>
                                            </div>
                                            <div class="form_group d_flex align_items_center">
                                                <label for="brand_meta_title" class="form_label"><strong style="color: #f00;">*</strong> Thẻ tiêu đề (Meta title)</label>
                                                <div class="form_input">
                                                    <input class="form_control" type="text" name="brand_meta_title" id="brand_meta_title" value="<?php {{ echo Validation::form_value("brand_meta_title"); }} ?>" placeholder="Thẻ tiêu đề (Meta title)" autocomplete="off" spellcheck="false">
                                                    <?php {{ echo Validation::form_error("brand_meta_title"); }} ?>
                                                </div>
                                            </div>
                                            <div class="form_group d_flex align_items_center">
                                                <label for="brand_meta_desc" class="form_label"><strong style="color: #f00;">*</strong> Thẻ mô tả (Meta desc)</label>
                                                <div class="form_input">
                                                    <textarea class="form_control" name="brand_meta_desc" id="brand_meta_desc" placeholder="Thẻ mô tả (Meta desc)" spellcheck="false"><?php {{ echo Validation::form_value("brand_meta_desc"); }} ?></textarea>
                                                    <?php {{ echo Validation::form_error("brand_meta_desc"); }} ?>
                                                </div>
                                            </div>
                                            <div class="form_group d_flex align_items_center">
                                                <label for="search_gg_info" class="form_label">Xem trước kết quả tìm kiếm</label>
                                                <div class="form_input">
                                                    <div class="google_title"><?php {{ echo Validation::form_value("brand_meta_title"); }} ?></div>
                                                    <div class="google_url"><?php {{ echo Validation::form_value("brand_meta_desc"); }}  ?>
                                                        <span class="default">https://thachcellphones.vn/<?php {{ echo Validation::form_value("brand_meta_url");}} ?></span><span class="url"></span>
                                                    </div>
                                                    <div class="google_desc"><?php {{ echo Validation::form_value("brand_meta_desc"); }}  ?></div>
                                                </div>
                                            </div>
                                            <div class="form_group seoUrl d_flex align_items_center">
                                                <label for="brand_meta_url" class="form_label"><strong style="color: #f00;">*</strong> Đường dẫn SEO</label>
                                                <div class="form_input">
                                                    <input class="form_control" type="text" id="brand_meta_url" value="<?php {{ echo Validation::form_value("brand_meta_url"); }} ?>" placeholder="Đường dẫn SEO" autocomplete="off" spellcheck="false">
                                                    <input type="hidden" name="brand_meta_url" value="<?php {{ echo Validation::form_value("brand_meta_url"); }} ?>">
                                                    <?php {{ echo Validation::form_error("brand_meta_url"); }} ?>
                                                </div>
                                            </div>
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
    <script type="text/javascript" src="./public/js/app/brand.add.ajax.js"></script>
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
        var metaTitleEl = document.querySelector("#brand_meta_title");
        var metaDescEl  = document.querySelector("#brand_meta_desc");
        var seoUrlEl    = document.querySelector("#brand_meta_url");

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
            document.querySelector("[name='brand_meta_url']").value = slug_string(vl);
            appendKeyWord(slug_string(vl), spaceAppend);
        });


        function appendKeyWord(keyWord, placeAppend)
        {
            placeAppend.innerText = keyWord;
        }

        function slug_string(str)
        {
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

        // handle notification status add cate new
        var alertStatusAddCateEl = document.querySelector('.alert');
        if(alertStatusAddCateEl !== null) {
            var buttonCloseAlertEl   = document.querySelector(".alert .close");
            if(alertStatusAddCateEl.getAttribute('data-status') === 'true') {
                alertStatusAddCateEl.classList.add('open');
                setTimeout(function() {
                    alertStatusAddCateEl.classList.remove('open');
                },5000);
            }

            buttonCloseAlertEl.addEventListener('click', function() {
                alertStatusAddCateEl.classList.remove('open');
            });
        }
    </script>
    <?php {{ view("Inc.script"); }} ?>
</body>
</html>