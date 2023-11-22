-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 22, 2023 lúc 02:42 PM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `shopee`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_user`
--

CREATE TABLE `tbl_user` (
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `avata` varchar(255) DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  `gender` int(11) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `status` int(11) NOT NULL,
  `admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_user`
--

INSERT INTO `tbl_user` (`username`, `password`, `name`, `email`, `phone`, `avata`, `id_user`, `gender`, `date_of_birth`, `status`, `admin`) VALUES
('VanhHung', '28c8edde3d61a0411511d3b1866f0636', 'A', 'aaa', '', NULL, 27, 0, '0000-00-00', 1, 0),
('Vanh', 'c4ca4238a0b923820dcc509a6f75849b', 'Hoang Viet Anh', 'abc@gmail.com', '', 'upload/wallpaperflare.com_wallpaper.jpg', 28, 0, '0000-00-00', 1, 1),
('Hung', '40f5888b67c748df7efba008e7c2f9d2', 'Hoang Viet Hung', 'aaa', '', NULL, 29, 0, '0000-00-00', 1, 0),
('Hoang', '28c8edde3d61a0411511d3b1866f0636', 'Nguyễn Đức Hoàng', 'a', '', NULL, 30, 1, '0000-00-00', 1, 0),
('Thanh', '28c8edde3d61a0411511d3b1866f0636', 'Dinh Tien Thanh', 'a', '', NULL, 31, 0, '0000-00-00', 1, 0),
('Dung', 'c4ca4238a0b923820dcc509a6f75849b', 'Nguyen Tien DUng', 'fhdfhdfh', '46346346', '', 32, 1, '2023-11-15', 1, 1),
('AAA', 'c4ca4238a0b923820dcc509a6f75849b', 'A', 'a', NULL, NULL, 33, NULL, NULL, 1, 0),
('admin', '81dc9bdb52d04dc20036dbd8313ed055', 'nguyen van tien', 'doibatcong2003@gmail.com', NULL, 'upload/Nguyễn Tiến Dũng_VN0000026972.png', 34, NULL, NULL, 1, 0);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
