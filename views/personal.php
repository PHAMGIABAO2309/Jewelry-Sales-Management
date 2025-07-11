<?php
session_start();
if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_name']) || !isset($_SESSION['user_email']) || !isset($_SESSION['user_dob']) || !isset($_SESSION['user_phai']) || !isset($_SESSION['user_hoten'])) {
    header("Location: login.php");
    exit();
}
?>

<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Thông tin cá nhân</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="../handle/dropdownprofile.js"></script>
    <script>
    function uploadImage(event) {
        const file = event.target.files[0];
        if (file) {
            if (!file.type.startsWith("image/")) {
                alert("Vui lòng chọn một tệp hình ảnh!");
                return;
            }
            let formData = new FormData();
            formData.append("file", file);

            fetch("../actions/upload.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.text())
            .then(filePath => {
                console.log("Kết quả trả về:", filePath);
                if (filePath.startsWith("Lỗi")) {
                    alert(filePath);
                } else {
                    document.getElementById("imgPreview").src = "../" + filePath;
                    document.getElementById("imagePath").value = filePath;
                }
            })
            .catch(error => console.error("Lỗi:", error));
        }
    }
    function saveAvatar() {
        const imagePath = document.getElementById("imagePath").value;

        fetch("../actions/update_avatar.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: "imagePath=" + encodeURIComponent(imagePath)
        })
        .then(response => response.text())
        .then(message => {
            alert(message);
            location.reload(); // Reload để cập nhật session
        })
        .catch(error => console.error("Lỗi:", error));
    }
