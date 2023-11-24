<?php
session_start();
require "./conect.php";

if (!$_SESSION["user_name"])
{
  header("Location:./login.php");
}

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
// $_SESSION["id_user"] = $user_id;
// $_SESSION["admin"] = $admin;

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
  <link rel="stylesheet" href="./fontawesome-free-6.4.2-web/fontawesome-free-6.4.2-web/css/reset.css">
  <link rel="stylesheet" href="./css/trang_chu.css">
  
  <link rel="stylesheet" href="./form-control">
  <link rel=" stylesheet" href="./css/reset.css">
  
  <link rel="stylesheet" href="./css/footer_Shopee.css">
  <link rel="stylesheet" href="./css/xem_them.css">
  <link rel="stylesheet" href="./css/responsive.css">
  <link rel="stylesheet" href="./css/tb.css">
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
                  <a href="./dang_nhap.html" >Đăng nhập</a>
                </div>
                <div class="log">
                  <a href="./admin/dangky.php">Đăng ký</a>
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
          <li class="li_avata_trangchu"><img class="avata_trangchu" src="<?php echo $avata?>" alt=""></li>
          <li class="li_name_profile"><a href="./thongtin.php" style="padding:10px;" ><?php echo $username?></a>
            <div class="bl_hover_profile">
              <ul class="bl_profile">
                <li id="li_name_profile"><a id="a_txt_myacount" href="./thongtin.php">My account</a></li>
                <li id="li_logout"><a id="a_txt_logout" href="./logout.php">Logout</a></li>
                <?php
                if (isset($_SESSION['admin']) == true) {
                  // Ngược lại nếu đã đăng nhập
                  $admin = $_SESSION['admin'];
                  // Kiểm tra quyền của người đó có phải là admin hay không
                  if ($admin == 1) {
                    // Nếu không phải admin thì xuất thông báo
                    echo '<li id="li_admin"><a id="a_txt_admin" href="./admin/manage_user.php">Admin</a></li>';
                    
                  }
                }
                ?>
                <!-- <li id="li_admint"><a id="a_txt_admin" href="./admin/manage_user.php">Admin</a></li> -->
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
        <!-- begin icon gio hang  -->
        <div class="header-shop__iconwrapper">
          <a id="mygiohang" href="./viewcart.php"><i class="fa-solid fa-cart-shopping header-shop__icon"></i></a>
          
        </div>

        <!-- end icon gio hang  -->
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

    <!-- Banner -->
    <div class="container banner-slider">
      <div class="banner-slider__wrapper">
        <div class="banner-slider__left">
          <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img class="d-block w-100" src="./img/slide-1.jpg" alt="First slide">
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" src="./img/slide-2.jpg" alt="Second slide">
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" src="./img/slide-3.jpg" alt="Third slide">
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
        </div>
        <div class="banner-slider__right">
          <div class="banner-first">
            <img src="./img/slide-right-1.jpg" alt="">
          </div>
          <div class="banner-second">
            <img src="./img/slide-right-2.jpg" alt="">
          </div>
        </div>
      </div>
    </div>

    <!-- Deal -->
    <div class="container deal-icon">
      <ul class="deal-icon__wrapper">
        <li class="deal-icon__item">
          <img src="./img/uu_dai-1.png" alt="">
          <p>Khung Giờ Săn Sale </p>
        </li>
        <li class="deal-icon__item">
          <img src="./img/uu_dai-2.png" alt="">
          <p>Miễn Phí Ship - Có Shopee </p>
        </li>
        <li class="deal-icon__item">
          <img src="./img/uu_dai-3.png" alt="">
          <p>Voucher Giảm Đến 500.000Đ </p>
        </li>
        <li class="deal-icon__item">
          <img src="./img/uu_dai-4.png" alt="">
          <p>Hàng Hiệu Outlet Giảm 50% </p>
        </li>
        <li class="deal-icon__item">
          <img src="./img/uu_dai-5.png" alt="">
          <p>Mã Giảm Giá </p>
        </li>
        <li class="deal-icon__item">
          <img src="./img/uu_dai-6.png" alt="">
          <p>Gì Cũng Rẻ - Deal Sốc 9.000Đ </p>
        </li>
        <li class="deal-icon__item">
          <img src="./img/uu_dai-7.png" alt="">
          <p>Nạp Thẻ, Dịch Vụ & Data </p>
        </li>
        <li class="deal-icon__item">
          <img src="./img/uu_dai-8.png" alt="">
          <p>Hàng Quốc Tế </p>
        </li>
        <li class="deal-icon__item">
          <img src="./img/uu_dai-9.png" alt="">
          <p>Bắt Trend - Giá Sốc</p>
        </li>
      </ul>
    </div>

    <!-- Danh muc -->
    <div class="container bl_title">
      <div class="title">
        <div class="content_titlte">DANH MỤC</div>
      </div>
      <div class="section_content_header">
        <div class="image_carousel">
          <div class="image-carousel__item-list-wrapper">
            <ul class="image-carousel__item-list">
              <?php
              $select_query = "select * from tbl_category";
              $result_query = mysqli_query($conn, $select_query);
              while ($row = mysqli_fetch_assoc($result_query)) {
                $cate_id = $row['id'];
                $cate_name = $row['catename'];
                $cate_image = $row['image'];
                echo "
                <li class='image-carousel__item'>
                  <a class='bl_a_item' href='./admin/ao_product.php?cate_id=$cate_id'>
                    <div class='block_item'>
                      <div class='bl_image'>
                        <img class='edit_image' src='$cate_image' alt='' />
                      </div>
                      <div class='image_txt'>
                        <div class='edit_text'>$cate_name</div>
                      </div>
                    </div>
                  </a>
                </li>";
              }
              ?>
            </ul>
          </div>

          <div class="arrow-prev" contenteditable="false">
            <i class="fa-solid fa-arrow-left"></i>
          </div>
          <div class="arrow-next" contenteditable="false">
            <i class="fa-solid fa-arrow-right"></i>
          </div>
        </div>
      </div>
    </div>

    <!-- flash sale -->
    <div class="container bl_title container_flash_sale">
      <div class="title title_flash_sale">
        <div class="content_titlte content_titlte_flash_sale">
          <img src="./img_flash_sale/img_flash_sale.png" alt="" style="height: 30px;">
          <div id="countdown"></div>
        </div>
        <div class="xem_tat_ca">
          <h2 style="color: #ee4d2d; font-size:14px; right:0px; margin-right:20px;">Xem Tất Cả ></h2>
        </div>
      </div>
      <div class="section_content_header">
        <div class="image_carousel">
          <div class="image-carousel__item-list-wrapper">
            <ul class="image-carousel__item-list image-carousel__item-list_flash_sale">
              
              <?php
                $select_query = "select * from tbl_product";
                $result_query = mysqli_query($conn, $select_query);
                while ($row = mysqli_fetch_assoc($result_query)) {
                  $product_id = $row['id'];
                  $product_name = $row['name'];
                  $product_price = $row['min_price'];
                  $product_image = $row['image'];
                  echo "
                  <li class='image-carousel__item image-carousel__item_flash_sale'>
                    <a class='bl_a_item' href='./sanpham.php?idsp=1'>
                      <div class='block_item block_item_flash_sale'>
                        <div class='bl_image'>
                          <img class='edit_image edit_image_flash_sale' src='./img_product/$product_image' alt='$product_name' width='100px'>
                        </div>
                        <div class='image_txt image_txt_price'>
                          <div class='edit_text edit_text_flash_sale'>đ $product_price</div>
                          <div class='bl_status_sell'>
                            <div class='row_status_flase_sale'>
                              <div class='status_flash_sale'>
                                <div class='bl_status_flash_sale'>
                                  <div class='col-6 bar_status_sale'></div>
                                  <h3 class='txt_status_sell'>
                                    ĐANG BÁN CHẠY 1
                                  </h3>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </a>
                  </li>";
                }
              ?>

            </ul>
          </div>
        </div>
        <div class="arrow-prev arrow-prev_flash_sale" contenteditable="false">
          <i class="fa-solid fa-arrow-left"></i>

        </div>
        <div class="arrow-next arrow-next_flash_sale" contenteditable="false">
          <i class="fa-solid fa-arrow-right"></i>

        </div>
      </div>
    </div>

    <!-- .shopee mall -->
    <div class="container shopee-mall__wrapper">
      <div class="shopee-mall__title">
        <div class="shopee-mall__left">
          <p class="shopee-mall_corner">SHOPEE MALL</p>
          <div class="shopee-mall_box">
            <img class="shopee-mall__img" src="./img/shopee-mall-icon1.png" alt="">
            <span class="shopee-mall__p">7 Ngày Miễn Phí Trả Hàng</span>
          </div>
          <div class="shopee-mall_box">
            <img class="shopee-mall__img" src="./img/shopee-mall-icon2.png" alt="">
            <span class="shopee-mall__p">Hàng Chính Hãng 100%</span>
          </div>
          <div class="shopee-mall_box">
            <img class="shopee-mall__img" src="./img/shopee-mall-icon3.png" alt="">
            <span class="shopee-mall__p">Miễn Phí Vận Chuyển</span>
          </div>
        </div>
        <div class="shopee-mall__right">
          <span>Xem Tất Cả</span>
          <i class="fa-solid fa-chevron-right icon"></i>
        </div>
      </div>
      <div class="shopee-mall__banner">
        <div class="shopee-mall__bannerleft">
          <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img class="d-block w-100 img-shmall" src="./img/shopee-mall-banner1.jpg" alt="First slide">
              </div>
              <div class="carousel-item">
                <img class="d-block w-100 img-shmall" src="./img/shopee-mall-banner2.jpg" alt="Second slide">
              </div>
              <div class="carousel-item">
                <img class="d-block w-100 img-shmall" src="./img/shopee-mall-banner3.jpg" alt="Third slide">
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
        </div>
        <div class="lop_phu_right">
          <div class="shopee-mall__bannerright">

            <div class="shopee-mall__imagewrapper">
              <ul class="shopee-mall__imagelist">
                <li class="shopee-mall__item">
                  <a class="shopee-a__item" href="">
                    <div class="shopee-mall__block">
                      <div class="shmall-img">
                        <img src="./img/shopee-mall-item1.jpg" alt="">
                      </div>
                      <div class="shmall-txt">Mua là có quà</div>
                    </div>
                  </a>
                </li>
                <li class="shopee-mall__item">
                  <a class="shopee-a__item" href="">
                    <div class="shopee-mall__block">
                      <div class="shmall-img">
                        <img src="./img/shopee-mall-item11.jpg" alt="">
                      </div>
                      <div class="shmall-txt">Mua là có quà</div>
                    </div>
                  </a>
                </li>
                <li class="shopee-mall__item">
                  <a class="shopee-a__item" href="">
                    <div class="shopee-mall__block">
                      <div class="shmall-img">
                        <img src="./img/shopee-mall-item3.jpg" alt="">
                      </div>
                      <div class="shmall-txt">Mua là có quà</div>
                    </div>
                  </a>
                </li>
                <li class="shopee-mall__item">
                  <a class="shopee-a__item" href="">
                    <div class="shopee-mall__block">
                      <div class="shmall-img">
                        <img src="./img/shopee-mall-item4.jpg" alt="">
                      </div>
                      <div class="shmall-txt">Mua là có quà</div>
                    </div>
                  </a>
                </li>
                <li class="shopee-mall__item">
                  <a class="shopee-a__item" href="">
                    <div class="shopee-mall__block">
                      <div class="shmall-img">
                        <img src="./img/shopee-mall-item5.jpg" alt="">
                      </div>
                      <div class="shmall-txt">Mua là có quà</div>
                    </div>
                  </a>
                </li>
                <li class="shopee-mall__item">
                  <a class="shopee-a__item" href="">
                    <div class="shopee-mall__block">
                      <div class="shmall-img">
                        <img src="./img/shopee-mall-item6.jpg" alt="">
                      </div>
                      <div class="shmall-txt">Mua là có quà</div>
                    </div>
                  </a>
                </li>
                <li class="shopee-mall__item">
                  <a class="shopee-a__item" href="">
                    <div class="shopee-mall__block">
                      <div class="shmall-img">
                        <img src="./img/shopee-mall-item7.jpg" alt="">
                      </div>
                      <div class="shmall-txt">Mua là có quà</div>
                    </div>
                  </a>
                </li>
                <li class="shopee-mall__item">
                  <a class="shopee-a__item" href="">
                    <div class="shopee-mall__block">
                      <div class="shmall-img">
                        <img src="./img/shopee-mall-item8.jpg" alt="">
                      </div>
                      <div class="shmall-txt">Mua là có quà</div>
                    </div>
                  </a>
                </li>
                <li class="shopee-mall__item">
                  <a class="shopee-a__item" href="">
                    <div class="shopee-mall__block">
                      <div class="shmall-img">
                        <img src="./img/shopee-mall-item9.jpg" alt="">
                      </div>
                      <div class="shmall-txt">Mua là có quà</div>
                    </div>
                  </a>
                </li>
                <li class="shopee-mall__item">
                  <a class="shopee-a__item" href="">
                    <div class="shopee-mall__block">
                      <div class="shmall-img">
                        <img src="./img/shopee-mall-item10.jpg" alt="">
                      </div>
                      <div class="shmall-txt">Mua là có quà</div>
                    </div>
                  </a>
                </li>
                <li class="shopee-mall__item">
                  <a class="shopee-a__item" href="">
                    <div class="shopee-mall__block">
                      <div class="shmall-img">
                        <img src="./img/shopee-mall-item11.jpg" alt="">
                      </div>
                      <div class="shmall-txt">Mua là có quà</div>
                    </div>
                  </a>
                </li>
                <li class="shopee-mall__item">
                  <a class="shopee-a__item" href="">
                    <div class="shopee-mall__block">
                      <div class="shmall-img">
                        <img src="./img/shopee-mall-item14.jpg" alt="">
                      </div>
                      <div class="shmall-txt">Mua là có quà</div>
                    </div>
                  </a>
                </li>
              </ul>
            </div>
           
          </div>
          <div class="arrow-prev__shmall" contenteditable="false">
            <i class="fa-solid fa-arrow-left"></i>
          </div>
          <div class="arrow-next__shmall" contenteditable="false" >
            <i class="fa-solid fa-arrow-right"></i>
          </div>
        </div>
       
      </div>

    </div>

    <!-- product_recommend -->
    <div>
      <div class="container component_recomment_list_product">
        <div class="bl_suggest">
          <h2 class="txt_suggest">GỢI Ý HÔM NAY</h2>
        </div>
        <div class="list_product">
          <div class="view_list_product">
            <div class="product_recommend">
              <div class="view_product">
                <a class="edit_a_componend" href="">
                  <!-- begin img -->
                  <div class="img_recommend">
                    <img class="edit_img_recommend" src="./img_recommend/hinh3.jfif" alt="">

                  </div>
                  <!-- end img -->

                  <!-- begin txt -->
                  <div class="bl_txt_recommend">
                    <h2 class="txt_recommend">Dép Quai Ngang Eva Đế Cao Hình Gấu</h2>
                  </div>
                  <!-- end txt -->

                  <!-- begin discount -->

                  <div class="bl_discount">
                    <div class="giam50_ic">Giảm 50k</div>
                    <div class="flash_sale_ic">Flash Sale</div>

                  </div>

                  <!-- end discount -->

                  <div class="bl_cost_status_cost">

                    <div class="bl_cost">
                      đ55.000

                    </div>

                    <div class="bl_status_cost">
                      Đã bán 4.2k

                    </div>
                  </div>

                  <div class="product_similar">
                    Tìm sản phẩm tương tự

                  </div>


                </a>
              </div>



            </div>
            <div class="product_recommend">
              <div class="view_product">
                <a class="edit_a_componend" href="">
                  <!-- begin img -->
                  <div class="img_recommend">
                    <img class="edit_img_recommend" src="./img_recommend/hinh3.jfif" alt="">

                  </div>
                  <!-- end img -->

                  <!-- begin txt -->
                  <div class="bl_txt_recommend">
                    <h2 class="txt_recommend">Dép Quai Ngang Eva Đế Cao Hình Gấu</h2>
                  </div>
                  <!-- end txt -->

                  <!-- begin discount -->

                  <div class="bl_discount">
                    <div class="giam50_ic">Giảm 50k</div>
                    <div class="flash_sale_ic">Flash Sale</div>

                  </div>

                  <!-- end discount -->

                  <div class="bl_cost_status_cost">

                    <div class="bl_cost">
                      đ55.000

                    </div>

                    <div class="bl_status_cost">
                      Đã bán 4.2k

                    </div>
                  </div>

                  <div class="product_similar">
                    Tìm sản phẩm tương tự

                  </div>


                </a>
              </div>



            </div>

            <div class="product_recommend">
              <div class="view_product">
                <a class="edit_a_componend" href="">
                  <!-- begin img -->
                  <div class="img_recommend">
                    <img class="edit_img_recommend" src="./img_recommend/hinh3.jfif" alt="">

                  </div>
                  <!-- end img -->

                  <!-- begin txt -->
                  <div class="bl_txt_recommend">
                    <h2 class="txt_recommend">Dép Quai Ngang Eva Đế Cao Hình Gấu</h2>
                  </div>
                  <!-- end txt -->

                  <!-- begin discount -->

                  <div class="bl_discount">
                    <div class="giam50_ic">Giảm 50k</div>
                    <div class="flash_sale_ic">Flash Sale</div>

                  </div>

                  <!-- end discount -->

                  <div class="bl_cost_status_cost">

                    <div class="bl_cost">
                      đ55.000

                    </div>

                    <div class="bl_status_cost">
                      Đã bán 4.2k

                    </div>
                  </div>

                  <div class="product_similar">
                    Tìm sản phẩm tương tự

                  </div>


                </a>
              </div>



            </div>

            <div class="product_recommend">
              <div class="view_product">
                <a class="edit_a_componend" href="">
                  <!-- begin img -->
                  <div class="img_recommend">
                    <img class="edit_img_recommend" src="./img_recommend/hinh3.jfif" alt="">

                  </div>
                  <!-- end img -->

                  <!-- begin txt -->
                  <div class="bl_txt_recommend">
                    <h2 class="txt_recommend">Dép Quai Ngang Eva Đế Cao Hình Gấu</h2>
                  </div>
                  <!-- end txt -->

                  <!-- begin discount -->

                  <div class="bl_discount">
                    <div class="giam50_ic">Giảm 50k</div>
                    <div class="flash_sale_ic">Flash Sale</div>

                  </div>

                  <!-- end discount -->

                  <div class="bl_cost_status_cost">

                    <div class="bl_cost">
                      đ55.000

                    </div>

                    <div class="bl_status_cost">
                      Đã bán 4.2k

                    </div>
                  </div>

                  <div class="product_similar">
                    Tìm sản phẩm tương tự

                  </div>


                </a>
              </div>



            </div>

            <div class="product_recommend">
              <div class="view_product">
                <a class="edit_a_componend" href="">
                  <!-- begin img -->
                  <div class="img_recommend">
                    <img class="edit_img_recommend" src="./img_recommend/hinh3.jfif" alt="">

                  </div>
                  <!-- end img -->

                  <!-- begin txt -->
                  <div class="bl_txt_recommend">
                    <h2 class="txt_recommend">Dép Quai Ngang Eva Đế Cao Hình Gấu</h2>
                  </div>
                  <!-- end txt -->

                  <!-- begin discount -->

                  <div class="bl_discount">
                    <div class="giam50_ic">Giảm 50k</div>
                    <div class="flash_sale_ic">Flash Sale</div>

                  </div>

                  <!-- end discount -->

                  <div class="bl_cost_status_cost">

                    <div class="bl_cost">
                      đ55.000

                    </div>

                    <div class="bl_status_cost">
                      Đã bán 4.2k

                    </div>
                  </div>

                  <div class="product_similar">
                    Tìm sản phẩm tương tự

                  </div>


                </a>
              </div>



            </div>

            <div class="product_recommend">
              <div class="view_product">
                <a class="edit_a_componend" href="">
                  <!-- begin img -->
                  <div class="img_recommend">
                    <img class="edit_img_recommend" src="./img_recommend/hinh3.jfif" alt="">

                  </div>
                  <!-- end img -->

                  <!-- begin txt -->
                  <div class="bl_txt_recommend">
                    <h2 class="txt_recommend">Dép Quai Ngang Eva Đế Cao Hình Gấu</h2>
                  </div>
                  <!-- end txt -->

                  <!-- begin discount -->

                  <div class="bl_discount">
                    <div class="giam50_ic">Giảm 50k</div>
                    <div class="flash_sale_ic">Flash Sale</div>

                  </div>

                  <!-- end discount -->

                  <div class="bl_cost_status_cost">

                    <div class="bl_cost">
                      đ55.000

                    </div>

                    <div class="bl_status_cost">
                      Đã bán 4.2k

                    </div>
                  </div>

                  <div class="product_similar">
                    Tìm sản phẩm tương tự

                  </div>


                </a>
              </div>



            </div>


            <div class="product_recommend">
              <div class="view_product">
                <a class="edit_a_componend" href="">
                  <!-- begin img -->
                  <div class="img_recommend">
                    <img class="edit_img_recommend" src="./img_recommend/hinh3.jfif" alt="">

                  </div>
                  <!-- end img -->

                  <!-- begin txt -->
                  <div class="bl_txt_recommend">
                    <h2 class="txt_recommend">Dép Quai Ngang Eva Đế Cao Hình Gấu</h2>
                  </div>
                  <!-- end txt -->

                  <!-- begin discount -->

                  <div class="bl_discount">
                    <div class="giam50_ic">Giảm 50k</div>
                    <div class="flash_sale_ic">Flash Sale</div>

                  </div>

                  <!-- end discount -->

                  <div class="bl_cost_status_cost">

                    <div class="bl_cost">
                      đ55.000

                    </div>

                    <div class="bl_status_cost">
                      Đã bán 4.2k

                    </div>
                  </div>

                  <div class="product_similar">
                    Tìm sản phẩm tương tự

                  </div>


                </a>
              </div>



            </div>


            <div class="product_recommend">
              <div class="view_product">
                <a class="edit_a_componend" href="">
                  <!-- begin img -->
                  <div class="img_recommend">
                    <img class="edit_img_recommend" src="./img_recommend/hinh3.jfif" alt="">

                  </div>
                  <!-- end img -->

                  <!-- begin txt -->
                  <div class="bl_txt_recommend">
                    <h2 class="txt_recommend">Dép Quai Ngang Eva Đế Cao Hình Gấu</h2>
                  </div>
                  <!-- end txt -->

                  <!-- begin discount -->

                  <div class="bl_discount">
                    <div class="giam50_ic">Giảm 50k</div>
                    <div class="flash_sale_ic">Flash Sale</div>

                  </div>

                  <!-- end discount -->

                  <div class="bl_cost_status_cost">

                    <div class="bl_cost">
                      đ55.000

                    </div>

                    <div class="bl_status_cost">
                      Đã bán 4.2k

                    </div>
                  </div>

                  <div class="product_similar">
                    Tìm sản phẩm tương tự

                  </div>


                </a>
              </div>



            </div>


            <div class="product_recommend">
              <div class="view_product">
                <a class="edit_a_componend" href="">
                  <!-- begin img -->
                  <div class="img_recommend">
                    <img class="edit_img_recommend" src="./img_recommend/hinh3.jfif" alt="">

                  </div>
                  <!-- end img -->

                  <!-- begin txt -->
                  <div class="bl_txt_recommend">
                    <h2 class="txt_recommend">Dép Quai Ngang Eva Đế Cao Hình Gấu</h2>
                  </div>
                  <!-- end txt -->

                  <!-- begin discount -->

                  <div class="bl_discount">
                    <div class="giam50_ic">Giảm 50k</div>
                    <div class="flash_sale_ic">Flash Sale</div>

                  </div>

                  <!-- end discount -->

                  <div class="bl_cost_status_cost">

                    <div class="bl_cost">
                      đ55.000

                    </div>

                    <div class="bl_status_cost">
                      Đã bán 4.2k

                    </div>
                  </div>

                  <div class="product_similar">
                    Tìm sản phẩm tương tự

                  </div>


                </a>
              </div>



            </div>


            <div class="product_recommend">
              <div class="view_product">
                <a class="edit_a_componend" href="">
                  <!-- begin img -->
                  <div class="img_recommend">
                    <img class="edit_img_recommend" src="./img_recommend/hinh3.jfif" alt="">

                  </div>
                  <!-- end img -->

                  <!-- begin txt -->
                  <div class="bl_txt_recommend">
                    <h2 class="txt_recommend">Dép Quai Ngang Eva Đế Cao Hình Gấu</h2>
                  </div>
                  <!-- end txt -->

                  <!-- begin discount -->

                  <div class="bl_discount">
                    <div class="giam50_ic">Giảm 50k</div>
                    <div class="flash_sale_ic">Flash Sale</div>

                  </div>

                  <!-- end discount -->

                  <div class="bl_cost_status_cost">

                    <div class="bl_cost">
                      đ55.000

                    </div>

                    <div class="bl_status_cost">
                      Đã bán 4.2k

                    </div>
                  </div>

                  <div class="product_similar">
                    Tìm sản phẩm tương tự

                  </div>


                </a>
              </div>



            </div>


            <div class="product_recommend">
              <div class="view_product">
                <a class="edit_a_componend" href="">
                  <!-- begin img -->
                  <div class="img_recommend">
                    <img class="edit_img_recommend" src="./img_recommend/hinh3.jfif" alt="">

                  </div>
                  <!-- end img -->

                  <!-- begin txt -->
                  <div class="bl_txt_recommend">
                    <h2 class="txt_recommend">Dép Quai Ngang Eva Đế Cao Hình Gấu</h2>
                  </div>
                  <!-- end txt -->

                  <!-- begin discount -->

                  <div class="bl_discount">
                    <div class="giam50_ic">Giảm 50k</div>
                    <div class="flash_sale_ic">Flash Sale</div>

                  </div>

                  <!-- end discount -->

                  <div class="bl_cost_status_cost">

                    <div class="bl_cost">
                      đ55.000

                    </div>

                    <div class="bl_status_cost">
                      Đã bán 500k

                    </div>
                  </div>

                  <div class="product_similar">
                    Tìm sản phẩm tương tự

                  </div>


                </a>
              </div>



            </div>


     
            

            <div class="product_recommend">
              <div class="view_product">
                <a class="edit_a_componend" href="">
                  <!-- begin img -->
                  <div class="img_recommend">
                    <img class="edit_img_recommend" src="./img_recommend/hinh3.jfif" alt="">

                  </div>
                  <!-- end img -->

                  <!-- begin txt -->
                  <div class="bl_txt_recommend">
                    <h2 class="txt_recommend">Dép Quai Ngang Eva Đế Cao Hình Gấu</h2>
                  </div>
                  <!-- end txt -->

                  <!-- begin discount -->

                  <div class="bl_discount">
                    <div class="giam50_ic">Giảm 50k</div>
                    <div class="flash_sale_ic">Flash Sale</div>

                  </div>

                  <!-- end discount -->

                  <div class="bl_cost_status_cost">

                    <div class="bl_cost">
                      đ55.000

                    </div>

                    <div class="bl_status_cost">
                      Đã bán 4.2k
                    </div>
                  </div>
                  <div class="product_similar">
                    Tìm sản phẩm tương tự
                  </div>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="btn_xem_them">
        <a class="txt_btn_xemthem" href="">
          Xem thêm
        </a>
      </div>
    </div>

    <!-- footer -->
    <footer role="contentinfo" class="PhanCuoi Vien_Do CoChu_Footer"">
      <div class=" DeMuc_SanPham">
      <div class="ChieuCao_Chu">Danh Muc</div>
      <div class="Can_DanhMuc">
        <div class="KhungLon_DanhMuc">
          <div class="KhungNho_DanhMuc">
            <div class="KhungTen_DanhMuc">
              <a class="Ten_DanhMuc" href="">Thoi Trang Nam</a>
            </div>
            <div class="KhungSP_DanhMuc">
              <div>
                <a class="SP_DanhMuc" href="">Ao khoac</a>
              </div>
              <div>
                <a class="SP_DanhMuc" href=""></a>
              </div>
              <div>
                <a class="SP_DanhMuc" href=""></a>
              </div>
              <div>
                <a class="SP_DanhMuc" href=""></a>
              </div>
            </div>
          </div>
          <div class="KhungNho_DanhMuc">
            <div class="KhungTen_DanhMuc">
              <a class="Ten_DanhMuc" href="">Thoi Trang Nam</a>
            </div>
            <div class="KhungSP_DanhMuc">
              <div>
                <a class="SP_DanhMuc" href="">Ao khoac</a>
              </div>
              <div>
                <a class="SP_DanhMuc" href=""></a>
              </div>
              <div>
                <a class="SP_DanhMuc" href=""></a>
              </div>
              <div>
                <a class="SP_DanhMuc" href=""></a>
              </div>
            </div>
          </div>
          <div class="KhungNho_DanhMuc">
            <div class="KhungTen_DanhMuc">
              <a class="Ten_DanhMuc" href="">Thoi Trang Nam</a>
            </div>
            <div class="KhungSP_DanhMuc">
              <div>
                <a class="SP_DanhMuc" href="">Ao khoac</a>
              </div>
              <div>
                <a class="SP_DanhMuc" href=""></a>
              </div>
              <div>
                <a class="SP_DanhMuc" href=""></a>
              </div>
              <div>
                <a class="SP_DanhMuc" href=""></a>
              </div>
            </div>
          </div>
          <div class="KhungNho_DanhMuc">
            <div class="KhungTen_DanhMuc">
              <a class="Ten_DanhMuc" href="">Thoi Trang Nam</a>
            </div>
            <div class="KhungSP_DanhMuc">
              <div>
                <a class="SP_DanhMuc" href="">Ao khoac</a>
              </div>
              <div>
                <a class="SP_DanhMuc" href=""></a>
              </div>
              <div>
                <a class="SP_DanhMuc" href=""></a>
              </div>
              <div>
                <a class="SP_DanhMuc" href=""></a>
              </div>
            </div>
          </div>
        </div>
        <div class="KhungLon_DanhMuc">
          <div class="KhungNho_DanhMuc">
            <div class="KhungTen_DanhMuc">
              <a class="Ten_DanhMuc" href="">Thoi Trang Nam</a>
            </div>
            <div class="KhungSP_DanhMuc">
              <div>
                <a class="SP_DanhMuc" href="">Ao khoac</a>
              </div>
              <div>
                <a class="SP_DanhMuc" href=""></a>
              </div>
              <div>
                <a class="SP_DanhMuc" href=""></a>
              </div>
              <div>
                <a class="SP_DanhMuc" href=""></a>
              </div>
            </div>
          </div>
          <div class="KhungNho_DanhMuc">
            <div class="KhungTen_DanhMuc">
              <a class="Ten_DanhMuc" href="">Thoi Trang Nam</a>
            </div>
            <div class="KhungSP_DanhMuc">
              <div>
                <a class="SP_DanhMuc" href="">Ao khoac</a>
              </div>
              <div>
                <a class="SP_DanhMuc" href=""></a>
              </div>
              <div>
                <a class="SP_DanhMuc" href=""></a>
              </div>
              <div>
                <a class="SP_DanhMuc" href=""></a>
              </div>
            </div>
          </div>
          <div class="KhungNho_DanhMuc">
            <div class="KhungTen_DanhMuc">
              <a class="Ten_DanhMuc" href="">Thoi Trang Nam</a>
            </div>
            <div class="KhungSP_DanhMuc">
              <div>
                <a class="SP_DanhMuc" href="">Ao khoac</a>
              </div>
              <div>
                <a class="SP_DanhMuc" href=""></a>
              </div>
              <div>
                <a class="SP_DanhMuc" href=""></a>
              </div>
              <div>
                <a class="SP_DanhMuc" href=""></a>
              </div>
            </div>
          </div>
          <div class="KhungNho_DanhMuc">
            <div class="KhungTen_DanhMuc">
              <a class="Ten_DanhMuc" href="">Thoi Trang Nam</a>
            </div>
            <div class="KhungSP_DanhMuc">
              <div>
                <a class="SP_DanhMuc" href="">Ao khoac</a>
              </div>
              <div>
                <a class="SP_DanhMuc" href=""></a>
              </div>
              <div>
                <a class="SP_DanhMuc" href=""></a>
              </div>
              <div>
                <a class="SP_DanhMuc" href=""></a>
              </div>
            </div>
          </div>
        </div>
        <div class="KhungLon_DanhMuc">
          <div class="KhungNho_DanhMuc">
            <div class="KhungTen_DanhMuc">
              <a class="Ten_DanhMuc" href="">Thoi Trang Nam</a>
            </div>
            <div class="KhungSP_DanhMuc">
              <div>
                <a class="SP_DanhMuc" href="">Ao khoac</a>
              </div>
              <div>
                <a class="SP_DanhMuc" href=""></a>
              </div>
              <div>
                <a class="SP_DanhMuc" href=""></a>
              </div>
              <div>
                <a class="SP_DanhMuc" href=""></a>
              </div>
            </div>
          </div>
          <div class="KhungNho_DanhMuc">
            <div class="KhungTen_DanhMuc">
              <a class="Ten_DanhMuc" href="">Thoi Trang Nam</a>
            </div>
            <div class="KhungSP_DanhMuc">
              <div>
                <a class="SP_DanhMuc" href="">Ao khoac</a>
              </div>
              <div>
                <a class="SP_DanhMuc" href=""></a>
              </div>
              <div>
                <a class="SP_DanhMuc" href=""></a>
              </div>
              <div>
                <a class="SP_DanhMuc" href=""></a>
              </div>
            </div>
          </div>
          <div class="KhungNho_DanhMuc">
            <div class="KhungTen_DanhMuc">
              <a class="Ten_DanhMuc" href="">Thoi Trang Nam</a>
            </div>
            <div class="KhungSP_DanhMuc">
              <div>
                <a class="SP_DanhMuc" href="">Ao khoac</a>
              </div>
              <div>
                <a class="SP_DanhMuc" href=""></a>
              </div>
              <div>
                <a class="SP_DanhMuc" href=""></a>
              </div>
              <div>
                <a class="SP_DanhMuc" href=""></a>
              </div>
            </div>
          </div>
          <div class="KhungNho_DanhMuc">
            <div class="KhungTen_DanhMuc">
              <a class="Ten_DanhMuc" href="">Thoi Trang Nam</a>
            </div>
            <div class="KhungSP_DanhMuc">
              <div>
                <a class="SP_DanhMuc" href="">Ao khoac</a>
              </div>
              <div>
                <a class="SP_DanhMuc" href=""></a>
              </div>
              <div>
                <a class="SP_DanhMuc" href=""></a>
              </div>
              <div>
                <a class="SP_DanhMuc" href=""></a>
              </div>
            </div>
          </div>
        </div>
        <div class="KhungLon_DanhMuc">
          <div class="KhungNho_DanhMuc">
            <div class="KhungTen_DanhMuc">
              <a class="Ten_DanhMuc" href="">Thoi Trang Nam</a>
            </div>
            <div class="KhungSP_DanhMuc">
              <div>
                <a class="SP_DanhMuc" href="">Ao khoac</a>
              </div>
              <div>
                <a class="SP_DanhMuc" href=""></a>
              </div>
              <div>
                <a class="SP_DanhMuc" href=""></a>
              </div>
              <div>
                <a class="SP_DanhMuc" href=""></a>
              </div>
            </div>
          </div>
          <div class="KhungNho_DanhMuc">
            <div class="KhungTen_DanhMuc">
              <a class="Ten_DanhMuc" href="">Thoi Trang Nam</a>
            </div>
            <div class="KhungSP_DanhMuc">
              <div>
                <a class="SP_DanhMuc" href="">Ao khoac</a>
              </div>
              <div>
                <a class="SP_DanhMuc" href=""></a>
              </div>
              <div>
                <a class="SP_DanhMuc" href=""></a>
              </div>
              <div>
                <a class="SP_DanhMuc" href=""></a>
              </div>
            </div>
          </div>
          <div class="KhungNho_DanhMuc">
            <div class="KhungTen_DanhMuc">
              <a class="Ten_DanhMuc" href="">Thoi Trang Nam</a>
            </div>
            <div class="KhungSP_DanhMuc">
              <div>
                <a class="SP_DanhMuc" href="">Ao khoac</a>
              </div>
              <div>
                <a class="SP_DanhMuc" href=""></a>
              </div>
              <div>
                <a class="SP_DanhMuc" href=""></a>
              </div>
              <div>
                <a class="SP_DanhMuc" href=""></a>
              </div>
            </div>
          </div>
          <div class="KhungNho_DanhMuc">
            <div class="KhungTen_DanhMuc">
              <a class="Ten_DanhMuc" href="">Thoi Trang Nam</a>
            </div>
            <div class="KhungSP_DanhMuc">
              <div>
                <a class="SP_DanhMuc" href="">Ao khoac</a>
              </div>
              <div>
                <a class="SP_DanhMuc" href=""></a>
              </div>
              <div>
                <a class="SP_DanhMuc" href=""></a>
              </div>
              <div>
                <a class="SP_DanhMuc" href=""></a>
              </div>
            </div>
          </div>
        </div>
        <div class="KhungLon_DanhMuc">
          <div class="KhungNho_DanhMuc">
            <div class="KhungTen_DanhMuc">
              <a class="Ten_DanhMuc" href="">Thoi Trang Nam</a>
            </div>
            <div class="KhungSP_DanhMuc">
              <div>
                <a class="SP_DanhMuc" href="">Ao khoac</a>
              </div>
              <div>
                <a class="SP_DanhMuc" href=""></a>
              </div>
              <div>
                <a class="SP_DanhMuc" href=""></a>
              </div>
              <div>
                <a class="SP_DanhMuc" href=""></a>
              </div>
            </div>
          </div>
          <div class="KhungNho_DanhMuc">
            <div class="KhungTen_DanhMuc">
              <a class="Ten_DanhMuc" href="">Thoi Trang Nam</a>
            </div>
            <div class="KhungSP_DanhMuc">
              <div>
                <a class="SP_DanhMuc" href="">Ao khoac</a>
              </div>
              <div>
                <a class="SP_DanhMuc" href=""></a>
              </div>
              <div>
                <a class="SP_DanhMuc" href=""></a>
              </div>
              <div>
                <a class="SP_DanhMuc" href=""></a>
              </div>
            </div>
          </div>
          <div class="KhungNho_DanhMuc">
            <div class="KhungTen_DanhMuc">
              <a class="Ten_DanhMuc" href="">Thoi Trang Nam</a>
            </div>
            <div class="KhungSP_DanhMuc">
              <div>
                <a class="SP_DanhMuc" href="">Ao khoac</a>
              </div>
              <div>
                <a class="SP_DanhMuc" href=""></a>
              </div>
              <div>
                <a class="SP_DanhMuc" href=""></a>
              </div>
              <div>
                <a class="SP_DanhMuc" href=""></a>
              </div>
            </div>
          </div>
          <div class="KhungNho_DanhMuc">
            <div class="KhungTen_DanhMuc">
              <a class="Ten_DanhMuc" href="">Thoi Trang Nam</a>
            </div>
            <div class="KhungSP_DanhMuc">
              <div>
                <a class="SP_DanhMuc" href="">Ao khoac</a>
              </div>
              <div>
                <a class="SP_DanhMuc" href=""></a>
              </div>
              <div>
                <a class="SP_DanhMuc" href=""></a>
              </div>
              <div>
                <a class="SP_DanhMuc" href=""></a>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
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
      <div class="KhungQuyen_QG" ">
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
          <img style="height:45px; width: 120px;" src="https://luatthienduc.vn/cloud/image-20200115095241-1.png" alt="">
        </a>
        <a class="Logo_ChinhSach" target="_blank" rel="noopener noreferrer"
          href="http://online.gov.vn/HomePage/AppDisplay.aspx?DocId=29">
          <img style="height:45px; width: 120px;" src="https://luatthienduc.vn/cloud/image-20200115095241-1.png" alt="">
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


<script src="./js/main.js"></script>
</html>
