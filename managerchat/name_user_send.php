<?php
session_start();
include '../database/connect.php';

header('Content-Type: application/json');

$filterTenND = isset($_GET['TenND']) ? $_GET['TenND'] : '';

$response = [];

if (!empty($filterTenND)) {
    $sql = "SELECT tn.NoiDung, tn.ThoiGian
            FROM tinnhan tn
            INNER JOIN nguoidung nd 
            ON tn.MaNguoiGui = nd.MaND 
            WHERE nd.TenND = ? 
            ORDER BY tn.ThoiGian";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $filterTenND);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $response[] = [
            "NoiDung" => htmlspecialchars($row["NoiDung"]),
            "ThoiGian" => date("d-m-Y H:i:s", strtotime($row["ThoiGian"]))
        ];
    }
}

echo json_encode($response);
?>
