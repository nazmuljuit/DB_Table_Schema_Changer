<?php
$servername = "localhost";
$username = "root";
$password = "xrmxSaxh";
$dbname = "bdu_dev";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$user_id = 1;
$sql = "SELECT id FROM auth_permissions";
$result = $conn->query($sql);

if ($result->num_rows > 0) 
{
  // output data of each row
 
  while($row = $result->fetch_assoc()) 
  {
    $sql2="insert into auth_user_permissions_demo(USER_ID,PERMISSION_ID) 
        values('" . $user_id ."','" . $row["id"] ."')";
     

     if ($conn->query($sql2) === TRUE) {
     echo "<h3>"."ID: " .$row["id"]." Successfully insert!</h3><hr>"."<br>";
    } else {
      echo "Error: " . $sql2 . "<br>" . $conn->error;
    }

       

  }
}

?>