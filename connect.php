<?php
function openconnection()
{
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass);
    mysqli_select_db($conn, 'Purfume');
    return $conn;
}
function closeconnection($conn)
{
    $conn->close();
}
?>
