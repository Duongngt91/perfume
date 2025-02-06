<?php
include 'connect.php';

    // Kết nối đến MySQL
    $conn = openconnection();

    // Kiểm tra kết nối
    if (!$conn) {
        die("Kết nối thất bại: " . mysqli_connect_error());
    }
    echo "Kết nối thành công.<br>";

    // Tạo cơ sở dữ liệu nếu chưa tồn tại
    $sql = "CREATE DATABASE IF NOT EXISTS Perfume";
    if (!mysqli_query($conn, $sql)) {
        die("Không tạo được cơ sở dữ liệu  Perfume: " . mysqli_error($conn));
    }
    echo "Đã tạo hoặc xác nhận cơ sở dữ liệu.<br>";

    // Chọn cơ sở dữ liệu
    if (!mysqli_select_db($conn, "Perfume")) {
        die("Không thể chọn cơ sở dữ liệu: " . mysqli_error($conn));
    }
    echo "Đã chọn cơ sở dữ liệu.<br>";

    // Tạo bảng NGUOIDUNG
    $NGUOIDUNG = "CREATE TABLE IF NOT EXISTS NGUOIDUNG (
        MAND VARCHAR(200) NOT NULL,
        TENDANGNHAP VARCHAR(200) NOT NULL,
        MATKHAU VARCHAR(200) NOT NULL,
        HOTEN NVARCHAR(200) NOT NULL,
        DIACHI NVARCHAR(200) DEFAULT 'Chưa cập nhật',
        SODT BIGINT DEFAULT 0,
        GIOITINH NVARCHAR(200),
        EMAIL VARCHAR(100) DEFAULT 'Chưa cập nhật',
        PHANQUYEN VARCHAR(10) DEFAULT 'user',
        PRIMARY KEY (TENDANGNHAP, SODT)
    )";
    if (!mysqli_query($conn, $NGUOIDUNG)) {
        die("Không thể tạo bảng NGUOIDUNG: " . mysqli_error($conn));
    }
    echo "Đã tạo hoặc xác nhận bảng NGUOIDUNG.<br>";

    // Thêm dữ liệu vào bảng NGUOIDUNG
    $DataNGUOIDUNG = "INSERT INTO NGUOIDUNG 
    (MAND, TENDANGNHAP, MATKHAU, HOTEN, DIACHI, SODT, GIOITINH, EMAIL, PHANQUYEN)
    VALUES 
    ('TT1', 'hehe', '123', 'Nguyễn Văn Chuối', '123 abc', 0987654321, 'Nam', 'abc@abc.com', 'admin'),
    ('TT2', 'haha', '123', 'duong', 'asdasdasd', 091236548, 'Nam', 'abc@gmail.com', 'user')
    
    ";

    if (!mysqli_query($conn, $DataNGUOIDUNG)) {
        die("Không thể thêm dữ liệu vào bảng NGUOIDUNG: " . mysqli_error($conn));
    }
    echo "Đã thêm dữ liệu vào bảng NGUOIDUNG.<br>";
    // Tạo bảng DANHMUC
    $DANHMUC = "CREATE TABLE IF NOT EXISTS DANHMUC (
        MADM VARCHAR(50) NOT NULL,
        TENDM NVARCHAR(200) NOT NULL,
        PRIMARY KEY (MADM)
    )";

    if (!mysqli_query($conn, $DANHMUC)) {
        die("Không tạo được bảng DANHMUC: " . mysqli_error($conn));
    }

    // Thêm dữ liệu vào bảng DANHMUC
    $DataDANHMUC = "INSERT INTO DANHMUC (MADM, TENDM) VALUES
        ('DM1', 'Deal Thơm'),
        ('DM2', 'New Arrivals'),
        ('DM3', 'Best Seller'),
        ('DM4', 'Mini & Travel Size'),
        ('DM5', 'Gift Set')";
        

    if (!mysqli_query($conn, $DataDANHMUC)) {
        die("Không thêm được dữ liệu vào bảng DANHMUC: " . mysqli_error($conn));
    }

    // Tạo bảng SANPHAM
    $SANPHAM = "CREATE TABLE IF NOT EXISTS SANPHAM (
        MASP VARCHAR(50) NOT NULL,
        TENSP NVARCHAR(200) NOT NULL,
        GIA DOUBLE NOT NULL,
        MADM VARCHAR(50) NOT NULL,
        HINHANH NVARCHAR(200),
        PRIMARY KEY (MASP),
        FOREIGN KEY (MADM) REFERENCES DANHMUC(MADM)
    )";

    if (!mysqli_query($conn, $SANPHAM)) {
        die("Không tạo được bảng SANPHAM: " . mysqli_error($conn));
    }
    // Thêm dữ liệu vào bảng SANPHAM
    $DataSANPHAM = "INSERT INTO SANPHAM (MASP, TENSP, GIA, MADM, HINHANH) VALUES
        ('SP1', 'Versace Pour Femme Dylan Purple', 1500000 , 'DM1', 'anh/1.webp'),
        ('SP2', 'Valentino Uomo Born In Roma Yellow Dream', 2080000, 'DM1', 'anh/2.webp'),
        ('SP3', 'Valentino Donna Born In Roma Yellow Dream', 2530000, 'DM1', 'anh/3.jpg'),
        ('SP4', 'Marc Jacobs Daisy Ever So Fresh', 1580000, 'DM1', 'anh/4.webp'),
        ('SP5', 'Jo Malone London Wild Bluebell Cologne Limited Edition', 3350000, 'DM1', 'anh/5.webp'),
        ('SP6', 'HERMES Kelly Caleche Eau de Parfum Travel Spray', 760000, 'DM1', 'anh/6.webp'),

        ('SP7', 'Hugo Boss Bottled Elixir', 2880000, 'DM2', 'anh/7.webp'),
        ('SP8', 'Jean Paul Gaultier Le Beau Paradise Garden', 2590000, 'DM2', 'anh/8.webp'),
        ('SP9', 'Argos Triumph of Bacchus Extrait', 8900000, 'DM2', 'anh/9.webp'),
        ('SP10', 'Ralph Lauren Polo Red Parfum', 4250000, 'DM2', 'anh/10.webp'),
        ('SP11', 'Mugler Alien Goddess Supra Florale', 3350000, 'DM2', 'anh/11.webp'),
        ('SP12', 'MCM Onyx Eau de Parfum', 1380000, 'DM2', 'anh/12.webp'),

        ('SP13', 'Gucci Bloom Eau de Parfum For Her', 3200000, 'DM3', 'anh/13.webp'),
        ('SP14', 'Giorgio Armani Acqua Di Gio Pour Homme', 1680000, 'DM3', 'anh/14.webp'),
        ('SP15', 'Carolina Herrera Good Girl Eau de Parfum', 1830000, 'DM3', 'anh/15.webp'),
        ('SP16', 'Tommy Hilfiger Tommy', 830000, 'DM3', 'anh/16.webp'),
        ('SP17', 'Salvatore Ferragamo Signorina Eau de Parfum', 1350000, 'DM3', 'anh/17.webp'),
        ('SP18', 'Versace Pour Homme', 1880000, 'DM3', 'anh/18.webp'),

        ('SP19', 'Gucci Flora Gorgeous Jasmine Mini Size', 480000, 'DM4', 'anh/19.webp'),
        ('SP20', 'Moschino Toy 2 Mini Size', 380000, 'DM4', 'anh/20.webp'),
        ('SP21', 'Burberry Goddess Eau de Parfum Mini Size', 360000, 'DM4', 'anh/21.webp'),
        ('SP22', 'Calvin Klein CK One Travel Size', 360000, 'DM4', 'anh/22.webp'),
        ('SP23', 'Marc Jacobs Daisy Eau So Fresh Mini Size', 320000, 'DM4', 'anh/23.webp'),
        ('SP24', 'Salvatore Ferragamo Signorina Libera Mini Size', 320000, 'DM4', 'anh/24.webp'),
        
        ('SP25', 'Gift Set Gucci Guilty Pour Homme Eau de Parfum', 3600000, 'DM5', 'anh/25.webp'),
        ('SP26', 'Gift Set Make Me Blush', 1249000, 'DM5', 'anh/26.webp'),
        ('SP27', 'Gift Set Gucci Flora Gorgeous Magnolia', 3920000, 'DM5', 'anh/27.webp'),
        ('SP28', 'Gift Set Paco Rabanne 1 Million', 3030000, 'DM5', 'anh/28.webp'),
        ('SP29', 'Gift Set Moschino Toy Boy', 2300000, 'DM5', 'anh/29.webp'),
        ('SP30', 'Mini Set Montblanc Discovery Kit Explorer', 480000, 'DM5', 'anh/30.webp')";
    if (!mysqli_query($conn, $DataSANPHAM)){
        die("Không thêm được dữ liệu vào bảng SANPHAM: " . mysqli_error($conn));
    }
    echo "Đã thêm dữ liệu vào bảng SANPHAM.<br>";

    // đóng kết nối
    closeconnection($conn);
?>