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
            <h3>Test</h3>
            <p id="zobrazitHodiny"></p>
        </div>
    </div>
</div>
<p></p>
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