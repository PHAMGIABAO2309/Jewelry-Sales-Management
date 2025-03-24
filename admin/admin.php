<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Trang Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="icon" type="image/png" href="../images/logo.jpg">
    <link rel="stylesheet" href="../assets/admins.css">
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
        
        <!-- Main Content -->
        <div class="p-4 bg-white main-content">
            <header class="navbar navbar-expand-lg navbar-dark bg-dark mt-[-55]">
                <div class="container">
                    <a class="navbar-brand" href="#">
                        <img src="../images/logo.jpg" alt="Logo" width="40" height="40" class="d-inline-block align-text-top rounded-circle">
                    </a>
                    <div class="d-flex align-items-center">
                        <span class="text-white me-3">Xin chào, <strong>Admin</strong></span>
                        <a href="../actions/logout.php" class="btn btn-danger">Đăng xuất</a>
                    </div>
                </div>
            </header>

            <div class="container " style="margin-top: 70px;">
                <h1 class="text-center text-6xl font-extrabold drop-shadow-xl mb-4 rainbow-text">
                    TRANG QUẢN TRỊ VIÊN Phạm Gia Bảo
                </h1>
                <p class="text-center text-xl text-gray-700 italic animate-pulse">
                    Chào mừng: <span class="font-semibold text-indigo-500 glow-text">Admin</span>
                </p>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-4 g-4 rounded-full">
                    <div class="col">
                        <div class="card text-center shadow-sm p-3 rounded-full">
                            <a href="quanlytaikhoan.php">
                                <img src="../images/quanlytaikhoan.png" class="card-img-top mx-auto" alt="Quản lý Tài Khoản">
                            </a>
                            <div class="card-body">
                                <h5 class="card-title">Quản lý Tài Khoản</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card text-center shadow-sm p-3">
                            <a href="quanlydonhang.php">
                                <img src="../images/quanlydonhang.png" class="card-img-top mx-auto" alt="Quản lý Đơn hàng">
                            </a>
                            <div class="card-body">
                                <h5 class="card-title">Quản lý Đơn hàng</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card text-center shadow-sm p-3">
                        <a href="quanlychat.php">
                            <img src="../images/chatvoikh.png" class="card-img-top mx-auto" alt="Quản lý Khách hàng">
                            </a>
                            <div class="card-body">
                                <h5 class="card-title">Chat với Khách hàng</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card text-center shadow-sm p-3">
                            <a href="quanlynhaphang.php">
                                <img src="../images/nhaphang.png" class="card-img-top mx-auto" alt="Quản lý Nhà cung cấp">
                            </a>
                            <div class="card-body">
                                <h5 class="card-title">Quản lý Nhập hàng</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card text-center shadow-sm p-3">
                            <a href="quanlydanhmuc.php">
                            <img src="../images/danhmuc.png" class="card-img-top mx-auto" alt="Quản lý Loại sản phẩm">
                            </a>
                            <div class="card-body">
                                <h5 class="card-title">Quản lý danh mục</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card text-center shadow-sm p-3">
                            <a href="chitietdanhmuc.php">
                            <img src="../images/chitietdanhmuc.png" class="card-img-top mx-auto" alt="Quản lý Loại sản phẩm">
                            </a>
                            <div class="card-body">
                                <h5 class="card-title" style="font-size:17px;">Quản lý chi tiết danh mục</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card text-center shadow-sm p-3">
                            <a href="../actions/logout.php">
                            <img src="../images/trangbanhang.png" class="card-img-top mx-auto" alt="Quản lý sản phẩm">
                            </a>
                            <div class="card-body">
                                <h5 class="card-title">Trang bán hàng</h5>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col">
                        <div class="card text-center shadow-sm p-3">
                        <a href="doanhthu.php">
                            <img src="../images/doanhthu.png" class="card-img-top mx-auto" alt="Báo cáo thống kê">
                            </a>
                            <div class="card-body">
                                <h5 class="card-title">Thống kê doanh thu</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<style>
.main-content {
    width: calc(100% - 250px); /* Trừ đi chiều rộng sidebar */
    height: 100vh; /* Chiều cao toàn màn hình */
    overflow-y: auto; /* Cho phép cuộn khi nội dung dài */
    padding: 20px; /* Tạo khoảng cách cho nội dung */
    background-color: #ffffff; /* Giữ nền trắng */ 
}
/* Hiệu ứng gradient động */
@keyframes glowingBackground {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}
@keyframes rainbow {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
  }
  .rainbow-text {
    background-image: linear-gradient(45deg, red, black, yellow, green, cyan, blue, violet);
    background-size: 400% 400%;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    animation: rainbow 10s infinite linear;
  }
header.navbar {
    position: fixed;
    top: 0;
    left: 0;
    width: 83%;
    z-index: 1000;
    margin-left: 250px;
    background: linear-gradient(45deg, #ff00ff, #0000ff, #00ffff, #ff00ff);
    background-size: 300% 300%;
    animation: glowingBackground 8s ease infinite;
    box-shadow: 0px 0px 15px rgba(255, 255, 255, 0.5);
}
header.navbar::after {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: url('https://www.transparenttextures.com/patterns/stardust.png'); /* Hiệu ứng lấp lánh */
    opacity: 0.2;
    pointer-events: none;
}
.card img {
    transition: transform 0.3s ease-in-out;
}

.card:hover img {
    transform: scale(1.1); /* Phóng to 10% */
}

</style>
</body>
</html>