-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3307
-- Thời gian đã tạo: Th10 30, 2024 lúc 05:40 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `tau_cn`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `adminnv`
--

CREATE TABLE `adminnv` (
  `taikhoan` varchar(20) NOT NULL,
  `matkhau` varchar(20) NOT NULL,
  `hoten` varchar(25) DEFAULT NULL,
  `sodienthoai` varchar(11) DEFAULT NULL,
  `email` varchar(25) DEFAULT NULL,
  `role` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `adminnv`
--

INSERT INTO `adminnv` (`taikhoan`, `matkhau`, `hoten`, `sodienthoai`, `email`, `role`) VALUES
('adminqt2', 'adminqt2', NULL, NULL, NULL, 1),
('adminnv2', 'adminnv2', NULL, NULL, NULL, 2),
('1', '2', '3', '4sdfd', '1@gmail.com', 0),
('23r', '4t4t4gt4t', 'rgtth', '878678674', '3t@gmail.com', 0),
('123', '322232332', 'grgr', '978567567', '323@gmail.com', 0),
('rght', '34ttttt', 'hth', '933435322', '23@gmail.com', 1),
('657', '6hhthtrh23', 'rthrthrth32', '9676600004', '34@gmail.com', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietlich`
--

CREATE TABLE `chitietlich` (
  `machitiet` int(11) NOT NULL,
  `magiave` int(11) NOT NULL,
  `malichtrinh` int(11) NOT NULL,
  `magadi` varchar(11) NOT NULL,
  `giodi` varchar(30) NOT NULL,
  `gioden` varchar(30) NOT NULL,
  `magaden` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `chitietlich`
--

INSERT INTO `chitietlich` (`machitiet`, `magiave`, `malichtrinh`, `magadi`, `giodi`, `gioden`, `magaden`) VALUES
(400, 1, 400, 'GaDN', '54', '21', 'GaHCM'),
(401, 2, 400, 'GaHN', '07 giờ 10 phút', '07 giờ 10 phút', 'GaNA'),
(402, 3, 400, 'GaHN', '07 giờ 10 phút', '07 giờ 10 phút', 'GaDN'),
(403, 1, 400, 'GaTH', '07 giờ 10 phút', '07 giờ 10 phút', 'GaNA'),
(404, 2, 400, 'GaTH', '07 giờ 10 phút', '07 giờ 10 phút', 'GaDN'),
(405, 1, 400, 'GaNA', '07 giờ 10 phút', '07 giờ 10 phút', 'GaDN'),
(422, 1, 1, 'GaHCM', 't', '3r', 'GaDN'),
(500, 1, 500, 'GaHP', '07 giờ 10 phút', '07 giờ 10 phút', 'GaNA'),
(501, 2, 500, 'GaHP', '07 giờ 10 phút', '07 giờ 10 phút', 'GaHCM'),
(502, 1, 500, 'GaNA', '07 giờ 10 phút', '07 giờ 10 phút', 'GaHCM'),
(600, 1, 600, 'GaHCM', '07 giờ 10 phút', '07 giờ 10 phút', 'GaDN'),
(601, 2, 600, 'GaHCM', '07 giờ 10 phút', '07 giờ 10 phút', 'GaNA'),
(602, 3, 600, 'GaHCM', '07 giờ 10 phút', '07 giờ 10 phút', 'GaHD'),
(603, 4, 600, 'GaHCM', '07 giờ 10 phút', '07 giờ 10 phút', 'GaHN'),
(1231, 2, 2222, 'GaDN', '43', '523', 'GaPT'),
(3333, 2, 98783, 'GaHD', '43', '523', 'GaHCM'),
(5654, 3, 1, 'GaDN', '15:22', '17:20', 'GaHCM'),
(54534, 1, 400, 'GaDN', 'ewf3', '234', 'GaHCM'),
(545346, 2, 1, 'GaDN', '17:58', '19:58', 'GaDN'),
(5453412, 2, 1, 'GaDN', '23', '12', 'GaHCM');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `gadi`
--

CREATE TABLE `gadi` (
  `maga` varchar(11) NOT NULL,
  `tengadi` varchar(30) NOT NULL,
  `tengaden` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `gadi`
--

INSERT INTO `gadi` (`maga`, `tengadi`, `tengaden`) VALUES
('GaDN', 'Ga Đà Nẵng', '	 Ga Đà Nẵng'),
('GaHCM', 'Ga TP.HCM', 'Ga TP.HCM'),
('GaHD', 'Ga Hải Dương', 'Ga Hải Dương'),
('GaHN', 'Ga Hà Nội', 'Ga Hà Nội'),
('GaHP', 'Ga Hải Phòng', 'Ga Hải Phòng'),
('GaNA', 'Ga Nghệ An', 'Ga Nghệ An'),
('GaPT', 'Ga Phú Thọ', 'Ga Phú Thọ'),
('GaTH', 'Ga Thanh Hóa', 'Ga Thanh Hóa');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ghe`
--

CREATE TABLE `ghe` (
  `maghe` int(11) NOT NULL,
  `tenghe` varchar(255) DEFAULT NULL,
  `matoa` int(11) DEFAULT NULL,
  `tinhtrangghe` bit(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `ghe`
--

INSERT INTO `ghe` (`maghe`, `tenghe`, `matoa`, `tinhtrangghe`) VALUES
(44, 'Ghế 44', 402, b'01'),
(45, 'Ghế 45', 402, b'00'),
(46, 'Ghế 46', 403, b'00'),
(47, 'Ghế 47', 403, b'00'),
(51, 'Ghế 51', 500, b'00'),
(53, 'Ghế 53', 501, b'00'),
(54, 'Ghế 54', 502, b'00'),
(55, 'Ghế 55', 502, b'00'),
(56, 'Ghế 56', 503, b'00'),
(57, 'Ghế 57', 503, b'00'),
(60, 'Ghế 60', 600, b'00'),
(61, 'Ghế 61', 600, b'00'),
(62, 'Ghế 62', 601, b'00'),
(63, 'Ghế 63', 601, b'00'),
(64, 'Ghế 64', 602, b'00'),
(65, 'Ghế 65', 602, b'00'),
(66, 'Ghế 66', 603, b'00'),
(67, 'Ghế 67', 603, b'00'),
(70, 'Ghế 70', 700, b'00'),
(71, 'Ghế 71', 700, b'00'),
(72, 'Ghế 72', 701, b'00'),
(73, 'Ghế 73', 701, b'00'),
(74, 'Ghế 74', 702, b'00'),
(75, 'Ghế 75', 702, b'00'),
(76, 'Ghế 76', 703, b'00'),
(77, 'Ghế 77', 703, b'00'),
(84, 'Ghế 84', 402, b'00'),
(85, 'Ghế 85', 402, b'00'),
(86, 'Ghế 86', 403, b'00'),
(87, 'Ghế 87', 403, b'00'),
(90, 'Ghế 90', 900, b'00'),
(91, 'Ghế 91', 900, b'00'),
(92, 'Ghế 92', 901, b'00'),
(93, 'Ghế 93', 901, b'00'),
(94, 'Ghế 94', 902, b'00'),
(95, 'Ghế 95', 902, b'00'),
(96, 'Ghế 96', 903, b'00'),
(97, 'Ghế 97', 903, b'00'),
(100, 'Ghế 100', 1000, b'00'),
(101, 'Ghế 101', 1000, b'00'),
(102, 'Ghế 102', 1001, b'00'),
(103, 'Ghế 103', 1001, b'00'),
(104, 'Ghế 104', 1002, b'00'),
(105, 'Ghế 105', 1002, b'00'),
(106, 'Ghế 106', 1003, b'00'),
(107, 'Ghế 107', 1003, b'00'),
(110, 'Ghế 110', 1100, b'00'),
(111, 'Ghế 111', 1100, b'00'),
(112, 'Ghế 112', 1101, b'00'),
(113, 'Ghế 113', 1101, b'00'),
(114, 'Ghế 114', 1102, b'00'),
(115, 'Ghế 115', 1102, b'00'),
(116, 'ghế 01', 401, b'00'),
(117, 'ghế 02', 401, b'00'),
(118, 'ghế 03', 401, b'00'),
(119, 'ghế 04', 401, b'00'),
(120, 'ghế 05', 401, b'00'),
(121, 'ghế 06', 401, b'00'),
(122, 'ghế 07', 401, b'00'),
(123, 'ghế 08', 401, b'00'),
(124, 'ghế 09', 401, b'00'),
(125, 'ghế 10', 401, b'00'),
(126, 'ghế 11', 401, b'00'),
(127, 'ghế 12', 401, b'00'),
(128, 'ghế 13', 401, b'00'),
(129, 'ghế 14', 401, b'00'),
(130, 'ghế 15', 401, b'00'),
(131, 'ghế 16', 401, b'00'),
(132, 'ghế 17', 401, b'00'),
(133, 'ghế 18', 401, b'00'),
(134, 'ghế 19', 401, b'00'),
(135, 'ghế 20', 401, b'00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giave`
--

CREATE TABLE `giave` (
  `magiave` int(11) NOT NULL,
  `giatien` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `giave`
--

INSERT INTO `giave` (`magiave`, `giatien`) VALUES
(1, 20000023),
(2, 400000),
(3, 600000),
(4, 800000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lichtrinh`
--

CREATE TABLE `lichtrinh` (
  `malichtrinh` int(11) NOT NULL,
  `tenlichtrinh` varchar(120) NOT NULL,
  `ngaykhoihanh` date DEFAULT NULL,
  `ngayketthuc` date DEFAULT NULL,
  `matau` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `lichtrinh`
--

INSERT INTO `lichtrinh` (`malichtrinh`, `tenlichtrinh`, `ngaykhoihanh`, `ngayketthuc`, `matau`) VALUES
(1, 'vdvdvdjhg', '2024-11-01', '2024-11-10', 400),
(400, 'Hà Nội - Thanh Hóa - Nghệ An - Đà Nẵng', '2024-01-01', '2024-01-01', 400),
(500, 'Hải Phòng -TPHCM', '0000-00-00', '0000-00-00', 500),
(600, 'TPHCM - Hà Nội', '2024-01-01', '2024-01-01', 600),
(700, 'Hà Nội - Thanh Hóa', '2024-01-01', '2024-01-01', 700),
(800, 'Hà Nội - Thanh Hóa - Nghệ An - Đà Nẵng', '2024-01-01', '2024-01-01', 800),
(2222, '123', '2024-11-14', '2024-11-13', 1000),
(9878, '344tg4t', '2024-11-02', '2024-11-02', 400),
(98783, '44efe', '2024-11-28', '2024-11-28', 500);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phieudat`
--

CREATE TABLE `phieudat` (
  `maphieu` int(11) NOT NULL,
  `tenkhach` varchar(40) NOT NULL,
  `sodienthoai` varchar(33) NOT NULL,
  `machitiet` int(11) NOT NULL,
  `maghe` int(11) DEFAULT NULL,
  `tinhtrangve` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `phieudat`
--

INSERT INTO `phieudat` (`maphieu`, `tenkhach`, `sodienthoai`, `machitiet`, `maghe`, `tinhtrangve`) VALUES
(1, 'Hoang Van Thong', '096156', 400, 42, b'1'),
(2, 'Hoang Van Thong', '096150080', 401, NULL, b'1'),
(3, 'Hoang Van Thong', '096150080', 402, NULL, b'1'),
(4, 'Hoang Van Thong', '096150080', 403, 46, b'1'),
(6, 'Thống', '5555555 ', 400, 47, b'0'),
(7, 'Thống', '0999 ', 400, NULL, b'0'),
(8, 'Thống', '0999 ', 400, NULL, b'0'),
(9, 'hoàng minh', '0961500807 ', 400, NULL, b'0'),
(10, 'hoàng minh', '0961500807 ', 400, NULL, b'0'),
(11, 'Hoang Van Thong', '09615', 500, NULL, b'1'),
(12, 'Hoang Van Minh', '096150080', 501, NULL, b'1'),
(13, 'Nguyễn Van Thong', '096150453', 602, NULL, b'0'),
(14, 'Nguyễn Đức Huy', '0961523451', 603, NULL, b'1'),
(16, 'Hoàng hứa', '5555555 ', 600, NULL, b'0'),
(17, 'Hoàng Cầu', '099945245 ', 600, NULL, b'1'),
(18, 'Thống', '09992783 ', 500, NULL, b'0'),
(19, 'Phan minh', '0357878678 ', 500, NULL, b'0'),
(20, 'Đỗ minh', '035787882 ', 500, NULL, b'1'),
(123124, 'thhrhrh', 'rhrhrhrh ', 400, NULL, b'0'),
(123125, 'jh', '088675556644 ', 400, NULL, b'0'),
(123126, 'jh', '088675556644 ', 400, NULL, b'0'),
(123127, 'jh', '088675556644 ', 400, NULL, b'0'),
(123239, '345', '34534', 400, 45, b'0');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tau`
--

CREATE TABLE `tau` (
  `matau` int(11) NOT NULL,
  `tentau` varchar(255) DEFAULT NULL,
  `diemdau` varchar(33) NOT NULL,
  `diemcuoi` varchar(33) NOT NULL,
  `giokhoihanh` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tau`
--

INSERT INTO `tau` (`matau`, `tentau`, `diemdau`, `diemcuoi`, `giokhoihanh`) VALUES
(400, 'Tàu 04', 'Ga Hà Nội', 'Ga Đà Nẵng', '2024-01-14 02:02:21.000000'),
(500, 'Tàu 05', 'Ga Hà Nội', 'Ga Đà Nẵng', '2024-01-14 02:02:21.000000'),
(600, 'Tàu 06', 'Ga TPHCM', 'Ga Hà Nội', '2024-01-20 02:04:06.000000'),
(700, 'Tàu 07', 'Ga Hà Nội', 'Ga Thanh Hóa', '2024-01-20 02:04:05.000000'),
(800, 'Tàu 08', 'Ga Thanh Hóa', 'Ga Hà Nội', '2024-07-14 02:02:21.000000'),
(900, 'Tàu 09', 'Ga Hải Dương', 'Ga Đà Nẵng', '2024-09-14 02:02:21.000000'),
(1000, 'Tàu 10', 'Ga TPHCM', 'Ga Hà Nội', '2024-05-20 02:04:06.000000'),
(1100, 'Tàu 11', 'Ga Hà Nội', 'Ga Nghệ An', '2024-04-20 02:04:05.000000'),
(12341, '12414', '124124', '12412', '2024-01-25 23:33:00.000000');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `toa`
--

CREATE TABLE `toa` (
  `matoa` int(11) NOT NULL,
  `tentoa` varchar(255) DEFAULT NULL,
  `matau` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `toa`
--

INSERT INTO `toa` (`matoa`, `tentoa`, `matau`) VALUES
(401, 'toa 401 Thường', 400),
(402, 'Toa 402 VIP', 400),
(403, 'Toa 403 Trung', 400),
(500, 'Toa 50', 500),
(501, 'Toa 51', 500),
(502, 'Toa 52', 500),
(503, 'Toa 53', 500),
(600, 'Toa 60', 600),
(601, 'Toa 61', 600),
(602, 'Toa 62', 600),
(603, 'Toa 63', 600),
(700, 'Toa 70', 700),
(701, 'Toa 71', 700),
(702, 'Toa 72', 700),
(703, 'Toa 73', 700),
(802, 'Toa 82', 800),
(803, 'Toa 83', 800),
(900, 'Toa 90', 900),
(901, 'Toa 91', 900),
(902, 'Toa 92', 900),
(903, 'Toa 93', 900),
(1000, 'Toa 100', 1000),
(1001, 'Toa 101', 1000),
(1002, 'Toa 102', 1000),
(1003, 'Toa 103', 1000),
(1100, 'Toa 110', 1100),
(1101, 'Toa 111', 1100),
(1102, 'Toa 112', 1100);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `chitietlich`
--
ALTER TABLE `chitietlich`
  ADD PRIMARY KEY (`machitiet`),
  ADD KEY `FK_chitiet_giave` (`magiave`),
  ADD KEY `FK_chitiet_gadi` (`magadi`),
  ADD KEY `FK_chitiet_lichtrinh` (`malichtrinh`),
  ADD KEY `FK_chitiet_gadi2` (`magaden`);

--
-- Chỉ mục cho bảng `gadi`
--
ALTER TABLE `gadi`
  ADD PRIMARY KEY (`maga`);

--
-- Chỉ mục cho bảng `ghe`
--
ALTER TABLE `ghe`
  ADD PRIMARY KEY (`maghe`),
  ADD KEY `FK_ghe_toa` (`matoa`);

--
-- Chỉ mục cho bảng `giave`
--
ALTER TABLE `giave`
  ADD PRIMARY KEY (`magiave`);

--
-- Chỉ mục cho bảng `lichtrinh`
--
ALTER TABLE `lichtrinh`
  ADD PRIMARY KEY (`malichtrinh`),
  ADD KEY `FK_lichtrinh_tau` (`matau`);

--
-- Chỉ mục cho bảng `phieudat`
--
ALTER TABLE `phieudat`
  ADD PRIMARY KEY (`maphieu`),
  ADD KEY `FK_phieudat_chitietlich` (`machitiet`);

--
-- Chỉ mục cho bảng `tau`
--
ALTER TABLE `tau`
  ADD PRIMARY KEY (`matau`);

--
-- Chỉ mục cho bảng `toa`
--
ALTER TABLE `toa`
  ADD PRIMARY KEY (`matoa`),
  ADD KEY `matau` (`matau`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `ghe`
--
ALTER TABLE `ghe`
  MODIFY `maghe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT cho bảng `phieudat`
--
ALTER TABLE `phieudat`
  MODIFY `maphieu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123240;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `chitietlich`
--
ALTER TABLE `chitietlich`
  ADD CONSTRAINT `FK_chitiet_gadi` FOREIGN KEY (`magadi`) REFERENCES `gadi` (`maga`),
  ADD CONSTRAINT `FK_chitiet_gadi2` FOREIGN KEY (`magaden`) REFERENCES `gadi` (`maga`),
  ADD CONSTRAINT `FK_chitiet_giave` FOREIGN KEY (`magiave`) REFERENCES `giave` (`magiave`),
  ADD CONSTRAINT `FK_chitiet_lichtrinh` FOREIGN KEY (`malichtrinh`) REFERENCES `lichtrinh` (`malichtrinh`);

--
-- Các ràng buộc cho bảng `ghe`
--
ALTER TABLE `ghe`
  ADD CONSTRAINT `FK_ghe_toa` FOREIGN KEY (`matoa`) REFERENCES `toa` (`matoa`);

--
-- Các ràng buộc cho bảng `lichtrinh`
--
ALTER TABLE `lichtrinh`
  ADD CONSTRAINT `FK_lichtrinh_tau` FOREIGN KEY (`matau`) REFERENCES `tau` (`matau`);

--
-- Các ràng buộc cho bảng `phieudat`
--
ALTER TABLE `phieudat`
  ADD CONSTRAINT `FK_phieudat_chitietlich` FOREIGN KEY (`machitiet`) REFERENCES `chitietlich` (`machitiet`);

--
-- Các ràng buộc cho bảng `toa`
--
ALTER TABLE `toa`
  ADD CONSTRAINT `FK_toa_tau` FOREIGN KEY (`matau`) REFERENCES `tau` (`matau`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
