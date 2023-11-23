<!--  Header Area Start  -->
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
<!--  Header Area End  -->
<!-- Banner Area Start -->
<div class="main-banner" id="top">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="owl-carousel owl-banner">
                    <div class="item item-1">
                        <div class="header-text">
                            <span class="category">Our Courses</span>
                            <h2>With NextGen Teachers, Everything Is Easier</h2>
                            <p>Nextgen is a website where you can explore any courses you want.</p>
                            <div class="buttons">
                                <div class="main-button">
                                    <?php
                                    if (isset($_SESSION['is_login']) || isset($_SESSION['loggedin']) == true) {
                                        echo '<a href="./Learner/learnerProfile.php">View Profile</a>';
                                    } elseif (isset($_SESSION['tloggedin']) == true) {
                                        echo '<a href="./Tutor/tutorProfile.php">View Profile</a>';
                                    } else {
                                        echo '<a href="./l-login.php">Join us</a>';
                                    }
                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item item-2">
                        <div class="header-text">
                            <span class="category">Best Result</span>
                            <h2>Get the best result out of your effort</h2>
                            <p>You can develop your skills by enrolling with us.</p>
                            <div class="buttons">
                                <div class="main-button">
                                    <?php
                                    if (isset($_SESSION['is_login']) || isset($_SESSION['loggedin']) == true) {
                                        echo '<a href="./Learner/learnerProfile.php">View Profile</a>';
                                    } elseif (isset($_SESSION['tloggedin']) == true) {
                                        echo '<a href="./Tutor/tutorProfile.php">View Profile</a>';
                                    } else {
                                        echo '<a href="./l-login.php">Join us</a>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item item-3">
                        <div class="header-text">
                            <span class="category">Online Learning</span>
                            <h2>Online Learning helps you save the time</h2>
                            <p>you can save time and develop skills and practice more coding in less time</p>
                            <div class="buttons">
                                <div class="main-button">
                                    <?php
                                    if (isset($_SESSION['is_login']) || isset($_SESSION['loggedin']) == true) {
                                        echo '<a href="./Learner/learnerProfile.php">View Profile</a>';
                                    } elseif (isset($_SESSION['tloggedin']) == true) {
                                        echo '<a href="./Tutor/tutorProfile.php">View Profile</a>';
                                    } else {
                                        echo '<a href="./l-login.php">Join us</a>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Banner Area End -->

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


<div class="container mt-5">
    <h1 class="text-center p-5">Popular Course</h1>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php
        $sql = "SELECT * FROM course LIMIT 3";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $course_id = $row['course_id'];

                // Retrieve average rating for the course
                $avgRatingSql = "SELECT AVG(f_ratings) AS avg_rating FROM feedback WHERE course_id = '$course_id'";
                $avgRatingResult = $conn->query($avgRatingSql);
                $avgRatingRow = $avgRatingResult->fetch_assoc();
                $avgRating = ($avgRatingRow['avg_rating']) ? round($avgRatingRow['avg_rating'], 1) : 5;
                ?>

                <div class="col">
                    <a href="coursedetails.php?course_id=<?php echo $course_id; ?>" class="btn" style="text-align: left; padding:0px; margin:0px;">
                        <div class="card">
                            <img src="<?php echo str_replace('..', '.', $row['course_img']); ?>" class="card-img-top image" alt="courseImg">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row['course_name']; ?></h5>
                                <p class="card-text"><?php echo $row['course_desc']; ?></p>
                            </div>
                            <div class="card-footer">
                                <div class="rating" style="color:#f7af14;"><?php echo generateStarRating($avgRating); ?></div>
                                <p class="card-text d-inline">Price: <small><del>&#36;<?php echo $row['course_original_price']; ?></del></small></p>
                                <span class="font-weight-bolder">&#36;<?php echo $row['course_price']; ?></span>
                                <a class="btn btn-primary text-white font-weight-bolder float-right" href="coursedetails.php?course_id=<?php echo $course_id; ?>">Enroll</a>
                            </div>
                        </div>
                    </a>
                </div>
                <?php
            }
        }
        ?>
    </div>

    <div class="row row-cols-1 row-cols-md-3 g-4 mt-4">
        <?php
        $sql = "SELECT * FROM course LIMIT 3,3";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $course_id = $row['course_id'];

                // Retrieve average rating for the course
                $avgRatingSql = "SELECT AVG(f_ratings) AS avg_rating FROM feedback WHERE course_id = '$course_id'";
                $avgRatingResult = $conn->query($avgRatingSql);
                $avgRatingRow = $avgRatingResult->fetch_assoc();
                $avgRating = ($avgRatingRow['avg_rating']) ? round($avgRatingRow['avg_rating'], 1) : 5;
                ?>

                <div class="col">
                    <a href="coursedetails.php?course_id=<?php echo $course_id; ?>" class="btn" style="text-align: left; padding:0px;">
                        <div class="card">
                            <img src="<?php echo str_replace('..', '.', $row['course_img']); ?>" class="card-img-top image" alt="courseImg">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row['course_name']; ?></h5>
                                <p class="card-text"><?php echo $row['course_desc']; ?></p>
                            </div>
                            <div class="card-footer">
                                <div class="rating" style="color:#f7af14;"><?php echo generateStarRating($avgRating); ?></div>
                                <p class="card-text d-inline">Price: <small><del>&#36;<?php echo $row['course_original_price']; ?></del></small></p>
                                <span class="font-weight-bolder">&#36;<?php echo $row['course_price']; ?></span>
                                <a class="btn btn-primary text-white font-weight-bolder float-right" href="<?php echo 'coursedetails.php?course_id=' . $course_id . '';?>">Enroll</a>
                            </div>
                        </div>
                    </a>
                </div>
                <?php
            }
        }
        ?>
    </div>

    <div class="text-center m-4">
        <a class="btn btn-danger btn-sm" href="courses.php" style="padding: 10px 20px;">View All Course</a>
    </div>
</div>


<!-- Function to Generate Star Rating -->
<?php
function generateStarRating($rating)
{
    $stars = '';
    $fullStars = floor($rating);
    $halfStar = ceil($rating - $fullStars);

    // Add full stars
    for ($i = 0; $i < $fullStars; $i++) {
        $stars .= '<i class="fas fa-star"></i>';
    }

    // Add half star if applicable
    if ($halfStar) {
        $stars .= '<i class="fas fa-star-half-alt"></i>';
    }

    // Add empty stars
    $emptyStars = 5 - $fullStars - $halfStar;
    for ($i = 0; $i < $emptyStars; $i++) {
        $stars .= '<i class="far fa-star"></i>';
    }

    return $stars;
}
?>
<!-- Courses Area End -->

<!-- Contact Area Start -->
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
<!-- Contact Area End -->
<div class="back-top-section">
    <a href="#" class="back-to-top-btn " id="backToTopBtn">
        <i class="fas fa-arrow-up"></i>
    </a>
</div>

<!-- Footer Area Start -->
<?php
include('./footer.php');
?>
<!-- Footer Area End -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>