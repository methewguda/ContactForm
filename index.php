<?php

 /**
  * Homepage
  */

 // Initialisation
 require_once('includes/init.php');

 // Set the title, show the page header, then the rest of the HTML
 $page_title = 'Home';
 include('includes/header.php');

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {

   $contact = Contact::sendFeedback($_POST);

   if (empty($contact->errors)) {

     // Redirect to home page
     Util::redirect('index.php');
   }
 }

?>

<section id="contact">
	<div class= "container">
		<div class="row">
			<div class="col-md-6">

				<h1>Contact Form</h1>
				<p>Send a message via the form below.</p>

				<form method="POST" role="form">
					<div class="form-group">
						<input type="text" name="name" id="name" class="form-control" placeholder="Your Name">
					</div>
					<div class="form-group">
						<input type="email" name="email" id="email" class="form-control" placeholder="Your Email">
					</div>
					<div class="form-group">
						<input type="text" name="subject" id="subject" class="form-control" placeholder="Your Subject">
					</div>
					<div class="form-group">
						<textarea rows="5" name="message" id="message" class="form-control" placeholder="Your Message..."></textarea>
					</div>
					<div align="center">
						<input type="submit" name="submit" class="btn btn-secondary" value="Send Message">
					</div>

				</form>

			</div>
			<div class="col-md-6">

                <div class="details">
                    <h2>This is a responsive ontact form.</h2><br><br>
                    <p>
                        This is a fully functional responsive contact form developed with PHP, Bootstrap and PHPmailer.
                        <br><br>
                        If you want to test it, please send a feedback and I will send you a replay.
                    </p>
                </div>
                <div class="error-log">
                    <h3>Any errors or feedback will display here:</h3>
                    <?php if (isset($contact)): ?>
                        <ul>
                            <?php foreach ($contact->errors as $error): ?>
                                <li><?php echo $error; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>

			</div>

		</div>
	</div>
</section>

<?php

// Show the page footer at the end of the page.
include('includes/footer.php');
?>
