<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>luram</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <center>
<?php if (!isset($_COOKIE['username']) || empty($_COOKIE['username'])): ?>
<?php
$username = $_POST['username'];
setcookie('username',$username,time() +60*60*24*31 , "/"); 
header("Location: ../luram/chat.php");?>
<?php else:?>
    <?php  ?>
        <div id="chat">
            <form action="../luram/send_message.php" method="post">
                <input id="text"  class="inpt" name="message" placeholder="Ваше сообщение">
                <input type="submit" onclick="add_message()" class="sbm" value=">">
            </form>
            
            <output id="message"><?php $message = require '../luram/messages.php';?></output>
        </div>
    </center>
</body>
</html>
    
<?php endif;?>