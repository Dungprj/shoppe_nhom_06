<?php
  require("../conect.php");
  require("./admin.php");

  // if(!$_SESSION["user"]) {
  //   header("location:../login.php");
  // } 
  // echo"Xin chao thanh vien" . $_SESSION["user"];

  // thêm
  if(isset($_POST["btn_insert"])) {
    $cate_id = $_POST['cate'];
    $product_name = $_POST["txt_product_name"];
    $product_minvalue = $_POST["txt_product_minvalue"];
    $product_maxvalue = $_POST["txt_product_maxvalue"];
    $product_desc = $_POST["txt_product_desc"];
    $product_quantity = $_POST["txt_product_quantity"];
    
    $target_dir = "../img_product/";
    $target_file = $target_dir . basename($_FILES["img"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    //kiem tra dinh dang file anh
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    if($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
    }
    else {
      if(move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
        $image_name = basename($_FILES["img"]["name"]);
        $sql_insert = "insert into tbl_product(name, min_price, max_price, description, image, category, quantity) 
                  values(N'" .$product_name. "', ".$product_minvalue.", ".$product_maxvalue.", '".$product_desc."',     '".$image_name."', ".$cate_id.", " .$product_quantity. ")";
        if(mysqli_query($conn, $sql_insert)) {
          header("location:manage_product.php");
        } 
        else {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
      } 
      else {
        echo "Sorry, there was an error uploading your file.";
      }
    } 
  }

  // xóa
  if(isset($_GET["task"]) && $_GET["task"] == "delete") {
    $id = $_GET["id"];
    $sql_delete = "delete from tbl_product where id = " . $id;
    if(mysqli_query($conn, $sql_delete)) {
      echo "Xoa thanh cong";
      header("location:manage_product.php");
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
  }

  //delete check
  if(isset($_POST["delete_check"])) {
    if(isset($_POST["prod"])) {
      $prod = $_POST["prod"];
      foreach($prod as $c) {
        echo $c;
        $sql_delete = "delete from tbl_product where id = " . $c;
        if(mysqli_query($conn, $sql_delete)) {
          echo "Xoa thanh cong";
          header("location:manage_product.php");
        } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
      }
    }
  }

?>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Document</title>
    <style>
        h1{
            text-align: center;
        }

        .pagination a {
            text-decoration:none;
            margin-left: 10px;
            border: 1px solid #ccc;
            padding: 5px 10px;
        }
        .pagination span {
            border: 1px solid #000;
            padding: 5px 10px;
            margin-left: 10px;
            background-color: #ccc;
            
        }           
    </style>
  </head>
  <body>
    <div class="container">
      <h1 style="text-align: center">TRANG QUẢN TRỊ SẢN PHẨM</h1>
      <div class="row">
        <div class="col-6">
          <form action="manage_product.php" method="post" enctype="multipart/form-data">
            Chọn danh mục:
            <select class="form-control" name="cate" id="">
                <?php
                    $sql = "select * from tbl_category order by id DESC";                             
                    //Khai báo sql, liên kết sql hiển thị bảng
                    $result = mysqli_query($conn,$sql);               
                    if(mysqli_num_rows($result)>0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            echo"<option value='".$row["id"]."'>".$row["catename"]."</option>";
                        }                                
                    }
                ?>
            </select>
            <br>
            Nhập vào tên sản phẩm:
            <input type="text" class="form-control" name="txt_product_name" />
            <br>
            Nhập vào min value:
            <input type="text" class="form-control" name="txt_product_minvalue" />
            <br>
            Nhập vào max value:
            <input type="text" class="form-control" name="txt_product_maxvalue" />
            <br>
            Nhập vào mô tả sản phẩm:
            <input type="text" class="form-control" name="txt_product_desc" />
            <br>
            Chọn ảnh đại diện cho sản phẩm:
            <input class="form-control" type="file" name="img" id="">
            <br>
            Nhập vào số lượng sản phẩm:
            <input type="text" class="form-control" name="txt_product_quantity" />
            <br>
            <input type="submit" class="btn btn-primary" name="btn_insert" value="Thêm mới" />
          </form>
        </div>
      </div>
      <div class="row" style="margin-top: 10px; display: flex;">
        <div class="col-6">
          <form action="manage_product.php" method="post" style="margin-top: 10px; display: flex;">
            <input placeholder="Nhập vào tên dm......." class="form-control" id="live_search" type="text" name="txt_search">
            <input class="btn btn-success" type="submit" value="Tìm Kiếm" name="btn_search"></input>
          </form>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <?php
            $result = mysqli_query($conn, 'select count(id) as total from tbl_product');
            $row = mysqli_fetch_assoc($result);
            $total_records = $row['total'];

            //tim limit va current page
            $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
            $limit = 5;
            // BƯỚC 4: TÍNH TOÁN TOTAL_PAGE VÀ START
            // tổng số trang
            $total_page = ceil($total_records / $limit);
            
            // Giới hạn current_page trong khoảng 1 đến total_page
            if ($current_page > $total_page){
                $current_page = $total_page;
            }
            else if ($current_page < 1){
                $current_page = 1;
            }
            
            // Tìm Start
            $start = ($current_page - 1) * $limit;

            // $input = isset($_POST['input']) ? $_POST['input'] : '';
            // $query = "select * from tbl_category where catename like '{$input}%' or status like '{$input}%'";
          ?>
          <!-- <div id="searchresult"></div> -->
          <table class="table tabke-stripped" >
            <thead>
              <tr>
                <th>Mã SP</th>
                <th>Tên sản phẩm</th>
                <th>Giá min-value</th>
                <th>Giá max-value</th>
                <th>Mô tả</th>
                <th>Hình ảnh</th>
                <th>Danh mục</th>
                <th>Số lượng</th>
                <th>Thao tác</th>
                <th>Lựa chọn</th>
              </tr>
            </thead>

            <form action="manage_product.php" method="post">
              <input style="margin-right: 5px;" type="submit" value="Xóa theo chọn" name="delete_check" class="btn btn-info">
              
              <tbody id="searchresult">
                <?php
                  $sql = "select * from tbl_product limit " . $start . "," . $limit;
                  if(isset($_POST["btn_search"])) {
                    $sql = "select * from tbl_product where name like '%".$_POST["txt_search"]."%'";
                  } 
                  else {
                    // include
                    $sql = "select * from tbl_product order by id desc";
                  }

                  $result = mysqli_query($conn,$sql);

                  if (mysqli_num_rows($result)>0)
                  {
                    while ($row = mysqli_fetch_assoc($result))
                    {
                      echo "<tr>";
                        echo "<td>".$row["id"]."</td>";
                        echo "<td>".$row["name"]."</td>";
                        echo "<td>".$row["min_price"]."</td>";
                        echo "<td>".$row["max_price"]."</td>";
                        echo "<td>".$row["description"]."</td>";
                        echo "<td> <img style='width:100px;' src=../img_product/".$row["image"]."></td>";
                        echo "<td>".$row["category"]."</td>";
                        echo "<td>".$row["quantity"]."</td>";

                        echo "<td>";
                          echo "<a  class='btn btn-warning' href='update_product.php?task=update&id=".$row["id"]."'> Sua</a>";
                          echo "<a class='btn btn-danger' href='manage_product.php?task=delete&id=".$row["id"]."'> Xoa</a>";
                        echo "</td>";

                        echo "<td>";
                          echo "<input type='checkbox' class='form-check-input' name='prod[]' value='".$row['id']."'>";
                        echo "</td>";

                      echo "</tr>";
                    }
                  }else
                  {
                    echo "no";
                  }
                ?>
              </tbody>  
            
            </form>
          </table>
          <div class="pagination">
            <?php 
                if ($current_page > 1 && $total_page > 1){
                    echo '<a href="manage_product.php?page='.($current_page-1).'">Truoc</a> | ';
                }
                  
                // Lặp khoảng giữa
                for ($i = 1; $i <= $total_page; $i++){
                    // Nếu là trang hiện tại thì hiển thị thẻ span
                    // ngược lại hiển thị thẻ a
                    if ($i == $current_page){
                        echo '<span>'.$i.'</span> | ';
                    }
                    else{
                        echo '<a href="manage_product.php?page='.$i.'">'.$i.'</a> | ';
                    }
                }
                  
                // nếu current_page < $total_page và total_page > 1 mới hiển thị nút prev
                if ($current_page < $total_page && $total_page > 1){
                    echo '<a href="manage_product.php?page='.($current_page+1).'">Sau</a> | ';
                }
            ?>
        </div>
        </div>
      </div>
    </div>
     

  </body>
</html>