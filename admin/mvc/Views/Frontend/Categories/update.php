<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/css/config/helper.css">
    <link rel="stylesheet" href="./public/css/style/layout.css">
    <link rel="stylesheet" href="./public/css/style/home.css">
    <title>Danh mục</title>
</head>
<body>
    <div id="dashboardApp" class="showAside position_relative">
        <?php { {view("Inc.header");}} ?>
        <?php { {view("Inc.sidebar");}} ?>
        <main class="main_content">
            <form action="" method="POST">
                <div class="page_header">
                    <div class="container_fluid d_flex justify_content_between align_items_center">
                        <div class="d_flex align_items_end">
                            <h1>Danh mục</h1>
                            <ol class="breadcrumb d_flex align_items_center">
                                <li>
                                    <a href="<?php {{echo Config::getBaseUrlAdmin();}} ?>">Trang chủ</a>
                                </li>
                                <li class="active">
                                    <a href="javascript:;">Danh mục</a>
                                </li>
                            </ol>
                        </div>
                        <div class="d_flex align_items_center">
                            <button type="submit" <?php echo empty($CateProdItem) ? "disabled" : ''; ?> class="btn_item btn_primary" name="updateCateProd_action">
                                <i class="fa fa-save" aria-hidden="true"></i>
                                <span>Cập nhật</span>
                            </button>
                            <a class="btn_item btn_default" href="<?php echo Config::getBaseUrlAdmin("?controller=Categories"); ?>">
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
                                <span>Update danh mục</span>
                            </h2>
                        </div>
                        <!-- noti add form -->
                        <?php if(!empty($dataStatusCate) ) : ?>
                            <div class="notification_status_form open">
                                <div class="notification-inner <?php {{ echo $dataStatusCate['status'];}} ?>">
                                    <p class="notification_text"><?php {{ echo $dataStatusCate['notify'];}} ?></p>
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
                            <?php if( !empty($CateProdItem) ) : ?>
                                <div id="table_content">
                                    <div class="nav_tabs d_flex align_items_center">
                                        <a class="active tab_item" href="#tab_general">Tổng quan</a>
                                        <a class="tab_item" href="#tab_data">Dữ liệu</a>
                                    </div>
                                    <div class="tab_content">
                                        <div class="tab_pane" id="tab_general">
                                        <div class="form_group status_wrap d_flex align_items_center">
                                                <label for="status_value" class="form_label">Trạng thái</label>
                                                <div class="switch_status">
                                                    <label for="status_value" class="status_toggle on">
                                                        <input type="checkbox" <?php {{
                                                            if( !empty(Validation::form_value("cateprod_is_status")) ) {
                                                                echo Validation::form_value("cateprod_is_status") == "on" ? "checked" : null;
                                                            } else {
                                                                echo $CateProdItem['cateprod_is_status'] == "on" ? "checked" : null;
                                                            }
                                                        }} ?> name="cateprod_is_status" id="status_value" class="d_none">
                                                        <span class="lever"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="content_group">
                                                <div class="form_group d_flex align_items_center">
                                                    <label for="cateprod_name" class="form_label">Tên danh mục</label>
                                                    <div class="form_input">
                                                        <input class="form_control" value="<?php {{
                                                            if( !empty(Validation::form_value("cateprod_name")) ) {
                                                                echo Validation::form_value("cateprod_name");
                                                            } else {
                                                                echo $CateProdItem['cateprod_name'];
                                                            }
                                                        }} ?>" type="text" name="cateprod_name" id="cateprod_name" placeholder="Nhập tên danh mục" autocomplete="off" spellcheck="false">
                                                        <?php {{ echo Validation::form_error("cateprod_name"); }} ?>
                                                    </div>
                                                </div>
                                                <div class="form_group d_flex align_items_center">
                                                    <label for="cateprod_meta_keywords" class="form_label">Từ khoá</label>
                                                    <div class="form_input">
                                                        <input class="form_control" value="<?php {{
                                                            if( !empty(Validation::form_value("cateprod_meta_keywords")) ) {
                                                                echo Validation::form_value("cateprod_meta_keywords");
                                                            } else {
                                                                echo $CateProdItem['cateprod_meta_keywords'];
                                                            }
                                                        }} ?>" type="text" name="cateprod_meta_keywords" id="cateprod_meta_keywords" placeholder="Nhập từ khoá" autocomplete="off" spellcheck="false">
                                                        <?php {{ echo Validation::form_error("cateprod_meta_keywords"); }} ?>
                                                    </div>
                                                </div>
                                                <div class="form_group d_flex align_items_center">
                                                    <label for="cateprod_meta_title" class="form_label">Thẻ tiêu đề (Meta title)</label>
                                                    <div class="form_input">
                                                        <input class="form_control" value="<?php {{
                                                            if( !empty(Validation::form_value("cateprod_meta_title")) ) {
                                                                echo Validation::form_value("cateprod_meta_title");
                                                            } else {
                                                                echo $CateProdItem['cateprod_meta_title'];
                                                            }
                                                        }} ?>" type="text" name="cateprod_meta_title" id="cateprod_meta_title" placeholder="Thẻ tiêu đề (Meta title)" autocomplete="off" spellcheck="false">
                                                        <?php {{ echo Validation::form_error("cateprod_meta_title"); }} ?>
                                                    </div>
                                                </div>
                                                <div class="form_group d_flex align_items_center">
                                                    <label for="cateprod_meta_desc" class="form_label">Thẻ mô tả (Meta desc)</label>
                                                    <div class="form_input">
                                                        <input class="form_control" value="<?php {{
                                                            if( !empty(Validation::form_value("cateprod_meta_desc")) ) {
                                                                echo Validation::form_value("cateprod_meta_desc");
                                                            } else {
                                                                echo $CateProdItem['cateprod_meta_desc'];
                                                            }
                                                        }} ?>" type="text" name="cateprod_meta_desc" id="cateprod_meta_desc" placeholder="Thẻ mô tả (Meta desc)" autocomplete="off" spellcheck="false">
                                                        <?php {{ echo Validation::form_error("cateprod_meta_desc"); }} ?>
                                                    </div>
                                                </div>
                                                <div class="form_group d_flex align_items_center">
                                                    <label for="search_gg_info" class="form_label">Xem trước kết quả tìm kiếm</label>
                                                    <div class="form_input">
                                                        <div class="google_title"><?php {{ 
                                                            if( !empty(Validation::form_value("cateprod_meta_title")) ) {
                                                                echo Validation::form_value("cateprod_meta_title");
                                                            } else {
                                                                echo $CateProdItem['cateprod_meta_title'];
                                                            }                                                            
                                                        }} ?></div>
                                                        <div class="google_url">
                                                            <span class="default">Cellphones/</span>
                                                            <span class="url"><?php {{ 
                                                                if( !empty(Validation::form_value("cateprod_meta_url")) ) {
                                                                    echo Validation::form_value("cateprod_meta_url");
                                                                } else {
                                                                    echo $CateProdItem['cateprod_meta_url'];
                                                                }                                                                      
                                                            }} ?></span>
                                                        </div>
                                                        <div class="google_desc"><?php {{ 
                                                                if( !empty(Validation::form_value("cateprod_meta_desc")) ) {
                                                                    echo Validation::form_value("cateprod_meta_desc");
                                                                } else {
                                                                    echo $CateProdItem['cateprod_meta_desc'];
                                                                }                                                                
                                                         }} ?></div>
                                                    </div>
                                                </div>
                                                <div class="form_group cateprod_meta_url d_flex align_items_center">
                                                    <label for="cateprod_meta_url" class="form_label">Đường dẫn SEO</label>
                                                    <div class="form_input">
                                                        <input class="form_control" value="<?php {{
                                                            if( !empty(Validation::form_value("cateprod_meta_url")) ) {
                                                                echo Validation::form_value("cateprod_meta_url");
                                                            } else {
                                                                echo $CateProdItem['cateprod_meta_url'];
                                                            }      
                                                        }} ?>" type="text" id="cateprod_meta_url" name="cateprod_meta_url" placeholder="Đường dẫn SEO" autocomplete="off" spellcheck="false">
                                                        <input type="hidden" name="cateprod_meta_url" value="<?php {{
                                                            if( !empty(Validation::form_value("cateprod_meta_url")) ) {
                                                                echo Validation::form_value("cateprod_meta_url");
                                                            } else {
                                                                echo $CateProdItem['cateprod_meta_url'];
                                                            }
                                                        }} ?>">
                                                        <?php {{ echo Validation::form_error("cateprod_meta_url"); }} ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab_pane" id="tab_data">
                                            <div class="form_group d_flex align_items_center">
                                                <label for="cateprod_parent_id" class="form_label">Danh mục cha</label>
                                                <div class="form_input">
                                                <select class="form_control" name="cateprod_parent_id" id="cateprod_parent_id">
                                                    <?php if( !empty($listMultiCate)) : ?>
                                                        <option value="<?php {{ echo Validation::form_value("cateprod_parent_id") == "no_select" ? "selected" : null ;}} ?>">--- Chọn ---</option>
                                                        <?php foreach($listMultiCate as $cateItem ) : ?>
                                                            <option <?php {{
                                                                if(!empty(Validation::form_value("cateprod_parent_id"))) {
                                                                    echo Validation::form_value("cateprod_parent_id") == $cateItem['cateprod_id'] ? "selected" : null;
                                                                } else {
                                                                    echo $CateProdItem['cateprod_parent_id'] == $cateItem['cateprod_id'] ? "selected" : '';
                                                                }
                                                            }} ?> value="<?php {{ echo $cateItem['cateprod_id'];}} ?>"> <?php {{
                                                                echo str_repeat('--', $cateItem['level']);
                                                                echo $cateItem['cateprod_name'];
                                                            }} ?>  </option>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </select>
                                                </div>
                                            </div>
                                            <div class="form_group d_flex align_items_center">
                                                <label for="cateprod_icon" class="form_label">Mini icon</label>
                                                <div class="form_input position_relative">
                                                    <label for="cateprod_icon">
                                                        <span class="thumbNail small">
                                                            <img class="img_cover full_size" id="cateprod_icon_append" src="<?php {{
                                                               if( !empty(Validation::form_value("cateprod_icon")) ) {
                                                                    echo Validation::form_value("cateprod_icon");
                                                                } else {
                                                                    echo !empty($CateProdItem['cateprod_icon']) ? $CateProdItem['cateprod_icon'] : "./public/images/logo/no_image-50x50.png";
                                                                }
                                                            }} ?>" alt="">
                                                        </span>
                                                        <div class="popover position_absolute" style="left: 155px;">
                                                            <div class="popover_content d_flex align_items_center">
                                                                <label for="cateprod_icon_fake" style="padding: 6px 10px 7px 12px;margin-right: 3px;" class="button_image btn btn_primary iframe-btn">
                                                                    <i class="fa fa-pencil"></i>
                                                                    <input type="file" class="d_none" id="cateprod_icon_fake" value=" <?php {{ 
                                                                        if( !empty(Validation::form_value("cateprod_icon_fake")) ) {
                                                                            echo Validation::form_value("cateprod_icon_fake");
                                                                        } else {
                                                                            echo $CateProdItem['cateprod_icon'];
                                                                        }
                                                                     }} ?>">
                                                                    <input type="hidden" class="d_none" name="cateprod_icon" id="cateprod_icon" value="<?php {{
                                                                        if( !empty(Validation::form_value("cateprod_icon")) ) {
                                                                            echo Validation::form_value("cateprod_icon");
                                                                        } else {
                                                                            echo $CateProdItem['cateprod_icon'];
                                                                        }
                                                                    }} ?>">
                                                                </label>
                                                                <button type="button" data-id-clear-img="cateprod_icon" class="button_clear btn btn_danger" title="Xóa ảnh này">
                                                                    <i class="fa fa-trash-o"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </label>
                                                <?php echo Validation::form_error("cateprod_icon"); ?>
                                                <p class="_cateProd_icon_upload_logo_error_ success " style="color: green; font-size:.9rem; margin:14px 0 0 20px;"></p>
                                                </div>
                                            </div>
                                            <div class="form_group d_flex align_items_center">
                                                <label for="cateprod_banner_pc" class="form_label">Banner PC</label>
                                                <div class="form_input position_relative">
                                                    <label for="cateprod_banner_pc">
                                                        <span class="thumbNail banner __PC">
                                                            <img id="cateprod_banner_pc_append" src="<?php {{
                                                                if( !empty(Validation::form_value("cateprod_banner_pc")) ) {
                                                                    echo Validation::form_value("cateprod_banner_pc");
                                                                } else {
                                                                    echo !empty($CateProdItem['cateprod_banner_pc']) ? $CateProdItem['cateprod_banner_pc'] : "./public/images/logo/no_image-50x50.png";
                                                                }
                                                            }} ?>" width="100%" height="100%" alt="">
                                                        </span>
                                                        <div class="popover position_absolute" style="left: -104px; top:40%;">
                                                            <div class="popover_content d_flex align_items_center">
                                                            <label for="cateprod_banner_pc_fake" style="padding: 6px 10px 7px 12px;margin-right: 3px;" class="button_image btn btn_primary iframe-btn">
                                                                <i class="fa fa-pencil"></i>
                                                                <input type="file" class="d_none" id="cateprod_banner_pc_fake" value="<?php {{ 
                                                                    if( !empty(Validation::form_value("cateprod_banner_pc_fake")) ) {
                                                                        echo Validation::form_value("cateprod_banner_pc_fake");
                                                                    } else {
                                                                        echo $CateProdItem['cateprod_banner_pc'];
                                                                    }
                                                                 }} ?>">
                                                                <input type="hidden" class="d_none" name="cateprod_banner_pc" id="cateprod_banner_pc" value="<?php {{
                                                                    if( !empty(Validation::form_value("cateprod_banner_pc")) ) {
                                                                        echo Validation::form_value("cateprod_banner_pc");
                                                                    } else {
                                                                        echo $CateProdItem['cateprod_banner_pc'];
                                                                    }
                                                                }} ?>">
                                                            </label>
                                                            <button type="button" data-id-clear-img="cateprod_banner_pc" class="button_clear btn btn_danger" title="Xóa ảnh này">
                                                                <i class="fa fa-trash-o"></i>
                                                            </button>
                                                            </div>
                                                        </div>
                                                    </label>
                                                <?php echo Validation::form_error("cateprod_banner_pc"); ?>
                                                <p class="_cateProd_banner_pc_upload_logo_error_ success " style="color: green; font-size:.9rem; margin:14px 0 0 20px;"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                            <?php else : ?>
                                <p class="data-empty">Không tồn tại danh mục này !</p>
                            <?php endif; ?>
                           
                        </div>
                    </div>
                </div>
            </form>
        </main>
        <?php {{view("Inc.footer");}} ?>
    </div>
    <script type="text/javascript" src="./public/js/config/jquery.min.js"></script>
    <script type="text/javascript" src="./public/js/app/cateProd.add.ajax.js"></script>
    <script type="text/javascript" src="./public/js/app/CateProd_icon.ajax.js"></script>
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
        var metaTitleEl = document.querySelector("#cateprod_meta_title");
        var metaDescEl = document.querySelector("#cateprod_meta_desc");
        var seoUrlEl = document.querySelector("#cateprod_meta_url");

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
            document.querySelector("[name='cateprod_meta_url']").value = slug_string(vl);
            appendKeyWord(slug_string(vl), spaceAppend);
        });


        function appendKeyWord(keyWord, placeAppend) {
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

        // handle notification status add cate new
        var alertStatusAddCateEl = document.querySelector('.alert');
        if (alertStatusAddCateEl !== null) {
            var buttonCloseAlertEl = document.querySelector(".alert .close");
            if (alertStatusAddCateEl.getAttribute('data-status') === 'true') {
                alertStatusAddCateEl.classList.add('open');
                setTimeout(function() {
                    alertStatusAddCateEl.classList.remove('open');
                }, 5000);
            }

            buttonCloseAlertEl.addEventListener('click', function() {
                alertStatusAddCateEl.classList.remove('open');
            });
        }
    </script>
    <?php {{view("Inc.script");}} ?>
</body>

</html>