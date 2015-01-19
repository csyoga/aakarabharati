<?php
	// If nothing is GETed, redirect to search page
	if(empty($_GET['author']) && empty($_GET['title']) && empty($_GET['text'])) {
		header('Location: search.php');
		exit(1);
	}
?>
<!DOCTYPE html>
<html>
  <head>
    <title> ಆಧುನಿಕ ಕರ್ನಾಟಕದ ಬೌದ್ಧಿಕ ಇತಿಹಾಸ</title>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- css -->
    <link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="../css/style.css" rel="stylesheet" media="screen">
	<link href="../color/default.css" rel="stylesheet" media="screen">
	<script src="../js/modernizr.custom.js"></script>
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
				<li><a href="#">&nbsp;&nbsp;ನೀನಾಸಮ್ ಮಾತುಕತೆ</a></li>
				<li><a href="#">&nbsp;&nbsp;ಕರ್ಣಾಟಕ ಗತವೈಭವ</a></li>
				<li><a href="#">&nbsp;&nbsp;ಪುಸ್ತಕ ಪ್ರಪಂಚ</a></li>
			</ul>
		</div>
		<div id="about_sakshi">
			<div class="archive_holder">
				<?php

include("connect.php");
require_once("common.php");

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
	//~ include("include_footer.php");
	echo "<div class=\"clearfix\"></div></div>";
	//~ include("include_footer_out.php");
	echo "</body></html>";
	exit(1);
}
?>
				<div class="archive_search">
