<!-- sql injection
ma hoa, ipa,token -->

<!-- <?php
    require "./conect.php";

    if(isset($_POST["btn_register"])){
      
        $user_name = $_POST["txt_username"];
        $password = $_POST["txt_password"];
        $re_password = $_POST["txt_password_re"];
        $fullname = $_POST["txt_fullname"];
        $email = $_POST["txt_email"];

        if ($password!=$re_password){
            echo "Mat khau khong trung";

        }
        else{
            $sql = "select * from tbl_user where username = '".$user_name."' ";
            $result = mysqli_query($conn,$sql);
            if(mysqli_num_rows($result)>0){
                echo "Ten dang nhap da ton tai";

            }
            else{
                $sql_insert = "insert into tbl_user(username,password,email,name,admin) values('".$user_name."',md5('".$password."'),'".$email."','".$fullname."',0)";
                if (mysqli_query($conn, $sql_insert)){
                    echo " dang ki thanh cong";
                    header("location:login.php");

                }
                else{
                    echo "Error: " .$sql_insert . "br" . mysqli_error($conn);
                }
            }
        }
    }

?> -->



<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="./fontawesome-free-6.4.2-web/fontawesome-free-6.4.2-web/css/reset.css" />
  <link rel="stylesheet" href="./css/dang_ky.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="./css/responsive.css">
  <script src="./jquery-3.7.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

  <script> 
  

  $(document).ready(function(){
    $("#txt_username").blur(function(){
      var name = $(this).val();
      $.get("./admin/checkUserName.php",{user_name:name},function(data){
        if ( data ==0 ){
          $("#LoiUserName").html("Tên người dùng hợp Lệ");
          $("#LoiUserName").css("color","blue");
          $
        }else{
          $("#LoiUserName").html("Tên người dùng đã được sử dụng");
          $("#LoiUserName").css("color","red");
        }
      });
    });
  });


  </script>
  <title>Đăng Ký</title>
</head>

<body>
  <div>
    <div class="container header-dangky">
      <div class="dang-ky__left">
        <a href="./index.html">
          <img class="dang-ky__logo" src="./img/shopee-logo__dangky.png" alt="logo" />
        </a>
        <h2 class="dang-ky__heading">Đăng ký</h2>
      </div>
      <div class="dang-ky__right">
        <p>Bạn cần giúp đỡ ?</p>
      </div>
    </div>
    <div class="dang-ky__fullbanner">
      <div class="container background-dangky">
        <div class="dang-ky__banner">
          <img src="./img/dang_ky_bg.png" alt="" />
        </div>
      </div>
      <div class="background_temporary"></div>
      <div class="container dang-ky__form">

        <h4 style="text-align: center">Đăng Kí</h4>
            <form action="register.php" method="post" >
                
                <input type="text" placeholder="Họ và Tên" class="form-control" name="txt_fullname" id="txt_fullname" />
                <br>
                <input type="text" placeholder="Tên đăng nhập" class="form-control" name="txt_username" id="txt_username" />
                <div id="LoiUserName"></div>
                <br>
                <input type="password" placeholder="Mật Khẩu" class="form-control" name="txt_password" id="txt_password" />
                <br>
                <input type="password" placeholder="Nhập lại mật khẩu" class="form-control" name="txt_password_re" id="txt_password_re" />
                <br>
                <input type="text" placeholder="Email" class="form-control" name="txt_email" id="txt_email" />
                <br>
                <input  type="submit" class="form-input__btn btn btn-primary" name="btn_register" id="insert" value="Đăng Kí" />

                <p id= "ketqua"></p>
                
            </form>
        
        <div class="form-dangnhap">
          Bạn đã có tài khoản?
          <a class="form-des__text" href="./login.php">Đăng nhập</a>
        </div>
      </div>
    </div>
  </div>
</body>

</html>