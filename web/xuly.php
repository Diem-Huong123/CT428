<?php
// Nếu không phải là sự kiện đăng ký thì không xử lý
if (!isset($_POST['txtUsername'])) {
    die('');
}

// Nhúng file kết nối với database
include ('ketnoi.php');

// Khai báo utf-8 để hiển thị được tiếng Việt
header('Content-Type: text/html; charset=UTF-8');

// Lấy dữ liệu từ file dangky.php
$username = addslashes($_POST['txtUsername']);
$password = addslashes($_POST['txtPassword']);
$email = addslashes($_POST['txtEmail']);
$fullname = addslashes($_POST['txtFullname']);
$birthday = addslashes($_POST['txtBirthday']);
$sex = addslashes($_POST['txtSex']);

// Kiểm tra người dùng đã nhập liệu đầy đủ chưa
if (!$username || !$password || !$email || !$fullname || !$birthday || !$sex) {
    echo "Vui lòng nhập đầy đủ thông tin. <a href='javascript: history.go(-1)'>Trở lại</a>";
    exit;
}

// Mã hóa mật khẩu
$password = password_hash($password, PASSWORD_DEFAULT);

// Kiểm tra tên đăng nhập này đã có người dùng chưa
$stmt = $conn->prepare("SELECT username FROM member WHERE username=?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
if ($result && $result->num_rows > 0) {
    echo "Tên đăng nhập này đã có người dùng. Vui lòng chọn tên đăng nhập khác. <a href='javascript: history.go(-1)'>Trở lại</a>";
    exit;
}

// Kiểm tra email có đúng định dạng hay không
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Email này không hợp lệ. Vui lòng nhập email khác. <a href='javascript: history.go(-1)'>Trở lại</a>";
    exit;
}

// Kiểm tra email đã có người dùng chưa
$stmt = $conn->prepare("SELECT email FROM member WHERE email=?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
if ($result && $result->num_rows > 0) {
    echo "Email này đã có người dùng. Vui lòng chọn Email khác. <a href='javascript: history.go(-1)'>Trở lại</a>";
    exit;
}

// Kiểm tra dạng nhập vào của ngày sinh
if (!preg_match("/^[0-9]{1,2}\/[0-9]{1,2}\/[0-9]{4}$/", $birthday)) {
    echo "Ngày tháng năm sinh không hợp lệ. Vui lòng nhập lại. <a href='javascript: history.go(-1)'>Trở lại</a>";
    exit;
}

// Lưu thông tin thành viên vào bảng
$stmt = $conn->prepare("INSERT INTO member (username, password, email, fullname, birthday, sex) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $username, $password, $email, $fullname, $birthday, $sex);

if ($stmt->execute()) {
    echo "Quá trình đăng ký thành công. <a href='dangnhap.php'>Về trang chủ</a>";
} else {
    echo "Có lỗi xảy ra trong quá trình đăng ký. <a href='dangky.php'>Thử lại</a>";
}

// Đóng kết nối
$stmt->close();
$conn->close();
?>