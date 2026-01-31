<?php 
    $message = $_POST['message'];
    $username = $_COOKIE['username'];
    $msql = new  mysqli("localhost","root","","bd");
    $msql->query("INSERT INTO `message` (`name`,`message`)
        VALUES('$username','$message')");
    $msql->close();
    header("Location: ../luram/chat.php");
?>