<?php

    $conn = "";
    $nazovTabu ="Filip Stredoskolska praca";
    $stranka = "nastavenia";
    include "confs/head.php";

    //kontrola role
    if(isset($_GET["rola"]) && $_GET["rola"] == "admin")
    {
        $admin_mode = TRUE;
    }
    else
    {
        $_GET["rola"] = "user";
        $admin_mode = FALSE;
    }
?>


<div class="container-fluid">
    <div class="row"> 
        <div class="col-sm">  
            <h1 class="display-4">Nastavenia</h1>
            <br>
            
            <form action="settings.php" method="POST">
                <div class="input-group mb-3">
                    <!--Jednotky-->
                    <h4 class="display-5 mb-0">Jednotky: &nbsp;</h3>
                    <select class="form-select" name="jednotky" aria-label="Jednotky">
                        <?php
                            $queryJednotky = "SELECT jednotky FROM tbl_settings WHERE id_nastavenia=8;";
                            $resultJednotky = mysqli_query($conn, $queryJednotky);
                            while($row = mysqli_fetch_assoc($resultJednotky))
                            {
                                ?>
                                    <option value="1" <?php if ($row["jednotky"] == 1) {echo "selected";}?>>Metricke</option>
                                    <option value="2" <?php if ($row["jednotky"] == 2) {echo "selected";}?>>Imperiálne</option>
                                <?php
                            }
                        ?>
                    </select>
                </div>

                <div class="input-group mb-3">
                    <!--Formát času-->
                    <h4 class="display-5">Časový formát: &nbsp;</h3>
                    <?php
                            $queryJednotky = "SELECT hod_format FROM tbl_settings WHERE id_nastavenia=8;";
                            $resultJednotky = mysqli_query($conn, $queryJednotky);
                            while($row = mysqli_fetch_assoc($resultJednotky))
                            {
                                ?>
                        <div class="form-check mt-1">
                            <input class="form-check-input" type="radio" name="hodformat" value="24" id="hodformat" <?php if($row["hod_format"]== 24){echo "checked";} ?>>
                            <label class="form-check-label">24H &nbsp;</label>
                        </div>
                        <div class="form-check mt-1">
                            <input class="form-check-input" type="radio" name="hodformat" value="12" id="hodformat"<?php if($row["hod_format"]== 12){echo "checked";} ?>>
                            <label class="form-check-label">12H &nbsp;</label>
                        </div>
                                <?php
                            }
                        ?>
                    <br>
                </div>    

                <!--Miesto merania-->
                <h4 class="display-5 mb-3">Miesto merania:<br></h3>
                <div class="input-group mb-3">
                    <h5 class="display-5 mt-1 ml-4">Okres: &nbsp;</h5>
                    <select class="form-select" name="okres" id="okres" aria-label="Okres" required>
                    <?php
                        $query_okres = "SELECT * FROM filip_soc.enum_okres eo WHERE eo.`kód krajiny` = '703';";
                        $result_okres = mysqli_query($conn,$query_okres);
                        $pocetriadkov_okres = mysqli_num_rows($result_okres);
                        
                        while ($row_okres = mysqli_fetch_assoc($result_okres))
                        { 
                        ?>
                            <!--vytvaranie moznosti-->
                            <option value="<?php echo $row_okres["kód"];?>"> <?php echo $row_okres["názov"];?> </option>

                        <?php } ?>

                    </select>
                </div> 

                <div class="input-group mb-3">
                    <h5 class="display-5 mt-1 ml-4">Obec: &nbsp;</h5>
                    <select class="form-select ml-1" name="obec" id="obec" aria-label="Obec" required>
                    <?php

                        $okr = 703;

                        $query_obce = "SELECT kod,názov FROM filip_soc.enum_obce eo2 WHERE eo2.`kód okresu` = $okr";
                        $result_obce = mysqli_query($conn,$query_obce);
                        $pocetriadkov_obce = mysqli_num_rows($result_obce);

                        while ($row_obce = mysqli_fetch_assoc($result_obce))
                        { 
                        ?>
                            <!--vytvaranie moznosti-->
                            <option value="<?php echo $row_obce["kod"];?>"> <?php echo $row_obce["názov"];?> </option>

                        <?php } ?>
                    ?>
                    </select>
                </div> 

                <!--Save-->    
                <?php
                    if($admin_mode)
                    {
                        ?>
                            <input type="submit" name="save" id="save" class="btn btn-primary p-3">
                        <?php    
                    }
                ?>

                <!--Posielanie udajov do tbl_settings-->
                <!--Edit sql-->
                <?php 
                    if(isset($_POST["save"]))
                    {
                        $hod_format = $_POST["hodformat"];
                        $jednotky = $_POST["jednotky"];
                   
                        $query_save_setings = "UPDATE filip_soc.tbl_settings SET hod_format = $hod_format, jednotky = $jednotky WHERE id_nastavenia = 8;";
                        $result_settings= mysqli_query($conn,$query_save_setings);
                    }  

                ?>
            </form>
          
        </div>

        <!--Senzory-->
        <div class="col-sm">
            <h1 class="display-4">Senzory</h1>
            
            <!--ADD Senzor-->
            <?php
                    if($admin_mode)
                    {
                        ?>
                            <button type="button" class="btn btn-primary p-3 pull-right mb-3" data-toggle="modal" data-target="#ADD_sensor">Pridat</button>
                        <?php    
                    }
            ?>
            
            <!--modalne okno add-->
            <div class="modal fade bd-example-modal-lg" id="ADD_sensor" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Pridanie senzoru</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <!--ID_senzoru-->
                        <form action="confs/send_sensor_data.php" method="POST">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text ml-1" id="basic-addon1">Názov senzoru</span>
                                </div>
                                <input type="text" name="id_sensor" id="id_sensor" class="form-control mr-1" aria-describedby="id_sensor">
                            </div>

                            <!--Vyuzitie-->
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text ml-1" id="basic-addon1">Vyuzitie</span>
                                </div>
                                    <input type="text" name="function" id="function" class="form-control mr-1" aria-describedby="function_sensor">
                                
                            </div>
                            <input type="submit" name="poslat" id="poslat" class="btn btn-primary mr-3 float-right">
                        </form>
                    </div>
                </div>
            </div>


            <!--Tabulka senzorov-->
            <table class="table table-hover table-bordered text-center mt-3">
                <thead>
                    <tr>
                        <th scope="col">Senzor_id</th>
                        <th scope="col-6">Vyuzitie</th>
                    </tr>
                </thead>
                <tbody class="table-active">
                    <?php
                    $query_sensor = "SELECT id,sensor_id,pouzitie_senzoru FROM filip_soc.tbl_sensors ts;";
                    $result_sensor = mysqli_query($conn,$query_sensor);
                    $pocetriadkov_sensor = mysqli_num_rows($result_sensor);

                    while ($row_sensor = mysqli_fetch_assoc($result_sensor))
                    {
                    ?>
                        <tr>
                            <td><?php echo $row_sensor["sensor_id"];?></td>
                            <td><?php echo $row_sensor["pouzitie_senzoru"];?></td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>

        </div>
    </div>
</div>

<?php                       
    include "confs/footer.php";
?>