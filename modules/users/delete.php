<?php
$id=(int)$_GET['id'];
$sql = "DELETE FROM `tbl_users` WHERE `user_id` = '$id'";
mysqli_query($conn, $sql);
header("Location: ?modules=users&action=list");