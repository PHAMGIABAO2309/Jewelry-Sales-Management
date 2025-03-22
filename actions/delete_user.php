<?php
session_start();
include '../database/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['MaND'])) {
    $MaND = trim($_POST['MaND']);

    if (empty($MaND)) {
        echo "error: MaND rỗng!";
        exit();
    }

    $query = "DELETE FROM nguoidung WHERE MaND = ?";
    $stmt = mysqli_prepare($conn, $query);
    
    if (!$stmt) {
        echo "error: Không thể chuẩn bị truy vấn!";
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $MaND);
    $success = mysqli_stmt_execute($stmt);

    if ($success) {
        echo "success";
    } else {
        echo "error: Không thể xóa!";
    }
} else {
    echo "error: Dữ liệu không hợp lệ!";
}
?>
