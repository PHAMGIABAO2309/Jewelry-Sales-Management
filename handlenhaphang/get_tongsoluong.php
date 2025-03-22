<?php
include dirname(__DIR__) . '/database/connect.php';

$maCTDM = isset($_GET['MaCTDM']) ? $_GET['MaCTDM'] : '';

if ($maCTDM !== '') {
    $sql = "SELECT cdm.TenCTDM, SUM(sp.SoLuong) AS TongSoLuong 
            FROM sanpham sp 
            JOIN chitietdanhmuc cdm ON sp.MaCTDM = cdm.MaCTDM 
            WHERE sp.MaCTDM = ?
            GROUP BY cdm.TenCTDM";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $maCTDM);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
} else {
    // Nếu không chọn MaCTDM, lấy tổng số lượng tất cả sản phẩm và không có tên danh mục cụ thể
    $sql = "SELECT SUM(SoLuong) AS TongSoLuong FROM sanpham";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $row['TenCTDM'] = 'Tất cả danh mục';
}

echo json_encode([
    'TenCTDM' => $row['TenCTDM'] ?? 'Không xác định',
    'TongSoLuong' => $row['TongSoLuong'] ?? 0
]);
?>
