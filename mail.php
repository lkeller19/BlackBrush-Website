<?php 

ini_set('error_reporting', E_ALL);


    $nameErr = $emailErr = "";
    $name = $email = $message = "";
    $messageError = $successMessage = "";
    $notReady = "ddd";
    $number = "";
    $numberError = "";

if (isset($_POST['submit'])) {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
    }
  }

  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
      $notReady ="";
    }
  }

  if (empty($_POST["message"])) {
    $messageError = "Message is required";
  } else {
    $message = test_input($_POST["message"]);
  }

if(!($name=='') && !($email=='') && !($message=='') && !($notReady==''))
{
        if (empty($_POST["number"])) {
          $number = "(not provided)";
        }
        else {
          $number = test_input($_POST["number"]);
        }
        $subject= $name."<". $email .">";
        $subjects = "Contact Confirmation from blackbrushhc.com"; /* Let's prepare the message for the e-mail */
        $header="";
        $headers="";
        $msg = "Hello, $name! Thank you for contacting us. This is a contact confirmation email. We will be in touch with you as soon as possible.

        For your own records, here is what we got from you:
        Name: $name
        E-mail: $email
        Number: $number
        Message: $message

        We look forward to working with you! -BHC";
        $msg1 = " $name contacted us through the website. Here are the details:
        Name: $name
        E-mail: $email
        Number: $number
        Message: $message "; /* Send the message using mail() function */
        if(mail($email, $subjects, $msg, $headers, "-finfo@blackbrushhc.com") && mail("info@blackbrushhc.com", $subject, $msg1, $header, "-finfo@blackbrushhc.com"))
        {
            $successMessage = "Message sent successfully! We will get back to you as soon as we can.";
            $nameErr = $emailErr = "";
    $name = $email = $message = $number = "";
        }
        else {
            $messageError = "Mail server full. Please contact us directly instead. Thank you!";
            $nameErr = $emailErr = "";
    $name = $email = $message = "";
        }


    }
}

  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

?>