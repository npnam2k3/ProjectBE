<?php
if (isset($_POST['submit'])) {
    $errors = [];
    if (!empty($_POST['product-name'])) {
        $product_name = trim($_POST['product-name']);
    } else {
        $errors['name_empty'] = "Bạn chưa nhập tên sản phẩm";
    }
    if (!empty($_POST['price'])) {
        $price = trim($_POST['price']);
    } else {
        $errors['price_empty'] = "Bạn chưa nhập giá sản phẩm";
    }

    $pathUpload = 'modules/products/uploads';
    if (!empty($_FILES['file_upload'])) {
        //Lấy tên file
        $fileName = $_FILES['file_upload']['name'];
        if ($_FILES['file_upload']['error'] == 4) {
            $errors['choose_file'] = 'Vui lòng chọn file';
        }

        if (empty($errors)) {
            $sql = "INSERT INTO tbl_products(product_name, price, product_img) VALUES('$product_name', '$price', '$fileName')";

            $upload = move_uploaded_file($_FILES['file_upload']['tmp_name'], $pathUpload . '/' . $fileName);
            if ($upload) {
                mysqli_query($conn, $sql);
                header("Location: ?modules=products&action=list");
            } else {
                echo "Upload không thành công";
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

    <title>Thêm sản phẩm</title>
</head>

<body>
    <div class="container">
        <h1 class="my-3">Thêm mới sản phẩm</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="product-name">Tên sản phẩm</label>
                <input type="text" name="product-name" class="form-control" placeholder="Tên sản phẩm ...">
                <?php if(!empty($errors['name_empty'])) echo "<p class='error'>{$errors['name_empty']}</p>"; ?>
            </div>
            <div class="form-group">
                <label for="price">Giá</label>
                <input type="number" name="price" class="form-control" placeholder="Giá ...">
                <?php if(!empty($errors['price_empty'])) echo "<p class='error'>{$errors['price_empty']}</p>"; ?>
            </div>
            
            <label for="formFile" class="form-label">Chọn ảnh</label>
            <input class="form-control" name="file_upload" type="file" id="formFile">
            <?php if(!empty($errors['choose_file'])) echo "<p class='error'>{$errors['choose_file']}</p>"; ?>

            <input class="btn btn-info mt-3" type="submit" name="submit" value="Thêm">
            <a href="?modules=products&action=list" class="btn btn-info mt-3" role="button">Thoát</a>
        </form>
    </div>
</body>

</html>