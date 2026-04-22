<?php 
    $message =  strip_tags($_POST['message']);
    $username =  strip_tags($_COOKIE['username']);
    $msql = new  mysqli("localhost","root","","bd");
    if (isset($message)){
        if($message=='clearest'){
              $msql->query("TRUNCATE TABLE `message`");
         }
        elseif($message!=''){
                    $msql->query("INSERT INTO `message` (`name`,`message`)
        VALUES('$username','$message')"); 
        }
        elseif (isset($_FILES['file'])) {
            $file = $_FILES['file'];
            $uploadDir = 'photo/'; // Папка, куда сохранять (должна существовать)
            $uploadFile = $uploadDir . basename($file['name']);
            $filename = rawurlencode(basename($file['name']));
            // Безопасное перемещение файла
            if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
                $dir = "<img src=\"photo/$filename\" id=\"photo\">";
                $msql->query("INSERT INTO `message` (`name`,`message`) VALUES ('$username','$dir')");
            } else {
                echo "Ошибка при загрузке файла.";
                
            }
        } 
    }
    $msql->close();
    header("Location: chat.php");
?>