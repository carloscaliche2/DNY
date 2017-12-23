<?php
$owner_email = 'carloscaliche2@gmail.com';
//SMTP server settings
$host = '';
$port = '465';//"587";
$username = '';
$password = '';

$subject = 'A message from your site visitor ';
$user_email = '';
$message_body = '';
$message_type = 'html';

$max_file_size = 50;//MB
$file_types = '/(doc|docx|txt|pdf|zip|rar)$/';
$error_text = 'something goes wrong';
$error_text_filesize = 'File size must be less than';
$error_text_filetype = 'Failed to upload file. This file type is not allowed. Accepted files types: doc, docx, txt, pdf, zip, rar.';

$private_recaptcha_key = '6LeZwukSAAAAACmqrbLmdpvdhC68NLB1c9EA5vzU'; //localhost


$use_recaptcha = isset($_POST["recaptcha_challenge_field"]) and isset($_POST["recaptcha_response_field"]);
$use_smtp = ($host == '' or $username == '' or $password == '');
$max_file_size *= 1048576;

if ($owner_email == '') {
    die('Attention, recipient e-mail is not set! Please define "owner_email" variable in the MailHanlder.php file.');
}

if (preg_match('/^(127\.|192\.168\.)/', $_SERVER['REMOTE_ADDR'])) {
    die('Attention, contact form will not work locally! Please upload your template to a live hosting server.');
}

if ($use_recaptcha) {
    require_once('recaptchalib.php');
    $resp = recaptcha_check_answer($private_recaptcha_key, $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);
    if (!$resp->is_valid) {
        die ('wrong captcha');
    }
}


if (isset($_POST['name']) and $_POST['name'] != '') {
    $message_body .= '<p>Name Visitor: ' . $_POST['name'] . '</p>' . "\n" . '<br>' . "\n";
    $subject .= $_POST['name'];
}
if (isset($_POST['name2']) and $_POST['name2'] != '') {
    $message_body .= '<p>Last Name Visitor: ' . $_POST['name2'] . '</p>' . "\n" . '<br>' . "\n";
    $subject .= $_POST['name2'];
}
if (isset($_POST['Company']) and $_POST['Company'] != '') {
    $message_body .= '<p>Company: ' . $_POST['Company'] . '</p>' . "\n" . '<br>' . "\n";
    $subject .= $_POST['Company'];
}
if (isset($_POST['email']) and $_POST['email'] != '') {
    $message_body .= '<p>Email Address: ' . $_POST['email'] . '</p>' . "\n" . '<br>' . "\n";
    $user_email = $_POST['email'];
}
if (isset($_POST['phone']) and $_POST['phone'] != '') {
    $message_body .= '<p>Phone Number: ' . $_POST['phone'] . '</p>' . "\n" . '<br>' . "\n";
}
if (isset($_POST['numbers']) and $_POST['numbers'] != '') {
    $message_body .= '<p>Number of Pieces: ' . $_POST['numbers'] . '</p>' . "\n" . '<br>' . "\n";
}


if (isset($_POST['name11']) and $_POST['name11'] != '') {
    $message_body .= '<p>Pound or Kilos: ' . $_POST['name11'] . '</p>' . "\n" . '<br>' . "\n";
}
if (isset($_POST['name12']) and $_POST['name12'] != '') {
    $message_body .= '<p>Quantity Pound: ' . $_POST['name12'] . '</p>' . "\n" . '<br>' . "\n";
}

if (isset($_POST['name13']) and $_POST['name13'] != '') {
    $message_body .= '<p>Quantity Kilos: ' . $_POST['name13'] . '</p>' . "\n" . '<br>' . "\n";
}
if (isset($_POST['option2']) and $_POST['option2'] != '') {
    $message_body .= '<p>CBM or CBF: ' . $_POST['option2'] . '</p>' . "\n" . '<br>' . "\n";
}
if (isset($_POST['name15']) and $_POST['name15'] != '') {
    $message_body .= '<p>Quantity CBM: ' . $_POST['name15'] . '</p>' . "\n" . '<br>' . "\n";
}
if (isset($_POST['name16']) and $_POST['name16'] != '') {
    $message_body .= '<p>Quantity CBF: ' . $_POST['name16'] . '</p>' . "\n" . '<br>' . "\n";
}


