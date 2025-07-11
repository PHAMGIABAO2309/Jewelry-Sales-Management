<?php
include dirname(__DIR__) . '/database/connect.php';

$sql_danhmuc = "SELECT MaCTDM, TenCTDM, MoTa FROM chitietdanhmuc WHERE MaDM='DM03'";
$result_danhmuc = $conn->query($sql_danhmuc);
function saveMoTaToSessionLSP($maCTDM, $tenCTDM, $moTa) {
    $mapping = [
        'CTDM19' => 'Nhẫn nữ',
        'CTDM20' => 'Nhẫn nam',
        'CTDM21' => 'Nhẫn cưới',
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
<div id="dropdownloaisanpham" class="absolute left-80 top-[50px] w-60 bg-white shadow-lg rounded-lg overflow-hidden hidden z-10">
    <div class="p-4">
        <ul class="space-y-2">
            <?php 
            function getSanPhamJsonLSP($maCTDM) {
                global $conn;
                $sql_sanpham = "SELECT MaSP, MaCTDM, TenSP, Gia, LinkAnh FROM SANPHAM WHERE MaCTDM = '$maCTDM'";
                $result_sanpham = $conn->query($sql_sanpham);
                $sanpham_data = [];
                if ($result_sanpham) {
                    while ($sp = $result_sanpham->fetch_assoc()) {
                        $sanpham_data[] = $sp;
                    }
                }
                return urlencode(json_encode($sanpham_data));
            }
            if ($result_danhmuc) {
                while ($row = $result_danhmuc->fetch_assoc()) {
                    $maCTDM = htmlspecialchars($row["MaCTDM"]);
                    $tenCTDM = htmlspecialchars($row["TenCTDM"]); 
                    $moTa = htmlspecialchars($row["MoTa"]);
                    $sanpham_json = getSanPhamJsonLSP($maCTDM);
                    // Lưu thông tin vào session
                    saveMoTaToSessionLSP($maCTDM, $tenCTDM, $moTa);

                    // Hiển thị danh mục với các sản phẩm
                    echo '<li class="flex items-center text-gray-800">
                            <a href="../views/maitramnam.php?maCTDM=' . $maCTDM . '&data=' . $sanpham_json . '" class="text-black-600">' . $tenCTDM . '</a>
                        </li>';
                }
            }
            ?>
        </ul>
    </div>
</div>
