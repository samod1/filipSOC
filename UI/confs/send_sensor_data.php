<?php
     include "DB.php";

     $id = 0;
     $query_send = "INSERT INTO tbl_sensors (id,sensor_id,pouzitie_senzoru) VALUES (?,?,?);";
     $stmt = mysqli_stmt_init($conn);
     mysqli_stmt_prepare($stmt,$query_send);
     mysqli_stmt_bind_param($stmt,'iss', $id, $_POST["id_sensor"], $_POST["function"]);
     mysqli_stmt_execute($stmt);
     mysqli_stmt_close($stmt);
     header("Location:../settings.php");

     echo "ajpk";


?>