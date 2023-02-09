<footer class="bg-dark text-center text-lg-start mt-5">
    <button type="button" class="btn btn-link" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-info"></i></button>
    <p class="text-center text-white mb-0"></p>
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
          <?php include "curlFooter.php"?>        
      </div>
      <div class="modal-footer">
        <button type="button" class=" btn btn-lg btn-block btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
