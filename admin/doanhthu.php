<?php
include '../database/connect.php'; 
include '../managerchat/listchat.php'; 
// Nhận dữ liệu ngày tháng từ form
$tuNgay = isset($_GET['tuNgay']) ? $_GET['tuNgay'] : "";
$tuThang = isset($_GET['tuThang']) ? $_GET['tuThang'] : "";
$tuNam = isset($_GET['tuNam']) ? $_GET['tuNam'] : "";
$denNgay = isset($_GET['denNgay']) ? $_GET['denNgay'] : "";
$denThang = isset($_GET['denThang']) ? $_GET['denThang'] : "";
$denNam = isset($_GET['denNam']) ? $_GET['denNam'] : "";

// Xử lý ngày tháng năm đầu vào
if (!empty($tuNgay) && !empty($tuThang) && !empty($tuNam) && !empty($denNgay) && !empty($denThang) && !empty($denNam)) {
    $tuNgayFormatted = "$tuNam-$tuThang-$tuNgay"; // Format yyyy-mm-dd
    $denNgayFormatted = "$denNam-$denThang-$denNgay"; // Format yyyy-mm-dd
    
    $sql = "SELECT DATE(NgayXuatHang) AS NgayXuatHang, 
                   SUM(TongTien) AS DoanhThu, 
                   SUM(TongTien) * 0.9 AS LoiNhuan
            FROM xuathang
            WHERE NgayXuatHang BETWEEN '$tuNgayFormatted' AND '$denNgayFormatted'
            GROUP BY DATE(NgayXuatHang)
            ORDER BY NgayXuatHang ASC";
} else {
    // Trường hợp không có dữ liệu lọc, lấy 7 ngày gần nhất
    $sql = "SELECT DATE(NgayXuatHang) AS NgayXuatHang, 
                   SUM(TongTien) AS DoanhThu, 
                   SUM(TongTien) * 0.9 AS LoiNhuan
            FROM xuathang
            WHERE NgayXuatHang >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)
            GROUP BY DATE(NgayXuatHang)
            ORDER BY NgayXuatHang ASC
            LIMIT 7";
}

// Thực thi truy vấn
$result = $conn->query($sql);

// Tạo mảng để lưu dữ liệu
$data = []; $labels = []; $doanhThu = []; $loiNhuan = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
        $labels[] = date("d/m/Y", strtotime($row['NgayXuatHang']));
        $doanhThu[] = $row['DoanhThu'];
        $loiNhuan[] = $row['LoiNhuan'];
    }
}

