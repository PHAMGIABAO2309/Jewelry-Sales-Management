<?php
session_start();
include dirname(__DIR__) . '/database/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['maDM'])) {
    $maDM = $_POST['maDM'];

    // Kiểm tra chi tiet danh mục có tồn tại không
    $checkQuery = "SELECT * FROM chitietdanhmuc WHERE MaCTDM = '$maDM'";
    $checkResult = $conn->query($checkQuery);

    if ($checkResult->num_rows > 0) {
        // Thực hiện xóa
        $deleteQuery = "DELETE FROM chitietdanhmuc WHERE MaCTDM = '$maDM'";
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
