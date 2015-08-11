<?php
	session_start();
	$url ="";
	if(isset($_GET['journalid']) && $_GET['journalid'] != ''){$journalid = $_GET['journalid']; $url = "journalid=".$journalid;}
	if(isset($_GET['volume']) && $_GET['volume'] != ''){$volume = $_GET['volume']; $url .= "&volume=".$volume;}
	if(isset($_GET['part']) && $_GET['part'] != ''){$part = $_GET['part']; $url .= "&part=".$part;}
	if(isset($_GET['page']) && $_GET['page'] != ''){$page = $_GET['page']; $url .= "&pagenum=".$page;}
	if(isset($_GET['text']) && $_GET['text'] != ''){$text = $_GET['text']; $url .= "&searchText=".$text;}
	header("Location: bookreader/templates/book.php?".$url);
	echo $url;
	//~ print_r(json_encode($_SESSION['sd'][$year.$month]));
	
?>
