<?php
include dirname(__DIR__) . '/database/connect.php';
$sql = "select MaSP,MaCTDM, TenSP, Gia, LinkAnh from  SANPHAM where  MaCTDM = 'CTDM01' ";
$result = $conn->query($sql);
if (!$result) {
    die("Lỗi truy vấn: " . $conn->error);
}
?>