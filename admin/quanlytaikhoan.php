<?php
include '../database/connect.php'; 
include '../managerchat/listchat.php'; 

$query = "SELECT MaND, HoTen, MatKhau, Email, NgaySinh, DiaChi, Phai, avt FROM nguoidung";
$result = mysqli_query($conn, $query);
?>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quản lý tài khoản</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="icon" type="image/png" href="../images/logo.jpg">
    <link rel="stylesheet" href="../assets/admins.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../handle/dropdownchatadmin.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar d-flex flex-column p-3">
            <div class="d-flex align-items-center border-bottom pb-3 mb-3">
                <div class="admin-info">
                    <img src="../images/logo.jpg" alt="Admin">
                    <span>Admin</span>
                </div>
            </div>
            <a href="admin.php"><i class="fas fa-tachometer-alt me-2"></i> Tổng quan</a>
            <a href="quanlydanhmuc.php"><i class="fas fa-list me-2"></i> Quản lý danh mục</a>
            <a href="chitietdanhmuc.php"><i class="fas fa-list-alt me-2"></i> Quản lý chi tiết danh mục</a>
            <a href="quanlytaikhoan.php"><i class="fas fa-users me-2"></i> Quản lý tài khoản</a>
            <a href="quanlysanpham.php"><i class="fas fa-boxes me-2"></i> Quản lý sản phẩm</a>
            <a href="quanlynhaphang.php"><i class="fas fa-truck-loading me-2"></i> Quản lý nhập hàng</a>
            <a href="quanlydonhang.php"><i class="fas fa-shopping-cart me-2"></i> Quản lý đơn hàng</a>
            <a href="quanlychat.php"><i class="fas fa-comments me-2"></i> Chat với KH</a>
            <a href="doanhthu.php"><i class="fas fa-chart-line me-2"></i> Thống kê doanh thu</a>
            <a href="../actions/logout.php"><i class="fas fa-store me-2"></i> Trang bán hàng</a>
            <a href="../views/login.php"><i class="fas fa-sign-out-alt me-2"></i> Đăng xuất</a>
        </div>
        <!-- Main Content -->
        <div class="p-4 bg-white w-[calc(100%-250px)] h-screen overflow-y-auto">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-3xl font-extrabold text-gray-800">Quản lý tài khoản</h2>
            </div>
            <div class=" rounded-lg shadow-md flex-grow md:w-[100%] w-full">
                <table class="min-w-full bg-white border border-gray-200 rounded-lg overflow-hidden text-center">
                    <thead class="bg-gradient-to-r from-blue-500 to-indigo-500 text-white">
                        <tr>
                            <th class="py-3 px-4 text-sm font-semibold break-words w-24"> <i class="fas fa-id-badge text-2xl"></i><br>Mã ND</th>
                            <th class="py-3 px-4 text-sm font-semibold break-words w-32"> <i class="fas fa-user-circle text-2xl"></i><br>Avatar</th>
                            <th class="py-3 px-4 text-sm font-semibold break-words w-40"> <i class="fas fa-user text-2xl"></i><br>Tên Người dùng</th>
                            <th class="py-3 px-4 text-sm font-semibold break-words w-48"> <i class="fas fa-envelope text-2xl"></i><br>Email</th>
                            <th class="py-3 px-4 text-sm font-semibold break-words w-32"> <i class="fas fa-user-tag text-2xl"></i><br>Vai trò</th>
                            <th class="py-3 px-4 text-sm font-semibold break-words w-48"> <i class="fas fa-map-marker-alt text-2xl"></i><br>Địa chỉ</th>
                            <th class="py-3 px-4 text-sm font-semibold break-words w-32"> <i class="fas fa-venus-mars text-2xl"></i><br>Giới tính</th>
                            <th class="py-3 px-4 text-sm font-semibold break-words w-40"> <i class="fas fa-birthday-cake text-2xl"></i><br>Ngày sinh</th>
                            <th class="py-3 px-4 text-sm font-semibold break-words w-20"> <i class="fas fa-cogs text-2xl"></i><br>Xóa</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            // Xác định vai trò dựa trên MaND
                            if (strpos($row['MaND'], 'Admin') !== false) {
                                $vaiTro = 'Admin';
                            } elseif (strpos($row['MaND'], 'ND') !== false) {
                                $vaiTro = 'Người dùng';
                            } else {
                                $vaiTro = 'Không xác định';
                            }
                            $avatar = !empty($row['avt']) ? '../' . $row['avt'] : '../images/macdinh.jpg';
                            echo '<tr class="hover:bg-blue-300 transition">';
                            echo '<td class="py-4 px-4 break-words">' . $row['MaND'] . '</td>';
                            echo '<td class="py-4 px-2">';
                            echo '<img class="w-full h-55 rounded-full border-2 border-gray-300 mx-auto" src="' . $avatar . '" alt="Avatar">';
                            echo '</td>';
                            echo '<td class="py-4 px-6 font-medium text-gray-700  whitespace-nowrap break-words">' . $row['HoTen'] . '</td>';
                            echo '<td class="py-4 px-4 text-gray-600 break-words">' . $row['Email'] . '</td>';
                            echo '<td class="py-4 px-6 font-semibold text-indigo-600  whitespace-nowrap break-words">' . $vaiTro . '</td>';
                            echo '<td class="py-4 px-4 text-gray-600 break-words">' . $row['DiaChi'] . '</td>';
                            echo '<td class="py-4 px-4 text-gray-600 break-words">' . $row['Phai'] . '</td>';
                            echo '<td class="py-4 px-6 text-gray-600 text-lg whitespace-nowrap break-words">' . date("d-m-Y", strtotime($row['NgaySinh'])) . '</td>';
                            echo '<td class="py-4 px-4 flex justify-center mt-2">';
                            echo '<button class="text-red-500 hover:text-red-700" onclick="deleteUser(\'' . $row['MaND'] . '\')" title="Xóa tài khoản">';
                            echo '<i class="fas fa-trash text-2xl"></i>';
                            echo '</button>';
                            echo '</td>';
                            echo '</tr>';
                        }
                    } else {
                        echo '<tr><td colspan="9" class="text-center py-4">Không có dữ liệu</td></tr>';
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
<script>
    
function deleteUser(MaND) {
    Swal.fire({
        title: "Bạn có chắc chắn?",
        text: "Tài khoản này sẽ bị xóa vĩnh viễn!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Xóa ngay!",
        cancelButtonText: "Hủy"
    }).then((result) => {
        if (result.isConfirmed) {
            fetch('../actions/delete_user.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'MaND=' + encodeURIComponent(MaND)
            })
            .then(response => response.text())
            .then(result => {
                if (result.trim() === "success") {
                    Swal.fire({
                        title: "Đã xóa!",
                        text: "Tài khoản đã được xóa thành công.",
                        icon: "success",
                        timer: 1000, 
                        showConfirmButton: false
                    }).then(() => location.reload());
                } else {
                    Swal.fire("Lỗi!", "Xóa thất bại, vui lòng thử lại!", "error");
                }
            })
            .catch(error => {
                Swal.fire("Lỗi!", "Có lỗi xảy ra, vui lòng thử lại!", "error");
                console.error("Lỗi:", error);
            });
        }
    });
}

</script>
