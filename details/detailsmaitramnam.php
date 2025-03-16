<?php
include '../database/connect.php'; 
include '../actions/danhmuc.php'; 
include '../actions/dropdownbosuutap.php'; 
include '../actions/dropdowndongtrangsuc.php';
include '../actions/dropdownloaisanpham.php';
include '../actions/dauanphaimanh.php';
include '../actions/mota.php';

if (isset($_GET['MaSP'])) {
    $MaSP = $_GET['MaSP'];

    // Truy vấn dữ liệu từ database
    $query = "SELECT TenSP, Gia, MaSP, SoLuong FROM sanpham WHERE MaSP = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $MaSP);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $TenSP = htmlspecialchars($row['TenSP']);
        $Gia = number_format($row['Gia'], 0, ',', '.') . " VNĐ";
        $SoLuong = htmlspecialchars( $row['SoLuong']);
        $LinkAnh = "../images/" . htmlspecialchars($row['MaSP']) . ".jpg";

         // Kiểm tra sự tồn tại của ảnh nhỏ
         $thumbnail1 = "../images/" . $row['MaSP'] . "(1).jpg";
         $thumbnail2 = "../images/" . $row['MaSP'] . "(2).jpg";
         $hasThumbnails = file_exists($thumbnail1) && file_exists($thumbnail2);

          // Mảng chứa đường dẫn ảnh
        $imageArray = [$LinkAnh];
        if (file_exists($thumbnail1)) $imageArray[] = $thumbnail1;
        if (file_exists($thumbnail2)) $imageArray[] = $thumbnail2;

        // Biến kiểm tra có ảnh phụ hay không
        $hasThumbnails = count($imageArray) > 1;
    } else {
        echo "Sản phẩm không tồn tại!";
        exit;
    }
} else {
    echo "Không có sản phẩm nào được chọn!";
    exit;
}
?>

<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>Gia Bảo Jewelry</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link rel="icon" type="image/png" href="https://storage.googleapis.com/a1aa/image/idUd40l_cpmB-xqRpUgornlkLqPLLy0mvYxRHI7Vcd8.jpg">
  <link rel="stylesheet" href="../assets/navbar.css">
  <script src="../handle/dropdownprofile.js"></script>
  <script src="../handle/dropdownbosuutap.js"></script>
  <script src="../handle/dropdowndongtrangsuc.js"></script>
  <script src="../handle/dropdownloaisanpham.js"></script>
