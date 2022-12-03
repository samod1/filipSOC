<?php
    $server = "db.dw082.nameserver.sk";
    $user = "filip_majchrak";
    $pass = "X5Me1BZj";
    $db = "filip_soc";

    $conn= mysqli_connect($server,$user,$pass,$db);

    if(!$conn)
    {
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        Pripojenie na databazu <b>". $server . "</b> zlyhalo
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>";
    }

    else
    {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        Pripojenie na databazu <b>". $server . "</b> prebehlo uspesne
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>";
    }

    $gitCommit = exec("git log --pretty=%h -n1 HEAD");

    //TODO grafana integration
?>