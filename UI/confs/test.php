
<?php
    if($_GET["rola"] == "admin")
    {
        //zobrazit dve tlacitka
        ?>
        <input type="submit">
        <input type="reset">
        <?php
    }

    else
    {
        echo "na vykonanie tychto akcii nemate dostatocne opravnenia";
    }
?>