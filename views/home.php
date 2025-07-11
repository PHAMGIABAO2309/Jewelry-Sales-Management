<?php
include '../database/connect.php'; 
include '../actions/danhmuc.php'; 
include '../actions/dropdownbosuutap.php'; 
include '../actions/dropdowndongtrangsuc.php';
include '../actions/dropdownloaisanpham.php';
include '../actions/dropdowndathang.php';

// Truy vấn lấy sản phẩm xuất hàng trong 7 ngày gần nhất, tổng số lượng xuất và ngày xuất mới nhất
$sql = "
    SELECT xh.MaSP, sp.TenSP, sp.Gia, sp.SoLuong, SUM(xh.SoLuong) AS TongSoLuong, MAX(xh.NgayXuatHang) AS NgayXuatGanNhat
    FROM sanpham sp
    JOIN xuathang xh ON sp.MaSP = xh.MaSP
    WHERE xh.NgayXuatHang >= CURDATE() - INTERVAL 7 DAY
    GROUP BY xh.MaSP, sp.TenSP, sp.Gia
    ORDER BY TongSoLuong DESC
";
$result = mysqli_query($conn, $sql); 

?>

<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>Gia Bảo Jewelry</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link rel="icon" type="image/png" href="../images/logo.jpg">
  <link rel="stylesheet" href="../assets/navbar.css">
  <script src="../handle/dropdownprofile.js"></script>
  <script src="../handle/dropdownbosuutap.js"></script>
  <script src="../handle/dropdowndongtrangsuc.js"></script>
  <script src="../handle/dropdownloaisanpham.js"></script>
</head>
 <body class="bg-white text-black">
    <header class="flex items-center justify-between p-4 bg-gray-100 w-[1640px] h-[80px]">
        <!-- Logo và Danh mục sản phẩm -->
        <div class="flex items-center space-x-4 relative mt-[-10]">
            <a href="../views/home.php">
                <img id="logo" alt="Logo" class="h-16 w-16 rounded-full" src="../images/logo.jpg"/>
            </a>
            <div class="relative">
                <?php echo getDanhMuc($conn); ?>
            </div>
        </div>
        <!-- Ô tìm kiếm + Thông tin user -->
        <div class="flex items-center space-x-4 ml-auto mt-4">
            <div class="relative">
                <form method="GET" action="timkiem.php" class="w-full">
                    <input class="border rounded-full p-2 w-96 pl-10" 
                        placeholder="Tìm Sản Phẩm: Ví dụ: kiềng, dây chuyền..." 
                        type="text" name="search"/>
                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 mt-[-6]"></i>
                </form>
            </div>
            <?php if (isset($_SESSION['user_name'])): ?>
                <a id="userDropdown" class="flex items-center space-x-1 cursor-pointer mt-[-20]" href="#">
                <i class="fas fa-user text-white bg-blue-500 rounded-full p-1 text-sm shadow-md"></i>
                    <span class="ml-2 px-3 py-1  text-blue-600 font-bold hover:text-purple-500 transition-all duration-300">
                        <?= $_SESSION['user_name']; ?>
                    </span>
                </a>
                <?php include '../actions/dropdownprofile.php'; ?>
                <a class="flex items-center space-x-1 text-red-500 mt-[-20]" href="../actions/logout.php"><i class="fas fa-sign-out-alt"></i><span>Đăng Xuất</span></a>
            <?php else: ?>
                <a class="flex items-center space-x-1 mt-[-20]" href="login.php"><i class="fas fa-user"></i><span>Đăng Nhập</span></a>
                <a class="flex items-center space-x-1 mt-[-20]" href="register.php"><i class="fas fa-user-plus"></i><span>Đăng Ký</span></a>
            <?php endif; ?>
        </div>
    </header>

    <main class="p-4">
        <div class="overflow-hidden w-full max-w-[70vw] lg:max-w-[65vw] mx-auto mt-[-14] ">
            <!-- Slider Wrapper -->
            <div id="sliderWrapper" class="flex transition-transform duration-700 ease-in-out">
                <img src="../images/home1.jpg" alt="Gold bars" class="w-full object-cover flex-shrink-0">
                <img src="../images/home2.jpg" alt="Gold bars" class="w-full object-cover flex-shrink-0">
                <img src="../images/home3.jpg" alt="Gold bars" class="w-full object-cover flex-shrink-0">
                <img src="../images/home4.jpg" alt="Gold bars" class="w-full object-cover flex-shrink-0">
            </div>

            <!-- Nút Trái -->
            <button id="prevBtn"
                class="absolute left-28 top-1/2 -translate-y-1/2 bg-black/50 text-white w-10 h-10 flex items-center justify-center rounded-full hover:bg-black z-0">
                ❮
            </button>

            <!-- Nút Phải -->
            <button id="nextBtn"
                class="absolute right-28 top-1/2 -translate-y-1/2 bg-black/50 text-white w-10 h-10 flex items-center justify-center rounded-full hover:bg-black z-0">
                ❯
            </button>
            <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 z-10 flex space-x-2">
                <input type="radio" name="slide" id="slide1" class="hidden" checked>
                <label for="slide1" class="w-4 h-4 bg-white rounded-full cursor-pointer"></label>

                <input type="radio" name="slide" id="slide2" class="hidden">
                <label for="slide2" class="w-4 h-4 bg-white rounded-full cursor-pointer"></label>

                <input type="radio" name="slide" id="slide3" class="hidden">
                <label for="slide3" class="w-4 h-4 bg-white rounded-full cursor-pointer"></label>
            </div>
        </div>
        <h2 class="text-center text-2xl font-bold mt-10 p-2">
            SẢN PHẨM BÁN CHẠY TRONG TUẦN
        </h2>
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4 mt-2">
            <?php 
            // Nếu có từ khóa tìm kiếm thì dùng kết quả từ truy vấn tìm kiếm
           
            while ($row = mysqli_fetch_assoc($result)) { ?>
                <div class="text-center">
                    <div class="group relative  ">
                        <img alt="<?= $row['TenSP']; ?>" class="mx-auto rounded-lg  cursor-pointer transition-transform duration-300 ease-in-out group-hover:-translate-y-2" height="150" 
                            src="../images/<?= $row['MaSP']; ?>.jpg" width="150"/>
                        
                        <!-- Phần hover hiện dưới ảnh -->
                        <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-[150px] opacity-0 translate-y-2 
                                    transition-all duration-300 ease-in-out group-hover:translate-y-0 group-hover:opacity-100">
                            <div class="flex justify-around items-center py-3 bg-white shadow-lg rounded-lg">
                                <button class="menuorder text-gray-700 hover:text-gray" 
                                        data-masp="<?= htmlspecialchars($row['MaSP']) ?>" 
                                        data-tensp="<?= htmlspecialchars($row['TenSP']) ?>" 
                                        data-soluongsp="<?= $row['SoLuong'] ?>"
                                        data-gia="<?= $row['Gia'] ?>"
                                        data-mand="<?= $_SESSION['user_id']; ?>">
                                    <i class="fas fa-shopping-cart hover:text-red-500" title="Thêm vào giỏ hàng"></i>
                                </button>
                                <button class="text-gray-700 hover:text-black"><i class="fas fa-heart"></i></button>
                                <button class="text-gray-700 hover:text-black"><i class="fas fa-shopping-bag"></i></button>
                            </div>
                        </div>
                    </div>
                    <p class="mt-2"><?= $row['TenSP']; ?></p>
                    <p class="text-red-500 font-bold">Giá: <?= number_format($row['Gia'], 0, ',', '.') ?> đ</p>
                </div>
            <?php } ?>
        </div> 
    </main>
    <footer class="overflow-hidden bg-gray-100 p-4 mt-8 relative">
        <div class="marquee">
            <p>
                Trang web quản lý mua bán trang sức. Giảng viên hướng dẫn: Nguyễn Thị Diễm Trang. Sinh viên thực hiện: Phạm Gia Bảo
            </p>
        </div>
    </footer>
 <?php
