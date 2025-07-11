<?php
session_start();
include '../database/connect.php'; 

if (isset($_GET["MaCTDM"]) && isset($_GET["MaDM"])) {
    $maCTDM = $_GET["MaCTDM"];
    $maDM = $_GET["MaDM"];

    $query = "SELECT TenCTDM, MoTa FROM chitietdanhmuc WHERE MaCTDM = $maCTDM AND MaDM = $maDM";
    $result = mysqli_query($conn, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        echo json_encode($row);
    }
}
?>
