<?php
session_start();
// if(isset($_SESSION['userid']))
// { 
// echo $_SESSION['userid'];
// }
?>

<!DOCTYPE html>
<html lang="en"> <!--<![endif]-->


<head>
	<!-- Basic Page Needs -->
	<meta charset="utf-8">
	<title>Ask Me</title>
	

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

	<!-- <div class="loader">
		<div class="loader_html"></div>
	</div> -->


	<?php include '../askmedev/comman/header.php';
	?>
	<section class="container main-content">
		<div class="row">
			<div class="col-md-9">
				 
			<?php
				include '../askmedev/model/dbcon.php';
				 

					$questionsearch = "SELECT * FROM question" ;
					$query = mysqli_query($conn, $questionsearch);
					$d=$query->num_rows;
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
			
					<div class="tabs-warp question-tab">
						<div class="tab-inner-warp">
							<div class="tab-inner">
								<article class="question question-type-normal">
									<h2>
										<a href="single_question.php?id=<?php echo $row['id'];?> " ><?php echo "Question : " .$row["question"]; ?></a>
									</h2>
									<div class="question-inner">
										<div class="clearfix"></div>
										<p class="question-desc"><?php echo "Question Details : " .$row['qusdetails']; ?></p>
										<div class="question-details">	
										<span class="question-date"><i class="icon-time"></i><?php echo "Create Date : " .$row["createdate"];?></span>
										<span class="question-comment"><i class="icon-comment"></i>  <?php echo $total; ?>  </a></span>
										
										<span class="question-"> <i class="icon-user"></i> <?php echo "Username : " .$row["username"]; ?> </span>
									</div>
								</article>
								<?php

							}
					}	

				?>		
				
			



			</div><!-- End main -->
		</div><!-- End row -->
	</section><!-- End container -->
	<?php include '../askmedev/comman/footer.php'; ?>


</body>
</html>