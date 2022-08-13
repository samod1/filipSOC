<footer>
    <div class="container-fluid bg-dark" style="position:fixed; bottom:0%;">
    <button type="button" class="btn btn-link" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-info"></i></button>
    </div>
</footer>
</body>
</html>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Informácie o projekte</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p><b>Verzia: </b> 1.0.0 </b>
        <p><b>posledny commit:</b> <?exec('git rev-parse --verify HEAD 2> /dev/null', $output);
                                      $hash = $output[0];?></p>
      </div>
      <div class="modal-footer">
        <button type="button" class=" btn btn-lg btn-block btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
