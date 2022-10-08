<?php

$conn = "";
$nazovTabu ="Filip Stredoskolska praca";
include "confs/head.php";

?>

<div  class="container-fluid mb-5">
    <div class="row">
        <div class="col">

          <!-- Tabulka s 10 poslednymi hodnotami-->
            <div id="pricing" class="container-fluid">
              <table class="table table-bordered table-striped text-center mb-5">
                <thead>
                <?php
                    $query = "SELECT tt.value, tt.timestamp, ej.jednotka, eo.názov from tbl_teplota tt Inner join enum_obce eo ON tt.miesto_merania =eo.kod INNER JOIN enum_jednotky ej on ej.id = tt.jednotka LIMIT 10";
                    $result = mysqli_query($conn,$query);
                    $pocetriadkov = mysqli_num_rows($result);
                    if(!$result)
                    {
                      echo "ERR: neda sa vykonat prikaz";
                    }
                    
                    else
                    {
                      if ($pocetriadkov == 0)
                      {
                        echo "V prislusnej databaze sa nic nenaslo";
                      }
                    }

                    while ($row = mysqli_fetch_assoc($result))
                    { 

                    ?>
                    <tr>
                         <td>Teplota</td>
                         <td> <?php echo $row["value"];?> </td>
                         <td><?php echo $row["jednotka"];?> </td>
                         <td> <?php echo $row["timestamp"];?> </td>
                         <td> <?php echo $row["názov"];?> </td>              
                         <td>
                         <!-- Button informácie -->
                         <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#informacie">Informácie</button>
                         <!-- Button Zmazat-->
                         <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#zmazat">Zmazat údaj</button>
                         </td>
                    </tr>  

                    <?php } ?>
                </tbody>


              <!--Informačné okno-->
               <div class="modal fade" id="informacie" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                         <div class="modal-content">
                              <div class="modal-header">
                                   <h5 class="modal-title" id="exampleModalLongTitle">Podrobné informácie</h5>
                                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                   </button>
                              </div>
                              <div class="modal-body">
                                   <p><b>Čas merania: </b> </b>
                                   <p><b>Nazov senzoru: </b> </b>
                                   <p><b>Vyuzitie: </b> </b>
                                   <p><b>Nameraná hodnota: </b> </b>
                              </div>
                              <div class="modal-footer">
                                   <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              </div>
                         </div>
                    </div>
               </div>

               <!--Zmazať-->
               <div class="modal fade" id="zmazat" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                   <button type="button" class="btn btn-primary" data-dismiss="modal">Ano</button>
                                   <button type="button" class="btn btn-secondary" data-dismiss="modal">Nie</button>
                              </div>
                         </div>
                    </div>
               </div>  
            </div>
        </div>
    </div>
</div>

<?php
include "confs/footer.php";
?>