<?php
// Khai báo sử dụng session
session_start();

// Khai báo utf-8 để hiển thị được tiếng Việt
header('Content-Type: text/html; charset=UTF-8');

// Xử lý đăng nhập
if (isset($_POST['dangnhap'])) {
    // Kết nối tới database
    include ('ketnoi.php');

    // Lấy dữ liệu nhập vào
    $username = addslashes($_POST['txtUsername']);
    $password = addslashes($_POST['txtPassword']);

    // Kiểm tra đã nhập đủ tên đăng nhập và mật khẩu chưa
    if (!$username || !$password) {
        echo "Vui lòng nhập đầy đủ tên đăng nhập và mật khẩu. <a href='javascript: history.go(-1)'>Trở lại</a>";
        exit;
    }

    // Mã hóa mật khẩu
    //$password = password_hash($password, PASSWORD_DEFAULT);

    // Kiểm tra tên đăng nhập có tồn tại không
    $stmt = $conn->prepare("SELECT username, password FROM member WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        echo "Tên đăng nhập này không tồn tại. Vui lòng kiểm tra lại. <a href='javascript: history.go(-1)'>Trở lại</a>";
        exit;
    }

    // Lấy mật khẩu từ cơ sở dữ liệu
    $row = $result->fetch_assoc();

    // So sánh 2 mật khẩu có trùng khớp hay không
    if (password_verify($password, $row['password'])) {
        $_SESSION['username'] = $username;
        echo "Xin chào " . $username . ". Bạn đã đăng nhập thành công. <a href='trangchu.php'>Về trang chủ</a>";
        die();
    } else {
        echo "Mật khẩu không đúng. Vui lòng nhập lại. <a href='javascript: history.go(-1)'>Trở lại</a>";
        exit;
    }


}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Đăng Nhập</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
    <div class="wrapper">
        <div class="container">
            <div class="row justify-content-around">
                <form action="dangnhap.php?do=login" method="POST" class="col-md-6 bg-light p-3 my-3">
                    <h1 class="text-center text-uppercase h3 py-3">ĐĂNG NHẬP TÀI KHOẢN</h1>
                    <div class=" form-group">
                        <label for="txtUsername">Tên đăng nhập</label>
                        <input type="text" name="txtUsername" id="username" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="txtPassword">Mật khẩu</label>
                        <input type="password" name="txtPassword" id="password" class="form-control" required>
                    </div>
                    <input type="submit" value="Đăng nhập" name="dangnhap" class="btn-primary btn btn-block">
                    <a href='dangky.php' title='Đăng ký'>Đăng ký</a>
                </form>
            </div>
        </div>
    </div>
</body>

</html>