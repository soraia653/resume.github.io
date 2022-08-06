<?php
// define variables and set to empty values
$full-name = $email = $comment = "";
$full-name-error = $email-error = "";

if (isset($_POST["submit"])) {
    //my email address
    $mail_to = "soraiaoliveira094@gmail.com";

    if (empty($_POST["full-name"])) {
        $full-name-error = "Name is required";
    } else {
        $full-name = test_input($_POST["full-name"]);

        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/",$full-name)) {
            $full-name-error = "Only letters and white space allowed";
        }
    }

    if (empty($_POST["email"])) {
        $email-error = "Email is required";
    } else {
        $email = test_input($_POST["email"]);

        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email-error = "Invalid email format";
        }
    }

    if (empty($_POST["comment"])) {
        $comment = "";
    } else {
        $comment = test_input($_POST["comment"]);
    }

    // Email body I will receive
    $message = "Full Name: " . $full-name . "\n"
    . "Email Address: " . $email . "\n\n"
    . "Message: " . "\n" . $comment;

    // Subject
    $subject = "Contact from CV website";
    
    //Email header
    $headers = "From: " . $email;

    // PHP mailer function
    $send_email = mail($mail_to, $subject, $message, $headers, '-soraiaoliveira094@gmail.com');

    // Check if email was sent successfully
    if ($send_email) {
        $success = "Your message was sent successfully.";
    } else {
        $failed = "Apologies, message was not sent. Please try again later.";
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>