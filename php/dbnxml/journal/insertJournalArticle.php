<?php
	$host = $argv[1];
	$database = $argv[2];
	$user = $argv[3];
	$password = $argv[4];
	$journalID = $argv[5];
	
	$db = mysql_connect($host, $user, $password) or die("Not connected to database");
	$rs = mysql_select_db($database, $db) or die("No Database");
	mysql_query("set names utf8");
		
	file_exists('journal-' . $journalID . '.xml') ? $xmlObj = simplexml_load_file('journal-' . $journalID . '.xml') : exit("Failed to open journal-" . $journalID . ".xml. \n");
	
	foreach($xmlObj->volume as $volume)
	{
		$vnum = $volume['vnum'];
		foreach($volume->part as $part)
		{
			$prevPage = '';
			$count = 0;
			$pnum = $part['pnum'];
			$year = $part['year'];
			$month = $part['month'];
			$info = $part['info'];
			foreach($part->entry as $entry)
			{
				$title = addslashes($entry->title);
				$feature = addslashes($entry->feature);
				$page = $entry->page;
				$authorString = '';
				
				foreach($entry->allauthors->author as $author)
				{
					$authorType = $author['type'];
					$authorString .= $authorType . ':' . $author . ';'; 
				}
				
				$authorString = preg_replace('/;$/', '', $authorString);
				(strcmp($page, $prevPage) == 0 ) ? ($titleid = 'id_' . $journalID . '_' . $vnum . '_' .$pnum . '_' . $page . '_' . ++$count) : ($titleid = 'id_' . $journalID . '_' . $vnum . '_' .$pnum . '_' . $page . '_0' AND $count = 0);
				$prevPage =  $page;
				$query = "INSERT INTO article VALUES('$journalID', '$vnum', '$pnum', '$year', '$month', '$title', '$feature', '$page', '$authorString', '$titleid')";
				mysql_query($query) or die("Query Problem" . mysql_error());
			}
		}
	}
?>
