<?php
// like

// if(isset($_POST["loadlistbinhluan"]) && isset($_POST["id_sp"]) && isset($_POST["style_edit_xoa"]) && $_POST["loadlistbinhluan"] == true && isset($_POST["nguoi_dang_dangnhap"]))
// {
//     require_once "myfunc.php";
//     $id_sp = $_POST["id_sp"];
//     $style_edit_xoa = $_POST["style_edit_xoa"];

//     echo hienthibinhluan($id_sp,$style_edit_xoa,$nguoi_dang_dangnhap);
    
// }

if (isset($_POST["id_user_binhluan"]) && isset($_POST["id_binhluan"]) && isset($_POST["liked"]) && $_POST["liked"] == true)
{
    require "./conect.php";
    $id_user = $_POST["id_user_binhluan"];
    $id_binhluan = $_POST["id_binhluan"];
    $sql = "INSERT INTO tbl_like_binhluan (id, id_binhluan, id_user) VALUES (NULL,$id_binhluan,$id_user);";
    $result = mysqli_query($conn,$sql);
   
    if ($result>0)
    {
      
        
    }else
    {
        echo "Error:".$sql.mysqli_error($conn);
    }

    require "close.php";
}
// dilike
if (isset($_POST["id_user_binhluan"]) && isset($_POST["disliked"]) && isset($_POST["id_binhluan"]) && $_POST["disliked"]==true)
{
    
    require "./conect.php";
    $id_user = $_POST["id_user_binhluan"];
    $id_binhluan = $_POST["id_binhluan"];
    
    $sql = "delete from tbl_like_binhluan WHERE id_binhluan = $id_binhluan and id_user = $id_user";
    $result = mysqli_query($conn,$sql);
    
    if ($result)
    {
        
    }else
    {
        echo "Error:".$sql.mysqli_error($conn);
    }

    require "close.php";
}


// xoa binh luan
if (isset($_POST["id_user_dangsudung"]) && isset($_POST["id_binhluan"]) && isset($_POST["id_sanpham"]) && isset($_POST["xoa_binhluan"]) && isset($_POST["style_edit_xoa"]) && isset($_POST["id_user_binhluan"]) && $_POST["xoa_binhluan"]==true)
{
   
    require "./conect.php";
    
    $id_binhluan = $_POST["id_binhluan"];
    $id_sp = $_POST["id_sanpham"];
    $id_user_binhluan = $_POST["id_user_binhluan"];
    $style_edit_xoa = $_POST["style_edit_xoa"];
    $id_user_dangsudung = $_POST["id_user_dangsudung"];

    
    $sql = "delete from tbl_binhluan WHERE id = $id_binhluan and id_sanpham = $id_sp and id_user = $id_user_binhluan; ";
    $result = mysqli_query($conn,$sql);
    
    if ($result)
    {
        require_once "myfunc.php";
        echo hienthibinhluan($id_sp,$id_user_dangsudung);
    }else
    {
        echo "Error:".$sql.mysqli_error($conn);
    }



    require "close.php";
}


// show sl like

if ( isset($_POST["id_binhluan"]) && isset($_POST["soluonglike"]) && $_POST["soluonglike"] == true )
{

    $id_binhluan = $_POST["id_binhluan"];
    require "myfunc.php";

    echo getsoluotlike_binhluan($id_binhluan);
    
    
}

//check liked
if (isset($_POST["id_user_binhluan"]) && isset($_POST["id_binhluan"]) && isset($_POST["checked_like"]) && $_POST["checked_like"] == true)
{
    require "./conect.php";
    $id_user = $_POST["id_user_binhluan"];
    $id_binhluan = $_POST["id_binhluan"];
    
    $sql = "SELECT * FROM tbl_like_binhluan WHERE id_binhluan = $id_binhluan and id_user = $id_user";
    $result = mysqli_query($conn,$sql);
    
    if (mysqli_num_rows($result)>0)
    {
        echo true;
    }else
    {
        echo false;
    }

    require "close.php";
}



?>