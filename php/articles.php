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
	(isset($_GET['letter']) && $_GET['letter'] != '') ? $letter = $_GET['letter'] : $letter = 'ಅ' ;
	$query = 'select * from article where title like \'' . $letter . '%\' order by title, part, page';
	$result = $db->query($query); 
	$num_rows = $result ? $result->num_rows : 0;

	if($num_rows > 0)
	{
		while($row = $result->fetch_assoc())
		{
			echo '<div class="article">';
			echo '	<div class="gapBelowSmall">';
			echo ($row['feature'] != '') ? '		<span class="aFeature clr2"><a href="feat.php?feature='.$row['feature'].' ">' . $row['feature'] . '</a></span> | ' : '';
			echo '		<span class="aIssue clr5"><a href="toc.php?part='.$row['part'].'">ಸಂಚಿಕೆ ' . intval($row['part']) . '</a></span>';
			echo '	</div>';
			echo '	<span class="aTitle"><a target="_blank" href="../../../../Volumes/'. 'sakshi'.'/'. $row['part'] . '/index.djvu?djvuopts&amp;page=.djvu&amp;zoom=page_start">' . $row['title'] . '</a></span><br />';
			//~ if($row['authid'] != 0) {
//~ 
				//~ echo '	<span class="aAuthor itl">by ';
				//~ $authids = preg_split('/;/',$row['authid']);
				//~ $authornames = preg_split('/;/',$row['authorname']);
				//~ $a=0;
				//~ foreach ($authids as $aid) {
//~ 
					//~ echo '<a href="auth.php?authid='.$aid.'&amp;author='. urlencode($authornames[$a]) .' ">' . $authornames[$a] . '</a> ';
					//~ $a++;
				//~ }
				//~ 
				//~ echo '	</span>';
			//~ }
			echo '</div>';
		}
	}
	else
	{
		echo '<span class="sml">Sorry! No articles were found to begin with the letter \'' . $letter . '\' in saakshi</span>';
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
	

