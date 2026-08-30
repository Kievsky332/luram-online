<?php if (!isset($_COOKIE['username']) || empty($_COOKIE['username'])): ?>
<?php
$username = $_POST['username']??'';
setcookie('username',$username,time() +60*60*24*31 , "/");
?>
<script>location.href = "https://luram.sorav.ru/";</script>
<?php else:?>
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
        <div id="chat">
            <form action="send_message.php" method="post" enctype="multipart/form-data">
                <input id="text"  class="inpt" name="message" placeholder="Ваше сообщение">
                <input type="file" id="file" name="file" accept="image/*">
                <input type="submit"  class="sbm" value=">">
            </form>
           <p>Для удаления информации обратитесь admin@sorav.ru</p>

          
            
            <output ><iframe src='messages.php' id="message"></iframe></output><script>
  const iframe = document.getElementById('message');
  iframe.onload = function() {
    // Прокрутка к нижней части
    iframe.contentWindow.scrollTo(0, iframe.contentWindow.document.body.scrollHeight);
  };
</script>
        </div>
</center>
</body>
</html>
  
<?php endif;?>    
