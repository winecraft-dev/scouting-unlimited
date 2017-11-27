<?php

require_once($fileRoot . '/swift-mailer/lib/swift_required.php');

class Mailer {
  /*
  A class centralizing code to send emails.
  */
  
  public function sendEmail($address, $subject, $messageBody) {
    if($GLOBALS['config']->get('send_email')) { //check config file for emailing
      $message = Swift_Message::newInstance();
      $message->setFrom(['admin@team624.org' => 'blog.team624.org']);
      $message->setSubject($subject);
      $message->setTo($address);
      $message->setBody($messageBody);
      
      $transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, 'ssl');
      $transport->setUsername('admin@team624.org');
      $transport->setPassword('Gravity624-2015');
      
      $mailer = Swift_Mailer::newInstance($transport);
      $mailer->send($message);
    } else {
      echo $messageBody;
    }
  }
}
