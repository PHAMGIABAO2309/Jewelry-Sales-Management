<?php
session_start();
include dirname(__DIR__) . '/database/connect.php';
$sql = "SELECT xh.MaPhieuXuat, sp.TenSP, nd.HoTen, xh.NgayXuatHang, xh.TongTien, xh.SoLuong,
                xh.PhuongThucThanhToan
        FROM xuathang xh
        JOIN sanpham sp ON xh.MaSP = sp.MaSP
        JOIN nguoidung nd ON xh.MaND = nd.MaND";
$result = $conn->query($sql);

$sql_tenkh = "SELECT DISTINCT  HoTen FROM  nguoidung nd, xuathang xh WHERE nd.MaND = xh.MaND ;";
$result_tenkh = $conn->query($sql_tenkh);

$sql_ngaymua = "SELECT DISTINCT DATE(NgayXuatHang) AS NgayXuatHang
FROM xuathang
ORDER BY NgayXuatHang;
 ";
$result_ngaymua = $conn->query($sql_ngaymua);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quản lý đơn hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.0/dist/tailwind.min.css" rel="stylesheet">

    <link rel="icon" type="image/png" href="../images/logo.jpg">
    <link rel="stylesheet" href="../assets/admins.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- FontAwesome (để hiển thị icon) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
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
                <div class="container bg-white rounded  p-4">
                    <h2 class=" text-primary fw-bold mb-4 ">Quản lý đơn hàng</h2>
                    <div class="flex items-center mb-4 mt-4">
                        <label class="text-base font-semibold text-gray-700 mr-3">
                            🔍 Lọc theo tên khách hàng:
                        </label>
                        <select id="customerSelect" class=" w-56 px-4 py-2">
                            <option value="">--Chọn tên khách hàng--</option>
                            <?php while ($row = $result_tenkh->fetch_assoc()) { ?>
                                <option value="<?= $row['HoTen'] ?>" data-name="<?= $row['HoTen'] ?>">
                                    <?= $row['HoTen'] ?>
                                </option>
                            <?php } ?>
                        </select>
                        <label class="text-base font-semibold text-gray-700 mr-3">
                            🔍 Lọc theo ngày:
                        </label>
                        <select id="daySelect" class="w-56 px-4 py-2">
                            <option value="">--Chọn ngày --</option>
                            <?php while ($row = $result_ngaymua->fetch_assoc()) { ?>
                                <option value="<?= date('d-m-Y', strtotime($row['NgayXuatHang'])) ?>" 
                                        data-name="<?= date('d-m-Y', strtotime($row['NgayXuatHang'])) ?>">
                                    <?= date('d-m-Y', strtotime($row['NgayXuatHang'])) ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="table-responsive">
                        <table class="  text-center align-middle  table-hover" id="ordersTable">
                            <thead style="background-color: aqua;" >
                                <tr >
                                    <th class="py-3 px-4 w-24">Mã Đơn Hàng</th>
                                    <th class="py-3 px-4 w-48">Tên Sản Phẩm</th>
                                    <th class="py-3 px-4 ">Số Lượng</th>
                                    <th class="py-3 px-4 w-48">Tên Khách Hàng</th>
                                    <th class="py-3 px-4 w-48">Ngày Mua Hàng</th>
                                    <th class="py-3 px-4 w-48">Tổng Tiền</th>
                                    
                                    <th class="py-3 px-4 w-40">Phương Thức Thanh Toán</th>
                                    <th class="py-3 px-4 w-24">Trạng Thái</th>
                                    <th class="py-3 px-4 w-20">Hành Động</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $groupedOrders = [];

                                while ($row = $result->fetch_assoc()) {
                                    $groupedOrders[$row["MaPhieuXuat"]][] = $row;
                                }
                                // Sắp xếp MaPhieuXuat tăng dần
                                ksort($groupedOrders);

                                if (count($groupedOrders) > 0):
                                    foreach ($groupedOrders as $maPhieu => $orders):
                                        $rowCount = count($orders);
                                ?>
                                        <tr style="border-top: 3px solid black;">
                                            <td rowspan="<?= $rowCount ?>" style="background-color: green; color: white; font-weight: bold; border-left: 3px solid black;border-right: 3px solid black; border-top: 3px solid black; border-bottom: 3px solid black;">
                                                <strong><?= $maPhieu ?></strong>
                                            </td>
                                            <?php foreach ($orders as $index => $order): ?>
                                                <?php if ($index > 0): ?>
                                                    <tr>
                                                <?php endif; ?>
                                                    <td><?= $order["TenSP"] ?></td>
                                                    <td><?= $order["SoLuong"] ?></td>
                                                    <td><?= $order["HoTen"] ?></td>
                                                    <td><?= date("d-m-Y", strtotime($order["NgayXuatHang"])) ?></td>
                                                    <td class="text-danger fw-bold"><?= number_format($order["TongTien"], 0, ',', '.') ?> VNĐ</td>
                                                    <td style="color: <?= ($order["PhuongThucThanhToan"] == 'Thanh Toán Online') ? 'blue' : 'darkred' ?>; font-weight: bold;">
                                                        <?= $order["PhuongThucThanhToan"] ?>
                                                    </td>
                                                    <td><span class="badge bg-warning text-dark">Đang xử lý</span></td>
                                                    <td style="border-right: 3px solid black;">
                                                        <button class="btn btn-sm btn-outline-success btnUpdate">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-outline-danger btnDelete" data-mapx="<?= $maPhieu ?>">
                                                            <i class="fas fa-trash"></i>
                                                        </button>

                                                    </td>
                                                </tr>
                                                <?php if ($index == $rowCount - 1): ?>
                                                    <tr style="border-bottom: 3px solid black;"></tr>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                <?php  
                                    endforeach;
                                else: 
                                ?>
                                    <tr>
                                        <td colspan="9">Không có đơn hàng nào.</td>
                                    </tr>
                                <?php endif; ?>
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
.custom-modal-size {
    max-width: 600px;  /* Độ rộng tối đa */
    width: 80%; /* Chiếm 80% màn hình */
}

@media (max-width: 768px) {
    .custom-modal-size {
        width: 95%; /* Nếu trên màn hình nhỏ, mở rộng modal */
    }
}
.table-hover tbody tr:hover {
    background-color:rgb(38, 173, 241) !important;
    color: white;
}
table {
    border-collapse: collapse;
    width: 100%;
}

tr {
    border-bottom: 1px solid ; /* Chỉ có viền ngang */
}

tr:first-child {
    border: 3px solid; /* Viền trên cùng */
    
}

th, td {
    border-left: none;
    border-right: none;
    padding: 10px;
    text-align: center;
}


.custom-modal-size .modal-content {
    min-height: 300px; /* Độ cao tối thiểu */
    max-height: 500px; /* Độ cao tối đa */
    overflow-y: auto; /* Nếu nội dung dài, sẽ có thanh cuộn */
}
.input-group-text i {
    color: #007bff; /* Màu xanh dương */
}
.icon-product { color: #ff5733; } /* Đỏ cam */
.icon-quantity { color: #28a745; } /* Xanh lá */
.icon-user { color: #17a2b8; } /* Xanh biển */
.icon-calendar { color: #ffc107; } /* Vàng */
.icon-money { color: #dc3545; } /* Đỏ */
.icon-status { color: #6610f2; } /* Tím */
.icon-payment { color: #fd7e14; } /* Cam */

</style>
<!-- Modal Chỉnh Sửa Đơn Hàng -->
<div class="modal fade" id="editOrderModal" tabindex="-1" aria-labelledby="editOrderLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editOrderLabel">Chỉnh Sửa Đơn Hàng</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editOrderForm">
                    <input type="hidden" id="editMaPhieuXuat" name="MaPhieuXuat" readonly>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="editTenSP" class="form-label">Tên Sản Phẩm</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-box"></i></span>
                                <input type="text" class="form-control" id="editTenSP" name="TenSP" readonly>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="editSoLuong" class="form-label">Số Lượng</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-sort-numeric-up"></i></span>
                                <input type="number" class="form-control" id="editSoLuong" name="SoLuong" readonly>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="editHoTen" class="form-label">Khách Hàng</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                <input type="text" class="form-control" id="editHoTen" name="HoTen" readonly>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="editNgayXuatHang" class="form-label">Ngày Xuất Hàng</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                <input type="date" class="form-control" id="editNgayXuatHang" name="NgayXuatHang" readonly>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="editTongTien" class="form-label">Tổng Tiền</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                <input type="text" class="form-control" id="editTongTien" name="TongTien" readonly>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="editTrangThai" class="form-label">Trạng Thái</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-tasks"></i></span>
                                <select class="form-control" id="editTrangThai" name="TrangThai">
                                    <option value="Đang xử lý">Đang xử lý</option>
                                    <option value="Đang giao hàng">Đang giao hàng</option>
                                    <option value="Đã giao hàng">Đã giao hàng</option>
                                    <option value="Đã hủy hàng">Đã hủy hàng</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="editPhuongThucThanhToan" class="form-label">Phương Thức Thanh Toán</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-credit-card"></i></span>
                                <select class="form-control" id="editPhuongThucThanhToan" name="PhuongThucThanhToan">
                                    <option value="Thanh Toán Tiền Mặt">Thanh Toán Tiền Mặt</option>
                                    <option value="Thanh Toán Online">Thanh Toán Online</option>
                                </select>
                                
                            </div>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Cập Nhật</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
    $(".btnUpdate").click(function () {
        let row = $(this).closest("tr");

        // Lấy dữ liệu từ hàng
        let maPhieuXuat = row.find("td:eq(0)").text().trim();
        let tenSP = row.find("td:eq(1)").text().trim();
        let soLuong = row.find("td:eq(2)").text().trim();
        let hoTen = row.find("td:eq(3)").text().trim();
        let ngayXuatHang = row.find("td:eq(4)").text().trim();
        let tongTien = row.find("td:eq(5)").text().replace(" VNĐ", "").trim().replace(/\./g, '');
        let phuongThucThanhToan = row.find("td:eq(6)").text().trim();

        // Gán giá trị vào modal
        $("#editMaPhieuXuat").val(maPhieuXuat);
        $("#editTenSP").val(tenSP);
        $("#editSoLuong").val(soLuong);
        $("#editHoTen").val(hoTen);
        $("#editNgayXuatHang").val(ngayXuatHang.split("-").reverse().join("-")); // Định dạng về YYYY-MM-DD
        $("#editTongTien").val(tongTien);
        $("#editPhuongThucThanhToan").val(phuongThucThanhToan);

        // Hiển thị modal
        $("#editOrderModal").modal("show");
    });

    // Gửi dữ liệu cập nhật khi submit form
    $("#editOrderForm").submit(function (e) {
        e.preventDefault(); // Ngăn chặn tải lại trang

        let formData = $(this).serialize();

        $.ajax({
                type: "POST",
                url: "../quanlydonhang/update_order.php",
                data: formData,
                dataType: "json",
                success: function (response) {
                    if (response.status === "success") {
                        Swal.fire({
                            title: "Thành công!",
                            text: response.message,
                            icon: "success",
                            confirmButtonColor: "#3085d6",
                            confirmButtonText: "OK"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload(); // Tải lại trang để cập nhật dữ liệu
                            }
                        });
                    } else {
                        Swal.fire({
                            title: "Lỗi!",
                            text: response.message,
                            icon: "error",
                            confirmButtonColor: "#d33",
                            confirmButtonText: "Thử lại"
                        });
                    }
                }
            });
    });
});
</script>
<!-- Modal Xác Nhận Xóa -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog custom-modal-size modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Xác Nhận Xóa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <i class="fas fa-exclamation-triangle text-danger" style="font-size: 50px;"></i>
                <p class="mt-3"><strong>Bạn có chắc chắn muốn xóa tất cả đơn hàng có Mã Phiếu Xuất:</strong></p>
                <h4 class="text-danger" id="maPhieuXuatText"></h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Xóa</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal thông báo -->
<div class="modal fade" id="deleteSuccessModal" tabindex="-1" aria-labelledby="deleteSuccessModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="deleteSuccessModalLabel">Xóa Thành Công</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <i class="fas fa-check-circle text-success" style="font-size: 50px;"></i>
                <p class="mt-3">Đơn hàng đã được xóa thành công!</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        let selectedMaPhieuXuat = "";

        // Khi nhấn nút xóa, hiển thị modal xác nhận
        $(".btnDelete").click(function () {
            selectedMaPhieuXuat = $(this).data("mapx");
            $("#maPhieuXuatText").text(selectedMaPhieuXuat);
            $("#confirmDeleteModal").modal("show");
        });

        // Khi nhấn nút Xóa trong modal
        $("#confirmDeleteBtn").click(function () {
            $.ajax({
                url: "../quanlydonhang/delete_order.php",
                type: "POST",
                data: { MaPhieuXuat: selectedMaPhieuXuat },
                success: function (response) {
                    if (response.includes("Đã xóa thành công")) {
                        // Hiển thị modal thông báo xóa thành công
                        $("#confirmDeleteModal").modal("hide"); // Đóng modal xác nhận
                        $("#deleteSuccessModal").modal("show");

                        // Tải lại trang sau 2 giây
                        setTimeout(function () {
                            location.reload();
                        }, 2000);
                    } else {
                        alert(response);
                    }
                },
                error: function () {
                    alert("Có lỗi xảy ra. Vui lòng thử lại!");
                }
            });
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const colors = ["red", "blue", "green", "purple", "orange", "brown", "darkcyan"];
        let options = document.querySelectorAll("#customerSelect option");

        options.forEach((option, index) => {
            if (option.value !== "") {
                option.style.color = colors[index % colors.length];
            }
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const colors = ["red", "blue", "green", "purple", "orange", "brown", "darkcyan"];
        let options = document.querySelectorAll("#daySelect option");

        options.forEach((option, index) => {
            if (option.value !== "") {
                option.style.color = colors[index % colors.length];
            }
        });
    });
</script>
<script>
document.getElementById("customerSelect").addEventListener("change", function () {
    let selectedCustomer = this.value;
    let rows = document.querySelectorAll("#ordersTable tbody tr");

    rows.forEach(row => {
        let customerCell = row.querySelector("td:nth-child(4)"); // Cột chứa HoTen
        if (customerCell) {
            let customerName = customerCell.textContent.trim();
            if (selectedCustomer === "" || customerName === selectedCustomer) {
                row.style.display = ""; // Hiện dòng
            } else {
                row.style.display = "none"; // Ẩn dòng
            }
        }
    });
});
</script>
<script>
document.getElementById("daySelect").addEventListener("change", function() {
    let selectedDate = this.value; // Lấy ngày được chọn từ select
    let rows = document.querySelectorAll("#ordersTable tbody tr");

    rows.forEach(row => {
        let dateCell = row.querySelector("td:nth-child(5)"); // Cột chứa Ngày Mua Hàng

        if (dateCell) {
            let orderDate = dateCell.textContent.trim(); // Lấy giá trị ngày

            // Kiểm tra nếu ngày được chọn khớp với ngày trong bảng hoặc không có ngày nào được chọn
            if (selectedDate === "" || orderDate === selectedDate) {
                row.style.display = ""; // Hiện dòng
            } else {
                row.style.display = "none"; // Ẩn dòng
            }
        }
    });
});
</script>