// Chuyển đổi mảng PHP thành JSON để dùng trong JavaScript
$labels_json = json_encode($labels);
$doanhThu_json = json_encode($doanhThu);
$loiNhuan_json = json_encode($loiNhuan);
$conn->close();
?>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quản lý Chat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="../assets/admins.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../handle/dropdownchatadmin.js"></script>
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
            <a href="#"><i class="fas fa-cogs me-2"></i> Quản lý hệ thống</a>
            <a href="quanlytaikhoan.php"><i class="fas fa-users me-2"></i> Quản lý tài khoản</a>
            <a href="quanlysanpham.php"><i class="fas fa-boxes me-2"></i> Quản lý sản phẩm</a>
            <a href="quanlynhaphang.php"><i class="fas fa-truck-loading me-2"></i> Quản lý nhập hàng</a>
            <a href="#"><i class="fas fa-shopping-cart me-2"></i> Quản lý đơn hàng</a>
            <a href="quanlychat.php"><i class="fas fa-comments me-2"></i> Chat với KH</a>
            <a href="doanhthu.php"><i class="fas fa-chart-bar me-2"></i> Thống kê doanh thu</a>
            <a href="#"><i class="fas fa-bell me-2"></i> Thông báo</a>
            <a href="#"><i class="fas fa-cogs me-2"></i> Cài đặt</a>
            <a href="#"><i class="fas fa-sign-out-alt me-2"></i> Đăng xuất</a>
        </div>
        

        <div class="p-4 bg-white w-[calc(100%-250px)] h-screen overflow-y-auto">
            <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">📊 THỐNG KÊ TỔNG HỢP</h1>
            <div class="bg-white p-8 rounded-xl border w-full min-h-[500px] max-h-[700px] ">
                <h2 class="text-xl font-semibold text-gray-700 mb-6">📈 THỐNG KÊ DOANH THU</h2>
                <!-- Bộ lọc ngày -->
                <form method="GET">
                    <div class="flex items-center justify-center gap-6 mb-8">
                        <div class="flex items-center">
                            <label class="mr-2 text-gray-600 font-medium">Từ:</label>
                            <select name="tuNgay" class="border border-gray-300 p-2 rounded-lg shadow-sm focus:ring focus:ring-blue-300 transition">
                                <option value="">Ngày</option>
                                <script>
                                    for (let i = 1; i <= 31; i++) {
                                        document.write(`<option value="${i}">${i}</option>`);
                                    }
                                </script>
                            </select>
                            <select name="tuThang" class="border border-gray-300 p-2 rounded-lg shadow-sm focus:ring focus:ring-blue-300 transition">
                                <option value="">Tháng</option>
                                <script>
                                    for (let i = 1; i <= 12; i++) {
                                        document.write(`<option value="${i}">${i}</option>`);
                                    }
                                </script>
                            </select>
                            <select name="tuNam" class="border border-gray-300 p-2 rounded-lg shadow-sm focus:ring focus:ring-blue-300 transition">
                                <option value="">Năm</option>
                                <script>
                                    let year = new Date().getFullYear();
                                    for (let i = 2000; i <= year; i++) {
                                        document.write(`<option value="${i}">${i}</option>`);
                                    }
                                </script>
                            </select>
                        </div>

                        <div class="flex items-center">
                            <label class="mr-2 text-gray-600 font-medium">Đến:</label>
                            <select name="denNgay" class="border border-gray-300 p-2 rounded-lg shadow-sm focus:ring focus:ring-blue-300 transition">
                                <option value="">Ngày</option>
                                <script>
                                    for (let i = 1; i <= 31; i++) {
                                        document.write(`<option value="${i}">${i}</option>`);
                                    }
                                </script>
                            </select>
                            <select name="denThang" class="border border-gray-300 p-2 rounded-lg shadow-sm focus:ring focus:ring-blue-300 transition">
                                <option value="">Tháng</option>
                                <script>
                                    for (let i = 1; i <= 12; i++) {
                                        document.write(`<option value="${i}">${i}</option>`);
                                    }
                                </script>
                            </select>
                            <select name="denNam" class="border border-gray-300 p-2 rounded-lg shadow-sm focus:ring focus:ring-blue-300 transition">
                                <option value="">Năm</option>
                                <script>
                                    for (let i = 2000; i <= year; i++) {
                                        document.write(`<option value="${i}">${i}</option>`);
                                    }
                                </script>
                            </select>
                        </div>

                        <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded-lg font-medium shadow-md hover:bg-blue-700 transition">
                            🔍 Tìm kiếm
                        </button>
                    </div>
                </form>


                <!-- Biểu đồ + Bảng thống kê -->
                <div class="flex flex-col md:flex-row gap-8">
                    <!-- Biểu đồ (Tùy chỉnh kích thước) -->
                    <div class="flex-grow md:w-[55%] w-full">
                        <div class="bg-gray-50 p-6 rounded-lg shadow-md">
                            <canvas id="revenueChart" style="width: 500px; height: 300px;"></canvas>
                        </div>
                    </div>
                    <!-- Bảng thống kê (Tùy chỉnh kích thước) -->
                    <div class="flex-grow md:w-[45%] w-full">
                        <h3 class="text-lg font-semibold text-gray-700 mb-3">📑 BÁO CÁO DOANH THU</h3>
                        <div class="overflow-x-auto ">
                            <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden " style="width: 450px;">
                                <thead class="bg-blue-600 text-white border">
                                    <tr>
                                    <th class="py-3 px-4 text-left w-12">#</th>
                                    <th class="py-3 px-4 text-left w-32">Ngày</th>
                                    <th class="py-3 px-4 text-left w-40">Doanh thu</th>
                                    <th class="py-3 px-4 text-left w-40">Lợi nhuận</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-700 border">
                                    <?php
                                    if (!empty($data)) {
                                        $index = 1;
                                        foreach ($data as $row) {
                                            echo "<tr class='hover:bg-gray-100 transition'>";
                                            echo "<td class='py-3 px-4'>{$index}</td>";
                                            echo "<td class='py-3 px-4'>" . date("d/m/Y", strtotime($row['NgayXuatHang'])) . "</td>";
                                            echo "<td class='py-3 px-4 text-green-600 font-medium'>" . number_format($row['DoanhThu'], 0, ',', '.') . " VNĐ</td>";
                                            echo "<td class='py-3 px-4 text-blue-600 font-medium'>" . number_format($row['LoiNhuan'], 0, ',', '.') . " VNĐ</td>";
                                            echo "</tr>";
                                            $index++;
                                        }
                                    } else {
                                        echo "<tr><td colspan='4' class='text-center py-3 px-4'>Không có dữ liệu</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

</body>
</html>

<script>
    const labels = <?php echo $labels_json; ?>;
    const doanhThu = <?php echo $doanhThu_json; ?>;
    const loiNhuan = <?php echo $loiNhuan_json; ?>;

    const ctx = document.getElementById('revenueChart').getContext('2d');
    const revenueChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Doanh thu',
                    data: doanhThu,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Lợi nhuận',
                    data: loiNhuan,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }
            ]
        },
        options: {
            scales: {
                x: {
                    ticks: {
                        autoSkip: false, // Không bỏ qua nhãn
                    }
                },
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
