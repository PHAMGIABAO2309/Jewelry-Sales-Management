<?php
include '../database/connect.php'; 

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $tenCTDM = trim($_POST["tenCTDM"]);
    $MaDM = $_POST["MaDM"];

    if (empty($tenCTDM) || empty($MaDM)) {
        echo json_encode(["status" => "error", "message" => "Dữ liệu không hợp lệ!"]);
        exit;
    }

    // **Lấy mã CTDM cuối cùng**
    $query = "SELECT MaCTDM FROM chitietdanhmuc ORDER BY MaCTDM DESC LIMIT 1";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    $lastRow = $result->fetch_assoc();
    $stmt->close(); // Đóng statement sau khi sử dụng

    if ($lastRow) {
        $lastCode = $lastRow["MaCTDM"];
        $number = (int)substr($lastCode, 4) + 1; // Lấy số cuối và tăng lên 1
    } else {
        $number = 1;
    }

    $MaCTDM = "CTDM" . str_pad($number, 2, "0", STR_PAD_LEFT);

    // **Thực hiện INSERT**
    $insert_sql = "INSERT INTO chitietdanhmuc (MaCTDM, TenCTDM, MaDM) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($insert_sql);
    $stmt->bind_param("sss", $MaCTDM, $tenCTDM, $MaDM);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Thêm thành công", "MaCTDM" => $MaCTDM, "TenCTDM" => $tenCTDM, "MaDM" => $MaDM]);
    } else {
        echo json_encode(["status" => "error", "message" => "Lỗi khi thêm dữ liệu"]);
    }

    $stmt->close();
    $conn->close();
}
?>
