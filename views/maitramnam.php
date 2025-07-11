<?php
include '../database/connect.php'; 
include '../actions/danhmuc.php'; 
include '../actions/dropdownbosuutap.php'; 
include '../actions/dropdowndongtrangsuc.php';
include '../actions/dropdownloaisanpham.php';
include '../actions/dropdowndathang.php';
// Kiểm tra xem maCTDM có được truyền vào hay không
if (isset($_GET['maCTDM'])) {
    $maCTDM = mysqli_real_escape_string($conn, $_GET['maCTDM']);
    $sql = "SELECT MaSP, TenSP, Gia, SoLuong FROM SANPHAM WHERE MaCTDM = '$maCTDM'";
    $result = $conn->query($sql);
}
// Mảng ánh xạ giữa mã CTDM và tên
$mapping = [
    'CTDM01' => 'Mai trăm năm',
    'CTDM02' => 'Giao thời 2024',
    'CTDM03' => 'Dấu ấn phái mạnh 2024',
    'CTDM04' => 'Giáp Thìn phú quý',
    'CTDM05' => 'Magical stone',
    'CTDM06' => 'Bách phúc trường an',
    'CTDM19' => 'Nhẫn nữ',
    'CTDM20' => 'Nhẫn nam',
    'CTDM21'=> 'Nhẫn cưới',
];
// Khởi tạo các biến
$ten = "";
$mota = "";
// Kiểm tra nếu mã CTDM tồn tại trong mảng
if (isset($mapping[$maCTDM])) {
    $ten = isset($_SESSION["Ten" . str_replace(' ', '', $mapping[$maCTDM])]) ? $_SESSION["Ten" . str_replace(' ', '', $mapping[$maCTDM])] : '';
    $mota = isset($_SESSION["MoTa" . str_replace(' ', '', $mapping[$maCTDM])]) ? $_SESSION["MoTa" . str_replace(' ', '', $mapping[$maCTDM])] : '';
}
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
  <script src="../handle/dropdownchat.js"></script>
  <script src="../handle/dropdowndathang.js"></script>
  <link rel="stylesheet" href="../css/maitramnamm.css">
  <link rel="stylesheet" href="../css/boxchat.css">