if (isset($_SESSION['now_playing'])) {
    $song = $_SESSION['now_playing']['song'];
    $time = $_SESSION['now_playing']['time'];
    echo "<script>
      const audio = new Audio('$song');
      audio.currentTime = $time;
      audio.play();
    </script>";
}
?>




 </body>
</html>
<script>
    const images = ["../images/home1.jpg", "../images/home2.jpg", "../images/home3.jpg", "../images/home4.jpg"];
    const sliderWrapper = document.getElementById("sliderWrapper");
    const totalSlides = sliderWrapper.children.length;
    let currentIndex = 0;
    const radios = document.querySelectorAll("input[name='slide']");
    const labels = document.querySelectorAll("label[for^='slide']");

    // Cập nhật slide hiện tại và màu radio button
    function updateSlide(index) {
        const slideWidth = sliderWrapper.clientWidth / totalSlides;
        sliderWrapper.style.transform = `translateX(-${index * 100}%)`;

        // Cập nhật radio button
        radios.forEach((radio, i) => {
            const label = labels[i];
            if (i === index) {
                label.style.backgroundColor = 'blue';  // Màu xanh khi radio button được chọn
            } else {
                label.style.backgroundColor = 'white'; // Màu trắng khi không được chọn
            }
        });
    }

    function nextSlide() {
        currentIndex = (currentIndex + 1) % totalSlides;
        updateSlide(currentIndex);
    }

    function prevSlide() {
        currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
        updateSlide(currentIndex);
    }

    document.getElementById("nextBtn").addEventListener("click", nextSlide);
    document.getElementById("prevBtn").addEventListener("click", prevSlide);
    
    radios.forEach((radio, index) => {
        radio.addEventListener("change", () => {
            currentIndex = index;
            updateSlide(currentIndex);
        });
    });
    
    setInterval(nextSlide, 2000);
</script>
