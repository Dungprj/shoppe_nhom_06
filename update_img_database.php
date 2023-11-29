<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $remainingImages = $_POST["images"];
    $id_binhluancuoicung = $_POST["id_binhluan"];
    
    require "myfunc.php";

    capnhaplaiimg_binhluan($id_binhluancuoicung,$remainingImages);

    echo "Database updated successfully";
}
?>
