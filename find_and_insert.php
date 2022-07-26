<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bdu_dev";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$user_id = '1'
$sql = "SELECT id FROM auth_permissions";
$result = $conn->query($sql);

if ($result->num_rows > 0) 
{
  // output data of each row
 
  while($row = $result->fetch_assoc()) 
  {

       $sql2 = "INSERT INTO auth_user_permissions_demo ( USER_ID, PERMISSION_ID, CREATE,READ,UPDATE,DELETE ) VALUES ( $user_id, $row["id"],1,1,1)";
       $conn->query($sql2);

  }
}

?>