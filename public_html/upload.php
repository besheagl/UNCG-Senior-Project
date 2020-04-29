<?php
    session_start();
    header("Location:".$_POST['goback']);
    $username = $_SESSION["login_username"];
    require 'dbAccess.php';
    if (isset($_POST['submit'])) {
        $file = $_FILES['file'];
        print_r($file); //debug
        $fileName = $_FILES['file']['name'];
        $fileTmpName = $_FILES['file']['tmp_name']; //temp location of file
        $fileSize = $_FILES['file']['size'];
        $fileError = $_FILES['file']['error'];
        $fileType = $_FILES['file']['type'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('jpg', 'jpeg', 'png');

        if (in_array($fileActualExt, $allowed)) {
            if ($fileError === 0) {
                if ($fileSize < 1000000) {
                    $fileNameNew = uniqid('', true).".".$fileActualExt;
                    echo "unique id created";
                    $fileDest = '/storage/ssd4/920/12568920/public_html/uploads/' . $fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDest);
                    if ($fileNameNew !== ''){
                        addImg($con, $fileNameNew, $username);
                    }
                }
            else {
                echo "Your file is too big.";
            }
        }
        else {
            echo "There was an error uploading your file.";
        }
    }
    else {
        echo "Wrong file type. Please upload a .jpg, .jpeg, or .png file";
    }
}