</head>
<body class="bg-white text-black">
   
    <header class="flex items-center justify-between p-4 bg-gray-100">
        <!-- Logo và Danh mục sản phẩm -->
        <div class="flex items-center space-x-4 relative mt-[-10]">
            <a href="../views/home.php">
                <img alt="Logo" class="h-16 w-16 rounded-full" src="../images/logo.jpg"/>
            </a>
            <div class="relative "><?php echo getDanhMuc($conn); ?></div>
        </div>
        <!-- Ô tìm kiếm + Thông tin user -->
        <div class="flex items-center space-x-4 ml-auto">
            <div class="relative">
                <form method="GET" action="timkiem.php" class="w-full">
                    <input name="search" class="border rounded-full p-2 w-96 pl-10 mt-2" placeholder="Tìm Sản Phẩm: Ví dụ: kiềng, dây chuyền..." type="text" />
                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 mt-[-4px]"></i>
                </form>
            </div>
            <?php if (isset($_SESSION['user_name']) && isset($_SESSION['user_id'])): ?>
                <a id="userDropdown" class="flex items-center space-x-1 cursor-pointer mt-[-10px]" href="#">
                    <i class="fas fa-user"></i>
                    <span><?= $_SESSION['user_name']; ?></span>
                    <!-- <small>ID<?= $_SESSION['user_id']; ?></small> Hiển thị ID -->
                </a>
                <?php include '../actions/dropdownprofile.php'; ?>
                <a class="flex items-center space-x-1 text-red-500 mt-[-10px]" href="../actions/logout.php"><i class="fas fa-sign-out-alt"></i><span>Đăng Xuất</span></a>
            <?php else: ?>
                <a class="flex items-center space-x-1" href="login.php"><i class="fas fa-user"></i><span>Đăng Nhập</span></a>
            <?php endif; ?>
        </div>
    </header>
    <main>
        <div class="container mx-auto p-4">
            <div class="text-center px-4">
                <h2 class="text-red-800 text-lg font-semibold mb-2"><?= $_SESSION['TenBoSuuTap']; ?></h2>
                <h1 class="text-red-800 text-5xl font-bold mb-4"> <?= htmlspecialchars($ten) ?> </h1>
                <p class="text-gray-700 text-base max-w-2xl mx-auto"> <?= htmlspecialchars($mota) ?> </p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-5 p-4">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="bg-white p-4 rounded shadow group overflow-hidden">
                        <div class="group relative overflow-hidden rounded-lg  shadow">
                            <a href="../details/detailsmaitramnam.php?MaSP=<?= urlencode($row['MaSP']) ?>" class="relative block">
                                <img alt="<?= htmlspecialchars($row['TenSP']) ?>" 
                                    class="w-full h-auto cursor-pointer transition-transform duration-300 ease-in-out group-hover:-translate-y-10" 
                                    height="300" 
                                    src="../images/<?= htmlspecialchars($row['MaSP']) ?>.jpg" 
                                    width="300"/>
                                <!-- Lớp hiệu ứng ánh sáng -->
                                <div class="overlay-effect pointer-events-none absolute inset-0 z-10"></div>
                            </a>
                            <!-- Hiệu ứng hover từ đáy ảnh lên -->
                            <div class="absolute bottom-0 left-0 w-full opacity-0 translate-y-full transition-all duration-300 ease-in-out group-hover:translate-y-0 group-hover:opacity-100 ">
                                <div class="flex justify-around py-4 bg-white shadow-lg rounded">
                                    <button class="menuorder text-gray-700 hover:text-gray" 
                                        data-masp="<?= htmlspecialchars($row['MaSP']) ?>" 
                                        data-tensp="<?= htmlspecialchars($row['TenSP']) ?>" 
                                        data-soluongsp="<?= $row['SoLuong'] ?>"
                                        data-gia="<?= $row['Gia'] ?>"
                                        data-mand="<?= $_SESSION['user_id']; ?>">
                                        <i class="fas fa-shopping-cart hover:text-red-500 " title="Thêm vào giỏ hàng"></i>
                                    </button>
                                    <button class="btn-favorite text-gray-700 hover:text-black" data-masp="<?= htmlspecialchars($row['MaSP']) ?>">
                                        <i class="fas fa-heart hover:text-red-500" title="Thêm vào yêu thích"></i>
                                    </button>

                                    <button class="text-gray-700 hover:text-black" onclick="window.location.href='../donhang/order.php';"><i class="fas fa-shopping-bag hover:text-red-500" title="Xem giỏ hàng"></i></button>
                                </div>
                            </div>
                        </div>
                        <a href="../details/detailsmaitramnam.php?MaSP=<?= urlencode($row['MaSP']) ?>">
                            <h2 class="text-lg font-semibold text-center cursor-pointer"><?= htmlspecialchars($row['TenSP']) ?></h2>
                        </a>
                        <p class="text-black font-bold text-center" style="color:red;">
                            <?= number_format($row['Gia'], 0, ',', '.') ?> VNĐ
                        </p>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
        <div class="fixed bottom-4 right-4">
            <button id="menuchat" class="bg-red-600 text-white p-4 rounded-full shadow-lg"><i class="fas fa-comments"></i></button> 
        </div>
        <?php include '../actions/dropdownchat.php'; ?>
    </main>
    <!-- Overlay mờ đen -->
    <div id="overlay" class="fixed top-0 left-0 w-full h-full bg-black opacity-50 hidden z-40"></div>
   <!-- Thông báo đã thêm vào yêu thích -->
    <div id="favorite-alert" class="fixed bg-white text-black border border-red-600 shadow-lg px-6 py-4 rounded-xl hidden z-50 text-center font-semibold text-lg">
        <i class="fas fa-heart text-red-600 text-3xl"></i> Đã thêm sản phẩm vào yêu thích!
    </div>
    <!-- Hiển thị số lượng sản phẩm yêu thích -->

   

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
document.querySelectorAll('.btn-favorite').forEach(button => {
    button.addEventListener('click', () => {
        const alertBox = document.getElementById('favorite-alert');
        const overlay = document.getElementById('overlay');
        const heartIcon = button.querySelector('i');
        const productId = button.getAttribute('data-masp'); // Lấy mã sản phẩm
        // Kiểm tra trạng thái yêu thích của sản phẩm
        let favorites = JSON.parse(localStorage.getItem('favorites')) || [];
        // Nếu sản phẩm đã có trong danh sách yêu thích (tim đỏ), hủy yêu thích
        if (favorites.includes(productId)) {
            // Hiển thị thông báo hủy yêu thích
            alertBox.innerHTML = ' Đã hủy yêu thích sản phẩm! <i class="fas fa-times-circle text-yellow-600 text-3xl"></i>';
            heartIcon.classList.remove('text-red-600'); // Đổi tim thành màu đen
            // Xóa sản phẩm khỏi danh sách yêu thích
            favorites = favorites.filter(id => id !== productId);
        } else {
            // Nếu chưa yêu thích, thêm vào danh sách
            alertBox.innerHTML = '<i class="fas fa-heart text-red-600 text-3xl"></i> Đã thêm sản phẩm vào yêu thích! <i class="fas fa-check-circle text-green-600 text-3xl"></i>';
            heartIcon.classList.add('text-red-600'); // Đổi tim thành màu đỏ
            // Thêm sản phẩm vào danh sách yêu thích
            favorites.push(productId);
             // Sau 1s đổi thành mũi tên
            setTimeout(() => {
                alertBox.innerHTML = '<i class="fas fa-long-arrow-alt-up text-red-600 text-3xl"></i>';
                alertBox.classList.add('animate');
            }, 1000);
        }
        // Lưu lại danh sách yêu thích vào localStorage
        localStorage.setItem('favorites', JSON.stringify(favorites));
        // Hiển thị overlay và alert box
        overlay.classList.remove('hidden');
        alertBox.classList.remove('hidden', 'animate');
        alertBox.style.top = '50%';
        alertBox.style.left = '50%';
        alertBox.style.transform = 'translate(-50%, -50%)';
        // Sau 3s ẩn thông báo và overlay
        setTimeout(() => {
            alertBox.classList.add('hidden');
            overlay.classList.add('hidden');
            alertBox.classList.remove('animate');
        }, 2500);
        updateFavoriteCount();
    });
});
// Khi trang được tải, kiểm tra trạng thái yêu thích của sản phẩm và cập nhật lại icon tim
document.querySelectorAll('.btn-favorite').forEach(button => {
    const heartIcon = button.querySelector('i');
    const productId = button.getAttribute('data-masp');
    let favorites = JSON.parse(localStorage.getItem('favorites')) || [];
    if (favorites.includes(productId)) {
        heartIcon.classList.add('text-red-600'); // Nếu sản phẩm trong danh sách yêu thích, làm cho tim màu đỏ
    }
});
// Hàm cập nhật số lượng sản phẩm yêu thích
function updateFavoriteCount() {
    let favorites = JSON.parse(localStorage.getItem('favorites')) || [];
    const favoriteCount = favorites.length; // Đếm số lượng sản phẩm yêu thích

    // Hiển thị số lượng yêu thích
    document.getElementById('favorite-count').textContent = favoriteCount;
}
// Gọi hàm để cập nhật số lượng yêu thích khi trang được tải
window.onload = function() {
    updateFavoriteCount();
};
</script>