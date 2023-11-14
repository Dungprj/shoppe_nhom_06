<?php
    if(iet($_POST["upload"])){
        $target_dir = "upload/";
        $target_file = $target_dir . basename($_FILES["upload_file"]["name"]);
        echo $target_file;

        
        $uploadOk = 1;
        //kiem tra dinh dang cua file upload
        $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        if($fileType != "jpg" && $fileType != "png" && $fileType != "jpeg"
            && $fileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
          // if everything is ok, try to upload file
          } 
        else {
            if (move_uploaded_file($_FILES["upload_file"]["tmp_name"], $target_file)) {
                echo "<img src='".$target_file."'>";
            } 
            else {
              echo "Sorry, there was an error uploading your file.";
            }
        }
    }
?>