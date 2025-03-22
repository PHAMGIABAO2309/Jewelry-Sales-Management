<?php
session_start();
include '../database/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mand = $_POST["mand"];
    $masp = $_POST["masp"];
    $tensp = $_POST["tensp"];
    $gia = intval($_POST["gia"]);
    $soluong = intval($_POST["soluong"]);
    $tongtien = $gia * $soluong;

    // Truy vấn MaGH mới nhất
    $sql = "SELECT MaGH FROM giohang ORDER BY MaGH DESC LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $latestMaGH = $row["MaGH"];
        $num = intval(substr($latestMaGH, 2)) + 1;
        $newMaGH = "GH" . str_pad($num, 2, "0", STR_PAD_LEFT);
    } else {
        $newMaGH = "GH01";
    }

    // Chèn vào database
    $sql = "INSERT INTO giohang (MaGH, MaND, MaSP, TenSP, Gia, SoLuong, TongTien) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssiii", $newMaGH, $mand, $masp, $tensp, $gia, $soluong, $tongtien);

    if ($stmt->execute()) {
        echo "Thêm vào giỏ hàng thành công!";
    } else {
        echo "Lỗi: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
