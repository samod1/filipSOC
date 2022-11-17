<?php

    $conn = "";
    $nazovTabu ="Filip Stredoskolska praca";
    $stranka = "nastavenia";
    include "confs/head.php";
?>


<div class="container-fluid">
    <div class="row"> 
        <div class="col-sm">  
            <h1 class="display-4">Nastavenia</h1>
            <br>
            
            <div class="input-group mb-3">
                <!--Jednotky-->
                <h4 class="display-5 mb-0">Jednotky: &nbsp;</h3>
                <select class="form-select" aria-label="Jednotky">
                    <option selected value="1">Metricke</option>
                    <option value="2">Imperiálne</option>
                </select>
            </div>

            <div class="input-group mb-3">
                <!--Formát času-->
                <h4 class="display-5">Časový formát: &nbsp;</h3>
                <div class="form-check mt-1">
                    <input class="form-check-input" type="radio" name="hod_format" id="24" checked>
                    <label class="form-check-label" for="24">
                    24H &nbsp;
                    </label>
                </div>
                <div class="form-check mt-1">
                    <input class="form-check-input" type="radio" name="hod_format" id="12">
                    <label class="form-check-label" for="12">
                        12H &nbsp;
                    </label>
                </div>
                <br>
            </div>    

            <!--Miesto merania-->
            <h4 class="display-5 mb-0">Miesto merania:<br></h3>
            <div class="input-group mb-3">
                <h5 class="display-5 mb-0">Okres: &nbsp;</h5>
                <select class="form-select" name="okres" id="okres" aria-label="Okres" onchange="okres_id()" required>
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
                <h5 class="display-5 mb-0">Obec: &nbsp;</h5>
                <select class="form-select" name="obec" id="obec" aria-label="Obec" required></select>
                    <option ></option>
            </div> 

            <!--Save-->    
            <button type="button" class="btn btn-primary p-3">Save</button>
          
        </div>

        <!--Senzory-->
        <div class="col-sm">
            <h1 class="display-4">Senzory</h1>
            
            <!--ADD Senzor-->
            <button type="button" class="btn btn-primary p-3 pull-right mb-3" data-toggle="modal" data-target="#ADD_sensor">Pridat</button>
            
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
                        <form method="post">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Názov senzoru</span>
                                </div>
                                <input type="text" name="id_sensor" id="id_sensor" class="form-control" aria-describedby="id_sensor">
                            </div>

                            <!--Vyuzitie-->
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Vyuzitie</span>
                                </div>
                                <input type="text" name="function" id="function" class="form-control" aria-describedby="function_sensor">
                                <br>
                                <input type="submit" name="poslat" id="poslat" class="btn btn-primary" value="Odoslať">

                            </div>
                            <?php
                            
                                if(isset($_POST["poslat"]))
                                    {
                                        $id = 0;
                                        $query_send = "INSERT INTO tbl_sensors (id,sensor_id,pouzitie_senzoru) VALUES (?,?,?);";
                                        $stmt = mysqli_stmt_init($conn);
                                        mysqli_stmt_prepare($stmt,$query_send);
                                        mysqli_stmt_bind_param($stmt,'iss', $id, $_POST["id_sensor"], $_POST["function"]);
                                        mysqli_stmt_execute($stmt);
                                        mysqli_stmt_close($stmt);
                                    }  
                            ?>

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