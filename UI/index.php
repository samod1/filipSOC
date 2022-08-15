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

<div class="container-fluid">
    <div class="row">
        <div class="col">
            <h3>Test</h3>
            <p class="text-right" id="zobrazitHodiny"></p>
        </div>
    </div>
</div>

<?php
include "confs/footer.php";
?>