<?php
session_start();
if (!isset($_SESSION['name'])) {
	// echo "error";
	header('Location: login.php');
}


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

	<div class="loader">
		<div class="loader_html"></div>
	</div>

	<div id="wrap" class="grid_1200">

		<header id="header">
			<section class="container clearfix">
				<div class="logo"><a href="index.php"><img alt="" src="images/logo.png"></a></div>
				<nav class="navigation">
					<ul>
						<li><a href="index.php">Home</a>
						</li>
						<li class="ask_question.php"><a href="ask_question.php">Ask Question</a></li>

						<?php

						if (!isset($_SESSION['name'])) {

						?>
							<li><a href='login.php'>Login</a></li>
						<?php

						} else {
							echo "<li><a href='#'>" . $_SESSION['name'] . "</a></li>";
							echo  "<li><a href='logout.php'>Logout</a></li>";
						}

						?>
					</ul>
				</nav>
			</section><!-- End container -->
		</header><!-- End header -->

		<?php 
		include '../askmedev/model/dbcon.php';
				 
		 $id =  $_GET["id"] ;
		
		
		$questionsearch = "SELECT * FROM question where `id`='".$id."'" ;
		$query = mysqli_query($conn, $questionsearch);
		  
		if ($query->num_rows>0)
					{
						while($row=mysqli_fetch_array($query))
						{
						
							$i=$row['id'];
							$sql="select count(*) as total from answer where questionid=$i;";
							$res=mysqli_query($conn,$sql);
							$result=mysqli_fetch_assoc($res);
							$total=$result['total'];
							// echo "Question : " .$row["question"];
							// echo "<br>";
							// echo "Question Details : " .$row['qusdetails'];	
							// echo "<br>";
				    		//  echo "username : " .$row["username"];
					        //   echo "Create Date : " .$row["createdate"];						

 						?> 
		<section class="container main-content margin-top">
			<div class="row">
				<div class="col-md-9">
					<article class="question single-question question-type-normal">
						<h2>
							<a href="single_question.php"><?php echo "Question : " .$row["question"]; ?></a>
						</h2>
						<div class="question-inner">
							<div class="clearfix"></div>
							<div class="question-desc">
								<p> <?php echo "Question Details : " .$row['qusdetails'];	 ?></p>
								
							</div>
							<span class="question-date"><i class="icon-time"></i><?php echo "Create Date : " .$row["createdate"];?> </span>
							<span class="question-comment"><a href="#"><i class="icon-comment"></i>  <?php echo $total; ?>  </a></span>
							
							<span class="question-"> <i class="icon-user"></i> <?php echo "Username : " .$row["username"]; ?> </span>
							<ul>
							</ul>
							<div class="clearfix"></div>
						</div>
					</article>
               <?php
						}
					
					}
			   ?>
			   <div id="commentlist" class="page-content">
						<div class="boxedtitle page-title">
							<h2>Answers ( <span class="color"><?php echo $total; ?> </span> )</h2>
						</div>
            <?php 
		include '../askmedev/model/dbcon.php';
				 
		 $id =  $_GET["id"] ;
		
		
		$questionsearch = "SELECT * FROM answer where  questionid ='".$id."'" ;
		$query = mysqli_query($conn, $questionsearch);
		  
		if ($query->num_rows>0)
					{
						while($row=mysqli_fetch_array($query))
						{
						
							
												
					 ?>
					
						<ol class="commentlist clearfix">
							<li class="comment">
								<div class="comment-body comment-body-answered clearfix">
									<div class="comment-text">
										<div class="author clearfix">
											<div class="comment-author"><a href="#"><?php echo $row["userid"] ?></a></div>
					
											
											<div class="comment-meta">
												<div class="date"><i class="icon-time"></i> <?php echo $row["createdate"] ?> </div>
											</div>

											</div>
										<div class="text">
											<p><?php echo $row["answer"]?> </p>
										</div>
										
									</div>
								</div>
								
							</li>
							
						</ol><!-- End commentlist -->
					<!-- End page-content -->
					<?php
				}
			}

		 ?>
			</div>
					<div id="respond" class="comment-respond page-content clearfix">
						<div class="boxedtitle page-title">
							<h2>Leave a reply</h2>
						</div>
						<form action="" method="POST" id="commentform" class="comment-form">
							<div id="respond-textarea">
								<p>
									<label class="required" required="required" for="comment">Answer<span>*</span></label>
									<textarea id="comment" required="required" name="comment" aria-required="true" cols="58" rows="8"></textarea>
								</p>
							</div>
							<p class="form-submit">
								<input name="submit"   type="submit" id="submit" value="Post your Answer" class="button small color">
							</p>
						</form>
						
					</div>

				</div><!-- End main -->
			</div><!-- End row -->
		</section><!-- End container -->
		<footer id="footer-bottom">
			<section class="container">
				<div class="copyrights f_left">Copyright 2023 Ask me | <a href="">Mihir Dave</a></div>
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
 
if (isset($_REQUEST['submit']))
{
  	$comment =  mysqli_real_escape_string($conn, $_POST['comment']);
	$username = $_SESSION['name'];
	$id =  $_GET["id"] ;

	$insertquery = "INSERT INTO answer( questionid, userid, answer ) VALUES ('$id','$username','$comment')";

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