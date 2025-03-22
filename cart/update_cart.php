<?php
session_start();
include '../database/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mand = $_POST["mand"];
    $masp = $_POST["masp"];
    $soluong = intval($_POST["soluong"]);

    // Lấy giá sản phẩm từ bảng sanpham
    $gia_sql = "SELECT Gia FROM sanpham WHERE MaSP = ?";
    $stmt = $conn->prepare($gia_sql);
    $stmt->bind_param("s", $masp);
    $stmt->execute();
    $result = $stmt->get_result();
    $gia = $result->fetch_assoc()["Gia"];

    // Kiểm tra sản phẩm đã tồn tại trong giỏ hàng hay chưa
    $check_sql = "SELECT * FROM giohang WHERE MaND = ? AND MaSP = ?";
    $stmt = $conn->prepare($check_sql);
    $stmt->bind_param("ss", $mand, $masp);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Nếu sản phẩm đã tồn tại, cập nhật số lượng và tổng tiền
        $update_sql = "UPDATE giohang SET SoLuong = ?, TongTien = ? WHERE MaND = ? AND MaSP = ?";
        $tongtien = $gia * $soluong;
        $stmt = $conn->prepare($update_sql);
        $stmt->bind_param("iiss", $soluong, $tongtien, $mand, $masp);
    } else {
        // Nếu chưa có, thêm mới sản phẩm vào giỏ hàng
        $insert_sql = "INSERT INTO giohang (MaND, MaSP, SoLuong, TongTien) VALUES (?, ?, ?, ?)";
        $tongtien = $gia * $soluong;
        $stmt = $conn->prepare($insert_sql);
        $stmt->bind_param("ssii", $mand, $masp, $soluong, $tongtien);
    }

    if ($stmt->execute()) {
        echo "Cập nhật thành công!";
    } else {
        echo "Lỗi: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
