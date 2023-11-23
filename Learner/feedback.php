<?php
if (!isset($_SESSION)) {
    session_start();
}

define('TITLE', 'Feedback');
define('PAGE', 'feedback');
include_once('../dbConnection.php');
include('./learnerInclude/header.php');

if (isset($_SESSION['is_login'])) {
    $l_Email = $_SESSION['stuLogEmail'];
} else if (isset($_SESSION['loggedin'])) {
    $l_Email = $_SESSION['email'];
}
$sql = "SELECT * FROM learner WHERE l_Email='$l_Email'";
$result = $conn->query($sql);
if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $lId = $row["l_Id"];
}
// Check if the course_id parameter is present in the URL
if (isset($_REQUEST['course_id'])) {
    $course_id = $_REQUEST['course_id'];

    // Retrieve the course details from the database using the course_id
    $sql = "SELECT * FROM course WHERE course_id = '$course_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $course_name = $row['course_name'];
        $course_desc = $row['course_desc'];
        $course_img = $row['course_img'];
    }
}

// Process the feedback form submission
if (isset($_POST['submit'])) {
    // Get the submitted feedback data
    $rating = $_POST['rating'];
    $review = htmlspecialchars($_POST['review']);

    // Insert the feedback into the database
    $insertSql = "INSERT INTO feedback (f_content, l_Id, f_ratings, course_id) VALUES ('$review', '$lId', '$rating', '$course_id')";
    if ($conn->query($insertSql) === TRUE) {
        $passmsg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Submitted Successfully </div>';
    } else {
        $errormsg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Unable to submit the feedback </div>';
    }
}
?>

<!-- HTML code with Bootstrap CSS -->
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h4>Leave Feedback</h4>
            <div class="card mb-3">
                <img src="<?php echo $course_img; ?>" class="card-img-top" alt="Course Image">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $course_name; ?></h5>
                    <p class="card-text"><?php echo $course_desc; ?></p>
                </div>
            </div>
            <form method="POST" action="">
                <div class="form-group">
                    <label for="rating">Rating:</label>
                    <div class="star-rating">
                        <input type="radio" id="star5" name="rating" value="5" />
                        <label for="star5" title="5 stars"></label>
                        <input type="radio" id="star4" name="rating" value="4" />
                        <label for="star4" title="4 stars"></label>
                        <input type="radio" id="star3" name="rating" value="3" />
                        <label for="star3" title="3 stars"></label>
                        <input type="radio" id="star2" name="rating" value="2" />
                        <label for="star2" title="2 stars"></label>
                        <input type="radio" id="star1" name="rating" value="1" />
                        <label for="star1" title="1 star"></label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="review">Review:</label>
                    <textarea class="form-control" id="review" name="review" rows="5"></textarea>
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Submit Feedback</button>
                <?php if (isset($passmsg)) {
                    echo $passmsg;
                } ?>
            </form>
        </div>
    </div>
</div>

<!-- Add Font Awesome CDN for star icons -->
<script src="https://kit.fontawesome.com/your-font-awesome-kit.js" crossorigin="anonymous"></script>

<style>
    .star-rating {
        display: inline-block;
        unicode-bidi: bidi-override;
        color: #c5c5c5;
        font-size: 25px;
        height: 25px;
        min-width: 125px;
        margin: 0 auto;
        position: relative;
        padding: 0;
        text-shadow: 1px 1px #bbb;
    }

    .star-rating input {
        display: none;
    }

    .star-rating label {
        color: #c5c5c5;
        font-size: 25px;
        float: right;
        transition: color 0.2s;
        cursor: pointer;
    }

    .star-rating label:before {
        content: "\f005";
        font-family: "Font Awesome 5 Free";
        font-weight: 900;
        display: inline-block;
        margin-right: 5px;
    }

    .star-rating input:checked~label {
        color: #FFC107;
    }

    .star-rating label:hover,
    .star-rating label:hover~label {
        color: #FFC107;
    }
</style>
