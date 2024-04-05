<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/PHPMailer-6.9.1/src/Exception.php';
require 'PHPMailer/PHPMailer-6.9.1/src/PHPMailer.php';
require 'PHPMailer/PHPMailer-6.9.1/src/SMTP.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Me</title>
    <link rel="stylesheet" href="contactForm.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>

<body>
    <section id="contact-form">
        <h2>Contact</h2>
        <form id="contact" name="contact" accept-charset="utf-8" action="processForm.php" method="post">


            <label><span>Name</span>
                <input name="name" type="text" placeholder="Name" /></label>
            <label><span>Email</span>
                <input name="email" type="email" placeholder="Email" /></label>
            <label><span>Message</span>
                <textarea name="message" placeholder="Message"></textarea></label>
            
                <input name="submit" type="submit" value="Send" />
        </form>
    </section>

    <script>
        $(document).ready(function () {
                var form = $('#contact'),
                    submit = form.find('[name="submit"]');

                form.on('submit', function (e) {
                    e.preventDefault();

                    // Your existing validation and animation code
                    var valid = true;

                    form.find('input, textarea').removeClass('invalid').each(function () {
                        if (!this.value.trim()) {
                            $(this).addClass('invalid');
                            valid = false;
                        }
                    });

                    if (!valid) {
                        form.animate({ left: '-3em' }, 50)
                            .animate({ left: '3em' }, 100)
                            .animate({ left: '0' }, 50);
                    } else {
                        $.ajax({
                            type: 'POST',
                            url: 'processForm.php',
                            data: form.serialize(),
                            dataType: 'json',
                            success: function (response) {
                                if (response.success) {
                                    // Success handling (e.g., display a success message)
                                    console.log(response.message);
                                } else {
                                    // Failure handling (e.g., display an error message)
                                    console.log(response.message);
                                }
                            },
                            error: function () {
                                // Error handling
                                console.log('Error occurred during AJAX request.');
                            }
                        });
                    }
                });
            });

    </script>
</body>

</html>