<?php include('header.php'); ?>
<?php include('nav.php'); ?>
		<div id="about_sakshi">
			<div class="archive_holder_maatukate">
				<div class="page_title"><i class="fa fa-book"></i>&nbsp;&nbsp;ಸಂಪುಟಗಳು</div>
					<div id="volumes_maatukate">
												<?php

												include("connect.php");
												require_once("common.php");
												$query = 'select distinct volume from article_pp order by volume';
												$result = $db->query($query); 
												$num_rows = $result ? $result->num_rows : 0;
												//~ $row_count = 10;
												//~ $count = 0;
												//~ $col = 3;
												echo '<ul class="dot">';
												if($num_rows > 0)
												{
													while($row = $result->fetch_assoc())
													{
														
														//~ $count++;
														//~ if($count > $row_count) {
															//~ $count = 1;
														//~ }
														//~ echo '<a href="part.php?vol='. $row['volume'] .'"><div class="button alt" > Volume&nbsp;'. intval($row['volume']) .'&nbsp;&nbsp;('.getYear($row['volume']) . ')</div></a>';
														echo '<li class="button alt" ><a href="part.php?vol='. $row['volume'] .'"><img src="images/volume/'.$row['volume'].'.png" alt=""><p>Volume&nbsp;'. intval($row['volume']) .'</p></a></li>';
													}
												}
												echo '</ul>';
												if($result){$result->free();}
												$db->close();
										?>
		</div>
		</div>
</div>
</div>
	<?php include("footer.php"); ?>