</script>
</head>
<body class="bg-gray-100">
    <header class="bg-white-500 text-black">
        <div class="container mx-auto flex justify-between items-center py-2">
        <div class="flex items-center space-x-4 relative mt-[-10]">
            <a href="../views/home.php">
                <img alt="Logo" class="h-16 w-16 rounded-full" src="../images/logo.jpg"/>
            </a>
            <span class="ml-2 text-xl font-bold">Gia Bảo Jewelry</span>
        </div>
            <div class="flex items-center space-x-4">
                <!-- <a class="hover:underline" href="#">Thông báo</a>
                <i class="fas fa-question-circle"></i><a class="hover:underline" href="#"> Hỗ trợ</a>
                <i class="fab fa-facebook"></i>
                <i class="fab fa-instagram"></i>
                <i class="fas fa-globe"></i>
                <span>Tiếng Việt</span> -->
                <div class="relative flex items-center">
                    <img alt="User avatar" class="h-8 w-8 rounded-full" src="../<?= $_SESSION['user_avt'] ?>" width="30" height="30"/>
                    <span class="block font-bold ml-2" id="userDropdown">
                        <?= htmlspecialchars($_SESSION['user_name']); ?>
                    </span>
                </div>
                <?php include '../actions/dropdownprofile.php'; ?>
                <i class="fas fa-shopping-cart"></i>
                <a href="../index.php" class="ml-4 text-red-600 hover:underline">Đăng xuất</a>
            </div>
        </div>
        <div class="bg-gray-600 py-2">
            <div class="container mx-auto flex justify-between items-center">
                <div class="relative w-1/2">
                    <form method="GET" action="timkiem.php" class="w-full">
                        <i class="fas fa-search absolute left-3 top-1/2 mt-[-6px] transform -translate-y-1/2 text-gray-400"></i>
                        <input name="search" class="w-full p-2 pl-10 rounded" placeholder="Tìm sản phẩm..." type="text"/>
                    </form>
                </div>
            </div>
        </div>

        <div class="bg-yellow-500 py-2">
            <div class="container mx-auto flex space-x-4">
                <a class="text-white hover:underline" href="#">Nhẫn Cưới</a>
                <a class="text-white hover:underline " href="#">Kim cương</a>
                <a class="text-white hover:underline" href="#">Ngọc trai</a>
                <a class="text-white hover:underline" href="#">Bông tai</a>
                <a class="text-white hover:underline" href="#">Dây chuyền</a>
                <a class="text-white hover:underline" href="#">Nhẫn Nam</a>
                <a class="text-white hover:underline" href="#">Nhẫn nữ</a>
                <a class="text-white hover:underline" href="#">Vòng tay</a>
            </div>
        </div>
    </header>
    <main class="container mx-auto mt-4 flex">
        <aside class="w-1/4 bg-white p-4 rounded shadow">
            <div class="flex items-center mb-4">
                <img alt="User avatar" class="h-12 w-12 rounded-full" height="50" src="../<?= $_SESSION['user_avt'] ?>" width="50"/>
                <div class="ml-2">
                    <?php if (!empty($_SESSION['user_name'])): ?>
                        <span class="block font-bold">
                            <?= htmlspecialchars($_SESSION['user_name']); ?>
                        </span>
                    <?php endif; ?>
                    <a class="text-blue-500 hover:underline" href="#">Sửa Hồ Sơ</a>
                </div>
            </div>
            <nav>
                <ul>
                    <li class="mb-2">
                        <a class="flex items-center text-gray-700 hover:text-orange-500" href="#"><i class="fas fa-bell mr-2"></i>Thông Báo</a>
                    </li>
                    <li class="mb-2">
                        <a class="flex items-center text-gray-700 hover:text-orange-500" href="#">
                            <i class="fas fa-user mr-2"></i>Tài Khoản Của Tôi
                        </a>
                        <ul class="ml-6 mt-2">
                            <li class="mb-2"><a class="text-orange-500" href="#">Hồ Sơ</a></li>
                            <li class="mb-2"><a class="text-gray-700 hover:text-orange-500" href="#">Ngân Hàng</a></li>
                            <li class="mb-2"><a class="text-gray-700 hover:text-orange-500" href="#">Địa Chỉ</a></li>
                            <li class="mb-2"><a class="text-gray-700 hover:text-orange-500" href="#">Đổi Mật Khẩu</a></li>
                            <li class="mb-2"><a class="text-gray-700 hover:text-orange-500" href="#">Cài Đặt Thông Báo</a></li>
                            <li class="mb-2"><a class="text-gray-700 hover:text-orange-500" href="#">Những Thiết Lập Riêng Tư</a></li>
                        </ul>
                    </li>
                    <li class="mb-2">
                        <a class="flex items-center text-gray-700 hover:text-orange-500" href="#">
                            <i class="fas fa-box mr-2"></i>Đơn Mua
                        </a>
                    </li>
                    <li class="mb-2">
                        <a class="flex items-center text-gray-700 hover:text-orange-500" href="#">
                            <i class="fas fa-ticket-alt mr-2"></i>Kho Voucher
                        </a>
                    </li>
                    <li class="mb-2">
                        <a class="flex items-center text-gray-700 hover:text-orange-500" href="#">
                            <i class="fas fa-coins mr-2"></i>Xu Tích Lũy
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <section class="w-3/4 bg-white p-6 rounded shadow ml-4">
            <h2 class="text-xl font-bold mb-4">Hồ Sơ Của Tôi</h2>
            <p class="mb-4">Quản lý thông tin hồ sơ để bảo mật tài khoản</p>
            <form>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block mb-2">Tên đăng nhập</label>
                        <div class="flex items-center border rounded p-2">
                            <i class="fas fa-user text-gray-500 mr-2"></i>
                            <input class="w-full p-2 border-none rounded" disabled type="text" value="<?= htmlspecialchars($_SESSION['user_name']); ?>"/>
                        </div>
                    </div>
                    <div>
                        <label class="block mb-2">Họ Tên</label>
                        <div class="flex items-center border rounded p-2">
                            <i class="fas fa-user-circle text-gray-500 mr-2"></i>
                            <input class="w-full p-2 border-none rounded" disabled type="text" value="<?= htmlspecialchars($_SESSION['user_hoten']); ?>"/>
                        </div>
                    </div>
                    <div>
                        <label class="block mb-2">Email</label>
                        <div class="flex items-center border rounded p-2">
                            <i class="fas fa-envelope text-gray-500 mr-2"></i>
                            <input id="userEmail" class="w-full p-2 border-none rounded" disabled type="text" value="<?= htmlspecialchars($_SESSION['user_email']); ?>"/>
                            <a id="changeEmailBtn" class="text-blue-500 ml-2 cursor-pointer">Thay Đổi</a>
                        </div>
                        <!-- Form ẩn để nhập email mới -->
                        <div id="emailForm" class="hidden mt-2">
                            <div class="flex items-center border rounded p-2">
                                <i class="fas fa-envelope text-gray-500 mr-2"></i>
                                <input id="newEmail" class="w-full p-2 border-none rounded" type="email" placeholder="Nhập email mới"/>
                            </div>
                            <button id="updateEmailBtn" class="mt-2 bg-blue-500 text-white p-2 rounded">Cập Nhật</button>
                        </div>
                    </div>
                    <div>
                        <label class="block mb-2">Ngày sinh</label>
                        <div class="flex items-center border rounded p-2">
                            <i class="fas fa-calendar-alt text-gray-500 mr-2"></i>
                            <input id="userNgaySinh" class="w-full p-2 border-none rounded" disabled type="text" value="<?= date('d/m/Y', strtotime($_SESSION['user_dob'])); ?>"/>
                            <a id="changeNgaySinhBtn" class="text-blue-500 ml-2" href="#">Thay Đổi</a>
                        </div>
                        <!-- Form ẩn để nhập ngày sinh mới -->
                        <div id="ngaysinhForm" class="hidden mt-2">
                            <div class="flex items-center border rounded p-2">
                                <i class="fas fa-calendar-day text-gray-500 mr-2"></i>
                                <input id="newNgaysinh" class="w-full p-2 border-none rounded" type="text" placeholder="Nhập ngày sinh (dd/mm/yyyy)"/>
                            </div>
                            <button id="updateNgaySinhBtn" class="mt-2 bg-blue-500 text-white p-2 rounded">Cập Nhật</button>
                        </div>
                    </div>
                    <div>
                        <label class="block mb-2 text-lg font-semibold">Giới tính</label>
                        <div class="flex items-center">
                            <div class="flex items-center mr-6">
                                <input class="mr-2" name="gender" type="radio" value="male" <?= ($_SESSION['user_phai'] == 'Nam') ? 'checked' : ''; ?>/>
                                <i class="fas fa-male text-gray-700 mr-2 text-2xl"></i>
                                <label class="text-gray-700 text-lg">Nam</label>
                            </div>
                            <div class="flex items-center mr-6">
                                <input class="mr-2" name="gender" type="radio" value="female" <?= ($_SESSION['user_phai'] == 'Nữ') ? 'checked' : ''; ?>/>
                                <i class="fas fa-female text-gray-700 mr-2 text-2xl"></i>
                                <label class="text-gray-700 text-lg">Nữ</label>
                            </div>
                            <div class="flex items-center">
                                <input class="mr-2" name="gender" type="radio" value="other" <?= ($_SESSION['user_phai'] == 'Khác') ? 'checked' : ''; ?>/>
                                <label class="text-gray-700 text-lg">Khác</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-4 flex items-center">
                    <img id="imgPreview" class="h-24 w-24 rounded-full" src="../<?= $_SESSION['user_avt'] ?>" alt="User profile picture">
                    <div class="ml-4">
                        <input type="hidden" id="imagePath" value="<?= $_SESSION['user_avt'] ?>">
                        <input type="file" id="fileInput" name="file" style="display: none;" onchange="uploadImage(event)">
                        <button type="button" class="block bg-gradient-to-r from-blue-500 to-blue-600 text-white px-6 py-3 rounded-full text-lg font-semibold hover:from-blue-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300 shadow-lg transform transition duration-300 ease-in-out hover:scale-105 active:scale-95" onclick="document.getElementById('fileInput').click()">
                            Chọn Ảnh
                        </button>
                        <p class="text-gray-500 mt-2">Dung lượng file tối đa 1 MB<br/>Định dạng: .JPEG, .PNG</p>
                    </div>
                </div>
                <div class="mt-4">
                    <button class="bg-orange-500 text-white px-4 py-2 rounded" onclick="saveAvatar()">Lưu</button>
                </div>
            </form>
        </section>
    </main>
