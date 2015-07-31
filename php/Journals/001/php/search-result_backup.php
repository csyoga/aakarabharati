<?php
	// If nothing is GETed, redirect to search page
	if(empty($_GET['author']) && empty($_GET['title']) && empty($_GET['text'])) {
		header('Location: search.php');
		exit(1);
	}
?>

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
	<title>ಆಧುನಿಕ ಕರ್ನಾಟಕದ ಬೌದ್ಧಿಕ ಇತಿಹಾಸ</title>
</head>
<body>
	<header class="cd-main-header">
		<a class="cd-logo" href="../../index.html"><i class="fa fa-home fa-2x"></i></a>
		<ul class="cd-header-buttons">
			<li><a class="cd-search-trigger" href="#cd-search">Search<span></span></a></li>
			<li><a class="cd-nav-trigger" href="#cd-primary-nav">Menu<span></span></a></li>
		</ul> <!-- cd-header-buttons -->
	</header>
<?php include("nav.php"); ?>
	<main class="cd-main-content">
<?php include("sec_nav.php"); ?>
		<section id="about">
			<h2>ಸಾಕ್ಷಿ</h2>
			<h4><br>ಸಾಹಿತ್ಯ ಸಂಸ್ಕೃತಿಗಳ ವಿಚಾರ ವಿಮರ್ಶೆಯ ವೇದಿಕೆ</h4>
			<div id="about_p">
				
			<?php
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

			$author = preg_replace("/[\t]/", " ", $author);
			$author = preg_replace("/[ ]/", " ", $author);
			$author = preg_replace("/^ /", "", $author);

			$title = preg_replace("/[\t]/", " ", $title);
			$title = preg_replace("/[ ]/", " ", $title);
			$title = preg_replace("/^ /", "", $title);

			$text = preg_replace("/[\t]/", " ", $text);
			$text = preg_replace("/[ ]/", " ", $text);
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
				$query = '';
				
				$mtf = '';
				for($ic=0;$ic < sizeof($check);$ic)
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
				elseif(preg_match("/\/", $text))
				{
					$stext = preg_replace("/\/", " ", $text);
					$dtext = preg_replace("/\/", "|", $text);
					$stext = '' . $stext;
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
								
				
				$query = '';
				$mtf = '';
				for($ic=0;$ic<sizeof($check);$ic)
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
			echo "<div class=\"page_title\">$mtf</p><span>ಫಲಿತಾಂಶ</span></div>";
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
				for($i=1;$i<=$num_results;$i)
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
					
					
					if($type == 01)
					{
							$type = "sakshi";
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
						if($type == "sakshi")
						{
							$titleid = $book_id;
							$query_aux = "select * from article_".$type." where titleid='$titleid'";
				
							
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
							
							$paper = $part;
							
							$title = preg_replace('/!!(.*)!!/', "<i>$1</i>", $title);
							$title = preg_replace('/!/', "", $title);
							$title1=addslashes($title);

							if($result_aux){$result_aux->free();}

							$query3 = "select feat_name from feature_".$type." where featid='$featid'";
							

							$result3 = $db->query($query3); 
							$row3 = $result3->fetch_assoc();
							
							$feature=$row3['feat_name'];
							
							if($result3){$result3->free();}
							
							if($type == "sakshi")
							{
							
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
							

							if($text != '')
							{
								echo "<br /><span class=\"authorspan\">result(s) found at page no(s). </span>";
								if(($type == "sakshi") || ($type == "samvada") )
								{
									echo "<span class=\"titlespan\"><a href=\"../Volumes/$type/$volume/$part/index.djvu?djvuopts&amp;page=$cur_page.djvu&amp;zoom=page&amp;find=$dtext/r\" target=\"_blank\">".intval($cur_page)."&nbsp;</a></span>";
								}
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
	

