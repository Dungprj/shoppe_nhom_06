<?php
  require("../conect.php");
  require("./admin.php");
  if(isset($_POST["btn_update"])) {

    $product_id = $_POST['id_product'];
    // $cate_name = $_POST["txt_cate_name"];
    $cate_id = $_POST["cate"];
    $product_name = $_POST["txt_product_name"];
    $product_minvalue = $_POST["txt_product_minvalue"];
    $product_maxvalue = $_POST["txt_product_maxvalue"];
    $product_desc = $_POST["txt_product_desc"];
    $image = $_POST["img"];
    $product_quantity = $_POST["txt_product_quantity"];
    
    $sql_update = "update tbl_product set category = ".$cate_id.", name = N'".$product_name."', min_price = ".$product_minvalue.", max_price = ".$product_maxvalue.", description = '".$product_desc."', image = '".$image  ."', quantity = ".$product_quantity." where id =" .$product_id;
        if (mysqli_query($conn, $sql_update)) {
            header("location:manage_product.php");
            // echo "New record created successfully";
        }
        else {
            echo "Error: " .$sql . "</br>" . mysqli_error($conn); 
        }
    }

    if(isset($_POST["btn_cancel"])) {
        header("location: manage_product.php");
        exit();   
    }


?>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Document</title>
  </head>
  <body>
    <div class="container">
      <h1 style="text-align: center">TRANG CẬP NHẬT SẢN PHẨM</h1>
      <div class="row">
        <div class="col-6">
        <form action="update_product.php" method="post" enctype="multipart/form-data">
            Chọn danh mục:
            <select class="form-control" name="cate" id="">
                <?php
                 if(isset($_GET["task"]) && $_GET["task"]=="update") {
                  $id = $_GET["id"];
                    $sql = "select * from tbl_category where id = " .$id;                             
                    //Khai báo sql, liên kết sql hiển thị bảng
                    $result = mysqli_query($conn,$sql);               
                    if(mysqli_num_rows($result)>0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            echo"<option value='".$row["id"]."'>".$row["catename"]."</option>";
                        }                                
                    }
        
                  $sql_select = "select * from tbl_product where id = " .$id;                             
                  //Khai báo sql, liên kết sql hiển thị bảng
                  $result = mysqli_query($conn,$sql_select);
                  if(mysqli_num_rows($result)>0) {
                     // Hiển thị các cột dữ liệu
                     while($row = mysqli_fetch_assoc($result)) {
                          echo "<input type='hidden' name='id_product' value ='".$row["id"]."'>";
                           echo "Nhập vào tên sản phẩm:";
                           echo "<input class='form-control' value ='".$row["name"]."' type='text' name='txt_product_name' required id=''>";
                           echo "Nhập vào min-value:";
                           echo "<input class='form-control' value ='".$row["min_price"]."' type='text' name='txt_product_minvalue' required id=''>";
                           echo "Nhập vào max-value:";
                           echo "<input class='form-control' value ='".$row["max_price"]."' type='text' name='txt_product_maxvalue' required id=''>";
                           echo "Nhập vào mô tả sản phẩm:";
                           echo "<input class='form-control' value ='".$row["description"]."' type='text' name='txt_product_desc' required id=''>";
                           echo "Chọn ảnh đại diện cho sản phẩm:";
                           echo "<input class='form-control' value ='".$row["image"]."' type='text' name='img' required id=''>";
                           echo "Nhập vào số lượng sản phẩm:";
                           echo "<input class='form-control' value ='".$row["quantity"]."' type='text' name='txt_product_quantity' required id=''>";
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