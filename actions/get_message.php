<?php
session_start();
include '../database/connect.php';

$MaNguoiGui = $_GET['MaNguoiGui'];
$MaNguoiNhan = $_GET['MaNguoiNhan'];

$query = "SELECT * FROM tinnhan WHERE (MaNguoiGui = ? AND MaNguoiNhan = ?) OR (MaNguoiGui = ? AND MaNguoiNhan = ?) ORDER BY ThoiGian ASC";
$stmt = $conn->prepare($query);
$stmt->bind_param("ssss", $MaNguoiGui, $MaNguoiNhan, $MaNguoiNhan, $MaNguoiGui);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $thoiGian = date("H:i", strtotime($row['ThoiGian'])); // Định dạng giờ:phút
    if ($row['MaNguoiGui'] == $MaNguoiGui) {
        echo '
        <div class="flex items-center space-x-2 justify-end mb-2  ">
            <div class="text-xs text-gray-400">' . $thoiGian . '</div>
            <div class="bg-yellow-200 text-sm p-2 rounded-lg max-w-xs shadow">' . htmlspecialchars($row['NoiDung']) . '</div>
        </div>';
    } else {
        echo '
        <div class="flex items-center space-x-2 justify-start mb-2">
            <div class="bg-gray-200 text-sm p-2 rounded-lg max-w-xs shadow">' . htmlspecialchars($row['NoiDung']) . '</div>
            <div class="text-xs text-gray-400">' . $thoiGian . '</div>
        </div>';
    }
}
?>
