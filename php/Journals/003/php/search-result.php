<?php
	// If nothing is GETed, redirect to search page
	//~ if(empty($_GET['author']) || empty($_GET['title']) || empty($_GET['text'])) {
		//~ header('Location: search.php');
		//~ exit(1);
	//~ }
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
			<h2>ಮಾತುಕತೆ</h2>
			<h4><br>ಶ್ರೀ ನೀಲಕಂಠೇಶ್ವರ ನಾಟ್ಯ ಸೇವಾ ಸಂಘ</h4>
			<div id="about_p">
				
			<?php

include("connect.php");
require_once("common.php");

if(isset($_GET['author'])){$author = $_GET['author'];}else{$author = '';}
if(isset($_GET['text'])){$text = $_GET['text'];}else{$text = '';}
if(isset($_GET['title'])){$title = $_GET['title'];}else{$title = '';}
//~ if(isset($_GET['featid'])){$featid = $_GET['featid'];}else{$featid = '';}
//~ if(isset($_GET['year1'])){$year1 = $_GET['year1'];}else{$year1 = '';}
//~ if(isset($_GET['year2'])){$year2 = $_GET['year2'];}else{$year2 = '';}

$text = entityReferenceReplace($text);
$author = entityReferenceReplace($author);
$title = entityReferenceReplace($title);
//~ $featid = entityReferenceReplace($featid);
//~ $year1 = entityReferenceReplace($year1);
//~ $year2 = entityReferenceReplace($year2);

$author = preg_replace("/[,\-]+/", " ", $author);
$author = preg_replace("/[\t]+/", " ", $author);
$author = preg_replace("/[ ]+/", " ", $author);
$author = preg_replace("/^ +/", "", $author);
$author = preg_replace("/ +$/", "", $author);
$author = preg_replace("/  /", " ", $author);
$author = preg_replace("/  /", " ", $author);

$title = preg_replace("/[,\-]+/", " ", $title);
$title = preg_replace("/[\t]+/", " ", $title);
$title = preg_replace("/[ ]+/", " ", $title);
$title = preg_replace("/^ +/", "", $title);
$title = preg_replace("/ +$/", "", $title);
$title = preg_replace("/  /", " ", $title);
$title = preg_replace("/  /", " ", $title);

$text = preg_replace("/[,\-]+/", " ", $text);
$text = preg_replace("/[\t]+/", " ", $text);
$text = preg_replace("/[ ]+/", " ", $text);
$text = preg_replace("/^ +/", "", $text);
$text = preg_replace("/ +$/", "", $text);
$text = preg_replace("/  /", " ", $text);
$text = preg_replace("/  /", " ", $text);

if($title=='')
{
    $title='[a-z]*';
}
if($author=='')
{
    $author='[a-z]*';
}
if($featid=='')
{
    $featid='[a-z]*';
}



$authorFilter = '';
$titleFilter = '';

$authors = preg_split("/ /", $author);
$titles = preg_split("/ /", $title);

for($ic=0;$ic<sizeof($authors);$ic++)
{
    $authorFilter .= "and authorname REGEXP '" . $authors[$ic] . "' ";
}
for($ic=0;$ic<sizeof($titles);$ic++)
{
    $titleFilter .= "and title REGEXP '" . $titles[$ic] . "' ";
}

$authorFilter = preg_replace("/^and /", "", $authorFilter);
$titleFilter = preg_replace("/^and /", "", $titleFilter);
$titleFilter = preg_replace("/ $/", "", $titleFilter);

if($text=='')
{
    $query="SELECT * FROM
                (SELECT * FROM
                    (SELECT * FROM
                        (SELECT * FROM article_maatukate WHERE $authorFilter) AS tb1
                    WHERE $titleFilter) AS tb2
                WHERE featid REGEXP '$featid') AS tb3
            ORDER BY  volume,part,titleid,page_start";

}
//~ elseif($text!='')
//~ {
    //~ $text = rtrim($text);
    //~ if(preg_match("/^\"/", $text)) {
//~ 
        //~ $stext = preg_replace("/\"/", "", $text);
        //~ $dtext = $stext;
        //~ $stext = '"' . $stext . '"';
    //~ }
    //~ elseif(preg_match("/\+/", $text)) {
//~ 
        //~ $stext = preg_replace("/\+/", " +", $text);
        //~ $dtext = preg_replace("/\+/", "|", $text);
        //~ $stext = '+' . $stext;
    //~ }
    //~ elseif(preg_match("/\|/", $text)) {
