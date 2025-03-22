document.addEventListener("DOMContentLoaded", function () {
    const thanhtoanBtn = document.getElementById("thanhtoan"); // Button "Thay Đổi"
    const dropdown = document.getElementById("dropdownthanhtoan"); // Popup giỏ hàng
    const closeDropdown = document.getElementById("closeDropdown"); // Nút đóng (X)
    const closeOrder = document.getElementById("closeorder"); // Nút đóng đặt hàng

    if (!thanhtoanBtn || !dropdown || !closeDropdown || !closeOrder) {
        console.error("Không tìm thấy phần tử cần thiết!");
        return;
    }

    // Toggle hiển thị popup khi nhấn vào "Thay Đổi"
    thanhtoanBtn.addEventListener("click", function (event) {
        event.stopPropagation(); // Ngăn chặn sự kiện lan ra ngoài
        dropdown.classList.toggle("hidden"); // Toggle trạng thái popup
    });

    // Đóng popup khi nhấn dấu ❌
    closeDropdown.addEventListener("click", function (event) {
        event.stopPropagation();
        dropdown.classList.add("hidden");
    });

    // Đóng popup khi nhấn nút closeorder
    closeOrder.addEventListener("click", function (event) {
        event.stopPropagation();
        dropdown.classList.add("hidden");
    });

    // Ẩn popup khi click ra ngoài
    document.addEventListener("click", function (event) {
        if (!dropdown.classList.contains("hidden") && !dropdown.contains(event.target)) {
            dropdown.classList.add("hidden");
        }
    });
});
