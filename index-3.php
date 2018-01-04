<?php
$name=stripslashes($_POST["name"]);
$email=stripslashes($_POST["email"]);
$lastName=stripslashes($_POST["lastName"]);
$company=stripslashes($_POST["company"]);
$phone=stripslashes($_POST["phone"]);
$piecesNumber=stripslashes($_POST["piecesNumber"]);
$weight=stripslashes($_POST["weight"]);
$weightType=stripslashes($_POST["weightType"]);
$cbm=stripslashes($_POST["cbm"]);
$cbmType=stripslashes($_POST["cbmType"]);
$origin=stripslashes($_POST["origin"]);
$destinationPort=stripslashes($_POST["destinationPort"]);
$originType=stripslashes($_POST["originType"]);
$measures=stripslashes($_POST["measures"]);
$description=stripslashes($_POST["description"]);
$secret="6LectD0UAAAAACCPJ3mg-wEcfU-0-Y0ATTmZkp4P";
$response=$_POST["captcha"];

error_log($response, 4); // This is not an error, I used it just to print in the console

$verify=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secret}&response={$response}");
$captcha_success=json_decode($verify);
if ($captcha_success->success==false) {
  error_log('This user was not verified by recaptcha', 4);  // This is not an error, I used it just to print in the console

  // I don't know if this is the best way to return an error in PHP but it works
  // You can use here a 404 response error
  header('HTTP/1.1 500 Internal Server Error');
  header('Content-Type: application/json; charset=UTF-8');
  die(json_encode(array('message' => 'Captcha has expired or it is invalid', 'code' => 1337)));

} else if ($captcha_success->success==true) {
  error_log('This user is verified by recaptcha', 4);  // This is not an error, I used it just to print in the console
  // Here you can send emails, save to the DB or whatever is needed, the form is validated

  $retorna=$Corre->formLCLOcean($name,
                                $lastName,
                                $company,
                                $email,
                                $phone,
                                $piecesNumber,
                                $weight.$weightType,
                                $cbm.$cbmType,
                                $dimension,
                                $originType." | "."from". $origin." to ".$destinationPort,
                                $measures,
                                $description)

  if($retorna){
    $banMS=true;
  }
}
?>
