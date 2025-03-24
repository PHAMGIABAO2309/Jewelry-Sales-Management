<?php
session_start();
include dirname(__DIR__) . '/database/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['maDM'])) {
    $maDM = $_POST['maDM'];

    // Kiểm tra danh mục có tồn tại không
    $checkQuery = "SELECT * FROM danhmuc WHERE MaDM = '$maDM'";
    $checkResult = $conn->query($checkQuery);

    if ($checkResult->num_rows > 0) {
        // Thực hiện xóa
        $deleteQuery = "DELETE FROM danhmuc WHERE MaDM = '$maDM'";
        if ($conn->query($deleteQuery) === TRUE) {
            echo json_encode(["status" => "success"]);
        } else {
            echo json_encode(["status" => "error", "message" => $conn->error]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Danh mục không tồn tại!"]);
    }
}
?>
