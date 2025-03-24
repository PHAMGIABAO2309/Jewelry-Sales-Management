<?php
session_start();
include dirname(__DIR__) . '/database/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['tenDM'])) {
    $tenDM = trim($_POST['tenDM']);

    if ($tenDM == "") {
        echo json_encode(["status" => "error", "message" => "Tên danh mục không được để trống!"]);
        exit();
    }

    // Lấy mã danh mục mới (DM01, DM02, ...)
    $query = "SELECT MaDM FROM danhmuc ORDER BY MaDM DESC LIMIT 1";
    $result = $conn->query($query);
    $newMaDM = "DM01";

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $lastMaDM = $row["MaDM"];
        $number = (int)substr($lastMaDM, 2) + 1;
        $newMaDM = "DM" . str_pad($number, 2, "0", STR_PAD_LEFT);
    }

    // Thêm vào database
    $insertQuery = "INSERT INTO danhmuc (MaDM, TenDM) VALUES ('$newMaDM', '$tenDM')";
    if ($conn->query($insertQuery) === TRUE) {
        echo json_encode(["status" => "success", "newMaDM" => $newMaDM]);
    } else {
        echo json_encode(["status" => "error", "message" => $conn->error]);
    }
}
?>
