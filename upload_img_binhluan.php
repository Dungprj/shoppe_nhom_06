<?php

if(isset($_POST["send"]) && isset($_POST["noidungbinhluan"]) && isset($_POST["id_sp"]) && isset($_POST["id_user"]))
    {
        
        $noidungbinhluan =  $_POST["noidungbinhluan"];
        $id_sp = $_POST["id_sp"];
        $id_user = $_POST["id_user"];
        require "myfunc.php";

        $id_binhluanvuatao =  taobinhluan($noidungbinhluan,$id_sp,$id_user);


       
        
    
        
    
        echo $id_binhluanvuatao;
        

        die;
    };

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $target_dir = "binhluan/";
        $uploadedImagePaths = array();
    
        // Kiểm tra xem trường 'files' có tồn tại không
        if (isset($_FILES['files']['tmp_name']) && is_array($_FILES['files']['tmp_name'])) {
            foreach ($_FILES['files']['tmp_name'] as $key => $tmp_name) {
                $target_file = $target_dir . basename($_FILES['files']['name'][$key]);
    
                if (move_uploaded_file($_FILES['files']['tmp_name'][$key], $target_file)) {
                    $uploadedImagePaths[] = $target_file;
                }
            }
        }
    
        echo json_encode($uploadedImagePaths);
    }
    


?>
