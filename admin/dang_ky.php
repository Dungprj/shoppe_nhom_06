<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
    />
    <link
      rel="stylesheet"
      href="./fontawesome-free-6.4.2-web/fontawesome-free-6.4.2-web/css/reset.css"
    />
    <link rel="stylesheet" href="./css/dang_ky.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
      integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="./responsive.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Đăng Ký</title>
  </head>
  <body>
    <div>
      <div class="container header-dangky">
        <div class="dang-ky__left">
          <a href="./index.html">
            <img
              class="dang-ky__logo"
              src="./img/shopee-logo__dangky.png"
              alt="logo"
            />
          </a>
          <h2 class="dang-ky__heading">Đăng ký</h2>
        </div>
        <div class="dang-ky__right">
          <p>Bạn cần giúp đỡ ?</p>
        </div>
      </div>
      <div class="dang-ky__fullbanner">
        <div class="container background-dangky">
          <div class="dang-ky__banner">
            <img src="./img/dang_ky_bg.png" alt="" />
          </div>
        </div>
        <div class="background_temporary"></div>
        <div class="container dang-ky__form">
          <h4 class="form_heading">Đăng Ký</h4>
          <input
            class="form-input__phone"
            type="text"
            placeholder="Số điện thoại"
            id="fname"
            name="fname"
          />
          <br />
          <button class="form-input__btn">TIẾP THEO</button>
          <div class="form-input__social">
            <div class="form-social__fb">
              <i class="fa-brands fa-facebook"></i>
              <span>Facebook</span>
            </div>
            <div class="form-social__gg">
              <i class="fa-brands fa-google"></i>
              <span>Google</span>
            </div>
          </div>
          <div class="form-des">
            Bằng việc đăng kí, bạn đã đồng ý với Shopee về <br />
            <a class="form-des__text" href="#!">Điều Khoản dịch vụ</a> &
            <a class="form-des__text" href="#!">Chính sách bảo mật</a>
          </div>
          <div class="form-dangnhap">
            Bạn đã có tài khoản?
            <a class="form-des__text" href="./dang_nhap.html">Đăng nhập</a>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
