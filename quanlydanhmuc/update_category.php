<?php
session_start();
include dirname(__DIR__) . '/database/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $maDM = $_POST["maDM"];
    $tenDM = $_POST["tenDM"];

    $sql = "UPDATE danhmuc SET TenDM = ? WHERE MaDM = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $tenDM, $maDM);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Cập nhật thất bại"]);
    }
    $stmt->close();
    $conn->close();
}
?>
