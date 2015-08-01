<?php
	(isset($_GET['journalid']) && $_GET['journalid'] != '') ? $journalID = $_GET['journalid'] : $journalID = '';
	include("header.php");
	include("nav.php");
?>
<main class="cd-main-content">
<?php include("sec_nav.php"); ?>
<?php
	include("connect.php");
	require_once("common.php");
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
		<section id="about">
			<h2><?php echo $row['title']; ?></h2>
			<h4><br><?php echo $row['details']; ?></h4>
			<div id="about_p">
				<div class="page_title"><i class="fa fa-book"></i>&nbsp;&nbsp;ಸಂಪುಟಗಳು</div>
					<div class="volumes">
						
							<?php
							$query = "SELECT DISTINCT volume FROM article WHERE journalid = '$journalID'";
							$result = $db->query($query); 
							$num_rows = $result ? $result->num_rows : 0;
							$isVolumePart = true;
							$row = $result->fetch_assoc();
							($num_rows == 1 && strcmp($row['volume'], '000') == 0) ? ($query = "SELECT DISTINCT part FROM article WHERE journalid = '$journalID'" AND $isVolumePart = false) : $query = "SELECT DISTINCT volume FROM article WHERE journalid = '$journalID'";
							
							$result = $db->query($query); 
							$num_rows = $result ? $result->num_rows : 0;
							
							if($num_rows > 0)
							{
								while($row = $result->fetch_assoc())
								{
									($isVolumePart) ? ( $volume = $row['volume'] AND $path = 'part.php?volume=' . $volume) : ( $volume = $row['part'] AND $path = 'toc.php?volume=' . $volume);
									file_exists("Journals/" . $journalID . "/php/images/cover/" . $volume. ".jpg") ? $imageUrl = "Journals/" . $journalID . "/php/images/cover/" . $volume. ".jpg" : $imageUrl = "img/noimageavailable.jpg";
									echo '<a class="box-shadow-outset" href="' . $path . '"><img src="' . $imageUrl . '" alt="Cover image"><p>ಸಂಪುಟ '. intval($volume) .'</p></a>';
								}
							}
							else
							{
								echo "No result Found<br />";
							}
							if($result){$result->free();}
							$db->close();
							?>
						
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
	

