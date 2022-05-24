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

$sql = "SELECT t.table_name FROM INFORMATION_SCHEMA.TABLES t WHERE t.table_schema = 'bdu_dev'";
$result = $conn->query($sql);
$i = 0;
if ($result->num_rows > 0) {
  // output data of each row
 
  while($row = $result->fetch_assoc()) {
    $i += 1;
    

    $sql1 = "DESCRIBE ".$row["table_name"];
    $result1 = $conn->query($sql1);
    if($result1->num_rows > 0)
    {

      while($row1 = $result1->fetch_assoc()) 
      {

        if($row1["Key"] == 'PRI')
        {
            echo "Primary Key: " .$row1["Field"]."<br>";
            $sql2 = "ALTER TABLE ".$row["table_name"]." MODIFY ".$row1["Field"]." INT AUTO_INCREMENT";
          

            $conn->query($sql2);
            // echo a message to say the UPDATE succeeded
            echo "Table Name: " . $row["table_name"]."; Number: ".$i. " records UPDATED successfully"."<br>";
         
        }
        

      }

    }
    else
    {
        echo "Table Name: " . $row["table_name"]."; Number: ".$i. "; records UPDATED failed!"."<br>";
    }


    
  }
} else {
  echo "0 results";
}
$conn->close();
?>