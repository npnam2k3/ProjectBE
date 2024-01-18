<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="public/css/style.css">

    <title><?php echo (!empty($data['title']) ? $data['title'] : 'Document') ?></title>
</head>

<body>
    <div id="menu">
        <ul>
            <li><a href="?modules=products&action=list">Danh sách sản phẩm</a></li>

            <li><a href="<?php echo (!empty($_SESSION['is_login'])) ? '?modules=products&action=manager' : '?modules=auth&action=login'; ?>">Quản lý sản phẩm</a></li>

            <li><a href="<?php echo (!empty($_SESSION['is_login']) && $_SESSION['is_login_admin'] == true) ? '?modules=users&action=list' : '?modules=errors&action=error'; ?>">Quản lý người dùng</a></li>

            <?php if (!empty($_SESSION['user_login'])) echo "<li class=\"float-left\">Xin chào: {$_SESSION['user_login']}</li>" ?>

            <?php if (!empty($_SESSION['user_login'])) echo '<li class="float-right"><a href="?modules=auth&action=logout">Đăng xuất</a></li>' ?>

            <?php if (empty($_SESSION['user_login'])) echo '<li class="float-right"><a href="?modules=auth&action=login">Đăng nhập</a></li>' ?>
        </ul>
    </div>