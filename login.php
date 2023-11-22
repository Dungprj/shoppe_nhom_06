<?php
  session_start();
  require "./conect.php";
  
  

  if(isset($_POST["btn_login"])) {
    $user_name = $_POST["txt_username"];
    $password = $_POST["txt_password"];
    $sql = "select * from tbl_user where username= '". $user_name ."' and password = md5('". $password ."')";
    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)>0) {
      $_SESSION["user_name"] = $user_name;
      header("location:./trangchu.php");
    } else {
      echo "Sai ten dang nhap hoac mat khau";
    }
  }


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="./fontawesome-free-6.4.2-web/fontawesome-free-6.4.2-web/css/reset.css" />
  <link rel="stylesheet" href="./css/dang_nhap.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="./responsive.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <title>Đăng Nhập</title>
</head>

<body>
  <div>
    <div class="container header-dangnhap">
      <div class="dang-nhap__left">
        <a href="./index.html">
          <img class="dang-nhap__logo" src="./img/shopee-logo__dangky.png" alt="logo" />
        </a>
        <h2 class="dang-nhap__heading">Đăng nhập</h2>
      </div>
      <div class="dang-nhap__right">
        <p>Bạn cần giúp đỡ ?</p>
      </div>
    </div>
    <div class="dang-nhap__fullbanner">
      <div class="container background-dangnhap">
        <div class="dang-nhap__banner">
          <img src="./img/dang_ky_bg.png" alt="" />
        </div>
      </div>
      <div class="background_temporary"></div>
      <div class="container dang-nhap__form">
        <h4 class="form_heading">Đăng nhập</h4>
        <!-- <input class="form-input__phone" type="text" placeholder="Tên đăng nhập"
          name="txt_username" />
        <br />
        <input class="form-input__password" type="password" placeholder="Mật khẩu" name="txt_password" />
        <button class="form-input__btn" name="btn_login">ĐĂNG NHẬP</button> -->
        
        <form action="login.php" method="post" >

                <input type="text" placeholder="Tên đăng nhập" class="form-control" name="txt_username" />
                <br>
                <input type="password" placeholder="Mật Khẩu" class="form-control" name="txt_password" />
                <br>
                <input  type="submit" class="form-input__btn btn btn-primary" name="btn_login" value="Đăng Nhập" />
            </form>



        <div class="form-dangnhap">
          Bạn chưa có tài khoản?
          <a class="form-des__text" href="./register.php">Đăng Ký</a>
        </div>
        <!-- <div class="form-des__input">
          <p>Bạn mới biết đến Shopee? <a class="form-des__text" href="./dang_ky.html">Đăng ký</a> </p>
        </div> -->
      </div>
    </div>
  </div>
</body>

</html>