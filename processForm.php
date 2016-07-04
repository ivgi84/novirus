<?php
 
// Define some constants
define( "RECIPIENT_NAME", "Evgeny Smolovich" );
define( "RECIPIENT_EMAIL", "ivgi84@gmail.com" );
define( "EMAIL_SUBJECT", "New Visitor data from No-Virus" );
 
// Read the form values
$success = false;
$senderName = isset( $_POST['senderName'] )? preg_replace( "/[^\.\-\' a-zA-Z0-9א-ת]/", "", $_POST['senderName'] ) : "";
$senderPhone = isset( $_POST['senderPhone'] ) ? preg_replace( "/[^\.\-\' 0-9]/", "", $_POST['senderPhone'] ) : "";
$senderEmail = isset( $_POST['senderEmail'] ) ? preg_replace( "/[^\.\-\_\@a-zA-Z0-9]/", "", $_POST['senderEmail'] ) : "";
$message = isset( $_POST['message'] ) ? preg_replace( "/(From:|To:|BCC:|CC:|Subject:|Content-Type:)/", "", $_POST['message'] ) : "";
 
// If all values exist, send the email
if ( $senderName && $senderEmail && $message ) {
  $recipient = RECIPIENT_NAME . " <" . RECIPIENT_EMAIL . ">";
  
  $headers = "MIME-Version: 1.0\r\n";
  $headers .= "Content-Type: text/html; charset=utf-8\r\n";
  $headers .= "From: " . $senderName . " <" . $senderEmail . ">";

  $body.="Name is: " .  $senderName . "<br />";
  $body.="Email is: " .  $senderEmail .  "<br />";
  $body.="Telephone is: " .  $senderPhone .  "<br />";
  $body.="message is: " .  $message .  "<br />";
  $success = mail( $recipient, EMAIL_SUBJECT, $body, $headers );

 
}
 
// Return an appropriate response to the browser
if ( isset($_GET["ajax"]) ) {
  echo $success ? "success" : "error";
} else {
?>
<html>
  <head>
    <title>Thanks!</title>
  </head>
  <body>
  <?php if ( $success ) echo "<p>Thanks for sending your message! We'll get back to you shortly.</p>" ?>
  <?php if ( !$success ) echo "<p>There was a problem sending your message. Please try again.</p>" ?>
  <p>Click your browser's Back button to return to the page.</p>
  </body>
</html>
<?php
}
?>