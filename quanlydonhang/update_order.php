<?php
session_start();
include dirname(__DIR__) . '/database/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $maPhieuXuat = $_POST["MaPhieuXuat"];
    $phuongThucThanhToan = $_POST["PhuongThucThanhToan"];

    $sql = "UPDATE xuathang 
            SET PhuongThucThanhToan='$phuongThucThanhToan' 
            WHERE MaPhieuXuat='$maPhieuXuat'";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["status" => "success", "message" => "Cập nhật đơn hàng thành công!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Lỗi cập nhật: " . $conn->error]);
    }

    $conn->close();
}
?>

