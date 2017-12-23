<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);
$banMS=false;
if (filter_input(INPUT_POST, "g-recaptcha-response")!='') {
    //var_dump($_POST);

    //require 'bat\MailHandler.php';
    include 'bat/MailHandler.php';
    $Corre=new CorreoEnvi;
    $name = stripslashes($_POST["name"]);
    $name2 = stripslashes($_POST["name2"]);
    $Company = stripslashes($_POST["Company"]);
    $email = stripslashes($_POST["email"]);
    $phone = stripslashes($_POST["phone"]);
    $numbers = stripslashes($_POST["numbers"]);
    //pounds
    $name11 = stripslashes($_POST["name11"]);
    $name12 = stripslashes($_POST["name12"]);
    $name13 = stripslashes($_POST["name13"]);
    // CMB
    $option2 = stripslashes($_POST["option2"]);
    $name15 = stripslashes($_POST["name15"]);
    $name16 = stripslashes($_POST["name16"]);
    //door
    $option1 = stripslashes($_POST["option1"]);
    $origin = stripslashes($_POST["origin"]);
    $destination = stripslashes($_POST["destination"]);
    $origin_port = stripslashes($_POST["origin_port"]);
    $destination_port = stripslashes($_POST["destination_port"]);
    //Dimesion
    $numbers3 = stripslashes($_POST["numbers3"]);
    $numbers4 = stripslashes($_POST["numbers4"]);
    $numbers5 = stripslashes($_POST["numbers5"]);
    //Description
    $message1 = stripslashes($_POST["message1"]);

    $response = $_POST["g-recaptcha-response"];
    $secret='6LectD0UAAAAACCPJ3mg-wEcfU-0-Y0ATTmZkp4P';
   $urlll="https://www.google.com/recaptcha/api/siteverify?secret={$secret}&response={$response}";
    $c = curl_init($urlll);
    curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
    $verify2 = curl_exec($c);
    curl_close($c);


    $captcha_success = json_decode($verify2);
    if ($captcha_success->success == false) {
        //echo "<p>You are a bot! Go away!</p>";
        //var_dump($_POST);
    } else if ($captcha_success->success == true) {
       // echo "<p>You are not not a bot!</p>";
        //var_dump($_POST);
        $retorna=$Corre->formLCLOcean($name,$name2,$Company,$email,$phone,$numbers,$name11,$name12,$name13,$option2,$name15,$name16,$numbers3,$numbers4,$numbers5,$message1);
        if($retorna){
            $banMS=true;
        }
    }
    $_POST = array();

}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>LCL Ocean Rates </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon"/>

    <meta name="description"
          content="Intermodal Shipping is a world leader in global logistics for all size companies, offers premium logistics services to global businesses in need of unsurpassed knowledge and expertise.">
    <meta name="keywords"
          content="Export, Import, Amazon FBA, Quotes, Cargo Insurance, Logistica, International, Advice   ">
    <meta name="author" content="Intermodal Shipping">

    <meta name="format-detection" content="telephone=no"/>
    <!--CSS-->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/contact-form.css">
    <link rel="stylesheet" href="css/stuck.css">
    <link rel="stylesheet" href="fonts/font-awesome.css">
    <!--JS-->
    <script src="js/jquery.js"></script>
    <script src="js/jquery-migrate-1.2.1.min.js"></script>
    <script src="js/superfish.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
    <script src="js/jquery.mobilemenu.js"></script>
    <script src="js/jquery.equalheights.js"></script>
    <!-- <script src="js/TMForm.js"></script> -->
    <script src="js/modal.js"></script>
    <script src="js/bootstrap-filestyle.js"></script>
    <script src="js/jquery.ui.totop.js"></script>
    <script src="js/tmstickup.js"></script>
    <!--[if lt IE 9]>
    <div style='text-align:center' class="qwerty"><a
            href="http://windows.microsoft.com/en-US/internet-explorer/products/ie/home?ocid=ie6_countdown_bannercode"><img
            src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0"
            height="42" width="820"
            alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today."/></a>
    </div>
    <![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <link rel="stylesheet" href="css/ie.css">
    <![endif]-->


    <script src="https://www.google.com/recaptcha/api.js" async defer></script>



<script type="text/javascript">

   // $("#select").attr('required', 'required');




    function mostrar(id) {
        if (id == "door") {
            $("#origin_port").prop('required', false);
            $("#destination_port").prop('required', false);
            $("#origin_port").val("");
            $("#destination_port").val("");
            $("#origin").prop('required', true);
            $("#destination").prop('required', true);
            $("#door").show();
            $("#port").hide();
            $(".door").attr('class', 'show door');
            $(".port").attr('class', 'hide port');
        }

        if (id == "port") {
            $("#origin_port").prop('required', true);
            $("#destination_port").prop('required', true);
            $("#origin").val("");
            $("#destination").val("");
            $("#origin").prop('required', false);
            $("#destination").prop('required', false);
            $("#door").hide();
            $("#port").show();
            $(".port").attr('class', 'show port');
            $(".door").attr('class', 'hide door');
        }

        if (id == "pound") {
            $("#name12").prop('required', true);
            $("#name13").prop('required', false);
            $("#name13").val("");
            $("#pound").show();
            $("#kilos").hide();
            $(".pound").attr('class', 'show pound');
            $(".kilos").attr('class', 'hide kilos');
        }

        if (id == "kilos") {
            $("#Pound").hide();
            $("#name12").prop('required', false);
            $("#name13").prop('required', true);
            $("#name12").val("");
            $("#kilos").show();
            $(".kilos").attr('class', 'show kilos');
            $(".pound").attr('class', 'hide pound');
        }

        if (id == "cbm") {
            $("#name16").prop('required', false);
            $("#name15").prop('required', true);
            $("#name16").val("");
            $("#cbm").show();
            $("#cbf").hide();
            $(".cbm").attr('class', 'show cbm');
            $(".cbf").attr('class', 'hide cbf');

        }

        if (id == "cbf") {
            $("#name15").prop('required', false);
            $("#name16").prop('required', true);
            $("#name15").val("");
            $("#cbm").hide();
            $("#cbf").show();
            $(".cbf").attr('class', 'show cbf');
            $(".cbm").attr('class', 'hide cbm');
        }
    };


</script>

</head>
<body onload="window.onload = null;">
<!--header-->
<?php
if($banMS){
echo "<script src='js/sweetalert.min.js'></script>";
    echo "<script>swal({
  title: \"Good job!\",
  text: \"You clicked the button!\",
  icon: \"success\",
  button: \"Aww yiss!\",
});</script>";
}

