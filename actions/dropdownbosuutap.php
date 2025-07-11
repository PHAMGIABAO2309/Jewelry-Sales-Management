<?php
include dirname(__DIR__) . '/database/connect.php';

$sql = "SELECT MaCTDM, TenCTDM, MoTa FROM chitietdanhmuc WHERE MaDM = 'DM01'";
$result = $conn->query($sql);
function saveMoTaToSession($maCTDM, $tenCTDM, $moTa) {
    $mapping = [
        'CTDM01' => 'Mai trăm năm',
        'CTDM02' => 'Giao thời 2024',
        'CTDM03' => 'Dấu ấn phái mạnh 2024',
        'CTDM04' => 'Giáp Thìn phú quý',
        'CTDM05' => 'Magical stone',
        'CTDM06' => 'Bách phúc trường an',
    ];
    // Kiểm tra nếu mã và tên trùng với dữ liệu trong mảng
    foreach ($mapping as $code => $name) {
        if ($maCTDM === $code && $tenCTDM === $name) {
            $sessionKeyName = 'Ten' . str_replace(' ', '', $name);
            $sessionKeyDesc = 'MoTa' . str_replace(' ', '', $name);
            
            $_SESSION[$sessionKeyName] = $tenCTDM;
            $_SESSION[$sessionKeyDesc] = $moTa;
        }
    }
}
?>
<div id="dropdownbosuutap" class="absolute left-4 top-[50px] w-60 bg-white shadow-lg rounded-lg overflow-hidden hidden z-10">
    <div class="p-4">
        <ul class="space-y-2">
            <?php 
                function getSanPhamJson($maCTDM) {
                    global $conn;
                    $sql_sanpham = "SELECT MaSP, MaCTDM, TenSP, Gia, LinkAnh FROM SANPHAM WHERE MaCTDM = '$maCTDM'";
                    $result_sanpham = $conn->query($sql_sanpham);
                    if ($result_sanpham) {
                        $sanpham_data = [];
                        while ($sp = $result_sanpham->fetch_assoc()) {
                            $sanpham_data[] = $sp;
                        }
                        return urlencode(json_encode($sanpham_data)); 
                    }
                    return '';
                }
                if ($result) {
                    while ($row = $result->fetch_assoc()) {
                        $maCTDM = htmlspecialchars($row["MaCTDM"]);
                        $tenCTDM = htmlspecialchars($row["TenCTDM"]); 
                        $moTa = htmlspecialchars($row["MoTa"]);
                        saveMoTaToSession($maCTDM, $tenCTDM, $moTa);
                        $sanpham_json = getSanPhamJson($maCTDM);
                        // Hiển thị danh mục với các sản phẩm
                        echo '<li class="flex items-center text-gray-800">
                                <i class="mr-3"></i>
                                <a href="../views/maitramnam.php?maCTDM=' . $maCTDM . '&data=' . $sanpham_json . ' "  class="text-black-600 hover:text-red-500">' . $tenCTDM . '</a>
                            </li>';
                    }
                }
            ?>
        </ul>
    </div>
</div>
