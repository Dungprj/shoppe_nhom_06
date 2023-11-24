<?php


function thongtindonhang()
{
    
}
function taogiohang($tensp,$hinhsp,$dongia,$soluong,$thanhtien,$idbill)
{
    include "conect.php";

    

    $sql = "insert into tbl_cart(tensp,hinhsp,dongia,soluong,thanhtien,idbill) values('$tensp','$hinhsp',$dongia,$soluong,$thanhtien,$idbill)";
    if (mysqli_query($conn,$sql))
    {
        
    }else
    {
        echo "Error:".$sql.mysqli_error($conn);
    }


    

    include "close.php";

    


}


function taodonhang($name,$address,$tel,$total,$pttt)
{
    include "conect.php";

    

    $sql = "insert into tbl_bill(name,address,tel,total,pttt) values('$name','$address','$tel','$total','$pttt')";
    if (mysqli_query($conn,$sql))
    {
        $last_id = $conn->insert_id;
    }else
    {
        echo "Error:".$sql.mysqli_error($conn);
    }


    

    include "close.php";

    return $last_id;


}
function tongdonhang($cart)
{
    $tong = 0;
    $kq ="";
    $stt = 1;
    if(isset($cart)&&is_array($cart))
    {
        if(sizeof($cart)>0){
            $thanhtien = 0;
        for ($i = 0; $i < sizeof($cart); $i++)
        {
            $tong = $cart[$i][3] * $cart[$i][4];
            $thanhtien +=$tong;

           

            
        }
       

        }
    }
   


    return $tong;
}


function showcart($cart,$bill= 0)
{
     
    if ($bill <=0)
    {
        $tong = 0;
        $ttgh ="";
        $stt = 1;
        if(isset($cart)&&is_array($cart))
        {
            if(sizeof($cart)>0){
                $thanhtien = 0;
            for ($i = 0; $i < sizeof($cart); $i++)
            {
                $tong = $cart[$i][3] * $cart[$i][4];
                $thanhtien +=$tong;

                $ttgh.="<tr>
                    <th scope='row'>$i</th>
                    <td><img src=".$cart[$i][1]." width=100px></td>
                    <td>".$cart[$i][2]."</td>
                    <td>".number_format($cart[$i][3],0,',','.')."</td>
                    <td>".$cart[$i][4]."</td>
                    <td>".number_format($tong,0,',','.')."</td>
                    <td style='text-align:center;'><a href='./viewcart.php?delid=$i'>Xóa</a></td>


                </tr>";

                
            }
            $ttgh.=" <tr>
            <th colspan='5'>Tổng đơn hàng</th>
            <td style='background-color:#ccc;'>".number_format($thanhtien,0,',','.')."</td>
            </tr>
            ";

            }
        
        }
   


        return $ttgh;

    }else
    {
        $tong = 0;
        $ttgh ="";
        $stt = 1;
        if(isset($cart)&&is_array($cart))
        {
            if(sizeof($cart)>0){
                $thanhtien = 0;
            for ($i = 0; $i < sizeof($cart); $i++)
            {
                $tong = $cart[$i][3] * $cart[$i][4];
                $thanhtien +=$tong;

                $ttgh.="<tr>
                    <th scope='row'>$i</th>
                    <td><img src=".$cart[$i][1]." width=100px></td>
                    <td>".$cart[$i][2]."</td>
                    <td>".number_format($cart[$i][3],0,',','.')."</td>
                    <td>".$cart[$i][4]."</td>
                    <td>".number_format($tong,0,',','.')."</td>
                    


                </tr>";

                
            }
            $ttgh.=" <tr>
            <th colspan='5'>Tổng đơn hàng</th>
            <td style='background-color:#ccc;'>".number_format($thanhtien,0,',','.')."</td>
            </tr>
            ";

            }
        }
        return $ttgh;
    
    }
}



?>