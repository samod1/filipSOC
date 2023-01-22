<?php
    //maximum zobrazenych hodnot
    $results_per_page = 10;  
  
    //aktuálna strana
    if (!isset ($_GET['page_teplota']) ) {  
        $page = 1;  
    } else {  
        $page = $_GET['page_teplota'];  
    }  
  
    //odkial ma sql zacinat
    $page_first_result = ($page-1) * $results_per_page;  

?>

<div class="tab-pane fade show active" id="teplota" role="tabpanel" aria-labelledby="teplota-tab">

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
               $query_teplota = "SELECT id_merania,value,timestamp,eo.názov ,ej.jednotka  FROM filip_soc.tbl_teplota tt INNER JOIN filip_soc.enum_obce eo ON  tt.miesto_merania = eo.kod  INNER JOIN  filip_soc.enum_jednotky ej ON  tt.jednotka = ej.id ORDER BY id_merania DESC  LIMIT $page_first_result,$results_per_page";
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
                                   <td> <?php echo $vypocet." "."°F";?> </td>
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
                    <td> <?php echo $row_teplota["názov"];?> </td>              
                    <td>
                         <!-- Button informácie -->
                         <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#informacie<?php echo $row_teplota["id_merania"];?>">Informácie</button>
                         <!-- Button Zmazat-->
                         <?php 
                              if($admin_mode)
                              {
                                   ?>
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#zmazat<?php echo $row_teplota["id_merania"];?>">Zmazat údaj</button>
                                   <?php
                              }
                         ?>              
                    </td>

                    <!--Informačné okno-->
                    <div class="modal fade" id="informacie<?php echo $row_teplota["id_merania"];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                                       <p><b>Čas merania:</b> <?php echo date("Y.m.d - h:i:s A", strtotime($row_teplota["timestamp"]));?></p>
                                                  <?php
                                             }
                                             else
                                             {
                                                  ?>
                                                       <p><b>Čas merania:</b> <?php echo date("Y.m.d - H:i:s", strtotime($row_teplota["timestamp"]));?></p>
                                                  <?php
                                             }
                                        ?>
                                        <p><b>Nazov senzoru: </b>BMP180 </p>
                                        <?php
                                             if($row_settings["jednotky"] == 2)
                                             {
                                                  $vypocet = ($row_teplota["value"] * 1.8) + 32
                                                  ?>
                                                       <p><b>Nameraná hodnota:</b> <?php echo $vypocet." "."°F";?></p>
                                                  <?php
                                             }
                                             else
                                             {
                                                  ?>
                                                       <p><b>Nameraná hodnota:</b> <?php echo $row_teplota["value"]." ".$row_teplota["jednotka"];?></p>
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

                    <!--Zmazať-->
                    <div class="modal fade" id="zmazat<?php echo $row_teplota["id_merania"];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                        <button type="button" name="delete_teplota" id="delete_teplota" class="btn btn-primary" data-dismiss="modal">Ano</button>
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
                    <?php
                        //vytvaranie pagination
                         for($page = 1; $page<= 10; $page++) {  
                              echo'<li class="page-item"><a class="page-link" href="udaje.php?page_teplota='.$page.'">'.$page.'</a></li>';
                         }
                    ?>
               </ul>
          </nav>

     </div>
</div>
