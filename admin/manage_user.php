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
            // echo "Error: " .$sql_insert . "br" . mysqli_error($conn);
            echo "Đăng kí KHÔNG thành công !!!";
        }
      } 
      else
        {
        echo "Sorry, there was an error uploading your file.";
      }
    }


}

  //xoa
  if(isset($_GET["task"]) && $_GET["task"] == "delete") {
    $id = $_GET["id_user"];
    $sql_delete = "delete from tbl_user where id_user = " . $id;
    if(mysqli_query($conn, $sql_delete)) {
      echo "Xoa thanh cong";
      header("location:manage_user.php");
    } else {
      // echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      echo "Xóa KHÔNG thành công !!!";
    }
  }


?>


<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" />
    <script src="../jquery-3.7.1.min.js"></script>
    <title>Manage User</title>
    <script> 
    $(document).ready(function(){
    $("#txt_username").blur(function(){
      var name = $(this).val();
      $.get("./checkUserName.php",{user_name:name},function(data){
        if ( data ==0 ){
          $("#LoiUserName").html("Tên người dùng hợp Lệ");
          $("#LoiUserName").css("color","blue");
          $
        }else{
          $("#LoiUserName").html("Tên người dùng đã được sử dụng");
          $("#LoiUserName").css("color","red");
        }
      });
    });
  });
  </script> 
  </head>
  <body>
    <div class="container"  >
      <h1 style="text-align: center">Trang Quản Trị Tài Khoản</h1>

      <!-- Dang Ky Tai Khoan -->
      <div class="row" >
      <div class="col-6" style="margin-left: auto;margin-right: auto;" >
          <form action="manage_user.php" method="post" enctype="multipart/form-data">
           
            <br>
            <input type="text" placeholder="Họ và Tên" class="form-control" name="txt_fullname" />
            <br>
            <input type="text" placeholder="Tên đăng nhập" class="form-control" name="txt_username" id="txt_username" />
            <br>
            <div id="LoiUserName"></div>
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


      <!-- Search  -->
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
              // if(isset($_POST["btn_search"])) {
              //   $sql = "select * from tbl_user  where username like '%".$_POST["txt_search"]."%'" ;
              // } 
              // else {
              //   // include
              //   $sql = "select * from tbl_user order by id_user desc";
              // }
              

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
              

              $sql = "";
              if(isset($_POST["btn_search"])) {
                $sql = "select * from tbl_user  where username like '%".$_POST["txt_search"]."%' LIMIT $start, $limit ";
              } 
              else {
                // include
                $sql = "select * from tbl_user order by id_user asc LIMIT $start, $limit ";
              }


              // BƯỚC 5: TRUY VẤN LẤY DANH SÁCH TIN TỨC
              // Có limit và start rồi thì truy vấn CSDL lấy danh sách tin tức
              $result = mysqli_query($conn, $sql);
              // $result = mysqli_query($conn, "SELECT * FROM tbl_user LIMIT $start, $limit");

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