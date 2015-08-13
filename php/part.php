<?php 
	include("header.php");
	include("nav.php");
	include("connect.php");
	require_once("common.php");
	
	(isset($_GET['journalid']) && $_GET['journalid'] != '') ? $journalID = $_GET['journalid'] : $journalID = '';
	(isset($_GET['volume']) && $_GET['volume'] != '') ? $volume = $_GET['volume'] : $volume = '';
		
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
				<div class="page_title"><i class="fa fa-book"></i> ಸಂಪುಟ <?php echo getKannadaNumbers(intval($volume))."ರ";?>&nbsp;ಸಂಚಿಕೆಗಳು</div>
					<div class="volumes">
						<ul>
			<div class="col1">
				<ul>

<?php

$row_count = 4;
$query = "select distinct part from article where journalid = '$journalID' and volume ='$volume' order by volume";
$result = $db->query($query); 
$num_rows = $result ? $result->num_rows : 0;
$count = 0;
$col = 1;

if($num_rows > 0)
{
	while($row = $result->fetch_assoc())
	{
		$part = $row['part'];
		$path = 'toc.php?journalid=' . $journalID . '&amp;volume=' . $volume . '&amp;part=' . $part . '&amp;isVolumePart=true';
		file_exists("img/Journals/" . $journalID . "/cover/" . $volume. "_" . $part . ".jpg") ? $imageUrl = "img/Journals/" . $journalID . "/cover/" . $volume. "_" . $part . ".jpg" : $imageUrl = "img/noimageavailable.jpg";
		echo '<a class="box-shadow-outset" href="' . $path . '"><img src="' . $imageUrl . '" alt="Cover image"><p>ಸಂಚಿಕೆ '. getKannadaNumbers(intval($part)) .'</p></a>';
	}
}
else
{
	echo "No data in the database";
}

if($result){$result->free();}
$db->close();
?>
			</ul>
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
