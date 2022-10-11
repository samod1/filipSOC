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
include "confs/head.php";
$active = 1;
?>


<div class="container-fluid">
    <div class="row">
        <div class="col">
          <h1 class="text-center">Posledné namerané údaje</h1>
          <!-- Tabulka s nameranými hodnotami-->
            <div id="pricing" class="container-fluid">
              <table class="table table-bordered text-center">
                <thead>
                  <tr>
                    <th>Merany atribut</th>
                    <th>Hodnota</th>
                    <th>Čas merania</th>
                    <th>Miesto merania</th>
                  </tr>
                </thead>
                <!--Teplota-->
                <tbody class="table-active">
                    <?php
                    $query = "SELECT Max(id_merania),value,timestamp,eo.názov,ej.jednotka  FROM filip_soc.tbl_teplota tt INNER JOIN filip_soc.enum_obce eo ON tt.miesto_merania = eo.kod  INNER JOIN  filip_soc.enum_jednotky ej ON tt.jednotka = ej.id;";
                    $result = mysqli_query($conn,$query);
                    $pocetriadkov = mysqli_num_rows($result);
                    if(!$result)
                    {
                      echo "ERR: neda sa vykonat prikaz";
                    }
                    
                    else
                    {
                      if ($pocetriadkov == 0)
                      {
                        echo "V prislusnej databaze sa nic nenaslo";
                      }
                    }

                    while ($row = mysqli_fetch_assoc($result))
                    { 

                    ?>
                      <tr>
                        <td>Teplota</td>
                        <td> <?php echo $row["value"];?> </td>
                        <td><?php echo $row["jednotka"];?> </td>
                        <td> <?php echo $row["timestamp"];?> </td>
                        <td> <?php echo $row["názov"];?> </td>
                      </tr>                  
                  <?php } ?>

                  <!--Tlak-->
                  <?php
                    $query1 = "SELECT MAX(id_merania),value,timestamp,eo.názov ,ej.jednotka  FROM filip_soc.tbl_tlak tt  INNER JOIN filip_soc.enum_obce eo ON tt.miesto_merania = eo.kod  INNER JOIN  filip_soc.enum_jednotky ej ON tt.jednotka = ej.id;";
                    $result1 = mysqli_query($conn,$query1);
                    $pocetriadkov1 = mysqli_num_rows($result1);
                    if(!$result1)
                    {
                      echo "ERR: neda sa vykonat prikaz";
                    }
                    
                    else
                    {
                      if ($pocetriadkov1 == 0)
                      {
                        echo "V prislusnej databaze sa nic nenaslo";
                      }
                    }

                    while ($row1 = mysqli_fetch_assoc($result1))
                    { 

                    ?>
                      <tr>
                        <td>Tlak</td>
                        <td> <?php echo $row1["value"];?> </td>
                        <td><?php echo $row1["jednotka"];?> </td>
                        <td> <?php echo $row1["timestamp"];?> </td>
                        <td> <?php echo $row1["názov"];?> </td>
                      </tr>                                       
                  <?php } ?>


                  <!--Vlhkost-->
                  <?php
                    $query1 = "SELECT MAX(id_merania),value,timestamp,eo.názov ,ej.jednotka  FROM filip_soc.tbl_vlhkost tv INNER JOIN filip_soc.enum_obce eo ON tv.miesto_merania = eo.kod  INNER JOIN  filip_soc.enum_jednotky ej ON tv.jednotka = ej.id;";
                    $result1 = mysqli_query($conn,$query1);
                    $pocetriadkov1 = mysqli_num_rows($result1);
                    if(!$result1)
                    {
                      echo "ERR: neda sa vykonat prikaz";
                    }
                    
                    else
                    {
                      if ($pocetriadkov1 == 0)
                      {
                        echo "V prislusnej databaze sa nic nenaslo";
                      }
                    }

                    while ($row1 = mysqli_fetch_assoc($result1))
                    { 

                    ?>
                      <tr>
                        <td>Vlhkost</td>
                        <td> <?php echo $row1["value"];?> </td>
                        <td><?php echo $row1["jednotka"];?> </td>
                        <td> <?php echo $row1["timestamp"];?> </td>
                        <td> <?php echo $row1["názov"];?> </td>
                      </tr>                                       
                  <?php } ?>

                </tbody>
              </table>
            </div>
        </div>
    </div>
</div>

<?php
include "confs/footer.php";
?>