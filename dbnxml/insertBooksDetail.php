<?php
	echo "Books Detail Insertion.......\n";
	$host = $argv[1];
	$database = $argv[2];
	$user = $argv[3];
	$password = $argv[4];

	$db = mysql_connect($host, $user, $password) or die("Not connected to database");
	$rs = mysql_select_db($database, $db) or die("No Database");
	mysql_query("set names utf8");
	
	mysql_query("DROP TABLE IF EXISTS bookdetails");
	mysql_query("CREATE TABLE bookdetails (id varchar(5), title varchar(100),sstitle varchar(500), author varchar(200), details varchar(300), publisher varchar(300), primary key(id)) ENGINE=MyISAM character set utf8 collate utf8_general_ci");
	file_exists('books/book-details.xml') ? $xmlObj = simplexml_load_file('books/book-details.xml') : exit("Failed to open books/book-details.xml");
	
	foreach($xmlObj->book as $book)
	{
		$bookid = $book['id'];
		$sstitle = $book['sstitle'];
		$title = addslashes($book->title);
		$i = 0 ;
		$array = $authors = array();
		$authorJson = '[';
		
		foreach($book->authors->author as $author)
		{
			if((string)$author != '')
			{
				$authorJson .= '{"name":' . '"' . (string)$author . '"} , ';
			}
		}
		
		$authorJson = preg_replace('/ , $/', '', $authorJson);
		$authorJson = $authorJson . ']';
		
		$detailsJson = '[{"year":"' . (string)$book->details->year . '",';
		$detailsJson .= '"edition":"' . (string)$book->details->edition . '",';
		$detailsJson .= '"editor":"' . (string)$book->details->editor . '",';
		$detailsJson .= '"volume":"' . (string)$book->details->volume . '",';
		$detailsJson .= '"part":"' . (string)$book->details->part . '",';
		$detailsJson .= '"page":"' . (string)$book->details->pages . '"}]';
		
		$publisher = (string)$book->publisher;
		$query = "INSERT INTO bookdetails VALUES('$bookid', '$title', '$sstitle', '$authorJson', '$detailsJson' , '$publisher')";
		mysql_query($query) or die("Query Problem \n" . mysql_error());
	}
?>
