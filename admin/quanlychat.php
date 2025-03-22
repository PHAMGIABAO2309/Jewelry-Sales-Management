<?php
include '../database/connect.php'; 
include '../managerchat/listchat.php'; 

?>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quản lý Chat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/admins.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../handle/dropdownchatadmin.js"></script>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar d-flex flex-column p-3">
            <div class="d-flex align-items-center border-bottom pb-3 mb-3">
                <div class="admin-info">
                    <img src="../images/logo.jpg" alt="Admin">
                    <span>Admin</span>
                </div>
            </div>
            <a href="admin.php"><i class="fas fa-tachometer-alt me-2"></i> Tổng quan</a>
            <a href="#"><i class="fas fa-cogs me-2"></i> Quản lý hệ thống</a>
            <a href="quanlytaikhoan.php"><i class="fas fa-users me-2"></i> Quản lý tài khoản</a>
            <a href="quanlysanpham.php"><i class="fas fa-boxes me-2"></i> Quản lý sản phẩm</a>
            <a href="quanlynhaphang.php"><i class="fas fa-truck-loading me-2"></i> Quản lý nhập hàng</a>
            <a href="#"><i class="fas fa-shopping-cart me-2"></i> Quản lý đơn hàng</a>
            <a href="quanlychat.php"><i class="fas fa-comments me-2"></i> Chat với KH</a>
            <a href="doanhthu.php"><i class="fas fa-chart-bar me-2"></i> Thống kê doanh thu</a>
            <a href="#"><i class="fas fa-bell me-2"></i> Thông báo</a>
            <a href="#"><i class="fas fa-cogs me-2"></i> Cài đặt</a>
            <a href="#"><i class="fas fa-sign-out-alt me-2"></i> Đăng xuất</a>
        </div>
        <!-- Main Content -->
        <div class="flex-grow-1 p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold text-dark">Chat với KH</h2>
                <div class="position-relative">
                    <i class="menuchatadmin fas fa-comments fs-3 text-secondary"></i>
                    <span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle"></span>
                </div>
            </div>
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Danh sách tin nhắn</h5>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 150px; height: 50px;">Tên KH</th> <!-- Giới hạn chiều rộng -->
                                <th style="width:150px; height: 50px;">Tin nhắn</th> <!-- Để tin nhắn rộng hơn -->
                                <th style="width: 180px; height: 50px;">Thời gian</th> <!-- Vừa đủ để hiển thị -->
                                <th style="width: 100px; height: 50px;"></th> <!-- Cột chứa nút "Xem" -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($row["TenKH"]) . "</td>";
                                    echo "<td class='noidung' title='" . htmlspecialchars($row["NoiDung"]) . "'>" . htmlspecialchars($row["NoiDung"]) . "</td>";
                                    echo "<td>" . date("d-m-Y H:i:s", strtotime($row["ThoiGian"])) . "</td>";
                                    echo '<td>
                                            <button class="btn btn-primary btn-sm menuchatadmin" 
                                                data-name="' . htmlspecialchars($row["TenKH"]) . '" 
                                                data-avt="' . htmlspecialchars($row["avt"]) . '"
                                                data-manguoinhan="' . htmlspecialchars($row["MaNguoiGui"]) . '" 
                                                data-noidung="' . htmlspecialchars($row["NoiDung"]) . '" 
                                                data-thoigian="' . date("H:i d/m/Y", strtotime($row["ThoiGian"])) . '">
                                                Xem
                                            </button>
                                        </td>';
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='4' class='text-center text-muted'>Không có tin nhắn nào!</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
   

    <!-- Chat Box -->
    <div id="dropdownchatadmin" class="hidden w-full max-w-sm bg-white rounded-lg shadow-md overflow-hidden fixed bottom-2 right-4 ">
        <!-- Header -->
        <div class="flex items-center justify-between p-3 bg-red-500 rounded-t-lg">
            <div class="flex items-center">
                <img id="chatUserAvatar" alt="User profile picture" 
                    class="w-10 h-10 rounded-full border-2 border-white" 
                    src="../images/logo.jpg"/>
                <div class="ml-3">
                    <p id="chatUserName" class="text-sm font-semibold text-yellow-100">Gia Bảo Jewelry</p>
                </div>
            </div>
            <div class="flex items-center space-x-3 text-gray-700">
                <i id="closechat" class="fas fa-times cursor-pointer hover:text-yellow-500"></i>
            </div>
        </div>

        <!-- Chat Messages -->
        <div class="p-3 space-y-3 overflow-y-auto h-96 bg-white" id="chat-messages">
            <div id="chatContainer" class="overflow-y-auto max-h-96"></div>  <!-- Chứa danh sách tin nhắn --> 
        </div>

        <!-- Footer -->
        <div class="flex items-center p-3 bg-red-500 rounded-b-lg">
            <div class="flex items-center space-x-3 text-gray-800">
                <i class="fas fa-thumbs-up cursor-pointer hover:text-blue-500"></i>
                <i class="fas fa-camera cursor-pointer hover:text-blue-500"></i>
                <i class="fas fa-image cursor-pointer hover:text-blue-500"></i>
                <i class="fas fa-microphone cursor-pointer hover:text-blue-500"></i>
                <i class="fas fa-laugh cursor-pointer hover:text-yellow-500"></i>
            </div>
            <input id="message-input" class="flex-1 mx-3 p-2 bg-white border border-gray-300 rounded-lg text-sm text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-yellow-500" placeholder="Aa" type="text"/>
            <i id="send-btn" class="fas fa-paper-plane text-blue-500 cursor-pointer"></i>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
   
