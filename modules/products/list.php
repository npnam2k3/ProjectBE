<?php
$data = [
    'title' => 'Danh sách sản phẩm'
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
    <h1 class="">Danh sách sản phẩm</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="list-product">
                <div class="row mb-3">
                    <?php
                    if (!empty($arr)) {
                        foreach ($arr as $item) {
                    ?>
                            <div class="col-md-3 mt-2">
                                <div class="product-item border py-2">
                                    <div class="product-thumb">
                                        <a href="">
                                            <img src="<?php echo "modules/products/uploads/" . $item['product_img'] ?>" class="img-fluid" alt="">
                                        </a>
                                    </div>
                                    <div class="product-info p-2 text-center">
                                        <a href="" class="product-name"><?php echo $item['product_name'] ?></a>
                                        <div class="price">
                                            <span class="text-danger"><?php echo number_format($item['price']).' đ' ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>