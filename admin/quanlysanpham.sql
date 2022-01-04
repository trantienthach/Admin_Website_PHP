-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th1 04, 2022 lúc 08:39 AM
-- Phiên bản máy phục vụ: 10.4.21-MariaDB
-- Phiên bản PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `quanlysanpham`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_brand`
--

CREATE TABLE `tbl_brand` (
  `brand_id` int(100) NOT NULL,
  `brand_name` varchar(200) NOT NULL,
  `brand_logo` varchar(500) NOT NULL,
  `brand_order` int(100) NOT NULL,
  `brand_meta_title` varchar(500) NOT NULL,
  `brand_meta_desc` varchar(500) NOT NULL,
  `brand_meta_url` varchar(500) NOT NULL,
  `brand_meta_keywords` varchar(500) NOT NULL,
  `brand_create_date` int(100) NOT NULL,
  `brand_update_date` int(100) DEFAULT NULL,
  `brand_creator_id` int(100) NOT NULL,
  `brand_is_status` enum('on','off') NOT NULL,
  `brand_views` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_brand`
--

INSERT INTO `tbl_brand` (`brand_id`, `brand_name`, `brand_logo`, `brand_order`, `brand_meta_title`, `brand_meta_desc`, `brand_meta_url`, `brand_meta_keywords`, `brand_create_date`, `brand_update_date`, `brand_creator_id`, `brand_is_status`, `brand_views`) VALUES
(9, 'Iphone', 'public/uploads/brands/ed9d875566d96da849e3b564fbfde0c9.png', 1, 'Iphone', 'Iphone', 'iphone', 'Iphone', 1641280944, NULL, 1, 'on', 0),
(10, 'Samsung', 'public/uploads/brands/60e82b9a387967e82c5c3c763479e036.png', 2, 'Samsung', 'Samsung', 'samsung', 'Samsung', 1641280978, NULL, 1, 'on', 0),
(11, 'Dell', 'public/uploads/brands/8342aae091fbc224c9b8d4883b0b0493.png', 3, 'Dell', 'Dell', 'dell', 'Dell', 1641281008, NULL, 1, 'on', 0),
(12, 'Sony', 'public/uploads/brands/ad133f16d8d78697e35fcd34201866bb.png', 4, 'Sony', 'Sony', 'sony', 'Sony', 1641281057, NULL, 1, 'off', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_catenews`
--

CREATE TABLE `tbl_catenews` (
  `catenews_id` int(100) NOT NULL,
  `catenews_name` varchar(200) NOT NULL,
  `catenews_banner_pc` varchar(100) NOT NULL,
  `catenews_banner_mb` varchar(500) NOT NULL,
  `catenews_order` int(100) NOT NULL,
  `catenews_parent_id` int(100) NOT NULL,
  `catenews_meta_title` varchar(500) NOT NULL,
  `catenews_meta_desc` varchar(500) NOT NULL,
  `catenews_meta_url` varchar(500) NOT NULL,
  `catenews_keywords` varchar(500) NOT NULL,
  `catenews_create_date` int(100) NOT NULL,
  `catenews_update_date` int(100) DEFAULT NULL,
  `catenews_creator_id` int(100) NOT NULL,
  `catenews_is_status` enum('on','off') NOT NULL,
  `catenews_views` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_cateprod`
--

CREATE TABLE `tbl_cateprod` (
  `cateprod_id` int(100) NOT NULL,
  `cateprod_name` varchar(200) NOT NULL,
  `cateprod_icon` varchar(100) NOT NULL,
  `cateprod_banner_pc` varchar(500) NOT NULL,
  `cateprod_banner_mb` varchar(500) NOT NULL,
  `cateprod_order` int(100) NOT NULL,
  `cateprod_parent_id` int(100) NOT NULL,
  `cateprod_meta_title` varchar(500) NOT NULL,
  `cateprod_meta_desc` varchar(500) NOT NULL,
  `cateprod_meta_url` varchar(500) NOT NULL,
  `cateprod_meta_keywords` varchar(500) NOT NULL,
  `cateprod_create_date` int(100) NOT NULL,
  `cateprod_update_date` int(100) DEFAULT NULL,
  `cateprod_creator_id` int(100) NOT NULL,
  `cateprod_is_status` enum('on','off') NOT NULL,
  `cateprod_views` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_cateprod`
--

INSERT INTO `tbl_cateprod` (`cateprod_id`, `cateprod_name`, `cateprod_icon`, `cateprod_banner_pc`, `cateprod_banner_mb`, `cateprod_order`, `cateprod_parent_id`, `cateprod_meta_title`, `cateprod_meta_desc`, `cateprod_meta_url`, `cateprod_meta_keywords`, `cateprod_create_date`, `cateprod_update_date`, `cateprod_creator_id`, `cateprod_is_status`, `cateprod_views`) VALUES
(37, 'Điện thoai', 'public/uploads/CateProd/3dde5bb1a0fe58b0e68b5752e2f80701.png', 'public/uploads/CateProd/cc7651f230803021f8d867125008fbd4.png', '', 0, 0, 'Điện thoai', 'Điện thoai', 'dien-thoai', 'Điện thoai', 1641281395, NULL, 1, 'on', 0),
(38, 'Giải trí', 'public/uploads/CateProd/21edb3e6ffa6bc45f7d35229db82d652.png', 'public/uploads/CateProd/fe172dcbc4af496e80cd86c22bb994b3.png', '', 0, 0, 'Giải trí', 'Giải trí', 'giai-tri', 'Giải trí', 1641281596, NULL, 1, 'on', 0),
(39, 'Ipad', 'public/uploads/CateProd/f1e936dbb3049a69d676b04148560447.png', 'public/uploads/CateProd/43e83bd278ecfe0664c47a5128e6cb60.png', '', 0, 38, 'Ipad', 'Ipad', 'ipad', 'Ipad', 1641281635, NULL, 1, 'on', 0),
(40, 'TV', 'public/uploads/CateProd/76d5f5d70948bb9cff631fed801f132f.png', 'public/uploads/CateProd/b0436741466b8732bcb50ad1756669c7.png', '', 0, 38, 'TV', 'TV', 'tv', 'TV', 1641281676, NULL, 1, 'off', 0),
(41, 'ipod', 'public/uploads/CateProd/a1da498a71a3f9c30f14ac90fff6a3d2.jpg', 'public/uploads/CateProd/4602b0bd979ce3675fcdfbf946d91a8c.jpg', '', 0, 39, 'ipod', 'ipod', 'ipod', 'ipod', 1641281699, NULL, 1, 'on', 0),
(42, 'laptop', 'public/uploads/CateProd/dce75de8d405149050175b96544ba268.jpg', 'public/uploads/CateProd/9a32e52e3fa5ff59b67cd90253105a67.jpg', '', 0, 0, 'laptop', 'laptop', 'laptop', 'laptop', 1641281724, NULL, 1, 'on', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_commentnews`
--

CREATE TABLE `tbl_commentnews` (
  `commentnews_id` int(100) NOT NULL,
  `commentnews_time` varchar(500) NOT NULL,
  `commentnews_content` text NOT NULL,
  `commentnews_news_id_ties` int(100) NOT NULL,
  `commentnews_parent_id` int(100) NOT NULL,
  `commentnews_customer_id` int(100) NOT NULL,
  `commentnews_is_status` enum('on','off') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `customer_id` int(100) NOT NULL,
  `customer_fullname` varchar(200) NOT NULL,
  `customer_phone` varchar(200) NOT NULL,
  `customer_email` varchar(500) NOT NULL,
  `customer_regis_date` int(100) NOT NULL,
  `customer_is_active` enum('on','off') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_imgdesc`
--

CREATE TABLE `tbl_imgdesc` (
  `imgdesc_id` int(100) NOT NULL,
  `imgdesc_order` varchar(500) NOT NULL,
  `imgdesc_src` varchar(500) NOT NULL,
  `imgdesc_prod_id_ties` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_news`
--

CREATE TABLE `tbl_news` (
  `news_id` int(100) NOT NULL,
  `news_name` varchar(200) NOT NULL,
  `news_catenews_id_ties` int(100) NOT NULL,
  `news_order` int(100) NOT NULL,
  `news_avatar` varchar(500) NOT NULL,
  `news_video` varchar(500) NOT NULL,
  `news_meta_title` varchar(500) NOT NULL,
  `news_meta_desc` varchar(500) NOT NULL,
  `news_meta_url` varchar(500) NOT NULL,
  `news_meta_keyword` varchar(500) NOT NULL,
  `news_create_date` int(100) NOT NULL,
  `news_update_date` int(100) DEFAULT NULL,
  `news_creator_id` int(100) NOT NULL,
  `news_is_status` enum('on','off') NOT NULL,
  `news_views` int(100) NOT NULL,
  `news_likes` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_prod`
--

CREATE TABLE `tbl_prod` (
  `prod_id` int(100) NOT NULL,
  `prod_name` varchar(200) NOT NULL,
  `prod_code` varchar(50) NOT NULL,
  `prod_avatar` varchar(500) NOT NULL,
  `prod_price_current` int(100) NOT NULL,
  `prod_price_old` int(100) NOT NULL,
  `prod_market` int(100) NOT NULL,
  `prod_cateprod_id_ties` int(100) NOT NULL,
  `prod_brand_id_ties` int(100) NOT NULL,
  `prod_video` varchar(500) NOT NULL,
  `prod_is_installment` enum('1','0') NOT NULL,
  `prod_installment_percentage` int(5) NOT NULL,
  `prod_short_desc` text NOT NULL,
  `prod_content_promo` text NOT NULL,
  `prod_content_specifications` text NOT NULL,
  `prod_content_main_desc` text NOT NULL,
  `prod_order` int(100) NOT NULL,
  `prod_meta_title` varchar(500) NOT NULL,
  `prod_meta_desc` varchar(500) NOT NULL,
  `prod_meta_seourl` varchar(500) NOT NULL,
  `prod_meta_keywords` varchar(500) NOT NULL,
  `prod_create_date` int(100) NOT NULL,
  `prod_update_date` int(100) DEFAULT NULL,
  `prod_creator_id` int(100) NOT NULL,
  `prod_is_status` enum('on','off') NOT NULL,
  `prod_views` int(100) NOT NULL,
  `prod_love` int(100) NOT NULL,
  `prod_amount` int(100) NOT NULL,
  `prod_status_stock` enum('1','2','3','4') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_prod`
--

INSERT INTO `tbl_prod` (`prod_id`, `prod_name`, `prod_code`, `prod_avatar`, `prod_price_current`, `prod_price_old`, `prod_market`, `prod_cateprod_id_ties`, `prod_brand_id_ties`, `prod_video`, `prod_is_installment`, `prod_installment_percentage`, `prod_short_desc`, `prod_content_promo`, `prod_content_specifications`, `prod_content_main_desc`, `prod_order`, `prod_meta_title`, `prod_meta_desc`, `prod_meta_seourl`, `prod_meta_keywords`, `prod_create_date`, `prod_update_date`, `prod_creator_id`, `prod_is_status`, `prod_views`, `prod_love`, `prod_amount`, `prod_status_stock`) VALUES
(5, 'Iphone XR', '30000000', 'public/uploads/Prod/a796de9e338d997ff09c4431d86cf1f9.jpg', 30000000, 0, 0, 0, 0, '', '0', 0, '<p>Iphone XR</p>\r\n', '', '', '<p>Iphone XR</p>\r\n', 0, 'Iphone XR', 'Iphone XR', 'iphone-xr', 'Iphone XR', 1641281808, NULL, 1, 'on', 0, 0, 30000000, '1'),
(6, 'máy tính dell', 'LAP123', 'public/uploads/Prod/3d62ebbe3b3a57ae014a13ed9b7846ae.jpg', 50000000, 0, 0, 0, 0, '', '1', 0, '<p>m&aacute;y t&iacute;nh dell</p>\r\n', '', '', '<p>m&aacute;y t&iacute;nh dell</p>\r\n', 0, 'máy tính dell', 'máy tính dell', 'may-tinh-dell', 'máy tính dell', 1641281919, NULL, 1, 'on', 0, 0, 30000000, '2');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `user_fullname` varchar(200) NOT NULL,
  `user_username` varchar(200) NOT NULL,
  `user_password` varchar(200) NOT NULL,
  `user_gender` enum('male','female') NOT NULL,
  `user_address` varchar(200) NOT NULL,
  `user_avatar` varchar(500) NOT NULL,
  `user_birthday` int(11) NOT NULL,
  `user_phone` varchar(200) NOT NULL,
  `user_email` varchar(200) NOT NULL,
  `user_title` varchar(500) NOT NULL,
  `user_is_active` enum('1','0') NOT NULL,
  `user_is_disable` enum('1','0') NOT NULL,
  `user_numPassword_attempts` int(11) NOT NULL,
  `user_time_login` int(11) NOT NULL,
  `user_token` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_fullname`, `user_username`, `user_password`, `user_gender`, `user_address`, `user_avatar`, `user_birthday`, `user_phone`, `user_email`, `user_title`, `user_is_active`, `user_is_disable`, `user_numPassword_attempts`, `user_time_login`, `user_token`) VALUES
(1, 'Tran Tien Thach', 'trantienthach', '270e9448c7de80b534130e76c9f331f3', 'male', '95 Nguyen Thuong Hien', '', 0, '0788884003', 'thachttps14525@fpt.edu.vn', '', '1', '0', 0, 0, '');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `tbl_brand`
--
ALTER TABLE `tbl_brand`
  ADD PRIMARY KEY (`brand_id`);

--
-- Chỉ mục cho bảng `tbl_catenews`
--
ALTER TABLE `tbl_catenews`
  ADD PRIMARY KEY (`catenews_id`);

--
-- Chỉ mục cho bảng `tbl_cateprod`
--
ALTER TABLE `tbl_cateprod`
  ADD PRIMARY KEY (`cateprod_id`);

--
-- Chỉ mục cho bảng `tbl_commentnews`
--
ALTER TABLE `tbl_commentnews`
  ADD PRIMARY KEY (`commentnews_id`);

--
-- Chỉ mục cho bảng `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Chỉ mục cho bảng `tbl_imgdesc`
--
ALTER TABLE `tbl_imgdesc`
  ADD PRIMARY KEY (`imgdesc_id`);

--
-- Chỉ mục cho bảng `tbl_news`
--
ALTER TABLE `tbl_news`
  ADD PRIMARY KEY (`news_id`);

--
-- Chỉ mục cho bảng `tbl_prod`
--
ALTER TABLE `tbl_prod`
  ADD PRIMARY KEY (`prod_id`);

--
-- Chỉ mục cho bảng `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `tbl_brand`
--
ALTER TABLE `tbl_brand`
  MODIFY `brand_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `tbl_catenews`
--
ALTER TABLE `tbl_catenews`
  MODIFY `catenews_id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tbl_cateprod`
--
ALTER TABLE `tbl_cateprod`
  MODIFY `cateprod_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT cho bảng `tbl_commentnews`
--
ALTER TABLE `tbl_commentnews`
  MODIFY `commentnews_id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `customer_id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tbl_imgdesc`
--
ALTER TABLE `tbl_imgdesc`
  MODIFY `imgdesc_id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tbl_news`
--
ALTER TABLE `tbl_news`
  MODIFY `news_id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tbl_prod`
--
ALTER TABLE `tbl_prod`
  MODIFY `prod_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
