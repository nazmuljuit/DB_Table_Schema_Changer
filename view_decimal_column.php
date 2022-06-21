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

if ($result->num_rows > 0) {
  // output data of each row
 
  while($row = $result->fetch_assoc()) {

    echo "<h3>"."Table Name: " .$row["table_name"]."</h3><hr>"."<br>";

    $sql1 = "DESCRIBE ".$row["table_name"];
    $result1 = $conn->query($sql1);
    if($result1->num_rows > 0)
    {

      while($row1 = $result1->fetch_assoc()) 
      {

        $dataType = explode('(', $row1['Type']);

        if($dataType[0] == 'decimal')
        {
          $pdataType = explode(')', $dataType[1]);

          $rdataType = explode(',', $pdataType[0]);

            if($rdataType[1] == 0)
            {
              echo "Field Name: " .$row1["Field"]." of ".$row["table_name"]." should be integer!"."<br>";
            }
            else if($rdataType[1] > 2)
            {
              echo "Field Name: " .$row1["Field"]." of ".$row["table_name"]." decimal place should be less than 3!"."<br>";
            }
            else
            {
              echo "Field Name: " .$row1["Field"]." of ".$row["table_name"]." is ok!"."<br>";
            }

        }
        

      }

    }



    
  }
} 
else 
{
  echo "0 results";
}

$conn->close();
?>