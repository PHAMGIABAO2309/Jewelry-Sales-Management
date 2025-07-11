<?php
session_start();
include dirname(__DIR__) . '/database/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["MaPhieuXuat"])) {
    $maPhieuXuat = $_POST["MaPhieuXuat"];

    $stmt = $conn->prepare("DELETE FROM xuathang WHERE MaPhieuXuat = ?");
    $stmt->bind_param("s", $maPhieuXuat);

    if ($stmt->execute()) {
        echo "Đã xóa thành công tất cả đơn hàng có Mã Phiếu Xuất: " . $maPhieuXuat;
    } else {
        echo "Lỗi khi xóa đơn hàng!";
    }

    $stmt->close();
    $conn->close();
}
?>
