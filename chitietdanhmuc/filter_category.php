<?php
session_start();
include '../database/connect.php'; 

// Truy vấn danh mục
$sql_danhmuc = "SELECT MaDM, TenDM FROM danhmuc";
$result_danhmuc = $conn->query($sql_danhmuc);

// Truy vấn chi tiết danh mục (Ban đầu hiển thị tất cả)
$sql = "SELECT MaDM, MaCTDM, TenCTDM, MoTa FROM chitietdanhmuc";

if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST['MaDM'])) {
    $sql .= " WHERE MaDM = '" . $conn->real_escape_string($_POST['MaDM']) . "'";
}

$result = $conn->query($sql);

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

// Kiểm tra xem dữ liệu có đúng không
header('Content-Type: application/json');
echo json_encode($data);
exit;
?>
