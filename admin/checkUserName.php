<?php
    require("../conect.php");


    $user_name = $_GET["user_name"];
    $sql = "select * from tbl_user where username = '".$user_name."' ";

    $result = mysqli_query($conn,$sql);
    $ketquauser = mysqli_num_rows($result);
    echo $ketquauser;



?>