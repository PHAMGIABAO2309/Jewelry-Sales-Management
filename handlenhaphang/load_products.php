<?php
session_start();
include dirname(__DIR__) . '/database/connect.php';

// Nếu không có MaCTDM, lấy tất cả sản phẩm
if (!isset($_POST['MaCTDM']) || empty($_POST['MaCTDM'])) {
    $sql = "SELECT MaSP, TenSP, Gia, SoLuong, NgayNhap FROM sanpham";
    $stmt = $conn->prepare($sql);
} else {
    $maCTDM = $_POST['MaCTDM'];
    $sql = "SELECT MaSP, TenSP, Gia, SoLuong, NgayNhap FROM sanpham WHERE MaCTDM = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $maCTDM);
}

if (!$stmt) {
    die("Lỗi truy vấn: " . $conn->error);
}

$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr class='text-center hover:bg-blue-300 transition'>";
        echo "<td class='px-4 py-2'>{$row['MaSP']}</td>";
        echo "<td class='px-4 py-2'>{$row['TenSP']}</td>";
        echo "<td class='px-4 py-2'>" . number_format($row['Gia'], 0, ',', '.') . " VND</td>";
        echo "<td class='px-4 py-2'>{$row['SoLuong']}</td>";
        echo "<td class='px-4 py-2'>{$row['NgayNhap']}</td>";
        echo "<td class='px-4 py-2'><img src='../images/{$row['MaSP']}.jpg' class='mx-auto w-20 h-20 object-cover border'></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='6' class='text-center'>Không có sản phẩm nào!</td></tr>";
}
?>
