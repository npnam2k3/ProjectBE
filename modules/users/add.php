<?php
if(isset($_POST['submit'])){
    $error = array();
    $fullname = filter_input(INPUT_POST, 'fullname', FILTER_SANITIZE_SPECIAL_CHARS);
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

    //validate fullname
    if(empty(trim($fullname))){
        $error['fullname'] = "Không được để trống họ và tên";
    }

    //validate username
    if(empty(trim($username))){
        $error['username'] = "Không được để trống tên đăng nhập";
    }

    //validate email
    if(empty(trim($email))){
        $error['email'] = "Không được để trống email";
    }

    //validate password
    if(empty(trim($password))){
        $error['password'] = "Không được để trống mật khẩu";
    }

    //Nếu không có lỗi
    if(empty($error)){
        $sql = "SELECT * from `tbl_users` where `username` = '$username' or `email`='$email'";
        if(mysqli_num_rows(mysqli_query($conn, $sql))>0){
            echo "<div class=\"alert alert-danger\">
            Email hoặc tên đăng nhập đã tồn tại trong hệ thống
          </div>";
        }else{
            $password = md5($password);
            $sql = "INSERT into `tbl_users`(username, fullname, email, password) value('$username', '$fullname', '$email', '$password')";
            $success = mysqli_query($conn, $sql);
            if($success){
                header("Location: ?modules=users&action=list");
            }else{
                echo "Thêm không thành công";
            }
        }
    }

}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="public/css/style.css">

    <title>Thêm người dùng</title>
</head>

<body>
    <div class="container">
        <h1 class="my-3">Thêm người dùng</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" class="form-control" placeholder="Tên đăng nhập ..." id="username">
                <?php if(!empty($error['username'])) echo "<p class='error'>{$error['username']}</p>"; ?>
            </div>
            <div class="form-group">
                <label for="fullname">Họ và tên</label>
                <input type="text" name="fullname" class="form-control" placeholder="Họ và tên ..." id="fullname">
                <?php if(!empty($error['fullname'])) echo "<p class='error'>{$error['fullname']}</p>"; ?>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" class="form-control" placeholder="Email ..." id="email">
                <?php if(!empty($error['email'])) echo "<p class='error'>{$error['email']}</p>"; ?>
            </div>
            <div class="form-group">
                <label for="password">Mật khẩu</label>
                <input type="password" name="password" class="form-control" placeholder="Mật khẩu ..." id="password">
                <?php if(!empty($error['password'])) echo "<p class='error'>{$error['password']}</p>"; ?>
            </div>

            <input class="btn btn-info mt-3" type="submit" name="submit" value="Thêm">
            <a href="?modules=users&action=list" class="btn btn-info mt-3" role="button">Thoát</a>
        </form>
    </div>
</body>

</html>