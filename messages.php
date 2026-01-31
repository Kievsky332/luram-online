<?php 
$msql = new  mysqli("localhost","root","","bd");
$sql = "SELECT * FROM `message`";
$result = $msql->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) 
        {
            $message =  $row["message"]; 
            $user =  $row["name"]; 
            $messages = "<p>$user : $message </p>";
           echo $messages;
        };
}else {
    
    $msql->close();
    echo "0 results";
};
$msql->close();
?>