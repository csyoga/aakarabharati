<?php
	include("header.php");
	include("nav.php");
	include("connect.php");
	require_once("common.php");
	(isset($_GET['journalid']) && $_GET['journalid'] != '') ? $journalID = $_GET['journalid'] : $journalID = '';
	(isset($_GET['letter']) && $_GET['letter'] != '') ? $letter = $_GET['letter'] : $letter = 'ಅ' ;
	
	$query = "SELECT * FROM journaldetails WHERE id = '$journalID'";
	$result = $db->query($query);
	$num_rows = $result ? $result->num_rows : 0;
	if($num_rows > 0)
	{
		$row = $result->fetch_assoc();
	}
	else
	{
		echo "<div class=\"center\">No Journals found. Please try again.</div>";
		echo "</main>";
		include("footer.php");
		exit();
	}
?>
	<main class="cd-main-content">
		<?php include("sec_nav.php"); ?>
		<section id="about">
			<h2><?php echo $row['title']; ?></h2>
			<h4><br><?php echo $row['details']; ?></h4>
			<div id="about_p">
				<div class="page_title"><i class="fa fa-pencil"></i>&nbsp;&nbsp;ಲೇಖನಗಳು</div>
			<div class="alphabet">
				<?php echo "<span class=\"letter\"><a href=\"articles.php?letter=ಅ&amp;journalid=$journalID\">ಅ</a></span>"; ?>
				<?php echo "<span class=\"letter\"><a href=\"articles.php?letter=ಆ&amp;journalid=$journalID\">ಆ</a></span>"; ?>
				<?php echo "<span class=\"letter\"><a href=\"articles.php?letter=ಇ&amp;journalid=$journalID\">ಇ</a></span>"; ?>
				<?php echo "<span class=\"letter\"><a href=\"articles.php?letter=ಈ&amp;journalid=$journalID\">ಈ</a></span>"; ?>
				<?php echo "<span class=\"letter\"><a href=\"articles.php?letter=ಉ&amp;journalid=$journalID\">ಉ</a></span>"; ?>
				<?php echo "<span class=\"letter\"><a href=\"articles.php?letter=ಋ&amp;journalid=$journalID\">ಋ</a></span>"; ?>
				<?php echo "<span class=\"letter\"><a href=\"articles.php?letter=ಎ&amp;journalid=$journalID\">ಎ</a></span>"; ?>
				<?php echo "<span class=\"letter\"><a href=\"articles.php?letter=ಏ&amp;journalid=$journalID\">ಏ</a></span>"; ?>
				<?php echo "<span class=\"letter\"><a href=\"articles.php?letter=ಐ&amp;journalid=$journalID\">ಐ</a></span>"; ?>
				<?php echo "<span class=\"letter\"><a href=\"articles.php?letter=ಒ&amp;journalid=$journalID\">ಒ</a></span>"; ?>
				<?php echo "<span class=\"letter\"><a href=\"articles.php?letter=ಔ&amp;journalid=$journalID\">ಔ</a></span>"; ?>
				<?php echo "<span class=\"letter\"><a href=\"articles.php?letter=ಕ&amp;journalid=$journalID\">ಕ</a></span>"; ?>
				<?php echo "<span class=\"letter\"><a href=\"articles.php?letter=ಖ&amp;journalid=$journalID\">ಖ</a></span>"; ?>
				<?php echo "<span class=\"letter\"><a href=\"articles.php?letter=ಗ&amp;journalid=$journalID\">ಗ</a></span>"; ?>
				<?php echo "<span class=\"letter\"><a href=\"articles.php?letter=ಘ&amp;journalid=$journalID\">ಘ</a></span>"; ?>
				<?php echo "<span class=\"letter\"><a href=\"articles.php?letter=ಚ&amp;journalid=$journalID\">ಚ</a></span>"; ?>
				<?php echo "<span class=\"letter\"><a href=\"articles.php?letter=ಛ&amp;journalid=$journalID\">ಛ</a></span>"; ?>
				<?php echo "<span class=\"letter\"><a href=\"articles.php?letter=ಜ&amp;journalid=$journalID\">ಜ</a></span>"; ?>
				<?php echo "<span class=\"letter\"><a href=\"articles.php?letter=ಟ&amp;journalid=$journalID\">ಟ</a></span>"; ?>
				<?php echo "<span class=\"letter\"><a href=\"articles.php?letter=ಡ&amp;journalid=$journalID\">ಡ</a></span>"; ?>
				<?php echo "<span class=\"letter\"><a href=\"articles.php?letter=ತ&amp;journalid=$journalID\">ತ</a></span>"; ?>
				<?php echo "<span class=\"letter\"><a href=\"articles.php?letter=ದ&amp;journalid=$journalID\">ದ</a></span>"; ?>
				<?php echo "<span class=\"letter\"><a href=\"articles.php?letter=ನ&amp;journalid=$journalID\">ನ</a></span>"; ?>
				<?php echo "<span class=\"letter\"><a href=\"articles.php?letter=ಪ&amp;journalid=$journalID\">ಪ</a></span>"; ?>
				<?php echo "<span class=\"letter\"><a href=\"articles.php?letter=ಬ&amp;journalid=$journalID\">ಬ</a></span>"; ?>
				<?php echo "<span class=\"letter\"><a href=\"articles.php?letter=ಮ&amp;journalid=$journalID\">ಮ</a></span>"; ?>
				<?php echo "<span class=\"letter\"><a href=\"articles.php?letter=ಯ&amp;journalid=$journalID\">ಯ</a></span>"; ?>
				<?php echo "<span class=\"letter\"><a href=\"articles.php?letter=ರ&amp;journalid=$journalID\">ರ</a></span>"; ?>
				<?php echo "<span class=\"letter\"><a href=\"articles.php?letter=ಲ&amp;journalid=$journalID\">ಲ</a></span>"; ?>
				<?php echo "<span class=\"letter\"><a href=\"articles.php?letter=ವ&amp;journalid=$journalID\">ವ</a></span>"; ?>
				<?php echo "<span class=\"letter\"><a href=\"articles.php?letter=ಶ&amp;journalid=$journalID\">ಶ</a></span>"; ?>
				<?php echo "<span class=\"letter\"><a href=\"articles.php?letter=ಸ&amp;journalid=$journalID\">ಸ</a></span>"; ?>
				<?php echo "<span class=\"letter\"><a href=\"articles.php?letter=ಹ&amp;journalid=$journalID\">ಹ</a></span>"; ?>
				<?php echo "<span class=\"letter\"><a href=\"articles.php?letter=Special&amp;journalid=$journalID\">#</a></span"; ?>>
			</div>
