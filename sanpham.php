<?php
require "./conect.php";
require "./myfunc.php";
session_start();

// begin check session
if (!$_SESSION["user_name"])
{
  header("Location:./login.php");
}

$id_sanpham_hientai;

$sql = "select * from tbl_user where username = '".$_SESSION["user_name"]."' ";
$user_id;
$username;
$name;
$email;
$phone;
$avata;
$gender;
$data_of_birth;
$admin;
$result = mysqli_query($conn,$sql);


if (mysqli_num_rows($result)>0)
{
	while ($row = mysqli_fetch_assoc($result))
	{
      $user_id = $row["id_user"];
      $username = $row["username"];
      $name = $row["name"];
      $email = $row["email"];
      $phone = $row["phone"];
      $avata = $row["avata"];
      $gender = $row["gender"];
      $data_of_birth = $row["date_of_birth"];
      $admin = $row["admin"];

  }
  $_SESSION["id_user"] = $user_id;
  $_SESSION["admin"] = $admin;
}

// end check session







if ($_GET["idsp"])
{
  $id_sp = $_GET["idsp"];

  $sql = "select * from tbl_product where id= $id_sp";
  $result = mysqli_query($conn,$sql);
  if (mysqli_num_rows($result)>0)
  {
    while ($row = mysqli_fetch_assoc($result))
    {
      $name_sp = $row['name'];
      $min_price = $row['min_price'];
      $max_price = $row['max_price'];
      $description = $row['description'];
      $image = $row['image'];
      $category = $row['category'];
      $quantity = $row["quantity"];
  }
}


  
}


// cehck admin
$style_edit_xoa = "display:none;";
if($_SESSION["admin"]==1)
{
  $style_edit_xoa = "display:flex;";
}


// kiem tra dang nhap

if (!$_SESSION["user_name"])
{
  header("Location:./login.php");
}

//get data user

$sql = "select * from tbl_user where username = '".$_SESSION["user_name"]."' ";
$username;
$name;
$email;
$phone;
$avata;
$gender;
$date_of_birth;
$result = mysqli_query($conn,$sql);


if (mysqli_num_rows($result)>0)
{
	while ($row = mysqli_fetch_assoc($result))
	{
    
      $username = $row["username"];
      $name = $row["name"];
      $email = $row["email"];
      $phone = $row["phone"];
      $avata = $row["avata"];
      $gender = $row["gender"];
      $date_of_birth = $row["date_of_birth"];

  }

}

if(isset($_SESSION["id_user"]))
{
  $id_user = $_SESSION["id_user"];

}


// begin phan trang

$tongsobanghi;

$tranghientai = 1;

$limit = 4;
$sql = "select count(id) as total from tbl_binhluan where id_sanpham = $id_sp";
$result = mysqli_query($conn,$sql);

if (mysqli_num_rows($result)>0)
{
	while ($row = mysqli_fetch_assoc($result))
  {
    $tongsobanghi = $row['total'];
  }

}
if($tongsobanghi>0)
{
  $tongsotrang = ceil($tongsobanghi / $limit);
}else
{
  $tongsotrang = 1;
}





if(isset($_GET["page"]))
{
  $tranghientai = $_GET["page"];
}

if($tranghientai > $tongsotrang)
{
  $tranghientai = $tongsotrang;
}else if ($tranghientai < 1)
{
  $tranghientai = 1;
}

$start = ($tranghientai - 1) * $limit;



// end phan trang


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="./fontawesome-free-6.4.2-web/fontawesome-free-6.4.2-web/css/all.css" />
  <!-- <link rel="stylesheet" href="./fontawesome-free-6.4.2-web/fontawesome-free-6.4.2-web/css/reset.css"> -->
  <link rel="stylesheet" href="./css/address_sanpham.css">
  <link rel="stylesheet" href="./css/trang_chu.css">
  <link rel="stylesheet" href="./css/style_chitietsanpham.css">
  <link rel="stylesheet" href="./css/binhluan.css">
  <link rel="stylesheet" href="./css/phantrang_sanpham.css">






  <!-- <link rel="stylesheet" href="./form-control"> -->
  <link rel=" stylesheet" href="./css/reset.css">
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="./css/footer_Shopee.css">
  <link rel="stylesheet" href="./css/xem_them.css">
  <link rel="stylesheet" href="./css/responsive.css">
  <link rel="stylesheet" href="./css/tb.css">
  <!-- <link rel="stylesheet" href="./css/change_password.css"> -->
  <title>Document</title>
</head>

