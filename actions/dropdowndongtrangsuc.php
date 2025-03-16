<?php
include dirname(__DIR__) . '/database/connect.php';
// Truy vấn danh sách TenCTDM từ bảng chitietdanhmuc với MaDM = 'DM02' (Dòng trang sức)
$sql = "SELECT TenCTDM FROM chitietdanhmuc WHERE MaDM = 'DM02'";
$result = $conn->query($sql);

if (!$result) {
    die("Lỗi truy vấn: " . $conn->error);
}
?>

<div id="dropdowndongtrangsuc" class="absolute left-40 top-[50px] w-60 bg-white shadow-lg rounded-lg overflow-hidden hidden">
    <div class="p-4">
        <ul class="space-y-2">
            <?php 
            while ($row = $result->fetch_assoc()) {
                $tenCTDM = htmlspecialchars($row["TenCTDM"]); // Chống lỗi XSS
                echo '<li class="flex items-center text-gray-800"><i class="mr-3"></i><span>' . $tenCTDM . '</span></li>';
            }
            ?>
        </ul>
    </div>
</div>
