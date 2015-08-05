<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/intermediate/font-awesome.min.css"> <!-- CSS reset -->
	<link rel="stylesheet" href="css/intermediate/reset.css"> <!-- CSS reset -->
	<link rel="stylesheet" href="css/intermediate/style.css"> <!-- Resource style -->
	<link rel="stylesheet" href="css/search/style.css">
	<script src="js/index/modernizr.js"></script> <!-- Modernizr -->
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

<?php include("nav.php"); ?>
	<main class="cd-main-content">
		<section id="about">
			<h2>ಹುಡುಕು</h2>
			<div id="about_p">
				<div id="check_box">
					<table class="check_box">
						<tr>
							<td>
								<input type="checkbox" name="check[]" value="sak" id="check_sak" checked/>&nbsp;<label for="check_sak">ಸಾಕ್ಷಿ</label><br />
								<input type="checkbox" name="check[]" value="sam" id="check_sam" checked/>&nbsp;<label for="check_sam">ಸಂವಾದ</label><br />
								<input type="checkbox" name="check[]" value="maa" id="check_maa" checked/>&nbsp;<label for="check_maa">ನೀನಾಸಮ್ ಮಾತುಕತೆ</label><br />
								<input type="checkbox" name="check[]" value="pp" id="check_pp" checked/>&nbsp;<label for="check_pp">ಪುಸ್ತಕ ಪ್ರಪಂಚ</label><br />
								<input type="checkbox" name="check[]" value="ab" id="check_ab" checked/>&nbsp;<label for="check_ab">ಅರಿವು ಬರಹ</label><br />
								<input type="checkbox" name="check[]" value="rb" id="check_rb" checked/>&nbsp;<label for="check_rb">ರಂಗಭೂಮಿ</label><br />
							</td>
						</tr>
					</table>
				</div>
				<form class="cd-form floating-labels" method="get" action="search-result.php">
		<fieldset>
			
			<legend>ಲೇಖಕರ ಹೆಸರು, ಪದ, ನಿಯತಕಾಲಿಕೆಯನ್ನು ತಿಳಿಸಿರಿ</legend>
			<div class="icon">
				<label class="cd-label" for="cd-name">ಲೇಖಕರ ಹೆಸರು</label>
				<input class="user" type="text" name="author" id="cd-name">
		    </div> 

		    <div class="icon">
		    	<label class="cd-label" for="cd-company">ಲೇಖನ</label>
				<input class="company" type="text" name="title" id="cd-company">
		    </div> 

		    <div class="icon">
		    	<label class="cd-label" for="cd-email">ಪದ</label>
				<input class="email error" type="text" name="text" id="cd-email">
		    </div>
			<div>
		      	<input class="company" type="submit" value="ಹುಡುಕು">
		    </div>
		</fieldset>
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
			<script src="js/intermediate/jquery-2.1.1.js"></script>
	<script src="js/intermediate/jquery.mobile.custom.min.js"></script>
	<script src="js/intermediate/main.js"></script> <!-- Resource jQuery -->
	<script src="js/search/main.js"></script> <!-- Resource jQuery -->
	
</body>
</html>
	

