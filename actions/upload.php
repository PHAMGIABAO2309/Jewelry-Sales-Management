<?php
session_start();
include '../database/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["file"])) {
    $targetDir = "../images/";

    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    $file = $_FILES["file"];
    $fileType = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
    $allowedTypes = ["jpg", "jpeg", "png"];

    if (!in_array($fileType, $allowedTypes)) {
        echo "Lỗi: Chỉ chấp nhận file JPG, JPEG, PNG!";
        exit;
    }

    if ($file["size"] > 1 * 1024 * 1024) {
        echo "Lỗi: Kích thước file quá lớn!";
        exit;
    }

    $newFileName = uniqid() . "." . $fileType;
    $targetFilePath = $targetDir . $newFileName;

    if (move_uploaded_file($file["tmp_name"], $targetFilePath)) {
        // Trả về đường dẫn tương đối của ảnh
        echo "images/" . $newFileName;
    } else {
        echo "Lỗi: Không thể tải lên file!";
    }
}
?>
