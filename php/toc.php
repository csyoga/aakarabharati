<?php
	include("header.php");
	include("nav.php");
	include("connect.php");
	require_once("common.php");
	(isset($_GET['journalid']) && $_GET['journalid'] != '') ? $journalID = $_GET['journalid'] : $journalID = '';
	(isset($_GET['volume']) && $_GET['volume'] != '') ? $volume = $_GET['volume'] : $volume = '';
	(isset($_GET['part']) && $_GET['part'] != '') ? $part = $_GET['part'] : $part = '';	
	(isset($_GET['isVolumePart']) && $_GET['isVolumePart'] != '') ? $isVolumePart = $_GET['isVolumePart'] : $isVolumePart = '';
	
	$query = "SELECT * FROM journaldetails WHERE id = '$journalID'";
	$result = $db->query($query);
	$num_rows = $result ? $result->num_rows : 0;
	if($num_rows > 0)
	{
		$row = $result->fetch_assoc();
	}
	else
	{
		echo "<div class=\"center\">No Result found. Please try again.</div>";
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
	$part1 = $part;
	$part = '';
	$split = preg_split('/-/', $part1);
	foreach($split as $pnum) $part .= getKannadaNumbers(intval($pnum)) . '-'; 
	$part = preg_replace('/-$/', '', $part);
	
	if($isVolumePart === 'true')
	{
		$query1 = "SELECT DISTINCT year, month FROM journals WHERE journalid = '$journalID' AND volume = '$volume' AND part = '$part1' ORDER BY year";
		$result = $db->query($query1);
		$row = $result->fetch_assoc();
		$year = $row['year'];
		$month = $row['month'];
		
		echo '<div class="page_title"><i class="fa fa-book"></i>&nbsp;&nbsp;ಸಂಪುಟ ' . getKannadaNumbers(intval($volume)) . ' ಸಂಚಿಕೆ ' . $part;
		if($month != '') echo ' <span class="yearspan">' . getMonth($month) . ', </span>';
		if($year != '') echo ' <span class="yearspan">' . getKannadaNumbers(intval($year)) . '</span>';
		echo  '</div> ';
		$query = "SELECT * FROM journals WHERE journalid = '$journalID' AND volume = '$volume' AND part = '$part1' ORDER BY titleid";
	}
	else
	{
		$query1 = "SELECT DISTINCT year, month FROM journals WHERE journalid = '$journalID' AND part = '$part1' ORDER BY year";
		$result = $db->query($query1);
		$row = $result->fetch_assoc();
		$year = $row['year'];
		$month = $row['month'];
		
		echo '<div class="page_title"><i class="fa fa-book"></i>&nbsp;&nbsp;ಸಂಪುಟ ' . $part;
		if($month != '') echo ' <span class="yearspan">' . getMonth($month) . ', </span>';
		if($year != '') echo ' <span class="yearspan">' . getKannadaNumbers(intval($year)) . '</span>';
		echo  '</div> ';
		$query = "SELECT * FROM journals WHERE journalid = '$journalID' AND part = '$part1' ORDER BY titleid";
	}
	
	$result = $db->query($query); 
	$num_rows = $result ? $result->num_rows : 0;

	if($num_rows > 0)
	{
		while($row = $result->fetch_assoc())
		{
			$page = preg_split('/-/', $row['page']);
			$page_start = $page[0];
			echo '<div class="article">';
			echo ($row['feature'] != '') ? '<div class="gapBelowSmall"><span class="aFeature clr2"><a href="feat.php?journalid=' . $journalID . '&amp;volume=' . $row['volume'] . '&amp;part='.$row['part'].'&amp;isVolumePart='. $isVolumePart .'&amp;feature=' . $row['feature'] .'">' . $row['feature'] . '</a></span></div>' : '';
			
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
					$displayAuthor .=  '<a href="javascript:void();">' . $author->name . '</a> | ';
					//~ $displayAuthor .=  '<a href="journalAuth.php?authorname=' . urlencode($author->name) . '&amp;journalid=' . $journalID . '">' . $author->name . '</a> | ';
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
	

