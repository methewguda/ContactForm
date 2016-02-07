<?php

/**
 * Mail class - a wrapper around PHPMailer
 */

class Mail
{

  private function __construct() {}  // disallow creating a new object of the class with new Mail()

  private function __clone() {}  // disallow cloning the class

  /**
   * Send an email
   *
   * @param string $name     Name
   * @param string $email    Email address
   * @param string $subject  Subject
   * @param string $body     Body
   * @return boolean         true if the email was sent successfully, false otherwise
   */
  public static function send($name, $email, $subject, $body)
  {
    require dirname(dirname(__FILE__)) . '/vendors/PHPMailer/PHPMailerAutoload.php';

    $mail = new PHPMailer();

    //Set PHPMailer to use SMTP.
    $mail->isSendMail();
    //Set SMTP host name
    $mail->Host = Config::SMTP_HOST;
    //Set this to true if SMTP host requires authentication to send email
    $mail->SMTPAuth = true;
    //Provide username and password
    $mail->Username = Config::SMTP_USER;
    $mail->Password = Config::SMTP_PASS;
    //If SMTP requires TLS encryption then set it
    $mail->SMTPSecure = Config::SMTP_CERTIFICATE;
    //Set TCP port to connect to
    $mail->Port = Config::SMTP_PORT;

    $mail->setFrom($email, $name);
    $mail->addAddress(Config::SMTP_USER, Config::SMTP_NAME);

    $mail->isHTML(true);

    $mail->Subject = $subject;
    $mail->Body = $body;

    if(!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    }
  }
}
