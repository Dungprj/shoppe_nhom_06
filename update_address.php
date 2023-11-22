<?php
require "./conect.php";

session_start();






if(isset($_POST["btn_submit_editaddress"]))
{
  
  $fullname_editaddress = $_POST["fullname_editaddress"];
  $phone_editaddress = $_POST["phone_editaddress"];
  $address_editaddress = $_POST["address_editaddress"];
  $id_edit_adress = $_POST["id_edit_adress"];



  $sql_update = "UPDATE tbl_address_user SET name = '".$fullname_editaddress."', phone = '".$phone_editaddress."',address='".$address_editaddress."' WHERE id = $id_edit_adress";

  if (mysqli_query($conn,$sql_update))
  {

      header("Location: ./address.php");
  }else
  {
    echo "Error:".$sql.mysqli_error($conn);
  }
    





}

if (isset($_POST["btn_cancel"]))
{
  header("Location:./address.php");
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>update address</title>
    <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="./fontawesome-free-6.4.2-web/fontawesome-free-6.4.2-web/css/all.css" />
  <link rel="stylesheet" href="./fontawesome-free-6.4.2-web/fontawesome-free-6.4.2-web/css/reset.css">
  <link rel="stylesheet" href="./css/thongtin.css">

  <link rel="stylesheet" href="./form-control">
  <link rel=" stylesheet" href="./css/reset.css">
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="./css/footer_Shopee.css">
  <link rel="stylesheet" href="./css/xem_them.css">
  <link rel="stylesheet" href="./css/responsive.css">
  <link rel="stylesheet" href="./css/tb.css">
  <link rel="stylesheet" href="./css/update_address.css">
 
  <title>Update address</title>
</head>
<body>



    <div id="bl_add_new_address" style="padding: 2%;">
            
        <!-- bein -->
        <form method="post" action="./update_address.php">
         
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputEmail4"></label>
              <input type="text" class="form-control" id="inputEmail4" placeholder="Full Name" value="<?php if(isset($_GET["username"]))echo $_GET["username"]?>" name="fullname_editaddress">
            </div>
            <div class="form-group col-md-6">
              <label for="inputPassword4"></label>
              <input type="text" class="form-control" id="inputPassword4" placeholder="Phone Number" value="<?php if(isset($_GET["phone"]))echo $_GET["phone"]?>" name="phone_editaddress">
            </div>
          </div>
          <div class="form-group">
            <label for="inputAddress"></label>
            <input type="text" class="form-control" id="inputAddress" placeholder="Address" value="<?php if(isset($_GET["address"]))echo $_GET["address"]?>"name="address_editaddress">
          </div>
          
         <div class="bl_btn_cancel_submit">
         <input type="hidden" name="id_edit_adress" value="<?php if(isset($_GET["id"]))echo $_GET["id"]?>" />
          <button type="submit" class="btn btn-light btn_cancel_edit_address" name="btn_cancel">Cancel</button>
          <button type="submit" class="btn btn-danger btn_submit_address" name="btn_submit_editaddress">Submit</button>

         </div>
         
        </form>
    
</body>
</html>