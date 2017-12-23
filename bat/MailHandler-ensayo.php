<?php
	$owner_email='nataliagutierrezaj@gmail.com';
	//SMTP server settings	
	$host = '';
    $port = '465';//"587";
    $username = '';
    $password = '';

    $subject='A message from your site visitor ';
    $user_email='';    
	$message_body='';
	$message_type='html';

	$max_file_size=50;//MB 
	$file_types='/(doc|docx|txt|pdf|zip|rar)$/';
	$error_text='something goes wrong';
	$error_text_filesize='File size must be less than';
	$error_text_filetype='Failed to upload file. This file type is not allowed. Accepted files types: doc, docx, txt, pdf, zip, rar.';

	$private_recaptcha_key='6LeZwukSAAAAACmqrbLmdpvdhC68NLB1c9EA5vzU'; //localhost
	
	
	$use_recaptcha=isset( $_POST["recaptcha_challenge_field"]) and isset($_POST["recaptcha_response_field"]);
	$use_smtp=($host=='' or $username=='' or $password=='');
	$max_file_size*=1048576;

	if($owner_email==''){
		die('Attention, recipient e-mail is not set! Please define "owner_email" variable in the MailHanlder.php file.');
	}

	if(preg_match('/^(127\.|192\.168\.)/',$_SERVER['REMOTE_ADDR'])){
		die('Attention, contact form will not work locally! Please upload your template to a live hosting server.');
	}

	if($use_recaptcha){
		require_once('recaptchalib.php');
		$resp = recaptcha_check_answer ($private_recaptcha_key,$_SERVER["REMOTE_ADDR"],$_POST["recaptcha_challenge_field"],$_POST["recaptcha_response_field"]);
		if (!$resp->is_valid){
			die ('wrong captcha');
		}
	}
	
             
	if(isset($_POST['name']) and $_POST['name'] != ''){$message_body .= '<p>Name Visitor: ' . $_POST['name'] . '</p>' . "\n" . '<br>' . "\n"; $subject.=$_POST['name'];}
             if(isset($_POST['name2']) and $_POST['name2'] != ''){$message_body .= '<p>Last Name Visitor: ' . $_POST['name2'] . '</p>' . "\n" . '<br>' . "\n"; $subject.=$_POST['name2'];}
             if(isset($_POST['Company']) and $_POST['Company'] != ''){$message_body .= '<p>Company: ' . $_POST['Company'] . '</p>' . "\n" . '<br>' . "\n"; $subject.=$_POST['Company'];}
	if(isset($_POST['email']) and $_POST['email'] != ''){$message_body .= '<p>Email Address: ' . $_POST['email'] . '</p>' . "\n" . '<br>' . "\n"; $user_email=$_POST['email'];}
             if(isset($_POST['phone']) and $_POST['phone'] != ''){$message_body .= '<p>Phone Number: ' . $_POST['phone'] . '</p>' . "\n" . '<br>' . "\n";}
             if(isset($_POST['numbers']) and $_POST['numbers'] != ''){$message_body .= '<p>Number of Pieces: ' . $_POST['numbers'] . '</p>' . "\n" . '<br>' . "\n";}
             if(isset($_POST['numbers6']) and $_POST['numbers6'] != ''){$message_body .= '<p>Change Between pound or kilos: ' . $_POST['numbers6'] . '</p>' . "\n" . '<br>' . "\n";}
             if(isset($_POST['numbers2']) and $_POST['numbers2'] != ''){$message_body .= '<p>Gross Weight/total weight Lbs or Kilos: ' . $_POST['numbers2'] . '</p>' . "\n" . '<br>' . "\n";}

            if(isset($_POST['container']) and $_POST['container'] != ''){$message_body .= '<p>Container Type: ' . $_POST['container'] . '</p>' . "\n" . '<br>' . "\n";}
            if(isset($_POST['option1']) and $_POST['option1'] != ''){$message_body .= '<p>Option: ' . $_POST['option1'] . '</p>' . "\n" . '<br>' . "\n";}
            if(isset($_POST['origin']) and $_POST['origin'] != ''){$message_body .= '<p>Origin/Us zip Code: ' . $_POST['origin'] . '</p>' . "\n" . '<br>' . "\n";}
            if(isset($_POST['destination']) and $_POST['destination'] != ''){$message_body .= '<p>Name Destination Port: ' . $_POST['destination'] . '</p>' . "\n" . '<br>' . "\n";}
            if(isset($_POST['origin_port']) and $_POST['origin_port'] != ''){$message_body .= '<p>Origin Port: ' . $_POST['origin_port'] . '</p>' . "\n" . '<br>' . "\n";} 
            if(isset($_POST['destination_port']) and $_POST['destination_port'] != ''){$message_body .= '<p>Destination Port: ' . $_POST['destination_port'] . '</p>' . "\n" . '<br>' . "\n";}
          
        
       

             if(isset($_POST['numbers3']) and $_POST['numbers3'] != ''){$message_body .= '<p>Dimesion L: ' . $_POST['numbers3'] . '</p>' . "\n" . '<br>' . "\n"; $subject.=$_POST['numbers3'];}
             if(isset($_POST['numbers4']) and $_POST['numbers4'] != ''){$message_body .= '<p>Dimesion W: ' . $_POST['numbers4'] . '</p>' . "\n" . '<br>' . "\n";}
             if(isset($_POST['numbers5']) and $_POST['numbers5'] != ''){$message_body .= '<p>Dimesion H: ' . $_POST['numbers5'] . '</p>' . "\n" . '<br>' . "\n";}
              if(isset($_POST['option2']) and $_POST['option2'] != ''){$message_body .= '<p>CBM or CBF: ' . $_POST['option2'] . '</p>' . "\n" . '<br>' . "\n";}
 
    
             if(isset($_POST['message1']) and $_POST['message1'] != ''){$message_body .= '<p>Message LCL OCEAN RATES: ' . $_POST['message1'] . '</p>' . "\n";} 
             if(isset($_POST['message']) and $_POST['message'] != ''){$message_body .= '<p>Message: ' . $_POST['message'] . '</p>' . "\n";}
             if(isset($_POST['message2']) and $_POST['message2'] != ''){$message_body .= '<p>Message Export - FCL Ocean Rates: ' . $_POST['message2'] . '</p>' . "\n";}
             if(isset($_POST['message3']) and $_POST['message3'] != ''){$message_body .= '<p>Message LCL Trucking Rates: ' . $_POST['message3'] . '</p>' . "\n";} 

                      

                    

	if(isset($_POST['state']) and $_POST['state'] != ''){$message_body .= '<p>State: ' . $_POST['state'] . '</p>' . "\n" . '<br>' . "\n";}
	if(isset($_POST['fax']) and $_POST['fax'] != ''){$message_body .= '<p>Fax Number: ' . $_POST['fax'] . '</p>' . "\n" . '<br>' . "\n";}
		
	if(isset($_POST['stripHTML']) and $_POST['stripHTML']=='true'){$message_body = strip_tags($message_body);$message_type='text';}
             
           


    


 



 





try{
	include "libmail.php";
	$m= new Mail("utf-8");
	$m->From($user_email);
	$m->To($owner_email);
	$m->Subject($subject);
	$m->Body($message_body,$message_type);
	//$m->log_on(true);

	if(isset($_FILES['attachment'])){
		if($_FILES['attachment']['size']>$max_file_size){
			$error_text=$error_text_filesize . ' ' . $max_file_size . 'bytes';
			die($error_text);			
		}else{			
			if(preg_match($file_types,$_FILES['attachment']['name'])){
				$m->Attach($_FILES['attachment']['tmp_name'],$_FILES['attachment']['name'],'','attachment');
			}else{
				$error_text=$error_text_filetype;
				die($error_text);				
			}
		}		
	}
	if(!$use_smtp){
		$m->smtp_on( $host, $username, $password, $port);
	}

	if($m->Send()){
		die('success');
	}	
	
}catch(Exception $mail){
	die($mail);
}	
?>