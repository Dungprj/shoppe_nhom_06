<?php
require "./conect.php";

session_start();
if(isset($_POST["login"]))
{
    $username = $_POST["txt_username"];
    $password = $_POST["txt_password"];
    $sql = "select * from tbl_user where username = '".$username."' and password = '".$password."'";
    $result = mysqli_query($conn,$sql);
    

if (mysqli_num_rows($result)>0)
{
  $_SESSION["user"] = $username;
	while ($row = mysqli_fetch_assoc($result))
	{
		$_SESSION["avata"] = $row['avata'];
    $_SESSION["id_user"] = $row['id_user'];
  } 
  header("Location:./trangchu.php");
}else
{
  echo "dang nhap that bai";
  header("Location:./dang_nhap.php");
}
}

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
    />
    <link
      rel="stylesheet"
      href="./fontawesome-free-6.4.2-web/fontawesome-free-6.4.2-web/css/reset.css"
    />
    <link rel="stylesheet" href="./css/dang_nhap.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
      integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="./responsive.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Đăng Nhập</title>
  </head>
  <body>
    <div>
      <div class="container header-dangnhap">
        <div class="dang-nhap__left">
          <a href="./index.html">
            <img
              class="dang-nhap__logo"
              src="./img/shopee-logo__dangky.png"
              alt="logo"
            />
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
        <form  method="post" action="./dang_nhap.php">
        <div class="container dang-nhap__form">
          <h4 class="form_heading">Đăng nhập</h4>
          <input
            class="form-input__phone"
            type="text"
            placeholder="Email / Số điện thoại / Tên đăng nhập"
            id="fname"
            name="txt_username"
          />
          <br />
          <input
            class="form-input__password"
            type="text"
            placeholder="Mật khẩu"
            id="fname"
            name="txt_password"
          />
          <button type="submit"class="form-input__btn" name="login">ĐĂNG NHẬP</button>
          <div class="form-convenient">
            <a class="form-convenient__text" href="#!">Quên mật khẩu</a>
            <a class="form-convenient__text" href="#!">Đăng nhập với SMS</a>
          </div>
          <div class="form-input__social">
            <div class="form-social__fb">
              <i class="fa-brands fa-facebook"></i>
              <span>Facebook</span>
            </div>
            <div class="form-social__gg">
              <i class="fa-brands fa-google"></i>
              <span>Google</span>
            </div>
          </div>
          <div class="form-des__input">
            <p>Bạn mới biết đến Shopee? <a class="form-des__text" href="./dang_ky.html">Đăng ký</a> </p>
          </div>
        </div>

        </form>
        
      </div>
    </div>
  </body>
</html>
