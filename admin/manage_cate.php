<?php
  require("./config.php");
  session_start();
  // if(!$_SESSION["user"]) {
  //   header("location:../login.php");
  // } 
  // echo"Xin chao thanh vien" . $_SESSION["user"];

  // thêm
  if(isset($_POST["btn_insert"])) {
    $cate_name = $_POST["txt_cate_name"];
    $status = $_POST["txt_status"];

    $target_dir = "../img_danh_muc/";
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
        $sql_insert = "insert into tbl_category(catename, image, status) 
                  values(N'" .$cate_name. "', '".$target_file."', " .$status. ")";
        if(mysqli_query($conn, $sql_insert)) {
          header("location:manage_cate.php");
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
    $sql_delete = "delete from tbl_category where id = " . $id;
    if(mysqli_query($conn, $sql_delete)) {
      echo "Xoa thanh cong";
      header("location:manage_cate.php");
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
        $sql_delete = "delete from tbl_category where id = " . $c;
        if(mysqli_query($conn, $sql_delete)) {
          echo "Xoa thanh cong";
          header("location:manage_cate.php");
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
      <h1 style="text-align: center">TRANG QUẢN TRỊ DANH MỤC</h1>
      <div class="row">
        <div class="col-6">
          <form action="manage_cate.php" method="post" enctype="multipart/form-data">
            Nhập vào tên danh mục:
            <input type="text" class="form-control" name="txt_cate_name" />
            <br>
            Chọn ảnh đại diện cho danh mục:
            <input class="form-control" type="file" name="img" id="">
            <br>
            Nhập vào trạng thái danh mục:
            <input type="text" class="form-control" name="txt_status" />
            <br>
            <input type="submit" class="btn btn-primary" name="btn_insert" value="Them moi" />
          </form>
        </div>
      </div>
      <div class="row" style="margin-top: 10px; display: flex;">
        <div class="col-6">
          <form action="manage_cate.php" method="post" style="margin-top: 10px; display: flex;">
            <input placeholder="Nhập vào tên dm......." class="form-control" id="live_search" type="text" name="txt_search">
            <input class="btn btn-success" type="submit" value="Tìm Kiếm" name="btn_search"></input>
          </form>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <?php
            $input = isset($_POST['input']) ? $_POST['input'] : '';
            $query = "select * from tbl_category where catename like '{$input}%' or status like '{$input}%'";
          ?>
          <!-- <div id="searchresult"></div> -->
          <table class="table tabke-stripped" >
            <thead>
              <tr>
                <th>Mã DM</th>
                <th>Tên danh mục</th>
                <th>Hình ảnh</th>
                <th>Trạng thái</th>
                <th>Thao tác</th>
                <th>Lựa chọn</th>
              </tr>
            </thead>

            <form action="manage_cate.php" method="post">
              <input style="margin-right: 5px;" type="submit" value="Xóa theo chọn" name="delete_check" class="btn btn-info">
              
              <tbody id="searchresult">
                <?php
                  $sql = "select * from tbl_category";
                  // if(isset($_POST["btn_search"])) {
                  //   $sql = "select * from tbl_category where catename like '%".$_POST["txt_search"]."%'";
                  // } 
                  // else {
                  //   // include
                  //   $sql = "select * from tbl_category order by id desc";
                  // }

                  $result = mysqli_query($conn,$sql);

                  if (mysqli_num_rows($result)>0)
                  {
                    while ($row = mysqli_fetch_assoc($result))
                    {
                      echo "<tr>";
                        echo "<td>".$row["id"]."</td>";
                        echo "<td>".$row["catename"]."</td>";
                        echo "<td> <img style='width:100px;' src=../img_danh_muc/".$row["image"]."></td>";
                        if ($row["status"] == 1) {
                          echo "<td style='color:green'>Hiện</td>";
                        } else {
                          echo "<td style='color:red'>Ẩn</td>";
                        }

                        echo "<td>";
                          echo "<a  class='btn btn-warning' href='update_category.php?task=update&id=".$row["id"]."'> Sua</a>";
                          echo "<a class='btn btn-danger' href='manage_cate.php?task=delete&id=".$row["id"]."'> Xoa</a>";
                        echo "</td>";

                        echo "<td>";
                          echo "<input type='checkbox' class='form-check-input' name='cate[]' value='".$row['id']."'>";
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
        </div>
      </div>
    </div>
    
    
    <script>
      $(document).ready(function() {
        $("#live_search").keyup(function() {
          var input = $(this).val();
          // alert(input);

          if(input != "") {
            $.ajax({
              method: "POST",
              url: "searchajax.php",
              data:{input:input},

              success:function(data) {
                $("#searchresult").html(data);
                $("#searchresult").css("display", "block");
              }
            });
          } else {
            $("#searchresult").css("display", "none");
          }
        });
      })

    </script>

  </body>
</html>