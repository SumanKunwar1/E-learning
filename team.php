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
    if ($conn->query($sql) == TRUE) {
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
<!-- Team Area Start -->
<!-- Team Area Start -->
<div class="team section" id="team" style="margin-top: 9rem">
    <div class="container">
        <h2>Our Team</h2>
        <div class="row" style="flex: 0 0 290px;">
            <?php
            $sql = "SELECT * FROM team";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $team_id = $row['team_id'];
                    echo '
                <div class="col-lg-3 col-md-6">
                <div class="team-member">
                    <div class="main-content">
                    <div>
                    <img src="' . str_replace('..', '.', $row['team_image']) . '" alt="teamImage" style="    max-height: 170px;
                    height: 160px;
                    width:auto;
                    min-height: 150px;">
                    </div>
                        <span class="category">' . $row['team_position'] . '</span>
                        <h4>' . $row['team_name'] . '</h4>
                        <ul class="social-icons">
                            <li><a href="' . $row['team_fb'] . '"><i class="fab fa-facebook"></i></a></li>
                            <li><a href="' . $row['team_twitter'] . '"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="' . $row['team_linkedin'] . '"><i class="fab fa-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>';
                }
            }
            ?>

        </div>
    </div>
</div>
<!-- Team Area End -->

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
            <?php if (isset($msg)) {
                echo $msg;
            } ?>
        </form>
    </div>
</div>
<!-- Contact Area End -->

<?php

include('./footer.php');
?>