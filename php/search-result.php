<?php
	include("header.php");
	include("nav.php");
	include("connect.php");
	require_once("common.php");
?>
<main class="cd-main-content">
		<section id="about">
			<h2>ಸಮಗ್ರ  ಸಂಗ್ರಹದ ಶೋಧನೆಯ ಫಲಿತಾಂಶ</h2>
<div id="about_p">
	<div class="archive_search">
<?php
	$check = $_POST['check'];
	if(isset($_POST['authorname'])){$authorname = $_POST['authorname'];}else{$authorname = '';}
	if(isset($_POST['text'])){$text = $_POST['text'];}else{$text = '';}
	if(isset($_POST['title'])){$title = $_POST['title'];}else{$title = '';}
	
	$text = entityReferenceReplace($text);
	$author = entityReferenceReplace($authorname);
	$title = entityReferenceReplace($title);
	
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
	
	if($title == '')
	{
		$titleFilter = " WHERE title REGEXP '.*'";
		$titleWords = '';
	}
	else
	{
		$titleWords = preg_split("/ /", $title);
		$titleFilter = " WHERE";
		foreach($titleWords as $tw)
		{
			if($tw != ''){$titleFilter .= " and title REGEXP '$tw'";}
		}
		$titleFilter = preg_replace("/WHERE and/", "WHERE", $titleFilter);
	}
	
	if($authorname == '')
	{
		$authorFilter = " WHERE authorname REGEXP '.*'";
		$authorWords = '';
	}
	else
	{
		$authorWords = preg_split("/ /", $authorname);
		$authorFilter = " WHERE";
		foreach($authorWords as $aw)
		{
			if($aw != ''){$authorFilter .= " and authorname REGEXP '$aw'";}
		}
		$authorFilter = preg_replace("/WHERE and/", "WHERE", $authorFilter);
	}
	
	$query = "SELECT * FROM 
				(SELECT * FROM
					(SELECT * FROM article $authorFilter) AS tb1
				$titleFilter) AS tb2 WHERE journalid = ";
	
	if($text=='')
	{
		for($ic=0;$ic < sizeof($check);$ic++)
		{
			if($check[$ic] != '')
			{
				$query .= $check[$ic] . ' OR journalid = ';
			}
		}
		$query = preg_replace('/ OR journalid = $/', '', $query);
		$query .=' ORDER BY title';
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
		
		for($ic=0;$ic < sizeof($check);$ic++)
		{
			if($check[$ic] != '')
			{
				$query .= $check[$ic] . ' OR journalid = ';
			}
		}
		$query = preg_replace('/ OR journalid = $/', '', $query);
		$query .=' ORDER BY title';
		
	}
	
	$result = $db->query($query) or die ("Query Failed "); 
	$num_results = $result ? $result->num_rows : 0;
	
	if ($num_results > 0)
	{
		echo "<div class=\"page_title\"><span>" . getKannadaNumbers($num_results) . " ಫಲಿತಾಂಶ(ಗಳು)</span></div>";
	}
	
	$titleid[0]=0;
	$count = 1;
	$id = "0";
		
	if($num_results > 0)
	{
		while($row = $result->fetch_assoc())
		{
			$journalID = $row['journalid'];
			$query2 = "SELECT title from journaldetails where id = '" . $journalID . "'";
			$result2 = $db->query($query2) or die ("Query Failed "); 
			$row2 = $result2->fetch_assoc();
			$journalTitle = $row2['title'];
			
			$page = preg_split('/-/', $row['page']);
			$page_start = $page[0];
			
			echo '<div class="article">';
			echo '<div class = "journalTitleSpan" ><a href="javascript:void()"><img src="img/'.$journalID.'.jpg"/></a></div>';
			echo '	<div class="gapBelowSmall">';
			$part = '';

			$split = preg_split('/-/', $row['part']);
			foreach($split as $pnum) $part .= getKannadaNumbers(intval($pnum)) . '-'; 
			$part = preg_replace('/-$/', '', $part);
			if(strcmp($row['volume'] , '000') == 0)
			{
				$isVolumePart = 'false';
				//~ echo '<div class = "journalTitleSpan" ><a href="javascript:void()">' . $journalTitle . '</a></div>';
				echo '<span class="aIssue clr5"><a href="toc.php?journalid=' . $journalID . '&amp;volume=' . $row['volume'] . '&amp;part='.$row['part'].'&amp;isVolumePart='. $isVolumePart .'">ಸಂಪುಟ ' . $part . '</a></span>';
			}
			else
			{
				$isVolumePart = 'true';
				//~ echo '<span class="aIssue clr5"><a href="javascript:void()">' . $journalTitle . '</a> | </span>';
				echo '		<span class="aIssue clr5"><a href="part.php?journalid=' . $journalID . '&amp;volume=' . $row['volume'] . '&amp;isVolumePart='. $isVolumePart .'">ಸಂಪುಟ ' . getKannadaNumbers(intval($row['volume'])) . '</a> |</span>';
				echo '		<span class="aIssue clr5"><a href="toc.php?journalid=' . $journalID . '&amp;volume=' . $row['volume'] . '&amp;part='.$row['part'].'&amp;isVolumePart='. $isVolumePart .'">ಸಂಚಿಕೆ ' . $part . '</a></span>';
			}
			echo ($row['feature'] != '') ? ' | <span class="aFeature clr2"><a href="feat.php?journalid=' . $journalID . '&amp;volume=' . $row['volume'] . '&amp;part='.$row['part'].'&amp;isVolumePart='. $isVolumePart .'&amp;feature=' . $row['feature'] .'">' . $row['feature'] . '</a></span>' : '';
			echo ($row['month'] != '') ? ' | <span class="aFeature clr2"> <a href="javascript:void()">' . getMonth($row['month']) . '</a></span>' : '';
			echo ($row['year'] != '') ? ' <span class="aFeature clr2"><a href="javascript:void()">(' . getKannadaNumbers($row['year']) . ')</a></span>' : '';
			
			echo '</div>';
			
			if($isVolumePart === 'true')
			{
				echo '	<span class="aTitle"><a target="_blank" href="../Volumes/djvu/journals/' . $journalID . '/' . $row['volume'] . '/' . $row['part'] . '/index.djvu?djvuopts&amp;page=' . $page_start . '&amp;zoom=page">' . $row['title'] . '</a></span><br />';
			}
			else
			{
				echo '	<span class="aTitle"><a target="_blank" href="../Volumes/djvu/journals/' . $journalID . '/' . $row['part'] . '/index.djvu?djvuopts&amp;page=' . $page_start . '&amp;zoom=page">' . $row['title'] . '</a></span><br />';
			}
			echo '<span class="aAuthor itl">';
			$authors = json_decode($row['authorname']);
			foreach ($authors as $author)
			{
				if($author->name != '')
				{
					echo '<a href="auth.php?authorname=' . urlencode($author->name) . '&amp;journalid=' . $journalID . '">' . $author->name . '</a> ';
				}
			}				
			echo '	</span>';
			echo '</div>';	
		}
	}
	else
	{
		echo '<span class="sml">Sorry! No articles were found to begin with the letter \'' . $letter . '\' in saakshi</span>';
	}

?>
	</div>
</div>
	  </section>
	</main>
<?php include("footer.php"); ?>
