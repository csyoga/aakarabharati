<!DOCTYPE html>
<html>
  <head>
    <title> ಆಧುನಿಕ ಕರ್ನಾಟಕದ ಬೌದ್ಧಿಕ ಇತಿಹಾಸ</title>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- css -->
    <link href="css/index/bootstrap.min.css" rel="stylesheet" media="screen">
    
    <link href="css/index/style.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="css/intermediate/style.css"> <!-- Resource style -->
	<link href="css/index/color/default.css" rel="stylesheet" media="screen">
	<script src="js/index/modernizr.custom.js"></script>
      </head>
  <body>
	<div class="menu-area">
			<div id="dl-menu" class="dl-menuwrapper">
						<button class="dl-trigger">Open Menu</button>
						<ul class="dl-menu">
							<li>
								<a href="../index.html#intro">ಮುಖಪುಟ</a>
							</li>
							<li><a href="../index.html#about">ಪಕ್ಷಿನೋಟ</a></li>
							<li><a href="../index.html#services">ಸೇವೆಗಳು</a></li>
							<li><a href="../index.html#works">ಸಂಗ್ರಹ</a></li>
							<li><a href="../index.html#contact">ಸಂಪರ್ಕ</a></li>
							<li>
								<a href="#">ಹುಡುಕು</a>
								<ul class="dl-submenu">
									<li><a href="sakshi.html"><i class="fa fa-home"></i>&nbsp;&nbsp;ಮುಖಪುಟ</a></li>
									<li><a href="php/volumes_list.html"><i class="fa fa-book"></i>&nbsp;&nbsp;ಸಂಪುಟಗಳು</a></li>
									<li><a href="php/articles.php"><i class="fa fa-pencil"></i>&nbsp;&nbsp;ಲೇಖನಗಳು</a></li>
									<li><a href="php/authors.php"><i class="fa fa-pencil-square-o"></i>&nbsp;&nbsp;ಲೇಖಕರು</a></li>
								</ul>
							</li>
						</ul>
					</div><!-- /dl-menuwrapper -->
	</div>	
		<div id="header">
			<h1>ಹುಡುಕು</h1>

			
		<span>ಸಮಗ್ರ  ಸಂಗ್ರಹದ ಶೋಧನೆ</span>	
		</div>
    <div class="mainpage_search">
		<div id="nav_search">
			<ul class="menu_search">
				<li><a href="../volumes/sakshi/php/volumes_list.html">&nbsp;&nbsp;ಸಾಕ್ಷಿ</a></li>
				<li><a href="../volumes/samvada/php/volumes_list.html">&nbsp;&nbsp;ಸಂವಾದ</a></li>
				<li><a href="../volumes/maatukate/php/volumes.php">&nbsp;&nbsp;ನೀನಾಸಮ್ ಮಾತುಕತೆ</a></li>
				<li><a href="../volumes/kgv/akgv.html">&nbsp;&nbsp;ಕರ್ಣಾಟಕ ಗತವೈಭವ</a></li>
				<li><a href="../volumes/pustakaprapancha/pp.html">&nbsp;&nbsp;ಪುಸ್ತಕ ಪ್ರಪಂಚ</a></li>
			</ul>
		</div>
		<div id="about_sakshi">
			<div class="archive_holder">
<?php
include("connect.php");
//~ require_once("../common.php");

if(isset($_GET['vol'])){$volume = $_GET['vol'];}else{$volume = '';}
if(isset($_GET['part'])){$part = $_GET['part'];}else{$part = '';}

//~ if(!(isValidVolume($volume) && isValidPart($part)))
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
?>
				<div class="page_title">ಹುಡುಕು</div><br>
				<div class="archive_search">
					<form method="get" action="search-result.php">
					<table>
						<tr>
							<td class="right" colspan="2">
								<input type="checkbox" name="check[]" value="sak" id="check_sak" checked/>&nbsp;<label for="check_sak">ಸಾಕ್ಷಿ</label><br />
								<input type="checkbox" name="check[]" value="sam" id="check_sam" checked/>&nbsp;<label for="check_sam">ಸಂವಾದ</label><br />
								<input type="checkbox" name="check[]" value="maa" id="check_maa" checked/>&nbsp;<label for="check_maa">ನೀನಾಸಮ್ ಮಾತುಕತೆ</label><br />
								<input type="checkbox" name="check[]" value="pp" id="check_pp" checked/>&nbsp;<label for="check_pp">ಪುಸ್ತಕ ಪ್ರಪಂಚ</label><br />
							</td>
						</tr>
				<?php

//~ $db = mysql_connect("localhost",$user,$password) or die("Not connected to database");
//~ $rs = mysql_select_db($database,$db) or die("No Database");

echo "<tr>
	<td class=\"left\"><label for=\"autocomplete\" class=\"titlespan\">ಲೇಖಕರು</label></td>
	<td class=\"right\"><input name=\"author\" type=\"text\" class=\"titlespan wide\" id=\"autocomplete\" maxlength=\"150\" />";
	
$query_ac = "select * from author where type regexp '01|02|03|04|05|06|07|08|09|10|11|12|13' order by authorname";

$result_ac = $db->query($query_ac); 
$num_rows_ac = $result_ac ? $result_ac->num_rows : 0;

//~ $result_ac = mysql_query($query_ac);
//~ $num_rows_ac = mysql_num_rows($result_ac);

//~ echo "<script type=\"text/javascript\">$( \"#autocomplete\" ).autocomplete({source: [ ";

$source_ac = '';

if($num_rows_ac > 0)
{
	for($i=1;$i<=$num_rows_ac;$i++)
	{
		//~ $row_ac=mysql_fetch_assoc($result_ac);
		$row_ac = $result_ac->fetch_assoc();

		$authorname=$row_ac['authorname'];

		$source_ac = $source_ac . ", ". "\"$authorname\"";
	}
	$source_ac = preg_replace("/^\, /", "", $source_ac);
}

//~ echo "$source_ac ]});</script></td>";
echo "</tr>
<tr>
	<td class=\"left\"><label for=\"textfield2\" class=\"titlespan\">ಲೇಖನ</label></td>
	<td class=\"right\"><input name=\"title\" type=\"text\" class=\"titlespan wide\" id=\"textfield2\" maxlength=\"150\" autocomplete=\"off\"/></td>
</tr>";

if($result_ac){$result_ac->free();}
$db->close();
?>
					<tr>
						<td class="left"><label for="textfield3" class="titlespan">ಪದಗಳು</label></td>
						<td class="right"><input name="text" type="text" class="titlespan wide" id="textfield3" maxlength="150" autocomplete="off"/></td>
					</tr>
					<tr>
						<td class="left">&nbsp;</td>
						<td class="right">
							<input name="searchform" type="submit" class="titlespan_search med" id="button_search" value="ಹುಡುಕು"/>
							<input name="resetform" type="reset" class="titlespan_search med" id="button_reset" value="ರೀಸೆಟ್"/>
						</td>
					</tr>
				</table>
				</form>
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

	<script src="js/index/jquery.js"></script>
    <script src="js/index/bootstrap.min.js"></script>
	<script src="js/index/jquery.smooth-scroll.min.js"></script>
	<script src="js/index/jquery.dlmenu.js"></script>
	<script src="js/index/wow.min.js"></script>
	<script src="js/index/custom.js"></script>
</html>
