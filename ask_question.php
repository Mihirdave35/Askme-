<?php

	session_start();
	// echo $_SESSION['userid'];

		if(!isset($_SESSION['name']))
		{
			// echo "error";
			header('Location: login.php');
		}

?>


<!DOCTYPE html>
<html lang="en">
<!--<![endif]-->

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

	<div id="wrap" class="grid_1200">
	<header id="header">
    <section class="container clearfix">
        <div class="logo"><a href="index.php"><img alt="" src="images/logo.png"></a></div>
        <nav class="navigation">
            <ul>
                <li class="home"><a href="index.php">Home</a>
                </li>
                <li class="current_page_item"><a href="ask_question.php">Ask Question</a></li>
                <!-- <li><a href="cat_question.html">Questions</a>
						<ul>
							<li><a href="cat_question.html">Questions Category</a></li>
							<li><a href="single_question.html">Question Single</a></li>
							<li><a href="single_question_poll.html">Poll Question Single</a></li>
						</ul>
					</li> -->

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
						<h1>Ask Question</h1>
					</div>
					<div class="col-md-12">
						<div class="crumbs">
							<a href="index.php">Home</a>
							<span class="crumbs-span">/</span>
							<span class="current">Ask Question</span>
						</div>
					</div>
				</div><!-- End row -->
			</section><!-- End container -->
		</div><!-- End breadcrumbs -->

		<section class="container main-content">
			<div class="row">
				<div class="col-md-9">

					<div class="page-content ask-question">
						<div class="boxedtitle page-title">
							<h2>Ask Question</h2>
						</div>

						<div class="form-style form-style-3" id="question-submit">
							<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
								<div class="form-inputs clearfix">
									<p>
										<label class="required">Question Title<span>*</span></label>
										<input type="text" id="question-title" name="question" required="required" >
										<span class="form-description">Please choose an appropriate title for the
											question to answer it even easier .</span>
									</p>
								<div id="form-textarea">
									<p>
										<label class="required">Details<span>*</span></label>
										 
										<textarea name="questiondetails"  required="required" id="question-details" aria-required="true" cols="58"
											rows="8"></textarea>
										<span class="form-description">Type the description thoroughly and in detail
											.</span>
									</p>
								</div>
								<p class="form-submit">
									<input type="submit" id="publish-question" name="submit" value="Publish Your Question"
										class="button color small submit">
								</p>
							</form>
						</div>
					</div><!-- End page-content -->
				</div><!-- End main -->
			</div><!-- End row -->
		</section><!-- End container -->
		<footer id="footer-bottom">
			<section class="container">
				<div class="copyrights f_left">Copyright 2023 Ask me | <a href="index.php">By Mihir Dave</a></div>
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
<?php 
include '../askmedev/model/dbcon.php';

if(isset($_REQUEST['submit'])){ 
	

  $ques = mysqli_real_escape_string($conn, $_POST['question']);
  $quesdetails = mysqli_real_escape_string($conn, $_POST['questiondetails']);
  $username = $_SESSION['name'];

  $insertquery = "INSERT INTO question ( question , qusdetails ,username ) VALUES ('$ques','$quesdetails','$username')";
     
  $iquery = mysqli_query($conn, $insertquery); 
  if($iquery > 0)
  {
	?>
	<script>
			
			location.replace("index.php");
		</script>
		<?php
  }

}


?>							