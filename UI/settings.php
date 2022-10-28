<?php

    $conn = "";
    $nazovTabu ="Filip Stredoskolska praca";
    $stranka = "nastavenia";
    include "confs/head.php";

    $prsi = true;

?>


<div class="container-fluid">
    <h1 class="display-4">Nastavenia</h1>
    <br>

    <!--Jednotky-->
    <div class="row ml-1">
        <h4 class="display-5 mb-0">Jednotky: &nbsp;</h3>
        <select class="form-select" aria-label="Jednotky">
            <option selected value="1">Metricke</option>
            <option value="2">Imperiálne</option>
        </select>
    </div>

    <!--Formát času-->
    <div class="row ml-1 mt-4">
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
    </div>

    <!--Miesto merania-->
    <div class="row ml-1 mt-3">
        <h4 class="display-5 mb-0">Miesto merania: &nbsp;</h3>
        <select class="form-select" aria-label="Jednotky">
            <?php
            $query_obce = "SELECT kód,názov FROM filip_soc.enum_okres";
            $result_obce = mysqli_query($conn,$query_obce);
            $pocetriadkov_obce = mysqli_num_rows($result_obce);
            if(!$result_obce)
            {
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                <strong>ERR:</strong> Prikaz SQL sa neda vykonat ".$query_obce."
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
                </button>
            </div>";
            }
            
            else
            {
                if ($pocetriadkov_obce == 0)
                {
                echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>Holy guacamole!</strong> You should check in on some of those fields below.
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
                </div>";
                }
            }
            
            while ($row_obce = mysqli_fetch_assoc($result_obce))
            { 
            ?>
                <!--vytvaranie moznosti-->
                <option value="<?php echo $row_obce["kód"];?>"> <?php echo $row_obce["názov"];?> </option>
            <?php } ?>
        </select>
    </div>

    <!--Save-->
    <div class="row ml-1 mt-5">
        <button type="button" class="btn btn-primary p-3">Save</button>
    </div>
    
</div>

<?php
    include "confs/footer.php";
?>