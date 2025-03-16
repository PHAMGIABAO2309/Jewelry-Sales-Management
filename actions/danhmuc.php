<?php
session_start();
include dirname(__DIR__) . '/database/connect.php'; // Đảm bảo đường dẫn đúng

function getDanhMuc($conn)
{
    $sql = "SELECT TenDM FROM danhmuc";
    $result = $conn->query($sql);

    if (!$result) {
        die("Lỗi truy vấn: " . $conn->error);
    }

    // Danh sách icon tương ứng với danh mục
    $icons = [
        "Bộ sưu tập" => "fa-gem",
        "Dòng trang sức" => "fa-ring",
        "Loại sản phẩm" => "fa-box"
    ];

    $html = '<div class="flex items-center space-x-4">';

    while ($row = $result->fetch_assoc()) {
        $tenDM = $row["TenDM"];

         // Lưu vào session nếu là "Bộ sưu tập"
         if ($tenDM === "Bộ sưu tập") {
            $_SESSION["TenBoSuuTap"] = $tenDM;
        } else if ($tenDM === "Dòng trang sức") {
            $_SESSION["TenDongTrangSuc"] = $tenDM;
        } else if ($tenDM === "Loại sản phẩm") {
            $_SESSION["TenLoaiSanPham"] = $tenDM;
        }


        $icon = isset($icons[$tenDM]) ? $icons[$tenDM] : "fa-tag"; // Icon mặc định nếu không khớp

        // Gán ID cho danh mục cần dropdown
        $idAttr = '';
        if ($tenDM === "Bộ sưu tập") {
            $idAttr = 'id="menuBoSuuTap"';
        } elseif ($tenDM === "Dòng trang sức") {
            $idAttr = 'id="menuDongTrangSuc"';
        } elseif($tenDM === "Loại sản phẩm") {
            $idAttr = 'id="menuLoaiSanPham"';
        }

        $html .= '<a ' . $idAttr . ' class="flex items-center space-x-1 cursor-pointer relative" href="#">
                    <i class="fas ' . $icon . '"></i>
                    <span>' . $tenDM . '</span>
                  </a>';
    }

    $html .= '</div>';
    return $html;
}
?>
