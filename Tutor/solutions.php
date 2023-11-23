<?php
if (!isset($_SESSION)) {
    session_start();
}
define('TITLE', 'Solutions');
define('PAGE', 'solutions');
include('./tutorInclude/header.php');
include('../dbConnection.php');

if (isset($_SESSION['tloggedin'])) {
    $tutorEmail = $_SESSION['email'];
}

if (isset($_REQUEST['view'])) {
    $sql = "SELECT * FROM report WHERE report_Id = {$_REQUEST['id']}";
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $title = $row['Title'];
    }
}

$msg = ""; // Initialize an empty message

if (isset($_POST['submitRequest'])) {
    $reportId = $_POST['id'];
    if ($_POST['solution'] == "") {
        $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert">Please provide a solution</div>';
    } else {
        $solution = htmlspecialchars($_POST['solution']);
        $sql = "UPDATE report SET solution = '$solution' WHERE report_Id = $reportId ";
        if ($conn->query($sql) === TRUE) {
            $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert">Solution submitted successfully</div>';
          
        }
         else {
            $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert">Unable to submit the solution</div>';
        }
    }
}

?>

<div class="col-sm-6 mt-5 mx-3 jumbotron">
    <h3 class="text-center">Solution</h3>

    <form action="" method="POST" enctype="multipart/form-data">

        <div class="form-group">
            <label for="title">Title</label>
            <textarea class="form-control" id="title" name="title" readonly><?php if (isset($title)) {echo $title;} ?></textarea>
        </div>
        <div class="form-group">
            <label for="solution">Solution to the problem:</label>
            <textarea class="form-control" id="solution" name="solution" rows="3"></textarea>
        </div>
        <div class="text-center">
            <input type="hidden" name="id" value="<?php echo $_POST['id']; ?>">
            <button type="submit" class="btn btn-danger" id="submitRequest" name="submitRequest">Submit</button>
            <a href="solve.php" class="btn btn-secondary">Close</a>
        </div>
        <?php echo $msg; ?>
    </form>
</div>
</div> <!-- div Row close from header -->
</div> <!-- div Container-fluid close from header -->

<?php
include('./tutorInclude/footer.php');
?>
