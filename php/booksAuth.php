<?php 
	include("header.php");
	include("nav.php");
	include("connect.php");
	require_once("common.php");
	
	(isset($_GET['bookid']) && $_GET['bookid'] != '') ? $bookID = $_GET['bookid'] : $bookID = '';
	(isset($_GET['authorname'])&& $_GET['authorname'] != '') ? $authorname = $_GET['authorname'] : $authorname = '';
	
	$query = "SELECT * FROM bookdetails WHERE id = '$bookID'";
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
		<section id="about">
			<h2><br/><?php echo $row['title']; ?></h2>
			<div id="about_p">
<?php
$authorname = entityReferenceReplace($authorname);
$query = "select * from books where authorname like '%" . addslashes($authorname). "%'";
$result = $db->query($query); 
$num_rows = $result ? $result->num_rows : 0;

if($num_rows > 0)
{
	echo '<br/><br/><br/><br/><br/><div class="page_title"><span class="aAuthor"><i class="fa fa-user"></i>&nbsp;&nbsp;'. $authorname .'</span>&nbsp;ರವರು ಬರೆದಿರುವ ಲೇಖನಗಳು </div>';
	while($row = $result->fetch_assoc())
	{
			echo '<div class="article">';
			echo '	<div class="gapBelowSmall">';
			echo '	</div>';
			$part = '';
			$page = preg_split('/-/', $row['page']);
			$page_start = $page[0];
			echo '	<span class="aTitle"><a target="_blank" href="bookReader.php?bookid=' . $bookID . '&amp;page=' . $page_start . '">' . $row['title'] . '</a></span><br />';
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
