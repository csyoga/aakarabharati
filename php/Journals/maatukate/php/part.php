<?php include('header.php'); ?>
<?php include('nav.php'); ?>
		<div id="about_sakshi">
			<?php

				include("connect.php");
				require_once("common.php");

				if(isset($_GET['vol'])){$volume = $_GET['vol'];}else{$volume = '';}

				if(!(isValidVolume($volume)))
				{
					exit(1);
				}

				$query = "select distinct year,part,month from article_maatukate where volume='$volume' order by part";
				$result = $db->query($query); 
				$num_rows = $result ? $result->num_rows : 0;
				echo '<div class="archive_holder">';		
				echo '<div class="page_title"><i class="fa fa-book"></i>&nbsp;&nbsp;ಸಂಪುಟ&nbsp;'.intval($volume).'</div>';
			?>
			
				<div id="volumes">
					<ul>
				
											<?php

												if($num_rows > 0)
												{
													$isFirst = 1;
													while($row = $result->fetch_assoc())
													{
														//~ echo '<a href="toc.php?vol='.$volume.'&amp;part='.$row['part'].'">';
														echo '<li><a  class="button hollow" href="toc.php?vol='.$volume.'&amp;part='.$row['part'].'"><img src="images/cover/'. $volume .'_'.$row['part'].'.jpg" alt="Cover image"><p>'. $row['month'] .'</p></a></li>';
														//~ echo getMonth_part($row['month']);
														$isFirst = 0;
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
