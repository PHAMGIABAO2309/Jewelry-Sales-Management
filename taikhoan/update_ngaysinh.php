<?php
session_start();
include dirname(__DIR__) . '/database/connect.php';

if (!isset($_SESSION['user_name'])) {
    echo json_encode(["success" => false, "message" => "Bạn chưa đăng nhập"]);
    exit();
}

$user_id = $_SESSION['user_name'];
$new_ngaysinh = $_POST['new_ngaysinh']; // Lấy dữ liệu từ AJAX

// Chuyển đổi định dạng dd/mm/yyyy -> yyyy-mm-dd
$date_parts = explode("/", $new_ngaysinh);
if (count($date_parts) == 3) {
    $formatted_ngaysinh = $date_parts[2] . "-" . $date_parts[1] . "-" . $date_parts[0]; 
} else {
    echo json_encode(["success" => false, "message" => "Định dạng ngày không hợp lệ"]);
    exit();
}

// Cập nhật vào database
$sql = "UPDATE nguoidung SET NgaySinh = ? WHERE TenND = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $formatted_ngaysinh, $user_id);

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) { 
        $_SESSION['user_dob'] = $formatted_ngaysinh;
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "Không tìm thấy tài khoản hoặc ngày sinh không thay đổi"]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Lỗi cập nhật ngày sinh"]);
}

$stmt->close();
$conn->close();

?>

