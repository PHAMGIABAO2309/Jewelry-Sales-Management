<?php
session_start();
include dirname(__DIR__) . '/database/connect.php';

if (isset($_GET["MaCTDM"]) && isset($_GET["MaDM"])) {
    $maCTDM = $_GET["MaCTDM"];
    $maDM = $_GET["MaDM"];

    $stmt = $conn->prepare("SELECT TenCTDM, MoTa FROM chitietdanhmuc WHERE MaCTDM = ? AND MaDM = ?");
    $stmt->bind_param("ii", $maCTDM, $maDM);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($row = $result->fetch_assoc()) {
        echo json_encode($row);
    } else {
        echo json_encode(["error" => "Không tìm thấy dữ liệu"]);
    }
    $stmt->close();
}
?>
