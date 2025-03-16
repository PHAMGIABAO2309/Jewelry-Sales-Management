<?php
session_start();
include '../database/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["imagePath"])) {
    if (!isset($_SESSION['user_name'])) {
        echo "Bạn chưa đăng nhập!";
        exit();
    }

    $tenND = $_SESSION['user_name']; // Lấy TenND từ session
    $newAvatar = $_POST["imagePath"];

    $stmt = $conn->prepare("UPDATE nguoidung SET avt = ? WHERE TenND = ?");
    $stmt->bind_param("ss", $newAvatar, $tenND); // "ss" vì cả hai đều là string

    if ($stmt->execute()) {
        $_SESSION['user_avt'] = $newAvatar; // Cập nhật session
        echo "Ảnh đại diện đã được cập nhật!";
    } else {
        echo "Lỗi: Không thể cập nhật ảnh!";
    }

    $stmt->close();
    $conn->close();
}
?>
