<?php
	$host = $argv[1];
	$database = $argv[2];
	$user = $argv[3];
	$password = $argv[4];
		
	$db = mysql_connect($host, $user, $password) or die("Not connected to database");
	$rs = mysql_select_db($database, $db) or die("No Database");
	mysql_query("set names utf8");
	
	$result = mysql_query("SELECT id FROM journaldetails order by id");
	while($row = mysql_fetch_array($result))
	{
		$journalID = $row['id'];
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
					$array = $authors = array();
					$authorJson = '[';
	
					
					
					foreach($entry->allauthors->author as $author)
					{
						
						if((string)$author != '')
						{
							//~ $array['name'] = (string)$author;
							//~ $array['type'] = (string)$author['type'];
							//~ array_push($authors, $array);
							$authorJson .= '{"name":' . '"' . (string)$author . '" ,' . '"type":' . '"' . (string)$author['type'] . '"} , ';
						}
						
					}
					
					$authorJson = preg_replace('/ , $/', '', $authorJson);
					$authorJson = $authorJson . ']';
					
					//~ $authorJson = json_encode($authors);
					(strcmp($page, $prevPage) == 0 ) ? ($titleid = 'id_' . $journalID . '_' . $vnum . '_' .$pnum . '_' . $page . '_' . ++$count) : ($titleid = 'id_' . $journalID . '_' . $vnum . '_' .$pnum . '_' . $page . '_0' AND $count = 0);
					$prevPage =  $page;
					$query = "INSERT INTO article VALUES('$journalID', '$vnum', '$pnum', '$year', '$month', '$title', '$feature', '$page', '$authorJson', '$info', '$titleid')";
					mysql_query($query) or die("Query Problem" . mysql_error());
				}
			}
		}
	}
?>
