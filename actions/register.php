<?php
session_start();
include '../database/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    if (isset($_POST['dob']) && !empty($_POST['dob'])) {
        $dob = DateTime::createFromFormat('d/m/Y', $_POST['dob'])->format('Y-m-d');
    } else {
        $dob = null; // Tránh lỗi nếu người dùng không nhập ngày sinh
    }
    
    $address = trim($_POST['address']);
    $gender = $_POST['gender'];

    // Kiểm tra tên không có dấu, khoảng trắng, ký tự đặc biệt
    function isValidUsername($username) {
        return preg_match('/^[a-zA-Z0-9_]+$/', $username); // Chỉ cho phép chữ, số, dấu _
    }

    if (!isValidUsername($name)) {
        $_SESSION['message'] = "Tên chỉ chứa chữ cái, số, dấu gạch dưới, không có dấu hoặc khoảng trắng!";
        $_SESSION['type'] = "error";
        header("Location: ../views/register.php");
        exit();
    }

    if ($conn->connect_error) {
        die("Lỗi kết nối: " . $conn->connect_error);
    }

    // Kiểm tra email hoặc tên đã tồn tại
    $check = $conn->prepare("SELECT * FROM nguoidung WHERE Email = ? OR TenND = ?");
    $check->bind_param("ss", $email, $name);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['message'] = "Email hoặc tên đã tồn tại!";
        $_SESSION['type'] = "error";
        $check->close(); // Đóng truy vấn
        header("Location: ../views/register.php");
        exit();
    }
    $check->close(); // Đóng truy vấn sau khi kiểm tra

    // Lấy mã người dùng mới
    $query = "SELECT MaND FROM nguoidung WHERE MaND LIKE 'ND%' ORDER BY LENGTH(MaND) DESC, MaND DESC LIMIT 1";
    $result = $conn->query($query);
    
    if ($result->num_rows > 0) {
        $lastMaND = $result->fetch_assoc()['MaND']; // Lấy mã lớn nhất
        $lastNumber = (int)filter_var($lastMaND, FILTER_SANITIZE_NUMBER_INT); // Lấy phần số của mã
        $newNumber = $lastNumber + 1;
    } else {
        $newNumber = 1; // Bắt đầu từ ND09 nếu chưa có dữ liệu
    }
    
    $newMaND = "ND" . str_pad($newNumber, 2, "0", STR_PAD_LEFT);
    

   
    $hashed_password = $password; // Lưu mật khẩu trực tiếp, không mã hóa


    // Thêm vào CSDL
    $sql = $conn->prepare("INSERT INTO nguoidung (MaND, TenND, Email, MatKhau, NgaySinh, DiaChi, Phai) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $sql->bind_param("sssssss", $newMaND, $name, $email, $hashed_password, $dob, $address, $gender);
    

    if ($sql->execute()) {
        $_SESSION['message'] = "Đăng ký thành công! Vui lòng đăng nhập.";
        $_SESSION['type'] = "success";
        
        $sql->close(); // Đóng truy vấn
        $conn->close(); // Đóng kết nối

        // Chuyển hướng đến trang đăng nhập
        header("Location: ../views/login.php");
        exit();
    } else {
        $_SESSION['message'] = "Lỗi: " . $conn->error;
        $_SESSION['type'] = "error";

        $sql->close(); // Đóng truy vấn
        $conn->close(); // Đóng kết nối
        
        // Nếu có lỗi, quay lại trang đăng ký
        header("Location: ../views/register.php");
        exit();
    }
}
?>
