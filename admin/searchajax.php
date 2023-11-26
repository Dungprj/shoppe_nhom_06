<?php
  require("../conect.php");

  $input = isset($_POST["input"]);

  $sql = "select * from tbl_category where catename like '%".$_POST["input"]."%' ";

  $result = mysqli_query($conn, $sql);
  $output = '';

  if(mysqli_num_rows($result) > 0) {
    $output .= '<h4 align="center">Search Result</h4>';
    $output .= '<div class="table-responsive">
                  <table class="table table bordered">
                    <tr>
                      <th>Ma DM</th>
                      <th>Tên DM</th>
                      <th>Hình Ảnh</th>
                      <th>Trạng Thái</th>
                      <th>Thao tác</th>
                      <th>Lựa chọn</th>
                    </tr>';
    while($row = mysqli_fetch_array($result)) {
      $statusColor = ($row["status"] == 1) ? 'green' : 'red';
      $statusText = ($row["status"] == 1) ? 'Hiện' : 'Ẩn';
      $output .= '
        <tr>
          <td>'.$row["id"].'</td>
          <td>'.$row["catename"].'</td>
          <td><img src="../img_danh_muc/'.$row["image"].'" alt="Hình ảnh" style="width:100px;"></td>
          <td style="color:'.$statusColor.'">'.$statusText.'</td>
          <td>
            <a class="btn btn-warning" href="update_category.php?task=update&id='.$row["id"].'">Sửa</a>
            <a class="btn btn-danger" href="manage_cate.php?task=delete&id='.$row["id"].'">Xóa</a>
          </td>
          <td><input type="checkbox" class="form-check-input" name="cate[]" value="'.$row['id'].'"></td>
        </tr>
      ';
      
    }
    echo $output;
  } else {
    echo 'Data Not Found';
  }
?>

