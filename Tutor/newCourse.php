<?php 
	define('TITLE', 'Tutor Course');
	define('PAGE', 't_course');
	include('./tutorInclude/header.php'); 
	include_once('../dbConnection.php');
	session_start();

	if (isset($_SESSION['email'])) {
		
	}
	else{
		header('location:index.php');
	}

?>
<body>
	<nav class="navbar navbar-toggleable-sm navbar-inverse bg-inverse p-0">
		<div class="container">
			<button class="navbar-toggler toggler-right" data-target="#mynavbar" data-toggle="collapse">
				<span class="navbar-toggler-icon"></span>
			</button>
			<a href="#" class="navbar-brand mr-3">Tutor Courses</a>
			<div class="collapse navbar-collapse" id="mynavbar">
				<ul class="navbar-nav">
					<li class="nav-item px-2"><a href="#" class="nav-link active">Logged in as <?php echo $_SESSION['email']?></a></li>
				</ul>
				
			</div>
		</div>
	</nav>
	<!--This Is Header-->
	<!-- <header id="main-header" class="bg-primary py-2 text-white">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<h1><i class="fa fa-tachometer"></i> Dashboard</h1>
				</div>
			</div>
		</div>
	</header> -->
	<!--This is section-->
	<section id="sections" class="py-4 mb-4 bg-faded">
		<div class="container">
			<div class="row">
				<div class="col-md"></div>
				<div class="col-md-3">
					<a href="#" class="btn btn-primary btn-block" style="border-radius:0%;" data-toggle="modal" data-target="#addPostModal"><i class="fa fa-plus"></i> Apply to add course</a>
				</div>
				<div class="col-md-3">
					<a href="#" class="btn btn-warning btn-block" style="border-radius:0%;" data-toggle="modal" data-target="#addCateModal"><i class="fa fa-spinner"></i> Pendings</a>
				</div>
				<div class="col-md-3">
					<a href="#" class="btn btn-success btn-block" style="border-radius:0%;" data-toggle="modal" data-target="#addUsertModal"><i class="fa fa-check"></i> Approved Courses</a>
				</div>
				<div class="col-md"></div>
			</div>
		</div>
	
	</section>
	<!----Section2 for showing Post Model ---->
	<section id="post">
		<div class="container">
			<div class="row">
			<table id="tableid" class="table table-bordered table-hover table-striped">
							<thead>
								<th>#</th>
								<th>Course Name</th>
								<th>Course Description</th>
								<th>Course Author</th>
								<th>Course Image</th>
								<th>Course Duration</th>						
								<th>Status</th>
							</thead>
							 <tbody>
							 	<?php 
									$sql = "SELECT * FROM course WHERE email='".$_SESSION['email']."'";
									$que = mysqli_query($conn,$sql);
									$cnt=1;
									while ($result = mysqli_fetch_assoc($que)) {
									?>

									
							 	<tr>
									<td><?php echo $cnt;?></td>
							 		<td><?php echo $result['course_name']; ?></td>
							 		<td><?php echo $result['course_desc']; ?></td>
							 		<td><?php echo $result['course_author']; ?></td>
							 		<td><?php echo $result['course_img']; ?></td>
									 <td><?php echo $result['course_duration']; ?></td>
							 		<td>
							 			<?php 
							 			if ($result['status'] == 0) {
							 				echo "<span class='badge badge-warning'>Pending</span>";
							 			}
							 			else{
							 				echo "<span class='badge badge-success'>Approved</span>";
							 			}
							 	$cnt++;	}
							 		 ?>
							 		</td>
							 	</tr>

							 </tbody>
						</table>
			</div>
		</div>
	</section>
	
 <script>
    $(document).ready(function () {
        $('#tableid').DataTable();
    });
</script>