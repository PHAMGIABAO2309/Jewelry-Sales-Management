<?php
session_start();
include '../database/connect.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Bạn chưa đăng nhập']);
    exit();
}

$maND = $_SESSION['user_id'];
$phuongThucThanhToan = $_POST['phuongThucThanhToan'];
date_default_timezone_set('Asia/Ho_Chi_Minh'); // Đặt múi giờ Việt Nam
$ngayXuatHang = date('Y-m-d H:i:s'); // Lấy thời gian hiện tại



// Tạo MaPhieuXuat tự động (HD01, HD02, ...)
$sqlMax = "SELECT MAX(MaPhieuXuat) AS maxHD FROM xuathang";
$resultMax = $conn->query($sqlMax);
$row = $resultMax->fetch_assoc();
if ($row['maxHD']) {
    $soHD = (int) substr($row['maxHD'], 2) + 1;
    $maPhieuXuat = "HD" . str_pad($soHD, 2, '0', STR_PAD_LEFT);
} else {
    $maPhieuXuat = "HD01"; // Nếu chưa có đơn nào, bắt đầu từ HD01
}

// Lấy giỏ hàng
$sql = "SELECT MaSP, SoLuong, TongTien FROM giohang WHERE MaND = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $maND);
$stmt->execute();
$result = $stmt->get_result();
$cartItems = $result->fetch_all(MYSQLI_ASSOC);

if (empty($cartItems)) {
    echo json_encode(['status' => 'error', 'message' => 'Giỏ hàng trống']);
    exit();
}

// Lưu vào bảng xuathang
$sqlInsert = "INSERT INTO xuathang (MaSP, SoLuong, TongTien, NgayXuatHang, MaND, MaPhieuXuat, PhuongThucThanhToan) VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmtInsert = $conn->prepare($sqlInsert);

foreach ($cartItems as $item) {
    $stmtInsert->bind_param("sssssss", $item['MaSP'], $item['SoLuong'], $item['TongTien'], $ngayXuatHang, $maND, $maPhieuXuat, $phuongThucThanhToan);
    $stmtInsert->execute();
}

// Xóa giỏ hàng sau khi đặt
$conn->query("DELETE FROM giohang WHERE MaND = '$maND'");

echo json_encode(['status' => 'success', 'message' => 'Đặt hàng thành công!', 'maPhieuXuat' => $maPhieuXuat]);
?>
