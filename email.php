<?php


require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'vendor/autoload.php';

 $mail = new PHPMailer(true);

                                       
                                              //Server settings
                                              $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
                                              $mail->isSMTP();                                            // Send using SMTP
                                              $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
                                              $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                                              $mail->Username   = '';                     // SMTP username
                                              $mail->Password   = '';                               // SMTP password
                                              $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                                              $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

                                              //Recipients
                                              $mail->setFrom('tagihani', 'Admin Web Token');
                                              $mail->addAddress('erdyansyahboy@gmail.com');     // Add a recipient
                                              // $mail->addAddress('ellen@example.com');               // Name is optional
                                              // $mail->addReplyTo('info@example.com', 'Information');
                                              // $mail->addCC('cc@example.com');
                                              // $mail->addBCC('bcc@example.com');

                                              // // Attachments
                                              // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                                              // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

                                              // Content
                                              $mail->isHTML(true);                                  // Set email format to HTML
                                              $mail->Subject = 'Here is the subject';
                                              $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
                                               $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                                              $mail->send();
                                        




?>