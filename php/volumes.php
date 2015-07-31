<?php include("header.php");	?>
<?php include("nav.php"); ?>
<main class="cd-main-content">
<?php include("sec_nav.php"); ?>
<?php
	(isset($_GET['journalid']) && $_GET['journalid'] != '') ? $journalID = $_GET['journalid'] : $journalID = '003';
	include("connect.php");
	require_once("common.php");
	$query = "SELECT * FROM journaldetails WHERE id = '$journalID'";
	$result = $db->query($query);
	$num_rows = $result ? $result->num_rows : 0;
	if($num_rows > 0)
	{
		$row = $result->fetch_assoc();
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
							if($num_rows > 0)
							{
								while($row = $result->fetch_assoc())
								{
									echo '<a class="box-shadow-outset" href="part.php?volume='. $row['volume'] .'"><img src="Journals/' . $journalID . '/php/images/cover/'. $row['volume'] .'.jpg" alt="Cover image"><p>ಸಂಪುಟ '. intval($row['volume']) .'</p></a>';
								}
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
	

