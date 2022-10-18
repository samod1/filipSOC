<div class="container-fluid">
    <div class="jumbotron jumbotron-fluid">
      <div class="container">
        <h1 class="display-4 text-center">Meteorologická stanica</h1>
        <p class="lead text-center">Zariadenie na zber meteorologických údajov</p>
      </div>
    </div>
    <div class="text-center h5" id = "jsclock" onload="hodiny()"></div>
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item <?php if($stranka == "index") {echo' active';} ?>">
              <a class="nav-link" href="index.php">Domov<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item <?php if($stranka == 3) {echo' active';} ?>">
              <a class="nav-link" href="grafy.php">Grafy</a>
            </li>
            <li class="nav-item <?php if($stranka == "udaje") {echo' active';} ?>">
              <a class="nav-link" href="udaje.php">Udaje</a>
            </li>
            <!-- <li class="nav-item <?php if($stranka == 4) {echo' active';}?>">
              <a class="nav-link" href="#"><i class="fa fa-cog" aria-hidden="true"></i></a>
            </li> -->
          </ul>
        </div>
      </nav>
</div>
<br>



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