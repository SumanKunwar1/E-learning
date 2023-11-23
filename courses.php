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
    if ($conn->query($sql) == TRUE) {
        // below msg display on form submit success
        $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Your query submitted successfully </div>';
    } else {
        // below msg display on form submit failed
        $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Unable to submit your query</div>';
    }
}
?>
<!-- Header Area Include End -->

<!-- start course page Banner -->
<div class="container-fluid bg-dark">
    <div class="row">
        <video autoplay muted loop style="height:40%; width: 100%; object-fit: cover; opacity: 0.3;">
            <source src="./assets/video/bannerVid.mp4">
        </video>
    </div>
</div>
<!-- end course page banner -->

<!-- Courses Area Start -->
<div class="container mt-5">
    <!-- Start All Course -->
    <h1 class="text-center">All Courses</h1>
    <div class="search-control d-flex justify-content-center">
        <div class="input-group m-4" style="width: 50%;">
            <input type="text" name="searchBox" class="form-control" id="searchBox" placeholder="Search Course..." style="text-align: left;">
            <button class="btn btn-secondary" type="button" style="padding: 0px 20px;font-size: larger;">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>

    <div class="row mt-4" id="search-course">
        <!-- Start All Course Row -->
        <?php
        $sql = "SELECT * FROM course";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $foundRecords = false;
            while ($row = $result->fetch_assoc()) {
                $course_id = $row['course_id'];

                // Retrieve average rating for the course
                $avgRatingSql = "SELECT AVG(f_ratings) AS avg_rating FROM feedback WHERE course_id = '$course_id'";
                $avgRatingResult = $conn->query($avgRatingSql);
                $avgRatingRow = $avgRatingResult->fetch_assoc();
                $avgRating = ($avgRatingRow['avg_rating']) ? round($avgRatingRow['avg_rating'], 1) : 4.5;

                // Check if the search value matches course name or course description
                $searchValue = isset($_GET['search']) ? $_GET['search'] : '';
                $courseName = $row['course_name'];
                $courseDesc = $row['course_desc'];
                if (stripos($courseName, $searchValue) !== false || stripos($courseDesc, $searchValue) !== false) {
                    $foundRecords = true;
                    echo '
                    <div class="col-sm-4 mb-4">
                        <a href="coursedetails.php?course_id=' . $course_id . '" class="btn" style="text-align: left; padding:0px;">
                            <div class="card">
                                <img src="' . str_replace('..', '.', $row['course_img']) . '" class="card-img-top" alt="courseimg" />
                                <div class="card-body">
                                    <h5 class="card-title">' . $courseName . '</h5>
                                    <p class="card-text">' . $courseDesc . '</p>
                                </div>
                                <div class="card-footer">
                                    <div class="rating" style="color:#f7af14;">' . generateStarRating($avgRating) . '</div>
                                    <p class="card-text d-inline">Price: <small><del>&#36;' . $row['course_original_price'] . '</del></small></p>
                                    <span class="font-weight-bolder">&#36;' . $row['course_price'] . '</span>
                                    <a class="btn btn-primary text-white font-weight-bolder float-right" href="coursedetails.php?course_id=' . $course_id . '">Enroll</a>
                                </div>
                            </div>
                        </a>
                    </div>';
                }
            }
            if (!$foundRecords) {
                echo '<div class="col-sm-12">
                        <div class="alert alert-info" role="alert">No records found.</div>
                      </div>';
            }
        }
        ?>
    </div><!-- End All Course Row -->
</div><!-- End All Course -->

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
            <?php if (isset($msg)) {
                echo $msg;
            } ?>
        </form>
    </div>
</div>
<!-- Contact Area End -->
<!-- Footer Area Start -->
<?php
include('./footer.php');
?>
<!-- Footer Area End -->
<script>
    $(document).ready(function () {
        $('#searchBox').on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $("#search-course .col-sm-4").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });
        });

        $('.btn-secondary').click(function () {
            var searchValue = $('#searchBox').val().toLowerCase();
            var courseCards = $("#search-course .col-sm-4");
            var foundRecords = false;

            courseCards.each(function () {
                var courseName = $(this).find('.card-title').text().toLowerCase();
                var courseDesc = $(this).find('.card-text').text().toLowerCase();

                if (courseName.includes(searchValue) || courseDesc.includes(searchValue)) {
                    $(this).show();
                    foundRecords = true;
                } else {
                    $(this).hide();
                }
            });

            if (!foundRecords) {
                $('#search-course').append('<div class="col-sm-12"><div class="alert alert-info" role="alert">No records found.</div></div>');
            }
        });
    });
</script>
