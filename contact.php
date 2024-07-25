<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require "includes/db.php";
require "vendor/autoload.php";
require "classes/config.php";

$message = '';
$form_submitted = false;

if (isset($_POST['submit'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $messageContent = trim($_POST['message']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "<h4 class='alert alert-danger text-center'>Invalid email format</h4>";
    } else {
        $mail = new PHPMailer(true);
        try {
            // Server settings
            $mail->SMTPDebug = SMTP::DEBUG_OFF;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'aabubakarsidiqq@gmail.com';
            $mail->Password = 'ynsq yqtr qyix tbtd';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;

            // Recipients
            $mail->setFrom($email, $name);
            $mail->addAddress('aabubakarsidiqq@gmail.com'); // Enter your email address

            // Content
            $mail->isHTML(true);
            $mail->Subject = "$email ($subject)" . " From: CMS-BlogSystem";
            $mail->Body = $messageContent;
            $mail->AltBody = strip_tags($messageContent);

            $mail->send();
            $message = "<h4 class='alert alert-success text-center'>Message Sent Successfully</h4>";
            $form_submitted = true; // Set the flag to indicate form submission
        } catch (Exception $e) {
            $message = "<h4 class='alert alert-danger text-center'>Message could not be sent. Mailer Error: {$mail->ErrorInfo}</h4>";
        }
    }

    if ($form_submitted) {
        // Prevent form resubmission on page refresh
        header("Location: " . $_SERVER['PHP_SELF'] . "?success=1");
        exit();
    }
}
?>

<?php require "includes/header.php"; ?>
<?php require "includes/navigation.php"; ?>

<!-- ======= Contact Section ======= -->
<section class="breadcrumbs">
  <div class="container">
    <div class="d-flex justify-content-between align-items-center">
      <h2>Contact</h2>
      <ol>
        <li><a href="index.html">Home</a></li>
        <li>Contact</li>
      </ol>
    </div>
  </div>
</section><!-- End Contact Section -->

<!-- ======= Contact Section ======= -->
<section class="contact" data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-duration="500">
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <div class="row">
          <div class="col-md-12">
            <div class="info-box">
              <i class="bx bx-map"></i>
              <h3>Our Address</h3>
              <p>Elmira Way, Salford Manchester, M53LN</p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="info-box">
              <i class="bx bx-envelope"></i>
              <h3>Email Us</h3>
              <p>aabubakarsidiqq@gmail.com<br>abubakarsidiq-cms@abusidiqsupport.com</p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="info-box">
              <i class="bx bx-phone-call"></i>
              <h3>Call Us</h3>
              <p>+44 7442831743<br>+44 7442831735</p>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-6">
        <div id="form-message">
          <!-- Message will be displayed here -->
        </div>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" role="form" class="php-email-form">
          <div class="row">
            <div class="col-md-6 form-group">
              <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
            </div>
            <div class="col-md-6 form-group mt-3 mt-md-0">
              <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
            </div>
          </div>
          <div class="form-group mt-3">
            <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
          </div>
          <div class="form-group mt-3">
            <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
          </div>
          <div class="my-3">
            <!-- <div class="loading">Loading</div> -->
            <div class=""><?php echo $message;?></div>
          </div>
          <div class="text-center">
            <button class="" name="submit" type="submit">Send Message</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section><!-- End Contact Section -->

<?php include "includes/footer.php"; ?>

<script>
// Display the message after reload
window.onload = function() {
  const urlParams = new URLSearchParams(window.location.search);
  if (urlParams.has('success') && urlParams.get('success') === '1') {
    document.getElementById('form-message').innerHTML = '<h4 class="alert alert-success text-center">Message Sent Successfully</h4>';
    // Clear the query parameters
    window.history.replaceState(null, null, window.location.pathname);
  }
};
</script>
