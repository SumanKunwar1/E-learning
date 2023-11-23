
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

<!-- Start Students Testimonial -->
<div class="container-fluid mt-5"  id="Feedback">
  <h1 class="text-center p-5" style="color:#000;"> Student's Feedback </h1>
  <div class="row">
    <div class="col-md-12">
      <div id="testimonial-slider" class="owl-carousel" >
        <?php
        $sql = "SELECT l.l_Name, l.l_occ, l.l_img, f.f_content FROM learner AS l JOIN feedback AS f ON l.l_id = f.l_id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            $s_img = $row['l_img'];
            $n_img = str_replace('../', '', $s_img)
              ?>
            <div class="testimonial" style="background-color: #b8c3df; width: 413px; min-width: 400px; min-height: 415px; max-height: 450px; height: 420px; margin: 0px 7px 0px 7px;">
              <p class="description">
                <?php echo $row['f_content']; ?>
              </p>
              <div class="pic">
                <img src="<?php echo $n_img; ?>" alt="" />
              </div>
              <div class="testimonial-prof">
                <h4 style="color: #9745b1;">
                  <?php echo $row['l_Name']; ?>
                </h4>
                <small>
                  <?php echo $row['l_occ']; ?>
                </small>
              </div>
            </div>
          <?php }
        } ?>
      </div>
    </div>
  </div>
</div> <!-- End Students Testimonial -->

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