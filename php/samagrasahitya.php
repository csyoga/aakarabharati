<?php
	include("header.php");
	include("nav.php");
	(isset($_GET['sstitle']) && $_GET['sstitle'] != '') ? $sstitle = $_GET['sstitle'] : $sstitle = '';
?>
<main class="cd-main-content">
		<section id="about">
			<br/><h2><i class="fa fa-book"></i>&nbsp;&nbsp;<?php echo $sstitle; ?> ರವರ ಸಮಗ್ರ ಸಾಹಿತ್ಯ</h2>
			<h4><br></h4>
			<div id="about_p">
				<div class="page_title"></div>
					<div class="volumes">
						
							<?php
							include("connect.php");
							require_once("common.php");
							$query = "SELECT * FROM bookdetails WHERE sstitle = '$sstitle' ORDER BY id";
							$result = $db->query($query); 
							$num_rows = $result ? $result->num_rows : 0;
							if($num_rows > 0)
							{
								echo '<div class="books">';
								while($row = $result->fetch_assoc())
								{
									file_exists("img/books/" . $row['id'] . ".jpg") ? $imageUrl = "img/books/" . $row['id'] . ".jpg" : $imageUrl = "img/noimageavailable.jpg";
									echo '<div class="overlay"> ';
									echo '<a href="booktoc.php?bookid=' . $row['id'] . '"><img src="' . $imageUrl . '" alt="Books Cover image"/></a><br/>';
									echo '<div class="cd-member-info"><a style="display:block;" href="booktoc.php?bookid=' . $row['id'] . '"><span>' . $row['title'] . '</span></a></div>';
									echo '</div>';
								}
								echo '</div>';
							}
							else
							{
								echo "No volume found in this journal<br />";
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
			<input type="search" placeholder="Comming Soon...">
		</form>
	</div>
<?php include("footer.php"); ?>
	

