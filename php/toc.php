<?php
	include("header.php");
	include("nav.php");
	include("connect.php");
	require_once("common.php");
	(isset($_GET['journalid']) && $_GET['journalid'] != '') ? $journalID = $_GET['journalid'] : $journalID = '';
	(isset($_GET['part']) && $_GET['part'] != '') ? $part = $_GET['part'] : $part = '';	
	(isset($_GET['volume']) && $_GET['volume'] != '') ? $volume = $_GET['volume'] : $volume = '';
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
	(strcmp($volume , '000') == 0 ) ? $subheading = 'ಸಂಪುಟ' : $subheading =  'ಸಂಪುಟ ' . intval($volume) . ' ಸಂಚಿಕೆ' ;
	echo '<div class="page_title"><i class="fa fa-book"></i>&nbsp;&nbsp;' . $subheading . '&nbsp;'.intval($part) .'</div> ';
	(strcmp($isVolumePart , 'false') != 0) ? $query = "SELECT * FROM article WHERE journalid = '$journalID' AND volume = '$volume' AND part = '$part' ORDER BY titleid" : $query = "SELECT * FROM article WHERE journalid = '$journalID' AND part = '$part' ORDER BY titleid";
	$result = $db->query($query); 
	$num_rows = $result ? $result->num_rows : 0;

	if($num_rows > 0)
	{
		while($row = $result->fetch_assoc())
		{
			echo '<div class="article">';
			echo ($row['feature'] != '') ? '<div class="gapBelowSmall"><span class="aFeature clr2"><a href="feat.php?feature=' . urlencode($row['feature']) . '">' . $row['feature'] . '</a></span></div>' : '';
			echo '	<span class="aTitle"><a target="_blank" href="../Volumes/' . $row['volume'] . '/' . $row['part'] . '/index.djvu?djvuopts&amp;page=' . $row['page'] . '.djvu&amp;zoom=page">' . $row['title'] . '</a></span><br />';
			echo '	<span class="aAuthor itl">';
			$authors = json_decode($row['authorname']);
			foreach ($authors as $author)
			{
				if($author->name != '')
				{
					echo '<a href="auth.php?journalid=' . $journalID . '&amp;authorname=' . $author->name . '&amp;volume=' . $row['volume'] . '">' . $author->name . '</a> ';
				}
			}				
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
	  </section>
	</main>
	<div id="cd-search" class="cd-search">
		<form>
			<input type="search" placeholder="Search...">
		</form>
	</div>
<?php include("footer.php"); ?>
	

