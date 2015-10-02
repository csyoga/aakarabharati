<?php 
	include("header.php");
	include("nav.php");
	include("connect.php");
	require_once("common.php");
	
	(isset($_GET['journalid']) && $_GET['journalid'] != '') ? $journalID = $_GET['journalid'] : $journalID = '';
	
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
				<div class="page_title"><i class="fa fa-pencil"></i>&nbsp;&nbsp;ಲೇಖಕರು</div>
<?php
	$query = 'select distinct authorname from journals where journalid = ' . $journalID . ' order by authorname';
	$result = $db->query($query); 
	$num_rows = $result ? $result->num_rows : 0;

	if($num_rows > 0)
	{
		while($row = $result->fetch_assoc())
		{
			$author = json_decode($row['authorname']);
			if($author != NULL)
			{
				echo '<div class="author">';
				echo '	<span class="aAuthor"><a href="journalAuth.php?authorname=' . urlencode($author[0]->name) . '&amp;journalid=' . $journalID . '">' . $author[0]->name . '</a> ';
				echo '</div>';
			}
		}
	}
	else
	{
		echo '<span class="sml">Sorry! No author names were found to begin with the letter \'' . $letter . '\' in sakshi</span>';
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
	

