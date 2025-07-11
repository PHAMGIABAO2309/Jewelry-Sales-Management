<?php
session_start();
include dirname(__DIR__) . '/database/connect.php';
// Truy vấn danh mục
$sql_danhmuc = "SELECT MaDM, TenDM FROM danhmuc";
$result_danhmuc = $conn->query($sql_danhmuc);

// Truy vấn chi tiết danh mục
$sql_chitietdanhmuc = "SELECT MaDM, MaCTDM, TenCTDM, MoTa FROM chitietdanhmuc";
$result_chitietdanhmuc = $conn->query($sql_chitietdanhmuc);


?>

<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quản lý chi tiết danh mục</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="icon" type="image/png" href="../images/logo.jpg">
    <link rel="stylesheet" href="../assets/quanlynhaphang.css">
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
        <div class="p-4 bg-white main-content">
        <main class="container ">
                <section class="mb-8">
                    <h2 class="text-3xl font-extrabold mb-4 text-gray-900 tracking-wide">🚀 Quản lý chi tiết danh mục</h2>
                    <div class="d-flex align-items-center mb-3">
                        <label for="loai-danhmuc" class="form-label me-2">Loại danh mục:</label>
                        <select id="loai-danhmuc" name="loai-danhmuc" class="form-select form-select-sm" style="max-width: 200px; margin-left: 20px;">
                            <option value="">--Chọn loại danh mục--</option>
                            <?php while ($row = $result_danhmuc->fetch_assoc()) { ?>
                                <option value="<?= $row['MaDM'] ?>"><?= $row['TenDM'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <h2 class="text-lg font-semibold mb-2 text-gray-700">➕ Thêm chi tiết danh mục</h2>
                    <form id="categoryForm" class="flex space-x-4 items-center">
                        <input type="text" id="tenCTDM" placeholder="Nhập tên chi tiết danh mục" required
                            class="w-64 p-3 border border-gray-300 rounded-xl focus:ring-4 focus:ring-blue-400 focus:outline-none transition-all duration-300">
                        <button type="button" id="btnthem"
                            class="bg-gradient-to-r from-blue-500 to-blue-700 text-white px-5 py-2 rounded-xl transition-all duration-300 hover:scale-105 hover:shadow-lg active:scale-95 flex items-center space-x-2">
                            <i class="fas fa-plus"></i> <span>Thêm</span>
                        </button>
                    </form>
                    <p id="message" style="color: green; margin-top: 10px;"></p>
                </section>

                <section>
                    <h2 class="text-3xl font-extrabold mb-4 text-gray-900 tracking-wide">📋 Thông tin chi tiết danh mục</h2>
                    <div class="overflow-hidden border border-gray-300 rounded-xl transform transition-all duration-300 ">
                        <table class="min-w-full bg-white text-center">
                            <thead class="bg-blue-600 text-white">
                                <tr>
                                    <th class="py-4 px-6">Mã DM</th>
                                    <th class="py-4 px-6">Mã CTDM</th>
                                    <th class="py-4 px-6">Tên CTDM</th>
                                    <th class="py-4 px-6">Mô Tả</th>
                                    <th class="py-4 px-6">Hoạt động</th>
                                </tr>
                            </thead>
                            <tbody id="categoryTable">
                                <?php if ($result_chitietdanhmuc->num_rows > 0): ?>
                                    <?php while ($row = $result_chitietdanhmuc->fetch_assoc()): ?>
                                        <tr id="row_<?= $row["MaCTDM"] ?>"
                                            class="hover:bg-gray-100 transition-all duration-300 border-b transform ">
                                            <td class="py-4 px-6"><?= $row["MaDM"] ?></td>
                                            <td class="py-4 px-6"><?= $row["MaCTDM"] ?></td>
                                            <td class="py-6 px-8" style="min-width: 200px;"><?= $row["TenCTDM"] ?></td>
                                            <td class="py-4 px-6"><?= $row["MoTa"] ?></td>
                                            <td class="py-4 px-6">
                                                <div class="flex justify-center space-x-4">
                                                <button class="text-blue-600 hover:text-blue-800 updateBtn transition-all duration-200 hover:scale-110"
                                                        data-id="<?= $row["MaCTDM"] ?>"
                                                        data-madm="<?= $row["MaDM"] ?>">
                                                    <i class="fas fa-edit"></i> Edit
                                                </button>

                                                    <button class="text-red-600 hover:text-red-800 deleteBtn transition-all duration-200 hover:scale-110"
                                                        data-id="<?= $row["MaCTDM"] ?>" data-madm="<?= $row["MaDM"] ?>">
                                                        <i class="fas fa-trash"></i> Delete
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="3" class="py-4 px-6 text-gray-500">Không có danh mục nào!</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </section>
            </main>
        </div>
    </div>
</body>
</html>
<!-- Modal -->
<div id="editModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
        <h2 class="text-xl font-bold mb-4">Cập nhật danh mục</h2>
        
        <input type="hidden" id="editMaCTDM">
        <input type="hidden" id="editMaDM">
        
        <label class="block mb-2">Tên danh mục:</label>
        <input type="text" id="editTenCTDM" class="w-full border px-3 py-2 rounded mb-4">

        <label class="block mb-2">Mô tả:</label>
        <textarea id="editMoTa" class="w-full border px-3 py-2 rounded mb-4"></textarea>
        
        <div class="flex justify-end space-x-4">
            <button id="closeModal" class="px-4 py-2 bg-gray-500 text-white rounded">Hủy</button>
            <button id="updateCategory" class="px-4 py-2 bg-blue-600 text-white rounded">Cập nhật</button>
        </div>
    </div>
</div>



<style>
@keyframes marquee {
    0% { text-indent: -100%; } /* Bắt đầu từ bên trái ngoài khung */
    100% { text-indent: 100%; } /* Di chuyển sang phải ngoài khung */
}

.scrolling-input {
    white-space: nowrap;  /* Không xuống dòng */
    overflow: hidden;
    display: block;
    animation: marquee 5s linear infinite; /* 10s để chạy chậm hơn */
}
#categoryTable tr:hover {
    background-color:rgb(95, 198, 239); /* Màu xanh nhạt */
    transition: background-color 0.3s ease-in-out;
}
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function () {
    // Khi chọn danh mục thi hien chi tiet danh muc tuong ung
    $('#loai-danhmuc').change(function () {
        var maDM = $(this).val();
        $.ajax({
            type: "POST",
            url: "../chitietdanhmuc/filter_category.php",
            data: { MaDM: maDM },
            dataType: "json",
            success: function (response) {
                var tbody = $("#categoryTable");
                tbody.empty(); // Xóa dữ liệu cũ

                if (response.length > 0) {
                    $.each(response, function (index, item) {
                        tbody.append(`
                            <tr id="row_${item.MaCTDM}" class="hover:bg-gray-100 transition-all duration-300 border-b transform">
                                <td class="py-4 px-6">${item.MaDM}</td>
                                <td class="py-4 px-6">${item.MaCTDM}</td>
                                <td class="py-6 px-8" style="min-width: 200px;">${item.TenCTDM}</td>
                                <td class="py-4 px-6">${item.MoTa}</td>
                                <td class="py-4 px-6">
                                    <div class="flex justify-center space-x-4">
                                        <button class="text-blue-600 hover:text-blue-800 updateBtn transition-all duration-200 hover:scale-110"
                                            data-id="${item.MaCTDM}">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <button class="text-red-600 hover:text-red-800 deleteBtn transition-all duration-200 hover:scale-110"
                                            data-id="${item.MaCTDM}">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        `);
                    });
                } else {
                    tbody.append(`
                        <tr>
                            <td colspan="5" class="py-4 px-6 text-gray-500">Không có danh mục nào!</td>
                        </tr>
                    `);
                }
            }
        });
    });
});
</script>
<script>
document.getElementById("btnthem").addEventListener("click", function () {
    var tenCTDM = document.getElementById("tenCTDM").value.trim();
    var MaDM = document.getElementById("loai-danhmuc").value;

    if (!tenCTDM) {
        Swal.fire({
            icon: "warning",
            title: "Lỗi!",
            text: "Vui lòng nhập tên chi tiết danh mục!",
            confirmButtonColor: "#3085d6",
        });
        return;
    }
    if (!MaDM) {
        Swal.fire({
            icon: "warning",
            title: "Lỗi!",
            text: "Vui lòng chọn loại danh mục!",
            confirmButtonColor: "#3085d6",
        });
        return;
    }

    fetch("../chitietdanhmuc/insert_CTDM.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: "tenCTDM=" + encodeURIComponent(tenCTDM) + "&MaDM=" + encodeURIComponent(MaDM)
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === "success") {
            Swal.fire({
                icon: "success",
                title: "Thành công!",
                text: "Thêm danh mục mới thành công!",
                showConfirmButton: false,
                timer: 1500,
            });

            document.getElementById("tenCTDM").value = ""; // Xóa input sau khi thêm

            // **Thêm hàng mới vào cuối bảng**
            let newRow = `
                <tr id="row_${data.MaCTDM}" class="hover:bg-gray-100 transition-all duration-300 border-b transform">
                    <td class="py-4 px-6">${data.MaDM}</td>
                    <td class="py-4 px-6">${data.MaCTDM}</td>
                    <td class="py-6 px-8" style="min-width: 200px;">${data.TenCTDM}</td>
                    <td class="py-4 px-6">-</td> <!-- Cột Mô tả (chưa có dữ liệu) -->
                    <td class="py-4 px-6">
                        <div class="flex justify-center space-x-4">
                            <button class="text-blue-600 hover:text-blue-800 updateBtn transition-all duration-200 hover:scale-110"
                                data-id="${data.MaCTDM}">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <button class="text-red-600 hover:text-red-800 deleteBtn transition-all duration-200 hover:scale-110"
                                data-id="${data.MaCTDM}">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </div>
                    </td>
                </tr>
            `;

            document.getElementById("categoryTable").insertAdjacentHTML("beforeend", newRow); // ✅ Thêm vào cuối bảng
        } else {
            Swal.fire({
                icon: "error",
                title: "Lỗi!",
                text: data.message,
            });
        }
    })
    .catch(error => {
        Swal.fire({
            icon: "error",
            title: "Lỗi!",
            text: "Có lỗi xảy ra, vui lòng thử lại!",
        });
        console.error("Lỗi:", error);
    });
});
</script>
<script>
    $(document).ready(function() {
        $(document).on("click", ".deleteBtn", function() {
            var maDM = $(this).data("id");
            var row = $("#row_" + maDM);

            // Hiển thị hộp thoại xác nhận bằng SweetAlert2
            Swal.fire({
                title: "Bạn có chắc chắn?",
                text: "Hành động này sẽ xóa danh mục và không thể hoàn tác!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Xóa ngay!",
                cancelButtonText: "Hủy"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "../chitietdanhmuc/delete_CTDM.php",
                        type: "POST",
                        data: { maDM: maDM },
                        dataType: "json",
                        success: function(response) {
                            if (response.status === "success") {
                                row.remove(); // Xóa dòng
                                Swal.fire("Đã xóa!", "Danh mục đã bị xóa thành công.", "success");
                            } else {
                                Swal.fire("Lỗi!", response.message, "error");
                            }
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                            Swal.fire("Lỗi hệ thống!", "Vui lòng kiểm tra console để biết thêm chi tiết.", "error");
                        }
                    });
                }
            });
        });
    });
</script>

