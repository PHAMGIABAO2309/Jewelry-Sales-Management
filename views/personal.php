<?php
session_start();
if (!isset($_SESSION['user_name']) || !isset($_SESSION['user_email']) || !isset($_SESSION['user_dob'])) {
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
            <div class="flex items-center">
                <a href="../views/home.php">
                <img alt="Gold logo" class="h-10" height="40" src="https://storage.googleapis.com/a1aa/image/V9V4_XEIiWzg0jZ19FHN1uvQC53Lo7sRH6-UfdQKmp8.jpg" width="40"/>
                </a>
                <span class="ml-2 text-xl font-bold">Gia Bảo Jewelry</span>
            </div>
            <div class="flex items-center space-x-4">
                <a class="hover:underline" href="#">Thông báo</a>
                <i class="fas fa-question-circle"></i><a class="hover:underline" href="#"> Hỗ trợ</a>
                <i class="fab fa-facebook"></i>
                <i class="fab fa-instagram"></i>
                <i class="fas fa-globe"></i>
                <span>Tiếng Việt</span>
                <div class="relative flex items-center">
                    <img alt="User avatar" class="h-8 w-8 rounded-full" src="../<?= $_SESSION['user_avt'] ?>" width="30" height="30"/>
                    <span class="block font-bold ml-2">
                        <?= htmlspecialchars($_SESSION['user_name']); ?>
                    </span>
                </div>
                <i class="fas fa-shopping-cart"></i>
                <a href="../index.php" class="ml-4 text-red-600 hover:underline">Đăng xuất</a>
            </div>
        </div>
        <div class="bg-gray-600 py-2">
            <div class="container mx-auto flex justify-between items-center">
                <div class="relative w-1/2">
                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <input class="w-full p-2 pl-10 rounded" placeholder="Tìm sản phẩm, thương hiệu, và tên shop" type="text"/>
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
                        <input class="w-full p-2 border rounded" disabled="" type="text" value="<?= htmlspecialchars($_SESSION['user_name']); ?>"/>
                    </div>
                    <div>
                        <label class="block mb-2">Tên</label>
                        <input class="w-full p-2 border rounded" type="text" value="Daniel"/>
                    </div>
                    <div>
                        <label class="block mb-2">Email</label>
                        <div class="flex items-center">
                            <input class="w-full p-2 border rounded" disabled="" type="text" value="<?= htmlspecialchars($_SESSION['user_email']); ?>"/>
                            <a class="text-blue-500 ml-2" href="#">Thay Đổi</a>
                        </div>
                    </div>
                    <div>
                        <label class="block mb-2">Số điện thoại</label>
                        <div class="flex items-center">
                            <input class="w-full p-2 border rounded" disabled="" type="text" value="********80"/>
                            <a class="text-blue-500 ml-2" href="#">Thay Đổi</a>
                        </div>
                    </div>
                    <div>
                        <label class="block mb-2">Giới tính</label>
                        <div class="flex items-center">
                            <input checked="" class="mr-2" name="gender" type="radio" value="male"/>Nam
                            <input class="ml-4 mr-2" name="gender" type="radio" value="female"/>Nữ
                            <input class="ml-4 mr-2" name="gender" type="radio" value="other"/>Khác
                        </div>
                    </div>
                    <div>
                        <label class="block mb-2">Ngày sinh</label>
                        <div class="flex items-center">
                            <input class="w-full p-2 border rounded" disabled="" type="text" value="<?= htmlspecialchars($_SESSION['user_dob']); ?>"/>
                            <a class="text-blue-500 ml-2" href="#">Thay Đổi</a>
                        </div>
                    </div>
                </div>
                <div class="mt-4 flex items-center">
                    <img id="imgPreview" class="h-24 w-24 rounded-full" src="../<?= $_SESSION['user_avt'] ?>" alt="User profile picture">
                    <div class="ml-4">
                        <input type="hidden" id="imagePath" value="<?= $_SESSION['user_avt'] ?>">
                        <input type="file" id="fileInput" name="file" style="display: none;" onchange="uploadImage(event)">
                        <button type="button" class="block bg-gray-200 text-gray-700 px-4 py-2 rounded" onclick="document.getElementById('fileInput').click()">Chọn Ảnh</button>
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