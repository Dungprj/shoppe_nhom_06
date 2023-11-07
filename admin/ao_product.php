<?php
  require("config.php");

  $sql = "SELECT * FROM tbl_product";
  $all_product = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/ao_product.css">
  <title>Document</title>
</head>

<body>

  <main>
    <?php
      while($row = mysqli_fetch_assoc($all_product)){
    ?>  

    <div class="card">
      <div class="image">
        <img src="../img_product/ao2.jpg" alt="" srcset="">
      </div>
      <div class="caption">
        <h1 class="ao_name"><?php echo $row["title"];  ?></h1>
        <p class="ao_description">Mô tả: <?php echo $row["description"];  ?></p>
        <p class="ao_price">Giá: <?php echo $row["price"];  ?> $</p>
        <p class="ao_location">Vị trí: <?php echo $row["location"];  ?></p>
      </div>
      <button class="btn_add">ADD TO CART</button>
    </div>

    <?php
      }
    ?>
  </main>
  
</body>

</html>