//~ 
        //~ $stext = preg_replace("/\|/", " ", $text);
        //~ $dtext = $text;
    //~ }
    //~ else {
//~ 
        //~ $stext = $text;
        //~ $dtext = $stext = preg_replace("/ /", "|", $text);
    //~ }
    //~ 
    //~ $stext = addslashes($stext);
    //~ 
    //~ $query="(SELECT * FROM
				//~ (SELECT * FROM
					//~ (SELECT * FROM
						//~ (SELECT titleid, title, authid, authorname, page_start, type, featid)
							//~ AS tb10 WHERE authorname REGEXP '$author')
							//~ AS tb20 WHERE title REGEXP '$title')
							//~ AS tb30 WHERE page_start NOT REGEXP '.*')";
//~ }

$result = $db->query($query); 
$num_results = $result ? $result->num_rows : 0;

if ($num_results > 0)
{
    echo '<div class="count">' . $num_results;
    echo ($num_results > 1) ? ' ಫಲಿತಾಂಶಗಳು' : ' ಫಲಿತಾಂಶ';
    echo '</div>';
}

$result = $db->query($query); 
$num_rows = $result ? $result->num_rows : 0;
$id = 0;
if($num_rows > 0)
{
    while($row = $result->fetch_assoc())
    {
        $query3 = 'select feat_name from feature_maatukate where featid=\'' . $row['featid'] . '\'';
        $result3 = $db->query($query3);
        $row3 = $result3->fetch_assoc();
        
        $dpart = preg_replace("/^0/", "", $row['part']);
        $dpart = preg_replace("/\-0/", "-", $dpart);
        
        if($result3){$result3->free();}

        if ((strcmp($id, $row['titleid'])) != 0) {

            echo ($id == "0") ? '<div class="article">' : '</div><div class="article">';

            echo '  <div class="gapBelowSmall">';
       echo ($row3['feat_name'] != '') ? '		<span class="aFeature clr2"><a href="feat.php?feature='.$row3['feat_name'].'&amp;featid='.$row['featid'].' ">' . $row3['feat_name'] . '</a></span> | ' : '';
		echo '		<span class="aIssue clr5"><a href="toc.php?volume='.$row['volume'].'\'&amp;part='. $row['part'] .'">ಸಂಪುಟ '.intval($row['volume']).';&nbsp;ಸಂಚಿಕೆ ' . intval($dpart) . '</a></span>';
		echo '	</div>';
		echo '	<span class="aTitle"><a target="_blank" href="../../../../Volumes/'. 'maatukate'.'/'. $row['volume'] .'/'. $row['part'] . '/index.djvu?djvuopts&amp;page=' . $row['page_start'] . '.djvu&amp;zoom=page_start">' . $row['title'] . '</a></span><br />';
		if($row['authid'] != 0) {

			echo '	<span class="aAuthor itl">by ';
			$authids = preg_split('/;/',$row['authid']);
			$authornames = preg_split('/;/',$row['authorname']);
			$a=0;
			foreach ($authids as $aid) {

				echo '<a href="auth.php?authid='.$aid.'&amp;author='. urlencode($authornames[$a]) .' ">' . $authornames[$a] . '</a> ';
				$a++;
			}
			
			echo '	</span>';
            }
            if($text != '')
            {
                echo '<br /><span class="aIssue">Text match found at page(s) : </span>';
                echo '<span class="aIssue"><a href="../Volumes/' . $row['volume'] . '/' . $row['part'] . '/index.djvu?djvuopts&amp;page=' . $row['cur_page'] . '.djvu&amp;zoom=page&amp;find=' . $dtext . '/r" target="_blank">' . intval($row['cur_page']) . '</a> </span>';
            }
            $id = $row['titleid'];
        }
        else {

            if($text != '')
            {
                echo '&nbsp;<span class="aIssue"><a href="../Volumes/' . $row['volume'] . '/' . $row['part'] . '/index.djvu?djvuopts&amp;page=' . $row['cur_page'] . '.djvu&amp;zoom=page&amp;find=' . $dtext . '/r" target="_blank">' . intval($row['cur_page']) . '</a> </span>';
            }
            $id = $row['titleid'];
        }
    }
}
else
{
    echo '<a href="search.php" class="sml clr2">ಕ್ಷಮಿಸಿ, ಯಾವುದೇ ಫಲಿತಾಂಶವಿಲ್ಲ. ಪುನ: ಪ್ರಯತ್ನಿಸಲು ಈ ಕೊಂಡಿಯನ್ನು ಬಳಸಿ.</a>';
}

if($result){$result->free();}
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
	

