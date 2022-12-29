<?php
    $server = "db.dw082.nameserver.sk";
    $user = "filip_majchrak";
    $pass = "X5Me1BZj";
    $db = "filip_soc";

    $conn= mysqli_connect($server,$user,$pass,$db);

    //kontrola udajov
    //dazd
    $query_dazd_check = "SELECT  COUNT(*) FROM filip_soc.tbl_dazd td;";
    $result_dazd_check = mysqli_query($conn,$query_dazd_check);
    $pocetriadkov_dazd_check = mysqli_num_rows($result_dazd_check);
    $row_dazd_check = mysqli_fetch_assoc($result_dazd_check);
  
    if(!$result_dazd_check)
    {
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        <strong>ERR:</strong> Prikaz SQL sa neda vykonat ".$query_dazd_check."
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>";
    }
    if($row_dazd_check["COUNT(*)"] == 0)
    {
      echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
      <strong>ERR:</strong> V databáze tbl_dazd sa nenachádzajú údaje! 
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
      </button>
      </div>";
    }

    //teplota
    $query_teplota_check = "SELECT COUNT(*) FROM filip_soc.tbl_teplota tt; ";
    $result_teplota_check = mysqli_query($conn,$query_teplota_check);
    $pocetriadkov_teplota_check = mysqli_num_rows($result_teplota_check);
    $row_teplota_check = mysqli_fetch_assoc($result_teplota_check);
  
    if(!$result_teplota_check)
    {
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        <strong>ERR:</strong> Prikaz SQL sa neda vykonat ".$query_teplota_check."
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>";
    }
    if($row_teplota_check["COUNT(*)"] == 0)
    {
      echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
      <strong>ERR:</strong> V databáze tbl_teplota sa nenachádzajú údaje! 
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
      </button>
      </div>";
    }
    
    //vlhkost
    $query_vlhkost_check = "SELECT COUNT(*) FROM filip_soc.tbl_vlhkost tv;";
    $result_vlhkost_check = mysqli_query($conn,$query_vlhkost_check);
    $pocetriadkov_vlhkost_check = mysqli_num_rows($result_vlhkost_check);
    $row_vlhkost_check = mysqli_fetch_assoc($result_vlhkost_check);
  
    if(!$result_vlhkost_check)
    {
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        <strong>ERR:</strong> Prikaz SQL sa neda vykonat ".$query_vlhkost_check."
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>";
    }
    if($row_vlhkost_check["COUNT(*)"] == 0)
    {
      echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
      <strong>ERR:</strong> V databáze tbl_vlhkost sa nenachádzajú údaje! 
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
      </button>
      </div>";
    }
    
    //tlak
    $query_tlak_check = "SELECT COUNT(*) FROM filip_soc.tbl_tlak tt; ";
    $result_tlak_check = mysqli_query($conn,$query_tlak_check);
    $pocetriadkov_tlak_check = mysqli_num_rows($result_tlak_check);
    $row_tlak_check = mysqli_fetch_assoc($result_tlak_check);
  
    if(!$result_tlak_check)
    {
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        <strong>ERR:</strong> Prikaz SQL sa neda vykonat ".$query_tlak_check."
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>";
    }
    if($row_tlak_check["COUNT(*)"] == 0)
    {
      echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
      <strong>ERR:</strong> V databáze tbl_tlak sa nenachádzajú údaje! 
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
      </button>
      </div>";
    }
    
?>
