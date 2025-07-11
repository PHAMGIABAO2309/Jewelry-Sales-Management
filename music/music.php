<!-- music.php -->


<?php
include '../database/connect.php'; 
include '../actions/danhmuc.php'; 
include '../actions/dropdownbosuutap.php'; 
include '../actions/dropdowndongtrangsuc.php';
include '../actions/dropdownloaisanpham.php';
include '../actions/dropdowndathang.php';
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
    <iframe src="../music/music.php" name="musicPlayer" width="0" height="0" style="display:none;"></iframe>
    
    <header class="flex items-center justify-between p-4 bg-gray-100 w-[1470px] h-[80px]">
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
                <form method="GET" action="../views/timkiem.php" class="w-full">
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
        <section>
            <h2 class="text-xl font-bold mb-4">All Playlists</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <div class="bg-white p-4 rounded-lg shadow-md flex items-center justify-between">
                    <div class="flex items-center">
                        <img alt="Album cover of the playlist" class="w-24 h-24 rounded-lg mr-4" height="100" src="../images/cokhonggiumatdungtim.jpg" width="100"/>
                        <div>
                            <h3 class="text-lg font-bold">Có Không Giữ Mất Đừng Tìm</h3>
                            <p class="text-gray-600">Trúc Nhân - Bùi Công Nam.</p>
                        </div>
                    </div>
                    <!-- Nút play có data-src để lưu đường dẫn bài nhạc -->
                    <button class="text-blue-600 hover:text-blue-800 play-button " data-src="../music/cokhonggiumatdungtim.mp3">
                        <i class="fas fa-play-circle fa-2x"></i>
                    </button>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-md flex items-center justify-between">
                    <div class="flex items-center">
                        <img alt="Album cover of the playlist" class="w-24 h-24 rounded-lg mr-4" height="100" src="../images/hetroi.jpg" width="100"/>
                        <div>
                            <h3 class="text-lg font-bold">Hết Rồi</h3>
                            <p class="text-gray-600">Hồ Quang Hiếu.</p>
                        </div>
                    </div>
                    <!-- Nút play có data-src để lưu đường dẫn bài nhạc -->
                    <button class="text-blue-600 hover:text-blue-800 play-button " data-src="../music/hetroi.mp3">
                        <i class="fas fa-play-circle fa-2x"></i>
                    </button>
                </div>
            </div>
        </section>
        <?php
$nowPlaying = isset($_SESSION['now_playing']) ? $_SESSION['now_playing'] : null;
?>
<script>
  let currentAudio = null;
  let currentButton = null;
  let updateInterval;
  <?php if ($nowPlaying): ?>
    // Lấy dữ liệu từ session PHP
    const savedSong = "<?php echo $nowPlaying['song']; ?>";
    const savedTime = <?php echo floatval($nowPlaying['time']); ?>;

    window.addEventListener('DOMContentLoaded', () => {
      currentAudio = new Audio(savedSong);
      currentAudio.currentTime = savedTime;
      currentAudio.play();

      // Cập nhật session liên tục
      updateInterval = setInterval(() => {
        fetch('../music/save_current_song.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ song: savedSong, time: currentAudio.currentTime })
        });
      }, 1000);

      // Nếu cần đổi icon thì có thể tìm nút tương ứng với bài đang phát:
      document.querySelectorAll('.play-button').forEach(btn => {
        if (btn.getAttribute('data-src') === savedSong) {
          currentButton = btn;
          btn.querySelector('i').classList.remove('fa-play-circle');
          btn.querySelector('i').classList.add('fa-pause-circle');
        }
      });

      currentAudio.addEventListener('ended', () => {
        clearInterval(updateInterval);
        if (currentButton) {
          currentButton.querySelector('i').classList.remove('fa-pause-circle');
          currentButton.querySelector('i').classList.add('fa-play-circle');
        }
        currentAudio = null;
        currentButton = null;
      });
    });
  <?php endif; ?>
  document.querySelectorAll('.play-button').forEach(button => {
  button.addEventListener('click', () => {
    const audioSrc = button.getAttribute('data-src');

    if (currentAudio && currentAudio.src !== new URL(audioSrc, window.location.href).href) {
      currentAudio.pause();
      clearInterval(updateInterval);
      currentButton.querySelector('i').classList.remove('fa-pause-circle');
      currentButton.querySelector('i').classList.add('fa-play-circle');
      currentAudio = null;
      currentButton = null;
    }

    if (!currentAudio) {
      currentAudio = new Audio(audioSrc);
      currentAudio.play();
      currentButton = button;

      // Gửi ban đầu
      fetch('../music/save_current_song.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ song: audioSrc, time: 0 })
      });

      // Cập nhật liên tục thời gian đang phát mỗi 3 giây
      updateInterval = setInterval(() => {
        fetch('../music/save_current_song.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ song: audioSrc, time: currentAudio.currentTime })
        });
      }, 1000);

      // Đổi icon
      button.querySelector('i').classList.remove('fa-play-circle');
      button.querySelector('i').classList.add('fa-pause-circle');

      currentAudio.addEventListener('ended', () => {
        clearInterval(updateInterval);
        button.querySelector('i').classList.remove('fa-pause-circle');
        button.querySelector('i').classList.add('fa-play-circle');
        currentAudio = null;
        currentButton = null;
        
      });
    } else {
      currentAudio.pause();
      clearInterval(updateInterval);
      button.querySelector('i').classList.remove('fa-pause-circle');
      button.querySelector('i').classList.add('fa-play-circle');
      currentAudio = null;
      currentButton = null;
    }
  });
});
</script>
    </main>
</body>
</html>

