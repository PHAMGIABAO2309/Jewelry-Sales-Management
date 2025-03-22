<?php
include '../database/connect.php'; 
include '../actions/danhmuc.php'; 
include '../actions/dropdownbosuutap.php'; 
include '../actions/dropdowndongtrangsuc.php';
include '../actions/dropdownloaisanpham.php';
?>

<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>Gia Bảo Jewelry</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link rel="icon" type="image/png" href="https://storage.googleapis.com/a1aa/image/idUd40l_cpmB-xqRpUgornlkLqPLLy0mvYxRHI7Vcd8.jpg">
  <link rel="stylesheet" href="../assets/navbar.css">
  <script src="../handle/dropdownprofile.js"></script>
  <script src="../handle/dropdownbosuutap.js"></script>
  <script src="../handle/dropdowndongtrangsuc.js"></script>
  <script src="../handle/dropdownloaisanpham.js"></script>
  <script src="../handle/dropdownthanhtoan.js"></script>
  <script src="../handle/dropdownchat.js"></script>
</head>
 <body class="bg-white text-black flex flex-col h-screen">
    <header class="flex items-center justify-between p-4 bg-gray-100 w-full fixed top-0 left-0 ">
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
    <main class="flex-1 overflow-auto p-4 mt-[56px] mb-[72px] w-full">
        <div class="max-w-4xl mx-auto bg-white p-6 shadow-lg rounded-xl">
            <?php
                // Kiểm tra nếu chưa đăng nhập
                if (!isset($_SESSION['user_id'])) {
                    die("Bạn chưa đăng nhập. <a href='login.php'>Đăng nhập</a>");
                }
                $maND = $_SESSION['user_id'];
                // Truy vấn lấy giỏ hàng
                $sql = "SELECT nd.TenND, sp.MaSP, sp.TenSP, xh.SoLuong, sp.Gia, xh.NgayXuatHang, xh.MaPhieuXuat, xh.TongTien
                        FROM nguoidung nd
                        JOIN xuathang xh ON nd.MaND = xh.MaND
                        JOIN sanpham sp ON xh.MaSP = sp.MaSP
                        WHERE nd.MaND = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $maND);
                $stmt->execute();
                $result = $stmt->get_result();
                $cartItems = $result->fetch_all(MYSQLI_ASSOC);
                // Kiểm tra giỏ hàng rỗng
                if (empty($cartItems)) {
                    echo "<p class='text-center text-gray-500'>Giỏ hàng của bạn đang trống.</p>";
                } else {
                    // Thêm cột TongTien vào mỗi sản phẩm
                    $tongThanhToan = 0;
                    foreach ($cartItems as &$item) {
                        $item['TongTien'] = $item['SoLuong'] * $item['Gia'];
                        $tongThanhToan += $item['TongTien'];
                    }
                    unset($item); // Giải phóng biến để tránh lỗi tham chiếu

                    // Nhóm sản phẩm theo MaPhieuXuat
                    $groupedItems = [];
                    foreach ($cartItems as $item) {
                        $groupedItems[$item['MaPhieuXuat']][] = $item;
                    }
                    ?>
                <!-- Navigation -->
                <div class="flex justify-between items-center border-b pb-3">
                    <div class="flex space-x-6 text-sm font-medium">
                    <a class="text-gray-500 hover:text-red-500 transition" href="#">Tất cả</a>
                    <a class="text-red-500 border-b-2 border-red-500 pb-1" href="#">Chờ thanh toán (1)</a>
                    <a class="text-gray-500 hover:text-red-500 transition" href="#">Vận chuyển</a>
                    <a class="text-gray-500 hover:text-red-500 transition" href="#">Chờ giao hàng</a>
                    <a class="text-gray-500 hover:text-red-500 transition" href="#">Hoàn thành</a>
                    <a class="text-gray-500 hover:text-red-500 transition" href="#">Đã hủy</a>
                    <a class="text-gray-500 hover:text-red-500 transition" href="#">Trả hàng/Hoàn tiền</a>
                    </div>
                </div>

                    <!-- Hiển thị thông tin chung -->
                <div class="mt-6">
                    <h2 class="text-xl font-semibold">Thông tin đơn hàng</h2>
                    <p class="text-gray-600">Tên người dùng: <b><?php echo htmlspecialchars($cartItems[0]['TenND']); ?></b></p>
                </div>

                <?php foreach ($groupedItems as $maPhieuXuat => $items) { ?>
                    <div class="mt-6 border-2 border-gray-800 p-4 rounded-lg shadow-md">
                        <h2 class="text-lg font-bold text-gray-800">Mã phiếu xuất: <?php echo htmlspecialchars($maPhieuXuat); ?></h2>
                        <p class="text-gray-600 text-sm">Ngày xuất hàng: <?php echo date('d/m/Y H:i:s', strtotime($items[0]['NgayXuatHang'])); ?></p>
                        <?php foreach ($items as $row) { ?>
                            <div class="mt-4 flex items-center border-b pb-4">
                                <img src="../images/<?php echo htmlspecialchars($row['MaSP']); ?>.jpg" class="w-24 h-24 object-cover rounded-lg shadow-sm border">
                                <div class="ml-5 flex-1">
                                    <h2 class="text-gray-800 font-semibold text-lg"><?php echo htmlspecialchars($row['TenSP']); ?></h2>
                                    <p class="text-gray-500 text-sm">Số lượng: x<?php echo htmlspecialchars($row['SoLuong']); ?></p>
                                </div>
                                <div class="text-right">
                                    <p class="text-red-500 font-semibold text-lg"><?php echo number_format($row['TongTien'], 0, ',', '.'); ?> VNĐ</p>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
            <?php } ?>
            <?php $_SESSION['tongThanhToan'] = $tongThanhToan ?? 0; ?>
            <!-- Tong Tien Phai Tra -->
            <div class="mt-6 flex justify-between items-center border-t pt-4">
                <span class="text-gray-700 text-lg font-medium">Tổng thanh toán</span>
                <span class="text-red-500 text-2xl font-bold">
                    <?php echo number_format($_SESSION['tongThanhToan'], 0, ',', '.'); ?> VNĐ
                </span>
            </div>

            <!-- Cac nut -->
            <div class="mt-6 flex justify-end space-x-3">
                <button class="bg-gray-300 text-gray-500 px-5 py-2 rounded-lg cursor-not-allowed">Chờ</button>
                <button id="menuchat" class="bg-blue-500 text-white px-5 py-2 rounded-lg shadow-md hover:bg-blue-600 transition">Gửi tin nhắn</button>
                <button class="bg-red-500 text-white px-5 py-2 rounded-lg shadow-md hover:bg-red-600 transition">Hủy Đơn Hàng</button>
            </div>
        </div>>
        <?php include '../actions/dropdownchat.php'; ?>
    </main>
 </body>
 </html>