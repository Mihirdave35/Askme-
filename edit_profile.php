<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en"> 


<head>

	<!-- Basic Page Needs -->
	<meta charset="utf-8">
	<title>Ask me</title>

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	
	<!-- Main Style -->
	<link rel="stylesheet" href="style.css">
	
	<!-- Skins -->
	<link rel="stylesheet" href="css/skins/skins.css">
	
	<!-- Responsive Style -->
	<link rel="stylesheet" href="css/responsive.css">
	
	<!-- Favicons -->
	<link rel="shortcut icon" href="images/favicon.png">
  
</head>
<body>

<div class="loader"><div class="loader_html"></div></div>

<div id="wrap" class="grid_1200">
	
	<header id="header">
		<section class="container clearfix">
			<div class="logo"><a href="index.php"><img alt="" src="images/logo.png"></a></div>
			<nav class="navigation">
				<ul>
					<li><a href="index.php">Home</a>
					</li>
					<li class="ask_question"><a href="ask_question.php">Ask Question</a></li>
					<?php

					if(!isset($_SESSION['name']))
						{	

						?>
							<li><a href='login.php'>Login</a></li>
							<?php
	
							}
								else
								{
									echo "<li><a href='edit_profile.php'>".$_SESSION['name']."</a></li>";
   									echo  "<li><a href='logout.php'>Logout</a></li>";
								}

					?>
					
				</ul>
			</nav>
		</section><!-- End container -->
	</header><!-- End header -->
	
	<div class="breadcrumbs">
		<section class="container">
			<div class="row">
				<div class="col-md-12">
					<h1>Edit Profile</h1>
				</div>
				<div class="col-md-12">
					<div class="crumbs">
						<a href="index.php">Home</a>
						<span class="crumbs-span">/</span>
						<span class="current">Edit Profile</span>
					</div>
				</div>
			</div><!-- End row -->
		</section><!-- End container -->
	</div><!-- End breadcrumbs -->
	
	<section class="container main-content">
		<div class="row">
			<div class="col-md-9">
				<div class="page-content">
					<div class="boxedtitle page-title"><h2>Edit Profile</h2></div>
					
					<div class="form-style form-style-4">
						<form method="POST">
							<div class="form-inputs clearfix">
								<p>
									<label>Name</label>
									<input type="text" name="name">
								</p>
								<p>
									<label class="required">E-Mail<span>*</span></label>
									<input type="email" name="userid">
								</p>
								<p>
									<label class="required">Password<span>*</span></label>
									<input type="password" name="password" value="">
								</p>
								<p>
									<label class="required">Confirm Password<span>*</span></label>
									<input type="password" name="confirmpassword" value="">
								</p>
								
							</div>
							<p class="form-submit">
									<input type="submit" name="submit" value="Submit" class="button color small submit">
								</p>
							<div>
							</div>
						</form>
					</div>
				</div><!-- End page-content -->
			</div><!-- End main -->
		</div><!-- End row -->
	</section><!-- End container -->
	
</div>
	<footer id="footer-bottom">
		<section class="container">
			<div class="copyrights f_left">Copyright 2023 Ask me | <a href="#">Mihir Dave</a></div>
			<div>

			</div>
		</section><!-- End container -->
	</footer><!-- End footer-bottom -->
</div><!-- End wrap -->

<div class="go-up"><i class="icon-chevron-up"></i></div>

<!-- js -->
<script src="js/jquery.min.js"></script>
<script src="js/jquery-ui-1.10.3.custom.min.js"></script>
<script src="js/jquery.easing.1.3.min.js"></script>
<script src="js/html5.js"></script>
<script src="js/twitter/jquery.tweet.js"></script>
<script src="js/jflickrfeed.min.js"></script>
<script src="js/jquery.inview.min.js"></script>
<script src="js/jquery.tipsy.js"></script>
<script src="js/tabs.js"></script>
<script src="js/jquery.flexslider.js"></script>
<script src="js/jquery.prettyPhoto.js"></script>
<script src="js/jquery.carouFredSel-6.2.1-packed.js"></script>
<script src="js/jquery.scrollTo.js"></script>
<script src="js/jquery.nav.js"></script>
<script src="js/tags.js"></script>
<script src="js/jquery.bxslider.min.js"></script>
<script src="js/custom.js"></script>
<!-- End js -->

</body>
</html>

<?php
include '../askmedev/model/dbcon.php';
if (isset($_POST['submit'])) {
	$name = mysqli_real_escape_string($conn, $_POST['name']);
	$userid = mysqli_real_escape_string($conn, $_POST['userid']);
	$password = mysqli_real_escape_string($conn,md5($_POST['password']));
	$confirmpassword = mysqli_real_escape_string($conn,md5($_POST['confirmpassword']));
	 
	// echo $name;
	$username = $_SESSION['name'];
		// $pass = md5($password, PASSWORD_BCRYPT);
	

	$useridquery = " SELECT * FROM user where name = '$username' ";
	$query = mysqli_query($conn, $useridquery);
	$res=mysqli_fetch_assoc($query);
	$id=$res['id'];	

	// $useridcount = mysqli_num_rows($query);

	// if ($useridcount > 0) 
	
	// 	{

		if ($password === $confirmpassword) {
			$insertquery = "UPDATE  user SET `name`='$name',`password`='$password',`userid`='$userid' where id=$id ";

			$iquery = mysqli_query($conn, $insertquery);

			if ($iquery) {
		?>
				<script>
					alert("Connection Successful");
				</script>
			<?php
			} else {
			?>
				<script>
					alert("No Connection");
				</script>
			<?php
			}
		} else {
			?>
			<script>
				alert("Password are not match");
			</script>
			<?php
		}
	}
// }






?>