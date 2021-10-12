<?php
    require 'vendor/autoload.php';

    $email = new \SendGrid\Mail\Mail(); 
    $email->setFrom("gombos.krisztian14@gmail.com", "me");
    $email->setSubject("second test");
    $email->addTo("krisztian_gombos@yahoo.com", "also me");
    $email->addContent("text/plain", "and easy to do anywhere, even with PHP");
    $email->addContent(
        "text/html", "<strong>and easy to do anywhere, even with PHP</strong>"
    );

    session_start();

    $file_encoded = base64_encode(file_get_contents($_SESSION['fileName']));
    $email->addAttachment(
    $file_encoded,
    "application/csv",
    $_SESSION['fileName'],
    "attachment"
    );

    session_unset();
    session_destroy();


    $sendgrid = new \SendGrid('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');

    try {
        $response = $sendgrid->send($email);
        print $response->statusCode() . "\n";
        print_r($response->headers());
        print $response->body() . "\n";
    } catch (Exception $e) {
        echo 'Caught exception: '. $e->getMessage() ."\n";
    }