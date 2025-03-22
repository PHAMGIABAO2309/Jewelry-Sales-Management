<?php
session_start();
include '../database/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST["masp"]) || empty($_POST["masp"])) {
        die("Lỗi: Không có mã sản phẩm được gửi.");
    }
    $masp = $_POST["masp"];
    $sql = "DELETE FROM giohang WHERE MaSP = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $masp);

    if ($stmt->execute()) {
        echo "Xóa sản phẩm khỏi giỏ hàng thành công!";
    } else {
        echo "Lỗi khi xóa: " . $conn->error;
    }
    $stmt->close();
    $conn->close();
}

?>
