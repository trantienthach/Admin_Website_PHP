<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/css/config/helper.css">
    <link rel="stylesheet" href="./public/css/style/layout.css">
    <link rel="stylesheet" href="./public/css/style/home.css">
    <title>Sản phẩm</title>
</head>
<body>
    <div id="dashboardApp" class="showAside position_relative">
        <?php {{ view("Inc.header"); }} ?>
        <?php {{ view("Inc.sidebar"); }} ?>
        <main class="main_content">
            <div class="page_header">
                <div class="container_fluid d_flex justify_content_between align_items_center">
                    <div class="d_flex align_items_end">
                        <h1>Sản phẩm</h1>
                        <ol class="breadcrumb d_flex align_items_center">
                            <li>
                                <a href="">Trang chủ</a>
                            </li>
                            <li class="active">
                                <a href="">Sản phẩm</a>
                            </li>
                        </ol>
                    </div>
                    <div class="d_flex align_items_center">
                        <a class="btn_item btn_primary" href="<?php echo Config::getBaseUrlAdmin("?controller=Product&action=add"); ?>">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                            <span>Thêm mới</span>
                        </a>
                        <a class="btn_item btn_default" href="">
                            <i class="fa fa-refresh" aria-hidden="true"></i>
                            <span>Làm mới</span>
                        </a>
                    </div>
                </div>

            </div>
            <div class="container_fluid">
                <div class="action_wrap d_flex align_items_center">
                    <div class="page_action_item filter grid_column_4">
                        <div class="value d_flex align_items_center">
                            <div class="form_change_wrap position_relative">
                                <select name="" id="" class="form_control">
                                    <option value="">-- Tác vụ --</option>
                                    <option value="on">Bật</option>
                                    <option value="off">Tắt</option>
                                    <option value="delete">Xóa</option>
                                </select>
                                <button  type="button" class="form_button position_absolute">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                    <span>Chỉnh sửa</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="page_action_item filter grid_column_4">
                        <div class="value d_flex align_items_center">
                            <a class="item <?php {{ echo $dataURL['status']['data'] == "all" ? "active" : null; }} ?>" href="<?php {{ echo Config::getBaseUrlAdmin("?controller=Product&action=index&status=all{$dataURL['orderField']['url']}{$dataURL['orderBy']['url']}{$dataURL['strSearch']['url']}"); }} ?>" class="item <?php {{ echo $dataURL['status']['data'] == "all" ? "active" : null; }} ?>">Tất cả</a>
                            <a class="item <?php {{ echo $dataURL['status']['data'] == "on" ? "active" : null; }} ?>" href="<?php {{ echo Config::getBaseUrlAdmin("?controller=Product&action=index&status=on{$dataURL['orderField']['url']}{$dataURL['orderBy']['url']}{$dataURL['strSearch']['url']}"); }} ?>" class="item <?php {{ echo $dataURL['status']['data'] == "on"  ? "active" : null; }} ?>">Hiện</a>
                            <a class="item <?php {{ echo $dataURL['status']['data'] == "off" ? "active" : null; }} ?>" href="<?php {{ echo Config::getBaseUrlAdmin("?controller=Product&action=index&status=off{$dataURL['orderField']['url']}{$dataURL['orderBy']['url']}{$dataURL['strSearch']['url']}"); }} ?>" class="item <?php {{ echo $dataURL['status']['data'] == "off" ? "active" : null; }} ?>">Ẩn</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table_content container_fluid">
                <!-- // -- Notification -->
                <div class="alert_wrap">
                    <div class="alert position_relative alert_success" data-status="">
                        <i class="fa fa-check-circle" style="margin-right: 5px;"></i>
                        <span></span>
                        <button type="button" class="close position_absolute">x</button>
                    </div>
                </div>
                <!-- // -- Notification -->
                <div class="panel_table">
                    <div class="panel_heading">
                        <h2 class="panel_title">
                            <i class="fa fa-list"></i>
                            <span>Danh sách</span>
                        </h2>
                    </div>
                    <div class="panel_body">
                        <div id="table_content">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td>STT</td>
                                        <td>
                                            <input class="checkAllButton" type="checkbox" name="">
                                        </td>
                                        <td>Hình ảnh</td>
                                        <td>
                                        <a <?php {{ $orderByValue = $dataURL['orderBy']['data'] == 'asc' ? 'desc' : 'asc'; }} ?> href="<?php {{ echo Config::getBaseUrlAdmin("?controller=Product&action=index{$dataURL['status']['url']}&orderField=prod_name&orderBy={$orderByValue}"); }} ?>" class="<?php {{ echo $dataURL['orderBy']['data']; }} ?>">
                                                <span>Tên sản phẩm</span>
                                            </a>
                                        </td>
                                        <td>Model</td>
                                        <td>
                                            <a <?php {{ $orderByValue = $dataURL['orderBy']['data'] == 'asc' ? 'desc' : 'asc'; }} ?> href="<?php {{ echo Config::getBaseUrlAdmin("?controller=Product&action=index{$dataURL['status']['url']}&orderField=prod_price_current&orderBy={$orderByValue}"); }} ?>" class="<?php {{ echo $dataURL['orderBy']['data']; }} ?>">
                                                Giá
                                            </a>
                                        </td>
                                        <td>
                                            <a <?php {{ $orderByValue = $dataURL['orderBy']['data'] == 'asc' ? 'desc' : 'asc'; }} ?> href="<?php {{ echo Config::getBaseUrlAdmin("?controller=Product&action=index{$dataURL['status']['url']}&orderField=prod_create_date&orderBy={$orderByValue}"); }} ?>" class="<?php {{ echo $dataURL['orderBy']['data']; }} ?>">
                                                Ngày tạo                                            
                                            </a>
                                        </td>
                                        <td>
                                            <a <?php {{ $orderByValue = $dataURL['orderBy']['data'] == 'asc' ? 'desc' : 'asc'; }} ?> href="<?php {{ echo Config::getBaseUrlAdmin("?controller=Product&action=index{$dataURL['status']['url']}&orderField=prod_amount&orderBy={$orderByValue}"); }} ?>" class="<?php {{ echo $dataURL['orderBy']['data']; }} ?>">
                                                Số lượng
                                            </a>
                                        </td>
                                        <td>Trạng thái</td>
                                        <td>Cập nhật</td>
                                        <td>Xóa</td>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php if(!empty($listProd)) : ?>
                                        <?php $orderRow = 1; foreach($listProd as $ProdItem) : ?>
                                            <tr data-id ="<?php {{ echo $ProdItem['prod_id'];}} ?>">
                                                <td><?php {{ echo $orderRow ++; }} ?></td>
                                                <td>
                                                    <input class="checkItem" type="checkbox">
                                                </td>
                                                <td class="image">
                                                    <img src="<?php {{ echo $ProdItem['prod_avatar']; }} ?>" alt="">
                                                </td>
                                                <td><?php {{ echo $ProdItem['prod_name']; }} ?></td>
                                                <td><?php {{ echo $ProdItem['prod_code']; }} ?></td>

                                                <td><?php {{ echo $ProdItem['prod_price_current']; }}?></td>
                                                <td><?php {{ echo Format::formatFullDate($ProdItem['prod_create_date']); }} ?></td>
                                                <td><?php {{ echo $ProdItem['prod_amount']; }} ?></td>
                                                <td>
                                                    <div class="toggle_status <?php {{ echo $ProdItem['prod_is_status']; }} ?> position_relative">
                                                        <div class="toggle_group position_absolute">
                                                            <label class="toggle_on btn">Bật</label>
                                                            <label class="toggle_off btn">Tắt</label>
                                                            <span class="toggle_handle"></span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="update">
                                                    <a href="<?php {{ echo Config::getBaseUrlAdmin("?controller=Product&action=update&id={$ProdItem['prod_id']}"); }} ?>">
                                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                    </a>
                                                </td>
                                                <td class="delete">
                                                    <a href="javascript:;">
                                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <tr>
                                            <td colspan="9">
                                                <p class="empty-data-table">Bạn chưa thêm danh mục nào !</p>
                                            </td>
                                        </tr>
                                    <?php endif; ?>                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php if( $totalPage > 1 ) : ?>
                    <div class="pagination_wrap">
                        <?php {{ echo Pagination::getPagination("?controller=Product&action=index{$dataURL['status']['url']}{$dataURL['orderField']['url']}{$dataURL['orderBy']['url']}{$dataURL['strSearch']['url']}&page=", $totalPage, $dataURL['page']['data']); }} ?>
                    </div>
                <?php endif; ?>
            </div>
        </main>
        <?php {{ view("Inc.footer"); }} ?>
    </div>
    <script type="text/javascript" src="./public/js/config/jquery.min.js"></script>
    <script src="<?php echo Config::getBaseUrlAdmin("public/js/app/ProdList.ajax.js") ?>"></script>
    <script class="checked_list">
        let btnCheckAllBtn = document.querySelector("input[type='checkbox'].checkAllButton");
        let listBtnCheck   = document.querySelectorAll("input[type='checkbox'].checkItem");
        btnCheckAllBtn.addEventListener('click', function() {
            if(this.checked) {
                listBtnCheck.forEach(el=> {
                    el.checked = true;
                });
            } else {
                listBtnCheck.forEach(el=> {
                    el.checked = false;
                });
            }
        });
    </script>
    <script class="handle_toggle_input_status">
        let btnToggle = document.querySelectorAll("#table_content table.table tr .toggle_status");
        btnToggle.forEach(el => {
            el.addEventListener('click', function() {
                if(this.classList.contains('on')) {
                    this.classList.remove('on');
                    this.classList.add('off');
                } else {
                    this.classList.remove('off');
                    this.classList.add('on');
                }
            });
        });
    </script>
    <?php {{ view("Inc.script"); }} ?>
</body>
</html>