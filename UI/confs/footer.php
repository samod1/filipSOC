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

        <p><b>Verzia: </b> 0.9.4</b>
        <p><b>Vývojár: </b>Filip Majchrák, Samuel Domin</b> 
        <p><b>posledny commit: </b><?php
        
        $curl = curl_init();
        $headers = ["Accept: application/vnd.github+json",
"Authorization: Bearer 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",
"X-GitHub-Api-Version: 2022-11-28"];

$queryParams = "per_page=1";

curl_setopt_array($curl,[
  CURLOPT_RETURNTRANSFER => 1,
  CURLOPT_URL => 'https://api.github.com/repos/samod1/filipSOC/commits/main',
  CURLOPT_USERAGENT=> "Github API in CURL",
  CURLOPT_HTTPHEADER => $headers
  
  
]);

$response = curl_exec($curl);

$decodeJson= json_decode($response,true);

//var_dump(json_decode($response));
//echo $decodeJson["sha"];
$shortID = mb_substr($decodeJson["sha"],0,7);
echo $shortID; 
curl_close($curl);
?>

        
      </div>
      <div class="modal-footer">
        <button type="button" class=" btn btn-lg btn-block btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
