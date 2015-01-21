<!DOCTYPE html>
<html>
  <head>
    <title> ಆಧುನಿಕ ಕರ್ನಾಟಕದ ಬೌದ್ಧಿಕ ಇತಿಹಾಸ</title>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- css -->
    <link href="../../../css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="../../../css/style.css" rel="stylesheet" media="screen">
    <link href="../../../css/hover.css" rel="stylesheet" media="screen">
	<link href="../../../color/default.css" rel="stylesheet" media="screen">
	<script src="../../../js/modernizr.custom.js"></script>
      </head>
  <body>
	<div class="menu-area">
			<div id="dl-menu" class="dl-menuwrapper">
						<button class="dl-trigger">Open Menu</button>
						<ul class="dl-menu">
							<li>
								<a href="../../../index.html#intro">ಮುಖಪುಟ</a>
							</li>
							<li><a href="../../../index.html#about">ಪಕ್ಷಿನೋಟ</a></li>
							<li><a href="../../../index.html#services">ಸೇವೆಗಳು</a></li>
							<li><a href="../../../index.html#works">ಸಂಗ್ರಹ</a></li>
							<li><a href="../../../index.html#contact">ಸಂಪರ್ಕ</a></li>
							<li>
								<a href="#">ಸಾಕ್ಷಿ</a>
								<ul class="dl-submenu">
									<li><a href="../sakshi.html"><i class="fa fa-home"></i>&nbsp;&nbsp;ಮುಖಪುಟ</a></li>
									<li><a href="volumes_list.html"><i class="fa fa-book"></i>&nbsp;&nbsp;ಸಂಪುಟಗಳು</a></li>
									<li><a href="articles.php"><i class="fa fa-pencil"></i>&nbsp;&nbsp;ಲೇಖನಗಳು</a></li>
									<li><a href="authors.php"><i class="fa fa-pencil-square-o"></i>&nbsp;&nbsp;ಲೇಖಕರು</a></li>
								</ul>
							</li>
						</ul>
					</div><!-- /dl-menuwrapper -->
	</div>	
		<div id="header">
<!--
			<h1>ಸಾಕ್ಷಿ</h1>
-->   
        <div class="image_heading">
			<img src="images/maatukate.png">
		</div>
			
		<span><br>ಶ್ರೀ ನೀಲಕಂಠೇಶ್ವರ ನಾಟ್ಯ ಸೇವಾ ಸಂಘ</span>	
		</div>
		<div class="mainpage_sakshi">
		<div id="nav_sakshi">
			<ul class="menu_sakshi">
				<li><a href="../maatukate.html">&nbsp;&nbsp;ಮುಖಪುಟ</a></li>
				<li><a href="volumes.php">&nbsp;&nbsp;ಸಂಪುಟಗಳು</a></li>
				<li><a href="authors.php">&nbsp;&nbsp;ಲೇಖಕರು</a></li>
				<li><a href="articles.php">&nbsp;&nbsp;ಲೇಖನಗಳು</a></li>
			</ul>
		</div>
		<div id="about_sakshi">
			<div class="archive_holder_maatukate">
				<div class="page_title"><i class="fa fa-book"></i>&nbsp;&nbsp;ಸಂಚಿಕೆಗಳು</div>
					<div id="volumes_maatukate">
												<?php

												include("connect.php");
												require_once("common.php");
												$query = 'select distinct volume from article_maatukate order by volume';
												$result = $db->query($query); 
												$num_rows = $result ? $result->num_rows : 0;
												//~ $row_count = 10;
												//~ $count = 0;
												//~ $col = 3;
												echo '<ul class="dot">';
												if($num_rows > 0)
												{
													while($row = $result->fetch_assoc())
													{
														
														//~ $count++;
														//~ if($count > $row_count) {
															//~ $count = 1;
														//~ }
														//~ echo '<a href="part.php?vol='. $row['volume'] .'"><div class="button alt" > Volume&nbsp;'. intval($row['volume']) .'&nbsp;&nbsp;('.getYear($row['volume']) . ')</div></a>';
														echo '<a href="part.php?vol='. $row['volume'] .'"><li class="button alt" > Volume&nbsp;'. intval($row['volume']) .'&nbsp;&nbsp;</li></a>';
													}
												}
												echo '</ul>';
												if($result){$result->free();}
												$db->close();
										?>
		</div>
		</div>
</div>
</div>
	<footer>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<p>Digital Archives in Indian Languages<a href="#"> (DAIL)</a></p>
				</div>
			</div>		
		</div>	
	</footer>
	<script src="../../../js/jquery.js"></script>
    <script src="../../../js/bootstrap.min.js"></script>
	<script src="../../../js/jquery.smooth-scroll.min.js"></script>
	<script src="../../../js/jquery.dlmenu.js"></script>
	<script src="../../../js/wow.min.js"></script>
	<script src="../../../js/custom.js"></script>
</html>

