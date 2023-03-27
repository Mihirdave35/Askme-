<?php
session_start(); 
if(isset($_SESSION['name']))
{
	header("location: index.php");
}

?>
<!DOCTYPE html>
<html lang="en"> <!--<![endif]-->

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

	<div class="loader">
		<div class="loader_html"></div>
	</div>

	<header id="header">
    <section class="container clearfix">
        <div class="logo"><a href="index.php"><img alt="" src="images/logo.png"></a></div>
        <nav class="navigation">
            <ul>
                <li class="home"><a href="index.php">Home</a>
                </li>
                <li><a href="ask_question.php">Ask Question</a></li>
                <!-- <li><a href="cat_question.html">Questions</a>
						<ul>
							<li><a href="cat_question.html">Questions Category</a></li>
							<li><a href="single_question.html">Question Single</a></li>
							<li><a href="single_question_poll.html">Poll Question Single</a></li>
						</ul>
					</li> -->

                <li class="current_page_item"><a href="login.php">Login</a></li>
            </ul>
        </nav>
    </section><!-- End container -->
</header><!-- End header -->

		<div class="breadcrumbs">
			<section class="container">
				<div class="row">
					<div class="col-md-12">
						<h1>Login</h1>
					</div>
					<div class="col-md-12">
						<div class="crumbs">
							<a href="index.php">Home</a>
							<span class="crumbs-span">/</span>
							<span class="current">Login</span>
						</div>
					</div>
				</div><!-- End row -->
			</section><!-- End container -->
		</div><!-- End breadcrumbs -->

		<section class="container main-content">
			<div class="login">
				<div class="row">
					<div class="col-md-6">
						<div class="page-content">
							<h2>Login</h2>
							<div class="form-style form-style-3">
								<form action="" method="POST">
									<div class="form-inputs clearfix">
										<p class="login-text">
											<input type="text"  name= "userid"  required="required">
											<i class="icon-user"></i>
										</p>
										<p class="login-password">
											<input type="password" name="password"  required="required">
											<i class="icon-lock"></i>
										
										</p>
									</div>
									<p class="form-submit login-submit">
										<input type="submit" name="submitt" value="Log in" class="button color small login-submit submit">
									</p>
								</form>
							</div>
						</div><!-- End page-content -->
					</div><!-- End col-md-6 -->
					<div class="col-md-6">
						<div class="page-content">
							<h2>Register Now</h2>
							<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
								<div class="for-style form-style-3">

									<label clamss="required">Name<span>*</span></label>
									<input type="text" name="name" required="required ">
									<label class="required">E-Mail<span>*</span></label>
									<input type="email" name="userid" required="required">
									<label class="required">Password<span>*</span></label>
									<input type="password" value="" name="password" required="required">
									<label class="required">Confirm Password<span>*</span></label>
									<input type="password" value="" name="confirmpassword" required="required">

								</div>

								<p class="form-submit">
									<input type="submit" name="submit" value="Signup" class="button color small submit">
								</p>
							</form>
						</div>
						<!-- <a class="button small color signup">Create an account</a> -->
					</div><!-- End page-content -->
				</div><!-- End col-md-6 -->
			</div><!-- End row -->
	</div><!-- End login -->
	</section><!-- End container -->
	<footer id="footer-bottom">
		<section class="container">
			<div class="copyrights f_left">Copyright 2023 Ask me | <a href="#">By Mihir Dave</a></div>
			<div class="social_icons f_right">
			</div><!-- End social_icons -->
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
<!-- //  Register php -->
<?php

include '../askmedev/model/dbcon.php';
if (isset($_POST['submit'])) {
	$name = mysqli_real_escape_string($conn, $_POST['name']);
	$userid = mysqli_real_escape_string($conn, $_POST['userid']);
	$password = mysqli_real_escape_string($conn,md5($_POST['password']));
	$confirmpassword = mysqli_real_escape_string($conn,md5($_POST['confirmpassword']));

		// $pass = md5($password, PASSWORD_BCRYPT);
		

	$useridquery = " SELECT * FROM user where userid = '$userid' ";
	$query = mysqli_query($conn, $useridquery);

	$useridcount = mysqli_num_rows($query);

	if ($useridcount > 0) {
?>
		<script>
			alert("E-mail alredy exists");
		</script>
		<?php
	} else {
		if ($password === $confirmpassword) {
			$insertquery = "INSERT INTO  user  (name, userid, password) VALUES ('$name','$userid','$password')";

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
}
?>

<!-- // login php -->
<?php	
  include '../askmedev/model/dbcon.php';
  if(isset($_POST['submitt']))
  {
	$userid = mysqli_real_escape_string($conn, $_POST['userid']);
	$password = mysqli_real_escape_string($conn,md5( $_POST['password']));
  

	

	$userid_serach = "SELECT * FROM user WHERE userid='$userid' AND password='$password'";
	$query = mysqli_query($conn,$userid_serach); 
   
	 $userid_count = mysqli_num_rows($query);
	  if($userid_count > 0){ 
	    $useridpass = mysqli_fetch_assoc($query); 
		  
		 $dbpass = $useridpass['password'];
		 $_SESSION['name'] = $useridpass['name'];
		 

		 header("location: index.php");
		      
	    	if($dbpass){ 
			?>
			<script>
					alert("login successful");
				</script>
			<script>
			  location.replace("index.php");
			</script>
			<?php
		}else 
			?>
			<script>
					alert("password not match");
				</script>
				<?php

	  }else{
	 	?>
 	    <script>
				alert("invalid email");
	 		</script>
			<?php
	  }

  }  
?> 