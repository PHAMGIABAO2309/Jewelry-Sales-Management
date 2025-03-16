document.addEventListener("DOMContentLoaded", function () {
    const menuBoSuuTap = document.getElementById("menuLoaiSanPham"); // Bộ sưu tập
    const dropdown = document.getElementById("dropdownloaisanpham"); // Dropdown
    const closeDropdown = document.getElementById("closeDropdown"); // Nếu có nút đóng

    if (menuBoSuuTap && dropdown) {
        menuBoSuuTap.addEventListener("click", function (event) {
            event.stopPropagation(); // Ngăn chặn sự kiện lan ra ngoài
            dropdown.classList.toggle("hidden");
        });

        // Xử lý nút đóng dropdown (nếu có)
        if (closeDropdown) {
            closeDropdown.addEventListener("click", function (event) {
                event.stopPropagation();
                dropdown.classList.add("hidden");
            });
        }

        // Ẩn dropdown khi click ra ngoài
        document.addEventListener("click", function (event) {
            if (!dropdown.contains(event.target) && !menuBoSuuTap.contains(event.target)) {
                dropdown.classList.add("hidden");
            }
        });
    } else {
        console.error("Không tìm thấy phần tử menuBoSuuTap hoặc dropdown.");
    }
});
