<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/css/config/helper.css">
    <link rel="stylesheet" href="./public/css/style/layout.css">
    <link rel="stylesheet" href="./public/css/style/home.css">
    <title>Bảng điều khiển</title>
</head>
<body>
    <div id="dashboardApp" class="position_relative">
        <?php {{ view("Inc.header"); }} ?>
        <?php {{ view("Inc.sidebar"); }} ?>
        <main class="main_content">
            <div class="page_header">
                <div class="container_fluid">
                    <div class="d_flex align_items_end">
                        <h1>Bảng Điều Khiển</h1>
                        <ol class="breadcrumb d_flex align_items_center">
                            <li>
                                <a href="">Trang chủ</a>
                            </li>
                            <li class="active">
                                <a href="">Bảng Điều khiển</a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="page_content container_fluid">
                <div class="page_row_item grid_row">
                    <div class="box_content_item grid_column_3">
                        <div class="box_wrap">
                            <div class="heading d_flex justify_content_between align_items_center">
                                <span class="title">TỔNG SỐ ĐƠN HÀNG</span>
                                <span class="value">0%</span>
                            </div>
                            <div class="body d_flex justify_content_between align_items_center">
                                <i class="fa fa-shopping-cart"></i>
                                <span class="value">10</span>
                            </div>
                            <div class="footer">
                                <a href="">Xem thêm...</a>
                            </div>
                        </div>
                    </div>
                    <div class="box_content_item grid_column_3">
                        <div class="box_wrap">
                            <div class="heading d_flex justify_content_between align_items_center">
                                <span class="title">DOANH SỐ</span>
                                <span class="value">0%</span>
                            </div>
                            <div class="body d_flex justify_content_between align_items_center">
                                <i class="fa fa-credit-card"></i>
                                <span class="value">100M</span>
                            </div>
                            <div class="footer">
                                <a href="">Xem thêm...</a>
                            </div>
                        </div>
                    </div>
                    <div class="box_content_item grid_column_3">
                        <div class="box_wrap">
                            <div class="heading d_flex justify_content_between align_items_center">
                                <span class="title">TỔNG SỐ KHÁCH HÀNG</span>
                                <span class="value">0%</span>
                            </div>
                            <div class="body d_flex justify_content_between align_items_center">
                                <i class="fa fa-user"></i>
                                <span class="value">10</span>
                            </div>
                            <div class="footer">
                                <a href="">Xem thêm...</a>
                            </div>
                        </div>
                    </div>
                    <div class="box_content_item grid_column_3">
                        <div class="box_wrap">
                            <div class="heading d_flex justify_content_between align_items_center">
                                <span class="title">KHÁCH ĐANG TRUY CẬP</span>
                                <span class="value">0%</span>
                            </div>
                            <div class="body d_flex justify_content_between align_items_center">
                                <i class="fa fa-users"></i>
                                <span class="value">10</span>
                            </div>
                            <div class="footer">
                                <a href="">Xem thêm...</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel_row_item grid_row">
                    <div class="panel_content_item grid_column_6">
                        <div class="panel_box">
                            <div class="panel_heading">
                                <h3 class="panel_title">
                                    <i class="fa fa-support"></i>
                                    <span class="title">Hỗ trợ trực tuyến</span>
                                </h3>
                            </div>
                            <div class="panel_body">
                                <div class="media d_flex">
                                    <a class="media_left" href="tel:0385763717">
                                        <img src="./public/images/logo/hn.png" width="70" alt="">
                                    </a>
                                    <div class="media_right">
                                        <h5 class="media_heading">
                                            <strong>Tư vấn online</strong>
                                            <span>- Hỗ trợ tại Hà Nội</span>
                                        </h5>
                                        <p class="media_content">
                                            <span class="label">Điện thoại:</span>
                                            <a href="tel:0385763717" class="d_inline">038.5763.717</a>
                                        </p>
                                        <p class="media_content">
                                            <span class="label">Email:</span>
                                            <a href="mailTo:phamdinhhung212@gmail.com" class="d_inline">phamdinhhung212@gmail.com</a>
                                        </p>
                                    </div>
                                </div>
                                <div class="media d_flex">
                                    <a class="media_left" href="tel:0385763717">
                                        <img src="./public/images/logo/hn.png" width="70" alt="">
                                    </a>
                                    <div class="media_right">
                                        <h5 class="media_heading">
                                            <strong>Tư vấn online</strong>
                                            <span>- Hỗ trợ tại Hà Nội</span>
                                        </h5>
                                        <p class="media_content">
                                            <span class="label">Điện thoại:</span>
                                            <a href="tel:0385763717" class="d_inline">038.5763.717</a>
                                        </p>
                                        <p class="media_content">
                                            <span class="label">Email:</span>
                                            <a href="mailTo:phamdinhhung212@gmail.com" class="d_inline">phamdinhhung212@gmail.com</a>
                                        </p>
                                    </div>
                                </div>
                                <div class="media d_flex">
                                    <a class="media_left" href="tel:0385763717">
                                        <img src="./public/images/logo/hn.png" width="70" alt="">
                                    </a>
                                    <div class="media_right">
                                        <h5 class="media_heading">
                                            <strong>Tư vấn online</strong>
                                            <span>- Hỗ trợ tại Hà Nội</span>
                                        </h5>
                                        <p class="media_content">
                                            <span class="label">Điện thoại:</span>
                                            <a href="tel:0385763717" class="d_inline">038.5763.717</a>
                                        </p>
                                        <p class="media_content">
                                            <span class="label">Email:</span>
                                            <a href="mailTo:phamdinhhung212@gmail.com" class="d_inline">phamdinhhung212@gmail.com</a>
                                        </p>
                                    </div>
                                </div>
                                <div class="media d_flex">
                                    <a class="media_left" href="tel:0385763717">
                                        <img src="./public/images/logo/hn.png" width="70" alt="">
                                    </a>
                                    <div class="media_right">
                                        <h5 class="media_heading">
                                            <strong>Tư vấn online</strong>
                                            <span>- Hỗ trợ tại Hà Nội</span>
                                        </h5>
                                        <p class="media_content">
                                            <span class="label">Điện thoại:</span>
                                            <a href="tel:0385763717" class="d_inline">038.5763.717</a>
                                        </p>
                                        <p class="media_content">
                                            <span class="label">Email:</span>
                                            <a href="mailTo:phamdinhhung212@gmail.com" class="d_inline">phamdinhhung212@gmail.com</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel_content_item grid_column_6">
                        <div class="panel_box">
                            <div class="panel_heading">
                                <h3 class="panel_title">
                                    <i class="fa fa-support"></i>
                                    <span class="title">Hỗ trợ trực tuyến</span>
                                </h3>
                            </div>
                            <div class="panel_body"></div>
                        </div>
                    </div>
                    <div class="panel_content_item grid_column_6">
                        <div class="panel_box">
                            <div class="panel_heading">
                                <h3 class="panel_title">
                                    <i class="fa fa-support"></i>
                                    <span class="title">Hỗ trợ trực tuyến</span>
                                </h3>
                            </div>
                            <div class="panel_body"></div>
                        </div>
                    </div>
                    <div class="panel_content_item grid_column_6">
                        <div class="panel_box">
                            <div class="panel_heading">
                                <h3 class="panel_title">
                                    <i class="fa fa-bar-chart-o"></i>
                                    <span class="title">Thống kê Bán hàng</span>
                                </h3>
                            </div>
                            <div class="panel_body"></div>
                        </div>
                    </div>
                    <div class="panel_content_item grid_column_4">
                        <div class="panel_box">
                            <div class="panel_heading">
                                <h3 class="panel_title">
                                    <i class="fa fa-bar-chart-o"></i>
                                    <span class="title">Thống kê Bán hàng</span>
                                </h3>
                            </div>
                            <div class="panel_body"></div>
                        </div>
                    </div>
                    <div class="panel_content_item grid_column_8">
                        <div class="panel_box">
                            <div class="panel_heading">
                                <h3 class="panel_title">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span class="title">Đơn hàng mới nhất</span>
                                </h3>
                            </div>
                            <div class="table_wrap">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <td>Mã đơn hàng</td>
                                            <td>Tên khách hàng</td>
                                            <td>Trạng thái</td>
                                            <td>Thời gian đặt hàng</td>
                                            <td>Thành tiền</td>
                                            <td>Tác vụ</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>#TINB1</td>
                                            <td>
                                                <a href="">Phạm Đình Hùng</a>
                                            </td>
                                            <td>Chờ xử lý</td>
                                            <td>(09:10) 23/11/2020</td>
                                            <td>4.935.000đ</td>
                                            <td>
                                                <a href="" class="fa fa-eye view"></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>#TINB1</td>
                                            <td>
                                                <a href="">Phạm Đình Hùng</a>
                                            </td>
                                            <td>Chờ xử lý</td>
                                            <td>(09:10) 23/11/2020</td>
                                            <td>4.935.000đ</td>
                                            <td>
                                                <a href="" class="fa fa-eye view"></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>#TINB1</td>
                                            <td>
                                                <a href="">Phạm Đình Hùng</a>
                                            </td>
                                            <td>Chờ xử lý</td>
                                            <td>(09:10) 23/11/2020</td>
                                            <td>4.935.000đ</td>
                                            <td>
                                                <a href="" class="fa fa-eye view"></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>#TINB1</td>
                                            <td>
                                                <a href="">Phạm Đình Hùng</a>
                                            </td>
                                            <td>Chờ xử lý</td>
                                            <td>(09:10) 23/11/2020</td>
                                            <td>4.935.000đ</td>
                                            <td>
                                                <a href="" class="fa fa-eye view"></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>#TINB1</td>
                                            <td>
                                                <a href="">Phạm Đình Hùng</a>
                                            </td>
                                            <td>Chờ xử lý</td>
                                            <td>(09:10) 23/11/2020</td>
                                            <td>4.935.000đ</td>
                                            <td>
                                                <a href="" class="fa fa-eye view"></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <?php {{ view("Inc.footer"); }} ?>
    </div>
    <?php {{ view("Inc.script"); }} ?>
</body>
</html>