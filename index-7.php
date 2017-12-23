<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
$banMS = false;
if (filter_input(INPUT_POST, "g-recaptcha-response") != '') {
    //var_dump($_POST);

    //require 'bat\MailHandler.php';
    include 'bat/MailHandler.php';
    $Corre = new CorreoEnvi;
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
    $secret = '6LectD0UAAAAACCPJ3mg-wEcfU-0-Y0ATTmZkp4P';
    $urlll = "https://www.google.com/recaptcha/api/siteverify?secret={$secret}&response={$response}";
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
        $retorna = $Corre->formLCLOcean($name, $name2, $Company, $email, $phone, $numbers, $name11, $name12, $name13, $option2, $name15, $name16, $numbers3, $numbers4, $numbers5, $message1);
        if ($retorna) {
            $banMS = true;
        }
    }
    $_POST = array();

}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Export - FCL Ocean Rates </title>
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
    <script src="js/TMForm.js?v=1.0"></script>
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
</head>

<script src='https://www.google.com/recaptcha/api.js'></script>

<script type="text/javascript">

    $("#select").attr('required', 'required');

    $(document).ready(function () {
        delete_validation_list = []
    });

    function mostrar(id) {
        if (id == "Door") {

            var index = delete_validation_list.indexOf("originZipText");
            if (index > -1) {
                delete_validation_list.splice(index, 1);
            }
            var index = delete_validation_list.indexOf("destinationText");
            if (index > -1) {
                delete_validation_list.splice(index, 1);
            }

            delete_validation_list.push("originationPortText")
            delete_validation_list.push("destinationPortText")

            $("#Door").show();
            $("#Port").hide();
            $(".door").attr('class', 'show door');
            $(".port").attr('class', 'hide port');

        }
        if (id == "Port") {

            var index = delete_validation_list.indexOf("originationPortText");
            if (index > -1) {
                delete_validation_list.splice(index, 1);
            }
            var index = delete_validation_list.indexOf("destinationPortText");
            if (index > -1) {
                delete_validation_list.splice(index, 1);
            }

            delete_validation_list.push("originZipText")
            delete_validation_list.push("destinationText")

            $("#Door").hide();
            $("#Port").show();
            $(".port").attr('class', 'show port');
            $(".door").attr('class', 'hide door');
        }

        if (id == "Pound") {

            var index = delete_validation_list.indexOf("quantitypound");
            if (index > -1) {
                delete_validation_list.splice(index, 1);
            }
            delete_validation_list.push("quantitykilos")
            $("#Pound").show();

            $("#KILOS").hide();

            $(".pound").attr('class', 'show pound');
            $(".kilos").attr('class', 'hide kilos');
        }

        if (id == "KILOS") {
            var index = delete_validation_list.indexOf("quantitykilos");
            if (index > -1) {
                delete_validation_list.splice(index, 1);
            }
            delete_validation_list.push("quantitypound")
            $("#Pound").hide();
            $("#KILOS").show();
            $(".kilos").attr('class', 'show kilos');
            $(".pound").attr('class', 'hide pound');
        }
    };


</script>

