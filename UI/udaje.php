<?php

$conn = "";
$nazovTabu ="Filip Stredoskolska praca";
include "confs/head.php";

?>



<div  class="container-fluid">
    <div class="row">
        <div class="col">

          <!-- Tabulka s 10 poslednymi hodnotami-->
            <div id="pricing" class="container-fluid">
              <table class="table table-bordered table-striped text-center">
                <thead>
                  <tr>
                    <th>Kedy sa meralo</th>
                    <th>Teplota</th>
                    <th>Vlhkost</th>
                    <th>Tlak vzduchu</th>
                    <th>Miesto merania</th>
                    <th></th>
                  </tr>
                </thead>

                <tbody>
                    <tr>
                         <td>15.9.2022</td>
                         <td>25</td>
                         <td>80</td>
                         <td>1056</td>
                         <td>Trnava</td>
                         <td>
                              <!-- Button informácie -->
                              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#informacie">Informácie</button>
                              <!-- Button Zmazat-->
                              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#zmazat">Zmazat údaj</button>
                         </td>
                    </tr>
                </tbody>
              </table>

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
            <div id = "jsclock" onload="hodiny()"></div>
        </div>
    </div>
</div>

<?php
include "confs/footer.php";
?>

<script>
function hodiny() {
  let date = new Date(); 
  let hh = date.getHours();
  let mm = date.getMinutes();
  let ss = date.getSeconds();

   hh = (hh < 10) ? "0" + hh : hh;
   mm = (mm < 10) ? "0" + mm : mm;
   ss = (ss < 10) ? "0" + ss : ss;
    
   let time = hh + ":" + mm + ":" + ss + " ";

  document.getElementById("jsclock").innerText = time; 
  let t = setTimeout(function(){ hodiny() }, 1000);
}
hodiny();
</script>