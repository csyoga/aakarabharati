<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../../../css/intermediate/font-awesome.min.css"> <!-- CSS reset -->
	<link rel="stylesheet" href="../../../css/intermediate/reset.css"> <!-- CSS reset -->
	<link rel="stylesheet" href="../../../css/intermediate/style.css"> <!-- Resource style -->
	<link rel="stylesheet" href="../../../css/search/style.css">
	<script src="../../../js/intermediate/jquery-2.1.1.js"></script>
	<script src="../../../js/intermediate/jquery.mobile.custom.min.js"></script>
	<script src="../../../js/search/main.js"></script> <!-- Resource jQuery -->
	<script src="../../../js/intermediate/main.js"></script> <!-- Resource jQuery -->
	<script src="../../../js/index/modernizr.js"></script> <!-- Modernizr -->
	<script>
			function sumne()
			{
				var id = document.getElementsByClassName('cd-label');
				id[0]
				( id[0].val() == '' ) ? id[0].prev('.cd-label').removeClass('float') : id[0].prev('.cd-label').addClass('float');
			}
	</script>
	<script src="../../../js/search/keyboard.js"></script> <!-- Modernizr -->
	<title>ಆಧುನಿಕ ಕರ್ನಾಟಕದ ಬೌದ್ಧಿಕ ಇತಿಹಾಸ</title>
</head>
<body>
	<header class="cd-main-header">
		<a class="cd-logo" href="../../../index.php"><i class="fa fa-home fa-2x"></i></a>
		<ul class="cd-header-buttons">
			<li><a class="cd-search-trigger" href="#cd-search">Search<span></span></a></li>
			<li><a class="cd-nav-trigger" href="#cd-primary-nav">Menu<span></span></a></li>
		</ul> <!-- cd-header-buttons -->
	</header>
<?php include("nav.php"); ?>
	<main class="cd-main-content">
<?php include("sec_nav.php"); ?>
		<section id="about">
			<h2>ಪುಸ್ತಕ ಪ್ರಪಂಚ</h2>
			<h4><br>ವಯಸ್ಕರ ಶಿಕ್ಷಣ ಸಮಿತಿ, ಮೈಸೂರು</h4>
			<div id="about_p">
				<div id="keyboard_holder">
					<?php include("keyboard.php");?>
					<form class="cd-form floating-labels" method="GET" action="search-result.php">
						<fieldset onfocus="SetId('searchtext')">
<!--
							<legend>ಲೇಖಕರ ಹೆಸರು, ಪದ, ನಿಯತಕಾಲಿಕೆಯನ್ನು ತಿಳಿಸಿರಿ</legend>
-->
							<div class="icon">
								<label class="cd-label" for="cd-name" id = "sumne1">ಲೇಖಕರ ಹೆಸರು</label>
								<input class="user" type="text" name="author" id="cd-name" onfocus="SetId('cd-name');" onclick="sumne();">
							</div> 
							<div class="icon">
								<label class="cd-label" for="cd-company">ಲೇಖನ</label>
								<input class="company" type="text" name="title" id="cd-company" onfocus="SetId('cd-company')">
							</div> 
							<div class="icon">
								<label class="cd-label" for="cd-email">ಪದ</label>
								<input class="email error" type="text" name="text" id="cd-email" onfocus="SetId('cd-email')">
							</div>
							<div class="icon">
							
							</div>
						</fieldset>
						<input class="company" type="submit" value="ಹುಡುಕು">
					</form>
					</div>
	  </section>
	</main>
	<div id="cd-search" class="cd-search">
		<form>
			<input type="search" placeholder="Search...">
		</form>
	</div>
		   		   <footer>
			  <span>Digital Archives in Indian Languages&nbsp;(DAIL)</span>
          </footer>
	
</body>
</html>
	

