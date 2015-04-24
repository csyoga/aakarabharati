<?php include('header.php'); ?>
<?php include('nav.php'); ?>
		<div id="about_sakshi">
			<div class="archive_holder_maatukate">
<?php

include("connect.php");
//~ require_once("../common.php");

//~ if(isset($_GET['part'])){$part = $_GET['part'];}else{$part = '';}
if(isset($_GET['part'])){$part = $_GET['part'];}else{$part = '';}
if(isset($_GET['vol'])){$volume = $_GET['vol'];}else{$volume = '';}

//~ if(!(isValidVolume($volume) && isValidPart($part)))
//~ { 
	//~ echo "Invalid URL";
	//~ 
	//~ echo "</div></div>";
	//~ include("include_footer.php");
	//~ echo "<div class=\"clearfix\"></div></div>";
	//~ include("include_footer_out.php");
	//~ echo "</body></html>";
	//~ exit(1);
//~ }

$db = @new mysqli('localhost', "$user", "$password", "$database");
$db->set_charset('utf8');
if($db->connect_errno > 0)
{
	echo 'Not connected to the database [' . $db->connect_errno . ']';
	echo "</div></div>";
	include("include_footer.php");
	echo "<div class=\"clearfix\"></div></div>";
	include("include_footer_out.php");
	echo "</body></html>";
	exit(1);
}


//~ $db = mysql_connect("localhost",$user,$password) or die("Not connected to database");
//~ $rs = mysql_select_db($database,$db) or die("No Database");

//~ $month_name = array("0"=>"","1"=>"January","2"=>"February","3"=>"March","4"=>"April","5"=>"May","6"=>"June","7"=>"July","8"=>"August","9"=>"September","10"=>"October","11"=>"November","12"=>"December");

//~ $query = "select distinct year,month from article where volume='$volume'";

//~ $result = mysql_query($query);
//~ $num_rows = mysql_num_rows($result);

//~ $result = $db->query($query); 
//~ $num_rows = $result ? $result->num_rows : 0;
//~ 
//~ if($num_rows > 0)
//~ {
	//~ $row=mysql_fetch_assoc($result);
	//~ $row = $result->fetch_assoc();
//~ 
	//~ $month=$row['month'];
	//~ $year=$row['year'];
	//~ 
	//~ $dpart = preg_replace("/^0/", "", $part);
	//~ $dpart = preg_replace("/\-0/", "-", $dpart);
	//~ 

			
	echo "<div class=\"page_title\"><i class='fa fa-book fa-1x'></i>&nbsp;&nbsp;ಸಂಪುಟ &nbsp;".intval($volume)."&nbsp;ಸಂಚಿಕೆ&nbsp;(".intval($part).")</div>";
	
//~ }
//~ 
//~ if($result){$result->free();}
echo "<ul class=\"dot\">";
$query = "select * from article_pp where volume ='$volume' && part='$part' order by page_start";
$result = $db->query($query); 
$num_rows = $result ? $result->num_rows : 0;
//~ $result1 = mysql_query($query1);
//~ $num_rows1 = mysql_num_rows($result1);


if($num_rows > 0)
{
	for($i=1;$i<=$num_rows;$i++)
	{
		//~ $row1=mysql_fetch_assoc($result1);
		$row = $result->fetch_assoc();	
		$title=$row['title'];
		$authid=$row['authid'];
		$featid=$row['featid'];
		$titleid=$row['titleid'];
		
		$page=$row['page_start'];
		
		$volume=$row['volume'];
		$part=$row['part'];
		//~ $year=$row1['year'];
		//~ $month=$row1['month'];
		$title1=addslashes($title);
		$query3 = "select feat_name from feature_pp where featid='$featid'";
		//~ $result3 = mysql_query($query3);		
		//~ $row3=mysql_fetch_assoc($result3);

		$result3 = $db->query($query3); 
		$row3 = $result3->fetch_assoc();
		
		$feature=$row3['feat_name'];
		
		echo "<li>";
		echo "<span class=\"titlespan\"><a target=\"_blank\" href=\"../Volumes/$part/index.djvu?djvuopts&amp;page=$page.djvu&amp;zoom=page\">$title</a></span>";
		if($feature != "")
		{
			echo "<span class=\"titlespan\">&nbsp;&nbsp;|&nbsp;&nbsp;</span><span class=\"featurespan\"><a href=\"feat.php?feature=" . urlencode($feature) . "&amp;featid=$featid\">$feature</a></span>";
		}
		if($result3){$result3->free();}
		
		if($authid != 0)
		{

			echo "<br />";
			$aut = preg_split('/;/',$authid);

			$fl = 0;
			foreach ($aut as $aid)
			{
				$query2 = "select * from author where authid=$aid";

				//~ $result2 = mysql_query($query2);
				//~ $num_rows2 = mysql_num_rows($result2);

				$result2 = $db->query($query2); 
				$num_rows2 = $result2 ? $result2->num_rows : 0;

				if($num_rows2 > 0)
				{
					//~ $row2=mysql_fetch_assoc($result2);
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
	echo "No data in the database";
}

if($result){$result->free();}
$db->close();
echo "</ul>";

?>
		   </div>
	</div>
</div>
	<?php include("footer.php"); ?>