<?php
if(isset($_GET['check']))
{
	$check=$_GET['check'];
	if(!(isValidCheck($check)))
	{
		echo "Invalid URL";
		
		echo "</div></div>";
		//~ include("include_footer.php");
		echo "<div class=\"clearfix\"></div></div>";
		//~ include("include_footer_out.php");
		echo "</body></html>";
		exit(1);
	}
	
	
	if(isset($_GET['author'])){$author = $_GET['author'];}else{$author = '';}
	if(isset($_GET['text'])){$text = $_GET['text'];}else{$text = '';}
	if(isset($_GET['title'])){$title = $_GET['title'];}else{$title = '';}
	if(isset($_GET['searchform'])){$searchform = $_GET['searchform'];}else{$searchform = '';}
	if(isset($_GET['resetform'])){$resetform = $_GET['resetform'];}else{$resetform = '';}
	
	$text = entityReferenceReplace($text);
	$author = entityReferenceReplace($author);
	$title = entityReferenceReplace($title);
	$searchform = entityReferenceReplace($searchform);
	$resetform = entityReferenceReplace($resetform);

	$author = preg_replace("/[\t]+/", " ", $author);
	$author = preg_replace("/[ ]+/", " ", $author);
	$author = preg_replace("/^ /", "", $author);

	$title = preg_replace("/[\t]+/", " ", $title);
	$title = preg_replace("/[ ]+/", " ", $title);
	$title = preg_replace("/^ /", "", $title);

	$text = preg_replace("/[\t]+/", " ", $text);
	$text = preg_replace("/[ ]+/", " ", $text);
	$text = preg_replace("/^ /", "", $text);

	$text2 = $text;
	$text2d = $text;
	$text2d = preg_replace("/ /", "|", $text2d);

	if($title=='')
	{
		$title='.*';
	}
	if($author=='')
	{
		$author='.*';
	}

	$cfl = 0;
	
	$author = addslashes($author);
	$title = addslashes($title);
	if($text=='')
	{
		$iquery{"sak"}="(SELECT titleid, title, authid, authorname, page_start, type, featid from article_sakshi WHERE authorname REGEXP '$author' and title REGEXP '$title')";
		$iquery{"sam"}="(SELECT titleid, title, authid, authorname, page_start, type, featid from article_samvada WHERE authorname REGEXP '$author' and title REGEXP '$title')";
		$query = '';
		
		$mtf = '';
		for($ic=0;$ic < sizeof($check);$ic++)
		{
			if($check[$ic] != '')
			{
				$mtf = $mtf . "<span class=\"motif ".$check[$ic]."_motif nrmargin\"></span>\n";
				$query = $query . " UNION ALL " . $iquery{$check[$ic]};
			}
		}
		$query = preg_replace("/^ UNION ALL /", "", $query);
	}
	elseif($text!='')
	{
		$text = trim($text);
		if(preg_match("/^\"/", $text))
		{
			$stext = preg_replace("/\"/", "", $text);
			$dtext = $stext;
			$stext = '"' . $stext . '"';
		}
		elseif(preg_match("/\+/", $text))
		{
			$stext = preg_replace("/\+/", " +", $text);
			$dtext = preg_replace("/\+/", "|", $text);
			$stext = '+' . $stext;
		}
		elseif(preg_match("/\|/", $text))
		{
			$stext = preg_replace("/\|/", " ", $text);
			$dtext = $text;
		}
		else
		{
			$stext = $text;
			$dtext = $stext = preg_replace("/ /", "|", $text);
		}
		
		$stext = addslashes($stext);
		
		$iquery{"sak"}="(SELECT * FROM
							(SELECT * FROM
								(SELECT * FROM
									(SELECT titleid, title, authid, authorname, page_start, type, featid)
								AS tb10 WHERE authorname REGEXP '$author')
							AS tb20 WHERE title REGEXP '$title')
						AS tb30 WHERE page_start NOT REGEXP '.*')";
						
		$iquery{"sam"}="(SELECT * FROM
							(SELECT * FROM
								(SELECT * FROM
									(SELECT titleid, title, authid, authorname, page_start, type, featid)
								AS tb10 WHERE authorname REGEXP '$author')
							AS tb20 WHERE title REGEXP '$title')
						AS tb30 WHERE page_start NOT REGEXP '.*')";
						
				
		$query = '';
		$mtf = '';
		for($ic=0;$ic<sizeof($check);$ic++)
		{
			if($check[$ic] != '')
			{
				$mtf = $mtf . "<span class=\"motif ".$check[$ic]."_motif nrmargin\"></span>\n";
				$query = $query . " UNION ALL " . $iquery{$check[$ic]};
				
			}
		}
		$query = preg_replace("/^ UNION ALL /", "", $query);
	}
	
	//~ $result = mysql_query($query);
	//~ $num_results = mysql_num_rows($result);

	$result = $db->query($query); 
	$num_results = $result ? $result->num_rows : 0;
	echo "<div class=\"page_title\"><p style=\"float: right;\">$mtf</p><span>ಫಲಿತಾಂಶ</span></div>";
	//~ echo "<ul class='dot'>";
	if ($num_results > 0)
	{
		echo "<div class=\"count authorspan\">$num_results result(s)</div><br><br>";
	}
	
	$titleid[0]=0;
	$count = 1;
	$id = "0";
	
	if($num_results > 0)
	{	
		echo "<ul class='dot'>";
		for($i=1;$i<=$num_results;$i++)
		{
			//~ $row1 = mysql_fetch_assoc($result);
			$row1 = $result->fetch_assoc();

			if(isset($row1['titleid']))
			{
				$book_id = $row1['titleid'];
			}
			else
			{
				$book_id = $row1['book_id'];
			}
			
			$title = $row1['title'];
			$authid = $row1['authid'];
			$authorname = $row1['authorname'];
			$page = $row1['page_start'];
			$type = $row1['type'];
			if(isset($row1['featid']))
			{
				$slno = $row1['featid'];
			}
			else
			{
				$slno = $row1['slno'];
			}			
			
			//~ if($type == "type")
			//~ {
				//~ $slno = $book_id;
				//~ if(preg_match("/^sak/", $book_id))
				//~ {
					//~ $type = "sakshi";
					//~ $dtype = "Sakshi";
				//~ }
				//~ elseif(preg_match("/^sam/", $book_id))
				//~ {
					//~ $type = "samvada";
					//~ $dtype = "Samvada";
				//~ }
			//~ }
			if($type == 01)
			{
					$type = "sakshi";
				}
				elseif($type == 02)
				{
					$type = "samvada";
				}
			
			$title = preg_replace('/!!(.*)!!/', "<i>$1</i>", $title);
			$title = preg_replace('/!/', "", $title);
		
			if($text != '')
			{
				$cur_page = $row1['page_start'];
			}
			
			$title1=addslashes($title);
			
			if ($id != $slno)
			{
				if($id == 0)
				{
					echo "<li><span class=\"motif ".$type."_motif\"></span>";
				}
				else
				{
					echo "</li>\n<li><span class=\"motif ".$type."_motif\"></span>";
				}
				
				//~ if(($type == "fbi") || ($type == "fi") || ($type == "hpg") || ($type == "sse") || ($type == "tcm"))
				//~ {
					//~ $book_info = '';
					//~ 
					//~ if($type == "fi")
					//~ {
						//~ $query_aux = "select * from fbi_books_list where book_id='$book_id' and type='$type'";
					//~ }
					//~ else
					//~ {
						//~ $query_aux = "select * from ".$type."_books_list where book_id='$book_id' and type='$type'";
					//~ }
					//~ 
					//~ $result_aux = mysql_query($query_aux);
					//~ $num_rows_aux = mysql_num_rows($result_aux);
					//~ 
					//~ $result_aux = $db->query($query_aux); 
					//~ $num_rows_aux = $result_aux ? $result_aux->num_rows : 0;
					//~ 
					//~ $row_aux=mysql_fetch_assoc($result_aux);
					//~ $row_aux = $result_aux->fetch_assoc();
//~ 
					//~ $page_end = $row_aux['page_end'];
					//~ $edition = $row_aux['edition'];
					//~ $volume = $row_aux['volume'];
					//~ $part = $row_aux['part'];
					//~ $year = $row_aux['year'];
					//~ $month = $row_aux['month'];
					//~ 
					//~ if($result_aux){$result_aux->free();}
					//~ 
					//~ if($type == 'fbi')
					//~ {
						//~ $book_info = $book_info . "Fauna of British India ";	
					//~ }
					//~ elseif($type == 'fi')
					//~ {
						//~ $book_info = $book_info . "Fauna of India ";	
					//~ }
					//~ elseif($type == 'hpg')
					//~ {
						//~ $book_info = $book_info . "Handbook and Pictorial Guides ";	
					//~ }
					//~ elseif($type == 'sse')
					//~ {
						//~ $book_info = $book_info . "Status Survey of Endangered Species ";	
					//~ }
					//~ elseif($type == 'tcm')
					//~ {
						//~ $book_info = $book_info . "Technical Monographs ";	
					//~ }
//~ 
					//~ if($edition != '00')
					//~ {
						//~ if (intval($edition) == 1)
						//~ {
							//~ $book_info = $book_info . " | First Edition";
						//~ }
						//~ if (intval($edition) == 2)
						//~ {
							//~ $book_info = $book_info . " | Second Edition";
						//~ }
					//~ }
					//~ if($volume != '00')
					//~ {
						//~ $book_info = $book_info . " | Volume " . intval($volume);
					//~ }
					//~ if($part != '00')
					//~ {
						//~ $book_info = $book_info . " | Part " . intval($part);
					//~ }
					//~ if(intval($page_start) != 0)
					//~ {
						//~ $book_info = $book_info . " | pp " . intval($page_start) . " - " . intval($page_end);	
					//~ }
					//~ 
					//~ echo "<span class=\"titlespan\"><a href=\"".$type."/".$type."_books_toc.php?book_id=$book_id&amp;type=$type&amp;book_title=" . urlencode($title) . "\">$title</a></span>";
					//~ echo "<br /><span class=\"bookspan\">$book_info</span>";
					//~ print_author($authid,$db);
					//~ echo "<br /><span class=\"downloadspan\"><a href=\"".$type."/".$type."_books_toc.php?book_id=$book_id&amp;type=$type&amp;book_title=" . urlencode($title) . "\">View TOC</a>&nbsp;|&nbsp;<a target=\"_blank\" href=\"../Volumes/$type/$book_id/index.djvu?djvuopts&amp;page=1&amp;zoom=page_start\">Read Book</a>&nbsp;|&nbsp;<a href=\"#\">Download Book (DjVu)</a>&nbsp;|&nbsp;<a href=\"#\">Download Book (PDF)</a></span>";
					//~ $id = $slno;
					//~ 
					//~ if($text != '')
					//~ {
						//~ echo "<br /><span class=\"authorspan\">result(s) found at page no(s). </span>";
						//~ echo "<span class=\"titlespan\"><a href=\"../Volumes/$type/$book_id/index.djvu?djvuopts&amp;page=$cur_page.djvu&amp;zoom=page_start&amp;find=$dtext/r\" target=\"_blank\">".intval($cur_page)."</a> &nbsp;</span>";
						//~ $id = $slno;
					//~ }
				//~ }
				//~ elseif(($type == "sfs") || ($type == "cas") || ($type == "ess") || ($type == "spb") || ($type == "zlg"))
				//~ {
					//~ $book_info = "";
			//~ 
					//~ $query_aux = "select * from ".$type."_books_list where book_id=$book_id and type='".$type."'";
//~ 
					//~ $result_aux = mysql_query($query_aux);
					//~ $num_rows_aux = mysql_num_rows($result_aux);
//~ 
					//~ $result_aux = $db->query($query_aux); 
					//~ $num_rows_aux = $result_aux ? $result_aux->num_rows : 0;
//~ 
					//~ $row_aux=mysql_fetch_assoc($result_aux);
					//~ $row_aux = $result_aux->fetch_assoc();
//~ 
					//~ $btitle = $row_aux['title'];
					//~ $slno = $row_aux['slno'];
					//~ $edition = $row_aux['edition'];
					//~ $volume = $row_aux['volume'];
					//~ $part = $row_aux['part'];
					//~ $dpage = $row_aux['page_start'];
					//~ $dpage_end = $row_aux['page_end'];
					//~ $month = $row_aux['month'];
					//~ $year = $row_aux['year'];
					//~ 
					//~ if($result_aux){$result_aux->free();}
							//~ 
					//~ $btitle = preg_replace('/!!(.*)!!/', "<i>$1</i>", $btitle);
					//~ $btitle = preg_replace('/!/', "", $btitle);
		//~ 
					//~ if($type == 'sfs')
					//~ {
						//~ $stitle = "State Fauna Series ";	
					//~ }
					//~ elseif($type == 'cas')
					//~ {
						//~ $stitle = "Conservation Area Series ";	
					//~ }
					//~ elseif($type == 'ess')
					//~ {
						//~ $stitle = "Ecosystem Series ";	
					//~ }
					//~ elseif($type == 'spb')
					//~ {
						//~ $stitle = "Special Publications ";	
					//~ }
					//~ elseif($type == 'zlg')
					//~ {
						//~ $stitle = "Zoologiana ";	
					//~ }
					//~ 
					//~ if($btitle != '')
					//~ {
						//~ $book_info = $book_info . " | " . $btitle;
					//~ }
					//~ if($edition != '00')
					//~ {
						//~ $book_info = $book_info . " | Edition " . intval($edition);
					//~ }
					//~ if($volume != '00')
					//~ {
						//~ $book_info = $book_info . " | Volume " . intval($volume);
					//~ }
					//~ if($part != '00')
					//~ {
						//~ $book_info = $book_info . " | Part " . intval($part);
					//~ }
					//~ if(intval($dpage) != 0)
					//~ {
						//~ $book_info = $book_info . " | pp " . intval($dpage) . " - " . intval($dpage_end);	
					//~ }
					//~ if(intval($month) != 0)
					//~ {
						//~ $book_info = $book_info . " | " . $month_name{intval($month)} . " " . intval($year);	
					//~ }
//~ 
					//~ $book_info = preg_replace("/^ /", "", $book_info);
					//~ $book_info = preg_replace("/^\|/", "", $book_info);
					//~ $book_info = preg_replace("/^ /", "", $book_info);
//~ 
					//~ if($page_start == '')
					//~ {
						//~ echo "<span class=\"titlespan\"><a href=\"#\">$title</a></span>";
					//~ }
					//~ else
					//~ {
						//~ echo "<span class=\"titlespan\"><a target=\"_blank\" href=\"../Volumes/$type/$book_id/index.djvu?djvuopts&amp;page=$page_start.djvu&amp;zoom=page_start\">$title</a></span>";
					//~ }
					//~ echo "<span class=\"titlespan\">&nbsp;&nbsp;|&nbsp;&nbsp;</span><span class=\"yearspan\">$stitle</span><br /><span class=\"bookspan\">$book_info</span>";
					//~ print_author($authid,$db);
					//~ echo "<br /><span class=\"downloadspan\"><a href=\"".$type."/".$type."_books_toc.php?book_id=$book_id&amp;type=$type&amp;book_title=" . urlencode($btitle) . "\">View TOC</a>&nbsp;|&nbsp;<a href=\"#\">Download Article (DjVu)</a>&nbsp;|&nbsp;<a href=\"#\">Download Article (PDF)</a></span>";
					//~ $id = $slno;
					//~ 
					//~ if($text != '')
					//~ {
						//~ echo "<br /><span class=\"authorspan\">result(s) found at page no(s). </span>";
						//~ echo "<span class=\"titlespan\"><a href=\"../Volumes/$type/$book_id/index.djvu?djvuopts&amp;page=$cur_page.djvu&amp;zoom=page&amp;find=$dtext/r\" target=\"_blank\">".intval($cur_page)."</a> &nbsp;</span>";
						//~ $id = $slno;
					//~ }
				//~ }
				if(($type == "sakshi") || ($type == "samvada"))
				{
					$titleid = $book_id;
					$query_aux = "select * from article_".$type." where titleid='$titleid'";
		
					//~ $result_aux = mysql_query($query_aux);
					//~ $row_aux=mysql_fetch_assoc($result_aux);
					
					$result_aux = $db->query($query_aux); 
					$row_aux = $result_aux->fetch_assoc();

					$titleid=$row_aux['titleid'];
					$title=$row_aux['title'];
					$featid=$row_aux['featid'];
					$page=$row_aux['page_start'];
					$authid=$row_aux['authid'];
					$volume=$row_aux['volume'];
					$part=$row_aux['part'];
					$dpart = preg_replace("/^0/", "", $part);
					$dpart = preg_replace("/\-0/", "-", $dpart);
					//~ $year=$row_aux['year'];
					//~ $month=$row_aux['month'];
					
					$paper = $part;
					
					$title = preg_replace('/!!(.*)!!/', "<i>$1</i>", $title);
					$title = preg_replace('/!/', "", $title);
					$title1=addslashes($title);

					if($result_aux){$result_aux->free();}

					$query3 = "select feat_name from feature_".$type." where featid='$featid'";
					
					//~ $result3 = mysql_query($query3);		
					//~ $row3=mysql_fetch_assoc($result3);

					$result3 = $db->query($query3); 
					$row3 = $result3->fetch_assoc();
					
					$feature=$row3['feat_name'];
					
					if($result3){$result3->free();}
					
					if(($type == "sakshi") || ($type == "samvada"))
					{
					
						//~ echo "<li>";
						//~ echo "<li><span class=\"motif ".$type."_motif\"></span>";
						echo "<span class=\"titlespan\"><a target=\"_blank\" href=\"../Volumes/$part/index.djvu?djvuopts&amp;page=$page.djvu&amp;zoom=page\">$title</a></span>";
						echo "
						<span class=\"titlespan\">&nbsp;&nbsp;|&nbsp;&nbsp;</span>
						<span class=\"titlespan\">
							<a href=\"toc.php?part=$part\">ಸಂಚಿಕೆ (".intval($part).")</a>
						</span>";
						if($feature != "")
						{
							echo "<span class=\"titlespan\">&nbsp;&nbsp;|&nbsp;&nbsp;</span><span class=\"featurespan\"><a href=\"feat.php?feature=" . urlencode($feature) . "&amp;featid=$featid\">$feature</a></span>";
						}
					}
					//~ elseif($type == "occpapers")
					//~ {
						//~ echo "<span class=\"titlespan\"><a target=\"_blank\" href=\"../Volumes/occpapers/$paper/index.djvu?djvuopts&amp;page=1&amp;zoom=page\">$title</a></span>";
						//~ echo "<span class=\"featurespan\"><br />Occ. paper no.&nbsp;".intval($paper)."&nbsp;($year)</span>";
					//~ }
					
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
							
							if($num_rows2 > 0)
							{
								$row2 = $result2->fetch_assoc();		

								$authorname=$row2['authorname'];
								
								if($fl == 0)
								{
									echo "<span class=\"authorspan\"><a href=\"auth.php?authid=$aid&amp;author=" . urlencode($authorname) . "\">$authorname</a></span>";
									$fl = 1;
								}
								else
								{
									echo "<span class=\"titlespan\">;&nbsp;</span><span class=\"authorspan\"><a href=\"auth.php?authid=$aid&amp;author=" . urlencode($authorname) . "\">$authorname</a></span>";
								}
							}
							if($result2){$result2->free();}

						}
					}
					
					//~ if(($type == "sakshi") || ($type == "samvada") )
					//~ {
						//~ echo "<br /><span class=\"downloadspan\"><a href=\"../Volumes/$type/$volume/$part/index.djvu?djvuopts&amp;page=$page.djvu&amp;zoom=page\" target=\"_blank\">View article</a>&nbsp;|&nbsp;<a href=\"#\">Download article (DjVu)</a>&nbsp;|&nbsp;<a href=\"#\">Download article (PDF)</a></span>";
					//~ }
					//~ elseif($type == "occpapers")
					//~ {
						//~ echo "<br /><span class=\"downloadspan\"><a href=\"../Volumes/occpapers/$paper/index.djvu?djvuopts&amp;page=1&amp;zoom=page\" target=\"_blank\">View article</a>&nbsp;|&nbsp;<a href=\"#\">Download article (DjVu)</a>&nbsp;|&nbsp;<a href=\"#\">Download article (PDF)</a></span>";
					//~ }

					if($text != '')
					{
						echo "<br /><span class=\"authorspan\">result(s) found at page no(s). </span>";
						if(($type == "sakshi") || ($type == "samvada") )
						{
							echo "<span class=\"titlespan\"><a href=\"../Volumes/$type/$volume/$part/index.djvu?djvuopts&amp;page=$cur_page.djvu&amp;zoom=page&amp;find=$dtext/r\" target=\"_blank\">".intval($cur_page)."&nbsp;</a></span>";
						}
						//~ elseif($type == "occpapers")
						//~ {
							//~ echo "<span class=\"titlespan\"><a href=\"../Volumes/$type/$paper/index.djvu?djvuopts&amp;page=$cur_page.djvu&amp;zoom=page&amp;find=$dtext/r\" target=\"_blank\">".intval($cur_page)."&nbsp;</a></span>";
						//~ }
						$id = $titleid;
					}
				}
			}
			else
			{
				if($text != '')
				{
					if(($type == "sakshi") || ($type == "samvada") )
					{
						echo "<span class=\"titlespan\"><a href=\"../Volumes/$type/$volume/$part/index.djvu?djvuopts&amp;page=$cur_page.djvu&amp;zoom=page&amp;find=$dtext/r\" target=\"_blank\">".intval($cur_page)."</a> &nbsp;</span>";
						$id = $titleid;
					}
					//~ elseif($type == "occpapers")
					//~ {
						//~ echo "<span class=\"titlespan\"><a href=\"../Volumes/$type/$paper/index.djvu?djvuopts&amp;page=$cur_page.djvu&amp;zoom=page&amp;find=$dtext/r\" target=\"_blank\">".intval($cur_page)."</a> &nbsp;</span>";
						//~ $id = $titleid;
					//~ }
					//~ else
					//~ {
						//~ echo "<span class=\"titlespan\"><a href=\"../Volumes/$type/$book_id/index.djvu?djvuopts&amp;page=$cur_page.djvu&amp;zoom=page&amp;find=$dtext/r\" target=\"_blank\">".intval($cur_page)."</a> &nbsp;</span>";
						//~ $id = $slno;
					//~ }
				}
			}
		}
		echo "</li></ul>";
	}
	else
	{
		echo"<span class=\"titlespan\">No results</span><br />";
		echo"<span class=\"authorspan\"><a href=\"search.php\">Go back and Search again</a></span>";
	}	
	if($result){$result->free();}
	
}
else
{
	echo"<span class=\"titlespan\">Please slect at least one publication</span><br />";
	echo"<span class=\"authorspan\"><a href=\"search.php\">Go back and Search again</a></span>";
}
$db->close();
?>
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
	<script src="../../js/jquery.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
	<script src="../../js/jquery.smooth-scroll.min.js"></script>
	<script src="../../js/jquery.dlmenu.js"></script>
	<script src="../../js/wow.min.js"></script>
	<script src="../../js/custom.js"></script>
</html>

