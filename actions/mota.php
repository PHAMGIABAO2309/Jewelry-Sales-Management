<?php

include dirname(__DIR__) . '/database/connect.php';

function getMoTa($conn)
{
    $sql = "SELECT TenCTDM, MoTa FROM chitietdanhmuc WHERE MaCTDM = 'CTDM01'";
    $result = $conn->query($sql);
    
    if (!$result) {
        die("Lỗi truy vấn: " . $conn->error);
    }

    while ($row = $result->fetch_assoc()) {
        $tenCTDM = $row["TenCTDM"];
        $moTa = $row["MoTa"];

        // Lưu vào session nếu là "Mai trăm năm"
        if ($tenCTDM === "Mai trăm năm") {
            $_SESSION["TenMaiTramNam"] = $tenCTDM;
            $_SESSION["MoTaMaiTramNam"] = $moTa; // Lưu MoTa vào session
        }
    }
}

function getMoTaCTDM03($conn)
{
    $sql = "SELECT TenCTDM, MoTa FROM chitietdanhmuc WHERE MaCTDM = 'CTDM03'";
    $result = $conn->query($sql);
    
    if (!$result) {
        die("Lỗi truy vấn: " . $conn->error);
    }

    while ($row = $result->fetch_assoc()) {
        $tenCTDM = $row["TenCTDM"];
        $moTa = $row["MoTa"];

        // Lưu vào session nếu là "Dấu ấn phái mạnh 2024"
        if ($tenCTDM === "Dấu ấn phái mạnh 2024") {
            $_SESSION["TenDauAnPhaiManh"] = $tenCTDM;
            $_SESSION["MoTaDauAnPhaiManh"] = $moTa; // Lưu MoTa vào session
        }
    }
}

function getMoTaCTDM19($conn)
{
    $sql = "SELECT TenCTDM, MoTa FROM chitietdanhmuc WHERE MaCTDM = 'CTDM19'";
    $result = $conn->query($sql);
    
    if (!$result) {
        die("Lỗi truy vấn: " . $conn->error);
    }

    while ($row = $result->fetch_assoc()) {
        $tenCTDM = $row["TenCTDM"];
        $moTa = $row["MoTa"];

        // Lưu vào session nếu là "nhẫn nữ"
        if ($tenCTDM === "Nhẫn nữ") {
            $_SESSION["TenNhanNu"] = $tenCTDM;
            $_SESSION["MoTaNhanNu"] = $moTa; // Lưu MoTa vào session
        }
    }
}
?>
