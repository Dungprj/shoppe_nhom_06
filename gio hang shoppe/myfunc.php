<?php

function showcart($cart)
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

            $kq.="<tr>
                <th scope='row'>$i</th>
                <td><img src=".$cart[$i][1]." width=100px></td>
                <td>".$cart[$i][2]."</td>
                <td>".number_format($cart[$i][3],0,',','.')."</td>
                <td>".$cart[$i][4]."</td>
                <td>".number_format($tong,0,',','.')."</td>
                <td style='text-align:center;'><a href='./viewcart.php?delid=$i'>Xóa</a></td>


            </tr>";

            
        }
        $kq.=" <tr>
        <th colspan='5'>Tổng đơn hàng</th>
        <td style='background-color:#ccc;'>".number_format($thanhtien,0,',','.')."</td>
        </tr>
        ";

        }else
        {
            echo "Giỏ hàng rỗng";
        }
        
    }
   


    return $kq;
}



?>