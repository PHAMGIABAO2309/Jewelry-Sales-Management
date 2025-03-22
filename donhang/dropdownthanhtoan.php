<!-- Thư viện SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div id="dropdownthanhtoan" class="hidden fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 flex justify-center items-center z-50">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md">
         <!-- Header -->
         <div class="bg-blue-800 text-white text-center py-4 rounded-t-lg">
            <h1 class="text-2xl font-bold">CHỌN PHƯƠNG THỨC THANH TOÁN</h1>
        </div>

        <div class="p-4">
        <div class="flex justify-center gap-4 mb-4">
            <button id="codButton" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg shadow-md hover:bg-gray-400 transition duration-300">
                Thanh Toán Khi Nhận Hàng
            </button>
            <button id="onlineButton" class="bg-blue-600 text-white px-6 py-2 rounded-lg shadow-md hover:bg-blue-700 transition duration-300">
                Thanh Toán Online
            </button>
        </div>
        
        <!-- Nội dung -->
        <div class="p-6">
            <p class="text-center mb-4 text-lg">
                Bạn hãy thanh toán số tiền <span class="text-red-600 font-bold"><?php echo number_format($tongThanhToan, 0, ',', '.'); ?> VNĐ</span>
            </p>
            <p class="text-center mb-4 text-lg">
                Qua STK sau: <span class="font-semibold">1031533825</span><br>
                Ngân hàng: <span class="font-semibold">Vietcombank</span>
            </p>
            <p class="text-center mb-4 text-lg">
                Hãy nhập đúng nội dung để thanh toán:
            </p>

            <!-- Nội dung thanh toán -->
            <div class="flex justify-center items-center mb-4">
    <div class="bg-gray-200 px-4 py-2 rounded-lg shadow-inner">
        <span id="captchaText" class="text-gray-700 text-lg font-mono">ejcQOD</span>
    </div>
    <button id="refreshCaptcha" class="ml-3 text-blue-600 hover:text-blue-800 transition">
        <i class="fas fa-sync-alt text-2xl"></i>
    </button>
</div>
            <!-- Nhập nội dung -->
            <div class="flex justify-center mb-4">
                <input id="captchaInput" type="text" class="border border-gray-300 rounded-lg p-3 w-full max-w-xs shadow-inner" placeholder="Nhập nội dung">
            </div>
            <!-- Nút Xác nhận -->
            <div class="flex justify-center mb-4">
                <button id="submitCaptcha" class="bg-blue-600 text-white px-6 py-2 rounded-lg shadow-md hover:bg-blue-700 transition duration-300">
                    Xác nhận
                </button>
            </div>
            <!-- Thông báo -->
            <p id="captchaMessage" class="text-center text-lg font-semibold mt-2"></p>

            <!-- Nút Thoát -->
            <div class="flex justify-center">
                <button id="closeorder" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg shadow-md hover:bg-gray-400 transition duration-300">
                    Thoát
                </button>
            </div>
        </div>
        </div>
    </div>
</div>
<script>
    // Hàm tạo chuỗi captcha ngẫu nhiên
    function generateCaptcha() {
        const chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        let captcha = "";
        for (let i = 0; i < 6; i++) {
            captcha += chars.charAt(Math.floor(Math.random() * chars.length));
        }
        return captcha;
    }

    // Cập nhật captcha ban đầu
    document.getElementById("captchaText").textContent = generateCaptcha();

    // Sự kiện làm mới Captcha
    document.getElementById("refreshCaptcha").addEventListener("click", function() {
        document.getElementById("captchaText").textContent = generateCaptcha();
    });

    // Sự kiện khi nhấn nút xác nhận captcha
    document.getElementById("submitCaptcha").addEventListener("click", function() {
        let captchaText = document.getElementById("captchaText").textContent;
        let userInput = document.getElementById("captchaInput").value.trim();

        if (userInput === captchaText) {
            // Hiển thị thông báo thành công và đổi nội dung thanh toán
            Swal.fire({
                title: "✅ Captcha Chính Xác!",
                text: "Bạn đã nhập đúng captcha. Chúc mừng! 🎉",
                icon: "success",
                confirmButtonText: "OK",
                confirmButtonColor: "#3085d6",
                timer: 2500
            }).then(() => {
                // Hiện lại dropdown
                document.getElementById("dropdownthanhtoan").classList.remove("hidden");

                // Đổi nội dung từ "Thanh toán khi nhận hàng" thành "Thanh toán online"
                let paymentText = document.querySelector("span.phuongthucthanhtoan");
                if (paymentText && paymentText.textContent.trim() === "Thanh toán khi nhận hàng") {
                    paymentText.textContent = "Thanh toán online";
                }
            });
        } else {
            // Hiển thị thông báo lỗi và hiện lại dropdown
            Swal.fire({
                title: "❌ Sai Captcha!",
                text: "Captcha bạn nhập không đúng. Vui lòng thử lại!",
                icon: "error",
                confirmButtonText: "Thử lại",
                confirmButtonColor: "#d33"
            }).then(() => {
                document.getElementById("dropdownthanhtoan").classList.remove("hidden");
            });
        }
    });

    // Sự kiện khi nhấn nút Thoát
    document.getElementById("closeorder").addEventListener("click", function() {
        document.getElementById("dropdownthanhtoan").classList.add("hidden");
    });

    // Khi nhấn COD thì ẩn dropdown và đổi nội dung sang "Thanh toán tiền mặt"
    document.getElementById("codButton").addEventListener("click", function() {
        document.getElementById("dropdownthanhtoan").classList.add("hidden");

        let paymentText = document.querySelector("span.phuongthucthanhtoan");
        if (paymentText) {
            paymentText.textContent = "Thanh toán tiền mặt";
        }
    });

    // Khi nhấn Thanh Toán Online thì ẩn dropdown
    document.getElementById("onlineButton").addEventListener("click", function() {
        document.getElementById("dropdownthanhtoan").classList.add("hidden");
    });
</script>



