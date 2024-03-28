<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Đăng ký</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <div class="container">
            <div class="row justify-content-around">
                <form action="xuly.php" method="POST" class="col-md-6 bg-light p-3 my-3">
                    <h1 class="text-center text-uppercase h3 py-3">ĐĂNG KÝ TÀI KHOẢN</h1>
                    <div class=" form-group">
                        <label for="txtUsername">Tên đăng nhập</label>
                        <input type="text" name="txtUsername" id="username" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="txtPassword">Mật khẩu</label>
                        <input type="password" name="txtPassword" id="password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="txtEmail">Email</label>
                        <input type="text" name="txtEmail" id="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="txtFullname">Họ và tên</label>
                        <input type="text" name="txtFullname" id="fullname" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="txtBirthday">Birthday</label>
                        <input type="text" name="txtBirthday" id="birthday" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="txtSex">Giới tính</label>
                        <select name="txtSex">
                            <option value="Nam">Nam</option>
                            <option value="Nu">Nữ</option>
                        </select>
                        <!-- <div class="form-check form-check-inline">
                                <input type="radio" name="txtSex" id="male" value="male" class="form-check-input"
                                    checked>
                                 // thêm checked thì nam sẽ là cố định 
                                <label for="male">Nam</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" name="txtSex" id="female" value="female" class="form-check-input">
                                <label for="female">Nữ</label> -->
                    </div>
                    <input type="submit" value="Đăng Ký" name="dangky" class="btn-primary btn btn-block">
                    <input type="reset" value="Nhập lại" class="btn-block" />
            </div>

            </form>
        </div>
    </div>
    </div>

</body>

</html>