?>
<header id="stuck_container">
    <div class="container">
        <h1 class="navbar-brand navbar-brand_"><a href="index.html"><img src="img/logo.png" alt="logo"></a></h1>
        <nav class="navbar navbar-default navbar-static-top tm_navbar clearfix" role="navigation">
            <ul class="nav sf-menu clearfix">

                <li><a href="index-1.html">About Us</a></li>
                <li class="sub-menu"><a href="#">Services</a><span></span>
                    <ul class="submenu">
                        <li><a href="index-5.html">Export</a></li>
                        <li><a href="index-6.html">Import</a></li>
                    </ul>
                </li>
                <li><a href="index-2.html">Amazon FBA</a></li>
                <!--  <li><a href="index-3.html">Quotes</a></li> -->
                <li class="sub-menu"><a href="#">Quotes</a><span></span>
                    <ul class="submenu">
                        <li><a href="index-3.html" style="padding: 8px;">LCL Ocean Rates</a></li>
                        <li><a href="index-7.html" style="padding: 8px;">FCL Ocean Rates</a></li>
                        <li><a href="index-8.html" style="padding: 8px;">LCL Trucking Rates</a></li>
                        <li><a href="index-9.html" style="padding: 8px;">Import Port to US Port Rates</a></li>
                        <li><a href="index-10.html" style="padding: 8px;">Import Port to US Door Rates</a></li>
                        <li><a href="index-11.html" style="padding: 8px;">Air Export Rates</a></li>
                        <li><a href="index-12.html" style="padding: 8px;">Cargo Insurance</a></li>
                    </ul>
                </li>
                <li><a href="index-4.html">Contact</a></li>
            </ul>
        </nav>
    </div>
