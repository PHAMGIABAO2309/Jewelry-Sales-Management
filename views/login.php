<?php
session_start();
include '../database/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if ($conn->connect_error) {
        die("Lỗi kết nối: " . $conn->connect_error);
    }

    // Kiểm tra thông tin đăng nhập
    $stmt = $conn->prepare("SELECT MaND, TenND, MatKhau, NgaySinh, avt FROM nguoidung WHERE Email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // So sánh mật khẩu trực tiếp
        if ($password === $user['MatKhau']) {
            $_SESSION['user_id'] = $user['MaND'];
            $_SESSION['user_name'] = $user['TenND'];
            $_SESSION['user_email'] = $email; // Lưu email vào session
            $_SESSION['user_dob'] = $user['NgaySinh']; // Lưu ngày sinh vào session
            $_SESSION['user_avt'] = $user['avt']; // Lưu avatar vào session

            // Lưu thông báo đăng nhập thành công
            $_SESSION['message'] = "Đăng nhập thành công!";
            $_SESSION['type'] = "success";

            // Đảm bảo session được lưu trước khi chuyển trang
            session_write_close();
            header("Location: ../views/home.php");
            exit();
        } else {
            $_SESSION['message'] = "Mật khẩu không đúng!";
            $_SESSION['type'] = "error";
        }
    } else {
        $_SESSION['message'] = "Email không tồn tại!";
        $_SESSION['type'] = "error";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="../assets/login.css">
    <link rel="icon" type="image/png" href="../images/login.png">
</head>
<body>
    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert <?= $_SESSION['type']; ?>">
            <?= $_SESSION['message']; ?>
        </div>
        <?php unset($_SESSION['message'], $_SESSION['type']); ?>
    <?php endif; ?>

    <div class="login-container">
        <h2>Đăng Nhập</h2>
        <form action="login.php" method="POST">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Mật khẩu:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Đăng Nhập</button>
        </form>
        <p>Chưa có tài khoản? <a href="register.php">Đăng ký ngay</a></p>
    </div>
</body>
</html>
