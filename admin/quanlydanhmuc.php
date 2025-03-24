<?php
session_start();
include dirname(__DIR__) . '/database/connect.php';

// Truy vấn danh mục
$sql = "SELECT MaDM, TenDM FROM danhmuc";
$result = $conn->query($sql);
?>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quản lý danh mục</title>
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
                    <h2 class="text-3xl font-extrabold mb-4 text-gray-900 tracking-wide">🚀 Quản lý danh mục</h2>
                    <h2 class="text-lg font-semibold mb-2 text-gray-700">➕ Thêm danh mục</h2>
                    <form id="categoryForm" class="flex space-x-4 items-center">
                        <input type="text" id="tenDM" placeholder="Nhập tên danh mục" required
                            class="w-64 p-3 border border-gray-300 rounded-xl focus:ring-4 focus:ring-blue-400 focus:outline-none transition-all duration-300">
                        <button type="submit"
                            class="bg-gradient-to-r from-blue-500 to-blue-700 text-white px-5 py-2 rounded-xl transition-all duration-300 hover:scale-105 hover:shadow-lg active:scale-95 flex items-center space-x-2">
                            <i class="fas fa-plus"></i> <span>Thêm</span>
                        </button>
                    </form>
                </section>

                <section>
                    <h2 class="text-3xl font-extrabold mb-4 text-gray-900 tracking-wide">📋 Thông tin danh mục</h2>
                    <div class="overflow-hidden border border-gray-300 rounded-xl transform transition-all duration-300 ">
                        <table class="min-w-full bg-white text-center">
                            <thead class="bg-blue-600 text-white">
                                <tr>
                                    <th class="py-4 px-6">Mã danh mục</th>
                                    <th class="py-4 px-6">Tên danh mục</th>
                                    <th class="py-4 px-6">Hoạt động</th>
                                </tr>
                            </thead>
                            <tbody id="categoryTable">
                                <?php if ($result->num_rows > 0): ?>
                                    <?php while ($row = $result->fetch_assoc()): ?>
                                        <tr id="row_<?= $row["MaDM"] ?>"
                                            class="hover:bg-gray-100 transition-all duration-300 border-b transform ">
                                            <td class="py-4 px-6"><?= $row["MaDM"] ?></td>
                                            <td class="py-4 px-6"><?= $row["TenDM"] ?></td>
                                            <td class="py-4 px-6">
                                                <div class="flex justify-center space-x-4">
                                                    <button class="text-blue-600 hover:text-blue-800 updateBtn transition-all duration-200 hover:scale-110"
                                                        data-id="<?= $row["MaDM"] ?>">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </button>
                                                    <button class="text-red-600 hover:text-red-800 deleteBtn transition-all duration-200 hover:scale-110"
                                                        data-id="<?= $row["MaDM"] ?>">
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

<div id="updateModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded shadow-lg w-80">
        <h2 class="text-lg font-bold mb-4">Cập nhật danh mục</h2>
        <input type="hidden" id="updateMaDM">
        <input type="text" id="updateTenDM" class="w-full p-2 border rounded mb-4" placeholder="Nhập tên danh mục mới">
        <div class="flex justify-end space-x-2">
            <button id="closeModal" class="px-4 py-2 bg-gray-500 text-white rounded">Hủy</button>
            <button id="saveUpdate" class="px-4 py-2 bg-blue-600 text-white rounded">Cập nhật</button>
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
<script>
    $(document).ready(function () {
    // Mở form cập nhật khi nhấn nút Edit
    $(document).on("click", ".updateBtn", function () {
        let maDM = $(this).data("id");
        let tenDM = $(this).closest("tr").find("td:nth-child(2)").text().trim();
        $("#updateMaDM").val(maDM);
        $("#updateTenDM").val(tenDM);
        $("#updateModal").removeClass("hidden"); // Hiện modal
    });
    // Đóng modal
    $("#closeModal").click(function () {
        $("#updateModal").addClass("hidden");
    });

    // Gửi AJAX cập nhật danh mục
    $("#saveUpdate").click(function () {
        let maDM = $("#updateMaDM").val();
        let tenDM = $("#updateTenDM").val().trim();

        if (tenDM === "") {
            alert("Vui lòng nhập tên danh mục mới!");
            return;
        }

        $.ajax({
            url: "../quanlydanhmuc/update_category.php",
            type: "POST",
            data: { maDM: maDM, tenDM: tenDM },
            dataType: "json",
            success: function (response) {
    if (response.status === "success") {
        let row = $(".updateBtn[data-id='" + maCTDM + "'][data-madm='" + maDM + "']").closest("tr"); // Tìm đúng hàng chứa nút được click
        row.find("td:nth-child(1)").text(maDM); // Cập nhật lại Mã danh mục nếu cần
        row.find("td:nth-child(3)").text(tenCTDM);
        row.find("td:nth-child(4)").text(moTa);
        $("#updateModal").addClass("hidden");
    } else {
        alert("Lỗi: " + response.message);
    }
}
,
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
                alert("Lỗi hệ thống, kiểm tra console!");
            }
        });
    });
});
</script>

<script>
    $(document).ready(function() {
        $("#categoryForm").submit(function(e) {
            e.preventDefault(); // Ngăn form gửi truyền thống

            var tenDM = $("#tenDM").val().trim();
            if (tenDM === "") {
                alert("Vui lòng nhập tên danh mục!");
                return;
            }
            $.ajax({
                url: "../quanlydanhmuc/add_category.php",
                type: "POST",
                data: { tenDM: tenDM },
                dataType: "json",
                success: function(response) {
                    if (response.status === "success") {
                        // Thêm hàng mới vào CUỐI bảng
                        $("#categoryTable").append(`
                            <tr id="row_${response.newMaDM}" class="hover:bg-gray-100 transition-all duration-300 border-b transform ">
                                <td class="py-4 px-6 border-b">${response.newMaDM}</td>
                                <td class="py-4 px-6border-b">${tenDM}</td>
                                <td class="py-4 px-6 border-b">
                                    <div class="flex justify-center space-x-2">
                                        <button class="text-blue-600 hover:text-blue-800 updateBtn transition-all duration-200 hover:scale-110" data-id="${response.newMaDM}">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <button class="text-red-600 hover:text-red-800 deleteBtn transition-all duration-200 hover:scale-110" data-id="${response.newMaDM}">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        `);
                        $("#tenDM").val(""); // Reset input
                    } else {
                        alert("Lỗi: " + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                    alert("Lỗi hệ thống, xem console để biết thêm!");
                }
            });
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
                        url: "../quanlydanhmuc/delete_category.php",
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

