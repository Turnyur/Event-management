<!Doctype html>

<head>     
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />    
	<title><?php echo $page_title; ?></title> 
	<?php foreach ( $css_files as $css ): ?>     
	<link rel="stylesheet" type="text/css" media="screen,projection" 
	href="assets/css/<?php echo $css; ?>" />  <?php endforeach ?>

</head> 	


<body> 
	<div id="page">
		<header>
			<div id="branding">
				<div>
			<span id="meta-menu"><?php   
				if(isset($_SESSION['user'])){
				echo "Welcome, " .$_SESSION['user']['name']." | ".
				"<a href='assets/inc/process.inc.php?action=user_logout&token=$_SESSION[token]'>"
				."Log Out</a>";
			} ?>
		</span>
	</div>
				<figure>
					<!-- <img src="assets/images/interface/travel_worthy.png"alt="site_logo"/> -->
					<figcaption class="slogan"> </figcaption>

				</figure>

				<h3>Event Scheduling Software</h3> 
			</div>
			<div class="container-icon-bar" id="container-icon-bar">
				<div class="bar1"></div>
				<div class="bar2"></div>
				<div class="bar3"></div>
			</div>

			<div class="icon-bar" id="icon-bar"> <!-- This can be called navbar or primary navbar normally. -->
				<a id="home" class="active" href="index.php">Home</a> 
				<!--  Dropdown Menu Button -->
				<a id="calendar" href="javascript:void(0);">Calendar</a>

<?php include 'assets/common/dropdown.inc';  ?>
				<a id="services" href="services.php">About</a>
				<!-- <a id="about" href="about.php">About</a>  -->
				<!-- <a href="#" style="font-size:15px;" class="icon">&#9776;</a> -->

			</div>

	</header>


	<!-- This portion of the code was used for Social Media Linkages -->
<div id="mySidenav" class="sidenav">
  <a href="#" id="android" class="fa fa-android"></a>
  <a href="#" id="facebook" class="fa fa-facebook"></a>
  <a href="#" id="twitter" class="fa fa-twitter"></a>
  <a href="#" id="instagram" class="fa fa-instagram"></a>
  <a href="#" id="youtube" class="fa fa-youtube"></a>
  <a href="#" id="google" class="fa fa-google"></a>
</div>