<?php
	
	$query = 'select * from journals where journalid = ' . $journalID . ' and title like \'' . $letter . '%\' order by title, part, page';
	$result = $db->query($query); 
	$num_rows = $result ? $result->num_rows : 0;
	
	if($num_rows > 0)
	{
		while($row = $result->fetch_assoc())
		{
			echo '<div class="article">';
			echo '	<div class="gapBelowSmall">';
			
			$part = '';
			$page = preg_split('/-/', $row['page']);
			$page_start = $page[0];
			
			$split = preg_split('/-/', $row['part']);
			foreach($split as $pnum) $part .= getKannadaNumbers(intval($pnum)) . '-'; 
			$part = preg_replace('/-$/', '', $part);
			if(strcmp($row['volume'] , '000') == 0)
			{
				$isVolumePart = 'false';
				echo '		<span class="aIssue"><a href="toc.php?journalid=' . $journalID . '&amp;volume=' . $row['volume'] . '&amp;part='.$row['part'].'&amp;isVolumePart='. $isVolumePart .'">ಸಂಪುಟ ' . $part . '</a></span>';
			}
			else
			{
				$isVolumePart = 'true';
				echo '		<span class="aIssue"><a href="part.php?journalid=' . $journalID . '&amp;volume=' . $row['volume'] . '&amp;isVolumePart='. $isVolumePart .'">ಸಂಪುಟ ' . getKannadaNumbers(intval($row['volume'])) . '</a> |</span>';
				echo '		<span class="aIssue"><a href="toc.php?journalid=' . $journalID . '&amp;volume=' . $row['volume'] . '&amp;part='.$row['part'].'&amp;isVolumePart='. $isVolumePart .'">ಸಂಚಿಕೆ ' . $part . '</a></span>';
			}
			echo ($row['feature'] != '') ? ' | <span class="aFeature clr2"><a href="feat.php?journalid=' . $journalID . '&amp;volume=' . $row['volume'] . '&amp;part='.$row['part'].'&amp;isVolumePart='. $isVolumePart .'&amp;feature=' . $row['feature'] .'">' . $row['feature'] . '</a></span>' : '';
			echo ($row['month'] != '') ? ' | <span class="aFeature clr2"> <a href="javascript:void()">' . getMonth($row['month']) . '</a></span>' : '';
			echo ($row['year'] != '') ? ' <span class="aFeature clr2"><a href="javascript:void()">(' . getKannadaNumbers($row['year']) . ')</a></span>' : '';
			
			echo '</div>';
			//~ Djvu Link
			//~ echo '	<span class="aTitle"><a target="_blank" href="../Volumes/djvu/journals/' . $journalID . '/' . $row['volume'] . '/' . $row['part'] . '/index.djvu?djvuopts&amp;page=' . $page_start . '.djvu&amp;zoom=page">' . $row['title'] . '</a></span><br />';
			
			//~ Bookreader Link
			echo '	<span class="aTitle"><a target="_blank" href="bookReader.php?journalid=' . $journalID . '&amp;volume=' . $row['volume'] . '&amp;part=' . $row['part'] . '&amp;page=' . $page_start . '">' . $row['title'] . '</a></span><br />';
			
			
			//~ if($isVolumePart === 'true')
			//~ {
				//~ echo '	<span class="aTitle"><a target="_blank" href="../Volumes/djvu/journals/' . $journalID . '/' . $row['volume'] . '/' . $row['part'] . '/index.djvu?djvuopts&amp;page=' . $page_start . '.djvu&amp;zoom=page">' . $row['title'] . '</a></span><br />';
			//~ }
			//~ else
			//~ {
				//~ echo '	<span class="aTitle"><a target="_blank" href="../Volumes/djvu/journals/' . $journalID . '/000/' . $row['part'] . '/index.djvu?djvuopts&amp;page=' . $page_start . '.djvu&amp;zoom=page">' . $row['title'] . '</a></span><br />';
			//~ }
			echo '<span class="aAuthor itl">';
			$authors = json_decode($row['authorname']);
			$displayAuthor = '';
			foreach ($authors as $author)
			{
				if($author->name != '')
				{
					//~ $displayAuthor .=  '<a href="journalAuth.php?authorname=' . urlencode($author->name) . '&amp;journalid=' . $journalID . '">' . $author->name . '</a> | ';
					$displayAuthor .=  '<a href="javascript:void();">' . $author->name . '</a> | ';
				}
			}				
			echo preg_replace('/\ \|\ $/', '', $displayAuthor);
			echo '	</span>';
			echo '</div>';	
		}
	}
	else
	{
		echo '<span class="sml">Sorry! No articles were found to begin with the letter \'' . $letter . '\'</span>';
	}

	if($result){$result->free();}
	$db->close();

?>
			
		</div>
	</div>
</div>
			</div>
	  </section>
	</main>
	<div id="cd-search" class="cd-search">
		<form>
			<input type="search" placeholder="Coming soon...">
		</form>
	</div>
<?php include("footer.php"); ?>
	

