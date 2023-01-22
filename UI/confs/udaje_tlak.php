<div class="tab-pane fade" id="tlak" role="tabpanel" aria-labelledby="tlak-tab">
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
               $query_tlak = "SELECT id_merania,value,timestamp,eo.názov ,ej.jednotka  FROM filip_soc.tbl_tlak tt INNER JOIN filip_soc.enum_obce eo ON tt.miesto_merania = eo.kod  INNER JOIN  filip_soc.enum_jednotky ej ON tt.jednotka = ej.id ORDER BY id_merania DESC LIMIT 10;";
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
                    <td> <?php echo $row_tlak["názov"];?> </td>              
                    <td>
                    <!-- Button informácie -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#informacie<?php echo $row_tlak["id_merania"];?>">Informácie</button>
                    <!-- Button Zmazat-->
                    <?php 
                         if($admin_mode)
                         {
                              ?>
                                   <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#zmazat<?php echo $row_tlak["id_merania"];?>">Zmazat údaj</button>
                              <?php
                         }
                    ?>     
                    
                    </td>

                    <!--Informačné okno-->
                    <div class="modal fade" id="informacie<?php echo $row_tlak["id_merania"];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                             //Prepocitavanie casu tlak
                                             if($row_settings["hod_format"] == 12)
                                             {
                                                  ?>
                                                       <p><b>Čas merania:</b> <?php echo date("Y.m.d - h:i:s A", strtotime($row_tlak["timestamp"]));?></p>
                                                  <?php
                                             }
                                             else
                                             {
                                                  ?>
                                                       <p><b>Čas merania:</b> <?php echo date("Y.m.d - H:i:s", strtotime($row_tlak["timestamp"]));?></p>
                                                  <?php
                                             }
                                        ?>
                                        <p><b>Nazov senzoru: </b>BMP180 </p>
                                        <p><b>Nameraná hodnota:</b> <?php echo $row_tlak["value"]." ".$row_tlak["jednotka"];?></p>
                                   </div>
                                   <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                   </div>
                              </div>
                         </div>
                    </div>

                    <!--Zmazať-->
                    <div class="modal fade" id="zmazat<?php echo $row_tlak["id_merania"];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                        <button type="button" name="delete_tlak" id="delete_tlak" class="btn btn-primary" data-dismiss="modal">Ano</button>
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