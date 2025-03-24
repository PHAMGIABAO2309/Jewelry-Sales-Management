<?php
session_start();
include dirname(__DIR__) . '/database/connect.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["MaCTDM"], $_POST["MaDM"], $_POST["TenCTDM"], $_POST["MoTa"])) {
        $maCTDM = $_POST["MaCTDM"];
        $maDM = $_POST["MaDM"];
        $tenCTDM = $_POST["TenCTDM"];
        $moTa = $_POST["MoTa"];

        $stmt = $conn->prepare("UPDATE chitietdanhmuc SET TenCTDM = ?, MoTa = ? WHERE MaCTDM = ? AND MaDM = ?");
        $stmt->bind_param("ssii", $tenCTDM, $moTa, $maCTDM, $maDM);

        if ($stmt->execute()) {
            echo "Cập nhật thành công!";
        } else {
            echo "Lỗi khi cập nhật!";
        }

        $stmt->close();
    } else {
        echo "Thiếu dữ liệu!";
    }
}
?>
