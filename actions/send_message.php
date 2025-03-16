<?php
session_start();
include '../database/connect.php';

$MaNguoiGui = $_POST['MaNguoiGui'];
$MaNguoiNhan = $_POST['MaNguoiNhan'];
$NoiDung = $_POST['NoiDung'];

// Lấy MaTN lớn nhất hiện có
$query = "SELECT MaTN FROM tinnhan ORDER BY MaTN DESC LIMIT 1";
$result = $conn->query($query);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $lastMaTN = $row['MaTN'];

    // Lấy số từ TNxx
    $number = intval(substr($lastMaTN, 2)) + 1;
    $MaTN = "TN" . str_pad($number, 2, "0", STR_PAD_LEFT); // Format TN01, TN02...
} else {
    $MaTN = "TN01"; // Nếu chưa có tin nhắn nào
}

// Thêm tin nhắn mới vào database
$query = "INSERT INTO tinnhan (MaTN, MaNguoiGui, MaNguoiNhan, NoiDung, ThoiGian) VALUES (?, ?, ?, ?, NOW())";
$stmt = $conn->prepare($query);
$stmt->bind_param("ssss", $MaTN, $MaNguoiGui, $MaNguoiNhan, $NoiDung);

if ($stmt->execute()) {
    echo "success";
} else {
    echo "error";
}

$conn->close();
?>