<body>
  <div class="fluid-container">
    <!-- Header -->
    <div class="fluid-container header">
      <div class="container header-connect">
        <ul class="header-connect__left">
          <li><a href="#!">Kênh Người Bán</a></li>
          <li><a href="#!">Trở thành Người bán Shopee</a></li>
          <li>
            <div class="dropdown">
              <div class="dropdown_select">
                <a href="#!">Tải ứng dụng</a>
              </div>
              <div class="dropdown_content">
                <img style="width: 180px; height: 230px; border-radius: 2px;" src="./img/QR.PNG" alt="">
              </div>
            </div>
          </li>
          <li><a href="#!">Kết nối</a></li>
          <li><a href="#!"><i class="fa-brands fa-facebook header-facebook__icon"></i></a></li>
          <li><a href="#!"><i class="fa-brands fa-instagram header-instagram__icon"></i></a></li>
        </ul>
        <ul class="header-connect__right">
          <div class="dropdown">
            <div class="dropdown_select">
              <li><a href="#!"><i class="fa-regular fa-bell"></i></a></li>
              <li><a href="#!">Thông báo</a></li>
            </div>
            <div class="dropdown_list">
              <div class="dropdown_item">
                <img style="width: 30%;" src="./img/tb.png" alt="">
                <p>Đăng nhập để xem Thông báo</p>
              </div>
              <!-- <div class="dropdown_item--bottom">
                <div class="sign">
                  <a href="./dang_nhap.html">Đăng nhập</a>
                </div>
                <div class="log">
                  <a href="./admin/register.php">Đăng ký</a>
                </div>
              </div> -->
            </div>
          </div>
          <li><a href="#!"><i class="fa-regular fa-bell"></i></a></li>
          <!-- <li><a href="#!">Thông Báo</a></li> -->
          <li><a href="#!"><i class="fa-solid fa-question"></i></a></li>
          <li><a href="#!">Hỗ Trợ</a></li>
          <li><a href="#!"><i class="fa-solid fa-globe"></i></a></li>
          <li><a href="#!">Tiếng Việt</a></li>
          <li><a href="#!"><i class="fa-solid fa-chevron-down"></i></a></li>
          <li class="li_avata_trangchu"><img class="avata_trangchu" src="./img_user/<?php echo $avata?>" alt=""></li>
          <li class="li_name_profile"><a href="./thongtin.php" style="padding:10px;"><?php echo $username?></a>
          <input id="id_user" type="hidden" name="<?php echo $id_user?>" style_edit_xoa="<?php echo $style_edit_xoa?>" value="<?php echo $id_user?>">
            <div class="bl_hover_profile">
              <ul class="bl_profile">
                <li id="li_name_profile"><a id="a_txt_myacount" href="./thongtin.php">My account</a></li>
                
                <li id="li_logout"><a id="a_txt_logout" href="./logout.php">Logout</a></li>

                <!-- begin check admin -->
                <!-- <?php
                if (isset($_SESSION['admin']) == true) {
                  // Ngược lại nếu đã đăng nhập
                  $admin = $_SESSION['admin'];
                  // Kiểm tra quyền của người đó có phải là admin hay không
                  if ($admin == 1) {
                    // Nếu không phải admin thì xuất thông báo
                    echo '<li id="li_admin"><a id="a_txt_admin" href="./admin/manage_user.php">Admin</a></li>';
                    
                  }
                }
                ?> -->

                <!-- end check admin -->
              </ul>
            </div>
          </li>
        </ul>
      </div>
      <div class="container header-find">
      <div class="header-find__img"><a href="./trangchu.php"><img src="./img/shopee_logo.png" alt="shopee_logo"></a></div>
        <div class="header-search__box">
          <div class="header-find">
            <input class="form-control header-find__input" type="text" placeholder="Shopee bao ship 0Đ - Đăng ký ngay!">
            <i class="fa-solid fa-magnifying-glass header-find__icon"></i>
          </div>
        </div>
        <div class="header-shop__iconwrapper">
          <a id="mygiohang" href="./viewcart.php"><i class="fa-solid fa-cart-shopping header-shop__icon"></i></a>
          
        </div>
      </div>
      <div class=" header-items">
        <ul class="header-items__wrapper">
          <li class="col-1">iPhone 1k</li>
          <li class="col-1">Đồ 1k</li>
          <li class="col-1">Ốp iPhone</li>
          <li class="col-1">Áo Thun</li>
          <li class="col-1">Túi Xách Nữ</li>
          <li class="col-1">Áo Khoác Dù</li>
          <li class="col-1">Áo Phông Nam</li>
          <li class="col-1">Dép Quai Hậu Nữ</li>
          <li class="col-1">Bình Giữ Nhiệt</li>
        </ul>
      </div>
    </div>
    <!-- begin body -->
    <div class="container bl_thongtin">

        <div class="bl-main_thongtin">

        <div class="container">
        <div class="boxsp container-chitetsanpham" style="position: relative; border:none !important;">

            <form action="addtocart.php" method="post" class="form-sanpham_sanphamchitiet">
            <img src="./img_product/<?php echo $image; ?>" alt="" class="img-sanpham_sanphamchitiet" style="object-fit: contain;">
                <div class="rest-sanpham">
                    <h4 class="tensp mgt-5"><?php echo $name_sp;?></h4>
                    <div class="line-fomat mgt-5"><p>Flash SALE</p></div>
                    <div class="bl_gia_chitietsanpham mgt-5">
                        <p class="min-gia"><?php echo $min_price;?></p>
                        <h3 class="max-gia"><?php echo $max_price;?></h3>
                    </div>
                    <input class="src_img"  type="hidden" name="img" value='./img_product/<?php echo $image;?>'>
                    <input class="ten_sp" type="hidden" name="tensp" value='<?php echo $name_sp;?>'>
                    <input class="min_price" type="hidden" name="gia" value=<?php echo $min_price?>>
                    <input class="id_sp" type="hidden" name="id" value=<?php echo $id_sp?>>
                    <div class="bl_soluong mgt-5">
                        <label for="quantity">Số lượng:  <input type="text" class="ip_soluong_chitietsanpham" name="quantity" id="quantity" value="1"></label>
                        <div class="quantity-container">
                            <input type="button" value="+" class="btn-quantity-tang" onclick="increaseQuantity()">
                            <input type="button" value="-" class="btn-quantity-giam" onclick="decreaseQuantity()">
                            
                        </div>
                    </div>
                    
                        
                        
                
                    
                    <div class="bl-themvaogiohang-muahang mgt-10">
                        <input class="btn_themgiohang" type="button" name="themvaogio" value="Thêm Vào Giỏ Hàng" id="btn-dathang_sanphamchitiet">
                        <input class="btn_muangay" type="submit" name="dathang" value="Mua Ngay">
                    </div>
                    
                </div>
            </form>
            
            <script type="text/javascript" src="jquery-3.7.1.min.js"></script>
            <script type="text/javascript">
              $(document).ready(function()
              {
               
                $(".btn_themgiohang").click(function(){

                  var src_img = $(".src_img").val();
                  var ten_sp = $(".ten_sp").val();
                  var min_price = $(".min_price").val();
                  
                  var id_sp = $(".id_sp").val();
                  var soluong = $("#quantity").val();
                  


                  $.post("addtocart.php",{img:src_img,tensp:ten_sp,gia:min_price,id:id_sp,quantity:soluong,themvaogio:true },function(data){
                      
                    $('.thongbaothemvaogio').fadeIn().css('display', 'flex');

           
                setTimeout(function() {
                    $('.thongbaothemvaogio').fadeOut();
                }, 3000);
                })


                  
                })

              })

            </script>





            
            
            <div class="thongbaothemvaogio" >
                  <div class="circle bl_tron" style=" width: 80px;
            height: 80px;
            background-color: #3dc284; /* Màu sắc của hình tròn */
            border-radius: 50%; 
            display:flex;"
            >
                  <i class="fa-solid fa-check icon-check" style="color: #ffffff; "></i>
              
          </div>

              <h2 class="txt-thongbaothemvaogiohang">Thêm sản phẩm vào giỏ hàng thành công !</h2>
              
              
            </div>
        </div>
    </div>
    

    <div class="container bl_container_description" style="border: none !important;">
        <div class="bl_description">
        <br>
            <h2>CHI TIẾT SẢN PHẨM</h2>
            <br>
            <table>
                <tr>
                    <td>Danh muc</td>
                    <td>Thiet bi</td>
                </tr>
                <tr>
                    <td>Xuat xu</td>
                    <td>viet nam</td>
                </tr>
            </table>

            <div class="bl_img_description">
            <img src="./img_product/<?php echo $image; ?>" alt="" class="img-sanpham_sanphamchitiet" style="margin-top: 5%;">
            </div>

        </div>

        <!-- bl binh luan  -->

        

    </div>


    
    <!-- begin upload binh loan -->

    <div class="container bl_container_nhap_binhluan">

          <div class="left_nhapbinhluan">
            <img class="avata_nhapbinhluan" src="./img_user/<?php echo $avata?>" alt="">

          </div>

          <div class="right_nhapbinhluan">
            <div class="bl_nhapbinhluan">
              <input id="input_nhapbinhluan" class="bl_media_inp_nhapbinhluan form-control" type="text">
              <div class="block_send_media_and_text">
                <div class="media_binhluan">
                  <input type="file" id="fileInput" multiple style="display: none;" enctype="multipart/form-data">
                  <label for="fileInput" class="file-upload-btn">
                    <i class="fa-solid fa-image img_gui_binhluan" style="color: #804242;"></i>
                  </label>






                </div>
                <div class="btn_gui_binhluan">
                  <button id="btn_gui" class="btn_gui_binhluan"><i class="icon_gui_binhluan fa-solid fa-paper-plane"
                      style="color: #f22121;"></i></button>
                </div>
              </div>
              <!-- begin anh tai len -->

              <div id="selectedImagesContainer" class="bl_list_img_guibinhluan">

              </div>

              <!-- end anh tai len -->

            </div>


          </div>

          <script>
                      function displaySelectedImages(imagePaths) {
              var selectedImagesContainer = $('#selectedImagesContainer');
              selectedImagesContainer.empty(); // Xóa nội dung hiện tại

              imagePaths.forEach(function(imagePath) {
                  var imgContainer = $('<div>').addClass('bl_img_gui_binhluan').css('height', '68px');

                  var imgElement = $('<img>').attr('src', imagePath).addClass('img_gui_binhluan');

                  var deleteButton = $('<button>').addClass('circel_xoa_anh_guibinhluan');
                  deleteButton.html('<i class="fa-solid fa-x" style="color: #ff0c0c;"></i>');
                  deleteButton.click(function() {
                      // Xóa hình ảnh khi nút xóa được nhấn
                      imgContainer.remove();

                      
                      
                  });

                  imgContainer.append(imgElement);
                  imgContainer.append(deleteButton);

                  selectedImagesContainer.append(imgContainer);
              });
          }

          function getRemainingImages() {
              var remainingImages = [];
              $('#selectedImagesContainer img').each(function() {
                  remainingImages.push($(this).attr('src'));
              });
              return remainingImages;
          }

          

          function updateDatabase(remainingImages,id_binhluan_vuatao) {
              // Gửi yêu cầu cập nhật cơ sở dữ liệu với danh sách ảnh còn lại
              $.ajax({
                  url: 'update_img_database.php',
                  type: 'POST',
                  data: { images: remainingImages,id_binhluan:id_binhluan_vuatao },
                  success: function(response) {
                      // Cập nhật cơ sở dữ liệu thành công (nếu cần)
                     
                      
                  }
              });
          }

          $(document).ready(function() {

             // begin gui
             let btn_guibinhluan = $("#btn_gui");
             let noidungbinhluan = $("#input_nhapbinhluan");
             let id_sp = $(".id_sp").val();
              let id_user = $('#id_user').val();

          

                    btn_guibinhluan.click(function() {

                      
                      
                      
                      
                     
                        $.ajax({
                      url: 'upload_img_binhluan.php',
                      type: 'POST',
                      data: { send: true,noidungbinhluan:noidungbinhluan.val(),id_sp:id_sp,id_user:id_user},
                      success: function(response) {
                        // Cập nhật cơ sở dữ liệu
                        

                      var remainingImages = getRemainingImages();
                      if (getRemainingImages().length > 0)
                      {
                        updateDatabase(remainingImages,response);
                        location.reload(); 
                      }else{
                        location.reload(); 
                      }

                          // Cập nhật cơ sở dữ liệu thành công (nếu cần)
                        
                      }
                  });
                    });
                    // end gui

              $('#fileInput').change(function() {
                  var files = $('#fileInput')[0].files;
                  var formData = new FormData();

                  for (var i = 0; i < files.length; i++) {
                      formData.append('files[]', files[i]);
                  }
                  var numberOfElements = Array.from(formData.entries()).length;

                  if(numberOfElements >9)
                  {
                    alert("Chỉ được chọn tối đa 9 ảnh ");
                  }else
                  {

                   
                    formData.append('content', 'helo');

                        $.ajax({
                      url: 'upload_img_binhluan.php',
                      type: 'POST',
                      data: formData,
                      contentType: false,
                      processData: false,
                      success: function(response) {
                          // Chuyển đổi chuỗi JSON thành mảng đường dẫn hình ảnh
                         var bl_container_nhap_binhluan = $(".bl_container_nhap_binhluan").css('height', '275px');

                          var imagePaths = JSON.parse(response);

                          

                            displaySelectedImages(imagePaths);
                        }
                    });
                  }
                  
              });
          });

          </script>




        </div>

        <!-- end upload binh loan -->

    <div class="container bl_container_binhluan">

              

          <!-- begin hien thi list binh luan  -->
              <?php echo hienthibinhluan($id_sp,$user_id,$start,$limit)?>
              
          <!-- end hien thi list binh luan -->

    </div>
    
    <!-- begin btn phan trang -->
    <div class="container-fluid bl-phantrang">
          <div class="lb_btn_phantrang">
            <?php
            
            $trang_prev = $tranghientai-1;
            if ($trang_prev == 0)
            {
              $trang_prev = 1;
            }
            $trang_next = $tranghientai+1;
            if ($trang_next == 0)
            {
              $trang_next = 1;
            }
            

            

            //
            echo "<button type='submit' class='btn-phantrang btn btn-light' >";
            // echo "<a href='http://localhost/unitop-php/thuchanh/admin/index.php?page=".$trang_prev."' >prev</a>";
            echo "<a href='./sanpham.php?idsp=$id_sp&page=".$trang_prev."' ><</a>";

            
          echo "</button>";
            //
            for ($i = 1; $i <= $tongsotrang;$i++)
            {
              // style='background-color: #EE4D2D;'

              echo "<button type='submit' class='btn-phantrang btn btn-light trangchuachon' >";
            // echo "<a href='http://localhost/unitop-php/thuchanh/admin/index.php?page=".$i."' >$i</a>";

            // style='color: #fff;'
            echo "<a  href='./sanpham.php?idsp=$id_sp&page=".$i."'>$i</a>";

          echo "</button>";
            }

            echo "<button type='submit' class='btn-phantrang btn btn-light' >";
            // echo "<a href='http://localhost/unitop-php/thuchanh/admin/index.php?page=".$trang_next."' >prev</a>";
            echo "<a href='./sanpham.php?idsp=$id_sp&page=".$trang_next."' >></a>";
          echo "</button>";

         
            
            ?>
            
           
          </div>
        </div>

    <!-- end btn phan trang -->
    
    



    
          <!-- ajax binh luan -->
        <script type="text/javascript" src="jquery-3.7.1.min.js"></script>
            <script type="text/javascript">


            


           
            
            
              
            



              var id_user = $('#id_user').attr('name');
              // begin load binh luan




              // end load binh luan

              $(document).ready(function()
              {

              

                

              




                var btn_like = $(this);
                //begin load trang thai like
                $(".btn-like_binhluan").each(function(index,element) {
                  var id_binhluan =  $(this).attr("name");
                  $.post("xuly_binhluan.php",{id_user_binhluan:id_user,id_binhluan:id_binhluan,checked_like:true},function(data){
                    if(data)
                    {
                      $(element).addClass("liked");
                    }
                  });

                });

                 
                  


                

                  
                

                //end load trang thai like

               
                $(".btn-like_binhluan").each(function() {
                   let id_sp = $(".id_sp").val();


                 
                  
                 $(this).click(function() {
                    
                    
                    if ($(this).hasClass("liked")) {
                      var id_binhluan_vs2 =  $(this).attr("name");
                      let soluotlike1 = $('.bl_soluotlike[name="id_btn_like_'.concat(id_binhluan_vs2)+'"]');
                      $(this).removeClass("liked");
                      $.post("xuly_binhluan.php",{id_user_binhluan:id_user,disliked:true,id_binhluan:id_binhluan_vs2},function(data){

                        
                        $.post("xuly_binhluan.php",{id_binhluan:id_binhluan_vs2,soluonglike:true},function(data6){

                          

                      soluotlike1.text(data6);

                      });



                      });


                    

                    } else {
                      var id_binhluan =  $(this).attr("name");
                    // alert(id_binhluan);
                    let soluotlike = $('.bl_soluotlike[name="id_btn_like_'.concat(id_binhluan)+'"]');
                        $(this).addClass("liked");
                        $.post("xuly_binhluan.php",{id_user_binhluan:id_user,id_binhluan:id_binhluan,liked:true},function(data){

                          
                          $.post("xuly_binhluan.php",{id_binhluan:id_binhluan,soluonglike:true},function(data2){

                            soluotlike.text(data2);

                            });
                          
                        
                          
                        });

                    }


                  
                    
                    
                      });
                  });



                   // block edit binh luan| edit-xoa_binhluan

                  // begin xoa binh luan
                  $(".edit-xoa_binhluan").each(function() {
                    let id_sp = $(".id_sp").val();
                    

                    $(this).click(function() {
                      let id_binhluan_edit_xoa = $(this).attr("name");
                      let id_user_binhluan = $(this).attr("id_user_binhluan");
                      let style_edit_xoa = $('#id_user').attr('name');
                      let id_user_dangsudung = $('#id_user').val();
                      
                    
                      $.post("xuly_binhluan.php",{id_user_dangsudung:id_user_dangsudung,id_binhluan:id_binhluan_edit_xoa,id_sanpham:id_sp,id_user_binhluan:id_user_binhluan,style_edit_xoa:style_edit_xoa,xoa_binhluan:true},function(data){

                        
                        location.reload(); 
                       

                    });
                    });


                    
                    


                });
                 // end xoa binh luan


                    // begin hien thi edit binh luan
                    $(".btn-edit_binhluan").each(function() {
                    let id_binhluan_edit = $(this).attr("name");
                    
                    let divElement = $(`.list-edit_binhluan[name="${id_binhluan_edit}"]`);

                    $(this).click(function() {
                        // Kiểm tra xem nút đã có class "opend-edit_binhluan" hay chưa
                        if (divElement.hasClass("opend-edit_binhluan")) {
                            divElement.removeClass("opend-edit_binhluan");
                        } else {
                            divElement.addClass("opend-edit_binhluan");
                        }
                    });


                });

                // end hien thi edit binh luan



              })


             



             

              

            </script>

        </div>
    </div>

    <!-- begin body -->

    <div class="Footer_Shopee">
      <div class="PhuLuc_QG">
        <div class="PhuLuc">
          <div class="ThanhPhan_PL">
            <div class="TieuDe_PL">Chăm Sóc Khách Hàng</div>
            <ul class="DanhSachTP_PL">
              <li class="TP_PL">
                <a class="Link_PL" href="https://help.shopee.vn/portal" title="_blank" rel="noopener noreferrer">
                  <span class="TenTP_PL">Trung Tâm Trợ Giúp</span>
                </a>
              </li>
              <li class="TP_PL">
                <a class="Link_PL" href="https://shopee.vn/blog/" title="_blank" rel="noopener noreferrer">
                  <span class="TenTP_PL">Shopee Blog</span>
                </a>
              </li>
              <li class="TP_PL">
                <a class="Link_PL"
                  href="https://help.shopee.vn/portal/article/79090-[Th%C3%A0nh-vi%C3%AAn-m%E1%BB%9Bi]-Shopee-Mall-l%C3%A0-g%C3%AC?previousPage=search%20recommendation%20bar"
                  title="_blank" rel="noopener noreferrer">
                  <span class="TenTP_PL">Shopee Mall</span>
                </a>
              </li>
              <li class="TP_PL">
                <a class="Link_PL"
                  href="https://help.shopee.vn/portal/article/79180-[Th%c3%a0nh-vi%c3%aan-m%e1%bb%9bi]-L%c3%a0m-sao-%c4%91%e1%bb%83-mua-h%c3%a0ng-%2F-%c4%91%e1%ba%b7t-h%c3%a0ng-tr%c3%aan-%e1%bb%a9ng-d%e1%bb%a5ng-Shopee%3F"
                  title="_blank" rel="noopener noreferrer">
                  <span class="TenTP_PL">Hướng Dẫn Mua Hàng</span>
                </a>
              </li>
              <li class="TP_PL">
                <a class="Link_PL" href="https://banhang.shopee.vn/edu/article/13243/ban-hang-online-bat-dau-tu-dau"
                  title="_blank" rel="noopener noreferrer">
                  <span class="TenTP_PL">Hướng Dẫn Bán Hàng</span>
                </a>
              </li>
              <li class="TP_PL">
                <a class="Link_PL"
                  href="https://help.shopee.vn/portal/category/59-Thanh-To%C3%A1n/708-V%C3%AD-ShopeePay?page=1"
                  title="_blank" rel="noopener noreferrer">
                  <span class="TenTP_PL">Thanh Toán</span>
                </a>
              </li>
              <li class="TP_PL">
                <a class="Link_PL"
                  href="https://help.shopee.vn/portal/article/79144-[Shopee-Xu]-C%c3%a1c-c%c3%a2u-h%e1%bb%8fi-th%c6%b0%e1%bb%9dng-g%e1%ba%b7p"
                  title="_blank" rel="noopener noreferrer">
                  <span class="TenTP_PL">Shopee Xu</span>
                </a>
              </li>
              <li class="TP_PL">
                <a class="Link_PL"
                  href="https://help.shopee.vn/portal/category/60-%C4%90%C6%A1n-H%C3%A0ng-V%E1%BA%ADn-Chuy%E1%BB%83n/703-%C4%90%C6%A1n-h%C3%A0ng?page=1"
                  title="_blank" rel="noopener noreferrer">
                  <span class="TenTP_PL">Vận Chuyển</span>
                </a>
              </li>
              <li class="TP_PL">
                <a class="Link_PL"
                  href="https://help.shopee.vn/portal/article/79258-Tr%e1%ba%a3-h%c3%a0ng%2FHo%c3%a0n-ti%e1%bb%81n]-C%e1%ba%a9m-nang-Tr%e1%ba%a3-h%c3%a0ng-ho%c3%a0n-ti%e1%bb%81n"
                  title="_blank" rel="noopener noreferrer">
                  <span class="TenTP_PL">Trả Hàng & Hoàn Tiền</span>
                </a>
              </li>
              <li class="TP_PL">
                <a class="Link_PL"
                  href="https://help.shopee.vn/portal/article/79191-%5BD%E1%BB%8Bch-v%E1%BB%A5%5D-L%C3%A0m-sao-%C4%91%E1%BB%83-li%C3%AAn-h%E1%BB%87-Ch%C4%83m-s%C3%B3c-Kh%C3%A1ch-h%C3%A0ng"
                  title="_blank" rel="noopener noreferrer">
                  <span class="TenTP_PL">Chăm Sóc Khách Hàng</span>
                </a>
              </li>
              <li class="TP_PL">
                <a class="Link_PL"
                  href="https://help.shopee.vn/portal/article/79046-[Quy-%c4%91%e1%bb%8bnh]-Ch%c3%adnh-s%c3%a1ch-b%e1%ba%a3o-h%c3%a0nh-cho-s%e1%ba%a3n-ph%e1%ba%a9m-mua-t%e1%ba%a1i-Shopee"
                  title="_blank" rel="noopener noreferrer">
                  <span class="TenTP_PL">Chính Sách Bảo Hành</span>
                </a>
              </li>
            </ul>
          </div>
          <div class="ThanhPhan_PL">
            <div class="TieuDe_PL">Về SHOPEE</div>
            <ul class="DanhSachTP_PL">
              <li class="TP_PL">
                <a class="Link_PL" href="https://careers.shopee.vn/about" title="_blank" rel="noopener noreferrer">
                  <span class="TenTP_PL">Giới Thiệu Về Shopee Việt Nam</span>
                </a>
              </li>
              <li class="TP_PL">
                <a class="Link_PL" href="https://careers.shopee.vn/jobs" title="_blank" rel="noopener noreferrer">
                  <span class="TenTP_PL">Tuyển Dụng</span>
                </a>
              </li>
              <li class="TP_PL">
                <a class="Link_PL" href="https://help.shopee.vn/portal/article/77242" title="_blank"
                  rel="noopener noreferrer">
                  <span class="TenTP_PL">Điều Khoản Shopee</span>
                </a>
              </li>
              <li class="TP_PL">
                <a class="Link_PL" href="https://help.shopee.vn/portal/article/77244" title="_blank"
                  rel="noopener noreferrer">
                  <span class="TenTP_PL">Chính Sách Bảo Mật</span>
                </a>
              </li>
              <li class="TP_PL">
                <a class="Link_PL" href="https://shopee.vn/mall/" title="_blank" rel="noopener noreferrer">
                  <span class="TenTP_PL">Chính Sách</span>
                </a>
              </li>
              <li class="TP_PL">
                <a class="Link_PL" href="https://banhang.shopee.vn/" title="_blank" rel="noopener noreferrer">
                  <span class="TenTP_PL">Kênh Người Bán</span>
                </a>
              </li>
              <li class="TP_PL">
                <a class="Link_PL" href="https://shopee.vn/flash_sale/" title="_blank" rel="noopener noreferrer">
                  <span class="TenTP_PL">Flash Sales</span>
                </a>
              </li>
              <li class="TP_PL">
                <a class="Link_PL" href="https://shopee.vn/affiliate/" title="_blank" rel="noopener noreferrer">
                  <span class="TenTP_PL">Chương Trình Tiếp Thị Liên Kết Shopee</span>
                </a>
              </li>
              <li class="TP_PL">
                <a class="Link_PL" href="media.vn@shopee.com" title="_blank" rel="noopener noreferrer">
                  <span class="TenTP_PL">Liên Hệ Với Truyền Thông</span>
                </a>
              </li>
            </ul>
          </div>
          <div class="ThanhPhan_PL">
            <div class="TieuDe_PL">THANH TOÁN</div>
            <ul class="DanhSachAnh_PL">
              <li class="TPAnh_PL">
                <a target="_blank" rel="noopener noreferrer" class="LinkAnh_PL">
                  <img src="https://down-vn.img.susercontent.com/file/d4bbea4570b93bfd5fc652ca82a262a8" alt="logo">
                </a>
              </li>
              <li class="TPAnh_PL">
                <a target="_blank" rel="noopener noreferrer" class="LinkAnh_PL">
                  <img src="https://down-vn.img.susercontent.com/file/a0a9062ebe19b45c1ae0506f16af5c16" alt="logo">
                </a>
              </li>
              <li class="TPAnh_PL">
                <a target="_blank" rel="noopener noreferrer" class="LinkAnh_PL">
                  <img src="https://down-vn.img.susercontent.com/file/38fd98e55806c3b2e4535c4e4a6c4c08" alt="logo">
                </a>
              </li>
              <li class="TPAnh_PL">
                <a target="_blank" rel="noopener noreferrer" class="LinkAnh_PL">
                  <img src="https://down-vn.img.susercontent.com/file/bc2a874caeee705449c164be385b796c" alt="logo">
                </a>
              </li>
              <li class="TPAnh_PL">
                <a target="_blank" rel="noopener noreferrer" class="LinkAnh_PL">
                  <img src="https://down-vn.img.susercontent.com/file/2c46b83d84111ddc32cfd3b5995d9281" alt="logo">
                </a>
              </li>
              <li class="TPAnh_PL">
                <a target="_blank" rel="noopener noreferrer" class="LinkAnh_PL">
                  <img src="https://down-vn.img.susercontent.com/file/5e3f0bee86058637ff23cfdf2e14ca09" alt="logo">
                </a>
              </li>
              <li class="TPAnh_PL">
                <a target="_blank" rel="noopener noreferrer" class="LinkAnh_PL">
                  <img src="https://down-vn.img.susercontent.com/file/9263fa8c83628f5deff55e2a90758b06" alt="logo">
                </a>
              </li>
              <li class="TPAnh_PL">
                <a target="_blank" rel="noopener noreferrer" class="LinkAnh_PL">
                  <img src="https://down-vn.img.susercontent.com/file/0217f1d345587aa0a300e69e2195c492" alt="logo">
                </a>
              </li>
            </ul>
            <div class="TieuDe_PL">ĐƠN VỊ VẬN CHUYỂN</div>
            <ul class="DanhSachAnh_PL">
              <li class="TPAnh_PL">
                <a target="_blank" rel="noopener noreferrer" class="LinkAnh_PL">
                  <img src="https://down-vn.img.susercontent.com/file/vn-50009109-159200e3e365de418aae52b840f24185"
                    alt="logo">
                </a>
              </li>
              <li class="TPAnh_PL">
                <a target="_blank" rel="noopener noreferrer" class="LinkAnh_PL">
                  <img src="https://down-vn.img.susercontent.com/file/d10b0ec09f0322f9201a4f3daf378ed2" alt="logo">
                </a>
              </li>
              <li class="TPAnh_PL">
                <a target="_blank" rel="noopener noreferrer" class="LinkAnh_PL">
                  <img src="https://down-vn.img.susercontent.com/file/77bf96a871418fbc21cc63dd39fb5f15" alt="logo">
                </a>
              </li>
              <li class="TPAnh_PL">
                <a target="_blank" rel="noopener noreferrer" class="LinkAnh_PL">
                  <img src="https://down-vn.img.susercontent.com/file/59270fb2f3fbb7cbc92fca3877edde3f" alt="logo">
                </a>
              </li>
              <li class="TPAnh_PL">
                <a target="_blank" rel="noopener noreferrer" class="LinkAnh_PL">
                  <img src="https://down-vn.img.susercontent.com/file/957f4eec32b963115f952835c779cd2c" alt="logo">
                </a>
              </li>
              <li class="TPAnh_PL">
                <a target="_blank" rel="noopener noreferrer" class="LinkAnh_PL">
                  <img src="https://down-vn.img.susercontent.com/file/0d349e22ca8d4337d11c9b134cf9fe63" alt="logo">
                </a>
              </li>
              <li class="TPAnh_PL">
                <a target="_blank" rel="noopener noreferrer" class="LinkAnh_PL">
                  <img src="https://down-vn.img.susercontent.com/file/3900aefbf52b1c180ba66e5ec91190e5" alt="logo">
                </a>
              </li>
              <li class="TPAnh_PL">
                <a target="_blank" rel="noopener noreferrer" class="LinkAnh_PL">
                  <img src="https://down-vn.img.susercontent.com/file/6e3be504f08f88a15a28a9a447d94d3d" alt="logo">
                </a>
              </li>
              <li class="TPAnh_PL">
                <a target="_blank" rel="noopener noreferrer" class="LinkAnh_PL">
                  <img src="https://down-vn.img.susercontent.com/file/b8348201b4611fc3315b82765d35fc63" alt="logo">
                </a>
              </li>
              <li class="TPAnh_PL">
                <a target="_blank" rel="noopener noreferrer" class="LinkAnh_PL">
                  <img src="https://down-vn.img.susercontent.com/file/0b3014da32de48c03340a4e4154328f6" alt="logo">
                </a>
              </li>
              <li class="TPAnh_PL">
                <a target="_blank" rel="noopener noreferrer" class="LinkAnh_PL">
                  <img src="	https://down-vn.img.susercontent.com/file/vn-50009109-ec3ae587db6309b791b78eb8af6793fd"
                    alt="logo">
                </a>
              </li>
            </ul>

          </div>
          <div class="ThanhPhan_PL">
            <div class="TieuDe_PL">THEO DÕI CHÚNG TÔI</div>
            <ul class="DanhSachTP_PL">
              <li class="TP_PL">
                <a class="Link_PL" title="_blank" rel="noopener noreferrer" href="https://www.facebook.com/ShopeeVN">
                  <img class="Icon_PL" src="https://down-vn.img.susercontent.com/file/2277b37437aa470fd1c71127c6ff8eb5"
                    alt="logo">
                  <span class="TenTP_PL">FaceBook</span>
                </a>
              </li>
              <li class="TP_PL">
                <a class="Link_PL" title="_blank" rel="noopener noreferrer" href="https://www.instagram.com/Shopee_VN/">
                  <img class="Icon_PL" src="https://down-vn.img.susercontent.com/file/5973ebbc642ceee80a504a81203bfb91"
                    alt="logo">
                  <span class="TenTP_PL">Instagram</span>
                </a>
              </li>
              <li class="TP_PL">
                <a class="Link_PL" title="_blank" rel="noopener noreferrer"
                  href="https://www.linkedin.com/authwall?trk=bf&trkInfo=AQEUYLnJNXTieQAAAYpWQcr4OKjcWFSOoyvLhKqW5L2qjV9B-Rz96p868TP8I45SLo01wmojFdSrEIMu1ImiY1oXcGdaJN24sfJlLtVWBRTM7Bohw_5pynJsztU7lLwg5m04WOI=&original_referer=&sessionRedirect=https%3A%2F%2Fwww.linkedin.com%2Fcompany%2Fshopee">
                  <img class="Icon_PL" src="https://down-vn.img.susercontent.com/file/f4f86f1119712b553992a75493065d9a"
                    alt="logo">
                  <span class="TenTP_PL">Linkedin</span>
                </a>
              </li>
            </ul>
          </div>
          <div class="ThanhPhan_PL">
            <div class="TieuDe_PL">Tải Ứng Dụng Shopee</div>
            <div class="LinkDownLoad_PL">
              <a target="_blank" rel="noopener noreferrer" href="https://shopee.vn/web">
                <img class="QRCode_PL" src="https://down-vn.img.susercontent.com/file/a5e589e8e118e937dc660f224b9a1472"
                  alt="QR code">
              </a>
              <div class="DanhSachApp_PL">
                <a target="_blank" rel="noopener noreferrer" class="App_PL" href="https://shopee.vn/web"><img
                    src="	https://down-vn.img.susercontent.com/file/ad01628e90ddf248076685f73497c163" alt=""></a>
                <a target="_blank" rel="noopener noreferrer" class="App_PL" href="https://shopee.vn/web"><img
                    src="https://down-vn.img.susercontent.com/file/ae7dced05f7243d0f3171f786e123def" alt=""></a>
                <a target="_blank" rel="noopener noreferrer" class="App_PL" href="https://shopee.vn/web"><img
                    src="https://down-vn.img.susercontent.com/file/35352374f39bdd03b25e7b83542b2cb0" alt=""></a>
              </div>
            </div>
          </div>
        </div>
        <div class="KhungQuyen_QG">
                  <div class=" QuyenShopee Cachdong">© 2023 Shopee. Tất cả các quyền được bảo lưu.</div>
        <div class="DanhSach_QG">
          <div class="TieuDe_QG Cachdong">Quốc gia & Khu vực: </div>
          <div class="Khung_QG">
            <a class="Cachdong Ten_QG" href="https://shopee.sg">Singapore</a>
          </div>
          <div class="Khung_QG">
            <a class="Cachdong Ten_QG" href="https://shopee.co.id/">Indonesia</a>
          </div>
          <div class="Khung_QG">
            <a class="Cachdong Ten_QG" href="https://shopee.tw/">Đài Loan</a>
          </div>
          <div class="Khung_QG">
            <a class="Cachdong Ten_QG" href="https://shopee.co.th/">Thái Lan</a>
          </div>
          <div class="Khung_QG">
            <a class="Cachdong Ten_QG" href="https://shopee.com.my/">Malaysia</a>
          </div>
          <div class="Khung_QG">
            <a class="Cachdong Ten_QG" href="https://shopee.vn/">Việt Nam</a>
          </div>
          <div class="Khung_QG">
            <a class="Cachdong Ten_QG" href="https://shopee.ph/">Philippines</a>
          </div>
          <div class="Khung_QG">
            <a class="Cachdong Ten_QG" href="https://shopee.com.br/">Brazil</a>
          </div>
          <div class="Khung_QG">
            <a class="Cachdong Ten_QG" href="https://shopee.com.mx/">México</a>
          </div>
          <div class="Khung_QG">
            <a class="Cachdong Ten_QG" href="https://shopee.com.co/">Colombia</a>
          </div>
          <div class="Khung_QG">
            <a class="Cachdong Ten_QG" href="https://shopee.cl/">Chile</a>
          </div>
        </div>
      </div>
    </div>
    <div class="CS_TT">
      <div class="Khung_CS_TT">
        <div class="Chinh_Sach">
          <div class="TT_ChinhSach">
            <a class="Ten_Chinh_Sach" href="https://help.shopee.vn/portal/article/77244">
              <span>CHÍNH SÁCH BẢO MẬT</span>
            </a>
          </div>
          <div class="TT_ChinhSach">
            <a class="Ten_Chinh_Sach" href="https://help.shopee.vn/portal/article/77245">
              <span>QUY CHẾ HOẠT ĐỘNG</span>
            </a>
          </div>
          <div class="TT_ChinhSach">
            <a class="Ten_Chinh_Sach" href="https://help.shopee.vn/portal/article/77250">
              <span>CHÍNH SÁCH VẬN CHUYỂN</span>
            </a>
          </div>
          <div class="TT_ChinhSach">
            <a class="Ten_Chinh_Sach" href="https://help.shopee.vn/portal/article/77251">
              <span>CHÍNH SÁCH TRẢ HÀNG VÀ HOÀN TIỀN</span>
            </a>
          </div>
        </div>
        <div class="Logo_ChungNhan">
          <a class="Logo_ChinhSach" target="_blank" rel="noopener noreferrer"
            href="http://online.gov.vn/Home/WebDetails/18367">
            <img style="height:45px; width: 120px;" src="https://luatthienduc.vn/cloud/image-20200115095241-1.png"
              alt="">
          </a>
          <a class="Logo_ChinhSach" target="_blank" rel="noopener noreferrer"
            href="http://online.gov.vn/HomePage/AppDisplay.aspx?DocId=29">
            <img style="height:45px; width: 120px;" src="https://luatthienduc.vn/cloud/image-20200115095241-1.png"
              alt="">
          </a>
          <a class="Logo_ChinhSach" target="_blank" rel="noopener noreferrer" href="https://shopee.vn/docs/170">
            <img style="height: 48px ;width: 48px ;"
              src="https://cenlyvietnam.vn/wp-content/uploads/2020/06/noi-khong-voi-hang-gia-400x400.png" alt="">
          </a>
        </div>
        <div class="Dia_Chi Can_DiaChi">Công ty TNHH Shopee</div>
        <div class="Dia_Chi">
          "Địa chỉ: Tầng 4-5-6, Tòa nhà Capital Place, số 29 đường Liễu Giai, Phường Ngọc Khánh, Quận Ba Đình, Thành phố
          Hà Nội, Việt Nam. Tổng đài hỗ trợ: 19001221 - Email: cskh@hotro.shopee.vn"
        </div>
        <div class="Dia_Chi">
          "Chịu Trách Nhiệm Quản Lý Nội Dung: Nguyễn Đức Trí - Điện thoại liên hệ: 024 73081221 (ext 4678)"
        </div>
        <div class="Dia_Chi">
          "Mã số doanh nghiệp: 0106773786 do Sở Kế hoạch & Đầu tư TP Hà Nội cấp lần đầu ngày 10/02/2015"
        </div>
        <div class="Dia_Chi">
          "© 2015 - Bản quyền thuộc về Công ty TNHH Shopee"
        </div>
      </div>
    </div>
  </div>

  </footer>
</body>


<!-- <script src="./js/main.js"></scrip> -->
<script src="./js/address.js"></script>
<script src="./js/js_chitietsanpham.js"></script>



</html>