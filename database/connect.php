<?php
$conn = mysqli_connect('localhost', 'root', '', 'db_project_be','5033');
if(!$conn){
    die("Kết nối thất bại".mysqli_connect_error());
}