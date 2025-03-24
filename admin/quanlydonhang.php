<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quản lý đơn hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="icon" type="image/png" href="../images/logo.jpg">
    <link rel="stylesheet" href="../assets/admins.css">
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
        <div class="p-4 bg-white main-content">
        <main class="flex-grow container mx-auto px-4 py-6">
    <div class="bg-white  rounded-xl p-6">
        <h2 class="text-2xl font-bold text-gray-900 mb-6 ">Order Management</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden text-center">
                <thead>
                    <tr class="bg-gradient-to-r from-blue-600 to-purple-600 ">
                        <th class="py-3 px-4 text-sm font-semibold">Order ID</th>
                        <th class="py-3 px-4 text-sm font-semibold">Customer</th>
                        <th class="py-3 px-4 text-sm font-semibold">Date</th>
                        <th class="py-3 px-4 text-sm font-semibold">Status</th>
                        <th class="py-3 px-4 text-sm font-semibold">Total</th>
                        <th class="py-3 px-4 text-sm font-semibold">Product Name</th>
                        <th class="py-3 px-4 text-sm font-semibold">Member</th>
                        <th class="py-3 px-4 text-sm font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <tr class="hover:bg-gray-100 transition duration-300">
                        <td class="py-4 px-4 text-sm font-medium text-gray-900">#001</td>
                        <td class="py-4 px-4 text-sm text-gray-700">John Doe</td>
                        <td class="py-4 px-4 text-sm text-gray-700">2023-10-01</td>
                        <td class="py-4 px-4 text-sm">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-600">
                                Pending
                            </span>
                        </td>
                        <td class="py-4 px-4 text-sm font-semibold text-green-600">$100.00</td>
                        <td class="py-4 px-4 text-sm text-gray-700 truncate max-w-[150px]">Product </td>
                        <td class="py-4 px-4 text-sm text-gray-700">Member 1</td>
                        <td class="py-4 px-4 text-sm flex justify-center space-x-3">
                            
                            <a href="#" class="text-green-500 hover:text-green-700"><i class="fas fa-edit"></i></a>
                            <a href="#" class="text-red-500 hover:text-red-700"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-100 transition duration-300">
                        <td class="py-4 px-4 text-sm font-medium text-gray-900">#001</td>
                        <td class="py-4 px-4 text-sm text-gray-700">John Doe</td>
                        <td class="py-4 px-4 text-sm text-gray-700">2023-10-01</td>
                        <td class="py-4 px-4 text-sm">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-600">
                                Pending
                            </span>
                        </td>
                        <td class="py-4 px-4 text-sm font-semibold text-green-600">$100.00</td>
                        <td class="py-4 px-4 text-sm text-gray-700 truncate max-w-[150px]">Product Asssssssssssssssssssssssssssssssss</td>
                        <td class="py-4 px-4 text-sm text-gray-700">Member 1</td>
                        <td class="py-4 px-4 text-sm flex justify-center space-x-3">
                            
                            <a href="#" class="text-green-500 hover:text-green-700"><i class="fas fa-edit"></i></a>
                            <a href="#" class="text-red-500 hover:text-red-700"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</main>


   



        </div>
    </div>
</body>
</html>
<style>
    .main-content {
    width: calc(100% - 250px); /* Trừ đi chiều rộng sidebar */
    height: 100vh; /* Chiều cao toàn màn hình */
    overflow-y: auto; /* Cho phép cuộn khi nội dung dài */
    padding: 20px; /* Tạo khoảng cách cho nội dung */
    background-color: #ffffff; /* Giữ nền trắng */ 
}
</style>