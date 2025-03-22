document.addEventListener("DOMContentLoaded", function () {
    const menuBoSuuTap =  document.querySelectorAll(".menuorder");; // Nút "Đặt hàng"
    const dropdown = document.getElementById("dropdowndathang"); // Popup giỏ hàng
    const closeDropdown = document.getElementById("closeDropdown"); // Nút đóng (X)
    const closeorder = document.getElementById("closeorder"); // Nút đóng đặt hàng

    if (!menuBoSuuTap || !dropdown || !closeDropdown || !closeorder) {
        console.error("Không tìm thấy phần tử cần thiết!");
        return;
    }

    // Hiển thị popup khi nhấn "Đặt hàng"
    menuBoSuuTap.addEventListener("click", function (event) {
        event.stopPropagation(); // Ngăn chặn sự kiện lan ra ngoài
        dropdown.classList.remove("hidden"); // Hiện popup
    });

    // Đóng popup khi nhấn dấu ❌
    closeDropdown.addEventListener("click", function (event) {
        event.stopPropagation(); 
        dropdown.classList.add("hidden");
    });

    // Đóng popup khi nhấn nút closeorder
    closeorder.addEventListener("click", function (event) {
        event.stopPropagation();
        dropdown.classList.add("hidden");
    });

    // Ẩn popup khi click ra ngoài
    document.addEventListener("click", function (event) {
        if (!dropdown.classList.contains("hidden") && !dropdown.querySelector(".bg-white").contains(event.target)) {
            dropdown.classList.add("hidden");
        }
    });
});
