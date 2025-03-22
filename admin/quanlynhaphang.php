<?php
session_start();
include dirname(__DIR__) . '/database/connect.php';
$sql = "select MaCTDM, TenCTDM from chitietdanhmuc";
$result = $conn->query($sql);
if (!$result) {
    die("Lỗi truy vấn: " . $conn->error);
}

// Truy vấn để lấy tổng số lượng sản phẩm
$sql_total = "SELECT SUM(SoLuong) AS TongSoLuong FROM sanpham";
$result_total = $conn->query($sql_total);
$row_total = $result_total->fetch_assoc();
$tongSoLuong = $row_total['TongSoLuong'] ?? 0; // Nếu không có sản phẩm, gán mặc định là 0

?>

<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quản lý nhập hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../assets/quanlynhaphang.css">
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar d-flex flex-column p-3">
            <div class="d-flex align-items-center border-bottom pb-3 mb-3">
                <div class="admin-info">
                    <img src="../images/67d16f0e2ecfa.jpg" alt="Admin">
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
        <!-- Main Content -->
        <div class="main-content bg-white">
            <div class="">
                <div class="max-w-7xl mx-auto bg-white p-6 ">
                    <h1 class="text-3xl font-bold text-blue-700 text-center mb-6">QUẢN LÝ NHẬP HÀNG</h1>
                    <div class="row g-3 mb-1">
                        <!-- Cột bên trái -->
                        <div class="col-md-6">
                            <div class="d-flex align-items-center mb-3">
                                <label for="ma-san-pham" class="form-label me-2">Mã Sản Phẩm:</label>
                                <input type="text" id="ma-san-pham" class="form-control form-control-sm ml-10" style="max-width: 200px;">
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <label for="loai-hang" class="form-label me-2">Loại hàng:</label>
                                <select id="loai-hang" name="loai-hang" class="form-select form-select-sm" style="max-width: 200px; margin-left: 70px;">
                                    <option value="">--Chọn loại hàng--</option>
                                    <?php while ($row = $result->fetch_assoc()) { ?>
                                        <option value="<?= $row['MaCTDM'] ?>"><?= $row['TenCTDM'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            
                            <div class="d-flex align-items-center mb-3">
                                <label for="ten-san-pham" class="form-label me-2">Nhập tên sản phẩm:</label>
                                <input type="text" id="ten-san-pham" name="ten-san-pham" class="form-control form-control-sm" style="max-width: 250px;">
                            </div>
                            
                            <div class="d-flex align-items-center mb-3">
                                <label for="so-luong" class="form-label me-2">Nhập số lượng:</label>
                                <input type="number" id="so-luong" name="so-luong"  class="form-control form-control-sm ml-9" style="max-width: 200px;">
                            </div>

                            
                        </div>

                        <!-- Cột bên phải -->
                        <div class="col-md-6">
                            <div class="d-flex align-items-center mb-3">
                                <label for="tim-san-pham" class="form-label me-2">Tìm sản phẩm:</label>
                                <div class="position-relative ml-9" style="max-width: 300px;">
                                    <input type="text" id="tim-san-pham" class="form-control form-control-sm pr-10" placeholder="VD: SP01,Dây chuyền,...">
                                    <i class="fas fa-search position-absolute" style="right: 10px; top: 50%; transform: translateY(-50%); color: blue;"></i>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <p class="text-gray-700">Tổng số lượng sản phẩm của <span id="ten-danh-muc" class="font-bold text-red-500">Tất cả loại hàng</span> là : <span id="tong-so-luong" class="font-bold text-red-500"><?php echo number_format($tongSoLuong); ?></span></p>
                            </div>
                            
                            <div class="d-flex align-items-center mb-3">
                                <label for="ngay-nhap" class="form-label me-2">Ngày Nhập:</label>
                                <input type="text" id="ngay-nhap" name="ngay-nhap" class="form-control form-control-sm ml-14" style="max-width: 200px;" placeholder="DD/MM/YYYY">
                            </div>

                            <div class="d-flex align-items-center mb-3">
                                <label for="gia-san-pham" class="form-label me-2">Nhập Giá Sản Phẩm:</label>
                                <input type="number" id="gia-san-pham" name="gia-san-pham" class="form-control form-control-sm" style="max-width: 200px;">
                            </div>
                            
                            <div class="d-flex align-items-center mb-3">
                                <label for="anh-san-pham" class="form-label me-2">Tải ảnh sản phẩm:</label>
                                <input type="file"  class="form-control form-control-sm">
                            </div>
                        </div>
                        
                    </div>
                    <div class="flex justify-between items-center">
                        <h2 class="text-xl font-bold text-gray-700 mb-3">Thông tin sản phẩm:</h2>
                        <div class="flex items-center space-x-5 mb-3">
                            <button class="btnthem bg-gray-200 text-gray-700 p-2 rounded text-lg">➕</button> <!-- Thêm -->
                            <button class="btnluu bg-gray-200 text-gray-700 p-2 rounded text-lg">💾</button> <!-- Lưu -->
                            <button class="bg-gray-200 text-gray-700 p-2 rounded text-lg">♻️</button> <!-- Cập nhật -->
                        </div>
                    </div>

                    <div class="overflow-x-auto max-w-full mb-6" style="overflow-y: auto;">
                        <table class="min-w-full border-collapse table" id="table-sanpham" >
                            <thead>
                                <tr class="bg-red-400 text-center">
                                    <th class="px-4 py-2">Mã Sản Phẩm</th>
                                    <th class="px-4 py-2">Tên Sản Phẩm</th>
                                    <th class="px-4 py-2">Giá Sản Phẩm</th>
                                    <th class="px-4 py-2" style="width: 100px;">Số Lượng</th>
                                    <th class="px-4 py-2" style="width: 120px;">Ngày Nhập</th>
                                    <th class="px-4 py-2" style="width: 150px;">Ảnh Sản Phẩm</th>
                                </tr>
                            </thead>
                            <tbody id="product-list">
                                <!-- Hiện thông tin sản phẩm khi chọn một chi tiết danh muục -->
                            </tbody>
                            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                            <script>
    document.querySelector(".btnluu").addEventListener("click", function () {
    let maSP = document.getElementById("ma-san-pham").value.trim();
    let tenSP = document.getElementById("ten-san-pham").value.trim();
    let giaSP = document.getElementById("gia-san-pham").value.trim();
    let maCTDM = document.getElementById("loai-hang").value.trim();
    let soLuong = document.getElementById("so-luong").value.trim();
    let ngayNhap = document.getElementById("ngay-nhap").value.trim();
    let fileInput = document.querySelector("input[type='file']");
    let file = fileInput.files[0]; // Lấy file ảnh

    if (!maSP || !tenSP || !giaSP || !maCTDM || !soLuong || !ngayNhap || !file) {
        alert("Vui lòng nhập đầy đủ thông tin!");
        return;
    }

    let formData = new FormData();
    formData.append("maSP", maSP);
    formData.append("tenSP", tenSP);
    formData.append("giaSP", giaSP);
    formData.append("maCTDM", maCTDM);
    formData.append("soLuong", soLuong);
    formData.append("ngayNhap", ngayNhap);
    formData.append("file", file);

    fetch("../handlenhaphang/insert_sanpham.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        alert(data);
        location.reload(); // Tải lại trang sau khi lưu thành công
    })
    .catch(error => console.error("Lỗi:", error));
});

</script>
<script>
document.querySelector("input[type='file']").addEventListener("change", function () {
    let maSP = document.getElementById("ma-san-pham").value.trim();
    if (!maSP) {
        alert("Vui lòng nhập Mã sản phẩm trước khi chọn ảnh!");
        this.value = ""; // Xóa file đã chọn nếu chưa có MaSP
        return;
    }

    let file = this.files[0];
    if (file) {
        let fileName = maSP + ".jpg"; // Đặt tên file theo MaSP
        let newFile = new File([file], fileName, { type: file.type });

        let dataTransfer = new DataTransfer();
        dataTransfer.items.add(newFile);
        this.files = dataTransfer.files; // Gán file mới vào input

        // Gửi file lên server ngay lập tức
        let formData = new FormData();
        formData.append("file", newFile);
        formData.append("maSP", maSP);

        fetch("../handlenhaphang/upload_image.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.text())
        .then(data => console.log(data))
        .catch(error => console.error("Lỗi:", error));
    }
});
</script>
                            <script>
                                $(document).ready(function () {
                                   
                                    // Tải toàn bộ sản phẩm khi trang load lần đầu
                                $.ajax({
                                    url: '../handlenhaphang/load_products.php',
                                    type: 'POST',
                                    success: function (response) {
                                        $('#product-list').html(response);
                                    },
                                    error: function () {
                                        alert("Lỗi khi tải dữ liệu sản phẩm.");
                                    }
                                });

                                // Xử lý sự kiện thay đổi loại hàng
                                $('#loai-hang').change(function () {
                                    var maCTDM = $(this).val(); // Lấy giá trị MaCTDM

                                    $.ajax({
                                        url: '../handlenhaphang/load_products.php', // File xử lý AJAX
                                        type: 'POST',
                                        data: { MaCTDM: maCTDM },
                                        success: function (response) {
                                            $('#product-list').html(response); // Cập nhật dữ liệu vào tbody
                                        },
                                        error: function () {
                                            alert("Lỗi khi tải dữ liệu sản phẩm.");
                                        }
                                    });
                                });
                                    // Xử lý sự kiện click vào hàng trong bảng
                                    $("#table-sanpham tbody").on("click", "tr", function () {
                                        // Xóa màu xanh của tất cả các hàng trước khi tô màu hàng mới
                                        $("#table-sanpham tbody tr").removeClass("bg-blue-500 text-white");

                                        // Thêm class cho hàng được chọn
                                        $(this).addClass("bg-blue-500 text-white");

                                        // Lấy dữ liệu từ hàng được click
                                        var maSP = $(this).find("td:eq(0)").text().trim();
                                        var tenSP = $(this).find("td:eq(1)").text().trim();
                                        var giaSP = $(this).find("td:eq(2)").text().replace(" VND", "").replace(/\./g, '').trim(); // Loại bỏ dấu chấm và chữ "VND"
                                        var soLuong = $(this).find("td:eq(3)").text().trim();
                                        var ngayNhap = $(this).find("td:eq(4)").text().trim();

                                        // Hiển thị dữ liệu vào các ô input
                                        $("#ma-san-pham").val(maSP);
                                        $("#ten-san-pham").val(tenSP);
                                        $("#gia-san-pham").val(giaSP);
                                        $("#so-luong").val(soLuong);
                                        $("#ngay-nhap").val(ngayNhap);
                                    });
                                });
                            </script>
                            <script>
                                document.getElementById('loai-hang').addEventListener('change', function() {
                                    var maCTDM = this.value;

                                    fetch('../handlenhaphang/get_tongsoluong.php?MaCTDM=' + maCTDM)
                                        .then(response => response.json())
                                        .then(data => {
                                            document.getElementById('ten-danh-muc').textContent = data.TenCTDM;
                                            document.getElementById('tong-so-luong').textContent = new Intl.NumberFormat().format(data.TongSoLuong);
                                        })
                                        .catch(error => console.error('Lỗi:', error));
                                });
                            </script>
                            <script>
                                document.addEventListener("DOMContentLoaded", function () {
                                    const btnThem = document.querySelector("button.btnthem"); // Nút thêm
                                    const inputMaSP = document.getElementById("ma-san-pham");
                                    const inputLoaiHang = document.getElementById("loai-hang");
                                    const inputTenSP = document.getElementById("ten-san-pham");
                                    const inputTimSP = document.getElementById("tim-san-pham");
                                    const inputNgayNhap = document.getElementById("ngay-nhap");
                                    const inputGiaSP = document.getElementById("gia-san-pham");
                                    const inputSoLuong = document.getElementById("so-luong");
                                    const productList = document.getElementById("product-list");

                                    btnThem.addEventListener("click", function () {
                                        fetch("../handlenhaphang/get_latest_masp.php")
                                            .then(response => response.text())
                                            .then(maSP => {
                                                inputMaSP.value = "SP" + String(maSP).padStart(3, '0'); // Format SP001, SP002,...
                                                // Reset các input khác
                                                inputLoaiHang.value = "";
                                                inputTenSP.value = "";
                                                inputTimSP.value = "";
                                                inputNgayNhap.value = "";
                                                inputGiaSP.value = "";
                                                inputSoLuong.value = "";
                                                // Vô hiệu hóa input mã sản phẩm
                                                inputMaSP.setAttribute("disabled", "true");
                                                // Vô hiệu hóa tbody bằng CSS
                                                productList.style.pointerEvents = "none";
                                                productList.style.opacity = "0.5"; // Làm mờ để thể hiện bị vô hiệu hóa
                                            })
                                            .catch(error => console.error("Lỗi khi lấy MaSP:", error));
                                    });
                                });
                            </script>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>