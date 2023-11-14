<?php 
  require("./config.php");

  // Kiem tra xem nguoi dung da nhan nut upload
  // if(isset($_POST["upload"])) {
  //   $target_dir = "upload/";
  //   $target_file = $target_dir . basename( $_FILES["upload_file"]["name"] );
  //   echo $target_file;
  //   $uploadOk = 1;
  //   //kiem tra dinh dang cua file upload
  //   $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  //   if($fileType != "jpg" && $fileType != "png" && $fileType != "jpeg" && $fileType != "gif" ) {
  //     echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  //     $uploadOk = 0;
  //   }
  //   if ($uploadOk == 0) {
  //     echo "Sorry, your file was not uploaded.";
  //     // if everything is ok, try to upload file
  //     } 
  //   else {
  //     if (move_uploaded_file($_FILES["upload_file"]["tmp_name"], $target_file)) {
  //         echo "<img src='".$target_file."' style='width: 300px;'>";
  //     } 
  //     else {
  //       echo "Sorry, there was an error uploading your file.";
  //     }
  //   }
  // }

  // Kiem tra xem nguoi dung da nhan nut them moi
  if(isset($_POST["btn_insert"])) {

    // //Hinh anh se duoc upload luôn
    // $target_dir = "upload/";
    // echo"1";
    // $target_file = $target_dir . basename( $_FILES["upload_file"]["name"] );
    // echo $target_file;
    // $uploadOk = 1;
    // //kiem tra dinh dang cua file upload
    // $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // if($fileType != "jpg" && $fileType != "png" && $fileType != "jpeg" && $fileType != "gif" ) {
    //   echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    //   $uploadOk = 0;
    // }
    // if ($uploadOk == 0) {
    //   echo "Sorry, your file was not uploaded.";
    //   // if everything is ok, try to upload file
    //   } 
    // else {
    //   if (move_uploaded_file($_FILES["upload_file"]["tmp_name"], $target_file)) {
    //       echo "<img src='".$target_file."' style='width: 300px;'>";
    //   } 
    //   else {
    //     echo "Sorry, there was an error uploading your file.";
    //   }
    // }

    //lay du lieu tu o nhap nhieu
    $user_name = $_POST["txt_username"];
    $password = $_POST["txt_password"];
    $re_password = $_POST["txt_password_re"];
    $fullname = $_POST["txt_fullname"];
    $email = $_POST["txt_email"];

    if ($password!=$re_password){
      echo "Mat khau khong trung";
    }

    else{
      $sql = "select * from tbl_users where user_login = '".$user_name."' ";
      $result = mysqli_query($conn,$sql);
      if(mysqli_num_rows($result)>0){
          echo "Ten dang nhap da ton tai";

      }
      else{
          $sql_insert = "insert into tbl_users(user_login,user_pass,user_email,display_name,user_status) values('".$user_name."',md5('".$password."'),'".$email."','".$fullname."',1)";
          if (mysqli_query($conn, $sql_insert)){
              echo " dang ki thanh cong";
              header("location:manage_user.php");

          }
          else{
              echo "Error: " .$sql_insert . "br" . mysqli_error($conn);
          }
      }
  }
}

  //xoa
  if(isset($_GET["task"]) && $_GET["task"] == "delete") {
    $id = $_GET["ID"];
    $sql_delete = "delete from tbl_users where ID = " . $id;
    if(mysqli_query($conn, $sql_delete)) {
      echo "Xoa thanh cong";
      header("location:manage_user.php");
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
  }

  //delete check
  // if(isset($_POST["delete_check"])) {
  //   if(isset($_POST["user_login"])) {
  //     $user_login = $_POST["user_login"];
  //     foreach($user_login as $c) {
  //       echo $c;
  //       $sql_delete = "delete from tbl_users where user_login = " . $c;
  //       if(mysqli_query($conn, $sql_delete)) {
  //         echo "Xoa thanh cong";
  //         header("location:manage_user.php");
  //       } else {
  //         echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  //       }
  //     }
  //   }
  // }

  //delete all
  // if(isset($_POST["delete_all"])) {
  //   if(isset($_POST["cate"])) {
  //     $cate = $_POST["cate"];
  //     foreach($cate as $c) {
  //       echo $c;
  //       $sql_delete = "delete from information";
  //       if(mysqli_query($conn, $sql_delete)) {
  //         echo "Xoa thanh cong";
  //         header("location:category.php");
  //       } else {
  //         echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  //       }
  //     }
  //   }
  // }
?>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" />
    <title>Quan Tri</title>
  </head>
  <body>
    <div class="container">
      <h1 style="text-align: center">Trang quan tri tai khoan</h1>
      <div class="row">
      <div class="col-6">
          <form action="manage_user.php" method="post">
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
            <input type="submit" class="btn btn-primary" name="btn_insert" value="Thêm tài khoản" />
          </form>
        </div>
      </div>

      <div class="row" style="margin-top: 10px; display: flex;">
        <div class="col-6">
          <form action="manage_user.php" method="post" style="margin-top: 10px; display: flex;">
            <input placeholder="Nhap ten tai khoan" class="form-control" type="text" name="txt_search">
            <input class="btn btn-success" type="submit" value="Tim kiem" name="btn_search"></input>
          </form>
        </div>
      </div>

      <div class="row">
        <div class="col-12">
          <table class="table tabke-stripped">
            <tr>
              <th>ID</th>
              <th>Tên Đăng Nhập</th>
              <th>Mật Khẩu</th>
              <th>Họ và Tên</th>
              <th>Email</th>
              <th>Trang Thai</th>
              <th>Admin</th>
              <th>Tùy Chọn</th>

            </tr>
            <form action="manage_user.php" method="post">
              <!-- <input type="submit" value="Xoa theo chon" name="delete_check" class="btn btn-info">
              <input type="submit" value="Xoa toan bo" name="delete_all" class="btn btn-danger"> -->
              
            <?php
              $sql = "";
              if(isset($_POST["btn_search"])) {
                $sql = "select * from tbl_users where user_login like '%".$_POST["txt_search"]."%'";
              } 
              else {
                // include
                $sql = "select * from tbl_users order by ID asc";
              }

              $result = mysqli_query($conn,$sql);

              if (mysqli_num_rows($result)>0)
              {
                while ($row = mysqli_fetch_assoc($result))
                {
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

                  // echo "<td>".$row["hinhanh"]."</td>";

                  echo "<td>";
                    echo "<a class='btn btn-warning' href='update_user.php?task=update&ID=".$row["ID"]."'> Sua</a>";
                    echo "<a class='btn btn-danger' href='manage_user.php?task=delete&ID=".$row["ID"]."'> Xoa</a>";
                  echo "</td>";

                  // echo "<td>";
                  //   echo "<input type='checkbox' class='form-check-input' name='cate[]' value='".$row['ID']."'>";
                  // echo "</td>";

                  echo "</tr>";
                }
              }else
              {
              echo "no";
              }
            ?>
            </form>
          </table>
        </div>
      </div>
    </div>
  </body>
</html>