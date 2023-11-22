<?php
    require "../conect.php";
    require "./admin.php";


    if(isset($_POST["btn_update"])) {
        
       

        $user_name = $_POST["txt_username"];
        $password = $_POST["txt_password"];
        $re_password = $_POST["txt_password_re"];
        $user_id = $_POST["txt_id"];
        $fullname = $_POST["txt_fullname"];
        $email = $_POST["txt_email"];
        $admin = $_POST["txt_admin"];
        $phone = $_POST["txt_phone"];
        $date_of_birth = $_POST["txt_date"];
        $gender = $_POST["gender"];


        if ($password!=$re_password){
            echo "Mat khau khong trung";
        }
        else{
            $sql_update = "update tbl_user set username = '".$user_name."', password = md5('".$password."'), name = '".$fullname."', email = '".$email."', admin = '".$admin."', phone = '".$phone."', date_of_birth = '".$date_of_birth."', gender = '".$gender."'  where id_user = '".$user_id."'";
            if (mysqli_query($conn, $sql_update)) {
                header("location:manage_user.php");
                $_SESSION["user_name"] = $user_name;
                $_SESSION["admin"] = $admin;
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
                    $id = $_GET["id_user"];
                    $sql_select = "select * from tbl_user where id_user = " .$id;                             
                    //Khai báo sql, liên kết sql hiển thị bảng
                    $result = mysqli_query($conn,$sql_select);
                    if(mysqli_num_rows($result)>0) {
                        // Hiển thị các cột dữ liệu
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<input type='hidden' name='txt_id' value ='".$row["id_user"]."'>";
                            echo "<br>";
                          
                            
                            echo "<br>";
                            echo "Nhập họ và tên: ";
                            echo "<input type='text' placeholder='Họ và Tên' class='form-control' value='".$row["name"]."' name='txt_fullname' />";
                            echo "Nhập vào tên đăng nhập:";
                            echo "<input type='text' placeholder='Tên đăng nhập' class='form-control' value='".$row["username"]."' name='txt_username' />";
                            echo "Nhập vào mật khẩu:";
                            echo "<input type='password' placeholder='Mật Khẩu' class='form-control' value='".$row["password"]."' name='txt_password' />";
                            echo "Nhap lai mat khau";
                            echo "<input type='password' placeholder=' Nhập Lại Mật Khẩu' class='form-control' value='".$row["password"]."' name='txt_password_re' />";
                            echo "Ngày Sinh";
                            echo "<br>";
                            echo "<input style='margin-left: 10px;' type='date' value='".$row["date_of_birth"]."' name='txt_date'>";
                            echo "<br>";
                            echo "Giới Tính";
                            echo "<br>";
                            if($row["gender"]== 1) {
                                echo "<input type='radio' name='gender' value='1' checked> Nam";
                                echo "<input type='radio' name='gender' value='0'> Nữ";
                            }
                            if($row["gender"]== 0) {
                                echo "<input style='margin-left: 10px;' type='radio' name='gender' value='1'> Nam";
                                // echo "<br>";
                                echo "<input style='margin-left: 20px;' type='radio' name='gender' value='0' checked> Nữ";
                            }
                            if($row["gender"]== "NULL") {
                                echo "<input style='margin-left: 10px;' type='radio' name='gender' value='1'> Nam";
                                // echo "<br>";
                                echo "<input style='margin-left: 20px;' type='radio' name='gender' value='0'> Nữ";
                            }
                            
                            // echo "gioi tinh";
                            // echo "<input type='radio' name='gender' value='1'> Male";
                            // echo "<input type='radio' name='gender' value='0'> Female";
                            echo "<br>";
                            echo "Nhập vào email:";
                            echo "<input type='text' placeholder='Email' class='form-control' value='".$row["email"]."' name='txt_email' />";
                            echo "Nhập số điện thoại:";
                            echo "<input type='text' placeholder='Phone' class='form-control' value='".$row["phone"]."' name='txt_phone' />";
                            echo "<br>";
                            echo "Admin:";
                            echo "(1: Kích Hoạt , 0: Chưa Kích Hoạt)";
                            echo "<br>";
                            echo "<input type='text' placeholder='Admin' class='form-control' value='".$row["admin"]."' name='txt_admin' />";
                            echo "<br>";
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