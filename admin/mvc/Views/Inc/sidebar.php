<aside class="aside scroll_custom">
    <div class="profile d_flex align_items_center">
        <div class="logo_user">
            <img width="50" src="./public/images/logo/logo_small.png" alt="">
        </div>
        <div class="info_user">
            <h3 class="user_fullName">Trần Tiến Thạch</h3>
            <small class="user_title">Quản trị viên</small>
        </div>
    </div>
    <ul class="menu">
        <li class="menu-dashboard">
            <a href="">
                <i class="fa fa-dashboard"></i>
                <span>Bảng điều kiển</span>
            </a>
        </li>
        <li class="menu-catalog">
            <a href="" class="parent">
                <i class="fa fa-tags"></i>
                <span>Sản phẩm</span>
            </a>
            <ul class="dropdown_menu">
                <li class="active">
                    <a href="?controller=Categories&action=index">
                        <i class="fa fa-angle-right"></i>
                        <span>Danh mục</span>
                    </a>
                </li>
                <li>
                    <a href="?controller=Brand&action=index">
                        <i class="fa fa-angle-right"></i>
                        <span>Thương hiệu</span>
                    </a>
                </li>
                <li>
                    <a href="?controller=Product">
                        <i class="fa fa-angle-right"></i>
                        <span>Sản phẩm</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-sale">
            <a href="" class="parent">
                <i class="fa fa-shopping-basket"></i>
                <span>Bán hàng</span>
            </a>
            <ul class="dropdown_menu">
                <li class="active">
                    <a href="">
                        <i class="fa fa-angle-right"></i>
                        <span>Khách hàng</span>
                    </a>
                </li>
                <li>
                    <a href="">
                        <i class="fa fa-angle-right"></i>
                        <span>Đơn Hàng</span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
    <div class="process_sale">
        <div class="sale_status_item">
            <div class="d_flex justify_content_between align_items_center">
                <span class="label">Đơn hàng hoàn thành</span>
                <span class="value">0%</span>
            </div>
            <div class="process position_relative">
                <div class="progress_bar position_absolute label_success" style="top: 0; left: 0; height: 100%; width: 20%;"></div>
            </div>
        </div>
        <div class="sale_status_item">
            <div class="d_flex justify_content_between align_items_center">
                <span class="label">Đơn hàng đang xử lý</span>
                <span class="value">0%</span>
            </div>
            <div class="process position_relative">
                <div class="progress_bar position_absolute label_danger" style="top: 0; left: 0; height: 100%; width: 20%;"></div>
            </div>
        </div>
        <div class="sale_status_item">
            <div class="d_flex justify_content_between align_items_center">
                <span class="label">Đơn hàng chờ duyệt</span>
                <span class="value">0%</span>
            </div>
            <div class="process position_relative">
                <div class="progress_bar position_absolute label_warning" style="top: 0; left: 0; height: 100%; width: 20%;"></div>
            </div>
        </div>
    </div>
</aside>