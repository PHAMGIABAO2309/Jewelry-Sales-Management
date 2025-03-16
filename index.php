<?php
include 'database/connect.php'; 
include 'actions/danhmuc.php';  
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
</head>
 <body class="bg-white text-black">
    <header class="flex items-center justify-between p-4 bg-gray-100">
        <div class="flex items-center space-x-4">
            <img alt="Logo" class="h-8" height="30" src="https://storage.googleapis.com/a1aa/image/RR8CRsz-B4mwtszDDQi_5Jz4xLoLiQOI1N6dCsXCOP0.jpg" width="30"/>
            
            <?php echo getDanhMuc($conn); ?>

        </div>

        <div class="flex items-center space-x-4">
            <div class="relative">
                <input class="border rounded-full p-2 w-96 pl-10" placeholder="Tìm Sản Phẩm: Ví dụ: kiềng, dây chuyền..." type="text" />
                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
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
        <div class="flex justify-center mb-8">
            <style>
                .custom-img {
                    width: 120px;  /* Chiều rộng tùy chỉnh */
                    height: auto;  /* Giữ nguyên tỉ lệ khung hình */
                }
            </style>
            <img alt="Gold bars" class="custom-img" src="https://storage.googleapis.com/a1aa/image/idUd40l_cpmB-xqRpUgornlkLqPLLy0mvYxRHI7Vcd8.jpg"/>
        </div>
        <h2 class="text-center text-2xl font-bold mb-8">SẢN PHẨM BÁN CHẠY TRONG TUẦN</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
            <div class="text-center">
                <img alt="Lắc tay Vàng 18K" class="mx-auto" height="150" src="https://storage.googleapis.com/a1aa/image/Hb04gwsP2FUcTAVhENkQAfldNmNJe-B7pHuX_4eQRaI.jpg" width="150"/>
                <p class="mt-2">Lắc tay Vàng 18K</p>
                <p class="text-red-500 font-bold">Giá: 31.040.000 đ</p>
            </div>
            <div class="text-center">
                <img alt="Nhẫn nam Vàng trắng" class="mx-auto" height="150" src="https://storage.googleapis.com/a1aa/image/Giq6oADJCDpbxSK0zu_Mv-MP8qMYc8XHbZRUALdSxPk.jpg" width="150"/>
                <p class="mt-2">Nhẫn nam Vàng trắng</p>
                <p class="text-red-500 font-bold">Giá: 20.699.000 đ</p>
            </div>
            <div class="text-center">
                <img alt="Nhẫn nam Vàng trắng" class="mx-auto" height="150" src="https://storage.googleapis.com/a1aa/image/Giq6oADJCDpbxSK0zu_Mv-MP8qMYc8XHbZRUALdSxPk.jpg" width="150"/>
                <p class="mt-2">Nhẫn nam Vàng trắng</p>
                <p class="text-red-500 font-bold">Giá: 31.040.000 đ</p>
            </div>
            <div class="text-center">
                <img alt="Nhẫn nam Vàng trắng" class="mx-auto" height="150" src="https://storage.googleapis.com/a1aa/image/Giq6oADJCDpbxSK0zu_Mv-MP8qMYc8XHbZRUALdSxPk.jpg" width="150"/>
                <p class="mt-2">Nhẫn nam Vàng trắng</p>
                <p class="text-red-500 font-bold">Giá: 25.319.000 đ</p>
            </div>
            <div class="text-center">
                <img alt="Nhẫn nam Vàng 18K" class="mx-auto" height="150" src="https://storage.googleapis.com/a1aa/image/u4jl50B4OMAqK8SVGWCAIXkO5_C5pRKaqP9BKbCPZeo.jpg" width="150"/>
                <p class="mt-2">Nhẫn nam Vàng 18K</p>
                <p class="text-red-500 font-bold">Giá: 21.055.000 đ</p>
            </div>
            <div class="text-center">
                <img alt="Nhẫn nam Vàng 18K" class="mx-auto" height="150" src="https://storage.googleapis.com/a1aa/image/u4jl50B4OMAqK8SVGWCAIXkO5_C5pRKaqP9BKbCPZeo.jpg" width="150"/>
                <p class="mt-2">Nhẫn nam Vàng 18K</p>
                <p class="text-red-500 font-bold">Giá: 22.999.000 đ</p>
            </div>
            <div class="text-center">
                <img alt="Nhẫn nam Vàng 18K" class="mx-auto" height="150" src="https://storage.googleapis.com/a1aa/image/u4jl50B4OMAqK8SVGWCAIXkO5_C5pRKaqP9BKbCPZeo.jpg" width="150"/>
                <p class="mt-2">Nhẫn nam Vàng 18K</p>
                <p class="text-red-500 font-bold">Giá: 22.999.000 đ</p>
            </div>
            <div class="text-center">
                <img alt="Nhẫn nam Vàng 18K" class="mx-auto" height="150" src="https://storage.googleapis.com/a1aa/image/u4jl50B4OMAqK8SVGWCAIXkO5_C5pRKaqP9BKbCPZeo.jpg" width="150"/>
                <p class="mt-2">Nhẫn nam Vàng 18K</p>
                <p class="text-red-500 font-bold">Giá: 22.999.000 đ</p>
            </div>
            <div class="text-center">
                <img alt="Nhẫn nam Vàng 18K" class="mx-auto" height="150" src="https://storage.googleapis.com/a1aa/image/u4jl50B4OMAqK8SVGWCAIXkO5_C5pRKaqP9BKbCPZeo.jpg" width="150"/>
                <p class="mt-2">Nhẫn nam Vàng 18K</p>
                <p class="text-red-500 font-bold">Giá: 22.999.000 đ</p>
            </div>
            <div class="text-center">
                <img alt="Nhẫn nam Vàng 18K" class="mx-auto" height="150" src="https://storage.googleapis.com/a1aa/image/u4jl50B4OMAqK8SVGWCAIXkO5_C5pRKaqP9BKbCPZeo.jpg" width="150"/>
                <p class="mt-2">Nhẫn nam Vàng 18K</p>
                <p class="text-red-500 font-bold">Giá: 22.999.000 đ</p>
            </div>
            <div class="text-center">
                <img alt="Nhẫn nam Vàng 18K" class="mx-auto" height="150" src="https://storage.googleapis.com/a1aa/image/u4jl50B4OMAqK8SVGWCAIXkO5_C5pRKaqP9BKbCPZeo.jpg" width="150"/>
                <p class="mt-2">Nhẫn nam Vàng 18K</p>
                <p class="text-red-500 font-bold">Giá: 22.999.000 đ</p>
            </div>
            <div class="text-center">
                <img alt="Nhẫn nam Vàng 18K" class="mx-auto" height="150" src="https://storage.googleapis.com/a1aa/image/u4jl50B4OMAqK8SVGWCAIXkO5_C5pRKaqP9BKbCPZeo.jpg" width="150"/>
                <p class="mt-2">Nhẫn nam Vàng 18K</p>
                <p class="text-red-500 font-bold">Giá: 22.999.000 đ</p>
            </div>
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
