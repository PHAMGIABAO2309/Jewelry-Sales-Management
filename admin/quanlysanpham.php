<?php
session_start();
include dirname(__DIR__) . '/database/connect.php';
$sql = "select MaCTDM, TenCTDM from chitietdanhmuc";
$result = $conn->query($sql);
if (!$result) {
    die("Lỗi truy vấn: " . $conn->error);
}
?>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quản lý sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/png" href="../images/logo.jpg">
    <link rel="stylesheet" href="../assets/quanlynhaphang.css">
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar d-flex flex-column p-3">
            <div class="d-flex align-items-center border-bottom pb-3 mb-3">
                <div class="admin-info">
                <img src="../images/logo.jpg" alt="Admin">
                    <span>Admin</span>
                </div>
            </div>
            <a href="admin.php"><i class="fas fa-tachometer-alt me-2"></i> Tổng quan</a>
            <a href="quanlydanhmuc.php"><i class="fas fa-list me-2"></i> Quản lý danh mục</a>
            <a href="chitietdanhmuc.php"><i class="fas fa-list-alt me-2"></i> Quản lý chi tiết danh mục</a>
            <a href="quanlytaikhoan.php"><i class="fas fa-users me-2"></i> Quản lý tài khoản</a>
            <a href="quanlysanpham.php"><i class="fas fa-boxes me-2"></i> Quản lý sản phẩm</a>
            <a href="quanlynhaphang.php"><i class="fas fa-truck-loading me-2"></i> Quản lý nhập hàng</a>
            <a href="quanlydonhang.php"><i class="fas fa-shopping-cart me-2"></i> Quản lý đơn hàng</a>
            <a href="quanlychat.php"><i class="fas fa-comments me-2"></i> Chat với KH</a>
            <a href="doanhthu.php"><i class="fas fa-chart-line me-2"></i> Thống kê doanh thu</a>
            <a href="../actions/logout.php"><i class="fas fa-store me-2"></i> Trang bán hàng</a>
            <a href="../views/login.php"><i class="fas fa-sign-out-alt me-2"></i> Đăng xuất</a>
        </div>
        <div class="main-content bg-white">
            <div class="max-w-7xl mx-auto  p-6 ">
                    <h1 class="text-3xl font-bold text-blue-700 text-center mb-6">QUẢN LÝ NHẬP HÀNG</h1>
                    <div class="row g-3 mb-1">
                        <!-- Cột bên trái -->
                        <div class="col-md-6">
                            <div class="d-flex align-items-center mb-3">
                                <label for="ma-san-pham" class="form-label me-2">Mã Sản Phẩm:</label>
                                <input type="text" id="ma-san-pham" class="form-control form-control-sm ml-10" style="max-width: 200px;">
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <label for="loai-hang" class="form-label me-2">Loại hàng:</label>
                                <select id="loai-hang" name="loai-hang" class="form-select form-select-sm" style="max-width: 200px; margin-left: 70px;">
                                    <option value="">--Chọn loại hàng--</option>
                                    <?php while ($row = $result->fetch_assoc()) { ?>
                                        <option value="<?= $row['MaCTDM'] ?>"><?= $row['TenCTDM'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            
                            <div class="d-flex align-items-center mb-3">
                                <label for="ten-san-pham" class="form-label me-2">Nhập tên sản phẩm:</label>
                                <input type="text" id="ten-san-pham" name="ten-san-pham" class="form-control form-control-sm" style="max-width: 250px;">
                            </div>
                            
                            <div class="d-flex align-items-center mb-3">
                                <label for="so-luong" class="form-label me-2">Nhập số lượng:</label>
                                <input type="number" id="so-luong" name="so-luong"  class="form-control form-control-sm ml-9" style="max-width: 200px;">
                            </div>
                        </div>

                        <!-- Cột bên phải -->
                        <div class="col-md-6">
                            <div class="d-flex align-items-center mb-3">
                                <label for="ngay-nhap" class="form-label me-2">Ngày Nhập:</label>
                                <input type="text" id="ngay-nhap" name="ngay-nhap" class="form-control form-control-sm ml-14" style="max-width: 200px;" placeholder="DD/MM/YYYY">
                            </div>

                            <div class="d-flex align-items-center mb-3">
                                <label for="gia-san-pham" class="form-label me-2">Nhập Giá Sản Phẩm:</label>
                                <input type="number" id="gia-san-pham" name="gia-san-pham" class="form-control form-control-sm" style="max-width: 200px;">
                            </div>
                            
                            <div class="d-flex align-items-center mb-3">
                                <label for="anh-san-pham" class="form-label me-2">Tải ảnh sản phẩm:</label>
                                <input type="file"   class="form-control form-control-sm">
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-between items-center">
                        <h2 class="text-xl font-bold text-gray-700 mb-3">Thông tin sản phẩm:</h2>
                        <div class="flex items-center space-x-5 mb-3">
                            <button class="btnluu bg-gray-200 text-gray-700 p-2 rounded text-lg">💾</button> <!-- Lưu -->
                        </div>
                    </div>



                    <div class="overflow-x-auto max-w-full mb-6" style="overflow-y: auto;">
                        <table class="min-w-full border-collapse table" id="table-sanpham" >
                            <thead>
                                <tr class="bg-red-400 text-center">
                                    <th class="px-4 py-2">Mã Sản Phẩm</th>
                                    <th class="px-4 py-2">Tên Sản Phẩm</th>
                                    <th class="px-4 py-2">Giá Sản Phẩm</th>
                                    <th class="px-4 py-2" style="width: 100px;">Số Lượng</th>
                                    <th class="px-4 py-2" style="width: 120px;">Ngày Nhập</th>
                                    <th class="px-4 py-2" style="width: 150px;">Ảnh Sản Phẩm</th>
                                </tr>
                            </thead>
                            <tbody id="product-list">
                                <!-- Hiện thông tin sản phẩm khi chọn một chi tiết danh muục -->
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
    </div>  
</body>
</html>