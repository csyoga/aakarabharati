<?php include("header.php");	?>
<?php include("nav.php"); ?>
	<main class="cd-main-content">
<?php include("sec_nav.php"); ?>
		<section id="about">
			<h2>ಸಂವಾದ</h2>
			<h4><br>ಸಾಹಿತ್ಯಿಕ - ಸಾಂಸ್ಕೃತಿಕ ದ್ವೈಮಾಸಿಕ ಸಂಕಲನ</h4>
			<div id="about_p">
				
			
<?php

include("connect.php");
require_once("common.php");

if(isset($_GET['authid'])){$authid = $_GET['authid'];}else{$authid = '';}
if(isset($_GET['author'])){$authorname = $_GET['author'];}else{$authorname = '';}

echo '<div class="page_title"><i class="fa fa-user"></i>&nbsp;&nbsp;'. $authorname .'&nbsp;ರವರು ಬರೆದಿರುವ ಲೇಖನಗಳು </div>';

$authorname = entityReferenceReplace($authorname);

//~ if(!(isValidAuthid($authid) && isValidAuthor($authorname)))
//~ {
	//~ echo '<span class="aFeature clr2">Invalid URL</span>';
	//~ echo '</div> <!-- cd-container -->';
	//~ echo '</div> <!-- cd-scrolling-bg -->';
	//~ echo '</main> <!-- cd-main-content -->';
	//~ include("include_footer.php");
//~ 
    //~ exit(1);
//~ }

$query = 'select * from article_samvada where authid like \'%' . $authid . '%\'';

$result = $db->query($query); 
$num_rows = $result ? $result->num_rows : 0;

if($num_rows > 0)
{
	while($row = $result->fetch_assoc())
	{
		$query3 = 'select feat_name from feature_samvada where featid=\'' . $row['featid'] . '\'';
		$result3 = $db->query($query3); 
		$row3 = $result3->fetch_assoc();		

		$dpart = preg_replace("/^0/", "", $row['part']);
		$dpart = preg_replace("/\-0/", "-", $dpart);

		if($result3){$result3->free();}
		
		echo '<div class="article">';
		echo '	<div class="gapBelowSmall">';
		echo ($row3['feat_name'] != '') ? '		<span class="aFeature clr2"><a href="feat.php?feature=' . urlencode($row3['feat_name']) . '&amp;featid=' . $row['featid'] . '">' . $row3['feat_name'] . '</a></span> | ' : '';
		echo '		<span class="aIssue clr5"><a href="toc.php?part=' . $row['part'] . '">' . 'ಸಂಚಿಕೆ ' . $dpart . '</a></span>';
		echo '	</div>';
		echo '	<span class="aTitle"><a target="_blank" href="../../../../Volumes/samvada'  . '/' . $row['part'] . '/index.djvu?djvuopts&amp;page=' . $row['page_start'] . '.djvu&amp;zoom=page">' . $row['title'] . '</a></span>';
		echo '</div>';
	}
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
	

