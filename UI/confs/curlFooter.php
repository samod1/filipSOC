<?php
$conn = "";
include "DB.php";

$query = "SELECT token FROM tbl_settings";
$result = mysqli_query($conn,$query);

$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

//last commit

$curl = curl_init();
$headers = ["Accept: application/vnd.github+json",
"Authorization: Bearer ".$row['token'],
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
$commitUrl = $decodeJson["html_url"];

echo "<b>Posledny commit: </b><a href='$commitUrl'>".$shortID."</a>"; 

curl_close($curl);



//license

$curlLicense = curl_init();
$headersLicense = ["Accept: application/vnd.github+json",
"Authorization: Bearer ".$row['token'],
"X-GitHub-Api-Version: 2022-11-28"];

curl_setopt_array($curlLicense,[
CURLOPT_RETURNTRANSFER => 1,
CURLOPT_URL => 'https://api.github.com/repos/samod1/filipSOC/license',
CURLOPT_USERAGENT=> "Github license in CURL",
CURLOPT_HTTPHEADER => $headers
]);

$LicenseResponse = curl_exec($curlLicense);
$LicenseResponseDecode = json_decode($LicenseResponse,true);

$licenseUrl=$LicenseResponseDecode["_links"]["html"];

echo "<br><b>Licencia repozitaru: </b> <a href='$licenseUrl'>".$LicenseResponseDecode["license"]["name"]."</a>";
curl_close($curlLicense);


//release

$curlRelease = curl_init();
$headersRelease = ["Accept: application/vnd.github+json",
"Authorization: Bearer ".$row['token'],
"X-GitHub-Api-Version: 2022-11-28"];

curl_setopt_array($curlRelease,[
CURLOPT_RETURNTRANSFER => 1,
CURLOPT_URL => 'https://api.github.com/repos/samod1/filipSOC/releases',
CURLOPT_USERAGENT=> "Github releases in CURL",
CURLOPT_HTTPHEADER => $headers
]);

$curlReleaseResponse = curl_exec($curlRelease);
$curlReleaseDecode = json_decode($curlReleaseResponse, true);

$releaseUrl = $curlReleaseDecode["0"]["html_url"];

echo "<br><b>Posledna produkcna verzia: </b> <a href='$releaseUrl'>" . $curlReleaseDecode["0"]["tag_name"]."</a>";

curl_close($curlRelease);



//collaborators

$curlCollaborators = curl_init();
$headersCollaborators = ["Accept: application/vnd.github+json",
"Authorization: Bearer ".$row['token'],
"X-GitHub-Api-Version: 2022-11-28"];

curl_setopt_array($curlCollaborators,[
CURLOPT_RETURNTRANSFER => 1,
CURLOPT_URL => 'https://api.github.com/repos/samod1/filipSOC/collaborators',
CURLOPT_USERAGENT=> "Github collaborators in CURL",
CURLOPT_HTTPHEADER => $headers
]);

$curlCollaboratorsResponse = curl_exec($curlCollaborators);
$curlCollaboratorsDecode = json_decode($curlCollaboratorsResponse, true);

$collaboratorsName = $curlCollaboratorsDecode["0"]["login"];
$collaboratorsName1 = $curlCollaboratorsDecode["1"]["login"];

$collaboratorsUrl = $curlCollaboratorsDecode["0"]["html_url"];
$collaboratorsUrl1 = $curlCollaboratorsDecode["1"]["html_url"];

echo "<br><b>Vyvojari: </b> <a href='$collaboratorsUrl1'>". $collaboratorsName1 . "</a> ,  <a href='$collaboratorsUrl'>". $collaboratorsName;


curl_close($curlRelease);


?>