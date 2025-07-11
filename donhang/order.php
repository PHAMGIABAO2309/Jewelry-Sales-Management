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
  <link rel="stylesheet" href="../css/donhang.css">
</head>
 <body class="bg-white text-black flex flex-col h-screen">
    <header class="flex items-center justify-between p-4 bg-gray-100 w-full fixed top-0 left-0 ">
        <!-- Logo và Danh mục sản phẩm -->
        <div class="flex items-center space-x-4 relative">
            <a href="../views/home.php">
                <img id="logo" alt="Logo" class="h-16 w-16 rounded-full" src="../images/logo.jpg"/>
            </a>
            <div class="relative"><?php echo getDanhMuc($conn); ?></div>
        </div>
        <!-- Ô tìm kiếm + Thông tin user -->
        <div class="flex items-center space-x-4 ml-auto">
            <div class="relative">
                <form method="GET" action="../views/timkiem.php" class="w-full">
                    <input name="search" class="border rounded-full p-2 w-96 pl-10 mt-2" placeholder="Tìm Sản Phẩm: Ví dụ: kiềng, dây chuyền..." type="text" />
                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 mt-[-4px]"></i>
                </form>
            </div>

            <?php if (isset($_SESSION['user_name']) && isset($_SESSION['user_id'])): ?>
                <a id="userDropdown" class="flex items-center space-x-1 cursor-pointer mt-[-10px]" href="#">
                    <i class="fas fa-user"></i>
                    <span><?= $_SESSION['user_name']; ?></span>
                    <!-- <small>ID<?= $_SESSION['user_id']; ?></small> Hiển thị ID -->
                </a>
                <?php include '../actions/dropdownprofile.php'; ?>
                <a class="flex items-center space-x-1 text-red-500 mt-[-10px]" href="../actions/logout.php"><i class="fas fa-sign-out-alt"></i><span>Đăng Xuất</span></a>
            <?php else: ?>
                <a class="flex items-center space-x-1" href="login.php"><i class="fas fa-user"></i><span>Đăng Nhập</span></a>
            <?php endif; ?>
        </div>
    </header>
    <main class="flex-1 overflow-auto p-4 mt-[56px] mb-[72px] w-full">
        <div class="bg-white p-6 shadow-lg rounded-lg">
            <h2 class="text-2xl font-bold mb-6 text-gray-800">🛍️ Sản phẩm</h2>
            <!-- Tiêu đề cột -->
            <div class="flex justify-between items-center font-semibold text-gray-600 border-b pb-2">
                <span class="w-1/3">Sản phẩm</span>
                <span class="w-1/4 text-center">Đơn giá</span>
                <span class="w-1/6 text-center">Số lượng</span>
                <span class="w-1/4 text-right">Thành tiền</span>
            </div>
                    
            <!-- san pham -->
            <?php
            // Kiểm tra nếu chưa đăng nhập
            if (!isset($_SESSION['user_id'])) {
                die("Bạn chưa đăng nhập. <a href='login.php'>Đăng nhập</a>");
            }
            $maND = $_SESSION['user_id'];
            // Truy vấn lấy giỏ hàng
            $sql = "SELECT MaSP, TenSP, Gia, SoLuong, TongTien FROM giohang WHERE MaND = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $maND);
            $stmt->execute();
            $result = $stmt->get_result();
            // Lấy toàn bộ dữ liệu một lần
            $cartItems = $result->fetch_all(MYSQLI_ASSOC);
            // Kiểm tra giỏ hàng rỗng
            if (empty($cartItems)) {
                echo "<p class='text-center text-gray-500'>Giỏ hàng của bạn đang trống.</p>";
            } else {
                $tongThanhToan = array_sum(array_column($cartItems, 'TongTien'));
                foreach ($cartItems as $row) {
                    ?>
                    <div class="flex justify-between items-center border-b pb-3 mb-4">
                        <div class="flex items-center space-x-4 w-1/3">
                            <img alt="Hình ảnh sản phẩm" class="w-16 h-16 rounded-lg shadow" 
                                src="../images/<?php echo htmlspecialchars($row['MaSP']); ?>.jpg"/>
                            <span class="text-gray-700 font-semibold"><?php echo htmlspecialchars($row['TenSP']); ?></span>
                        </div>
                        <span class="w-1/4 text-center text-orange-500 font-semibold">
                            <?php echo number_format($row['Gia'], 0, ',', '.'); ?> VNĐ
                        </span>
                        <span class="w-1/6 text-center font-semibold"><?php echo (int)$row['SoLuong']; ?></span>
                        <span class="w-1/4 text-right text-orange-600 font-bold">
                            <?php echo number_format($row['TongTien'], 0, ',', '.'); ?> VNĐ
                        </span>
                    </div>
                <?php } ?>
            <?php } ?>

            <!-- Thông tin giao hàng -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-xl font-bold mb-3 text-gray-800">🚚 Thông tin giao hàng</h3>
                    <div class="space-y-3">
                        <!-- Họ tên -->
                        <div>
                            <label class="block text-gray-700 font-semibold mb-1">Họ tên</label>
                            <div class="w-2/4 flex items-center border border-red-500 rounded-xl overflow-hidden focus-within:ring-2 focus-within:ring-red-500">
                                <span class="px-3 text-red-500"><i class="fas fa-user"></i></span>
                                <input class="w-full p-3 outline-none focus:border-red-600 transition-all duration-300" 
                                    type="text" 
                                    placeholder="Nhập họ tên"
                                    value="<?php echo isset($_SESSION['user_name']) ? htmlspecialchars($_SESSION['user_name']) : ''; ?>"/>
                            </div>
                        </div>

                        <!-- SĐT -->
                        <div>
                            <label class="block text-gray-700 font-semibold mb-1">SĐT</label>
                            <div class=" w-2/4 flex items-center border border-red-500 rounded-xl overflow-hidden focus-within:ring-2 focus-within:ring-red-500">
                                <span class="px-3 text-red-500"><i class="fas fa-phone"></i></span>
                                <input class="w-full p-3 outline-none focus:border-red-600 transition-all duration-300 
                                hover:border-orange-400 hover:shadow-lg   " 
                                    type="text" placeholder="Nhập số điện thoại"/>
                            </div>
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block text-gray-700 font-semibold mb-1">Email</label>
                            <div class="w-2/4 flex items-center border border-red-500 rounded-xl overflow-hidden focus-within:ring-2 focus-within:ring-red-500">
                                <span class="px-3 text-red-500"><i class="fas fa-envelope"></i></span>
                                <input class="w-full p-3 outline-none focus:border-red-600 transition-all duration-300" 
                                    type="text" placeholder="Nhập email"
                                    value="<?php echo isset($_SESSION['user_email']) ? htmlspecialchars($_SESSION['user_email']) : ''; ?>"/>
                            </div>
                        </div>

                        <!-- Địa chỉ -->
                        <div>
                            <label class="block text-gray-700 font-semibold mb-1">Địa chỉ</label>
                            <div class="w-2/4 flex items-center border border-red-500 rounded-xl overflow-hidden focus-within:ring-2 focus-within:ring-red-500">
                                <span class="px-3 text-red-500"><i class="fas fa-map-marker-alt"></i></span>
                                <input class="w-full p-3 outline-none focus:border-red-600 transition-all duration-300" 
                                    type="text" placeholder="Nhập địa chỉ"
                                    value="<?php echo isset($_SESSION['user_diachi']) ? htmlspecialchars($_SESSION['user_diachi']) : ''; ?>"/>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Hoàn tất đơn hàng -->
                <div>
                    <h3 class="text-xl font-bold mb-3 text-gray-800">✅ Hoàn tất đơn hàng</h3>
                    <div class="space-y-3 text-lg">
                        <div class="flex justify-between text-gray-700">
                            <span>Đơn hàng</span>
                            <span class="font-semibold"><?php echo number_format($tongThanhToan ?? 0, 0, ',', '.'); ?> VNĐ</span>

                        </div>
                        <div class="flex justify-between text-gray-700">
                            <span>Phương thức thanh toán</span>
                            <div class="flex space-x-2">
                                <span class="font-semibold phuongthucthanhtoan">Thanh toán tiền mặt</span>
                                <button class="text-blue-500 hover:text-blue-700" id="thanhtoan">Thay Đổi</button>
                            </div>
                        </div>

                        <div class="flex justify-between text-gray-700">
                            <span>Phí vận chuyển</span>
                            <span class="font-semibold">Miễn phí</span>
                        </div>
                        <div class="flex justify-between text-gray-700">
                            <span>Mã giảm giá</span>
                            <span class="font-semibold">0đ</span>
                        </div>
                        <div class="flex justify-between font-bold text-xl text-gray-900">
                            <span>Tổng cộng</span>
                            <span class="text-orange-500"><?php echo number_format($tongThanhToan ?? 0, 0, ',', '.'); ?> VNĐ</span>
                        </div>
                    </div>
                    <button id="btnDatHang" class="bg-red-600 hover:bg-red-700 text-white w-full p-3 rounded-lg mt-5 text-lg shadow-lg transition">
                        <i class="bi bi-cart-check"></i> Đặt hàng ngay
                    </button>
                </div>
            </div>
        </div>
        <?php include '../donhang/dropdownthanhtoan.php'?>
    </main>
    <!-- Footer -->
    <footer class="bg-gray-800 text-white fixed bottom-0 left-0 w-full shadow-md">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-center md:text-left p-2">
            <div>
                <h4 class="font-bold text-lg mb-2">🏢 Về chúng tôi</h4>
                <ul class="space-y-1 text-gray-300">
                    <li ><a href="../views/home.php">🏠 Trang Chủ</a></li>
                    <li>📰 Tin tức</li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold text-lg mb-2">📞 Tổng đài hỗ trợ</h4>
                <p class="text-orange-400 font-semibold text-lg">0829477290</p>
            </div>
            <div>
                <h4 class="font-bold text-lg mb-2">🌐 Kết nối với chúng tôi</h4>
                <p class="text-gray-300">📧 Email: <span class="text-orange-400">giabaojewelry@gmail.com</span></p>
                <div class="flex justify-center md:justify-start space-x-4 mt-2">
                    <i class="bi bi-facebook text-2xl"></i>
                    <i class="bi bi-instagram text-2xl"></i>
                    <i class="bi bi-twitter text-2xl"></i>
                </div>
            </div>
        </div>
    </footer>
    </body>
</html>
<!-- Modal thông báo đặt hàng thành công -->
<div id="successModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <h2>🎉 Đặt hàng thành công!</h2>
    <p id="orderCode">Mã phiếu xuất: <strong>PX0001</strong></p>
    <button id="redirectBtn">Xem đơn hàng</button>
  </div>
</div>
<script>
document.getElementById('btnDatHang').addEventListener('click', function() {
    let phuongThucTT = document.querySelector('.phuongthucthanhtoan').textContent.trim();
    let formData = new FormData();
    formData.append('phuongThucThanhToan', phuongThucTT);

    fetch('../donhang/add_xuathang.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        console.log("Server response:", data);
        if (data.status === 'success') {
            // Gán mã phiếu xuất vào modal
            document.getElementById('orderCode').innerHTML = "Mã phiếu xuất: <strong>" + data.maPhieuXuat + "</strong>";
            document.getElementById('successModal').style.display = 'block';

            // Tự động chuyển sau 1 giây
            setTimeout(() => {
                window.location.href = "../dathang/dathang.php";
            }, 1000); 
        } else {
            alert("Có lỗi xảy ra: " + data.message);
        }
    })
    .catch(error => console.error("Fetch error:", error));
});
</script>