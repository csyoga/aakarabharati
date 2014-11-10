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
									<li><a href="#"><i class="fa fa-thumbs-o-up"></i>&nbsp;&nbsp;ಕೃತಜ್ಞತೆಗಳು</a></li>
								</ul>
							</li>
						</ul>
					</div><!-- /dl-menuwrapper -->
	</div>	
		<div id="header">
			<h1>ಸಾಕ್ಷಿ</h1>
		<span>ಸಾಹಿತ್ಯ ಸಂಸ್ಕೃತಿಗಳ ವಿಚಾರ ವಿಮರ್ಶೆಯ ವೇದಿಕೆ</span>	
		</div>
    <div class="mainpage_sakshi">
<!--
		<div class="nav_sakshi">
			<ul class="menu_sakshi">
				<li class="last"><a href="sakshi.html"><i class="fa fa-home"></i>&nbsp;&nbsp;ಮುಖಪುಟ</a></li>
				<li><a href="html/volumes_list.html"><i class="fa fa-book"></i>&nbsp;&nbsp;ಸಂಪುಟಗಳು</a></li>
				<li><a href="html/authors.html"><i class="fa fa-pencil"></i>&nbsp;&nbsp;ಲೇಖಕರು</a></li>
				<li><a href="html/articles.html"><i class="fa fa-pencil-square-o"></i>&nbsp;&nbsp;ಲೇಖನಗಳು</a></li>
				<li><a href="html/contributors.html"><i class="fa fa-thumbs-o-up"></i>&nbsp;&nbsp;ಕೃತಜ್ಞತೆಗಳು</a></li>
			</ul>
-->
		<div id="about_sakshi">
			<div class="archive_holder">
			<ul class="dot">
<?php
include("connect.php");
//~ require_once("../common.php");

if(isset($_GET['feature'])){$feat_name = $_GET['feature'];}else{$feat_name = '';}
if(isset($_GET['featid'])){$featid = $_GET['featid'];}else{$featid = '';}

//~ $feat_name = entityReferenceReplace($feat_name);

//~ if(!(isValidFeature($feat_name) && isValidFeatid($featid)))
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
$db->set_charset('utf8');
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

//~ $month_name = array("0"=>"","1"=>"January","2"=>"February","3"=>"March","4"=>"April","5"=>"May","6"=>"June","7"=>"July","8"=>"August","9"=>"September","10"=>"October","11"=>"November","12"=>"December");

//~ echo "<div class=\"page_title\"><i class='fa fa-tags fa-1x'></i>&nbsp;&nbsp;Category&nbsp;:&nbsp;$feat_name</div>";
echo "<ul class=\"dot\">";


$query1 = "select * from article where featid='$featid' order by volume,page";

$result1 = $db->query($query1); 
$num_rows1 = $result1 ? $result1->num_rows : 0;

//~ $result1 = mysql_query($query1);
//~ $num_rows1 = mysql_num_rows($result1);

if($num_rows1 > 0)
{
	for($i=1;$i<=$num_rows1;$i++)
	{
		//~ $row1=mysql_fetch_assoc($result1);
		$row1 = $result1->fetch_assoc();

		$titleid=$row1['titleid'];
		$title=$row1['title'];
		$featid=$row1['featid'];
		$page=$row1['page'];
		$authid=$row1['authid'];
		$volume=$row1['volume'];
		//~ $part=$row1['part'];
		//~ $year=$row1['year'];
		//~ $month=$row1['month'];
		
		$title1=addslashes($title);
		
		$query3 = "select feat_name from feature where featid='$featid'";
		
		//~ $result3 = mysql_query($query3);		
		//~ $row3=mysql_fetch_assoc($result3);
		
		$result3 = $db->query($query3); 
		$row3 = $result3->fetch_assoc();

		$feature=$row3['feat_name'];
		
		if($result3){$result3->free();}
		
		//~ $dpart = preg_replace("/^0/", "", $part);
		//~ $dpart = preg_replace("/\-0/", "-", $dpart);
		echo "<li>";
		echo "<span class=\"titlespan\"><a target=\"_blank\" href=\"../Volumes/$volume/index.djvu?djvuopts&amp;page=$page.djvu&amp;zoom=page\">$title</a></span>";
		echo "
		<span class=\"titlespan\">&nbsp;&nbsp;|&nbsp;&nbsp;</span>
		<span class=\"featurespan\">
			<a href=\"toc.php?vol=$volume\">ಸಂಚಿಕೆ&nbsp;(".intval($volume).")</a>
		</span>";
		
		if($authid != 0)
		{

			echo "<br />";
			$aut = preg_split('/;/',$authid);

			$fl = 0;
			foreach ($aut as $aid)
			{
				$query2 = "select * from author where authid=$aid";

				$result2 = $db->query($query2); 
				$num_rows2 = $result2 ? $result2->num_rows : 0;
				
				//~ $result2 = mysql_query($query2);
				//~ $num_rows2 = mysql_num_rows($result2);

				if($num_rows2 > 0)
				{
					//~ $row2=mysql_fetch_assoc($result2);
					$row2 = $result2->fetch_assoc();

					$authorname=$row2['authorname'];
					

					if($fl == 0)
					{
						echo "<span class=\"authorspan\"><a href=\"auth.php?authid=$aid&amp;author=" . urlencode($authorname) . "\">$authorname</a></span>";
						$fl = 1;
					}
					else
					{
						echo "<span class=\"titlespan\">;&nbsp;</span><span class=\"authorspan\"><a href=\"../auth.php?authid=$aid&amp;author=" . urlencode($authorname) . "\">$authorname</a></span>";
					}
				}
				if($result2){$result2->free();}

			}
		}
		//~ echo "<br /><span class=\"downloadspan\"><a href=\"../../Volumes/$volume/$part/index.djvu?djvuopts&amp;page=$page.djvu&amp;zoom=page\" target=\"_blank\">View article</a>&nbsp;|&nbsp;<a href=\"#\">Download article (DjVu)</a>&nbsp;|&nbsp;<a href=\"#\">Download article (PDF)</a></span>";

		echo "</li>\n";
	}
}
else
{
	echo "No data in the database";
}

if($result1){$result1->free();}
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
					<p>Copyright &copy;2014 Digital Archives in Indian Languages. All rights reserved. By <a href="#">DAIL</a></p>
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
