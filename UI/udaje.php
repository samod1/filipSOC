<?php
$nazovTabu ="Filip Stredoskolska praca";
include "confs/head.php";
?>

<h1 class="text-center">Posledné namerané údaje</h1>
<!-- Tabulka s nameranými hodnotami-->
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
          <tbody style="">

          <?php 
          for ($x = 0; $x <= 10; $x++) {
          ?>
          <tr>
          <td><?=$x?></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td>
               <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#informacie">
               Informácie
               </button>
               <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#">
               Vymazať údaje
               </button>

               <!-- Modalne okno Informácie -->
               <div class="modal fade" id="informacie" tabindex="-1" role="dialog" aria-labelledby="informacie" aria-hidden="true">
               <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                         <h5 class="modal-title " id="exampleModalLongTitle">Podrobné informácie</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                    <ul class="list-group">
                         <li class="list-group-item">Čas merania: </li>
                         <li class="list-group-item">Názov senzoru: </li>
                         <li class="list-group-item">Využitie: </li>
                         <li class="list-group-item">Nameraná hodnota:</li>
                    </ul>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                    </div>
               </div>
               </div>
          </td>
          </tr>
          <?php } ?>  
     </tbody>
     </table>
</div>

<?php
include "confs/footer.php";
?>