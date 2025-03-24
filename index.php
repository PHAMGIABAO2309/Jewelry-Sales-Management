<?php
include 'database/connect.php'; 
include 'actions/danhmuc.php'; 
include 'actions/dropdownbosuutap.php'; 
include 'actions/dropdowndongtrangsuc.php';
include 'actions/dropdownloaisanpham.php';
include 'actions/dropdowndathang.php';

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

// Lấy giá trị tìm kiếm từ input người dùng (tránh SQL Injection)
$search_value = isset($_GET['search']) ? trim($_GET['search']) : "";

// Chuẩn bị truy vấn
$sql_search = "SELECT MaSP, TenSP, Gia, SoLuong FROM sanpham 
               WHERE TenSP LIKE ? OR MaSP = ? OR Gia = ?";

$stmt = mysqli_prepare($conn, $sql_search);
$search_param = "%$search_value%";
mysqli_stmt_bind_param($stmt, "ssi", $search_param, $search_value, $search_value);
mysqli_stmt_execute($stmt);
$result_search = mysqli_stmt_get_result($stmt); 
?>

<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>Jewelry Store</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link rel="icon" type="image/png" href="https://storage.googleapis.com/a1aa/image/idUd40l_cpmB-xqRpUgornlkLqPLLy0mvYxRHI7Vcd8.jpg">
  <link rel="stylesheet" href="assets/navbar.css">
  <script src="handle/dropdownbosuutap.js"></script>
  <script src="handle/dropdowndongtrangsuc.js"></script>
  <script src="handle/dropdownloaisanpham.js"></script>
</head>
 <body class="bg-white text-black">
    <header class="flex items-center justify-between p-4 bg-gray-100">
        <div class="flex items-center space-x-4">
            <a href="views/home.php">
                <img alt="Logo" class="h-16 w-16 rounded-full" src="images/logo.jpg"/>
            </a>
            <div class="relative "><?php echo getDanhMuc($conn); ?></div>

        </div>

        <div class="flex items-center space-x-4">
            <div class="relative">
                <form method="GET" class="w-full ">
                    <input class="border rounded-full p-2 w-96 pl-10 " 
                        placeholder="Tìm Sản Phẩm: Ví dụ: kiềng, dây chuyền..." 
                        type="text" name="search" value="<?= htmlspecialchars($search_value) ?>" />
                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 mt-[-6]"></i>
                </form>
            </div>
            <a class="flex items-center space-x-1 cursor-pointer" onclick="window.location.href='views/login.php'">
                <i class="fas fa-user"></i><span>Đăng Nhập</span>
            </a>
            <a class="flex items-center space-x-1" onclick="window.location.href='views/register.php'">
                <i class="fas fa-user-plus"></i><span>Đăng ký</span>
            </a>
        </div>
    </header>


    <main class="p-4">
    <div class=" flex justify-center mt-[-14]">
            <!-- Nút Trái -->
            <button id="prevBtn" 
                class="absolute left-32 top-1/2 -translate-y-1/2 bg-black/50 text-white w-10 h-10 flex items-center justify-center rounded-full hover:bg-black z-[0]">
                ❮
            </button>
            <!-- Ảnh Slideshow -->
            <img id="slideImage" alt="Gold bars" 
                class="w-full max-w-[70vw] lg:max-w-[75vw] h-auto object-cover z-[-10]" 
                src="images/home1.jpg"/>
            <!-- Nút Phải -->
            <button id="nextBtn" 
                class="absolute right-32 top-1/2 -translate-y-1/2 bg-black/50 text-white w-10 h-10 flex items-center justify-center rounded-full hover:bg-black  z-[0]">
                ❯
            </button>
        </div>
        <!-- Radio Button dưới ảnh -->
        <div class="flex justify-center space-x-2 mt-[-40]">
            <input type="radio" name="slide" id="slide1" class="hidden" checked>
            <label for="slide1" class="w-4 h-4 bg-white rounded-full cursor-pointer"></label>

            <input type="radio" name="slide" id="slide2" class="hidden">
            <label for="slide2" class="w-4 h-4 bg-white rounded-full cursor-pointer"></label>

            <input type="radio" name="slide" id="slide3" class="hidden">
            <label for="slide3" class="w-4 h-4 bg-white rounded-full cursor-pointer"></label>
        </div>
        
        <h2 class="text-center text-2xl font-bold mt-10 p-2">
            <?= empty($search_value) ? "SẢN PHẨM BÁN CHẠY TRONG TUẦN" : "KẾT QUẢ TÌM KIẾM" ?>
        </h2>
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4 mt-2">
            <?php 
            // Nếu có từ khóa tìm kiếm thì dùng kết quả từ truy vấn tìm kiếm
            $data = !empty($search_value) ? $result_search : $result;
            while ($row = mysqli_fetch_assoc($data)) { ?>
                <div class="text-center">
                    <div class="group relative">
                        <img alt="<?= $row['TenSP']; ?>" class="mx-auto rounded-lg" height="150" 
                            src="images/<?= $row['MaSP']; ?>.jpg" width="150"/>
                        
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
   
 </body>
</html>
<script>
    const images = ["images/home1.jpg", "images/home2.jpg", "images/home3.jpg"];
    let currentIndex = 0;
    const slideImage = document.getElementById("slideImage");
    const prevBtn = document.getElementById("prevBtn");
    const nextBtn = document.getElementById("nextBtn");
    const radios = document.querySelectorAll("input[name='slide']");
    const labels = document.querySelectorAll("label[for^='slide']");
    
    function updateSlide(index) {
        slideImage.src = images[index];
        radios[index].checked = true;
        labels.forEach(label => label.classList.remove("bg-blue-500"));
        labels[index].classList.add("bg-blue-500");
    }

    function nextSlide() {
        currentIndex = (currentIndex + 1) % images.length;
        updateSlide(currentIndex);
    }
    
    prevBtn.addEventListener("click", () => {
        currentIndex = (currentIndex - 1 + images.length) % images.length;
        updateSlide(currentIndex);
    });
    
    nextBtn.addEventListener("click", nextSlide);
    
    radios.forEach((radio, index) => {
        radio.addEventListener("change", () => {
            currentIndex = index;
            updateSlide(currentIndex);
        });
    });
    
    setInterval(nextSlide, 3000);
</script>
