<?php
$id = (int)$_GET['id'];
$sql = "SELECT * FROM tbl_users WHERE user_id = $id";
$result = mysqli_query($conn, $sql);
$arr = mysqli_fetch_assoc($result);
// print_r($arr);
if (isset($_POST['submit'])) {
    $error = array();
    $fullname = filter_input(INPUT_POST, 'fullname', FILTER_SANITIZE_SPECIAL_CHARS);
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS);

    //validate fullname
    if (empty(trim($fullname))) {
        $error['fullname'] = "Không được để trống họ và tên";
    }

    //validate username
    if (empty(trim($username))) {
        $error['username'] = "Không được để trống tên đăng nhập";
    }

    //validate email
    if (empty(trim($email))) {
        $error['email'] = "Không được để trống email";
    }

    //Nếu không có lỗi
    if (empty($error)) {
        $sql = "UPDATE tbl_users SET `username` = '$username', `fullname` = '$fullname', `email`= '$email' WHERE `user_id` = '$id'";
        $success = mysqli_query($conn, $sql);
        if ($success) {
            header("Location: ?modules=users&action=list");
        } else {
            echo "Cập nhật không thành công";
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

    <title>Cập nhật người dùng</title>
</head>

<body>
    <div class="container">
        <h1 class="my-3">Cập nhật người dùng</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" class="form-control" placeholder="Tên đăng nhập ..." id="username" value="<?php echo (!empty($arr['username'])) ? $arr['username'] : '' ?>">
                <?php if (!empty($error['username'])) echo "<p class='error'>{$error['username']}</p>"; ?>
            </div>
            <div class="form-group">
                <label for="fullname">Họ và tên</label>
                <input type="text" name="fullname" class="form-control" placeholder="Họ và tên ..." id="fullname" value="<?php echo (!empty($arr['fullname'])) ? $arr['fullname'] : '' ?>">
                <?php if (!empty($error['fullname'])) echo "<p class='error'>{$error['fullname']}</p>"; ?>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" class="form-control" placeholder="Email ..." id="email" value="<?php echo (!empty($arr['email'])) ? $arr['email'] : '' ?>">
                <?php if (!empty($error['email'])) echo "<p class='error'>{$error['email']}</p>"; ?>
            </div>


            <input class="btn btn-info mt-3" type="submit" name="submit" value="Cập nhật">
            <a href="?modules=users&action=list" class="btn btn-info mt-3" role="button">Thoát</a>
        </form>
    </div>
</body>

</html>