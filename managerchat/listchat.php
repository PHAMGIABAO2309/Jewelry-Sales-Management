<?php
session_start();
include '../database/connect.php';

// Kiểm tra nếu có tham số TenND được gửi lên
$filterTenND = isset($_GET['TenND']) ? $_GET['TenND'] : '';

// Nếu có bộ lọc, lấy toàn bộ tin nhắn của người đó
if (!empty($filterTenND)) {
    $sql = "SELECT nd.TenND AS TenKH, tn.NoiDung, tn.ThoiGian, tn.MaNguoiGui, nd.avt
            FROM tinnhan tn
            INNER JOIN nguoidung nd 
            ON tn.MaNguoiGui = nd.MaND 
            WHERE nd.TenND = ? 
            ORDER BY tn.ThoiGian ";
} else {
    // Nếu không lọc, lấy tin nhắn mới nhất của từng người gửi
    $sql = "SELECT nd.TenND AS TenKH, tn.NoiDung, tn.ThoiGian, tn.MaNguoiGui, nd.avt
            FROM tinnhan tn
            INNER JOIN (
                SELECT MaNguoiGui, MAX(ThoiGian) AS LatestTime
                FROM tinnhan
                GROUP BY MaNguoiGui
            ) latest 
            ON tn.MaNguoiGui = latest.MaNguoiGui AND tn.ThoiGian = latest.LatestTime
            INNER JOIN nguoidung nd 
            ON tn.MaNguoiGui = nd.MaND";
}

$stmt = $conn->prepare($sql);

// Nếu có bộ lọc, bind giá trị vào prepared statement
if (!empty($filterTenND)) {
    $stmt->bind_param("s", $filterTenND);
}

$stmt->execute();
$result = $stmt->get_result();
?>