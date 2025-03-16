<div id="dropdownchat" class="hidden w-full max-w-sm bg-white rounded-lg shadow-md overflow-hidden fixed bottom-2 right-4">
    <!-- Header -->
    <div class="flex items-center justify-between p-3 bg-red-500 rounded-t-lg">
        <div class="flex items-center">
            <img alt="User profile picture" class="w-10 h-10 rounded-full border-2 border-white" 
                src="../images/logo.jpg"/>
            <div class="ml-3">
                <p class="text-sm font-semibold text-gray-900">Gia Bảo Jewelry</p>
            </div>
        </div>
        <div class="flex items-center space-x-3 text-gray-700">
            <i class="fas fa-phone cursor-pointer hover:text-gray-900"></i>
            <i class="fas fa-video cursor-pointer hover:text-gray-900"></i>
            <i class="fas fa-info-circle cursor-pointer hover:text-gray-900"></i>
            <i id="closechat" class="fas fa-times cursor-pointer hover:text-yellow-500"></i>
        </div>
    </div>

    <!-- Chat Messages -->
    <div class="p-3 space-y-3 overflow-y-auto h-96 bg-white" id="chat-messages">
        <!-- Nội dung gửi -->
        <div class="flex items-center space-x-2">
            <div class="bg-gray-200 text-sm p-2 rounded-lg max-w-xs">Tôi là Admin, tôi có thể giúp gì cho bạn</div>
            <div class="text-xs text-gray-400">23:06</div>
            <i class="fas fa-smile text-gray-400"></i>
            <i class="fas fa-ellipsis-h text-gray-400"></i>
        </div>
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


<script>
document.addEventListener("DOMContentLoaded", function() {
    var sender_id = "<?php echo $_SESSION['user_id']; ?>";
    var receiver_id = "Admin";

    function scrollToBottom() {
        var chatBox = document.getElementById("chat-messages");
        chatBox.scrollTop = chatBox.scrollHeight;
    }

    function loadMessages() {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "../actions/get_message.php?MaNguoiGui=" + sender_id + "&MaNguoiNhan=" + receiver_id, true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                document.getElementById("chat-messages").innerHTML = xhr.responseText;
                scrollToBottom(); 
                // Khi có tin nhắn mới, tiếp tục gọi loadMessages để lắng nghe tiếp
                loadMessages();
            }
        };
        xhr.send();
    }

    function sendMessage() {
        var message = document.getElementById("message-input").value.trim();
        if (message === "") return;
        
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../actions/send_message.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                if (xhr.responseText === "success") {
                    document.getElementById("message-input").value = "";
                    loadMessages(); // Gọi lại để cập nhật tin nhắn ngay lập tức
                } else {
                    alert("Lỗi khi gửi tin nhắn!");
                }
            }
        };
        xhr.send("MaNguoiGui=" + encodeURIComponent(sender_id) + 
                 "&MaNguoiNhan=" + encodeURIComponent(receiver_id) + 
                 "&NoiDung=" + encodeURIComponent(message));
    }

    var dropdownChat = document.getElementById("dropdownchat");
    var observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.attributeName === "class") {
                if (!dropdownChat.classList.contains("hidden")) {
                    scrollToBottom();
                }
            }
        });
    });
    observer.observe(dropdownChat, { attributes: true });

    document.getElementById("send-btn").addEventListener("click", sendMessage);
    document.getElementById("message-input").addEventListener("keydown", function(event) {
        if (event.key === "Enter" && !event.shiftKey) { 
            event.preventDefault();
            sendMessage(); 
        }
    });

    loadMessages(); // Bắt đầu lắng nghe tin nhắn mới ngay lập tức
});


</script>
