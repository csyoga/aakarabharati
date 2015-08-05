<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/intermediate/font-awesome.min.css"> <!-- CSS reset -->
	<link rel="stylesheet" href="css/intermediate/reset.css"> <!-- CSS reset -->
	<link rel="stylesheet" href="css/intermediate/style.css"> <!-- Resource style -->
	<script src="js/intermediate/modernizr.js"></script> <!-- Modernizr -->
  	<script src="http://maps.googleapis.com/maps/api/js"></script>
	<script>
		function initialize() {
		var mapProp = {
		center:new google.maps.LatLng(12.4243894,76.6903270),
		zoom:17,
		mapTypeId:google.maps.MapTypeId.ROADMAP
		};
		var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
		}
		google.maps.event.addDomListener(window, 'load', initialize);
	</script>
	<title>ಆಕರಭಾರತಿ</title>
</head>
<body>
	<header class="cd-main-header">
		<a class="cd-logo" href="../index.html"><i class="fa fa-home fa-2x"></i></a>

		<ul class="cd-header-buttons">
			<li><a class="cd-search-trigger" href="#cd-search">Search<span></span></a></li>
			<li><a class="cd-nav-trigger" href="#cd-primary-nav">Menu<span></span></a></li>
		</ul> <!-- cd-header-buttons -->
	</header>
	
	<main class="cd-main-content">
		<section id="about">
			<h2>ಸಂಪರ್ಕಿಸಿ</h2>
			<div id="about_p" class="center">
				<p>ಶ್ರೀರಂಗ ಡಿಜಿಟಲ್ ಟೆಕ್ನೋಲಜೀಸ್</p><br />
					<p>೧ನೇ ಅಡ್ಡ ರಸ್ತೆ,<br />ರಂಗನಾಥನಗರ, ಶ್ರೀರಂಗಪಟ್ಟಣ<br />
					   ದೂರವಾಣಿ&nbsp;:&nbsp;+೯೧ ೮೨೩೬ ೨೯೨೪೩೨<br />ಇ-ಮೇಲ್<blockquote>info@aakarabharati.in</blockquote></p><br />
					   <div id="googleMap" style="width:900px;height:380px;"></div><br /><br /><br />
			</div>
	  </section>
	</main>
   <?php include("nav.php"); ?>
	<div id="cd-search" class="cd-search">
		<form>
			<input type="search" placeholder="Search...">
		</form>
	</div>
		 <?php include("footer.php"); ?>