</body>
</html>
<script>
document.getElementById("changeEmailBtn").addEventListener("click", function () {
    document.getElementById("emailForm").classList.remove("hidden");
});
document.getElementById("updateEmailBtn").addEventListener("click", function () {
    let newEmail = document.getElementById("newEmail").value;
    if (newEmail === "") {
        alert("Vui lòng nhập email mới!");
        return;
    }
    // Gửi dữ liệu qua AJAX
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../taikhoan/update_email.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            let response = JSON.parse(xhr.responseText);
            if (response.success) {
                document.getElementById("userEmail").value = newEmail;
                document.getElementById("emailForm").classList.add("hidden");
                alert("Cập nhật thành công!");
            } else {
                alert("Lỗi: " + response.message);
            }
        }
    };
    xhr.send("new_email=" + encodeURIComponent(newEmail));
});
</script>
<script>
document.getElementById("newNgaysinh").addEventListener("input", function (e) {
    let value = e.target.value.replace(/\D/g, ""); // Xóa ký tự không phải số
    if (value.length >= 2) value = value.slice(0, 2) + "/" + value.slice(2);
    if (value.length >= 5) value = value.slice(0, 5) + "/" + value.slice(5, 9);
    e.target.value = value;
});
document.getElementById("changeNgaySinhBtn").addEventListener("click", function () {
    document.getElementById("ngaysinhForm").classList.remove("hidden");
});
document.getElementById("updateNgaySinhBtn").addEventListener("click", function () {
    let newNgaySinh = document.getElementById("newNgaysinh").value;
    if (newNgaySinh === "") {
        alert("Vui lòng nhập Ngày sinh mới!");
        return;
    }
    // Gửi dữ liệu qua AJAX
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../taikhoan/update_ngaysinh.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            let response = JSON.parse(xhr.responseText);
            if (response.success) {
                document.getElementById("userNgaySinh").value = newNgaySinh;
                document.getElementById("ngaysinhForm").classList.add("hidden");
                alert("Cập nhật thành công!");
            } else {
                alert("Lỗi: " + response.message);
            }
        }
    };
    xhr.send("new_ngaysinh=" + encodeURIComponent(newNgaySinh));
});
</script>