</head>
 <body class="bg-white text-black">
    <header class="flex items-center justify-between p-4 bg-gray-100">
        <!-- Logo và Danh mục sản phẩm -->
        <div class="flex items-center space-x-4 relative">
            <a href="../views/home.php">
            <img alt="Logo" class="h-8 " height="30" src="https://storage.googleapis.com/a1aa/image/RR8CRsz-B4mwtszDDQi_5Jz4xLoLiQOI1N6dCsXCOP0.jpg" width="30"/>
            </a>
            <div class="relative"><?php echo getDanhMuc($conn); ?></div>
        </div>
        <!-- Ô tìm kiếm + Thông tin user -->
        <div class="flex items-center space-x-4 ml-auto">
            <div class="relative">
                <input class="border rounded-full p-2 w-96 pl-10" placeholder="Tìm Sản Phẩm: Ví dụ: kiềng, dây chuyền..." type="text" />
                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
            </div>

            <?php if (isset($_SESSION['user_name'])): ?>
                <a id="userDropdown" class="flex items-center space-x-1 cursor-pointer" href="#">
                    <i class="fas fa-user"></i>
                    <span><?= $_SESSION['user_name']; ?></span>
                </a>
                <?php include '../actions/dropdownprofile.php'; ?>
                <a class="flex items-center space-x-1 text-red-500" href="../actions/logout.php"><i class="fas fa-sign-out-alt"></i><span>Đăng Xuất</span></a>
            <?php else: ?>
                <a class="flex items-center space-x-1" href="login.php"><i class="fas fa-user"></i><span>Đăng Nhập</span></a>
            <?php endif; ?>
            
        </div>
    </header>
    <main>
        <div class="container mx-auto p-4">
            <div class="flex flex-col lg:flex-row items-center justify-center">
                <div class="flex flex-col items-center justify-center w-full lg:w-1/2">
                    <div class="flex items-center justify-center">
                        <?php if ($hasThumbnails): ?>
                            <button id="prevBtn" class="text-gray-500 hover:text-gray-700">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                        <?php endif; ?>
                        <img id="mainImage" alt="<?= $TenSP ?>" class="mx-4 border" height="400" src="<?= $LinkAnh ?>" width="400"/>
                        <?php if ($hasThumbnails): ?>
                            <button id="nextBtn" class="text-gray-500 hover:text-gray-700">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        <?php endif; ?>
                    </div>

                    <?php if ($hasThumbnails): ?>
                        <div class="flex justify-center mt-4">
                            <?php foreach ($imageArray as $index => $img): ?>
                                <img alt="Thumbnail <?= $index ?>" class="border p-1 mx-1 thumbnail" height="50" src="<?= $img ?>" width="50"/>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <script>
                    let imageArray = <?= json_encode($imageArray) ?>;
                    let currentIndex = 0; // Ảnh chính hiện tại
                    const mainImage = document.getElementById("mainImage");
                    const prevBtn = document.getElementById("prevBtn");
                    const nextBtn = document.getElementById("nextBtn");
                    const thumbnails = document.querySelectorAll(".thumbnail");

                    // Hàm cập nhật ảnh chính
                    function updateMainImage() {
                        mainImage.src = imageArray[currentIndex];
                        updateThumbnailBorder();
                    }

                    // Hàm cập nhật viền của ảnh nhỏ
                    function updateThumbnailBorder() {
                        thumbnails.forEach((thumb, index) => {
                            if (index === currentIndex) {
                                thumb.classList.add("border-2", "border-blue-500");
                            } else {
                                thumb.classList.remove("border-2", "border-blue-500");
                            }
                        });
                    }

                    // Xử lý click vào ảnh nhỏ
                    thumbnails.forEach((thumb, index) => {
                        thumb.addEventListener("click", () => {
                            currentIndex = index;
                            updateMainImage();
                        });
                    });

                    // Xử lý click Next
                    nextBtn.addEventListener("click", () => {
                        currentIndex = (currentIndex + 1) % imageArray.length;
                        updateMainImage();
                    });

                    // Xử lý click Prev
                    prevBtn.addEventListener("click", () => {
                        currentIndex = (currentIndex - 1 + imageArray.length) % imageArray.length;
                        updateMainImage();
                    });

                    // Đặt viền cho ảnh đầu tiên khi load trang
                    updateThumbnailBorder();
                </script>

                <div class="w-full lg:w-1/2 mt-8 lg:mt-0 lg:ml-8">
                    <h1 class="text-2xl font-bold text-gray-900"><?= $TenSP ?></h1>
                    <p class="text-gray-500 mt-2">Giá tham khảo</p>
                    <p class="text-3xl font-bold text-red-600"><?= $Gia ?></p>
                    <div class="flex">
                        <p class="text-gray-500 mt-2">Số lượng:</p>
                        <strong><p class="text-dark-500 fw-bold  mt-2 ml-2"><?= $SoLuong ?></p></strong>
                    </div>
                    <p class="text-gray-500 mt-2">Giá tham khảo sẽ thay đổi theo giá vàng, trọng lượng vàng và giá trị viên đá thực tế.</p>
                    <div class="flex mt-4">
                        <button class="bg-red-600 text-white px-4 py-2 rounded mr-2">GỬI TIN NHẮN</button>
                        <button class="bg-white text-red-600 border border-red-600 px-4 py-2 rounded">Đặt hàng</button>
                    </div>
                    <div class="mt-6">
                        <h3 class="text-gray-700 font-semibold">CHI TIẾT</h3>
                        <div class="mt-2">
                            <p class="text-gray-500"><span class="font-semibold text-gray-700">Loại vàng:</span>Vàng 18K (750)</p>
                            <p class="text-gray-500"><span class="font-semibold text-gray-700">Trọng lượng vàng:</span>0.50 - 0.55</p>
                            <p class="text-gray-500"><span class="font-semibold text-gray-700">Đá phụ:</span>Swarovski</p>
                            <p class="text-gray-500"><span class="font-semibold text-gray-700">Màu đá phụ:</span>Trắng</p>
                            <p class="text-gray-500"><span class="font-semibold text-gray-700">Hình dạng đá phụ:</span>Hình tròn</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center text-gray-500 mt-8">
                <p>Trang Chủ · Dòng Trang Sức · Vàng · DVNUTVV0001Q786</p>
            </div>
            <div class="fixed bottom-4 right-4">
                <button class="bg-red-600 text-white p-4 rounded-full shadow-lg"><i class="fas fa-comments"></i></button>
            </div>
        </div>
    </main>
</body>
</html>    