<?php
    require("./config.php");    

    if(isset($_GET["task"]) && $_GET["task"] == "update") {
        $id = $_GET["ID"];
        if(isset($_POST["btn_update"])) {
            $user_name = $_POST["txt_username"];
            $password = $_POST["txt_password"];
            $re_password = $_POST["txt_password_re"];
            // $ID = $_POST["txt_ID"];
            $fullname = $_POST["txt_fullname"];
            $email = $_POST["txt_email"];

            if ($password!=$re_password){
                echo "Mat khau khong trung";
            }
            else{
                $sql_update = "update tbl_users set user_login = N'".$user_name."', user_pass = ".$password.", display_name = ".$fullname.", user_email = ".$email."  where ID =" .$id."";
                if (mysqli_query($conn, $sql_update)) {
                    header("location:manage_user.php");
                    echo "update thanh cong";
                }
                else {
                    echo "Error: " .$sql . "</br>" . mysqli_error($conn); 
                }
        }
    }
}

?>

<html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" />
            <!-- <link rel="stylesheet" href="../css/bootstrap.bundle.min.js">         -->
        <style>
            h1{
                text-align: center;
            }
        </style>
    </head>

    <body style="background-color: ffffcc;">
        <div class="container">
            <h1>TRANG CẬP NHẬT NGƯỜI DÙNG</h1>

            <form action="update_user.php" method="post" >
                
                <input type="text" placeholder="Họ và Tên" class="form-control" name="txt_fullname" />
                <br>
                <input type="text" placeholder="Tên đăng nhập" class="form-control" name="txt_username" />
                <br>
                <input type="password" placeholder="Mật Khẩu" class="form-control" name="txt_password" />
                <br>
                <input type="password" placeholder="Nhập lại mật khẩu" class="form-control" name="txt_password_re" />
                <br>
                <input type="text" placeholder="Email" class="form-control" name="txt_email" />
                <br>
                <input class="btn btn-primary" name="btn_update" type="submit" value="Cập nhật">
                <input type="submit" value="Cancel" name="btn_cancel" class="btn btn-danger">

            </form>

            <!-- <div class="row">
                <div class="col-6">
                <table class="table tabke-stripped">
                    <tr>
                    <th>ID</th>
                    <th>Tên Đăng Nhập</th>
                    <th>Mật Khẩu</th>
                    <th>Họ và Tên</th>
                    <th>Email</th>
                    <th>Trang Thai</th>
                    <th>Admin</th>


                    </tr> -->
                
                    <!-- gửi dữ liệu qua form thông thường dùng qua post -->
                    <!-- <form action="update_user.php" method="post"> -->
                        
                        <!-- <br>

                    </form>

                        </table> -->
                </div>

            </div>

        </div>
    </body>
</html>