document.addEventListener("DOMContentLoaded", function () {
    const menuBoSuuTap = document.getElementById("menuchat");
    const menuBoSuuTapp = document.getElementById("menuchatt"); // Bộ sưu tập
    const dropdown = document.getElementById("dropdownchat"); // Dropdown
    const closeDropdown = document.getElementById("closeDropdown"); // Nếu có nút đóng khác
    const closeChat = document.getElementById("closechat"); // Nút đóng chat

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

        // Xử lý nút đóng chat
        if (closeChat) {
            closeChat.addEventListener("click", function (event) {
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
    } 
    if (menuBoSuuTapp && dropdown) {
        menuBoSuuTapp.addEventListener("click", function (event) {
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

        // Xử lý nút đóng chat
        if (closeChat) {
            closeChat.addEventListener("click", function (event) {
                event.stopPropagation();
                dropdown.classList.add("hidden");
            });
        }

        // Ẩn dropdown khi click ra ngoài
        document.addEventListener("click", function (event) {
            if (!dropdown.contains(event.target) && !menuBoSuuTapp.contains(event.target)) {
                dropdown.classList.add("hidden");
            }
        });
    } 
});
