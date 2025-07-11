<?php
include '../database/connect.php'; 
include '../actions/danhmuc.php'; 
include '../actions/dropdownbosuutap.php'; 
include '../actions/dropdowndongtrangsuc.php';
include '../actions/dropdownloaisanpham.php';
include '../actions/dropdowndathang.php';

// Lấy giá trị tìm kiếm từ input người dùng (tránh SQL Injection)
$search_value = isset($_GET['search']) ? trim($_GET['search']) : "";

// Chuẩn bị truy vấn
$sql_search = "SELECT MaSP, TenSP, Gia, SoLuong FROM sanpham 
               WHERE TenSP LIKE ? OR MaSP = ? OR Gia = ?";

$stmt = mysqli_prepare($conn, $sql_search);
$search_param = "%$search_value%";
mysqli_stmt_bind_param($stmt, "ssi", $search_param, $search_value, $search_value);
mysqli_stmt_execute($stmt);
$result_search = mysqli_stmt_get_result($stmt);
?>
<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>Gia Bảo Jewelry</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link rel="icon" type="image/png" href="../images/logo.jpg">
  <link rel="stylesheet" href="../assets/navbar.css">
  <script src="../handle/dropdownprofile.js"></script>
  <script src="../handle/dropdownbosuutap.js"></script>
  <script src="../handle/dropdowndongtrangsuc.js"></script>
  <script src="../handle/dropdownloaisanpham.js"></script>
</head>
 <body class="bg-white text-black">
    <header class="flex items-center justify-between p-4 bg-gray-100 w-[1640px] h-[80px]">
        <!-- Logo và Danh mục sản phẩm -->
        <div class="flex items-center space-x-4 relative mt-[-10]">
            <a href="../views/home.php">
                <img id="logo" alt="Logo" class="h-16 w-16 rounded-full" src="../images/logo.jpg"/>
            </a>
            <div class="relative">
                <?php echo getDanhMuc($conn); ?>
            </div>
        </div>
        <!-- Ô tìm kiếm + Thông tin user -->
        <div class="flex items-center space-x-4 ml-auto mt-4">
            <div class="relative">
                <form method="GET" class="w-full ">
                    <input class="border rounded-full p-2 w-96 pl-10 " 
                        placeholder="Tìm Sản Phẩm: Ví dụ: kiềng, dây chuyền..." 
                        type="text" name="search" value="<?= htmlspecialchars($search_value) ?>" />
                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 mt-[-6]"></i>
                </form>
            </div>
            <?php if (isset($_SESSION['user_name'])): ?>
                <a id="userDropdown" class="flex items-center space-x-1 cursor-pointer mt-[-20]" href="#">
                <i class="fas fa-user text-white bg-blue-500 rounded-full p-1 text-sm shadow-md"></i>
                    <span class="ml-2 px-3 py-1  text-blue-600 font-bold hover:text-purple-500 transition-all duration-300">
                        <?= $_SESSION['user_name']; ?>
                    </span>
                </a>
                <?php include '../actions/dropdownprofile.php'; ?>
                <a class="flex items-center space-x-1 text-red-500 mt-[-20]" href="../actions/logout.php"><i class="fas fa-sign-out-alt"></i><span>Đăng Xuất</span></a>
            <?php else: ?>
                <a class="flex items-center space-x-1 mt-[-20]" href="login.php"><i class="fas fa-user"></i><span>Đăng Nhập</span></a>
            <?php endif; ?>
        </div>
    </header>
    <main class="p-4">
        <h2 class="text-center text-2xl font-bold  p-2">
            KẾT QUẢ TÌM KIẾM
        </h2>
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4 mt-2">
            <?php 
            // Nếu có từ khóa tìm kiếm thì dùng kết quả từ truy vấn tìm kiếm
            $data = !empty($search_value) ? $result_search : $result;
            while ($row = mysqli_fetch_assoc($data)) { ?>
                <div class="text-center">
                    <div class="group relative  ">
                        <img alt="<?= $row['TenSP']; ?>" class="mx-auto rounded-lg  cursor-pointer transition-transform duration-300 ease-in-out group-hover:-translate-y-2" height="150" 
                            src="../images/<?= $row['MaSP']; ?>.jpg" width="150"/>
                        
                        <!-- Phần hover hiện dưới ảnh -->
                        <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-[150px] opacity-0 translate-y-2 
                                    transition-all duration-300 ease-in-out group-hover:translate-y-0 group-hover:opacity-100">
                            <div class="flex justify-around items-center py-3 bg-white shadow-lg rounded-lg">
                                <button class="menuorder text-gray-700 hover:text-gray" 
                                        data-masp="<?= htmlspecialchars($row['MaSP']) ?>" 
                                        data-tensp="<?= htmlspecialchars($row['TenSP']) ?>" 
                                        data-soluongsp="<?= $row['SoLuong'] ?>"
                                        data-gia="<?= $row['Gia'] ?>"
                                        data-mand="<?= $_SESSION['user_id']; ?>">
                                    <i class="fas fa-shopping-cart hover:text-red-500" title="Thêm vào giỏ hàng"></i>
                                </button>
                                <button class="text-gray-700 hover:text-black"><i class="fas fa-heart"></i></button>
                                <button class="text-gray-700 hover:text-black"><i class="fas fa-shopping-bag"></i></button>
                            </div>
                        </div>
                    </div>
                    <p class="mt-2"><?= $row['TenSP']; ?></p>
                    <p class="text-red-500 font-bold">Giá: <?= number_format($row['Gia'], 0, ',', '.') ?> đ</p>
                </div>
            <?php } ?>
        </div>
    </main>
</body>
</html>