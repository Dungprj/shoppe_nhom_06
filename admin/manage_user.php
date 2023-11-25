<?php 

  require "../conect.php";
  require "./admin.php";

  if (!$_SESSION["user_name"])
  {
    header("Location:../login.php");
  }

  // Kiem tra xem nguoi dung da nhan nut them moi
  if(isset($_POST["btn_insert"])) {

    //lay du lieu tu o nhap nhieu
    $user_name = $_POST["txt_username"];
    $password = $_POST["txt_password"];
    $re_password = $_POST["txt_password_re"];
    $fullname = $_POST["txt_fullname"];
    $date_of_birth = $_POST["txt_date"];
    $gender = $_POST["gender"];
    $phone = $_POST["txt_phone"];
    $email = $_POST["txt_email"];
    $admin = $_POST["txt_admin"];

    $target_dir = "../img_user/";
    $target_file = $target_dir . basename($_FILES["upload_file"]["name"]);  
    $uploadOk = 1;
    //kiem tra dinh dang cua file upload
    $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    if($fileType != "jpg" && $fileType != "png" && $fileType != "jpeg"&& $fileType != "gif" ) 
    {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) 
    {
        echo "Sorry, your file was not uploaded.";
    } 
    else 
    {
      if(move_uploaded_file($_FILES["upload_file"]["tmp_name"], $target_file)) {
        $image_name = basename($_FILES["upload_file"]["name"]);

        $sql_insert = "insert into tbl_user(username,password,name,email,phone,avata,gender,date_of_birth,admin) values('".$user_name."',md5('".$password."'),'".$fullname."','".$email."','".$phone."', '".$image_name."', '".$gender."','".$date_of_birth."','".$admin."')";

        if (mysqli_query($conn, $sql_insert)){
          echo " dang ki thanh cong";
          header("location:manage_user.php");
        }
        else{
            echo "Error: " .$sql_insert . "br" . mysqli_error($conn);
        }
      } 
      else
        {
        echo "Sorry, there was an error uploading your file.";
      }
    }

    // if ($password!=$re_password){
    //   echo "Mat khau khong trung";
    // }

    // else{
    //   $sql = "select * from tbl_user where username = '".$user_name."' ";
    //   $result = mysqli_query($conn,$sql);

    //   if(mysqli_num_rows($result)>0){
    //       echo "Ten dang nhap da ton tai";
    //   }
    //   else{         
    //   }
    // }
}

  //xoa
  if(isset($_GET["task"]) && $_GET["task"] == "delete") {
    $id = $_GET["id_user"];
    $sql_delete = "delete from tbl_user where id_user = " . $id;
    if(mysqli_query($conn, $sql_delete)) {
      echo "Xoa thanh cong";
      header("location:manage_user.php");
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
  }


?>


<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" />
    <title>Manage User</title>
  </head>
  <body>
    <div class="container"  >
      <h1 style="text-align: center">Trang Quản Trị Tài Khoản</h1>

      <!-- Dang Ky Tai Khoan -->
      <div class="row" >
      <div class="col-6" style="margin-left: auto;margin-right: auto;" >
          <form action="manage_user.php" method="post" enctype="multipart/form-data">
            <!-- <?php
              if(isset($_POST["upload"])) {
                $target_dir = "../img_user/";
                $target_file = $target_dir . basename( $_FILES["upload_file"]["name"] );
                // echo $target_file;
                $uploadOk = 1;
                //kiem tra dinh dang cua file upload
                $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                if($fileType != "jpg" && $fileType != "png" && $fileType != "jpeg" && $fileType != "gif" ) {
                  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                  $uploadOk = 0;
                }
                if ($uploadOk == 0) {
                  echo "Sorry, your file was not uploaded.";
                  // if everything is ok, try to upload file
                  } 
                else {
                  if (move_uploaded_file($_FILES["upload_file"]["tmp_name"], $target_file)) {
                      echo "<img src='".$target_file."' style='width: 300px;text-align: center;'>";
                  } 
                  else {
                    echo "Sorry, there was an error uploading your file.";
                  }
                }
              }
            ?> -->
            <br>
            <input type="text" placeholder="Họ và Tên" class="form-control" name="txt_fullname" />
            <br>
            <input type="text" placeholder="Tên đăng nhập" class="form-control" name="txt_username" />
            <br>
            <input type="password" placeholder="Mật Khẩu" class="form-control" name="txt_password" />
            <br>
            <input type="password" placeholder="Nhập lại mật khẩu" class="form-control" name="txt_password_re" />
            <br>
            <label for="">Ngày sinh  </label>
            <input type="date" name="txt_date"  >
            <br>
            <br>
            <label for="">Giới Tính</label>
            <input type="radio" name="gender" value="1"> Nam
            <input type="radio" name="gender" value="0"> Nữ
            <br>
            <input type="text" placeholder="Số Điện Thoại" class="form-control" name="txt_phone" />
            <br>
            <input type="text" placeholder="Email" class="form-control" name="txt_email" />
            <br>
            <input type="text" placeholder="Admin" class="form-control" name="txt_admin" />
            <br>
            Chọn ảnh đại diện cho người dùng:
            <input class="form-control" type="file" name="upload_file" id="">
            <br>


            <br>
            <input style="margin-left: 40%"  type="submit" class="btn btn-primary" name="btn_insert" value="Thêm tài khoản" />
          </form>
        </div>
      </div>

      <div class="row" style="margin-top: 10px; display: flex;margin-left: 20% ">
        <div class="col-10">
          <form action="manage_user.php" method="post" style="margin-top: 10px; display: flex;">
            <input placeholder="Tên Đăng Nhập" class="form-control" type="text" name="txt_search">
            <input class="btn btn-success" type="submit" value="Tìm Kiếm" name="btn_search"></input>
          </form>
        </div>
      </div>

      <!-- Quan Ly Tai Khoan -->
      <div class="row">
        <div class="col-12">
          <table class="table tabke-stripped">
            <tr>
              <th>ID</th>
              <th>Ảnh Đại Diện</th>
              <th>Tên Đăng Nhập</th>
              <th>Mật Khẩu</th>
              <th>Họ và Tên</th>
              <th>Giới Tính</th>
              <th>Ngày Sinh</th>
              <th>Số điện thoại</th>
              <th>Email</th>
              <th>Admin</th>
              <th>Tùy Chọn</th>

            </tr>
            <form action="manage_user.php" method="post">
            <?php

              $sql = "";
              if(isset($_POST["btn_search"])) {
                $sql = "select * from tbl_user where username like '%".$_POST["txt_search"]."%'";
              } 
              else {
                // include
                $sql = "select * from tbl_user order by id_user asc";
              }
              

              // $result = mysqli_query($conn,$sql);
              $result = mysqli_query($conn, 'select count(id_user) as total from tbl_user');
              $row = mysqli_fetch_assoc($result);
              $total_records = $row['total'];
      
              // BƯỚC 3: TÌM LIMIT VÀ CURRENT_PAGE
              $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
              $limit = 10;
      
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
      
              // BƯỚC 5: TRUY VẤN LẤY DANH SÁCH TIN TỨC
              // Có limit và start rồi thì truy vấn CSDL lấy danh sách tin tức
              $result = mysqli_query($conn, "SELECT * FROM tbl_user LIMIT $start, $limit");

              if (mysqli_num_rows($result)>0)
              {
                // while ($row = mysqli_fetch_assoc($result))
                while ($row = mysqli_fetch_assoc($result))
                {
                  echo "<tr>";
                  echo "<td>".$row["id_user"]."</td>";
                  echo "<td> <img style='width:100px;' src=../img_user/".$row["avata"]."></td>";
                  echo "<td>".$row["username"]."</td>";
                  echo "<td>".$row["password"]."</td>";
                  echo "<td>".$row["name"]."</td>";
                  if ($row["gender"] == 1) {
                    echo "<td>"."Nam"."</td>";
                  } else {
                    echo "<td>"."Nữ"."</td>";
                  }
                  echo "<td>".$row["date_of_birth"]."</td>";
                  echo "<td>".$row["phone"]."</td>";
                  echo "<td>".$row["email"]."</td>";

                  if ($row["admin"] == 1) {
                    echo "<td>"."Đã kích hoạt"."</td>";
                  } else {
                    echo "<td>"."Chưa kích hoạt"."</td>";
                  }
                  echo "<td>";
                    echo "<a class='btn btn-warning' href='update_user.php?task=update&id_user=".$row["id_user"]."'> Sua</a>";
                    echo "<a class='btn btn-danger' href='manage_user.php?task=delete&id_user=".$row["id_user"]."'> Xoa</a>";
                  echo "</td>";


                  echo "</tr>";
                }
              }
            ?>
            </form>
          </table>
        </div>
      </div>
      <div class="pagination">
           <?php 
            // PHẦN HIỂN THỊ PHÂN TRANG
            // BƯỚC 7: HIỂN THỊ PHÂN TRANG
 
            // nếu current_page > 1 và total_page > 1 mới hiển thị nút prev
            if ($current_page > 1 && $total_page > 1){
                echo '<a href="manage_user.php?page='.($current_page-1).'">Prev</a> | ';
            }
 
            // Lặp khoảng giữa
            for ($i = 1; $i <= $total_page; $i++){
                // Nếu là trang hiện tại thì hiển thị thẻ span
                // ngược lại hiển thị thẻ a
                if ($i == $current_page){
                    echo '<span>'.$i.'</span> | ';
                }
                else{
                    echo '<a href="manage_user.php?page='.$i.'">'.$i.'</a> | ';
                }
            }
 
            // nếu current_page < $total_page và total_page > 1 mới hiển thị nút prev
            if ($current_page < $total_page && $total_page > 1){
                echo '<a href="manage_user.php?page='.($current_page+1).'">Next</a> | ';
            }
           ?>
        </div>
      <div>
      <a class='btn btn-warning' href='../trangchu.php'> Quay ve trang chu</a>
      </div>
    </div>
  </body>
</html>