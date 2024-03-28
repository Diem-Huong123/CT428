<?php
// Thông tin kết nối
$servername = 'localhost'; // Tên server, nếu dùng hosting free thì cần thay đổi
$dbname = 'demo'; // Tên của Database
$username = 'root'; // Tên sử dụng Database
$password = 'DH050203@'; // Mật khẩu của tên sử dụng Database

// Tạo kết nối đến cơ sở dữ liệu
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Không thể kết nối database: " . $conn->connect_error);
}
?>