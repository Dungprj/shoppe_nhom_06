<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>add to cart</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <div class="container-fluid bl_fex">
        <div class="container">
            <div class="boxsp">
                <form action="addtocart.php" method="post">
                    <img src="./img/dienthoai.webp" alt="">
                    <p>Điện thoại 1</p>
                    <p>Gia : <span>13.000.000</span> dong</p>
                    <input type="hidden" name="img" value="./img/dienthoai.webp">
                    <input type="hidden" name="tensp" value="Dien thoai 1">
                    <input type="hidden" name="gia" value="13000000">
                    <input type="hidden" name="id" value="1">
                    <input type="submit"  name ="dathang" value="Đặt hàng">
                    <label for="quantity">Số lượng:</label>
                    <input type="text" name="quantity" id="quantity">


                </form>
            </div>
        </div>
        <div class="container">
            <div class="boxsp">
                <form action="addtocart.php" method="post">
                    <img src="./img/dienthoai.webp" alt="">
                    <p>Điện thoại 2</p>
                    <p>Gia : <span>13.000.000</span> dong</p>
                    <input type="hidden" name="img" value="./img/dienthoai.webp">
                    <input type="hidden" name="tensp" value="Dien thoai 2">
                    <input type="hidden" name="gia" value="13000000">
                    <input type="hidden" name="id" value="2">
                    <input type="submit" name ="dathang" value="Đặt hàng">
                    <label for="quantity">Số lượng:</label>
                    <input type="text" name="quantity" id="quantity">


                </form>
            </div>
        </div>
        <div class="container">
            <div class="boxsp">
                <form action="addtocart.php" method="post">
                    <img src="./img/dienthoai.webp" alt="">
                    <p>Điện thoại 3</p>
                    <p>Gia : <span>13.000.000</span> dong</p>
                    <input type="hidden" name="img" value="./img/dienthoai.webp">
                    <input type="hidden" name="tensp" value="Dien thoai 3">
                    <input type="hidden" name="gia" value="13000000">
                    <input type="hidden" name="id" value="3">
                    <input type="submit" name ="dathang" value="Đặt hàng">
                    <label for="quantity">Số lượng:</label>
                    <input type="text" name="quantity" id="quantity">


                </form>
            </div>
        </div>

    </div>
    
</body>
</html>