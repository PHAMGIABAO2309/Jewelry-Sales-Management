-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 23, 2025 lúc 05:25 AM
-- Phiên bản máy phục vụ: 9.1.0
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `webbanvang`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietdanhmuc`
--

CREATE TABLE `chitietdanhmuc` (
  `MaCTDM` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `TenCTDM` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `MaDM` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `MoTa` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `chitietdanhmuc`
--

INSERT INTO `chitietdanhmuc` (`MaCTDM`, `TenCTDM`, `MaDM`, `MoTa`) VALUES
('CTDM01', 'Mai Trăm Năm', 'DM01', 'Mai vàng trong sắc xuân mang theo những niềm vui và hứng khởi, đó cũng chính là cảm hứng trong bộ trang sức cưới Mai Trăm Năm. Với ý nghĩa vui tươi và ý niệm khởi đầu hạnh phúc, trang sức Mai Trăm Năm đồng hành cùng cặp đôi uyên ương trong ngày hỷ sự.'),
('CTDM02', 'Giao thời 2024', 'DM01', 'Cảm hứng từ sắc màu của ánh sáng, từng giác cắt CNC phô diễn sự lộng lẫy trong mỗi tuyệt tác trang sức GIAO THỜI. Bộ sưu tập là kết tinh của vẻ đẹp, sự nỗ lực hướng về phía trước của phái đẹp hiện đại – những người phụ nữ xinh đẹp – độc lập và tự tin.'),
('CTDM03', 'Dấu ấn phái mạnh 2024', 'DM01', 'Phái Mạnh sau những nỗ lực đương đầu thử thách, hoàn thiện bản thân mỗi ngày với tôn chỉ lịch thiệp, bản lĩnh và thành công. Trên nấc thang vững chãi ấy, trang sức nam NTJ chính là ngôn ngữ thay lời khẳng định vị thế của những Quý Ông thời đại.'),
('CTDM04', 'Giáp Thìn phú quý', 'DM01', 'Đánh dấu một cột mốc 2024 thuận lợi và may mắn, gói trọn những hy vọng về một năm thịnh vượng, phát đạt qua những tuyệt tác dành riêng cho dịp vía Thần Tài 2024.'),
('CTDM05', 'Magical stone', 'DM01', '“Bữa tiệc” ánh sáng từ đá Swarovski lấp lánh cùng hiệu ứng chuyển động bắt mắt, Magical Stone là phiên bản trang sức đặc biệt cùng nàng khuấy đảo mùa lễ hội cuối năm.'),
('CTDM06', 'Bách phúc trường an', 'DM01', 'Dung hòa giữa dòng chảy thời trang và văn hóa Đông Phương, BST khắc họa dấu ấn thiết kế hiện đại pha trộn cảm hứng truyền thống, biểu trưng cho dung mạo quý phái, lan tỏa phúc khí và may mắn của những quý cô.'),
('CTDM07', 'Cúc viên mãn', 'DM01', 'Lấy cảm hứng từ hoa cúc – loài hoa của niềm vui và sự hân hoan. Bộ sưu tập Cúc Viên Mãn khắc hoạ thế giới tình yêu ngập tràn sự lạc quan và tươi mới, mang ý niệm về hạnh phúc viên mãn và sự gắn kết trọn đời của tình yêu đích thực.'),
('CTDM08', 'Én uyên ương', 'DM01', 'Vẽ nên bầu trời mùa xuân lãng mạn và tràn đầy hạnh phúc, mỗi tuyệt tác trang sức cưới trong BST Én Uyên Ương là minh chứng cho khoảnh khắc những yêu thương đơm hoa nở rộ, đồng hành cùng tình yêu vĩnh cửu của lứa đôi. Hình tượng đàn én vàng uyển chuyển vút'),
('CTDM10', 'Vàng', 'DM02', 'Vàng là biểu tượng của sự vĩnh cửu, thịnh vượng và cao quý. Từng sản phẩm được chế tác tỉ mỉ, tôn vinh giá trị truyền thống và phong cách hiện đại tinh tế.'),
('CTDM11', 'Cưới', 'DM02', 'Bộ sưu tập cưới mang đến sự tinh tế và ý nghĩa sâu sắc, là minh chứng cho tình yêu vĩnh cửu, hòa quyện vẻ đẹp truyền thống và hiện đại.'),
('CTDM13', 'Đá màu Swarovski', 'DM02', 'Đá màu Swarovski với sắc màu tinh tế và lấp lánh, mang đến vẻ đẹp rạng ngời, sang trọng cho các món trang sức thời thượng.'),
('CTDM14', 'Đá màu tổng hợp', 'DM02', 'Đá màu tổng hợp với đa dạng màu sắc, mang lại vẻ đẹp nổi bật và sự lựa chọn phong phú cho các bộ trang sức độc đáo.'),
('CTDM15', 'Cẩm thạch', 'DM02', 'Cẩm thạch là loại đá quý tự nhiên với vân sắc độc đáo, mang đến vẻ đẹp sang trọng, đầy huyền bí cho các sản phẩm trang sức.'),
('CTDM16', 'Ngọc trai', 'DM02', 'Ngọc trai là biểu tượng của sự thanh cao và quý phái, mang lại vẻ đẹp tự nhiên và sang trọng cho những món trang sức đặc biệt.'),
('CTDM19', 'Nhẫn nữ', 'DM03', 'Nhẫn nữ tinh tế và duyên dáng, mang đến vẻ đẹp nhẹ nhàng nhưng đầy quyến rũ cho phái đẹp. Mỗi chiếc nhẫn được thiết kế tỉ mỉ, là món trang sức không thể thiếu cho các dịp đặc biệt, từ những bữa tiệc sang trọng đến những cuộc gặp gỡ lãng mạn.'),
('CTDM20', 'Nhẫn nam', 'DM03', 'Nhẫn nam mạnh mẽ và đầy cá tính, thể hiện sự phong trần và đẳng cấp của phái mạnh. Thiết kế hiện đại kết hợp với chất liệu cao cấp mang đến vẻ đẹp lịch lãm và mạnh mẽ, là món đồ không thể thiếu trong bộ sưu tập của những người đàn ông thời thượng.'),
('CTDM21', 'Nhẫn cưới', 'DM03', 'Nhẫn cưới là biểu tượng thiêng liêng của tình yêu và sự gắn kết vĩnh cửu giữa hai người. Mỗi chiếc nhẫn cưới được thiết kế tỉ mỉ, đại diện cho sự chung thủy, tình yêu bền lâu và những khoảnh khắc ngọt ngào của cặp đôi trong hành trình suốt đời.'),
('CTDM22', 'Bông tai', 'DM03', 'Bông tai là món trang sức làm nổi bật nét duyên dáng và quyến rũ của người phụ nữ. Với thiết kế đa dạng, từ tinh tế đến sang trọng, bông tai có thể dễ dàng kết hợp với mọi trang phục, tạo nên phong cách thanh lịch và nổi bật trong mọi dịp.'),
('CTDM23', 'Mặt dây chuyền', 'DM03', 'Mặt dây chuyền là món trang sức thanh lịch, phù hợp cho mọi dịp từ hàng ngày đến các sự kiện quan trọng. Với thiết kế sang trọng và tinh tế, mặt dây chuyền không chỉ làm đẹp mà còn thể hiện cá tính riêng biệt của người sở hữu, mang lại sự thu hút đặc biệt'),
('CTDM24', 'Dây chuyền', 'DM03', 'Dây chuyền là món trang sức tuyệt vời, không thể thiếu cho những ai yêu thích vẻ đẹp sang trọng và quý phái. Chất liệu cao cấp và thiết kế tinh xảo mang lại vẻ đẹp hoàn hảo, tôn lên vẻ quyến rũ và phong cách của chủ nhân trong mỗi dịp đặc biệt.'),
('CTDM25', 'Lắc tay', 'DM03', 'Lắc tay là món trang sức nữ tính, duyên dáng, giúp tôn lên vẻ đẹp mềm mại của người phụ nữ. Với thiết kế tinh tế và sang trọng, lắc tay không chỉ tạo nên điểm nhấn hoàn hảo cho bộ trang phục mà còn là món quà đầy ý nghĩa cho những người thân yêu.');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danhmuc`
--

