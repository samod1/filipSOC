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
                    <div class="tab-pane fade" id="vlhkost" role="tabpanel" aria-labelledby="vlhkost-tab">
                         <!-- Tabulka s 10 poslednymi hodnotami-->
                         <div id="pricing" class="container-fluid">
                              <table class="table table-hover table-bordered text-center mt-3">
                                   <thead>
                                        <tr>
                                        <th>Merany atribut</th>
                                        <th>Namerana hodnota</th>
                                        <th>Čas merania</th>
                                        <th>Miesto merania</th>
                                        <th>Akcia</th>
                                        </tr>
                                   </thead>
                                   
                                   <tbody class="table-active">
                                   <?php
                                   $query_vlhkost = "SELECT id_merania,hodnota,timestamp,eo.názov ,ej.jednotka  FROM filip_soc.tbl_vlhkost tv INNER JOIN filip_soc.enum_obce eo ON  tv.miesto_merania = eo.kod  INNER JOIN  filip_soc.enum_jednotky ej ON  tv.jednotka = ej.id ORDER BY id_merania DESC LIMIT 10;";
                                   $result_vlhkost = mysqli_query($conn,$query_vlhkost);
                                   $pocetriadkov_vlhkost = mysqli_num_rows($result_vlhkost);
                                  
                                   while ($row_vlhkost = mysqli_fetch_assoc($result_vlhkost))
                                   { 

                                   ?>
                                   <tr>
                                        <td>Vlhkost</td>

                                        <td> <?php echo $row_vlhkost["hodnota"]." ".$row_vlhkost["jednotka"];?> </td>
                                        <?php
                                             //Prepocitavanie casu vlhkost
                                             if($row_settings["hod_format"] == 12)
                                             {
                                                  ?>
                                                       <td> <?php echo date("Y.m.d - h:i:s A", strtotime($row_vlhkost["timestamp"]));?> </td>
                                                  <?php
                                             }
                                             else
                                             {
                                                  ?>
                                                       <td> <?php echo date("Y.m.d - H:i:s", strtotime($row_vlhkost["timestamp"]));?> </td>
                                                  <?php
                                             }
                                        ?>

                                        <td> <?php echo $row_vlhkost["názov"];?> </td>              
                                        <td>
                                        <!-- Button informácie -->
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#informacie<?php echo $row_vlhkost["id_merania"];?>">Informácie</button>
                                        <!-- Button Zmazat-->
                                        <?php 
                                             if($admin_mode)
                                             {
                                                  ?>
                                                       <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#zmazat<?php echo $row_vlhkost["id_merania"];?>">Zmazat údaj</button>
                                                  <?php
                                             }
                                        ?>     
                                        </td>

                                        <!--Informačné okno-->
                                        <div class="modal fade" id="informacie<?php echo $row_vlhkost["id_merania"];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                             <div class="modal-dialog modal-dialog-centered" role="document">
                                                  <div class="modal-content">
                                                       <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">Podrobné informácie</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                 <span aria-hidden="true">&times;</span>
                                                            </button>
                                                       </div>
                                                       <div class="modal-body">
                                                            <?php
                                                                 //Prepocitavanie casu teplota
                                                                 if($row_settings["hod_format"] == 12)
                                                                 {
                                                                      ?>
                                                                           <p><b>Čas merania:</b> <?php echo date("Y.m.d - h:i:s A", strtotime($row_vlhkost["timestamp"]));?></p>
                                                                      <?php
                                                                 }
                                                                 else
                                                                 {
                                                                      ?>
                                                                           <p><b>Čas merania:</b> <?php echo date("Y.m.d - H:i:s", strtotime($row_vlhkost["timestamp"]));?></p>
                                                                      <?php
                                                                 }
                                                            ?>
                                                            <p><b>Nazov senzoru: </b>HDT11</p>
                                                            <p><b>Nameraná hodnota:</b> <?php echo $row_vlhkost["hodnota"]." ".$row_vlhkost["jednotka"];?></p>
                                                       </div>
                                                       <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>

                                        <!--Zmazať-->
                                        <div class="modal fade" id="zmazat<?php echo $row_vlhkost["id_merania"];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                             <div class="modal-dialog modal-dialog-centered" role="document">
                                                  <div class="modal-content">
                                                       <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">Zmazať</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                 <span aria-hidden="true">&times;</span>
                                                            </button>
                                                       </div>
                                                       <div class="modal-body">
                                                            <center><h3><b>Chceš naozaj zmazať údaj?</b></h3></center>
                                                       </div>
                                                       <div class="modal-footer">
                                                            <button type="button" name="delete_vlhkost" id="delete_vlhkost" class="btn btn-primary" data-dismiss="modal">Ano</button>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Nie</button>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                   </tr>             
                                   <?php } ?>

                                   </tbody>
                              </table>
                         </div>

                         <nav aria-label="Page">
                              <ul class="pagination">
                                   <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                   <li class="page-item"><a class="page-link" href="#1">1</a></li>
                                   <li class="page-item"><a class="page-link" href="#">2</a></li>
                                   <li class="page-item"><a class="page-link" href="#">3</a></li>
                                   <li class="page-item"><a class="page-link" href="#">Next</a></li>
                              </ul>
                         </nav>               

                    </div>

                    <div class="mb-5"></div>

               </div>     
          </div>
     </div>
</div>

<?php
include "confs/footer.php";
?>