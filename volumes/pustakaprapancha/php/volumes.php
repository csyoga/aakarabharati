<?php include('header.php'); ?>
<?php include('nav.php'); ?>
		<div id="about_sakshi">
			<div class="archive_holder">
				<div class="page_title"><i class="fa fa-book"></i>&nbsp;&nbsp;ಸಂಪುಟಗಳು</div>
					<div id="volumes">
						<ul>
							<?php

							include("connect.php");
							require_once("common.php");
							$query = 'select distinct volume from article_pp order by volume';
							$result = $db->query($query); 
							$num_rows = $result ? $result->num_rows : 0;
							if($num_rows > 0)
							{
								while($row = $result->fetch_assoc())
								{
									
									echo '<li><a  class="button hollow"  href="part.php?vol='. $row['volume'] .'"><img src="images/cover/'.$row['volume'].'.png" alt=""><p>'. intval($row['volume']) .'</p></a></li>';
								}
							}
							if($result){$result->free();}
							$db->close();
							?>
						</ul>
					</div>
				</div>
			</div>
		</div>
<?php include("footer.php"); ?>

