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
?>


<div class="container-fluid">
    <div class="row">
        <div class="col">
          <h1 class="text-center">Posledné namerané údaje</h1>
          <!-- Tabulka s nameranými hodnotami-->
            <div id="pricing" class="container-fluid">
              <table class="table table-bordered table-striped text-center">
                <thead>
                  <tr>
                    <th>Merany atribut</th>
                    <th>Hodnota</th>
                    <th>Čas merania</th>
                    <th>Miesto merania</th>
                  </tr>
                </thead>

                <tbody>
                  
                    <?php
                    $query = "SELECT Max(id_merania),value,timestamp,eo.názov,ej.jednotka  FROM filip_soc.tbl_teplota tt INNER JOIN filip_soc.enum_obce eo ON tt.miesto_merania = eo.kod  INNER JOIN  filip_soc.enum_jednotky ej ON tt.jednotka = ej.id; ";
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
                        <td> <?php echo $row["value"]." ". $row["jednotka"]?> </td>
                        <td> <?php echo $row["timestamp"]?> </td>
                        <td> <?php echo $row["názov"]?> </td>

                      </tr>
                                         
                  <?php } ?>

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