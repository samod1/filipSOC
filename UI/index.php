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

 /**Namerané hodnoty */
 $teplota = 30;
 $tlak = 1014.2;
 $vlhkost = 20;


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
                    <th></th>
                    <th>Hodnota</th>
                  </tr>
                </thead>
                <tbody style="">
                  <tr>
                    <td>Teplota</td>
                    <td><?= $teplota ?>&#8451;</td>
                  </tr>
                  <tr>
                    <td>Tlak vzduchu</td>
                    <td><?=$tlak?>hPa</td>
                  </tr>
                  <tr>
                    <td>Vlhkosť</td>
                    <td><?=$vlhkost?>%</td>
                  </tr>
                </tbody>
              </table>
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


