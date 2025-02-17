<?php
function openconnection()
{
    $dbhost = "localhost:3307";
    $dbuser = "root";
    $dbpass = "";
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass);

    // Tạo database nếu chưa tồn tại
    $sql = 'CREATE DATABASE IF NOT EXISTS Perfume';
    mysqli_query($conn, $sql);

    mysqli_select_db($conn, 'Perfume');
    return $conn;
}
function closeconnection($conn)
{
    $conn->close();
}
?>
