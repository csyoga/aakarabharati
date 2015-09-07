<?php
	echo "Books Article Insertion.......\n";
	$host = $argv[1];
	$database = $argv[2];
	$user = $argv[3];
	$password = $argv[4];
		
	$db = mysql_connect($host, $user, $password) or die("Not connected to database");
	$rs = mysql_select_db($database, $db) or die("No Database");
	mysql_query("set names utf8");
	
	$result = mysql_query("SELECT id FROM bookdetails order by id");
	while($row = mysql_fetch_array($result))
	{
		$bookID = $row['id'];
		file_exists('books/book-' . $bookID . '.xml') ?  $xmlString = file_get_contents('books/book-' . $bookID . '.xml') : exit("Failed to open books/book-" . $bookID . ".xml. \n");
		
		$lines = preg_split('/\n/' , $xmlString);
		for($i = 0; $i < sizeof($lines); $i++)
		{
			$line = $lines[$i];
			if(preg_match("/\<book id=\"(.*)\" sstitle=\"(.*)\">/", $line, $matches))
			{
				$bookID = $matches[1];
				$sstitle = addslashes($matches[2]);
			}
			elseif(preg_match("/\<s(.*) page=\"(.*)\" title=\"(.*)\" author=\"(.*)\">/", $line, $matches))
			{
				$level = $matches[1];
				$page = $matches[2];
				$title = addslashes($matches[3]);
				$author = addslashes($matches[4]);
				$query = "INSERT INTO books VALUES('$bookID', '$sstitle', '$level', '$page', '$title', '$author')";
				mysql_query($query) or die("Query Problem" . mysql_error());
			}
			
		}	
	}
?>
