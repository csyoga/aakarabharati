<?php include("header.php");	?>
<?php include("nav.php"); ?>
	<main class="cd-main-content">
<?php include("sec_nav.php"); ?>
		<section id="about">
			<h2>ರಂಗಭೂಮಿ</h2>
			<h4><br>ಒಂದು ಕಲಾ ಪತ್ರಿಕೆ</h4>
			<div id="about_p">
<?php

include("connect.php");
require_once("common.php");

if(isset($_GET['feature'])){$feat_name = $_GET['feature'];}else{$feat_name = '';}
if(isset($_GET['featid'])){$featid = $_GET['featid'];}else{$featid = '';}

echo '<div class="page_title"><i class="fa fa-tag"></i>&nbsp;&nbsp;ಪ್ರಭೇದ&nbsp;'. $feat_name .'</div>   ';

//~ $feat_name = entityReferenceReplace($feat_name);

//~ if(!(isValidFeature($feat_name) && isValidFeatid($featid)))
//~ {
	//~ echo '<span class="aFeature clr2">Invalid URL</span>';
	//~ echo '</div> <!-- cd-container -->';
	//~ echo '</div> <!-- cd-scrolling-bg -->';
	//~ echo '</main> <!-- cd-main-content -->';
	//~ include("include_footer.php");
//~ 
    //~ exit(1);
//~ }

$query = 'select * from article_rb where featid=\'' . $featid . '\' order by  part, page_start';

$result = $db->query($query); 
$num_rows = $result ? $result->num_rows : 0;

if($num_rows > 0)
{
	while($row = $result->fetch_assoc())
	{
		$dpart = preg_replace("/^0/", "", $row['part']);
		$dpart = preg_replace("/\-0/", "-", $dpart);
		
		echo '<div class="article">';
		echo '	<div class="gapBelowSmall">';
		echo '		<span class="aIssue clr5"><a href=""toc.php?volume='.$row['volume'].'\'&amp;part='. $row['part'] .'">ಸಂಪುಟ '.intval($row['volume']).'&nbsp;;&nbsp;ಸಂಚಿಕೆ ' . intval($dpart) . '</a></span>';
		echo '	</div>';
		echo '	<span class="aTitle"><a target="_blank" href="../../../../Volumes/maatukate/' . $row['part'] . '/index.djvu?djvuopts&amp;page=' . $row['page_start'] . '.djvu&amp;zoom=page">' . $row['title'] . '</a></span><br />';
		if($row['authid'] != 0) {

			echo '	<span class="aAuthor itl">by ';
			$authids = preg_split('/;/',$row['authid']);
			$authornames = preg_split('/;/',$row['authorname']);
			$a=0;
			foreach ($authids as $aid) {

				echo '<a href="auth.php?authid='.$aid.'&amp;author='. urlencode($authornames[$a]) .' ">' . $authornames[$a] . '</a> ';
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
	

