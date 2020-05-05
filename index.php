
<?php include_once("credentials.php"); ?>

<?php

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

        if(isset($_POST['submit'])) {
            
            $email       = $_POST['email'];
            $full_name   = $_POST['full_name'];
            $body        = $_POST['body'];

            // Instantiation and passing `true` enables exceptions
            $mail = new PHPMailer(true);
            try {

                $mail->isSMTP();                                       // Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                // Enable SMTP authentication
                $mail->Username   = EMAIL;                               // SMTP username
                $mail->Password   = PASSWORD;                            // SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;      // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
                $mail->Port       = 587;                                 // TCP port to connect to

                //Recipients
                $mail->setFrom(EMAIL, $full_name);
                $mail->addAddress(EMAIL_ID, $full_name);   // Add a recipient
                $mail->addReplyTo($email, $full_name);

                // Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'Contact Inquiry!';
                $mail->Body    = "Name: $full_name <br /><br />Message: $body <br /><br />Sent By: $email";

                $mail->send();
                echo '<script>alert("Message has been sent");</script>';
            } catch (Exception $e) {
                echo '<script>alert("Message Couldn\'t be sent");</script>';
            }

        }
    
    ?>


    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PHP Mailer demo</title>
    </head>
    <body>

        <form action="" method="post">
            <div class="form-group">
                <input type="text" placeholder="email" name="email">
            </div>
            <div class="form-group">
                <input type="text" placeholder="full name" name="full_name">
            </div>
            <div class="form-group">
                <input type="text" placeholder="body" name="body">
            </div>
            <input type="submit" name="submit" value="Send Mail">
        </form>


    </body>
    </html>