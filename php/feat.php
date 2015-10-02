<?php
	include("header.php");
	include("nav.php");
	include("connect.php");
	require_once("common.php");
	(isset($_GET['journalid']) && $_GET['journalid'] != '') ? $journalID = $_GET['journalid'] : $journalID = '';
	(isset($_GET['volume']) && $_GET['volume'] != '') ? $volume = $_GET['volume'] : $volume = '';
	(isset($_GET['part']) && $_GET['part'] != '') ? $part = $_GET['part'] : $part = '';	
	(isset($_GET['isVolumePart']) && $_GET['isVolumePart'] != '') ? $isVolumePart = $_GET['isVolumePart'] : $isVolumePart = '';
	(isset($_GET['feature']) && $_GET['feature'] != '') ? $feature = $_GET['feature'] : $feature = '';
	
	$query = "SELECT * FROM journaldetails WHERE id = '$journalID'";
	$result = $db->query($query);
	$num_rows = $result ? $result->num_rows : 0;
	if($num_rows > 0)
	{
		$row = $result->fetch_assoc();
	}
	else
	{
		echo "<div class=\"center\">No Feature found. Please try again.</div>";
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

echo '<div class="page_title"><i class="fa fa-tag"></i>&nbsp;&nbsp;ಪ್ರಭೇದ: &nbsp;<span class="aAuthor">'. $feature .'</span></div>   ';
($isVolumePart === 'true') ? $query = 'SELECT * FROM journals WHERE journalid = \'' . $journalID . '\'  AND feature regexp \'' . addslashes($feature) . '\' order by  titleid' : $query = 'SELECT * FROM journals WHERE journalid = \'' . $journalID . '\' AND feature regexp \'' . $feature . '\' order by  titleid' ;
$result = $db->query($query); 
$num_rows = $result ? $result->num_rows : 0;

if($num_rows > 0)
{
	while($row = $result->fetch_assoc())
	{
		$part = '';
		$split = preg_split('/-/', $row['part']);
		
		$page = preg_split('/-/', $row['page']);
		$page_start = $page[0];
		
		foreach($split as $pnum) $part .= getKannadaNumbers(intval($pnum)) . '-'; 
		$part = preg_replace('/-$/', '', $part);

		echo '<div class="article">';
		echo '	<div class="gapBelowSmall">';
		if(strcmp($row['volume'] , '000') == 0)
		{
			echo '		<span class="aIssue clr5"><a href="toc.php?journalid=' . $journalID . '&amp;volume=' . $row['volume'] . '&amp;part='.$row['part'].'&amp;isVolumePart='. $isVolumePart .'">ಸಂಪುಟ ' . $part . '</a></span>';
		}
		else
		{
			echo '		<span class="aIssue clr5"><a href="part.php?journalid=' . $journalID . '&amp;volume=' . $row['volume'] . '&amp;isVolumePart='. $isVolumePart .'">ಸಂಪುಟ ' . getKannadaNumbers(intval($row['volume'])) . '</a> |</span>';
			echo '		<span class="aIssue clr5"><a href="toc.php?journalid=' . $journalID . '&amp;volume=' . $row['volume'] . '&amp;part='.$row['part'].'&amp;isVolumePart='. $isVolumePart .'">ಸಂಚಿಕೆ ' . $part . '</a></span>';
		}
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
				$displayAuthor .=  '<a href="journalAuth.php?authorname=' . urlencode($author->name) . '&amp;journalid=' . $journalID . '">' . $author->name . '</a> | ';
			}
		}				
		echo preg_replace('/\ \|\ $/', '', $displayAuthor);
		echo '	</span>';
		echo '</div>';	
	}
}

if($result){$result->free();}
$db->close();

?>
			
		</div>
	</div>
</div>
			</div>
	  </main>
	<div id="cd-search" class="cd-search">
		<form>
			<input type="search" placeholder="Coming soon...">
		</form>
	</div>
<?php include("footer.php"); ?>
	

