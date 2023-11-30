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


function getsoluotlike_binhluan($id_binhluan)
{
    include "conect.php";
    $sql = "SELECT COUNT(*) as sl FROM tbl_like_binhluan WHERE id_binhluan = $id_binhluan;";
    $result = mysqli_query($conn,$sql);
    $soluonglike = 1;
    if (mysqli_num_rows($result)>0)
    {
        while ($row = mysqli_fetch_assoc($result))
        {
        $soluonglike = $row["sl"];
        }

        include "close.php";
    }else
    {
        echo "Error:".$sql.mysqli_error($conn);
    }
    
    if($soluonglike > 0)
    {
        return $soluonglike;
    }else
    {
        return "";
    }
    
}

function lay_hinhanhbinhluan_quanly_binhluan($id_binhluan)
{
    include "conect.php";
    

    $sql = "SELECT img from tbl_img_binhluan where id_binhluan = $id_binhluan";
    $result = mysqli_query($conn,$sql);

    $bl_list_img ="";
    if (mysqli_num_rows($result)>0)
    {
        while ($row = mysqli_fetch_assoc($result))
        {
        $img_binhluan = "<img style='width:100px;' src=../".$row["img"].">";


        $bl_list_img.= $img_binhluan;

        }
    }

    include "close.php";

    return $bl_list_img;

}


function lay_hinhanhbinhluan($id_binhluan)
{
    include "conect.php";
    

    $sql = "SELECT * from tbl_img_binhluan where id_binhluan = $id_binhluan";
    $result = mysqli_query($conn,$sql);

    $bl_list_img ="";
    if (mysqli_num_rows($result)>0)
    {
        while ($row = mysqli_fetch_assoc($result))
        {
        $img_binhluan = '
        <img class="img_binhluan" src="'.$row["img"].'" alt="">
        ';

        $bl_list_img.= $img_binhluan;

        }
    }

    return $bl_list_img;

}

function hienthibinhluan($id_sp,$nguoi_dang_dangnhap,$start, $limit)
{
    require "./conect.php";
    

            $sql = "SELECT tbl_binhluan.id as id,tbl_binhluan.id_sanpham as id_sp,tbl_user.avata as avata,tbl_user.name as name,tbl_binhluan.ngay as ngay,tbl_binhluan.noidung as noidung,tbl_user.id_user FROM tbl_binhluan JOIN tbl_user on tbl_binhluan.id_user = tbl_user.id_user where tbl_binhluan.id_sanpham = $id_sp ORDER BY tbl_binhluan.id DESC LIMIT $start, $limit";
            $result = mysqli_query($conn,$sql);
            $style_edit_xoa = "";

            $bl_list_binhluan ="";
            if (mysqli_num_rows($result)>0)
            {
              while ($row = mysqli_fetch_assoc($result))
              {
                $id_binhluan = $row["id"];
                $avata_binhluan = $row["avata"];
                $name_binhluan = $row["name"];
                $ngaybinhluan = $row["ngay"];
                $noidungbinhluan = $row["noidung"];
                $id_user = $row["id_user"];
                $id_sp = $row["id_sp"];

                if($id_user == $nguoi_dang_dangnhap)
                {
                    $style_edit_xoa = "display: flex";
                }else
                {
                    $style_edit_xoa = "display: none";
                }



                
          
                $bl_binhluan ='
                <div class="bl_list_binhluan">
          
                      <div class="bl_binhluan">
                        <div class="bl_binhluan_left">
                        <img class="avata_binhluan" src=./img_user/'.$avata_binhluan.' alt="">
                        </div>
                        <div class="bl_binhluan_right">
                        <input class="user_binhluan_'.$id_user.'" type="hidden" value='.$id_user.'></input>
                          <div class="ten-user_binhluan">'.$name_binhluan.'</div>
                          <div class="ngay-binhluan_binhluan">'.$ngaybinhluan.'</div>
                          <div class="noidung_binhluan">'.$noidungbinhluan.'</div>
          
          
                          <div class="bl-anh_binhluan">
                            <div class="list-img_binhluan" style="gap: 5px;">
                              '.lay_hinhanhbinhluan($id_binhluan,$id_sp).'
                            </div>
                          </div>
                          <div class="bl_edit_binhluan">
                            <div class="like_and_edit_binhluan">
                              <div class="bl_like">
                                <div class="a_bl_like">
                                  <i class="fa-solid fa-thumbs-up btn-like_binhluan" name = '.$id_binhluan.'></i>
                          
                                  <div class="bl_soluotlike" name=id_btn_like_'.$id_binhluan.'>'.getsoluotlike_binhluan($id_binhluan).'</div>
                                </div>
          
                              </div>
          
                              <div class="bl_edit-binhluan">
                                <i class="fa-solid fa-ellipsis-vertical btn-edit_binhluan" name = '.$id_binhluan.'></i>
                                <div class="list-edit_binhluan" name='.$id_binhluan.'>
                                  <div class="edit-report_binhluan">Report</div>
                                  <div class="edit-xoa_binhluan" style="'.$style_edit_xoa.'"  name='.$id_binhluan.' id_user_binhluan='.$id_user.'>Xoa</div>
                                </div>
                              </div>
          
                            </div>
          
                          </div>
                        </div>
          
          
          
                      </div>
          
          
                    </div>
          
                ';
                $bl_list_binhluan.= $bl_binhluan;


                
          
                
               }
               return $bl_list_binhluan;

               require "close.php";
          }
}


function taobinhluan($noidungbinhluan,$id_sp,$id_user)
{
    require "./conect.php";

    $sql = "insert into tbl_binhluan(noidung,id_sanpham,id_user) values('".$noidungbinhluan."',$id_sp,$id_user)";
    if (mysqli_query($conn,$sql))
    {
        $last_id_binhluan = $conn->insert_id;
    }else
    {
        echo "Error:".$sql.mysqli_error($conn);
    }

    echo $last_id_binhluan;


    require "close.php";

}

function capnhaplaiimg_binhluan($id_binhluan,$remainingImages)
{
    require "./conect.php";
    $sqlDeleteAll = "DELETE FROM tbl_img_binhluan WHERE id_binhluan = $id_binhluan";
    if (mysqli_query($conn,$sqlDeleteAll))
    {

    }else
    {
        echo "Error:".$sql.mysqli_error($conn);
    }
    
    // Chèn lại danh sách ảnh còn lại
    foreach ($remainingImages as $imagePath) {
        $sqlInsert = "INSERT INTO tbl_img_binhluan (id_binhluan,img) VALUES ($id_binhluan,'".$imagePath."')";
        mysqli_query($conn,$sqlInsert);
    }

    require "close.php";
}


?>


