<?php
session_start();
require "./myfunc.php";

if (isset($_SESSION["cart"])) {

    

}

if(isset($_GET["delid"])&&($_GET["delid"]>=0))
{
    array_splice($_SESSION["cart"], $_GET["delid"],1);
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>view cart</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

    <div class="container-fluid">

        <div class="container">
        <h2>ĐƠN HÀNG CỦA BẠN</h2>
            <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col">STT</th>
                <th scope="col">Hình</th>
                <th scope="col">Tên sản phẩm</th>
                <th scope="col">Đơn giá</th>
                <th scope="col">Số lượng</th>
                <th scope="col">Thành tiền</th>
                <th scope="col"> Xóa</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if(isset($_SESSION["cart"])&&sizeof($_SESSION["cart"])>0)
                {
                    echo showcart($_SESSION["cart"]);
                }else
                {
                    echo "Giỏ hàng rỗng";
                }
                
                ?>
                
            </tbody>
            </table>

            <p><a href="./sanpham.php">Tiếp tục đặt hàng</a></p>
            <p><a href="./delcart.php">Xóa toàn bộ đơn hàng</a></p>

        </div>
        <?php
    if(!isset($_SESSION["cart"]))
    {
        echo "ban chua dat hang . Ban <a href='./sanpham.php'>Đặt hàng </a> đi";
    }
    ?>
    </div>

    
    
</body>
</html>


