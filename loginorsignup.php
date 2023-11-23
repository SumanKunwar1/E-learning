<!-- Header Area Include Start -->
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

<!-- Start Course Page Banner -->
<div class="container-fluid bg-dark">
  <div class="row">
    <video autoplay muted loop style="height:40%; width: 100%; object-fit: cover; opacity: 0.3;">
      <source src="./assets/video/bannerVid.mp4">
    </video>
  </div>
</div>
<!-- End Course Page Banner -->


<div class="container jumbotron mb-5">
  <div class="row mt-5">
    <div class="col-md-4">
      <h5 class="mb-3">If Already Registered !! Login</h5>
      <form role="form" id="stuLoginForm">
        <div class="form-group">
          <i class="fas fa-envelope"></i><label for="email" class="pl-2 font-weight-bold">Email</label><small
            id="statusLogMsg1"></small><input type="email" class="form-control" placeholder="Email" name="email"
            id="email">
        </div>
        <div class="form-group">
          <i class="fas fa-key"></i><label for="pass" class="pl-2 font-weight-bold">Password</label><input
            type="password" class="form-control" placeholder="Password" name="pass" id="pass">
        </div>
        <button type="button" class="btn btn-primary" id="stuLoginBtn" onclick="checkStuLogin()">Login</button>
      </form><br />
      <small id="statusLogMsg"></small>
    </div>
    <div class="col-md-6 offset-md-1">
      <h5 class="mb-3">New User !! Sign Up</h5>
      <form role="form" id="stuRegForm">
        <div class="form-group">
          <i class="fas fa-user"></i><label for="stuname" class="pl-2 font-weight-bold">Name</label><small
            id="statusMsg1"></small><input type="text" class="form-control" placeholder="Name" name="stuname"
            id="stuname">
        </div>
        <div class="form-group">
          <i class="fas fa-envelope"></i><label for="stuemail" class="pl-2 font-weight-bold">Email</label><small
            id="statusMsg2"></small><input type="email" class="form-control" placeholder="Email" name="email"
            id="email">
          <small class="form-text">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
          <i class="fas fa-key"></i><label for="stupass" class="pl-2 font-weight-bold">New
            Password</label><small id="statusMsg3"></small><input type="password" class="form-control"
            placeholder="Password" name="pass" id="pass">
        </div>
        <button type="button" class="btn btn-primary" id="signup" onclick="addStu()">Sign Up</button>
      </form> <br />
      <small id="successMsg"></small>
    </div>
  </div>
</div>
<hr />

<div class="contact-section" id="contact">
        <div class="contact-info">
            <h2>Get in touch</h2>
            <p>If you have any questions or inquiries, please feel free to get in touch with us. We'd love to hear from you!</p>
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

<?php
// Footer Include from mainInclude 
include('./footer.php');
?>