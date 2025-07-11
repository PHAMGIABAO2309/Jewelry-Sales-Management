<?php
$servername = "localhost"; // Thay đổi nếu server khác
$username = "root"; // Tên tài khoản MySQL
$password = ""; // Mật khẩu MySQL (để trống nếu chưa đặt)
$database = "webbanvangg"; // Tên database

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $database);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
?>
