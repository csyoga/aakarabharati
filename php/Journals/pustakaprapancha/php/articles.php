<?php include("header.php"); ?>
<?php include("nav.php"); ?>
		<div id="about_sakshi">
			<div class="archive_holder">
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
				<ul class="dot">
<?php

include("connect.php");
//~ require_once("../common.php");

if(isset($_GET['letter']))
{
	$letter=$_GET['letter'];
	
	//~ if(!(isValidLetter($letter)))
	//~ {
		//~ echo "<li>Invalid URL</li>";
		//~ 
		//~ echo "</ul></div></div>";
		//~ include("include_footer.php");
		//~ echo "<div class=\"clearfix\"></div></div>";
		//~ include("include_footer_out.php");
		//~ echo "</body></html>";
		//~ exit(1);
	//~ }
	
	if($letter == '')
	{
		$letter = 'ಅ';
	}
}
else
{
	$letter = 'ಅ';
}

//~ $db = mysql_connect("localhost",$user,$password) or die("Not connected to database");
//~ $rs = mysql_select_db($database,$db) or die("No Database");

$db = @new mysqli('localhost', "$user", "$password", "$database");
$db->set_charset('utf8');
if($db->connect_errno > 0)
{
	echo '<li>Not connected to the database [' . $db->connect_errno . ']</li>';
	echo "</ul></div></div>";
	include("include_footer.php");
	echo "<div class=\"clearfix\"></div></div>";
	include("include_footer_out.php");
	echo "</body></html>";
	exit(1);
}
//~ $month_name = array("0"=>"","1"=>"January","2"=>"February","3"=>"March","4"=>"April","5"=>"May","6"=>"June","7"=>"July","8"=>"August","9"=>"September","10"=>"October","11"=>"November","12"=>"December");

if($letter == 'Special')
{
	$query = "select * from article_pp where title not regexp '^[a-zA-Z].*' order by title, part, page_start";
}
else
{
	$query = "select * from article_pp where title like '$letter%' order by title, part, page_start";
}
//~ $result = mysql_query($query);
//~ $num_rows = mysql_num_rows($result);

$result = $db->query($query); 
$num_rows = $result ? $result->num_rows : 0;

if($num_rows > 0)
{
	for($i=1;$i<=$num_rows;$i++)
	{
		//~ $row=mysql_fetch_assoc($result);
		$row = $result->fetch_assoc();
		
		$titleid=$row['titleid'];
		$title=$row['title'];
		$featid=$row['featid'];
		$page=$row['page_start'];
		$authid=$row['authid'];
		$volume=$row['volume'];
		$part=$row['part'];
		//~ $year=$row['year'];
		//~ $month=$row['month'];
		
		$title1=addslashes($title);
		
		$query3 = "select feat_name from feature_pp where featid='$featid'";
		
		$result3 = $db->query($query3); 
		//~ $result3 = mysql_query($query3);	
			
		//~ $row3=mysql_fetch_assoc($result3);		
		$row3 = $result3->fetch_assoc();		
		$feature=$row3['feat_name'];
		//~ $dpart = preg_replace("/^0/", "", $part);
		//~ $dpart = preg_replace("/\-0/", "-", $dpart);
		if($result3){$result3->free();}
		echo "<li>";
		echo "<span class=\"titlespan\"><a target=\"_blank\" href=\"../Volumes/$part/index.djvu?djvuopts&amp;page=$page.djvu&amp;zoom=page\">$title</a></span>";
		echo "
		<span class=\"titlespan\">&nbsp;&nbsp;|&nbsp;&nbsp;</span>
		<span class=\"titlespan\">
			<a href=\"toc.php?vol=$volume&mp;part=$part\">ಸಂಪುಟ &nbsp;".intval($volume)."&nbsp;ಸಂಚಿಕೆ (".intval($part).")</a>
		</span>";
		if($feature != "")
		{
			echo "<span class=\"titlespan\">&nbsp;&nbsp;|&nbsp;&nbsp;</span><span class=\"featurespan\"><a href=\"feat.php?feature=" . urlencode($feature) . "&amp;featid=$featid\">$feature</a></span>";
		}
		
		if($authid != 0)
		{

			echo "<br />";
			$aut = preg_split('/;/',$authid);

			$fl = 0;
			foreach ($aut as $aid)
			{
				$query2 = "select * from author where authid=$aid";

				$result2 = $db->query($query2); 				
				$num_rows2 = $result2 ? $result2->num_rows : 0;
				
				if($num_rows2 > 0)
				{
					$row2 = $result2->fetch_assoc();		

					$authorname=$row2['authorname'];
					
					if($fl == 0)
					{
						echo "<span class=\"authorspan\"><a href=\"auth.php?authid=$aid&amp;author=" . urlencode($authorname) . "\">$authorname</a></span>";
						$fl = 1;
					}
					else
					{
						echo "<span class=\"titlespan\">;&nbsp;</span><span class=\"authorspan\"><a href=\"auth.php?authid=$aid&amp;author=" . urlencode($authorname) . "\">$authorname</a></span>";
					}
				}
				if($result2){$result2->free();}
			}
		}
		//~ echo "<br /><span class=\"downloadspan\"><a href=\"../../Volumes/$volume/$part/index.djvu?djvuopts&amp;page=$page.djvu&amp;zoom=page\" target=\"_blank\">View article</a>&nbsp;|&nbsp;<a href=\"#\">Download article (DjVu)</a>&nbsp;|&nbsp;<a href=\"#\">Download article (PDF)</a></span>";

		echo "</li>\n";
	}
}
else
{
	echo "<li>Sorry! No articles were found to begin with the letter '$letter' in maatukate</li>";
}
if($result){$result->free();}
$db->close();
?>
			</ul>
		</div>
	</div>
</div>
	<?php include("footer.php"); ?>
