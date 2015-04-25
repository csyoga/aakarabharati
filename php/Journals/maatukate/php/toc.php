<?php include("header.php"); ?>
<?php include("nav.php"); ?>
		<div id="about_sakshi">
			<div class="archive_holder">
				
<?php

include("connect.php");
require_once("common.php");

if(isset($_GET['part'])){$part = $_GET['part'];}else{$part = '';}

$dpart = preg_replace("/^0/", "", $part);
$dpart = preg_replace("/\-0/", "-", $dpart);

//~ $yearMonth = getYearMonth($volume, $part);

echo '<div class="page_title"><i class="fa fa-pencil"></i>&nbsp;&nbsp;ಸಂಚಿಕೆ.&nbsp;'.$dpart .'</div> ';

//~ if(!(isValidVolume($volume) && isValidPart($part)))
//~ {
	//~ echo '<span class="aFeature clr2">Invalid URL</span>';
	//~ echo '</div> <!-- cd-container -->';
	//~ echo '</div> <!-- cd-scrolling-bg -->';
	//~ echo '</main> <!-- cd-main-content -->';
	//~ include("include_footer.php");
//~ 
    //~ exit(1);
//~ }

$query = 'select * from article_sakshi where part=\'' . $part . '\'';

$result = $db->query($query); 
$num_rows = $result ? $result->num_rows : 0;

if($num_rows > 0)
{
	while($row = $result->fetch_assoc())
	{
		$query3 = 'select feat_name from feature_sakshi where featid=\'' . $row['featid'] . '\'';
		$result3 = $db->query($query3); 
		$row3 = $result3->fetch_assoc();		
		
		$dpart = preg_replace("/^0/", "", $row['part']);
		$dpart = preg_replace("/\-0/", "-", $dpart);
		
		if($result3){$result3->free();}

		echo '<div class="article">';
		echo ($row3['feat_name'] != '') ? '<div class="gapBelowSmall"><span class="aFeature clr2"><a href="feat.php?feature=' . urlencode($row3['feat_name']) . '&amp;featid=' . $row['featid'] . '">' . $row3['feat_name'] . '</a></span></div>' : '';
		echo '	<span class="aTitle"><a target="_blank" href="../Volumes/' . $row['volume'] . '/' . $row['part'] . '/index.djvu?djvuopts&amp;page=' . $row['page'] . '.djvu&amp;zoom=page">' . $row['title'] . '</a></span><br />';
		if($row['authid'] != 0) {

			echo '	<span class="aAuthor itl">by ';
			$authids = preg_split('/;/',$row['authid']);
			$authornames = preg_split('/;/',$row['authorname']);
			$a=0;
			foreach ($authids as $aid) {

				echo '<a href="auth.php?authid=' . $aid . '&amp;author=' . urlencode($authornames[$a]) . '">' . $authornames[$a] . '</a> ';
				$a++;
			}
			
			echo '	</span>';
		}
		echo '</div>';
	}
}

if($result){$result->free();}
$db->close();

?>
			</ul>
		</div>
	</div>
</div>
	<?php include("footer.php"); ?>
