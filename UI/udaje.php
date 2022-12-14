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
                    <div class="tab-pane fade show active" id="teplota" role="tabpanel" aria-labelledby="teplota-tab">

                         <!-- Tabulka s 10 poslednymi hodnotami-->
                         <div id="pricing" class="container-fluid">
                              <table class="table table-hover table-bordered text-center mt-3">
                                   <thead>
                                        <tr>
                                        <th>Merany atribut</th>
                                        <th>Namerana hodnota</th>
                                        <th>??as merania</th>
                                        <th>Miesto merania</th>
                                        <th>Akcia</th>
                                        </tr>
                                   </thead>
                                   
                                   <tbody class="table-active">
                                   <?php
                                   $query_teplota = "SELECT id_merania,value,timestamp,eo.n??zov ,ej.jednotka  FROM filip_soc.tbl_teplota tt INNER JOIN filip_soc.enum_obce eo ON  tt.miesto_merania = eo.kod  INNER JOIN  filip_soc.enum_jednotky ej ON  tt.jednotka = ej.id ORDER BY id_merania DESC  LIMIT 10;";
                                   $result_teplota = mysqli_query($conn,$query_teplota);
                                   $pocetriadkov_teplota = mysqli_num_rows($result_teplota);

                                   while ($row_teplota = mysqli_fetch_assoc($result_teplota))
                                   { 
                                   ?>
                                   <tr>
                                        <td>Teplota</td>
                                        <?php
                                             //Prepocitavanie teploty
                                             if($row_settings["jednotky"] == 2)
                                             {
                                                  $vypocet = ($row_teplota["value"] * 1.8) + 32
                                                  ?>
                                                       <td> <?php echo $vypocet." "."??F";?> </td>
                                                  <?php
                                             }
                                             else
                                             {
                                                  ?>
                                                       <td> <?php echo $row_teplota["value"]." ".$row_teplota["jednotka"];?> </td>
                                                  <?php
                                             }

                                             //Prepocitavanie casu teplota
                                             if($row_settings["hod_format"] == 12)
                                             {
                                                  ?>
                                                       <td> <?php echo date("Y.m.d - h:i:s A", strtotime($row_teplota["timestamp"]));?> </td>
                                                  <?php
                                             }
                                             else
                                             {
                                                  ?>
                                                       <td> <?php echo date("Y.m.d - H:i:s", strtotime($row_teplota["timestamp"]));?> </td>
                                                  <?php
                                             }
                                        ?>
                                        <td> <?php echo $row_teplota["n??zov"];?> </td>              
                                        <td>
                                             <!-- Button inform??cie -->
                                             <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#informacie<?php echo $row_teplota["id_merania"];?>">Inform??cie</button>
                                             <!-- Button Zmazat-->
                                             <?php 
                                                  if($admin_mode)
                                                  {
                                                       ?>
                                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#zmazat<?php echo $row_teplota["id_merania"];?>">Zmazat ??daj</button>
                                                       <?php
                                                  }
                                             ?>              
                                        </td>

                                        <!--Informa??n?? okno-->
                                        <div class="modal fade" id="informacie<?php echo $row_teplota["id_merania"];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                             <div class="modal-dialog modal-dialog-centered" role="document">
                                                  <div class="modal-content">
                                                       <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">Podrobn?? inform??cie</h5>
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
                                                                           <p><b>??as merania:</b> <?php echo date("Y.m.d - h:i:s A", strtotime($row_teplota["timestamp"]));?></p>
                                                                      <?php
                                                                 }
                                                                 else
                                                                 {
                                                                      ?>
                                                                           <p><b>??as merania:</b> <?php echo date("Y.m.d - H:i:s", strtotime($row_teplota["timestamp"]));?></p>
                                                                      <?php
                                                                 }
                                                            ?>
                                                            <p><b>Nazov senzoru: </b> </p>
                                                            <p><b>Vyuzitie: </b> </p>
                                                            <?php
                                                                 if($row_settings["jednotky"] == 2)
                                                                 {
                                                                      $vypocet = ($row_teplota["value"] * 1.8) + 32
                                                                      ?>
                                                                          <p><b>Nameran?? hodnota:</b> <?php echo $vypocet." "."??F";?></p>
                                                                      <?php
                                                                 }
                                                                 else
                                                                 {
                                                                      ?>
                                                                           <p><b>Nameran?? hodnota:</b> <?php echo $row_teplota["value"]." ".$row_teplota["jednotka"];?></p>
                                                                      <?php
                                                                 }
                                                            ?>  
                                                       </div>
                                                       <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>

                                        <!--Zmaza??-->
                                        <div class="modal fade" id="zmazat<?php echo $row_teplota["id_merania"];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                             <div class="modal-dialog modal-dialog-centered" role="document">
                                                  <div class="modal-content">
                                                       <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">Zmaza??</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                 <span aria-hidden="true">&times;</span>
                                                            </button>
                                                       </div>
                                                       <div class="modal-body">
                                                            <center><h3><b>Chce?? naozaj zmaza?? ??daj?</b></h3></center>
                                                       </div>
                                                       <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Ano</button>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Nie</button>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                   </tr>             
                                   <?php } ?>
                                   </tbody>
                              </table>

                              <nav aria-label="Page">
                                   <ul class="pagination">
                                        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                   </ul>
                              </nav>

                         </div>
                    </div>

                    <!--TLAK-->
                    <div class="tab-pane fade" id="tlak" role="tabpanel" aria-labelledby="tlak-tab">
                         <!-- Tabulka s 10 poslednymi hodnotami-->
                         <div id="pricing" class="container-fluid">
                              <table class="table table-hover table-bordered text-center mt-3">
                                   <thead>
                                        <tr>
                                        <th>Merany atribut</th>
                                        <th>Namerana hodnota</th>
                                        <th>??as merania</th>
                                        <th>Miesto merania</th>
                                        <th>Akcia</th>
                                        </tr>
                                   </thead>
                                   
                                   <tbody class="table-active">
                                   <?php
                                   $query_tlak = "SELECT id_merania,value,timestamp,eo.n??zov ,ej.jednotka  FROM filip_soc.tbl_tlak tt INNER JOIN filip_soc.enum_obce eo ON tt.miesto_merania = eo.kod  INNER JOIN  filip_soc.enum_jednotky ej ON tt.jednotka = ej.id ORDER BY id_merania DESC LIMIT 10;";
                                   $result_tlak = mysqli_query($conn,$query_tlak);
                                   $pocetriadkov_tlak = mysqli_num_rows($result_tlak);
                                  
                                   while ($row_tlak = mysqli_fetch_assoc($result_tlak))
                                   { 

                                   ?>
                                   <tr>
                                        <td>Tlak</td>
                                        <td> <?php echo $row_tlak["value"]." ".$row_tlak["jednotka"];?> </td>
                                        <?php
                                             //Prepocitavanie casu tlak
                                             if($row_settings["hod_format"] == 12)
                                             {
                                                  ?>
                                                       <td> <?php echo date("Y.m.d - h:i:s A", strtotime($row_tlak["timestamp"]));?> </td>
                                                  <?php
                                             }
                                             else
                                             {
                                                  ?>
                                                       <td> <?php echo date("Y.m.d - H:i:s", strtotime($row_tlak["timestamp"]));?> </td>
                                                  <?php
                                             }
                                        ?>
                                        <td> <?php echo $row_tlak["n??zov"];?> </td>              
                                        <td>
                                        <!-- Button inform??cie -->
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#informacie<?php echo $row_tlak["id_merania"];?>">Inform??cie</button>
                                        <!-- Button Zmazat-->
                                        <?php 
                                             if($admin_mode)
                                             {
                                                  ?>
                                                       <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#zmazat<?php echo $row_tlak["id_merania"];?>">Zmazat ??daj</button>
                                                  <?php
                                             }
                                        ?>     
                                        
                                        </td>

                                        <!--Informa??n?? okno-->
                                        <div class="modal fade" id="informacie<?php echo $row_tlak["id_merania"];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                             <div class="modal-dialog modal-dialog-centered" role="document">
                                                  <div class="modal-content">
                                                       <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">Podrobn?? inform??cie</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                 <span aria-hidden="true">&times;</span>
                                                            </button>
                                                       </div>
                                                       <div class="modal-body">
                                                            <?php
                                                                 //Prepocitavanie casu tlak
                                                                 if($row_settings["hod_format"] == 12)
                                                                 {
                                                                      ?>
                                                                           <p><b>??as merania:</b> <?php echo date("Y.m.d - h:i:s A", strtotime($row_tlak["timestamp"]));?></p>
                                                                      <?php
                                                                 }
                                                                 else
                                                                 {
                                                                      ?>
                                                                           <p><b>??as merania:</b> <?php echo date("Y.m.d - H:i:s", strtotime($row_tlak["timestamp"]));?></p>
                                                                      <?php
                                                                 }
                                                            ?>
                                                            <p><b>Nazov senzoru: </b> </p>
                                                            <p><b>Vyuzitie: </b> </p>
                                                            <p><b>Nameran?? hodnota:</b> <?php echo $row_tlak["value"]." ".$row_tlak["jednotka"];?></p>
                                                       </div>
                                                       <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>

                                        <!--Zmaza??-->
                                        <div class="modal fade" id="zmazat<?php echo $row_tlak["id_merania"];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                             <div class="modal-dialog modal-dialog-centered" role="document">
                                                  <div class="modal-content">
                                                       <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">Zmaza??</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                 <span aria-hidden="true">&times;</span>
                                                            </button>
                                                       </div>
                                                       <div class="modal-body">
                                                            <center><h3><b>Chce?? naozaj zmaza?? ??daj?</b></h3></center>
                                                       </div>
                                                       <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Ano</button>
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

                    <!--VLHKOST-->
                    <div class="tab-pane fade" id="vlhkost" role="tabpanel" aria-labelledby="vlhkost-tab">
                         <!-- Tabulka s 10 poslednymi hodnotami-->
                         <div id="pricing" class="container-fluid">
                              <table class="table table-hover table-bordered text-center mt-3">
                                   <thead>
                                        <tr>
                                        <th>Merany atribut</th>
                                        <th>Namerana hodnota</th>
                                        <th>??as merania</th>
                                        <th>Miesto merania</th>
                                        <th>Akcia</th>
                                        </tr>
                                   </thead>
                                   
                                   <tbody class="table-active">
                                   <?php
                                   $query_vlhkost = "SELECT id_merania,hodnota,timestamp,eo.n??zov ,ej.jednotka  FROM filip_soc.tbl_vlhkost tv INNER JOIN filip_soc.enum_obce eo ON  tv.miesto_merania = eo.kod  INNER JOIN  filip_soc.enum_jednotky ej ON  tv.jednotka = ej.id ORDER BY id_merania DESC LIMIT 10;";
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

                                        <td> <?php echo $row_vlhkost["n??zov"];?> </td>              
                                        <td>
                                        <!-- Button inform??cie -->
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#informacie<?php echo $row_vlhkost["id_merania"];?>">Inform??cie</button>
                                        <!-- Button Zmazat-->
                                        <?php 
                                             if($admin_mode)
                                             {
                                                  ?>
                                                       <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#zmazat<?php echo $row_vlhkost["id_merania"];?>">Zmazat ??daj</button>
                                                  <?php
                                             }
                                        ?>     
                                        </td>

                                        <!--Informa??n?? okno-->
                                        <div class="modal fade" id="informacie<?php echo $row_vlhkost["id_merania"];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                             <div class="modal-dialog modal-dialog-centered" role="document">
                                                  <div class="modal-content">
                                                       <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">Podrobn?? inform??cie</h5>
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
                                                                           <p><b>??as merania:</b> <?php echo date("Y.m.d - h:i:s A", strtotime($row_vlhkost["timestamp"]));?></p>
                                                                      <?php
                                                                 }
                                                                 else
                                                                 {
                                                                      ?>
                                                                           <p><b>??as merania:</b> <?php echo date("Y.m.d - H:i:s", strtotime($row_vlhkost["timestamp"]));?></p>
                                                                      <?php
                                                                 }
                                                            ?>
                                                            <p><b>Nazov senzoru: </b> </p>
                                                            <p><b>Vyuzitie: </b> </p>
                                                            <p><b>Nameran?? hodnota:</b> <?php echo $row_vlhkost["hodnota"]." ".$row_vlhkost["jednotka"];?></p>
                                                       </div>
                                                       <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>

                                        <!--Zmaza??-->
                                        <div class="modal fade" id="zmazat<?php echo $row_vlhkost["id_merania"];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                             <div class="modal-dialog modal-dialog-centered" role="document">
                                                  <div class="modal-content">
                                                       <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">Zmaza??</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                 <span aria-hidden="true">&times;</span>
                                                            </button>
                                                       </div>
                                                       <div class="modal-body">
                                                            <center><h3><b>Chce?? naozaj zmaza?? ??daj?</b></h3></center>
                                                       </div>
                                                       <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Ano</button>
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