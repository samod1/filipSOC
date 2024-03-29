<?php
$conn = "";
$nazovTabu ="Filip Stredoskolska praca";
$stranka = "index";
include "confs/head.php";

$prsi = true;

//settings
$query_settings = "SELECT * FROM filip_soc.tbl_settings ts WHERE id_nastavenia = 8;";
$result_settings = mysqli_query($conn,$query_settings);
$row_settings = mysqli_fetch_assoc($result_settings);


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
            $query_teplota = "SELECT value,timestamp,eo.názov,ej.jednotka  FROM filip_soc.tbl_teplota tt INNER JOIN filip_soc.enum_obce eo ON tt.miesto_merania = eo.kod  INNER JOIN  filip_soc.enum_jednotky ej ON tt.jednotka = ej.id ORDER BY id_merania DESC LIMIT 1;";
            $result_teplota = mysqli_query($conn,$query_teplota);
            $pocetriadkov_teplota = mysqli_num_rows($result_teplota);

            while ($row_teplota = mysqli_fetch_assoc($result_teplota))
            {
            ?>
            <!--zobrazovaie-->
            <div class="card text-white bg-danger mb-4 h-100" style="max-width: 20rem;">
              <div class="card-body text-center">
                  <div class="card-header"><h1>Teplota</h1></div>
                <div class="card-body">
                  <?php
                    //Prepocitavanie teploty
                    if($row_settings["jednotky"] == 2)
                    {
                        $vypocet = ($row_teplota["value"] * 1.8) + 32
                        ?>
                          <h1 class="card-title"><?php echo $vypocet." "."°F";?><h1>
                        <?php
                    }
                    else
                    {
                        ?>
                          <h1 class="card-title"><?php echo $row_teplota["value"]." ".$row_teplota["jednotka"];?></h1>
                        <?php
                    }

                    //Prepocitavanie casu teplota
                    if($row_settings["hod_format"] == 12)
                    {
                        ?>
                          <h5 class="card-title"><?php echo date("Y.m.d - h:i:s A", strtotime($row_teplota["timestamp"]));?></h5>
                        <?php
                    }
                    else
                    {
                        ?>
                          <h5 class="card-title"><?php echo date("Y.m.d - H:i:s", strtotime($row_teplota["timestamp"]));?></h5>
                        <?php
                    }
                  ?>
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
            $query_tlak = "SELECT value,timestamp,eo.názov ,ej.jednotka  FROM filip_soc.tbl_tlak tt  INNER JOIN filip_soc.enum_obce eo ON tt.miesto_merania = eo.kod  INNER JOIN  filip_soc.enum_jednotky ej ON tt.jednotka = ej.id ORDER BY id_merania DESC LIMIT 1;";
            $result_tlak = mysqli_query($conn,$query_tlak);
            $pocetriadkov_tlak = mysqli_num_rows($result_tlak);

            while ($row_tlak = mysqli_fetch_assoc($result_tlak))
            { 

            ?>
            <!--Zobrazovanie-->
            <div class="card text-white bg-success mb-4 h-100" style="max-width: 20rem;">
              <div class="card-body text-center">
                  <div class="card-header"><h1>Tlak</h1></div>
                <div class="card-body">
                  <h1 class="card-title"><?php echo $row_tlak["value"]." ". $row_tlak["jednotka"];?></h1>
                  <?php
                    //Prepocitavanie casu teplota
                    if($row_settings["hod_format"] == 12)
                    {
                        ?>
                          <h5 class="card-title"><?php echo date("Y.m.d - h:i:s A", strtotime($row_tlak["timestamp"]));?></h5>
                        <?php
                    }
                    else
                    {
                        ?>
                          <h5 class="card-title"><?php echo date("Y.m.d - H:i:s", strtotime($row_tlak["timestamp"]));?></h5>
                        <?php
                    }
                  ?>
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
            $query_vlhkost = "SELECT hodnota,timestamp,eo.názov ,ej.jednotka  FROM filip_soc.tbl_vlhkost tv INNER JOIN filip_soc.enum_obce eo ON tv.miesto_merania = eo.kod  INNER JOIN  filip_soc.enum_jednotky ej ON tv.jednotka = ej.id ORDER BY id_merania DESC LIMIT 1;";
            $result_vlhkost = mysqli_query($conn,$query_vlhkost);
            $pocetriadkov_vlhkost = mysqli_num_rows($result_vlhkost);

            while ($row_vlhkost = mysqli_fetch_assoc($result_vlhkost))
            { 

            ?>
            <!--zobrazovaie-->
            <div class="card text-white bg-warning mb-4 h-100" style="max-width: 20rem;">
              <div class="card-body text-center">
                <div class="card-header"><h1>Vlhkost</h1></div>
                <div class="card-body">

                  <h1 class="card-title"><?php echo $row_vlhkost["hodnota"]." ". $row_vlhkost["jednotka"];?></h1>
                  <?php
                    //Prepocitavanie casu teplota
                    if($row_settings["hod_format"] == 12)
                    {
                        ?>
                          <h5 class="card-title"><?php echo date("Y.m.d - h:i:s A", strtotime($row_vlhkost["timestamp"]));?></h5>
                        <?php
                    }
                    else
                    {
                        ?>
                          <h5 class="card-title"><?php echo date("Y.m.d - H:i:s", strtotime($row_vlhkost["timestamp"]));?></h5>
                        <?php
                    }
                  ?>

                  <h5 class="card-text"><?php echo $row_vlhkost["názov"];?></h5>
                </div>                   
              </div>
            </div>                                     
          <?php } ?>
          </div>

          <!--stvrty stlpec-->
          <div class="col-sm">
          <!--Dazd-->
          <?php
            $query_dazd = "SELECT hodnota,timestamp,eo.názov FROM filip_soc.tbl_dazd td INNER JOIN filip_soc.enum_obce eo ON  td.miesto_merania = eo.kod ORDER BY id_merania DESC LIMIT 1";
            $result_dazd = mysqli_query($conn,$query_dazd);

            while ($row_dazd = mysqli_fetch_assoc($result_dazd))
            { 
            ?>

              <!--Karticka pre dazd-->
                <div class="card text-white bg-info mb-4 h-100" style="max-width: 20rem;">
                  <div class="card-body text-center">
                    <div class="card-header"><h1 class="card-title">Dážď</h1></div>
                    <div class="card-body pt-1">
                      <?php 
                      if($row_dazd["hodnota"] == 1)
                      {
                        ?>
                        <h1 class="card-text"><i class="fa fa-check" aria-hidden="true"></i><h1>
                        <h5 class="card-text"><?php echo date("Y.m.d - H:i:s", strtotime($row_dazd["timestamp"]));?></h5>
                        <h5 class="card-text"><?php echo $row_dazd["názov"];?></h5>
                        <?php
                      }
                      elseif($row_dazd["hodnota"] == 0)
                      {
                        ?>
                        <h1 class="card-text mt-4"><i class="fa fa-times" aria-hidden="true"></i><h1>
                        <h5 class="card-text"><?php echo date("Y.m.d - H:i:s", strtotime($row_dazd["timestamp"]));?></h5>
                        <h5 class="card-text"><?php echo $row_dazd["názov"];?></h5>
                        <?php
                      }
                      ?>
                    </div>                   
                  </div>
                </div>                                                
          <?php } ?>
          </div>

        </div>
      </div>     
  </div>
</div>


<?php
include "confs/footer.php";
?>