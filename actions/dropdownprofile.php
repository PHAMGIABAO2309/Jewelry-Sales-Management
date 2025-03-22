<?php
// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['user_email'])) {
    header("Location: ../views/login.php");
    exit();
}

$email = $_SESSION['user_email'];
?>
<?php
$tongChiTieu = $_SESSION['tongThanhToan'] ?? 0;

// Xác định hạng thành viên và màu nền
if ($tongChiTieu >= 500000000) {
    $hangThanhVien = "Kim cương";
    $background = "bg-gradient-to-r from-blue-300 via-blue-400 to-blue-600 animate-pulse shadow-lg shadow-blue-500/50";
} elseif ($tongChiTieu >= 100000000) {
    $hangThanhVien = "Vàng";
    $background = "bg-gradient-to-r from-yellow-300 to-yellow-500 shadow-lg shadow-yellow-500/50";
} elseif ($tongChiTieu >= 10000000) {
    $hangThanhVien = "Bạc";
    $background = "bg-gradient-to-r from-gray-300 to-gray-500 shadow-lg shadow-gray-400/50";
} else {
    $hangThanhVien = "Đồng";
    $background = "bg-gradient-to-r from-orange-400 to-orange-600 shadow-lg shadow-orange-500/50";
}
?>

<div id="dropdownMenu" class=" absolute right-4 mt-1 w-80  top-[46px] bg-white shadow-lg rounded-lg overflow-hidden hidden">
    <div class="p-4 bg-yellow-100 flex items-start justify-between">
        <div class="flex items-center">
            <img alt="User avatar" class="w-10 h-10 rounded-full mr-3" height="40"
                src="../<?= $_SESSION['user_avt'] ?>"
                width="40" />
                <div>
                    <p class="font-bold text-gray-800"><?= htmlspecialchars($email); ?></p>
                    <p class="text-sm text-gray-600"><?= htmlspecialchars($email); ?></p>
                    <p class="text-sm text-gray-600">Tổng chi tiêu: <span class="text-red-500 font-bold"><?= number_format($tongChiTieu, 0, ',', '.'); ?> VNĐ</span> </p>
                </div>
        </div>
        <button id="closeDropdown" class="text-gray-600"><i class="fas fa-times"></i></button>
    </div>
    <div class="p-2">
    <button class="w-full text-white py-2 rounded-lg <?= $background; ?>">
        Thành viên <?= $hangThanhVien; ?>
    </button>
</div>
    <div class="p-4">
        <ul class="space-y-2">
            <li class="flex items-center text-gray-800" onclick="window.location.href='../views/personal.php';"><i class="fas fa-user-circle mr-3"></i><span>Thông tin tài khoản</span></li>
            <li class="flex items-center text-gray-800"><i class="fas fa-shopping-cart mr-3"></i><span>Giỏ hàng</span></li>
            <li class="flex items-center text-gray-800"><i class="fas fa-heart mr-3"></i><span>Sản phẩm yêu thích</span></li>
            <li class="flex items-center text-gray-800" onclick="window.location.href='../dathang/dathang.php';"><i class="fas fa-eye mr-3"></i><span>Theo dõi đơn hàng </span></li>
            <li class="flex items-center text-gray-800"><i class="fas fa-history mr-3"></i><span>Lịch sử đơn hàng</span></li>
            <li class="flex items-center text-gray-800"><i class="fas fa-bell mr-3"></i><span>Thông báo (0)</span></li>
            <li class="flex items-center text-gray-800"><i class="fas fa-key mr-3"></i><span>Đổi mật khẩu</span></li>
            <li class="flex items-center text-gray-800"><i class="fas fa-cog mr-3"></i><span>Cài đặt </span></li>
            <li class="flex items-center text-gray-800"><i class="fas fa-sign-out-alt mr-3"></i><span>Đăng xuất</span></li>
        </ul>
    </div>
</div>