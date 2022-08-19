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

<?php
/**Skušobné údaje */
$teplota = 30;
$tlak = 1014.2;
$vlhkost = 20;

?>

<div  class="container-fluid">
    <div class="row">
        <div class="col">
        <div  class="container-fluid">
    <div class="row">
        <div class="col">
          <h1 class="text-center">Dashboard</h1>
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

