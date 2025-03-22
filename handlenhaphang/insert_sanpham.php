
<?php
session_start();
include dirname(__DIR__) . '/database/connect.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $maSP = $_POST['maSP'];
    $tenSP = $_POST['tenSP'];
    $giaSP = $_POST['giaSP'];
    $maCTDM = $_POST['maCTDM'];
    $soLuong = $_POST['soLuong'];
    $ngayNhap = $_POST['ngayNhap'];

    // Chuyển đổi định dạng ngày từ DD/MM/YYYY sang YYYY-MM-DD
    $dateParts = explode("/", $ngayNhap);
    $ngayNhapFormatted = $dateParts[2] . "-" . $dateParts[1] . "-" . $dateParts[0];

    // Xử lý ảnh
    if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
        $targetDir = "images/";
        $targetFile = $targetDir . $maSP . ".jpg"; // Đổi tên file ảnh
        $linkAnh = $targetFile;
    } else {
        $linkAnh = "../images/macdinh.jpg"; // Ảnh mặc định nếu không có file
    }

    // Thực hiện insert vào database
    $sql = "INSERT INTO sanpham (MaSP, TenSP, Gia, MaCTDM, LinkAnh, SoLuong, NgayNhap) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdssis", $maSP, $tenSP, $giaSP, $maCTDM, $linkAnh, $soLuong, $ngayNhapFormatted);

    if ($stmt->execute()) {
        echo "Thêm sản phẩm thành công!";
    } else {
        echo "Lỗi: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}


?>
