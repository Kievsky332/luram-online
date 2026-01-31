<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>luram</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <center>
    <?php if (!isset($_COOKIE['username']) || empty($_COOKIE['username'])): 
?>        
        <div id="centered">
            <p id="invis">Пожалуйста введите имя!</p>
            <h1>Как тебя зовут ?</h1>
            <form action="../luram/chat.php" method="post" >
                <input type="text" id="inpt" class="inpt" value="Аноним" name="username" placeholder="Аноним"><br><br>
                <button type="submit" id="sbm" class="sbm" onclick="chat()">Зайти</button>
            </form>
        </div>
         <?php else:?>
            <script>
                window.location.href = '../luram/chat.php';
            </script>
        <?php endif;?>
    </center>
</body>
</html>