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


$conn = "";
$nazovTabu ="Filip Stredoskolska praca";
$stranka = "grafy";
include "confs/head.php";

?>


<div class="container-fluid">
    <h1>Grafy</h1>



<?php
    include "confs/footer.php";
?>