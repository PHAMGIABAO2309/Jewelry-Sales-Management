<?php
session_start();
include dirname(__DIR__) . '/database/connect.php';

if (!isset($_SESSION['user_name'])) {
    echo json_encode(["success" => false, "message" => "Bạn chưa đăng nhập"]);
    exit();
}

$user_id = $_SESSION['user_name'];
$new_email = filter_var($_POST['new_email'], FILTER_SANITIZE_EMAIL);

if (!filter_var($new_email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(["success" => false, "message" => "Email không hợp lệ"]);
    exit();
}

// Câu lệnh SQL sửa lỗi
$sql = "UPDATE nguoidung SET Email = ? WHERE TenND = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $new_email, $user_id); // Chuyển "si" thành "ss"

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) { // Chỉ cập nhật khi có hàng bị ảnh hưởng
        $_SESSION['user_email'] = $new_email;
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "Không tìm thấy tài khoản hoặc email không thay đổi"]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Lỗi cập nhật email"]);
}

$stmt->close();
$conn->close();
?>