CREATE TABLE `danhmuc` (
  `MaDM` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `TenDM` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `danhmuc`
--

INSERT INTO `danhmuc` (`MaDM`, `TenDM`) VALUES
('DM01', 'Bộ sưu tập'),
('DM02', 'Dòng trang sức'),
('DM03', 'Loại sản phẩm'),
('DM05', 'Liên hệ'),
('DM06', 'Hỗ trợ'),
('DM07', 'Gọi điện');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giohang`
--

CREATE TABLE `giohang` (
  `MaGH` varchar(191) NOT NULL,
  `MaND` varchar(255) DEFAULT NULL,
  `MaSP` varchar(255) DEFAULT NULL,
  `TenSP` varchar(255) DEFAULT NULL,
  `Gia` decimal(18,2) NOT NULL,
  `SoLuong` int NOT NULL,
  `TongTien` decimal(18,2) NOT NULL
) ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nguoidung`
--

CREATE TABLE `nguoidung` (
  `MaND` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `TenND` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `MatKhau` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `Email` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `NgaySinh` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `DiaChi` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `Phai` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `avt` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `HoTen` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nguoidung`
--

INSERT INTO `nguoidung` (`MaND`, `TenND`, `MatKhau`, `Email`, `NgaySinh`, `DiaChi`, `Phai`, `avt`, `HoTen`) VALUES
('Admin', 'GiaBaoJewelry', '123456', 'baojewelry@gmail.com', NULL, 'Mỹ Tho', 'Nam', NULL, 'Admin'),
('ND01', 'PhamGiaBao', '123456', 'bao@gmail.com', '2004-09-23', 'My Tho', 'Nam', 'images/67de88e2016a4.jpg', 'Phạm Gia Bảo'),
('ND02', 'HuynhThanhSang', '123456', 'sang@gmail.com', '2004-12-01', 'Bến Tre', 'Nam', 'images/67d582f8b194a.jpg', 'Huỳnh Thanh Sang'),
('ND03', 'PhuocThien', '123456', 'thien@gmail.com', '2001-01-01', 'My Tho', 'Nam', 'images/67d582dc10f89.jpg', 'Nguyễn Hoàng Phước Thiện'),
('ND04', 'LongPhi', '123456', 'phi@gmail.com', '2001-01-01', 'Bến Tre', 'Nam', NULL, 'Huỳnh Nguyễn Long Phi'),
('ND05', 'VoHoangYNhi', '123456', 'ynhi@gmail.com', '2004-12-23', 'Đà Nẵng', 'Nữ', 'images/67de88fdf02c8.jpg', 'Võ Hoàng Ý Nhi'),
('ND06', 'khanhhuyen', '123456', 'khanhhuyen@gmail.com', '2005-10-16', 'Bà Rịa', 'Nữ', 'images/67de8939ed594.jpg', 'Tôn Trương Khánh Huyền'),
('ND07', 'nguyenvanan', '123456', 'vanan@gmail.com', '2003-07-18', 'Bình Thuận', 'Nam', 'images/67de894f9c440.jpg', 'Nguyễn Văn An');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham`
--

CREATE TABLE `sanpham` (
  `MaSP` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `TenSP` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `Gia` decimal(18,2) NOT NULL,
  `MaCTDM` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `LinkAnh` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `SoLuong` int DEFAULT NULL,
  `NgayNhap` date DEFAULT NULL
) ;

--
-- Đang đổ dữ liệu cho bảng `sanpham`
--

INSERT INTO `sanpham` (`MaSP`, `TenSP`, `Gia`, `MaCTDM`, `LinkAnh`, `SoLuong`, `NgayNhap`) VALUES
('SP01', 'Dây chuyền Vàng ta 990 KVDRTTA0000R998', 46454000.00, 'CTDM01', 'Dây chuyền Vàng ta 990 KVDRTTA0000R998.jpg', 20, '2022-01-12'),
('SP02', 'Bông tai cưới Vàng ta 990 DVBVTTA0000A171', 11991400.00, 'CTDM01', 'Bông tai cưới Vàng ta 990 DVBVTTA0000A171.jpg', 17, '2022-09-26'),
('SP03', 'Dây chuyền Vàng ta 990 KVDRTTA0000R989', 46454000.00, 'CTDM01', 'Dây chuyền Vàng ta 990 KVDRTTA0000R989.jpg', 14, '2021-03-29'),
('SP04', 'Bông tai Vàng ta 990 DVBVTTA0000S111', 9590000.00, 'CTDM01', 'Bông tai Vàng ta 990 DVBVTTA0000S111.jpg', 22, '0000-00-00'),
('SP05', 'Dây chuyền Vàng ta 990 KVDRTTA0000R990', 46400000.00, 'CTDM01', 'Dây chuyền Vàng ta 990 KVDRTTA0000R990.jpg', 11, '0000-00-00'),
('SP06', 'Bông tai Cưới Vàng ta 990 DVBOTTA0000R262', 10859500.00, 'CTDM01', 'Bông tai Cưới Vàng ta 990 DVBOTTA0000R262.jpg', 21, '0000-00-00'),
('SP13', 'Lắc tay Vàng 18K LVLDTVV0001R829', 31040000.00, 'CTDM03', 'Lắc tay Vàng 18K LVLDTVV0001R829.jpg', 20, '0000-00-00'),
('SP14', 'Nhẫn nam Vàng trắng DVNATTT0101D302', 20699000.00, 'CTDM03', 'Nhẫn nam Vàng trắng DVNATTT0101D302.jpg', 25, '0000-00-00'),
('SP15', 'Nhẫn nam Vàng trắng DVNATTT0002D292', 31040000.00, 'CTDM03', 'Nhẫn nam Vàng trắng DVNATTT0002D292.jpg', 20, '0000-00-00'),
('SP16', 'Nhẫn nam Vàng trắng DVNATTT0102D298', 25319000.00, 'CTDM03', 'Nhẫn nam Vàng trắng DVNATTT0102D298.jpg', 15, '0000-00-00'),
('SP17', 'Nhẫn nam Vàng 18K DVNATVV0101D394', 21055000.00, 'CTDM03', 'Nhẫn nam Vàng 18K DVNATVV0101D394.jpg', 18, '0000-00-00'),
('SP18', 'Nhẫn nam Vàng 18K DVNATVV0102D299', 22999000.00, 'CTDM03', 'Nhẫn nam Vàng 18K DVNATVV0102D299.jpg', 21, '0000-00-00'),
('SP19', 'Nhẫn nam Vàng 18K DVNATVV0101D295', 19735000.00, 'CTDM03', 'Nhẫn nam Vàng 18K DVNATVV0101D295.jpg', 15, '0000-00-00'),
('SP20', 'Lắc tay Vàng 18K LVLDTVV0010Q617', 91020000.00, 'CTDM03', 'Lắc tay Vàng 18K LVLDTVV0010Q617.jpg', 10, '0000-00-00'),
('SP21', 'Lắc tay Vàng trắng DVLLTTT0008F483', 46015000.00, 'CTDM03', 'Lắc tay Vàng trắng DVLLTTT0008F483.jpg', 18, '0000-00-00'),
('SP22', 'Lắc tay Vàng 18K LVLDTVV0000F447', 52595000.00, 'CTDM03', 'Lắc tay Vàng 18K LVLDTVV0000F447.jpg', 10, '0000-00-00'),
('SP23', 'Lắc tay Vàng 18K DVLLTVV0000O247', 153682000.00, 'CTDM03', 'Lắc tay Vàng 18K DVLLTVV0000O247.jpg', 5, '0000-00-00'),
('SP24', 'Mặt dây chuyền Vàng 18K DVMATVVA105R623', 22599000.00, 'CTDM03', 'Mặt dây chuyền Vàng 18K DVMATVVA105R623.jpg', 20, '0000-00-00'),
('SP25', 'Mặt dây chuyền Vàng 18K DVMATVV0005R621', 21939000.00, 'CTDM03', 'Mặt dây chuyền Vàng 18K DVMATVV0005R621.jpg', 25, '0000-00-00'),
('SP253', 'Nhẫn nữ Vàng ta 990 DVNUTTA0000Q783', 3780000.00, 'CTDM19', 'Bông tai cưới Vàng ta 990 DVBVTTA0000A171.jpg', 3, '0000-00-00'),
('SP254', 'Nhẫn nữ Vàng 18K DVNUTVV0000Q266', 7580600.00, 'CTDM19', 'Bông tai cưới Vàng ta 990 DVBVTTA0000A171.jpg', 7, '0000-00-00'),
('SP255', 'Nhẫn nữ Vàng 18K DVNUTVV0000Q494', 11662000.00, 'CTDM19', 'Bông tai cưới Vàng ta 990 DVBVTTA0000A171.jpg', 8, '0000-00-00'),
('SP256', 'Nhẫn nữ Vàng 18K DVNOTVV0000I609', 4300000.00, 'CTDM19', 'Bông tai cưới Vàng ta 990 DVBVTTA0000A171.jpg', 10, '0000-00-00'),
('SP257', 'Nhẫn nữ Vàng 18K DVNUTVV0000D733', 12680000.00, 'CTDM19', 'Bông tai cưới Vàng ta 990 DVBVTTA0000A171.jpg', 9, '0000-00-00'),
('SP258', 'Nhẫn nữ Vàng 18K DVNUTVV0000Q336', 8265000.00, 'CTDM19', 'Bông tai cưới Vàng ta 990 DVBVTTA0000A171.jpg', 12, '0000-00-00'),
('SP259', 'Nhẫn nữ Vàng 18K DVNUTVV0000Q513', 10213000.00, 'CTDM19', 'Bông tai cưới Vàng ta 990 DVBVTTA0000A171.jpg', 8, '0000-00-00'),
('SP26', 'Mặt dây chuyền Vàng 18K DVMATVV0005R622', 23919000.00, 'CTDM03', 'Mặt dây chuyền Vàng 18K DVMATVV0005R622.jpg', 15, '0000-00-00'),
('SP260', 'Nhẫn nữ Vàng 18K DVNUTVV0001Q779', 6491000.00, 'CTDM19', 'Bông tai cưới Vàng ta 990 DVBVTTA0000A171.jpg', 5, '0000-00-00'),
('SP261', 'Nhẫn nữ Đá màu Swarovski Vàng 18K DWNUHVV0000M784', 15530000.00, 'CTDM19', 'Bông tai Đá màu Swarovski Vàng trắng DWBOTTT0100I594.jpg', 2, '0000-00-00'),
('SP262', 'Nhẫn nữ Đá màu Swarovski Vàng 18K DWNUHVV0000M786', 11039000.00, 'CTDM19', 'Bông tai Đá màu Swarovski Vàng trắng DWBOTTT0100I594.jpg', 2, '0000-00-00'),
('SP263', 'Nhẫn nữ Đá màu Swarovski Vàng 18K DWNUHVV0000M775', 10890000.00, 'CTDM19', 'Bông tai Đá màu Swarovski Vàng trắng DWBOTTT0100I594.jpg', 2, '0000-00-00'),
('SP264', 'Nhẫn nữ Đá màu Swarovski Vàng ta 990 DWNODTA0000P575', 29776000.00, 'CTDM19', 'Bông tai Đá màu Swarovski Vàng trắng DWBOTTT0100I594.jpg', 1, '0000-00-00'),
('SP265', 'Nhẫn nữ Đá màu tổng hợp Vàng trắng DMNUETT0000Q097', 5670000.00, 'CTDM19', 'Nhẫn nam Đá màu tổng hợp Vàng 18K DMNAEVV0300J538.jpg', 5, '0000-00-00'),
('SP266', 'Nhẫn nữ Cẩm thạch Vàng 18K DTNULVV0000R390', 23435000.00, 'CTDM19', 'Nhẫn nam Đá màu tổng hợp Vàng 18K DMNAEVV0300J538.jpg', 1, '0000-00-00'),
('SP267', 'Nhẫn nữ Cẩm thạch Vàng 18K DTNOLVV0000I804', 23435000.00, 'CTDM19', 'Nhẫn nam Đá màu tổng hợp Vàng 18K DMNAEVV0300J538.jpg', 1, '0000-00-00'),
('SP268', 'bbb', 2.00, 'CTDM02', 'images/SP268.jpg', 22, '2007-09-24');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tinnhan`
--

CREATE TABLE `tinnhan` (
  `MaTN` varchar(255) DEFAULT NULL,
  `MaNguoiGui` varchar(255) DEFAULT NULL,
  `MaNguoiNhan` varchar(255) DEFAULT NULL,
  `NoiDung` text NOT NULL,
  `ThoiGian` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tinnhan`
--

INSERT INTO `tinnhan` (`MaTN`, `MaNguoiGui`, `MaNguoiNhan`, `NoiDung`, `ThoiGian`) VALUES
(NULL, 'HuynhThanhSang', 'ND01', 'y', '2025-03-15 06:29:13'),
(NULL, 'PhamGiaBao', 'Admin', 'thử', '2025-03-15 06:34:03'),
(NULL, 'ND01', 'Admin', 'ê nha', '2025-03-15 06:34:50'),
(NULL, 'ND01', 'Admin', 'gì vay', '2025-03-15 06:37:28'),
(NULL, 'ND02', 'Admin', 'dữ dị seo', '2025-03-15 06:38:08'),
(NULL, 'ND02', 'Admin', 'sừ goi', '2025-03-15 06:40:28'),
(NULL, 'ND02', 'Admin', 'đù', '2025-03-15 06:41:26'),
(NULL, 'ND02', 'Admin', 'gì vậy trơi', '2025-03-15 06:44:00'),
(NULL, 'ND02', 'Admin', 'được đó', '2025-03-15 06:45:58'),
(NULL, 'ND02', 'Admin', 'nhấn nút enter', '2025-03-15 06:47:46'),
('TN01', 'ND02', 'Admin', 'mã tin nhắn', '2025-03-15 06:53:09'),
('TN02', 'ND02', 'Admin', 'một', '2025-03-15 06:54:28'),
('TN03', 'ND02', 'Admin', 'từ', '2025-03-15 06:54:51'),
('TN04', 'ND02', 'Admin', 'hai', '2025-03-15 06:54:53'),
('TN05', 'ND02', 'Admin', 'ba', '2025-03-15 06:54:55'),
('TN06', 'ND02', 'Admin', 'bốn', '2025-03-15 06:54:56'),
('TN07', 'ND02', 'Admin', 'năm', '2025-03-15 06:54:58'),
('TN08', 'ND02', 'Admin', 'sáu', '2025-03-15 06:54:59'),
('TN09', 'ND02', 'Admin', 'bảy', '2025-03-15 06:55:00'),
('TN10', 'ND02', 'Admin', 'haha', '2025-03-15 06:55:03'),
('TN11', 'ND02', 'Admin', 'bảo', '2025-03-15 06:55:04'),
('TN12', 'ND02', 'Admin', 'phạm', '2025-03-15 06:55:06'),
('TN13', 'ND02', 'Admin', 'gia', '2025-03-15 06:55:07'),
('TN14', 'ND02', 'Admin', 'abcdefg', '2025-03-15 06:55:13'),
('TN15', 'ND02', 'Admin', 'ff', '2025-03-15 06:59:01'),
('TN16', 'ND02', 'Admin', 'sds', '2025-03-15 06:59:17'),
('TN17', 'ND02', 'Admin', 'dfd', '2025-03-15 06:59:19'),
('TN18', 'ND02', 'Admin', 'ê nha', '2025-03-15 07:00:38'),
('TN19', 'ND03', 'Admin', 'hi', '2025-03-15 07:14:23'),
('TN20', 'ND02', 'Admin', 'hú', '2025-03-15 08:11:07'),
('TN21', 'ND02', 'Admin', 'alo', '2025-03-15 08:28:29'),
('TN22', 'ND02', 'Admin', 'quẩy', '2025-03-15 08:33:04'),
('TN23', 'ND02', 'Admin', 'ê', '2025-03-15 10:09:42'),
('TN24', 'ND02', 'Admin', 'hôm nay là ngày mười lăm tháng ba năm hai nghìn không trăm hai mươi lăm', '2025-03-15 11:14:02'),
('TN25', 'ND02', 'Admin', 'hôm nay là ngày mười lăm tháng ba năm hai nghìn không trăm hai mươi lămhôm nay là ngày mười lăm tháng ba năm hai nghìn không trăm hai mươi lămhôm nay là ngày mười lăm tháng ba năm hai nghìn không trăm hai mươi lămhôm nay là ngày mười lăm tháng ba năm hai nghìn không trăm hai mươi lămhôm nay là ngày mười lăm tháng ba năm hai nghìn không trăm hai mươi lăm', '2025-03-15 11:17:43'),
('TN26', 'ND02', 'Admin', 'hôm nay là ngày mười lăm tháng ba năm hai nghìn không trăm hai mươi lămhôm nay là ngày mười lăm tháng ba năm hai nghìn không trăm hai mươi lămhôm nay là ngày mười lăm tháng ba năm hai nghìn không trăm hai mươi lămhôm nay là ngày mười lăm tháng ba năm hai nghìn không trăm hai mươi lămhôm nay là ngày mười lăm tháng ba năm hai nghìn không trăm hai mươi lămhôm nay là ngày mười lăm tháng ba năm hai nghìn không trăm hai mươi lămhôm nay là ngày mười lăm tháng ba năm hai nghìn không trăm hai mươi lămhôm nay là ngày mười lăm tháng ba năm hai nghìn không trăm hai mươi lămhôm nay là ngày mười lăm tháng ba năm hai nghìn không trăm hai mươi lămhôm nay là ngày mười lăm tháng ba năm hai nghìn không trăm hai mươi lăm', '2025-03-15 11:27:21'),
('TN27', 'ND02', 'Admin', 'ê', '2025-03-15 11:27:35'),
('TN28', 'ND02', 'Admin', 'hôm nay là ngày mười lăm tháng ba năm hai nghìn không trăm hai mươi lăm', '2025-03-15 11:29:26'),
('TN29', 'ND02', 'Admin', 'Mai vàng trong sắc xuân mang theo những niềm vui và hứng khởi, đó cũng chính là cảm hứng trong bộ trang sức cưới Mai Trăm Năm. Với ý nghĩa vui tươi và ý niệm khởi đầu hạnh phúc, trang sức Mai Trăm Năm đồng hành cùng cặp đôi uyên ương trong ngày hỷ sự.', '2025-03-15 11:37:49'),
('TN30', 'ND02', 'HuynhThanhSang', 'wao', '2025-03-15 11:44:49'),
('TN31', 'ND02', 'HuynhThanhSang', 'cai gì', '2025-03-15 11:46:36'),
('TN32', 'ND02', 'HuynhThanhSang', 'f', '2025-03-15 11:49:54'),
('TN33', 'ND02', 'HuynhThanhSang', 'g', '2025-03-15 11:50:32'),
('TN34', 'ND02', 'Admin', 'omg', '2025-03-15 11:54:06'),
('TN35', 'ND02', 'HuynhThanhSang', 'd', '2025-03-15 11:58:12'),
('TN36', 'Admin', 'HuynhThanhSang', 'tr', '2025-03-15 11:58:52'),
('TN37', 'Admin', 'HuynhThanhSang', 'nữa', '2025-03-15 12:01:44'),
('TN38', 'ND02', 'Admin', 'haiz\'', '2025-03-15 12:02:16'),
('TN39', 'Admin', 'ND02', 'tr', '2025-03-15 12:05:55'),
('TN40', 'Admin', 'ND02', 'hú', '2025-03-15 12:06:53'),
('TN41', 'ND02', 'Admin', 'gì v', '2025-03-15 12:07:00'),
('TN42', 'ND01', 'Admin', 'ê', '2025-03-15 12:08:13'),
('TN43', 'Admin', 'ND02', 'what', '2025-03-15 12:09:39'),
('TN44', 'Admin', 'ND02', 'hả', '2025-03-15 12:09:47'),
('TN45', 'Admin', 'ND02', 'ê ee', '2025-03-15 12:10:29'),
('TN46', 'ND02', 'Admin', 'tôi là sang', '2025-03-15 12:11:02'),
('TN47', 'Admin', 'ND02', 'tôi là bảo', '2025-03-15 12:11:27'),
('TN48', 'ND02', 'Admin', 'thiệt k', '2025-03-15 12:11:41'),
('TN49', 'Admin', 'ND02', 'thiệt', '2025-03-15 12:11:46'),
('TN50', 'Admin', 'PhamGiaBao', 'tr', '2025-03-15 12:15:10'),
('TN51', 'Admin', 'HuynhThanhSang', 't', '2025-03-15 12:15:33'),
('TN52', 'ND02', 'Admin', 'tr', '2025-03-15 12:16:37'),
('TN53', 'Admin', 'ND02', 'kk', '2025-03-15 12:16:48'),
('TN54', 'Admin', 'ND02', 'f', '2025-03-15 12:23:52'),
('TN55', 'Admin', 'ND02', 'uày', '2025-03-15 12:28:30'),
('TN56', 'Admin', 'ND02', 'đập vỡ ccaay đàn', '2025-03-15 12:29:03'),
('TN57', 'Admin', 'Admin', 'f', '2025-03-15 12:31:52'),
('TN58', 'Admin', 'Admin', 'tr', '2025-03-15 12:32:52'),
('TN59', 'Admin', 'ND02', 'du', '2025-03-15 12:41:24'),
('TN60', 'Admin', 'ND01', 'tr', '2025-03-15 12:43:37'),
('TN61', 'Admin', 'ND02', 'dữ dằn', '2025-03-15 12:43:57'),
('TN62', 'Admin', 'ND01', 'w', '2025-03-15 12:46:19'),
('TN63', 'Admin', 'ND02', 'r', '2025-03-15 12:50:13'),
('TN64', 'Admin', 'ND02', 'chà', '2025-03-15 12:50:24'),
('TN65', 'ND02', 'Admin', 'kk', '2025-03-15 12:50:44'),
('TN66', 'Admin', 'ND02', 'vãi', '2025-03-15 12:51:16'),
('TN67', 'Admin', 'ND01', 'hehe', '2025-03-15 12:51:41'),
('TN68', 'Admin', 'ND02', 'hết cú', '2025-03-15 12:56:36'),
('TN69', 'Admin', 'ND01', 'ủa', '2025-03-15 12:56:50'),
('TN70', 'Admin', 'ND03', 'ủa', '2025-03-15 12:57:16'),
('TN71', 'Admin', 'ND02', 'kì ta', '2025-03-15 12:58:27'),
('TN72', 'ND04', 'Admin', 'xin chào admin', '2025-03-15 13:01:09'),
('TN73', 'Admin', 'ND04', 'chào nha', '2025-03-15 13:01:23'),
('TN74', 'Admin', 'ND03', 'tuyet', '2025-03-15 13:04:57'),
('TN75', 'Admin', 'ND01', 'hay quá', '2025-03-15 13:06:17'),
('TN76', 'Admin', 'ND02', 'quá đã', '2025-03-15 13:06:23'),
('TN77', 'Admin', 'ND02', 'kì z', '2025-03-15 13:08:21'),
('TN78', 'Admin', 'ND02', 'nữa', '2025-03-15 13:09:24'),
('TN79', 'ND02', 'Admin', 'haiz', '2025-03-15 13:09:46'),
('TN80', 'Admin', 'ND02', 'cú', '2025-03-15 13:10:08'),
('TN81', 'Admin', 'ND01', 'thành công', '2025-03-15 13:12:44'),
('TN82', 'ND02', 'Admin', 'hết cú', '2025-03-15 13:16:18'),
('TN83', 'Admin', 'ND02', 'hả', '2025-03-15 13:17:06'),
('TN84', 'ND02', 'Admin', 'kk', '2025-03-15 13:19:43'),
('TN85', 'Admin', 'ND02', 'kk', '2025-03-15 13:19:50'),
('TN86', 'ND02', 'Admin', 'hí hí', '2025-03-15 13:19:58'),
('TN87', 'Admin', 'ND02', 'hêhe', '2025-03-15 13:21:08'),
('TN88', 'Admin', 'ND02', 'ho\'', '2025-03-15 13:21:18'),
('TN89', 'ND02', 'Admin', 'quài lun', '2025-03-15 13:21:35'),
('TN90', 'Admin', 'ND02', 'troll vn', '2025-03-15 13:21:39'),
('TN91', 'ND02', 'Admin', 'kk', '2025-03-15 13:23:25'),
('TN92', 'Admin', 'ND02', 'nữa', '2025-03-15 13:25:21'),
('TN93', 'ND02', 'Admin', 'nữa', '2025-03-15 13:25:36'),
('TN94', 'Admin', 'ND02', 'haha', '2025-03-15 13:25:59'),
('TN95', 'ND02', 'Admin', 'hehe', '2025-03-15 13:26:06'),
('TN96', 'Admin', 'ND02', 'ay da', '2025-03-15 13:39:59'),
('TN97', 'ND02', 'Admin', 'da', '2025-03-15 13:40:18'),
('TN98', 'Admin', 'ND02', 'kk', '2025-03-15 13:40:25'),
('TN99', 'Admin', 'ND02', 'hum', '2025-03-15 13:40:45'),
('TN100', 'ND02', 'Admin', 'huy', '2025-03-15 13:40:53'),
('TN100', 'ND02', 'Admin', 'Mai vàng trong sắc xuân mang theo những niềm vui và hứng khởi, đó cũng chính là cảm hứng trong bộ trang sức cưới Mai Trăm Năm. Với ý nghĩa vui tươi và ý niệm khởi đầu hạnh phúc, trang sức Mai Trăm Năm đồng hành cùng cặp đôi uyên ương trong ngày hỷ sự.', '2025-03-15 13:43:05'),
('TN100', 'ND02', 'Admin', 'chà', '2025-03-15 13:47:56'),
('TN100', 'ND02', 'Admin', 'QUẨY', '2025-03-15 13:57:42'),
('TN100', 'Admin', 'ND01', 'ngủ thoi', '2025-03-15 14:02:11'),
('TN100', 'Admin', 'ND02', 'hí', '2025-03-15 14:02:36'),
('TN100', 'Admin', 'ND02', 'kk', '2025-03-16 02:24:02'),
('TN100', 'ND02', 'Admin', 'kk', '2025-03-16 02:24:10'),
('TN100', 'ND01', 'Admin', 'hi', '2025-03-17 04:42:05'),
('TN100', 'ND01', 'Admin', 'kk', '2025-03-17 22:12:52'),
('TN100', 'ND01', 'Admin', 'CREATE TABLE giohang (     MaGH VARCHAR(191) PRIMARY KEY,     MaND VARCHAR(191), -- ID người dùng (nếu có đăng nhập)     MaSP VARCHAR(191), -- Đảm bảo giống kiểu dữ liệu với sanpham.MaSP     TenSP VARCHAR(255),     Gia DECIMAL(18,2) NOT NULL CHECK (Gia > 0),     SoLuong INT NOT NULL CHECK (SoLuong > 0),     TongTien DECIMAL(18,2) NOT NULL CHECK (TongTien > 0),     FOREIGN KEY (MaSP) REFERENCES sanpham(MaSP) ON DELETE CASCADE,     FOREIGN KEY (MaND) REFERENCES nguoidung(MaND) ON DELETE CASCADE )', '2025-03-18 12:02:27'),
('TN100', 'ND01', 'Admin', 'tr', '2025-03-19 02:19:50'),
('TN100', 'ND01', 'Admin', 'haiz', '2025-03-19 02:20:30'),
('TN100', 'Admin', 'ND01', 'sao z', '2025-03-19 02:21:19'),
('TN100', 'ND01', 'Admin', 'kaka', '2025-03-19 02:34:15'),
('TN100', 'ND01', 'Admin', 'hi', '2025-03-19 02:34:34'),
('TN100', 'ND01', 'Admin', 'hay', '2025-03-19 02:44:45'),
('TN100', 'ND02', 'Admin', 'hi', '2025-03-19 13:12:45'),
('TN100', 'Admin', 'ND01', 'a', '2025-03-22 10:00:35');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `xuathang`
--

CREATE TABLE `xuathang` (
  `MaSP` varchar(255) DEFAULT NULL,
  `SoLuong` int DEFAULT NULL,
  `TongTien` decimal(10,0) DEFAULT NULL,
  `NgayXuatHang` datetime DEFAULT CURRENT_TIMESTAMP,
  `MaND` varchar(255) DEFAULT NULL,
  `MaPhieuXuat` varchar(20) DEFAULT NULL,
  `PhuongThucThanhToan` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `xuathang`
--

INSERT INTO `xuathang` (`MaSP`, `SoLuong`, `TongTien`, `NgayXuatHang`, `MaND`, `MaPhieuXuat`, `PhuongThucThanhToan`) VALUES
('SP01', 2, 92908000, '2025-03-19 00:00:00', 'ND02', 'HD01', 'Thanh toán khi nhận hàng'),
('SP03', 2, 92908000, '2025-03-19 21:32:24', 'ND02', 'HD02', 'Thanh toán tiền mặt'),
('SP03', 5, 232270000, '2025-03-19 21:32:48', 'ND02', 'HD03', 'Thanh toán tiền mặt'),
('SP04', 1, 9590000, '2025-03-19 21:32:48', 'ND02', 'HD03', 'Thanh toán tiền mặt'),
('SP14', 1, 20699000, '2025-03-20 20:00:09', 'ND02', 'HD04', 'Thanh toán tiền mặt'),
('SP15', 1, 31040000, '2025-03-20 20:00:09', 'ND02', 'HD04', 'Thanh toán tiền mặt'),
('SP02', 1, 11991400, '2025-03-20 20:22:07', 'ND02', 'HD05', 'Thanh toán tiền mặt'),
('SP03', 2, 92908000, '2025-03-20 20:22:07', 'ND02', 'HD05', 'Thanh toán tiền mặt'),
('SP25', 2, 43878000, '2025-03-21 19:03:04', 'ND05', 'HD06', 'Thanh toán tiền mặt'),
('SP22', 5, 262975000, '2025-03-21 19:03:04', 'ND05', 'HD06', 'Thanh toán tiền mặt'),
('SP05', 5, 232000000, '2025-03-21 19:03:04', 'ND05', 'HD06', 'Thanh toán tiền mặt'),
('SP18', 3, 68997000, '2025-03-21 19:03:04', 'ND05', 'HD06', 'Thanh toán tiền mặt'),
('SP04', 2, 19180000, '2025-03-21 19:03:04', 'ND05', 'HD06', 'Thanh toán tiền mặt'),
('SP04', 1, 9590000, '2025-03-22 13:58:33', 'ND01', 'HD07', 'Thanh toán tiền mặt'),
('SP16', 2, 50638000, '2025-03-22 14:01:29', 'ND06', 'HD08', 'Thanh toán tiền mặt'),
('SP23', 2, 307364000, '2025-03-22 14:02:45', 'ND03', 'HD09', 'Thanh toán tiền mặt');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `chitietdanhmuc`
--
ALTER TABLE `chitietdanhmuc`
  ADD PRIMARY KEY (`MaCTDM`),
  ADD KEY `MaDM` (`MaDM`);

--
-- Chỉ mục cho bảng `danhmuc`
--
ALTER TABLE `danhmuc`
  ADD PRIMARY KEY (`MaDM`);

--
-- Chỉ mục cho bảng `giohang`
--
ALTER TABLE `giohang`
  ADD PRIMARY KEY (`MaGH`),
  ADD KEY `MaSP` (`MaSP`(250)),
  ADD KEY `MaND` (`MaND`(250));

--
-- Chỉ mục cho bảng `nguoidung`
--
ALTER TABLE `nguoidung`
  ADD PRIMARY KEY (`MaND`);

--
-- Chỉ mục cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`MaSP`),
  ADD KEY `MaCTDM` (`MaCTDM`);

--
-- Chỉ mục cho bảng `tinnhan`
--
ALTER TABLE `tinnhan`
  ADD KEY `MaNguoiGui` (`MaNguoiGui`(250)),
  ADD KEY `MaNguoiNhan` (`MaNguoiNhan`(250));

--
-- Chỉ mục cho bảng `xuathang`
--
ALTER TABLE `xuathang`
  ADD KEY `MaSP` (`MaSP`(250)),
  ADD KEY `MaND` (`MaND`(250));

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `chitietdanhmuc`
--
ALTER TABLE `chitietdanhmuc`
  ADD CONSTRAINT `chitietdanhmuc_ibfk_1` FOREIGN KEY (`MaDM`) REFERENCES `danhmuc` (`MaDM`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `sanpham_ibfk_1` FOREIGN KEY (`MaCTDM`) REFERENCES `chitietdanhmuc` (`MaCTDM`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
