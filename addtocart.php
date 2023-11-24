<?php
session_start();


if (isset($_POST["themvaogio"]) && $_POST["themvaogio"])
{
    $img = $_POST["img"];
    $tensp = $_POST["tensp"];
    
    $gia = $_POST["gia"];
    $id_sp = $_POST["id"];
    $sl = $_POST["quantity"];

    // tao mang con
   

    // add to cart

    // $_SESSION['cart'][] = $sp;

    if (!isset($_SESSION["cart"])) $_SESSION["cart"] = array();

    $fl = 0;
    // kiem tra san pham co trong gio hang hay khong

 

   for ($i = 0; $i < sizeof($_SESSION["cart"]); $i++)
   {
    if ($_SESSION["cart"][$i][0] == $id_sp)
    {
        $fl =1;
        $soluongnew = $sl + $_SESSION["cart"][$i][4];
        $_SESSION["cart"][$i][4] = $soluongnew;
        break;
    }
   }
    if ($fl == 0 )
    {
        $sp = array($id_sp,$img,$tensp,$gia,$sl);
        array_push($_SESSION["cart"],$sp);
        echo '<script>';
    echo 'alert("Thêm sản phẩm vào giỏ thành công !");';
    echo '</script>';

    header("Location:./sanpham.php"."?idsp=".$id_sp);
        
    }else
    {
        header("Location:./sanpham.php"."?idsp=".$id_sp);

    }
   
}



if (isset($_POST["dathang"]) && $_POST["dathang"])
{
    $img = $_POST["img"];
    $tensp = $_POST["tensp"];
    
    $gia = $_POST["gia"];
    $id_sp = $_POST["id"];
    $sl = $_POST["quantity"];

    // tao mang con
   

    // add to cart

    // $_SESSION['cart'][] = $sp;

    if (!isset($_SESSION["cart"])) $_SESSION["cart"] = array();

    $fl = 0;
    // kiem tra san pham co trong gio hang hay khong

 

   for ($i = 0; $i < sizeof($_SESSION["cart"]); $i++)
   {
    if ($_SESSION["cart"][$i][0] == $id_sp)
    {
        $fl =1;
        $soluongnew = $sl + $_SESSION["cart"][$i][4];
        $_SESSION["cart"][$i][4] = $soluongnew;
        break;
    }
   }
    if ($fl == 0 )
    {
        $sp = array($id_sp,$img,$tensp,$gia,$sl);
        array_push($_SESSION["cart"],$sp);
        echo '<script>';
    echo 'alert("Thêm sản phẩm vào giỏ thành công !");';
    echo '</script>';

    header("Location:./viewcart.php");
        
    }else
    {
        header("Location:./viewcart.php");


    }

}
?>

