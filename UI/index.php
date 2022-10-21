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
$stranka = "index";
include "confs/head.php";

$prsi = false;

?>


<div class="container-fluid">
    <div class="row">
        <div class="col">
          <h1 class="text-center mb-5 mt-3">Posledné namerané údaje</h1>

          <div class="container">
            <div class="row">
              <!--prvy stlpec-->
              <div class="col-sm">
              <!--Teplota-->
              <?php
                $query_teplota = "SELECT Max(id_merania),value,timestamp,eo.názov,ej.jednotka  FROM filip_soc.tbl_teplota tt INNER JOIN filip_soc.enum_obce eo ON tt.miesto_merania = eo.kod  INNER JOIN  filip_soc.enum_jednotky ej ON tt.jednotka = ej.id;";
                $result_teplota = mysqli_query($conn,$query_teplota);
                $pocetriadkov_teplota = mysqli_num_rows($result_teplota);
                if(!$result_teplota)
                {
                  echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                  <strong>ERR:</strong> Prikaz SQL sa neda vykonat ".$query_teplota."
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
                </div>";
                }
                
                else
                {
                  if ($pocetriadkov_teplota == 0)
                  {
                    echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                    <strong>Holy guacamole!</strong> You should check in on some of those fields below.
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                      <span aria-hidden='true'>&times;</span>
                    </button>
                  </div>";
                  }
                }

                while ($row_teplota = mysqli_fetch_assoc($result_teplota))
                {
                ?>
                <!--zobrazovaie-->
                <div class="card text-white bg-danger mb-4 h-100" style="max-width: 20rem;">
                  <div class="card-body text-center">
                    <div class="card-header"><h1 class="card-title"><?php echo $row_teplota["value"]." ". $row_teplota["jednotka"];?></h1></div>
                    <div class="card-body">
                    <h5 class="card-text "><?php echo $row_teplota["timestamp"];?></h5>
                    <h5 class="card-text"><?php echo $row_teplota["názov"];?></h5>
                    </div>                   
                  </div>
                </div>

              <?php } ?>
              </div>

              <!--druhy stlpec-->
              <div class="col-sm">
              <!--Tlak-->
              <?php
                $query_tlak = "SELECT MAX(id_merania),value,timestamp,eo.názov ,ej.jednotka  FROM filip_soc.tbl_tlak tt  INNER JOIN filip_soc.enum_obce eo ON tt.miesto_merania = eo.kod  INNER JOIN  filip_soc.enum_jednotky ej ON tt.jednotka = ej.id;";
                $result_tlak = mysqli_query($conn,$query_tlak);
                $pocetriadkov_tlak = mysqli_num_rows($result_tlak);
                if(!$result_tlak)
                {
                  echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                  <strong>ERR:</strong> Prikaz SQL sa neda vykonat ".$query_tlak."
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
                </div>";
                }
                
                else
                {
                  if ($pocetriadkov_tlak == 0)
                  {
                    echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                    <strong>Holy guacamole!</strong> You should check in on some of those fields below.
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                      <span aria-hidden='true'>&times;</span>
                    </button>
                  </div>";
                  }
                }
                
                while ($row_tlak = mysqli_fetch_assoc($result_tlak))
                { 

                ?>
                <!--Zobrazovanie-->
                <div class="card text-white bg-success mb-4 h-100" style="max-width: 20rem;">
                  <div class="card-body text-center">
                    <div class="card-header"><h1 class="card-title"><?php echo $row_tlak["value"]." ". $row_tlak["jednotka"];?></h1></div>
                    <div class="card-body">
                    <h5 class="card-text "><?php echo $row_tlak["timestamp"];?></h5>
                    <h5 class="card-text"><?php echo $row_tlak["názov"];?></h5>
                    </div>                   
                  </div>
                </div>                                    
              <?php } ?>
              </div>

              <!--treti stlpec-->
              <div class="col-sm">
              <!--Vlhkost-->
              <?php
                $query_vlhkost = "SELECT MAX(id_merania),value,timestamp,eo.názov ,ej.jednotka  FROM filip_soc.tbl_vlhkost tv INNER JOIN filip_soc.enum_obce eo ON tv.miesto_merania = eo.kod  INNER JOIN  filip_soc.enum_jednotky ej ON tv.jednotka = ej.id;";
                $result_vlhkost = mysqli_query($conn,$query_vlhkost);
                $pocetriadkov_vlhkost = mysqli_num_rows($result_vlhkost);
                if(!$result_vlhkost)
                {
                  echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                  <strong>ERR:</strong> Prikaz SQL sa neda vykonat ".$query_vlhkost."
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
                </div>";
                }
                
                else
                {
                  if ($pocetriadkov_vlhkost == 0)
                  {
                    echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                    <strong>Holy guacamole!</strong> You should check in on some of those fields below.
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                      <span aria-hidden='true'>&times;</span>
                    </button>
                  </div>";
                  }
                }

                while ($row_vlhkost = mysqli_fetch_assoc($result_vlhkost))
                { 

                ?>
                <!--zobrazovaie-->
                <div class="card text-white bg-warning mb-4 h-100" style="max-width: 20rem;">
                  <div class="card-body text-center">
                    <div class="card-header"><h1 class="card-title"><?php echo $row_vlhkost["value"]." ". $row_vlhkost["jednotka"];?></h1></div>
                    <div class="card-body">
                      <h5 class="card-text "><?php echo $row_vlhkost["timestamp"];?></h5>
                      <h5 class="card-text"><?php echo $row_vlhkost["názov"];?></h5>
                    </div>                   
                  </div>
                </div>                                     
              <?php } ?>
              </div>

              <div class="col-sm">
                <div class="card text-white bg-info mb-4 h-100" style="max-width: 20rem;">
                  <div class="card-body text-center">
                    <div class="card-header"><h1 class="card-title">Dážď</h1></div>
                    <div class="card-body">
                      <?php 
                      if($prsi == true)
                      {
                        ?>
                        <h1 class="card-text mt-4"><i class="fa fa-check" aria-hidden="true"></i><h1>
                        <?php
                      }
                      elseif($prsi == false)
                      {
                        ?>
                        <h1 class="card-text mt-4"><i class="fa fa-times" aria-hidden="true"></i><h1>
                        <?php
                      }
                      ?>
                    </div>                   
                  </div>
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