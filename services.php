
<?php
include('./dbConnection.php');
include('./header.php');
// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Retrieve the form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

   $sql = "INSERT into contact(contact_name, contact_email, contact_message)
   values('$name', '$email', '$message')";
   if($conn->query($sql) == TRUE){
    // below msg display on form submit success
    $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Your query submitted successfully </div>';
   } else {
    // below msg display on form submit failed
    $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Unable to submit your query</div>';
   }
}
?>

<div class="container-fluid bg-dark">
    <div class="row">
        <video autoplay muted loop style="height:40%; width: 100%; object-fit: cover; opacity: 0.3;">
            <source src="./assets/video/bannerVid.mp4">
        </video>
    </div>
</div>

<!-- Services Area Start -->
<div class="section services" id="services">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-1">
                <div class="accordion" id="accordionExample">
                    <?php
                    // Fetch services from the database
                    $sql = "SELECT * FROM services";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        $counter = 1;
                        while ($row = $result->fetch_assoc()) {
                            $serviceId = $row['service_id'];
                            $serviceTitle = $row['service_title'];
                            $serviceDescription = $row['service_desc'];
                            ?>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading<?php echo $counter; ?>">
                                    <button class="accordion-button <?php echo ($counter === 1) ? 'collapsed' : ''; ?>"
                                        type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse<?php echo $counter; ?>"
                                        aria-expanded="<?php echo ($counter === 1) ? 'true' : 'false'; ?>"
                                        aria-controls="collapse<?php echo $counter; ?>">
                                        <?php echo $serviceTitle; ?>
                                    </button>
                                </h2>
                                <div id="collapse<?php echo $counter; ?>"
                                    class="accordion-collapse collapse <?php echo ($counter === 1) ? 'show' : ''; ?>"
                                    aria-labelledby="heading<?php echo $counter; ?>" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <?php echo $serviceDescription; ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $counter++;
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="col-lg-5 align-self-center">
                <div class="section-heading">
                    <h6>Our Services</h6>
                    <h2>What makes us the best online learning platform?</h2>
                    <p>By offering expertly crafted courses and engaging learning materials, we can provide learners
                        with a top-notch educational experience that is both effective and enjoyable.</p>
                    <div class="main-button">
                        <a href="./services.php">Discover More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Services Area End -->

<!-- Contact Area Start -->
<div class="contact-section" id="contact">
    <div class="contact-info">
        <h2>Get in touch</h2>
        <p>If you have any questions or inquiries, please feel free to get in touch with us. We'd love to hear from you!
        </p>
    </div>
    <div class="contact-form">
        <h2>Contact us</h2>
        <form action="#" method="POST">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" placeholder="Your Name..." required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Your E-mail..." required>
            </div>
            <div class="form-group">
                <label for="message">Message:</label>
                <textarea id="message" name="message" rows="5" placeholder="Write your message..." required></textarea>
            </div>
            <input type="submit" name="submit" value="Send">
            <?php if(isset($msg)) {echo $msg; } ?>
        </form>
    </div>
</div>
<!-- Contact Area End -->
<?php

include('./footer.php');
?>