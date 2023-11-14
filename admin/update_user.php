<?php
    require("./config.php");    
    if(isset($_POST["btn_update"])) {
        $user_name = $_POST["txt_username"];
        $password = $_POST["txt_password"];
        $re_password = $_POST["txt_password_re"];
        $user_id = $_POST["txt_id"];
        $fullname = $_POST["txt_fullname"];
        $email = $_POST["txt_email"];
        $admin = $_POST["txt_admin"];

        if ($password!=$re_password){
            echo "Mat khau khong trung";
        }
        else{
            $sql_update = "update tbl_users set user_login = '".$user_name."', user_pass = md5('".$password."'), display_name = '".$fullname."', user_email = '".$email."', admin = '".$admin."'  where ID = '".$user_id."'";
            if (mysqli_query($conn, $sql_update)) {
                header("location:manage_user.php");
                echo "update thanh cong";
            }
            else {
                echo "Error: " .$sql . "</br>" . mysqli_error($conn); 
            }
        }
    }
    if (isset($_POST["btn_cancel"])) {
        header("location: manage_user.php");
        exit();
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
            <?php
                            if(isset($_GET["task"]) && $_GET["task"]=="update") {
                                $id = $_GET["ID"];
                                $sql_select = "select * from tbl_users where ID = " .$id;                             
                                //Khai báo sql, liên kết sql hiển thị bảng
                                $result = mysqli_query($conn,$sql_select);
                                if(mysqli_num_rows($result)>0) {
                                    // Hiển thị các cột dữ liệu
                                    while($row = mysqli_fetch_assoc($result)) {
                                        echo "<input type='hidden' name='txt_id' value ='".$row["ID"]."'>";
                                        echo "Nhập họ và tên: ";
                                        echo "<input type='text' placeholder='Họ và Tên' class='form-control' value='".$row["display_name"]."' name='txt_fullname' />";
                                        echo "Nhập vào tên đăng nhập:";
                                        echo "<input type='text' placeholder='Tên đăng nhập' class='form-control' value='".$row["user_login"]."' name='txt_username' />";
                                        echo "Nhập vào mật khẩu:";
                                        echo "<input type='password' placeholder='Mật Khẩu' class='form-control' value='".$row["user_pass"]."' name='txt_password' />";
                                        echo "Nhap lai mat khau";
                                        echo "<input type='password' placeholder=' Nhap lai Mật Khẩu' class='form-control' value='".$row["user_pass"]."' name='txt_password_re' />";
                                        echo "Nhập vào email:";
                                        echo "<input type='text' placeholder='Email' class='form-control' value='".$row["user_email"]."' name='txt_email' />";
                                        echo "Admin:";
                                        echo "(1: Kich Hoat , 0: Chua Kich Hoat)";
                                        echo "<input type='text' placeholder='Admin' class='form-control' value='".$row["admin"]."' name='txt_admin' />";
                                    }
                                }
                            }
                        ?>

                <input class="btn btn-primary" name="btn_update" type="submit" value="Cập nhật">
                <input type="submit" value="Cancel" name="btn_cancel" class="btn btn-danger">

            </form>

                </div>

            </div>

        </div>
    </body>
</html>