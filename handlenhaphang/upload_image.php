<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["file"])) {
    $maSP = $_POST['maSP']; 
    $targetDir = "../images/";  // Thư mục lưu ảnh
    $targetFile = $targetDir . $maSP . ".jpg"; 

    if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
        echo "Ảnh đã tải lên thành công!";
    } else {
        echo "Lỗi khi tải ảnh lên.";
    }
}
?>
