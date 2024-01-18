<?php
if(isset($_POST['submit'])){
    $error = array(); //mảng lưu trữ lỗi khi đăng nhập

    //validate username
    if(empty($_POST['username'])){
        $error['username'] = "Không được để trống tên đăng nhập";
    }else{
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
    }

    //validate password
    if(empty($_POST['password'])){
        $error['password'] = "Không được để trống mật khẩu";
    }else{
        $password = md5(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS));
    }

    //Nếu không có lỗi 
    if(empty($error)){
        //Kiểm tra trong database đã tồn tại username và password này chưa
        $sql = "SELECT * from `tbl_users` where `username`='$username' AND `password`='$password'";
        $result = mysqli_query($conn, $sql);
        //Tồn tại
        if(mysqli_num_rows($result)>0){
            $user = mysqli_fetch_assoc($result);
            $_SESSION['user_login'] = $username;
            $_SESSION['is_login'] = true;
            $_SESSION['user_role'] = $user['role'];

            // Phân quyền dựa trên role
            if($user['role'] == '0'){
                // Chuyển hướng người dùng có role 0
                $_SESSION['is_login_admin'] = false;
                header("Location: ?modules=products&action=manager");
            } elseif ($user['role'] == '1') {
                // Chuyển hướng người dùng có role 1
                $_SESSION['is_login_admin'] = true;
                header("Location: ?modules=users&action=list");
            }
        }else{
            $error['login'] = "Thông tin đăng nhập không chính xác";
        }

    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="public/css/style.css">

    <title>Đăng nhập</title>
</head>

<body>
    <div class="row">
        <div class="col-6" style="margin: 20px auto;">
            <h3 class="text-center text-uppercase">Đăng nhập hệ thống</h3>
            <form action="" method="post">
                <div class="form-group">
                    <label for="username">Tên đăng nhập</label>
                    <input type="username" name="username" class="form-control" placeholder="Tên đăng nhập..." id="username">
                    <?php if(!empty($error['username'])) echo "<p class='error'>{$error['username']}</p>"; ?>
                </div>
                <div class="form-group">
                    <label for="password">Mật khẩu</label>
                    <input type="password" name="password" class="form-control" placeholder="Mật khẩu..." id="password">
                    <?php if(!empty($error['password'])) echo "<p class='error'>{$error['password']}</p>"; ?>
                </div>
                <button type="submit" name="submit" class="btn btn-primary btn-block">Đăng nhập</button>
                <?php if(!empty($error['login'])) echo "<p class='error text-center'>{$error['login']}</p>"; ?>
            </form>
        </div>
    </div>

</body>

</html>