<body>
<!--header-->
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
                    <h2>Export - FCL Ocean Rates <strong><span></span></strong></h2>
                    <P>Door to Port (ORIGIN ZIP CODE), port to port</P>
                    <form id="contact-form">
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
                                <input type="text" name="email" placeholder="E-mail*" value="" required/>
                            </label>
                            <label class="phone form-div-2">
                                <input type="text" name="phone" placeholder="Phone" value=""/>
                            </label>
                            <label><p>Pounds or Kilos </p></label>
                            <label class="name form-div-2">
                                <select type="select" id="select" name="name11" style="border: 1px solid #d4d4d4;font: 300 13px/39px 'Open Sans';padding: 10px;width: 250px;" required>
                                    <option value="">Selection*</option>
                                    <option value="Pound">Pounds</option>
                                    <option value="KILOS">Kilos</option>
                                </select>
                            </label>
                                <label class="name form-div-2">
                                    <input type="text" name="name12" id="quantity" placeholder="Quantity" value="" />
                            </label>

                            <label><p>Container Type:</p></label>
                            <label class="name form-div-1">
                                <input type="checkbox" name="container" value="20"/>20´Container
                            </label>
                            <label class="name form-div-1">
                                <input type="checkbox" name="container" value="40"/>40´Container
                            </label>
                            <label class="name form-div-1">
                                <input type="checkbox" name="container" value="40e"/>40´Reefer´
                            </label>

                                <!--<select name="container" size="3" style="border: 1px solid #d4d4d4;font: 300 13px/39px 'Open Sans';padding: 10px;width: 250px;" multiple>
                                    <option value="20´Container" selected>20´ Container</option>
                                    <option value="40´Container">40´ Container</option>
                                    <option value="40´Reefer´">40´ Reefer</option>
                                </select>-->



                            <label><p>Door to Port / Port to Port </p></label>
                            <label class="name form-div-2">
                                <select type="select" id="select" name="option1" data-constraints="@Required"
                                        onchange="mostrar(this.value)"
                                        style="border: 1px solid #d4d4d4;font: 300 13px/39px 'Open Sans';padding: 10px;width: 250px;">
                                    <option value="">Selection</option>
                                    <option value="Door">Door to Port</option>
                                    <option value="Port">Port to Port</option>
                                </select>
                                <span class="empty-message">*This field is required.</span>
                                <span class="error-message">*This is not a valid select.</span>
                            </label>

                            <label class="name form-div-2">
                                <div class="hide door">
                                    <label id="Door" class="elemento">
                                        <!--  <label> <p>Origin:</p> </label> -->
                                        <label class="name form-div-2">
                                            <input type="text" name="origin" placeholder="Origin/Us zip Code" value=""
                                                   type="hidden" id="originZipText"
                                                   data-constraints="@Required @Integer"/>
                                            <span class="empty-message">*This field is required.</span>
                                            <span class="error-message">*This is not a valid entry.</span>
                                        </label>
                                    </label>
                                </div>
                            </label>
                            <label class="name form-div-3">
                                <div class="hide door">
                                    <label class="name form-div-3">
                                        <input type="text" name="destination" placeholder="Name Destination Port"
                                               value="" data-constraints="@Required @Length(min=0,max=999999)"
                                               id="destinationText"/>
                                        <!--data-constraints='@Required @Length(min=0,max=999999)'-->
                                        <span class="empty-message">*This field is required.</span>
                                        <span class="error-message">*This is not a valid entry.</span>

                                    </label>
                                </div>
                            </label>
                            <label class="name form-div-2">
                                <div class="hide port">
                                    <label id="Port" class="elemento" style="margin-top: -10px;">
                                        <label class="name form-div-2">
                                            <input type="text" name="origin_port" placeholder="Origin Port" value=""
                                                   data-constraints="@Required @Length(min=0,max=999999)"
                                                   id="originationPortText"/>
                                            <!-- data-constraints="@Required @JustLetters"  -->
                                            <span class="empty-message">*This field is required.</span>
                                            <span class="error-message">*This is not a valid entry.</span>
                                        </label>
                                    </label>
                                </div>
                            </label>

                            <label class="name form-div-3">
                                <div class="hide port">
                                    <label id="Port" class="elemento" style="margin-top: -10px;">
                                        <label class="name form-div-3">
                                            <label class="name form-div-3">
                                                <input type="text" name="destination_port"
                                                       placeholder="Destination Port" value=""
                                                       data-constraints="@Required @Length(min=0,max=999999)"
                                                       id="destinationPortText"/>
                                                <!-- data-constraints="@Required @JustLetters" -->
                                                <span class="empty-message">*This field is required.</span>
                                                <span class="error-message">*This is not a valid entry.</span>
                                            </label>
                                        </label>
                                </div>
                            </label>


                            <label class="message form-div-7">
                                <textarea name="message2" placeholder="Description*"
                                          data-constraints='@Required @Length(min=1,max=999999)'></textarea>
                                <span class="empty-message">*This field is required.</span>
                                <span class="error-message">*The message is too short.</span>
                            </label>
                            <!-- <label class="recaptcha"><span class="empty-message">*This field is required.</span></label> -->


                            <label required>Click the box Below for security purposes. Then Click *<p></p>
                                <div class="g-recaptcha" data-sitekey="6LdAbC8UAAAAAOOox0TxIef_Twan0b8zLD5cJVPC"
                                     required></div>
                            </label>
                            <br>


                            <div>
                                <a href="#" data-type="submit" class="btn-default btn1 form-btns">submit</a>
                                <p>*Required Fields</p>
                            </div>
                        </fieldset>
                        <div class="modal fade response-message">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                            &times;
                                        </button>
                                        <h4 class="modal-title">Modal title</h4>
                                    </div>
                                    <div class="modal-body">
                                        You message has been sent! We will be in touch soon.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
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
                Studios</a> | <br><a href="http://www.discoveringnewyorkcity.com/">Discovering New York City</p>
        <ul class="follow_icon">
            <li><a href="https://www.linkedin.com/company/intermodal-shipping"><img src="img/follow_icon6.png"
                                                                                    alt=""></a></li>

        </ul>
    </div>
</footer>
<script src="js/bootstrap.min.js"></script>
<script src="js/tm-scripts.js"></script>
</body>
</html>