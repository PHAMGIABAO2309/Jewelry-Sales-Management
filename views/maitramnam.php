<?php
include '../database/connect.php'; 
include '../actions/danhmuc.php'; 
include '../actions/dropdownbosuutap.php'; 
include '../actions/dropdowndongtrangsuc.php';
include '../actions/dropdownloaisanpham.php';
include '../actions/dropdowndathang.php';
include '../actions/mota.php';

// Kiểm tra xem maCTDM có được truyền vào hay không
if (isset($_GET['maCTDM'])) {
    $maCTDM = $_GET['maCTDM'];
    // Truy vấn sản phẩm thuộc danh mục được chọn
    $sql = "SELECT MaSP, TenSP, Gia, SoLuong FROM SANPHAM WHERE MaCTDM = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $maCTDM);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    echo "<p>Không có danh mục nào được chọn.</p>";
    exit;
}
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
  <script src="../handle/dropdownchat.js"></script>
  <script src="../handle/dropdowndathang.js"></script>
</head>
 <body class="bg-white text-black">
    <header class="flex items-center justify-between p-4 bg-gray-100">
        <!-- Logo và Danh mục sản phẩm -->
        <div class="flex items-center space-x-4 relative">
            <a href="../views/home.php">
                <img alt="Logo" class="h-8 " height="30" src="https://storage.googleapis.com/a1aa/image/RR8CRsz-B4mwtszDDQi_5Jz4xLoLiQOI1N6dCsXCOP0.jpg" width="30"/>
            </a>
            <div class="relative"><?php echo getDanhMuc($conn); ?></div>
        </div>
        <!-- Ô tìm kiếm + Thông tin user -->
        <div class="flex items-center space-x-4 ml-auto">
            <div class="relative">
                <input class="border rounded-full p-2 w-96 pl-10" placeholder="Tìm Sản Phẩm: Ví dụ: kiềng, dây chuyền..." type="text" />
                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
            </div>

            <?php if (isset($_SESSION['user_name']) && isset($_SESSION['user_id'])): ?>
                <a id="userDropdown" class="flex items-center space-x-1 cursor-pointer" href="#">
                    <i class="fas fa-user"></i>
                    <span><?= $_SESSION['user_name']; ?></span>
                    <!-- <small>ID<?= $_SESSION['user_id']; ?></small> Hiển thị ID -->
                </a>
                <?php include '../actions/dropdownprofile.php'; ?>
                <a class="flex items-center space-x-1 text-red-500" href="../actions/logout.php"><i class="fas fa-sign-out-alt"></i><span>Đăng Xuất</span></a>
            <?php else: ?>
                <a class="flex items-center space-x-1" href="login.php"><i class="fas fa-user"></i><span>Đăng Nhập</span></a>
            <?php endif; ?>
            
        </div>
    </header>
    <main>
        <div class="container mx-auto p-4">
            <div class="text-center px-4">
                <h2 class="text-red-800 text-lg font-semibold mb-2"><?= $_SESSION['TenBoSuuTap']; ?></h2>
                <h1 class="text-red-800 text-5xl font-bold mb-4"> <?php echo getMoTa($conn); ?> <?= $_SESSION['TenMaiTramNam']; ?> </h1>
                <p class="text-gray-700 text-base max-w-2xl mx-auto"><?= $_SESSION['MoTaMaiTramNam']; ?></p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-5 p-4">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="bg-white p-4 rounded shadow group overflow-hidden">
                        <div>
                            <a href="../details/detailsmaitramnam.php?MaSP=<?= urlencode($row['MaSP']) ?>">
                                <img alt="<?= htmlspecialchars($row['TenSP']) ?>" 
                                    class="w-full h-auto cursor-pointer" height="300" 
                                    src="../images/<?= htmlspecialchars($row['MaSP']) ?>.jpg" width="300"/>
                            </a>
                            <!-- Hiệu ứng hover từ đáy ảnh lên -->
                            <div class="relative">
                                <div class="absolute bottom-0 left-0 w-full opacity-0 translate-y-full transition-all duration-300 ease-in-out group-hover:translate-y-0 group-hover:opacity-100">
                                    <div class="flex justify-around py-4 bg-white shadow-lg rounded">
                                        <button  class="menuorder text-gray-700 hover:text-gray" 
                                            data-masp="<?= htmlspecialchars($row['MaSP']) ?>" 
                                            data-tensp="<?= htmlspecialchars($row['TenSP']) ?>" 
                                            data-soluongsp="<?= $row['SoLuong'] ?>"
                                            data-gia="<?= $row['Gia'] ?>"
                                            data-mand="<?= $_SESSION['user_id']; ?>">
                                            <i class="fas fa-shopping-cart hover:text-red-500 " title="Thêm vào giỏ hàng"></i>
                                        </button>
                                        <button class="text-gray-700 hover:text-black"><i class="fas fa-heart"></i></button>
                                        <button class="text-gray-700 hover:text-black"><i class="fas fa-shopping-bag"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="../details/detailsmaitramnam.php?MaSP=<?= urlencode($row['MaSP']) ?>">
                            <h2 class="text-lg font-semibold text-center cursor-pointer"><?= htmlspecialchars($row['TenSP']) ?></h2>
                        </a>
                        <p class="text-black font-bold text-center" style="color:red;">
                            <?= number_format($row['Gia'], 0, ',', '.') ?> VNĐ
                        </p>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
        <div class="fixed bottom-4 right-4">
            <button id="menuchat" class="bg-red-600 text-white p-4 rounded-full shadow-lg"><i class="fas fa-comments"></i></button> 
        </div>
        <?php include '../actions/dropdownchat.php'; ?>
    </main>
    
 </body>
</html>