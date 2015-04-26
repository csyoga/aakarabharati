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
								<a href="#intro">ಮುಖಪುಟ</a>
							</li>
							<li><a href="#about">ಪಕ್ಷಿನೋಟ</a></li>
							<li><a href="#services">ಸೇವೆಗಳು</a></li>
							<li><a href="#works">ಸಂಗ್ರಹ</a></li>
							<li><a href="#contact">ಸಂಪರ್ಕ</a></li>
							<li>
								<a href="#">ಸಾಕ್ಷಿ</a>
								<ul class="dl-submenu">
									<li><a href="../sakshi.html"><i class="fa fa-home"></i>&nbsp;&nbsp;ಮುಖಪುಟ</a></li>
									<li><a href="#"><i class="fa fa-book"></i>&nbsp;&nbsp;ಸಂಪುಟಗಳು</a></li>
									<li><a href="#"><i class="fa fa-pencil"></i>&nbsp;&nbsp;ಲೇಖಕರು</a></li>
									<li><a href="#"><i class="fa fa-pencil-square-o"></i>&nbsp;&nbsp;ಲೇಖನಗಳು</a></li>
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
			<img src="images/sakshi.png" alt="sakshi_image">
		</div>
		<span><br>ಸಾಹಿತ್ಯ ಸಂಸ್ಕೃತಿಗಳ ವಿಚಾರ ವಿಮರ್ಶೆಯ ವೇದಿಕೆ</span>	
		</div>
    <div class="mainpage_sakshi">
		<div id="nav_sakshi">
			<ul class="menu_sakshi">
				<li><a href="../sakshi.html">&nbsp;&nbsp;ಮುಖಪುಟ</a></li>
				<li><a href="volumes_list.html">&nbsp;&nbsp;ಸಂಪುಟಗಳು</a></li>
				<li><a href="authors.php">&nbsp;&nbsp;ಲೇಖಕರು</a></li>
				<li><a href="articles.php">&nbsp;&nbsp;ಲೇಖನಗಳು</a></li>
			</ul>
		</div>
		<div id="about_sakshi">
		<div class="archive_holder_volume">
<?php

include("connect.php");
//~ require_once("../common.php");

if(isset($_GET['part'])){$part = $_GET['part'];}else{$part = '';}
//~ if(isset($_GET['year'])){$year = $_GET['year'];}else{$year = '';}

//~ if(!(isValidVolume($volume) && isValidYear($year)))
//~ {
	//~ echo "Invalid URL";
	//~ 
	//~ echo "</div></div>";
	//~ include("include_footer.php");
	//~ echo "<div class=\"clearfix\"></div></div>";
	//~ include("include_footer_out.php");
	//~ echo "</body></html>";
	//~ exit(1);
//~ }

$db = @new mysqli('localhost', "$user", "$password", "$database");
if($db->connect_errno > 0)
{
	echo 'Not connected to the database [' . $db->connect_errno . ']';
	echo "</div></div>";
	include("include_footer.php");
	echo "<div class=\"clearfix\"></div></div>";
	include("include_footer_out.php");
	echo "</body></html>";
	exit(1);
}

//~ $db = mysql_connect("localhost",$user,$password) or die("Not connected to database");
//~ $rs = mysql_select_db($database,$db) or die("No Database");

echo "<div class=\"page_title\"><i class='fa fa-book fa-1x'></i>&nbsp;&nbsp;Volume ".$part."</div>";
?>

			<div class="col1">
				<ul>

<?php

$row_count = 4;
//~ $month_name = array("0"=>"","1"=>"January","2"=>"February","3"=>"March","4"=>"April","5"=>"May","6"=>"June","7"=>"July","8"=>"August","9"=>"September","10"=>"October","11"=>"November","12"=>"December");

$query = "select distinct volume from article where part='$part' order by part";

$result = $db->query($query); 
$num_rows = $result ? $result->num_rows : 0;

//~ $result = mysql_query($query);
//~ $num_rows = mysql_num_rows($result);

$count = 0;
$col = 1;

if($num_rows > 0)
{
	for($i=1;$i<=$num_rows;$i++)
	{
		//~ $row=mysql_fetch_assoc($result);
		$row = $result->fetch_assoc();
		
		$part=$row['part'];
		
		$query11 = "select min(page) as minpage from article where part='$part'";
		
		//~ $result11 = mysql_query($query11);
		//~ $num_rows11 = mysql_num_rows($result11);
		$result11 = $db->query($query11); 
		$num_rows11 = $result11 ? $result11->num_rows : 0;

		
		if($num_rows11 > 0)
		{
			//~ $row11=mysql_fetch_assoc($result11);
			$row11 = $result11->fetch_assoc();
			$page_start = $row11['minpage'];
			$page_start = intval($page_start);
		}
		if($result11){$result11->free();}

		$query12 = "select max(page_end) as maxpage from article where part='$part'";
		
		//~ $result12 = mysql_query($query12);
		//~ $num_rows12 = mysql_num_rows($result12);
		$result12 = $db->query($query12); 
		$num_rows12 = $result12 ? $result12->num_rows : 0;
		
		if($num_rows12 > 0)
		{
			//~ $row12=mysql_fetch_assoc($result12);
			$row12 = $result12->fetch_assoc();
			$page_end = $row12['maxpage'];
			$page_end = intval($page_end);
		}
		if($result12){$result12->free();}

		$query1 = "select distinct month from article where part='$part' order by month";

		//~ $result1 = mysql_query($query1);
		//~ $num_rows1 = mysql_num_rows($result1);
		$result1 = $db->query($query1); 
		$num_rows1 = $result1 ? $result1->num_rows : 0;

		if($num_rows1 > 0)
		{
			//~ $row1=mysql_fetch_assoc($result1);
			$row1 = $result1->fetch_assoc();
			//~ $month = $row1['month'];

			$count++;
			if($count > $row_count)
			{
				$col++;
				echo "</div>\n
				<div class=\"col$col\">";
				echo "<ul>";
				$count = 1;
			}
			
			$dpart = preg_replace("/^0/", "", $part);
			$dpart = preg_replace("/\-0/", "-", $dpart);
			
			echo "<li class=\"li_below\"><span class=\"yearspan\"><a href=\"toc.php?part=$part\">Issue&nbsp;".$dpart;
			if(intval($volume) != 0)
			{
				echo "&nbsp;(".$part.")";
			}
			echo "<br /></a></span></li>";
		}
		if($result1){$result1->free();}
	}
}
else
{
	echo "No data in the database";
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

