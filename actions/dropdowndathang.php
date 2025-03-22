<script src="https://unpkg.com/lucide@latest"></script>
<div id="dropdowndathang" class="hidden fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 flex justify-center items-center z-50">
    <div class="bg-white shadow-lg rounded-lg p-6 w-full max-w-2xl max-h-[90vh] overflow-auto">
        <div class="flex justify-between items-center border-b pb-4 mb-4">
            <h2 id="cart-title" class="text-xl font-bold">GIỎ HÀNG CỦA BẠN (ĐANG CÓ 0 SẢN PHẨM)</h2>
            <button id="closeorder" class="text-black text-xl">
                <i data-lucide="x-circle" class="w-6 h-6"></i>
            </button>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr>
                        <th class="pb-2 ">Sản phẩm</th>
                        <th class="pb-2 text-center">Đơn giá</th>
                        <th class="pb-2 text-center">Số lượng</th>
                        <th class="pb-2 text-center">Thành tiền</th>
                        <th class="pb-2 text-center"></th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $sql = "SELECT MaSP, TenSP, Gia, SoLuong, TongTien FROM giohang WHERE MaND = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("s", $_SESSION['user_id']);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0): 
                        while ($row = $result->fetch_assoc()):
                    ?>
                        <tr class="border-b" data-masp="<?= htmlspecialchars($row['MaSP']) ?>">
                            <td class="py-4 flex items-center gap-x-6">
                                <img src="../images/<?= htmlspecialchars($row['MaSP']) ?>.jpg" alt="<?= htmlspecialchars($row['TenSP']) ?>" class="w-12 h-12 rounded-md">
                                <span class="d-inline-block text-wrap w-24 text-center"><?= htmlspecialchars($row['TenSP']) ?></span>
                            </td>
                            <td class="py-4 text-red-500 w-24 px-4 text-center"><?= number_format($row['Gia']) ?> VNĐ</td>
                            <td class="py-4 w-24 px-4 text-center">
                                <input class="w-16 border rounded p-1 text-center quantity-input" type="number" value="<?= $row['SoLuong'] ?>" min="1"
                                    data-price="<?= $row['Gia'] ?>" data-max="<?= $row['SoLuong'] ?>" oninput="updatePrice(this)">
                            </td>
                            <td class="py-4 text-red-500 w-24 px-4 text-center price"><?= number_format($row['TongTien']) ?> VNĐ</td>
                            <td class="py-4 px-4 text-center">
                                <button class="text-red-500 remove-item" data-masp="<?= htmlspecialchars($row['MaSP']) ?>">
                                    <i data-lucide="trash-2" class="w-5 h-5"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endwhile; else: ?>
                        <tr>
                            <td colspan="5" class="text-center py-4 text-gray-500">Giỏ hàng trống</td>
                        </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="flex justify-between items-center mt-4">
            <a class="text-gray-600 flex items-center" href="#">
                <i data-lucide="arrow-left" class="w-5 h-5 mr-1"></i> Tiếp tục mua hàng
            </a>
            <div class="text-right">
                <div class="text-lg font-bold">
                    Tổng: <span class="text-red-500 total-price"><?= $Gia ?></span>
                </div>
                <div class="mt-2">
                    <button class="bg-black text-white px-4 py-2 rounded" onclick="window.location.href='../donhang/order.php'">
                        TIẾN HÀNH THANH TOÁN
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const cartButtons = document.querySelectorAll(".menuorder");
        const modal = document.getElementById("dropdowndathang");
        const closeOrder = document.getElementById("closeorder");
        const cartBody = document.querySelector("#dropdowndathang tbody");
        const totalPriceEl = document.querySelector(".total-price");
        const cartTitle = document.getElementById("cart-title");
        const updatecarts = document.querySelector(".updates-carts");

        let totalPrice = 0; // Tổng giá trị đơn hàng
        function updateCartTitle() {
            let count = cartBody.querySelectorAll("tr").length;
            cartTitle.innerText = `GIỎ HÀNG CỦA BẠN (ĐANG CÓ ${count} SẢN PHẨM)`;
        }
        cartButtons.forEach(button => {
            button.addEventListener("click", function () {
                const maSP = this.getAttribute("data-masp");
                const tenSP = this.getAttribute("data-tensp");
                const gia = parseInt(this.getAttribute("data-gia"));
                const maND = this.getAttribute("data-mand");
                const soluongSP = this.getAttribute("data-soluongsp");

                let existingRow = document.querySelector(`tr[data-masp='${maSP}']`);
                if (existingRow) {
                    let quantityInput = existingRow.querySelector(".quantity-input");
                    quantityInput.value = parseInt(quantityInput.value) + 1;
                    updatePrice(quantityInput);
                    CapNhatSoLuong(maND, maSP, parseInt(quantityInput.value)); // Cập nhật SQL ngay lập tức
                } else {
                    let row = `
                        <tr class="border-b" data-masp="${maSP}">
                            <td class="py-4 flex items-center gap-x-6">
                                <img src="../images/${maSP}.jpg" class="w-12 h-12 rounded-md">
                                <span class="d-inline-block text-wrap w-24 text-center">${tenSP}</span>
                            </td>
                            <td class="py-4 text-red-500 w-24 px-4 text-center">${gia.toLocaleString()} VNĐ</td>
                            <td class="py-4 w-24 px-4 text-center">
                                <input class="w-16 border rounded p-1 text-center quantity-input" type="number" value="1" min="1"
                                    data-price="${gia}">
                            </td>
                            <td class="py-4 text-red-500 w-24 px-4 text-center price">${gia.toLocaleString()} VNĐ</td>
                            <td class="py-4 px-4 text-center">
                                <button class="text-red-500 remove-item">
                                    <i data-lucide="trash-2"></i>
                                </button>
                            </td>
                        </tr>
                    `;
                    cartBody.insertAdjacentHTML("beforeend", row);

                    let newQuantityInput = cartBody.querySelector(`tr[data-masp='${maSP}'] .quantity-input`);
                    newQuantityInput.addEventListener("change", function () {
                        let maxQuantity = parseInt(soluongSP); // Giới hạn số lượng sản phẩm có sẵn
                        let currentValue = parseInt(this.value);

                        if (isNaN(currentValue) || currentValue < 1) {
                            this.value = 1; // Đảm bảo không thể nhập số nhỏ hơn 1 hoặc giá trị không hợp lệ
                        } else if (currentValue > maxQuantity) {
                            this.value = maxQuantity; // Giới hạn lại số lượng
                            alert("Số lượng vượt quá hàng có sẵn!");
                        }

                        updatePrice(this);
                        CapNhatSoLuong(maND, maSP, parseInt(this.value));
                    });
                    // Gọi hàm thêm vào giỏ hàng
                    addToCart(maND, maSP, tenSP, gia, 1);
                }
                updateTotalPrice();
                modal.classList.remove("hidden");
                lucide.createIcons();
                updateCartTitle();
            });
        });

        // Cập nhật số lượng sản phẩm ngay khi thay đổi input
        function CapNhatSoLuong(maND, maSP, soluong) {
            fetch("../cart/update_cart.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: `mand=${maND}&masp=${maSP}&soluong=${soluong}`
            })
            .then(response => response.text())
            .then(data => console.log(data));
        }

        function addToCart(maND, maSP, tenSP, gia, soLuong) {
            fetch("../cart/add_to_cart.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: `mand=${maND}&masp=${maSP}&tensp=${tenSP}&gia=${gia}&soluong=${soLuong}`
            })
            .then(response => response.text())
            .then(data => console.log(data));
        }
        closeOrder.addEventListener("click", function () {
            modal.classList.add("hidden");
        });
        cartBody.addEventListener("click", function (event) {
            if (event.target.closest(".remove-item")) {
                let row = event.target.closest("tr");
                let maSP = row.getAttribute("data-masp"); // Lấy mã sản phẩm từ hàng
                row.remove();
                updateTotalPrice();
                // Cập nhật lại icon Lucide sau khi xóa
                lucide.createIcons();
                setTimeout(updateCartTitle, 100); // Đợi xóa xong rồi cập nhật
                fetch("../cart/xoagiohang.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded",
                    },
                    body: `masp=${maSP}`
                })
                .then(response => response.text())
                .then(data => console.log(data));
            }
        });

        window.updatePrice = function (input) {
            let price = parseInt(input.getAttribute("data-price"));
            let quantity = parseInt(input.value);
            let total = price * (quantity > 0 ? quantity : 1);
            input.closest("tr").querySelector(".price").innerText = total.toLocaleString() + " VNĐ";
            updateTotalPrice();
        };
        function updateTotalPrice() {
            totalPrice = 0;
            document.querySelectorAll("#dropdowndathang tbody tr").forEach(row => {
                let rowPrice = parseInt(row.querySelector(".price").innerText.replace(/\D/g, ""));
                totalPrice += rowPrice;
            });
            totalPriceEl.innerText = totalPrice.toLocaleString() + " VNĐ";
        }
    });
</script>
<script>lucide.createIcons();</script>