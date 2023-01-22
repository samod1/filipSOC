<?php

$conn = "";
$nazovTabu ="Filip Stredoskolska praca";
$stranka = "udaje";
include "confs/head.php";


//kontrola role
if(isset($_GET["rola"]) && $_GET["rola"] == "admin")
{
     $admin_mode = TRUE;
}
else
{
     $_GET["rola"] = "user";
     $admin_mode = FALSE;
}

//settings
$query_settings = "SELECT * FROM filip_soc.tbl_settings ts WHERE id_nastavenia = 8;";
$result_settings = mysqli_query($conn,$query_settings);
$row_settings = mysqli_fetch_assoc($result_settings);

?>

<div  class="container-fluid mb-5">
    <div class="row">
          <div class="col">

               <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                         <a class="nav-link active" id="teplota-tab" data-toggle="tab" href="#teplota" role="tab" aria-controls="teplota" aria-selected="true">Teplota</a>
                    </li>
                    <li class="nav-item">
                         <a class="nav-link" id="tlak-tab" data-toggle="tab" href="#tlak" role="tab" aria-controls="profile" aria-selected="false">Tlak</a>
                    </li>
                    <li class="nav-item">
                         <a class="nav-link" id="vlhkost-tab" data-toggle="tab" href="#vlhkost" role="tab" aria-controls="vlhkost" aria-selected="false">Vlhkost</a>
                    </li>
               </ul>

               <div class="tab-content" id="myTabContent">

                    <!--TEPLOTA-->
                    <?php include "confs/udaje_teplota.php"?>
                    
                    <!--TLAK-->
                    <?php include "confs/udaje_tlak.php"?>

                    <!--VLHKOST-->
                    <?php include "confs/udaje_vlhkost.php"?>

                    <div class="mb-5"></div>

               </div>     
          </div>
     </div>
</div>

<?php
include "confs/footer.php";
?>