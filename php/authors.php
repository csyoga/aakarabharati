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
<!--
			<div class="alphabet">
				<span class="letter"><a href="authors.php?letter=ಅ">ಅ</a></span>
				<span class="letter"><a href="authors.php?letter=ಆ">ಆ</a></span>
				<span class="letter"><a href="authors.php?letter=ಉ">ಉ</a></span>
				<span class="letter"><a href="authors.php?letter=ಊ">ಊ</a></span>
				<span class="letter"><a href="authors.php?letter=ಎ">ಎ</a></span>
				<span class="letter"><a href="authors.php?letter=ಕ">ಕ</a></span>
				<span class="letter"><a href="authors.php?letter=ಗ">ಗ</a></span>
				<span class="letter"><a href="authors.php?letter=ಚ">ಚ</a></span>
				<span class="letter"><a href="authors.php?letter=ಜ">ಜ</a></span>
				<span class="letter"><a href="authors.php?letter=ತ">ತ</a></span>
				<span class="letter"><a href="authors.php?letter=ದ">ದ</a></span>
				<span class="letter"><a href="authors.php?letter=ನ">ನ</a></span>
				<span class="letter"><a href="authors.php?letter=ಪ">ಪ</a></span>
				<span class="letter"><a href="authors.php?letter=ಬ">ಬ</a></span>
				<span class="letter"><a href="authors.php?letter=ಭ">ಭ</a></span>
				<span class="letter"><a href="authors.php?letter=ಮ">ಮ</a></span>
				<span class="letter"><a href="authors.php?letter=ಯ">ಯ</a></span>
				<span class="letter"><a href="authors.php?letter=ರ">ರ</a></span>
				<span class="letter"><a href="authors.php?letter=ಲ">ಲ</a></span>
				<span class="letter"><a href="authors.php?letter=ವ">ವ</a></span>
				<span class="letter"><a href="authors.php?letter=ಶ">ಶ</a></span>
				<span class="letter"><a href="authors.php?letter=ಸ">ಸ</a></span>
				<span class="letter"><a href="authors.php?letter=ಹ">ಹ</a></span>
			</div>
-->
<?php
	$query = 'select distinct authorname from article where journalid = ' . $journalID . ' order by authorname ';
	$result = $db->query($query); 
	$num_rows = $result ? $result->num_rows : 0;

	if($num_rows > 0)
	{
		while($row = $result->fetch_assoc())
		{
			$author = json_decode($row['authorname']);
			if($author[0]->name != '')
			{
				echo '<div class="author">';
				echo '	<span class="aAuthor"><a href="auth.php?authorname=' . urlencode($author[0]->name) . '&amp;journalid=' . $journalID . '">' . $author[0]->name . '</a> ';
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
			<input type="search" placeholder="Search...">
		</form>
	</div>
<?php include("footer.php"); ?>
	

