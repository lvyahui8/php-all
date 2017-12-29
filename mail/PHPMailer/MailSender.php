<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'vendor/autoload.php';
require_once 'Configuration.php';

/**
 * Created by PhpStorm.
 * User: lvyahui
 * Date: 2017/10/23
 * Time: 22:28
 */
class MailSender
{

    /**
     * @var PHPMailer
     */
    private $mail;

    /**
     * @var Config
     */
    private $configuration;
    /**
     * MailSender constructor.
     */
    public function __construct()
    {
        $this->configuration = new Config();
        $this->initMail();
    }

    public function sendText($subject, $message,$addresses){
        $this->mail->Subject = $subject;
        $this->mail->Body = $message;
        if(! is_array($addresses) || empty($addresses)){
            $addresses = $this->configuration->get('default_addresses');
        }

        foreach($addresses as $address){
            $this->mail->addAddress($address);
        }

        $this->mail->isHTML(true);

        $this->mail->send();
    }

    private function initMail()
    {
        $mail = new PHPMailer(true);
        $mail->SMTPDebug = 2;
        $mail->isSMTP();
        $mail->CharSet = 'UTF-8';
        $mail->Host = $this->configuration->get('smtp_host');
        $mail->SMTPAuth = true;
        $mail->Username = $this->configuration->get('svr_user');
        $mail->Password = $this->configuration->get('svr_pass');
        $mail->SMTPSecure = 'tls';
        $mail->Port =  $this->configuration->get('smtp_port');

        $mail->setFrom($mail->Username,'lyh');

        $this->mail =$mail;
    }
}