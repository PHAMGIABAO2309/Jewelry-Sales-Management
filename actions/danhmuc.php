<?php
session_start();
include dirname(__DIR__) . '/database/connect.php';

function getDanhMuc($conn)
{
    $sql = "SELECT TenDM FROM danhmuc";
    $result = $conn->query($sql);

    $icons = [
        "Bộ sưu tập" => "fa-gem",
        "Dòng trang sức" => "fa-ring",
        "Loại sản phẩm" => "fa-box"
    ];

    $idMap = [
        "Bộ sưu tập" => "menuBoSuuTap",
        "Dòng trang sức" => "menuDongTrangSuc",
        "Loại sản phẩm" => "menuLoaiSanPham"
    ];

    $sessionMap = [
        "Bộ sưu tập" => "TenBoSuuTap",
        "Dòng trang sức" => "TenDongTrangSuc",
        "Loại sản phẩm" => "TenLoaiSanPham"
    ];

    $html = '<div class="flex items-center space-x-4">';

    while ($row = $result->fetch_assoc()) {
        $tenDM = $row["TenDM"];

        // Gán session nếu có
        if (isset($sessionMap[$tenDM])) {
            $_SESSION[$sessionMap[$tenDM]] = $tenDM;
        }

        $icon = $icons[$tenDM] ?? "fa-tag";
        $idAttr = isset($idMap[$tenDM]) ? 'id="' . $idMap[$tenDM] . '"' : '';

        $html .= '<a ' . $idAttr . ' class="flex items-center space-x-1 cursor-pointer relative" href="#">
                    <i class="fas ' . $icon . '"></i>
                    <span>' . $tenDM . '</span>
                  </a>';
    }

    $html .= '</div>';
    return $html;
}
?>
