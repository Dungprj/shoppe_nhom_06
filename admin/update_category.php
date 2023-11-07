<?php
    require("./config.php");    
    if(isset($_POST["btn_update"])) {
        $cate_name = $_POST["txt_cate_name"];
        $cate_id = $_POST["txt_cate_id"];
        $status = $_POST["txt_status"];
        $sql_update = "update tbl_category set catename = N'".$cate_name."', status = ".$status." where id =" .$cate_id;
        if (mysqli_query($conn, $sql_update)) {
            header("location:manage_cate.php");
            // echo "New record created successfully";
        }
        else {
            echo "Error: " .$sql . "</br>" . mysqli_error($conn); 
        }
    }

?>

<html>
    <head>
            <link rel="stylesheet" href="../css/bootstrap.min.css">
            <!-- <link rel="stylesheet" href="../css/bootstrap.bundle.min.js">         -->
        <style>
            h1{
                text-align: center;
            }
        </style>
    </head>

    <body style="background-color: ffffcc;">
        <div class="container">
            <h1>TRANG CẬP NHẬT DANH MỤC</h1>
            <div class="row">
                <div class="col-6">
                    <!-- gửi dữ liệu qua form thông thường dùng qua post -->
                    <form action="update_category.php" method="post">
                        <?php
                            if(isset($_GET["task"]) && $_GET["task"]=="update") {
                                $id = $_GET["id"];
                                $sql_select = "select * from tbl_category where id = " .$id;                             
                                //Khai báo sql, liên kết sql hiển thị bảng
                                $result = mysqli_query($conn,$sql_select);
                                if(mysqli_num_rows($result)>0) {
                                    // Hiển thị các cột dữ liệu
                                    while($row = mysqli_fetch_assoc($result)) {
                                        echo "<input type='hidden' name='txt_cate_id' value ='".$row["id"]."'>";
                                        echo "Nhập vào tên danh mục:";
                                        echo "<input class='form-control' value ='".$row["catename"]."' type='text' name='txt_cate_name' required id=''>";
                                        echo "Nhập vào trạng thái danh mục:";
                                        echo "<input class='form-control' value ='".$row["status"]."' type='text' name='txt_status' required id=''>";
                                    }
                                }
                            }
                        ?>
                        <br>
                        <input class="btn btn-primary" name="btn_update" type="submit" value="Cập nhật">
                        <input type="submit" value="Cancel" name="btn_cancel" class="btn btn-danger">
                    </form>

                </div>
            </div>
        </div>
    </body>
</html>