<?php include("header.php");	?>
<?php include("nav.php"); ?>
	<main class="cd-main-content">
<?php include("sec_nav.php"); ?>
		<section id="about">
			<h2>ಅರಿವು ಬರಹ</h2>
			<h4><br>ಸಾಹಿತ್ಯಿಕ ಪತ್ರಿಕೆ</h4>
			<div id="about_p">
				<div class="page_title"><i class="fa fa-pencil"></i>&nbsp;&nbsp;ಲೇಖಕರು</div>
			<div class="alphabet">
				<span class="letter"><a href="authors.php?letter=ಅ">ಅ</a></span>
				<span class="letter"><a href="authors.php?letter=ಆ">ಆ</a></span>
				<span class="letter"><a href="authors.php?letter=ಉ">ಉ</a></span>
				<span class="letter"><a href="authors.php?letter=ಊ">ಊ</a></span>
				<span class="letter"><a href="authors.php?letter=ಎ">ಎ</a></span>
				<span class="letter"><a href="authors.php?letter=ಕ">ಕ</a></span>
				<span class="letter"><a href="authors.php?letter=ಗ">ಗ</a></span>
				<span class="letter"><a href="authors.php?letter=ಚ">ಚ</a></span>
				<span class="letter"><a href="authors.php?letter=ಜ">ಜ</a></span>
				<span class="letter"><a href="authors.php?letter=ತ">ತ</a></span>
				<span class="letter"><a href="authors.php?letter=ದ">ದ</a></span>
				<span class="letter"><a href="authors.php?letter=ನ">ನ</a></span>
				<span class="letter"><a href="authors.php?letter=ಪ">ಪ</a></span>
				<span class="letter"><a href="authors.php?letter=ಬ">ಬ</a></span>
				<span class="letter"><a href="authors.php?letter=ಭ">ಭ</a></span>
				<span class="letter"><a href="authors.php?letter=ಮ">ಮ</a></span>
				<span class="letter"><a href="authors.php?letter=ಯ">ಯ</a></span>
				<span class="letter"><a href="authors.php?letter=ರ">ರ</a></span>
				<span class="letter"><a href="authors.php?letter=ಲ">ಲ</a></span>
				<span class="letter"><a href="authors.php?letter=ವ">ವ</a></span>
				<span class="letter"><a href="authors.php?letter=ಶ">ಶ</a></span>
				<span class="letter"><a href="authors.php?letter=ಸ">ಸ</a></span>
				<span class="letter"><a href="authors.php?letter=ಹ">ಹ</a></span>
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

$query = 'select * from author where authorname like \'' . $letter . '%\' and type=05 order by authorname';

$result = $db->query($query); 
$num_rows = $result ? $result->num_rows : 0;

if($num_rows > 0)
{
	while($row = $result->fetch_assoc())
	{
		echo '<div class="author">';
		echo '	<span class="aAuthor"><a href="auth.php?authid=' . $row['authid'] . '&amp;author=' . urlencode($row['authorname']) . '">' . $row['authorname'] . '</a> ';
		echo '</div>';
	}
}
else
{
	echo '<span class="sml">Sorry! No author names were found to begin with the letter \'' . $letter . '\' in arivubaraha</span>';
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
	

