<?php
session_start();
include dirname(__DIR__) . '/database/connect.php';

$query = "SELECT MaSP FROM sanpham ORDER BY MaSP DESC LIMIT 1";
$result = $conn->query($query);

if ($row = $result->fetch_assoc()) {
    $latestMaSP = (int) filter_var($row['MaSP'], FILTER_SANITIZE_NUMBER_INT); // Lấy số từ MaSP
    echo $latestMaSP + 1;
} else {
    echo 1; // Nếu chưa có sản phẩm nào, bắt đầu từ 1
}
?>
