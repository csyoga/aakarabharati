<?php
	echo "Journal Details Insertion.......\n";
	$host = $argv[1];
	$database = $argv[2];
	$user = $argv[3];
	$password = $argv[4];

	$db = mysql_connect($host, $user, $password) or die("Not connected to database");
	$rs = mysql_select_db($database, $db) or die("No Database");
	mysql_query("set names utf8");
	
	mysql_query("DROP TABLE IF EXISTS journaldetails");
	mysql_query("CREATE TABLE journaldetails (id varchar(5), title varchar(100), period varchar(20), details varchar(300), primary key(id)) ENGINE=MyISAM character set utf8 collate utf8_general_ci");
	
	file_exists('journal/journals_details.xml') ? $xmlObj = simplexml_load_file('journal/journals_details.xml') : exit("Failed to open journals_details.xml");
	
	foreach($xmlObj->journal as $journal)
	{
		$id = $journal['id'];
		$title = addslashes($journal->title);
		$period = $journal->period;
		$details = addslashes($journal->details);
		$query = "INSERT INTO journaldetails VALUES('$id', '$title', '$period', '$details')";
		mysql_query($query) or die("Query Problem \n" . mysql_error());
	}
?>