if (isset($_POST['originzipcode']) and $_POST['originzipcode'] != '') {
    $message_body .= '<p>Origin Zip Code: ' . $_POST['originzipcode'] . '</p>' . "\n" . '<br>' . "\n";
}
if (isset($_POST['destinationzipcode']) and $_POST['destinationzipcode'] != '') {
    $message_body .= '<p>Destination Zip Code: ' . $_POST['destinationzipcode'] . '</p>' . "\n" . '<br>' . "\n";
}


if (isset($_POST['portnameorigin']) and $_POST['portnameorigin'] != '') {
    $message_body .= '<p>Port Name Origin: ' . $_POST['portnameorigin'] . '</p>' . "\n" . '<br>' . "\n";
}
if (isset($_POST['nameportdestination']) and $_POST['nameportdestination'] != '') {
    $message_body .= '<p>Name Port Destination: ' . $_POST['nameportdestination'] . '</p>' . "\n" . '<br>' . "\n";
}


if (isset($_POST['numbers6']) and $_POST['numbers6'] != '') {
    $message_body .= '<p>FCL or LCL: ' . $_POST['numbers6'] . '</p>' . "\n" . '<br>' . "\n";
}
if (isset($_POST['numbers2']) and $_POST['numbers2'] != '') {
    $message_body .= '<p>Gross Weight/total weight Lbs or Kilos: ' . $_POST['numbers2'] . '</p>' . "\n" . '<br>' . "\n";
}


if (isset($_POST['numbers100']) and $_POST['numbers100'] != '') {
    $message_body .= '<p>Pound or Kilos: ' . $_POST['numbers100'] . '</p>' . "\n" . '<br>' . "\n";
}

if (isset($_POST['container']) and $_POST['container'] != '') {
    $message_body .= '<p>Container Type: ' . $_POST['container'] . '</p>' . "\n" . '<br>' . "\n";
}
if (isset($_POST['type']) and $_POST['type'] != '') {
    $message_body .= '<p>Type: ' . $_POST['type'] . '</p>' . "\n" . '<br>' . "\n";
}


if (isset($_POST['option1']) and $_POST['option1'] != '') {
    $message_body .= '<p>Option: ' . $_POST['option1'] . '</p>' . "\n" . '<br>' . "\n";
}
if (isset($_POST['origin']) and $_POST['origin'] != '') {
    $message_body .= '<p>Origin/Us zip Code: ' . $_POST['origin'] . '</p>' . "\n" . '<br>' . "\n";
}
if (isset($_POST['destination']) and $_POST['destination'] != '') {
    $message_body .= '<p>Name Destination Port: ' . $_POST['destination'] . '</p>' . "\n" . '<br>' . "\n";
}
if (isset($_POST['zip']) and $_POST['zip'] != '') {
    $message_body .= '<p>Zip us: ' . $_POST['zip'] . '</p>' . "\n" . '<br>' . "\n";
}


if (isset($_POST['origin_port']) and $_POST['origin_port'] != '') {
    $message_body .= '<p>Origin Port: ' . $_POST['origin_port'] . '</p>' . "\n" . '<br>' . "\n";
}
if (isset($_POST['destination_port']) and $_POST['destination_port'] != '') {
    $message_body .= '<p>Destination Port: ' . $_POST['destination_port'] . '</p>' . "\n" . '<br>' . "\n";
}


if (isset($_POST['numbers3']) and $_POST['numbers3'] != '') {
    $message_body .= '<p>Dimesion L: ' . $_POST['numbers3'] . '</p>' . "\n" . '<br>' . "\n";
    $subject .= $_POST['numbers3'];
}
if (isset($_POST['numbers4']) and $_POST['numbers4'] != '') {
    $message_body .= '<p>Dimesion W: ' . $_POST['numbers4'] . '</p>' . "\n" . '<br>' . "\n";
}
if (isset($_POST['numbers5']) and $_POST['numbers5'] != '') {
    $message_body .= '<p>Dimesion H: ' . $_POST['numbers5'] . '</p>' . "\n" . '<br>' . "\n";
}

if (isset($_POST['quantitycbm']) and $_POST['quantitycbm'] != '') {
    $message_body .= '<p>Quantity CBM: ' . $_POST['quantitycbm'] . '</p>' . "\n" . '<br>' . "\n";
}
if (isset($_POST['quantitycbf']) and $_POST['quantitycbf'] != '') {
    $message_body .= '<p>Quantity CBF: ' . $_POST['quantitycbf'] . '</p>' . "\n" . '<br>' . "\n";
}


