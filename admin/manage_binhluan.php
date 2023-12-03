<?php
  require("../conect.php");
  require("./admin.php");
  // if(!$_SESSION["user"]) {
  //   header("location:../login.php");
  // } 
  // echo"Xin chao thanh vien" . $_SESSION["user"];

  // thêm
 

  // xóa
  if(isset($_GET["task"]) && $_GET["task"] == "delete") {
    $id = $_GET["id"];
    $sql_delete = "delete from tbl_binhluan where id = " . $id;
    if(mysqli_query($conn, $sql_delete)) {
      echo "Xoa thanh cong";
      header("location:manage_binhluan.php");
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
  }

  //delete check
  if(isset($_POST["delete_check"])) {
    if(isset($_POST["cate"])) {
      $cate = $_POST["cate"];
      foreach($cate as $c) {
        echo $c;
        $sql_delete = "delete from tbl_binhluan where id = " . $c;
        if(mysqli_query($conn, $sql_delete)) {
          echo "Xoa thanh cong";
          header("location:manage_binhluan.php");
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
  </head>
  <body>
    <div class="container">
      <h1 style="text-align: center">TRANG QUẢN TRỊ BÌNH LUẬN</h1>
      <div class="row">
        
      </div>
      <div class="row" style="margin-top: 10px; display: flex;">
        <div class="col-6">
        <form action="manage_binhluan.php" method="post" style="margin-top: 10px; display: flex;">
            <input placeholder="Nhập vào nội dung bình luận ......." class="form-control" id="live_search" type="text" name="txt_search">
            <input class="btn btn-success" type="submit" value="Tìm Kiếm" name="btn_search"></input>
          </form>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <?php
            $result = mysqli_query($conn, 'select count(id) as total from tbl_binhluan');
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
            $start = max(0, ($current_page - 1) * $limit);

           
          ?>
          <!-- <div id="searchresult"></div> -->
          <table class="table tabke-stripped" >
            <thead>
              <tr>
                <th>Mã bình luận</th>
                <th>Nội dung</th>
                <th>Hình ảnh</th>
                <th>Thao tác</th>
                <th>Lựa chọn</th>
              </tr>
            </thead>

            <form action="manage_binhluan.php" method="post">
              <input style="margin-right: 5px;" type="submit" value="Xóa theo chọn" name="delete_check" class="btn btn-info">
              
              <tbody id="searchresult">
                <?php
                require "../myfunc.php";
                if (isset($_POST["btn_search"]))
                {
                  $sql = "select * from tbl_binhluan where noidung like '%".$_POST["txt_search"]."%' limit " . $start . "," . $limit;
                }else
                {
                  $sql = "select * from tbl_binhluan limit " . $start . "," . $limit;
                }

                  $result = mysqli_query($conn,$sql);


                  if (mysqli_num_rows($result)>0)
                  {
                    while ($row = mysqli_fetch_assoc($result))
                    {
                      echo "<tr>";
                        echo "<td>".$row["id"]."</td>";
                        echo "<td>".$row["noidung"]."</td>";
                        // begin load list anh 
                        
                        echo "<td style='display: flex;gap: 5px;'>";
                        // echo "<td> <img style='width:100px;' src=../".$row["image"]."></td>";
                        echo lay_hinhanhbinhluan_quanly_binhluan($row["id"]);
                        echo "</td>";
                        // end load list anh 

                        echo "<td>";
                          
                          echo "<a class='btn btn-danger' href='manage_binhluan.php?task=delete&id=".$row["id"]."'> Xoa</a>";
                        echo "</td>";

                        echo "<td>";
                          echo "<input type='checkbox' class='form-check-input' name='cate[]' value='".$row['id']."'>";
                        echo "</td>";

                      echo "</tr>";
                    }
                  }else
                  {
                  echo "Không có dữ liệu";
                  }

                

                  
                ?>
              </tbody>  
            
            </form>
          </table>
          <div class="pagination">
            <?php 
                if ($current_page > 1 && $total_page > 1){
                    echo '<a href="manage_binhluan.php?page='.($current_page-1).'">Truoc</a> | ';
                }
                  
                // Lặp khoảng giữa
                for ($i = 1; $i <= $total_page; $i++){
                    // Nếu là trang hiện tại thì hiển thị thẻ span
                    // ngược lại hiển thị thẻ a
                    if ($i == $current_page){
                        echo '<span>'.$i.'</span> | ';
                    }
                    else{
                        echo '<a href="manage_binhluan.php?page='.$i.'">'.$i.'</a> | ';
                    }
                }
                  
                // nếu current_page < $total_page và total_page > 1 mới hiển thị nút prev
                if ($current_page < $total_page && $total_page > 1){
                    echo '<a href="manage_binhluan.php?page='.($current_page+1).'">Sau</a> | ';
                }
            ?>
        </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12" id="result"></div>
      </div>
    </div>
    
    
    

  </body>
</html>