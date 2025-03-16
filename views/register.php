<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký người dùng</title>
    <link rel="stylesheet" href="../assets/register.css">
</head>
<body>
    <div id="notification" class="notification"></div>
    <div class="form-container">
        <h2>Đăng Ký Tài Khoản</h2>
        <form action="../actions/register.php" method="POST">
            
            <div class="form-group">
                <label for="name">Họ và Tên:</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">Mật khẩu:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="form-group">
                <label for="dob">Ngày sinh:</label>
                <input type="text" id="dob" name="dob" placeholder="dd/mm/yyyy" required>
            </div>

            <div class="form-group">
                <label for="address">Địa chỉ:</label>
                <input type="text" id="address" name="address" required>
            </div>

            <div class="form-group">
                <label for="gender">Phái:</label>
                <select id="gender" name="gender" required>
                    <option value="Nam">Nam</option>
                    <option value="Nữ">Nữ</option>
                    <option value="Khác">Khác</option>
                </select>
            </div>

            <div class="form-group">
                <button type="submit">Đăng Ký</button>
                <button type="button" onclick="window.location.href='login.php'" style="margin-left: 20px;">Đăng Nhập</button>
            </div>
        </form>
    </div>
    <script>
        function showNotification(message, type) {
            let notification = document.getElementById("notification");
            notification.textContent = message;
            notification.className = "notification " + type;
            notification.style.display = "block";

            setTimeout(() => {
                notification.style.display = "none";
            }, 3000);
        }
        // Hiển thị thông báo từ session (PHP gửi sang)
        <?php
        session_start();
        if (isset($_SESSION['message']) && isset($_SESSION['type'])) {
            echo "showNotification('{$_SESSION['message']}', '{$_SESSION['type']}');";
            unset($_SESSION['message']);
            unset($_SESSION['type']);
        }
        ?>
    </script>
</body>
</html>
