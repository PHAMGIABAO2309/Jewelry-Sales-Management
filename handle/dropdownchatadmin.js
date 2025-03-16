document.addEventListener("DOMContentLoaded", function () {
    const menuChatAdmin = document.querySelectorAll(".menuchatadmin"); // Chọn tất cả phần tử có class 'menuchatadmin'
    const dropdown = document.getElementById("dropdownchatadmin"); // Dropdown
    const closeDropdown = document.getElementById("closeDropdown"); // Nút đóng dropdown
    const closeChat = document.getElementById("closechat"); // Nút đóng chat

    

    if (menuChatAdmin.length > 0 && dropdown) {
        menuChatAdmin.forEach(element => {
            element.addEventListener("click", function (event) {
                event.stopPropagation(); // Ngăn chặn sự kiện lan ra ngoài
                dropdown.classList.toggle("hidden");
            });
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
            if (!dropdown.contains(event.target) && !event.target.closest(".menuchatadmin")) {
                dropdown.classList.add("hidden");
            }
        });
    } else {
        console.error("Không tìm thấy phần tử menuChatAdmin hoặc dropdown.");
    }
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".menuchatadmin").forEach(button => {
            button.addEventListener("click", function() {
                let tenNguoiDung = this.getAttribute("data-tennd");
                document.getElementById("chatUserName").textContent = tenNguoiDung;
            });
        });
    });
});
