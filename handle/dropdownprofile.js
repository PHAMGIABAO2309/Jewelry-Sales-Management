document.addEventListener("DOMContentLoaded", function () {
    const dropdownBtn = document.getElementById("userDropdown"); // Đúng ID
    const dropdown = document.getElementById("dropdownMenu"); // Đúng ID
    const closeDropdown = document.getElementById("closeDropdown");

    if (dropdownBtn && dropdown) {
        dropdownBtn.addEventListener("click", function (event) {
            event.stopPropagation();
            dropdown.classList.toggle("hidden");
        });

        if (closeDropdown) {
            closeDropdown.addEventListener("click", function (event) {
                event.stopPropagation();
                dropdown.classList.add("hidden");
            });
        }

        document.addEventListener("click", function (event) {
            if (!dropdown.contains(event.target) && !dropdownBtn.contains(event.target)) {
                dropdown.classList.add("hidden");
            }
        });
    } else {
        console.error("Không tìm thấy phần tử dropdown hoặc nút bấm.");
    }
});
