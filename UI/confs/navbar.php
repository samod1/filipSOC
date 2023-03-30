<div class="container-fluid">
    <div class="jumbotron jumbotron-fluid">
      <div class="container">
        <h1 class="display-4 text-center">Meteorologická stanica</h1>
        <p class="lead text-center">Zariadenie na zber meteorologických údajov</p>
      </div>
    </div>

      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item <?php if($stranka == "index") {echo' active';} ?>">
              <a class="nav-link" href="index.php">Domov<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item <?php if($stranka == "grafy") {echo' active';} ?>">
              <a class="nav-link" href="https://samkodomin.grafana.net/d/c2IMPBpVk/soc-dashboard?orgId=1" target="_blank">Grafy</a>
            </li>
            <li class="nav-item <?php if($stranka == "udaje") {echo' active';} ?>">
              <a class="nav-link" href="udaje.php">Udaje</a>
            </li>
            <li class="nav-item mt-1 <?php if($stranka == "nastavenia") {echo' active';}?>">
              <a class="nav-link" href="settings.php"><i class="fa fa-cog" aria-hidden="true"></i></a>
            </li>
          </ul>
          <div class="text-white text-right font-weight-bold mr-2" id = "jsclock" onload="hodiny()"></div>
          <div class="text-white text-right font-weight-bold" id = "day_year" onload="hodiny()"></div>
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

  var options ={
    weekday:"short",
    year:"numeric",
    month:"long",
    day:"numeric"
  }; 

  document.getElementById("jsclock").innerText = time; 
  document.getElementById('day_year').innerHTML = date.toLocaleDateString("sk-SK", options);

  let t = setTimeout(function(){ hodiny() }, 1000);
}
hodiny();
</script>