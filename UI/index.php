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


<?php
/**Skušobné údaje */



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
                    <th>Merany atribut</th>
                    <th>Hodnota</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Teplota</td>
                    <td>
                      <?php
                      $query = "Select MAX(tt.id_merania),  tt.value, tt.miesto_merania, eo.názov  from filip_soc.tbl_teplota tt inner join filip_soc.enum_obce eo  on miesto_merania = kod";
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

                      while ($row = mysqli_fetch_assoc($result)){
                        echo $row["value"];
                      } ?>&#8451;</td>
                  </tr>
                  <tr>
                    <td>Tlak vzduchu</td>
                    <td>hPa</td>
                  </tr>
                  <tr>
                    <td>Vlhkosť</td>
                    <td>%</td>
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