if (isset($_POST['entrance']) and $_POST['entrance'] != '') {
    $message_body .= '<p>Port Name Entrance: ' . $_POST['entrance'] . '</p>' . "\n" . '<br>' . "\n";
}
if (isset($_POST['output']) and $_POST['output'] != '') {
    $message_body .= '<p>Port Name Output: ' . $_POST['output'] . '</p>' . "\n" . '<br>' . "\n";
}


if (isset($_POST['name20']) and $_POST['name20'] != '') {
    $message_body .= '<p>Port Name Origin Port: ' . $_POST['name20'] . '</p>' . "\n" . '<br>' . "\n";
}
if (isset($_POST['name21']) and $_POST['name21'] != '') {
    $message_body .= '<p>Port Name Destinarion Port: ' . $_POST['name21'] . '</p>' . "\n" . '<br>' . "\n";
}
if (isset($_POST['name22']) and $_POST['name22'] != '') {
    $message_body .= '<p>Commodity: ' . $_POST['name22'] . '</p>' . "\n" . '<br>' . "\n";
}
if (isset($_POST['name23']) and $_POST['name23'] != '') {
    $message_body .= '<p>Value of the Commodity: ' . $_POST['name23'] . '</p>' . "\n" . '<br>' . "\n";
}


if (isset($_POST['message1']) and $_POST['message1'] != '') {
    $message_body .= '<p>Message LCL OCEAN RATES: ' . $_POST['message1'] . '</p>' . "\n";
}
if (isset($_POST['message']) and $_POST['message'] != '') {
    $message_body .= '<p>Message: ' . $_POST['message'] . '</p>' . "\n";
}
if (isset($_POST['message2']) and $_POST['message2'] != '') {
    $message_body .= '<p>Message Export - FCL Ocean Rates: ' . $_POST['message2'] . '</p>' . "\n";
}
if (isset($_POST['message3']) and $_POST['message3'] != '') {
    $message_body .= '<p>Message LCL Trucking Rates: ' . $_POST['message3'] . '</p>' . "\n";
}
if (isset($_POST['message4']) and $_POST['message4'] != '') {
    $message_body .= '<p>Message Import Port to US Port Rates: ' . $_POST['message4'] . '</p>' . "\n";
}

if (isset($_POST['message5']) and $_POST['message5'] != '') {
    $message_body .= '<p>Message Import Port to Us Door Rates: ' . $_POST['message5'] . '</p>' . "\n";
}
if (isset($_POST['message6']) and $_POST['message6'] != '') {
    $message_body .= '<p>Message Air Export Rates: ' . $_POST['message6'] . '</p>' . "\n";
}
if (isset($_POST['message7']) and $_POST['message7'] != '') {
    $message_body .= '<p>Message Cargo Insurance: ' . $_POST['message7'] . '</p>' . "\n";
}


if (isset($_POST['state']) and $_POST['state'] != '') {
    $message_body .= '<p>State: ' . $_POST['state'] . '</p>' . "\n" . '<br>' . "\n";
}
if (isset($_POST['fax']) and $_POST['fax'] != '') {
    $message_body .= '<p>Fax Number: ' . $_POST['fax'] . '</p>' . "\n" . '<br>' . "\n";
}

if (isset($_POST['stripHTML']) and $_POST['stripHTML'] == 'true') {
    $message_body = strip_tags($message_body);
    $message_type = 'text';
}

try {
    include "libmail.php";
    $m = new Mail("utf-8");
    $m->From($user_email);
    $m->To($owner_email);
    $m->Subject($subject);
    $m->Body($message_body, $message_type);
    //$m->log_on(true);

    if (isset($_FILES['attachment'])) {
        if ($_FILES['attachment']['size'] > $max_file_size) {
            $error_text = $error_text_filesize . ' ' . $max_file_size . 'bytes';
            die($error_text);
        } else {
            if (preg_match($file_types, $_FILES['attachment']['name'])) {
                $m->Attach($_FILES['attachment']['tmp_name'], $_FILES['attachment']['name'], '', 'attachment');
            } else {
                $error_text = $error_text_filetype;
                die($error_text);
            }
        }
    }
    if (!$use_smtp) {
        $m->smtp_on($host, $username, $password, $port);
    }

    if ($m->Send()) {
        die('success');
    }

} catch (Exception $mail) {
    die($mail);
}
?>