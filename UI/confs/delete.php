<?php

$conn="";
include "db_conf.php";

if(isset($_GET["id"]))
{
    $query = "DELETE FROM xvelsova_pouzivatelia WHERE id_pouzivatela=?";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt,$query);
    mysqli_stmt_bind_param($stmt,'i',$_GET["id"]);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: vypis_pouzivatelov.php?deletation=ok");
}
else 
{
    header("Location: vypis_pouzivatelov.php");
}

?>