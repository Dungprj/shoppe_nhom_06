<?php
  require("../conect.php");
  require("./admin.php");
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
        $image_name = basename($_FILES["img"]["name"]); 
        $sql_insert = "insert into tbl_category(catename, image, status) 
                  values(N'" .$cate_name. "', '".$image_name."', " .$status. ")";
        if(mysqli_query($conn, $sql_insert)) {
          header("location:manage_test.php");
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
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Live Data Search with Pagination in PHP using Ajax</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/placeholder-loading/dist/css/placeholder-loading.min.css">
  </head>
  <body>
    <br />
    <div class="container">
      <h3 align="center">TRANG QUẢN TRỊ DANH MỤC using Ajax</h3>
      <br />
      <div class="row">
        <div class="col-6">
          <form action="manage_test.php" method="post" enctype="multipart/form-data">
            Nhập vào tên danh mục:
            <input type="text" class="form-control" name="txt_cate_name" />
            <br>
            Chọn ảnh đại diện cho danh mục:
            <input class="form-control" type="file" name="img" id="">
            <br>
            Nhập vào trạng thái danh mục:
            <input type="text" class="form-control" name="txt_status" />
            <br>
            <input type="submit" class="btn btn-primary" name="btn_insert" value="Thêm Mới" />
          </form>
        </div>
      </div>
      <br>
      <div class="card">
        <div class="card-header">Dynamic Data</div>
        <div class="card-body">
          <div class="form-group">
            <input type="text" name="search_box" id="search_box" class="form-control" placeholder="Type your search query here" />
          </div>
          <div class="table-responsive" id="dynamic_content">
            
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
<script>
  $(document).ready(function(){

    load_data(1);

    function load_data(page, query = '')
    {
      $.ajax({
        url:"fetch.php",
        method:"POST",
        data:{page:page, query:query},
        success:function(data)
        {
          $('#dynamic_content').html(data);
        }
      });
    }

    $(document).on('click', '.page-link', function(){
      var page = $(this).data('page_number');
      var query = $('#search_box').val();
      load_data(page, query);
    });

    $('#search_box').keyup(function(){
      var query = $('#search_box').val();
      load_data(1, query);
    });

  });
</script>