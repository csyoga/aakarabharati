<!DOCTYPE html>
<html>
  <head>
    <title> ಆಧುನಿಕ ಕರ್ನಾಟಕದ ಬೌದ್ಧಿಕ ಇತಿಹಾಸ</title>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- css -->
    <link href="../../../css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="../../../css/style.css" rel="stylesheet" media="screen">
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
			<h1>ಸಂವಾದ</h1>
			<span>ಸಾಹಿತ್ಯಿಕ - ಸಾಂಸ್ಕೃತಿಕ ದ್ವೈಮಾಸಿಕ ಸಂಕಲನ</span>	
		</div>
    <div class="mainpage_sakshi">
		<div id="nav_sakshi">
			<ul class="menu_sakshi">
				<li><a href="../samvada.html">&nbsp;&nbsp;ಮುಖಪುಟ</a></li>
				<li><a href="volumes_list.html">&nbsp;&nbsp;ಸಂಪುಟಗಳು</a></li>
				<li><a href="authors.php">&nbsp;&nbsp;ಲೇಖಕರು</a></li>
				<li><a href="articles.php">&nbsp;&nbsp;ಲೇಖನಗಳು</a></li>
			</ul>
		</div>
		<div id="about_sakshi">
			<div class="archive_holder">
				<div class="page_title"><i class="fa fa-user"></i>&nbsp;&nbsp;ಲೇಖಕರು</div>
			<div class="alphabet">
				<span class="letter"><a href="authors.php?letter=ಅ">ಅ</a></span>
				<span class="letter"><a href="authors.php?letter=ಆ">ಆ</a></span>
				<span class="letter"><a href="authors.php?letter=ಉ">ಉ</a></span>
				<span class="letter"><a href="authors.php?letter=ಊ">ಊ</a></span>
				<span class="letter"><a href="authors.php?letter=ಎ">ಎ</a></span>
				<span class="letter"><a href="authors.php?letter=ಕ">ಕ</a></span>
				<span class="letter"><a href="authors.php?letter=ಗ">ಗ</a></span>
				<span class="letter"><a href="authors.php?letter=ಚ">ಚ</a></span>
				<span class="letter"><a href="authors.php?letter=ಜ">ಜ</a></span>
				<span class="letter"><a href="authors.php?letter=ತ">ತ</a></span>
				<span class="letter"><a href="authors.php?letter=ದ">ದ</a></span>
				<span class="letter"><a href="authors.php?letter=ನ">ನ</a></span>
				<span class="letter"><a href="authors.php?letter=ಪ">ಪ</a></span>
				<span class="letter"><a href="authors.php?letter=ಬ">ಬ</a></span>
				<span class="letter"><a href="authors.php?letter=ಭ">ಭ</a></span>
				<span class="letter"><a href="authors.php?letter=ಮ">ಮ</a></span>
				<span class="letter"><a href="authors.php?letter=ಯ">ಯ</a></span>
				<span class="letter"><a href="authors.php?letter=ರ">ರ</a></span>
				<span class="letter"><a href="authors.php?letter=ಲ">ಲ</a></span>
				<span class="letter"><a href="authors.php?letter=ವ">ವ</a></span>
				<span class="letter"><a href="authors.php?letter=ಶ">ಶ</a></span>
				<span class="letter"><a href="authors.php?letter=ಸ">ಸ</a></span>
				<span class="letter"><a href="authors.php?letter=ಹ">ಹ</a></span>
			</div>
				<ul class="dot">
<?php

include("connect.php");
//~ require_once("../common.php");

if(isset($_GET['letter']))
{
	$letter=$_GET['letter'];

	//~ if(!(isValidLetter($letter)))
	//~ {
		//~ echo "<li>Invalid URL</li>";
		//~ 
		//~ echo "</ul></div></div>";
		//~ echo "<div class=\"clearfix\"></div></div>";
		//~ echo "</body></html>";
		//~ exit(1);
	//~ }

	if($letter == '')
	{
		$letter = 'ಅ';
	}
}
else
{
	$letter = 'ಅ';
}

//~ $db = mysql_connect("localhost",$user,$password) or die("Not connected to database");
//~ $rs = mysql_select_db($database,$db) or die("No Database");

$db = @new mysqli('localhost', "$user", "$password", "$database");
$db->set_charset('utf8');
if($db->connect_errno > 0)
{
	echo '<li>Not connected to the database [' . $db->connect_errno . ']</li>';
	echo "</ul></div></div>";
	include("include_footer.php");
	echo "<div class=\"clearfix\"></div></div>";
	include("include_footer_out.php");
	echo "</body></html>";
	exit(1);
}

//~ $db = mysql_connect("localhost",$user,$password) or die("Not connected to database");
//~ $rs = mysql_select_db($database,$db) or die("No Database");

$query = "select * from author where authorname like '$letter%' order by authorname";
/*
$query = "select * from author where authorname like '$letter%' order by authorname";
*/

//~ $result = mysql_query($query);
//~ $num_rows = mysql_num_rows($result);

$result = $db->query($query); 
$num_rows = $result ? $result->num_rows : 0;

if($num_rows > 0)
{
	for($i=1;$i<=$num_rows;$i++)
	{
		//~ $row=mysql_fetch_assoc($result);
		$row = $result->fetch_assoc();

		$authid=$row['authid'];
		$authorname=$row['authorname'];

		echo "<li>";
		echo "<span class=\"titlespan\"><a href=\"auth.php?authid=$authid&amp;author=" . urlencode($authorname) . "\">$authorname</a></span>";
		echo "</li>\n";
	}
}
else
{
	echo "<li>Sorry! No author names were found to begin with the letter '$letter' </li>";
}

if($result){$result->free();}
$db->close();
?>
				</ul>
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
