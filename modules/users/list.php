<?php
// echo $_SESSION['is_login'];
$data = [
    'title' => 'Danh sách người dùng'
];
require 'inc/header.php';

$sql = "SELECT * FROM tbl_users";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $arr[] = $row;
    }
}
// echo "<pre>";
// print_r($arr);
// echo "</pre>";
?>
<div class="container">
    <h1 class="">Danh sách người dùng</h1>
    <a href="?modules=users&action=add" class="btn btn-info my-3" role="button">Thêm người dùng</a>
    <?php
    if (!empty($arr)) {
    ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>ID</th>
                    <th>Tên đăng nhập</th>
                    <th>Họ và tên</th>
                    <th>Email</th>
                    <th>Tùy chọn</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $temp = 1;
                foreach ($arr as $item) {
                ?>
                    <tr>
                        <th><?php echo $temp++ ?></th>
                        <th><?php echo $item['user_id'] ?></th>
                        <td><?php echo $item['username'] ?></td>
                        <td><?php echo $item['fullname'] ?></td>
                        <td><?php echo $item['email'] ?></td>
                        <td><a href="?modules=users&action=update&id=<?php echo $item['user_id'] ?>" class="btn btn-info" role="button">Sửa</a> <a href="?modules=users&action=delete&id=<?php echo $item['user_id'] ?>" class="btn btn-info" role="button" onclick="return confirm('Bạn có chắc muốn xóa không?')">Xóa</a></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    <?php
    } else {
        echo "<p>Không có người dùng nào</p>";
    }
    ?>
</div>
</body>

</html>