<script>
  document.addEventListener("DOMContentLoaded", function () {
    let buttons = document.querySelectorAll(".menuchatadmin");

    buttons.forEach(button => {
        button.addEventListener("click", function () {
            let userName = this.getAttribute("data-name");
            let receiver_id = this.getAttribute("data-manguoinhan");
            let userAvatar = this.getAttribute("data-avt"); // Lấy avatar của người gửi

            fetch("../managerchat/name_user_send.php?TenND=" + encodeURIComponent(userName))
                .then(response => response.json())
                .then(data => {
                    document.getElementById("chatUserName").textContent = userName;
                    document.getElementById("send-btn").setAttribute("data-manguoinhan", receiver_id);

                     // Cập nhật ảnh đại diện
                     let avatarElement = document.getElementById("chatUserAvatar");
                    if (userAvatar) {
                        avatarElement.src = "../" + userAvatar; // Đảm bảo đường dẫn đúng
                    } else {
                        avatarElement.src = "../images/default-avatar.jpg"; // Ảnh mặc định nếu không có avatar
                    }

                    let chatContainer = document.getElementById("chatContainer");
                    chatContainer.innerHTML = "";

                    data.forEach((msg, index) => {
                        let msgWrapper = document.createElement("div");
                        msgWrapper.className = "flex items-end gap-2 mb-2";

                        let msgDiv = document.createElement("div");
                        msgDiv.className = "bg-gray-200 text-sm p-2 rounded-lg max-w-xs";
                        msgDiv.textContent = msg.NoiDung;

                        let timeDiv = document.createElement("div");
                        timeDiv.className = "text-xs text-gray-400";
                        timeDiv.textContent = msg.ThoiGian;

                        msgWrapper.appendChild(msgDiv);
                        msgWrapper.appendChild(timeDiv);

                        if (index === data.length - 1) {
                            msgWrapper.classList.add("last-message");
                        }

                        chatContainer.appendChild(msgWrapper);
                    });
                    scrollToBottom();
                    loadMessages(receiver_id);
                })
                .catch(error => console.error("Lỗi lấy tin nhắn:", error));
        });
    });

    let sender_id = "Admin";

    function scrollToBottom() {
        let lastMessage = document.querySelector("#chatContainer .last-message");
        if (lastMessage) {
            lastMessage.scrollIntoView({ behavior: "smooth", block: "end" });
        }
    }

    function sendMessage() {
        let messageInput = document.getElementById("message-input");
        let message = messageInput ? messageInput.value.trim() : "";
        let receiver_id = document.getElementById("send-btn").getAttribute("data-manguoinhan");

        if (message === "" || !receiver_id) return;

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "../actions/send_message.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                if (xhr.responseText.trim() === "success") {
                    loadMessages(receiver_id);
                    if (messageInput) {
                        messageInput.value = "";
                    }
                } else {
                    alert("Lỗi khi gửi tin nhắn! " + xhr.responseText);
                }
            }
        };
        xhr.send("MaNguoiGui=" + encodeURIComponent(sender_id) + 
                 "&MaNguoiNhan=" + encodeURIComponent(receiver_id) + 
                 "&NoiDung=" + encodeURIComponent(message));
    }

    function loadMessages(receiver_id) {
        let xhr = new XMLHttpRequest();
        xhr.open("GET", "../actions/get_message.php?MaNguoiGui=" + sender_id + "&MaNguoiNhan=" + receiver_id, true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                let chatBox = document.getElementById("chatContainer");
                if (chatBox) {
                    chatBox.innerHTML = xhr.responseText;

                    let messages = chatBox.querySelectorAll("div");
                    if (messages.length > 0) {
                        messages[messages.length - 1].classList.add("last-message");
                    }
                    scrollToBottom();
                    
                }
            
            }
        };
        xhr.send();
    }
    let sendButton = document.getElementById("send-btn");
    if (sendButton) {
        sendButton.addEventListener("click", sendMessage);
    }

    let messageInput = document.getElementById("message-input");
    if (messageInput) {
        messageInput.addEventListener("keydown", function (event) {
            if (event.key === "Enter" && !event.shiftKey) {
                event.preventDefault();
                sendMessage();
            }
        });
    }
});
</script>



<style>
table th, table td {
    overflow: hidden; /* Ẩn phần tràn ra */
    text-overflow: ellipsis; /* Hiển thị "..." nếu bị tràn */
}

td:nth-child(2) { /* Áp dụng riêng cho cột Tin nhắn */
    white-space: normal; /* Cho phép xuống dòng */
    word-wrap: break-word; /* Xuống dòng khi quá dài */
    max-width: 300px; /* Giới hạn chiều rộng */
}
#chatContainer {
    max-height: 400px;
    overflow-y: auto;
    -ms-overflow-style: none;  /* IE và Edge */
    scrollbar-width: none;  /* Firefox */
}
#chatContainer::-webkit-scrollbar {
    display: none;  /* Chrome, Safari, Opera */
}
td.noidung {
    max-width: 150px; /* Giới hạn chiều rộng */
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}



</style>
</body>
</html>