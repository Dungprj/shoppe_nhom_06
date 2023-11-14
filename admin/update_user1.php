<?php
    require("./config.php");    


    if(isset($_POST["btn_update"])) {
        $user_name = $_POST["txt_username"];
        $password = $_POST["txt_password"];
        $ID = $_POST["txt_ID"];
        $fullname = $_POST["txt_fullname"];
        $email = $_POST["txt_email"];

        $sql_update = "update tbl_users set user_login = N'".$user_name."', user_pass = ".$password.", display_name = ".$fullname.", user_email = ".$email."  where ID =" .$cate_ID;
        if (mysqli_query($conn, $sql_update)) {
            header("location:manage_user.php");
            // echo "New record created successfully";
        }
        else {
            echo "Error: " .$sql . "</br>" . mysqli_error($conn); 
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
            <div class="row">
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


                    </tr>
                
                    <!-- gửi dữ liệu qua form thông thường dùng qua post -->
                    <form action="update_user.php" method="post">
                        
                        
                        
                        <?php
                            if(isset($_GET["task"]) && $_GET["task"]=="update") {
                                $ID = $_GET["ID"];
                                $sql_select = "select * from tbl_users where ID = " .$ID."";                             
                                //Khai báo sql, liên kết sql hiển thị bảng
                                $result = mysqli_query($conn,$sql_select);
                                if(mysqli_num_rows($result)>0) {
                                    // Hiển thị các cột dữ liệu
                                    while($row = mysqli_fetch_assoc($result)) {
                                        echo "<tr>";
                                        echo "<td>".$row["ID"]."</td>";
                                        echo "<td>".$row["user_login"]."</td>";
                                        echo "<td>".$row["user_pass"]."</td>";
                                        echo "<td>".$row["display_name"]."</td>";
                                        echo "<td>".$row["user_email"]."</td>";
                                        if ($row["user_status"] == 1) {
                                            echo "<td>"."Đã kích hoạt"."</td>";
                                        } else {
                                            echo "<td>"."Chưa kích hoạt"."</td>";
                                        }
                                        if ($row["admin"] == 1) {
                                            echo "<td>"."Đã kích hoạt"."</td>";
                                        } else {
                                            echo "<td>"."Chưa kích hoạt"."</td>";
                                        }
                                    }
                                }
                            }
                        ?>
                        <br>

                    </form>

                        </table>
                </div>

            </div>
            <input class="btn btn-primary" name="btn_update" type="submit" value="Cập nhật">
                        <input type="submit" value="Cancel" name="btn_cancel" class="btn btn-danger">
        </div>
    </body>
</html>