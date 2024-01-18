<?php
$data = [
    'title' => 'Quản lý sản phẩm'
];
require 'inc/header.php';

$sql = "SELECT * FROM tbl_products";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $arr[] = $row;
    }
}
?>
<div class="container">
    <a href="?modules=products&action=upload_file" class="btn btn-info" role="button">Thêm sản phẩm</a>
    <?php
    if (!empty($arr)) {
    ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Mã sản phẩm</th>
                    <th>Tên sản phẩm</th>
                    <th>Ảnh sản phẩm</th>
                    <th>Giá</th>
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
                        <th><?php echo $item['product_id'] ?></th>
                        <td><?php echo $item['product_name'] ?></td>
                        <td><img width="100px" class="img-thumbnail" src="<?php echo "modules/products/uploads/" .$item['product_img'] ?>" alt=""></td>
                        <td><?php echo number_format($item['price']).' đ' ?></td>
                        <td><a href="?modules=products&action=update&id=<?php echo $item['product_id'] ?>" class="btn btn-info" role="button">Sửa</a> <a href="?modules=products&action=delete&id=<?php echo $item['product_id'] ?>" class="btn btn-info" role="button" onclick="return confirm('Bạn có chắc muốn xóa không?')">Xóa</a></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    <?php
    } else {
        echo "<p>Không có sản phẩm nào</p>";
    }
    ?>
</div>
</body>

</html>