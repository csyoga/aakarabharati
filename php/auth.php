<?php 
	include("header.php");
	include("nav.php");
	include("connect.php");
	require_once("common.php");
	
	(isset($_GET['journalid']) && $_GET['journalid'] != '') ? $journalID = $_GET['journalid'] : $journalID = '';
	(isset($_GET['authorname'])&& $_GET['authorname'] != '') ? $authorname = $_GET['authorname'] : $authorname = '';
	
	$query = "SELECT * FROM journaldetails WHERE id = '$journalID'";
	$result = $db->query($query);
	$num_rows = $result ? $result->num_rows : 0;
	if($num_rows > 0)
	{
		$row = $result->fetch_assoc();
	}
	else
	{
		echo "<div class=\"center\">No Articles found. Please try again.</div>";
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
<?php
$authorname = entityReferenceReplace($authorname);
$query = "select * from article where authorname like '%" . $authorname. "%' and journalid = '" . $journalID . "'";
$result = $db->query($query); 
$num_rows = $result ? $result->num_rows : 0;

if($num_rows > 0)
{
	echo '<div class="page_title"><i class="fa fa-user"></i>&nbsp;&nbsp;'. $authorname .'&nbsp;ರವರು ಬರೆದಿರುವ ಲೇಖನಗಳು </div>';
	while($row = $result->fetch_assoc())
	{
			echo '<div class="article">';
			echo '	<div class="gapBelowSmall">';
			$part = '';
			$page = preg_split('/-/', $row['page']);
			$page_start = $page[0];
			
			$split = preg_split('/-/', $row['part']);
			foreach($split as $pnum) $part .= intval($pnum) . '-'; 
			$part = preg_replace('/-$/', '', $part);
			if(strcmp($row['volume'] , '000') == 0)
			{
				$isVolumePart = 'false';
				echo '		<span class="aIssue clr5"><a href="toc.php?journalid=' . $journalID . '&amp;volume=' . $row['volume'] . '&amp;part='.$row['part'].'&amp;isVolumePart='. $isVolumePart .'">ಸಂಪುಟ ' . getKannadaNumbers($part) . '</a></span>';
			}
			else
			{
				$isVolumePart = 'true';
				echo '		<span class="aIssue clr5"><a href="part.php?journalid=' . $journalID . '&amp;volume=' . $row['volume'] . '&amp;isVolumePart='. $isVolumePart .'">ಸಂಪುಟ ' . getKannadaNumbers(intval($row['volume'])) . '</a> |</span>';
				echo '		<span class="aIssue clr5"><a href="toc.php?journalid=' . $journalID . '&amp;volume=' . $row['volume'] . '&amp;part='.$row['part'].'&amp;isVolumePart='. $isVolumePart .'">ಸಂಚಿಕೆ ' . getKannadaNumbers($part) . '</a></span>';
				
			}
			
			echo ($row['feature'] != '') ? ' | <span class="aFeature clr2"><a href="feat.php?journalid=' . $journalID . '&amp;volume=' . $row['volume'] . '&amp;part='.$row['part'].'&amp;isVolumePart='. $isVolumePart .'&amp;feature=' . $row['feature'] .'">' . $row['feature'] . '</a></span>' : '';
			echo ($row['month'] != '') ? ' | <span class="aFeature clr2"> <a href="javascript:void()">' . getMonth($row['month']) . '</a></span>' : '';
			echo ($row['year'] != '') ? ' <span class="aFeature clr2"><a href="javascript:void()">(' . getKannadaNumbers($row['year']) . ')</a></span>' : '';
			echo '	</div>';
			if($isVolumePart === 'true')
			{
				echo '	<span class="aTitle"><a target="_blank" href="../Volumes/djvu/journals/' . $journalID . '/' . $row['volume'] . '/' . $row['part'] . '/index.djvu?djvuopts&amp;page=' . $page_start . '&amp;zoom=page">' . $row['title'] . '</a></span><br />';
			}
			else
			{
				echo '	<span class="aTitle"><a target="_blank" href="../Volumes/djvu/journals/' . $journalID . '/000/' . $row['part'] . '/index.djvu?djvuopts&amp;page=' . $page_start . '&amp;zoom=page">' . $row['title'] . '</a></span><br />';
			}
			echo '	<span class="aAuthor itl">';
			echo '	</span>';
			echo '</div>';
	}
}
else
{
	echo '<div class="page_title"><i class="fa fa-user"></i>&nbsp;&nbsp;No Results Found</div>';
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
<?php include("footer.php"); ?>
