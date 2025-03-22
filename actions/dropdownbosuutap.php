<?php
include dirname(__DIR__) . '/database/connect.php';

// Truy vấn danh sách TenCTDM từ bảng chitietdanhmuc
$sql = "SELECT MaCTDM, TenCTDM FROM chitietdanhmuc WHERE MaDM = 'DM01'";
$result = $conn->query($sql);
if (!$result) {
    die("Lỗi truy vấn: " . $conn->error);
}
?>

<div id="dropdownbosuutap" class="absolute left-4 top-[50px] w-60 bg-white shadow-lg rounded-lg overflow-hidden hidden">
    <div class="p-4">
        <ul class="space-y-2">
            <?php 
                while ($row = $result->fetch_assoc()) {
                    $tenCTDM = htmlspecialchars($row["TenCTDM"]); // Chống lỗi XSS
                    $maCTDM = htmlspecialchars($row["MaCTDM"]);

                    if ($maCTDM === 'CTDM01') { 
                        // Truy vấn sản phẩm thuộc danh mục CTDM01
                        $sql_sanpham = "SELECT MaSP, MaCTDM, TenSP, Gia, LinkAnh FROM SANPHAM WHERE MaCTDM = 'CTDM01'";
                        $result_sanpham = $conn->query($sql_sanpham);

                        if ($result_sanpham) {
                            $sanpham_data = [];
                            while ($sp = $result_sanpham->fetch_assoc()) {
                                $sanpham_data[] = $sp;
                            }
                            $sanpham_json = urlencode(json_encode($sanpham_data)); // Mã hóa dữ liệu JSON để truyền qua URL
                        } else {
                            $sanpham_json = '';
                        }

                        echo '<li class="flex items-center text-gray-800">
                                <i class="mr-3"></i>
                                <a href="../views/maitramnam.php?maCTDM=' . $maCTDM . '&data=' . $sanpham_json . '" class="text-black-600">' . $tenCTDM . '</a>
                            </li>';
                    }
                    elseif ($maCTDM === 'CTDM03') { 
                        // Truy vấn sản phẩm thuộc danh mục CTDM01
                        $sql_sanpham = "SELECT MaSP, MaCTDM, TenSP, Gia, LinkAnh FROM SANPHAM WHERE MaCTDM = 'CTDM03'";
                        $result_sanpham = $conn->query($sql_sanpham);

                        if ($result_sanpham) {
                            $sanpham_data = [];
                            while ($sp = $result_sanpham->fetch_assoc()) {
                                $sanpham_data[] = $sp;
                            }
                            $sanpham_json = urlencode(json_encode($sanpham_data)); // Mã hóa dữ liệu JSON để truyền qua URL
                        } else {
                            $sanpham_json = '';
                        }

                        echo '<li class="flex items-center text-gray-800">
                                <i class="mr-3"></i>
                                <a href="../views/dauanphaimanh.php?maCTDM=' . $maCTDM . '&data=' . $sanpham_json . '" class="text-black-600">' . $tenCTDM . '</a>
                            </li>';
                    }
                    else {
                        echo '<li class="flex items-center text-gray-800">
                                <i class="mr-3"></i>
                                <span>' . $tenCTDM . '</span>
                            </li>';
                    }
                }
            ?>   
        </ul>
    </div>
</div>
