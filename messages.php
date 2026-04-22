<?php 
$msql = new  mysqli("localhost","root","","bd");
$sql = "SELECT * FROM `message`";
$result = $msql->query($sql);
echo '<meta http-equiv="refresh" content="10">';
echo'<link rel="stylesheet" href="style.css">';
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) 
        {
            $message =  $row["message"]; 
            $user =  $row["name"]; 
            $messages = "<p id='center'>$user :<br> $message </p>";
            echo $messages;
        };
    $msql->close();
}else {
    
    $msql->close();
    echo "<div id='center'><mark>Сообщений нету</mark></div>";
};
?>