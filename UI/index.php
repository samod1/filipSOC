<?php
/**
 * VNUTORNA UNIFORMNA STRUKTURA PROGRAMU
 * pouzivat bootstrapove divy 
 *      <div class="col">
 *          <div class = "row">
 *              <p>...</p>
 *          </div>
 *      <div>
 *  Na uvod suboru zavolat cez prikaz include z adresaru confs head.php a na zaver footer.php 
 */


$nazovTabu ="Filip Stredoskolska praca";
include "confs/head.php";
?>

<div  class="container-fluid">
    <div class="row">
        <div class="col">
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

                  <tr>
                    <td></td>
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

                </tbody>
              </table>
            </div>
            <p id="zobrazitHodiny"></p>
        </div>
    </div>
</div>

<?php
include "confs/footer.php";
?>

<script>
    function hodiny()
{
  const today = new Date();
  let h = getHours();
  let m = getMinutes();
  let s = getSeconds();
  m=checkTime(m);
  s=checkTime(s);
  document.getElementById("zobrazitHodiny").innerHTML = h + ":" + m + ":" + s;
  setTimeout(hodiny,1000);
}

function checkTime(i)
{
  if(i < 10){i = "0" + i};
  return i;
}
</script>