</header>
<!--content-->
<div class="global indent">

    <div class="formBox">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <h2>LCL Ocean Rates <strong><span></span></strong></h2>
                    <P>Door to Port (ORIGIN ZIP CODE), Port to port (PCS, WEIGHT LBS OR KGS, CBM OR CBF)</P>
                    <form method="post" id="contact-form" action="index-3.1.php" enctype="multipart/form-data">
                        <div class="contact-form-loader"></div>
                        <fieldset>
                            <label class="name form-div-1">
                                <input type="text" name="name" placeholder="Name*" value="" required/>

                            </label>
                            <label class="name form-div-2">
                                <input type="text" name="name2" placeholder="Last name" value=""/>

                            </label>
                            <label class="name form-div-3">
                                <input type="text" name="Company" placeholder="Company" value=""/>

                            </label>
                            <label class="email form-div-1">
                                <input type="text" name="email" placeholder="E-mail*" required/>
                            </label>
                            <label class="phone form-div-2">
                                <input type="text" name="phone" placeholder="Phone" value=""/>
                            </label>
                            <label class="name form-div-3">
                                <input type="text" name="numbers" placeholder="Number of Pieces*" pattern="[1-99]+" required/>
                            </label>
                            <!--Pounds or Kilos  -->
                            <label><p>Pounds or Kilos </p></label>
                            <label class="name form-div-1">
                                <select type="select" id="name11" name="name11" onchange="mostrar(this.value)" style="border: 1px solid #d4d4d4;font: 300 13px/39px 'Open Sans';padding: 10px;width: 250px;" required>
                                    <option value="">Selection*</option>
                                    <option value="pound">Pounds</option>
                                    <option value="kilos">Kilos</option>
                                </select>
                            </label>
                            <label class="name form-div-2">
                                <div class="hide pound">
                                    <label class="name form-div-2">
                                        <input type="text" name="name12" id="name12" placeholder="Quantity Pound" type="hidden"/>
                                    </label>
                                </div>
                            </label>

                            <label class="name form-div-2">
                                <div class="hide kilos">
                                    <label id="kilos" class="elemento" style="margin-top: -10px;">
                                        <label class="name form-div-2">
                                            <input type="text" name="name13" id="name13" placeholder="Quantity Kilos" />
                                        </label>
                                    </label>
                                </div>
                            </label>

                            <label><p>CMB or CBF </p></label>
                            <label class="name form-div-1">
                                <select type="select" name="option2" onchange="mostrar(this.value)" style="border: 1px solid #d4d4d4;font: 300 13px/39px 'Open Sans';padding: 10px;width: 250px;" required>
                                    <option value="">Selection*</option>
                                    <option value="cbm">CBM</option>
                                    <option value="cbf">CBF</option>
                                </select>
                            </label>
                            <label class="name form-div-2">
                                <div class="hide cbm">
                                    <label id="cbm" class="elemento">
                                        <label class="name form-div-2">
                                            <input type="text" id="name15" name="name15" placeholder="Quantity CBM" type="hidden"/>
                                        </label>
                                    </label>
                                </div>
                            </label>
                            <label class="name form-div-2">
                                <div class="hide cbf">
                                    <label id="cbf" class="elemento" style="margin-top: -10px;">
                                        <label class="name form-div-2">
                                            <input type="text" id="name16" name="name16" placeholder="Quantity CBF" type="hidden"/>
                                        </label>
                                    </label>
                                </div>
                            </label>

                            <label><p>Door to Port / Port to Port </p></label>
                            <label class="name form-div-2">
                                <select type="select" id="select" name="option1" onchange="mostrar(this.value)" style="border: 1px solid #d4d4d4;font: 300 13px/39px 'Open Sans';padding: 10px;width: 250px;" required>
                                    <option value="">Selection</option>
                                    <option value="door">Door to Port</option>
                                    <option value="port">Port to Port</option>
                                </select>
                            </label>
                            <label class="name form-div-2">
                                <div class="hide door">
                                    <label id="Door" class="elemento">
                                        <label class="name form-div-2">
                                            <input type="text" id="origin" name="origin" placeholder="Origin/Us zip Code" type="hidden"/>
                                        </label>
                                    </label>
                                </div>
                            </label>
                            <label class="name form-div-3">
                                <div class="hide door">
                                    <label class="name form-div-3">
                                        <input type="text" id="destination" name="destination" placeholder="Name Destination Port" type="hidden"/>
                                    </label>
                                </div>
                            </label>
                            <label class="name form-div-2">
                                <div class="hide port">
                                    <label id="Port2" class="elemento" style="margin-top: -10px;">
                                        <label class="name form-div-2">
                                            <input type="text" id="origin_port" name="origin_port" placeholder="Origin Port" type="hidden"/>
                                        </label>
                                    </label>
                                </div>
                            </label>
                            <label class="name form-div-3">
                                <div class="hide port">
                                    <label id="Port" class="elemento" style="margin-top: -10px;">
                                        <label class="name form-div-3">
                                            <input type="text" id="destination_port" name="destination_port" placeholder="Destination Port" type="hidden"/>
                                        </label>
                                    </label>
                                </div>
                            </label>
                            <label><p>Dimesion</p></label>
                            <label class="name form-div-2" style="width: 75px;">
                                <input type="text" name="numbers3" placeholder="L" value=""/>
                            </label>
                            <label class="numbers form-div-2" style="width: 75px;">
                                <input type="text" name="numbers4" placeholder="W" value=""/>
                            </label>
                            <label class="numbers form-div-3" style="width: 75px;">
                                <input type="text" name="numbers5" placeholder="H" value=""/>
                            </label>
                            <label class="message form-div-7">
                                <textarea name="message1" placeholder="Description*" required></textarea>
                            </label>
                            <div>
                                <div class="g-recaptcha" data-sitekey="6LectD0UAAAAAL_SLUbtH7F4nelM7vhJ4s0YZ8a2"  data-callback="enableBtn"></div>
                                <input type="submit" value="Submit?" id="btnSub" disabled class="btn-default btn1 form-btns" />



                                <!-- <a href="#" data-type="submit" class="btn-default btn1 form-btns">submit</a> -->
                                <p>*Required Fields</p>
                            </div>
                        </fieldset>
                    </form>

                    <br>

                </div>
            </div>
        </div>
    </div>
</div>
<!--footer-->
<footer>
    <div class="container">
        <p style="text-transform: capitalize;">Intermodal Shipping &copy; <em
                    id="copyright-year"></em><span> | </span><br><a href="http://ajcreativestudios.com/">AJ Creative
                Studios</a> | <br><a href="http://www.discoveringnewyorkcity.com/">Discovering New York City</a></p>
        <ul class="follow_icon">
            <li><a href="https://www.linkedin.com/company/intermodal-shipping"><img src="img/follow_icon6.png" alt=""></a></li>


        </ul>
    </div>
</footer>
<script>
    function enableBtn(){
        document.getElementById("btnSub").disabled = false;
    }

</script>
<script src="js/bootstrap.min.js"></script>
<script src="js/tm-scripts.js"></script>
</body>
</html>