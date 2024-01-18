<?php
$id = $_GET['id'];
$sql = "DELETE FROM `tbl_products` WHERE `product_id` = '$id'";
mysqli_query($conn, $sql);
header("Location: ?modules=products&action=list");