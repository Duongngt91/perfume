<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dương Perfume</title>
    <link rel="stylesheet" href="Trangchu.css">
    <link rel="icon" type="image/x-icon" href="anh/logo.webp">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>
    <?php
    // Nếu không có session, thì sẽ tạo session
    if(!isset($_SESSION)) {
        session_start();
    }

    include 'header.php';
    ?>
    <?php
    include 'nav.php';
    ?>
    <?php
    include 'aside.php';
    ?>
    <?php
    include 'article.php';
    ?>
    <?php
    include 'footer.php';
    ?>
</body>
</html>