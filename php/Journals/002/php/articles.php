<?php include("header.php");	?>
<?php include("nav.php"); ?>
	<main class="cd-main-content">
<?php include("sec_nav.php"); ?>
		<section id="about">
			<h2>ಸಂವಾದ</h2>
			<h4><br>ಸಾಹಿತ್ಯಿಕ - ಸಾಂಸ್ಕೃತಿಕ ದ್ವೈಮಾಸಿಕ ಸಂಕಲನ</h4>
			<div id="about_p">
				<div class="page_title"><i class="fa fa-pencil"></i>&nbsp;&nbsp;ಲೇಖನಗಳು</div>
			<div class="alphabet">
				<span class="letter"><a href="articles.php?letter=ಅ">ಅ</a></span>
				<span class="letter"><a href="articles.php?letter=ಆ">ಆ</a></span>
				<span class="letter"><a href="articles.php?letter=ಇ">ಇ</a></span>
				<span class="letter"><a href="articles.php?letter=ಈ">ಈ</a></span>
				<span class="letter"><a href="articles.php?letter=ಉ">ಉ</a></span>
				<span class="letter"><a href="articles.php?letter=ಋ">ಋ</a></span>
				<span class="letter"><a href="articles.php?letter=ಎ">ಎ</a></span>
				<span class="letter"><a href="articles.php?letter=ಏ">ಏ</a></span>
				<span class="letter"><a href="articles.php?letter=ಐ">ಐ</a></span>
				<span class="letter"><a href="articles.php?letter=ಒ">ಒ</a></span>
				<span class="letter"><a href="articles.php?letter=ಔ">ಔ</a></span>
				<span class="letter"><a href="articles.php?letter=ಕ">ಕ</a></span>
				<span class="letter"><a href="articles.php?letter=ಖ">ಖ</a></span>
				<span class="letter"><a href="articles.php?letter=ಗ">ಗ</a></span>
				<span class="letter"><a href="articles.php?letter=ಘ">ಘ</a></span>
				<span class="letter"><a href="articles.php?letter=ಚ">ಚ</a></span>
				<span class="letter"><a href="articles.php?letter=ಛ">ಛ</a></span>
				<span class="letter"><a href="articles.php?letter=ಜ">ಜ</a></span>
				<span class="letter"><a href="articles.php?letter=ಟ">ಟ</a></span>
				<span class="letter"><a href="articles.php?letter=ಡ">ಡ</a></span>
				<span class="letter"><a href="articles.php?letter=ತ">ತ</a></span>
				<span class="letter"><a href="articles.php?letter=ದ">ದ</a></span>
				<span class="letter"><a href="articles.php?letter=ನ">ನ</a></span>
				<span class="letter"><a href="articles.php?letter=ಪ">ಪ</a></span>
				<span class="letter"><a href="articles.php?letter=ಬ">ಬ</a></span>
				<span class="letter"><a href="articles.php?letter=ಮ">ಮ</a></span>
				<span class="letter"><a href="articles.php?letter=ಯ">ಯ</a></span>
				<span class="letter"><a href="articles.php?letter=ರ">ರ</a></span>
				<span class="letter"><a href="articles.php?letter=ಲ">ಲ</a></span>
				<span class="letter"><a href="articles.php?letter=ವ">ವ</a></span>
				<span class="letter"><a href="articles.php?letter=ಶ">ಶ</a></span>
				<span class="letter"><a href="articles.php?letter=ಸ">ಸ</a></span>
				<span class="letter"><a href="articles.php?letter=ಹ">ಹ</a></span>
				<span class="letter"><a href="articles.php?letter=Special">#</a></span>
			</div>
<?php

include("connect.php");
require_once("common.php");

if(isset($_GET['letter']))
{
	$letter=$_GET['letter'];
	
	//~ if(!(isValidLetter($letter)))
	//~ {
		//~ echo '<span class="aFeature clr2">Invalid URL</span>';
		//~ echo '</div> <!-- cd-container -->';
		//~ echo '</div> <!-- cd-scrolling-bg -->';
		//~ echo '</main> <!-- cd-main-content -->';
		//~ include("include_footer.php");
//~ 
        //~ exit(1);
	//~ }
	
	($letter == '') ? $letter = 'ಅ' : $letter = $letter;
}
else
{
	$letter = 'ಅ';
}

$query = 'select * from article_samvada where title like \'' . $letter . '%\' order by title, part, page_start';

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
		echo ($row3['feat_name'] != '') ? '		<span class="aFeature clr2"><a href="feat.php?feature='.$row3['feat_name'].'&amp;featid='.$row3['featid'].' ">' . $row3['feat_name'] . '</a></span> | ' : '';
		echo '		<span class="aIssue clr5"><a href="">ಸಂಚಿಕೆ ' . intval($dpart) . '</a></span>';
		echo '	</div>';
		echo '	<span class="aTitle"><a target="_blank" href="../../../../Volumes/'. 'samvada'.'/'. $row['part'] . '/index.djvu?djvuopts&amp;page=' . $row['page_start'] . '.djvu&amp;zoom=page_start">' . $row['title'] . '</a></span><br />';
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
else
{
	echo '<span class="sml">Sorry! No articles were found to begin with the letter \'' . $letter . '\' in samvada</span>';
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
	

