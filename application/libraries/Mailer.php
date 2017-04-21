<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once('PHPMailer/class.phpmailer.php');

class Mailer extends PHPMailer
{

    var $mail;
	
    public function __construct()
    {			
        // the true param means it will throw exceptions on errors, which we need to catch
        $this->mail = new PHPMailer(true);
 
        $this->mail->IsSMTP(); // telling the class to use SMTP
 
        $this->mail->CharSet = "utf-8";                  // ????? CharSet ????????
        $this->mail->SMTPDebug  = 0;                     // enables SMTP debug information
        $this->mail->SMTPAuth   = false;                  // enable SMTP authentication
        $this->mail->SMTPSecure = false;                 // sets the prefix to the servier
        $this->mail->Host       = "localhost";      // sets GMAIL as the SMTP server
        $this->mail->Port       = 25;                   // set the SMTP port for the GMAIL server
        $this->mail->Username   = SMTP_USERNAME;// GMAIL username
        $this->mail->Password   = SMTP_PASSWORD;       // GMAIL password
        $this->mail->AddReplyTo('no-reply@tture.com', 'Tture');
        $this->mail->SetFrom('no-reply@tture.com', 'Tture');
    }

    public function sendmail($to, $to_name, $subject, $body){

        try{
            $this->mail->AddAddress($to, $to_name);
            //$this->mail->AddBCC('testsoft.54@gmail.com','CIDEMO Mails');

            $this->mail->Subject = $subject;
            $this->mail->Body    = $body;

            $this->mail->Send();

           // echo "Message Sent OK</p>\n";
 
        } catch (phpmailerException $e) {
            echo $e->errorMessage(); //Pretty error messages from PHPMailer
        } catch (Exception $e) {
            echo $e->getMessage(); //Boring error messages from anything else!
        }
    }
}
 
/* End of file mailer.php */