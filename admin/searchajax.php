<?php
  require("../conect.php");

  $input = isset($_POST['input']);

  $sql = "select * from tbl_category where catename like '{$input}%' or status like '{$input}%' LIMIT 3";

  $result = mysqli_query($conn, $sql);

  while ($row = mysqli_fetch_assoc($result)) {
    ?>
    <div class="col-12">
      <table class="table tabke-stripped">
          <thead>
            <tr>
              <th>Mã DM</th>
              <th>Tên danh mục</th>
              <th>Trạng thái</th>
              <th>Thao tác</th>
              <th>Lựa chọn</th>
            </tr>
          </thead>

          <tbody>
            <?php
              while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['id'];
                $catename = $row['catename'];
                $status = $row['status'];  
              }      
            ?>

            <tr>
              <td><?php echo $id; ?></td>
              <td><?php echo $catename; ?></td>
              <td><?php echo $status; ?></td>
            </tr>

          </tbody>
      </table>
    </div>
      

      <?php
  }
?>

<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Document</title>
  </head>
</html>