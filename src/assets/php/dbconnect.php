<?php 
    $conn = new mysqli(getenv('DB_HOSTNAME'), getenv('DB_USERNAME'), getenv('DB_PASSWORD'), getenv('DB_USERNAME'));

    
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

?>