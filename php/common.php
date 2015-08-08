<?php

function isValidId($book_id)
{
	if(is_array($book_id)){return false;}
	return preg_match("/^[0-9][0-9][0-9]$/", $book_id) ? true : false;
}

function isValidType($type)
{
	if(is_array($type)){return false;}
	return preg_match("/^(rec|mem|occ|fbi|fi|sfs|cas|ess|hpg|spb|sse|tcm|zlg|bul)$/", $type) ? true : false;
}

function isValidCheck($check)
{
	for($i=0;$i<sizeof($check);$i++)
	{
		if(is_array($check[$i])){return false;}
		if(!(preg_match("/^(rec|mem|occ|fbi|fi|sfs|cas|ess|hpg|spb|sse|tcm|zlg|bul)$/", $check[$i])))
		{
			return false;
		}
	}
	return true;
}

function isValidTitle($title)
{
	return is_array($title) ? false : true;
}

function isValidLetter($letter)
{
	if(is_array($letter)){return false;}
	return preg_match('അ' | 'ആ'| 'ഇ' | 'ഈ' | 'ഉ' | 'ഊ' | 'എ' | 'ഏ' | 'ഐ' | 'ഒ' | 'ഓ' | 'ഔ' | 'ക' | 'ഗ' | 'ച' | 'ഛ'| 'ജ' | 'ഞ' | 'ട' | 'ഡ' | 'ത' | 'ദ' | 'ധ' | 'ന' | 'പ' | 'ഫ' | 'ബ' | 'ഭ' | 'മ' | 'യ' | 'ര' | 'റ' | 'ല' | 'വ' | 'ശ' | 'ഷ' | 'സ' | 'ഹ', $letter) ? true : false;
}

function isValidVolume($vol)
{
	if(is_array($vol)){return false;}
	return preg_match("/^[0-9][0-9][0-9]$/", $vol) ? true : false;
}

function isValidPart($part)
{
	if(is_array($part)){return false;}
	return preg_match("/([0-9][0-9]\_[0-9][0-9])||([0-9][0-9])/", $part) ? true : false;
}

function isValidYear($year)
{
	if(is_array($year)){return false;}
	return preg_match("/^([0-9][0-9][0-9][0-9]|[0-9][0-9][0-9][0-9]\-[0-9][0-9])$/", $year) ? true : false;
}

function isValidFeature($feature)
{
	return is_array($feature) ? false : true;
}

function isValidFeatid($featid)
{
	if(is_array($featid)){return false;}
	return preg_match("/^[0-9][0-9][0-9][0-9][0-9]$/", $featid) ? true : false;
}

function isValidAuthid($authid)
{
	if(is_array($authid)){return false;}
	return preg_match("/^[0-9][0-9][0-9][0-9][0-9]$/", $authid) ? true : false;
}

function isValidAuthor($author)
{
	return is_array($author) ? false : true;
}

function isValidText($text)
{
	return is_array($text) ? false : true;
}

function entityReferenceReplace($term)
{
	if(is_array($term))
	{
		$term = "$term";
	}
	
	$term = preg_replace("/<i>/", "", $term);
	$term = preg_replace("/<\/i>/", "", $term);
	$term = preg_replace("/\;/", "&#59;", $term);
	$term = preg_replace("/</", "&#60;", $term);
	$term = preg_replace("/=/", "&#61;", $term);
	$term = preg_replace("/>/", "&#62;", $term);
	$term = preg_replace("/\(/", "&#40;", $term);
	$term = preg_replace("/\)/", "&#41;", $term);
	$term = preg_replace("/\:/", "&#58;", $term);
	$term = preg_replace("/Drop table|Create table|Alter table|Delete from|Desc table|Show databases|iframe/i", "", $term);
	
	return($term);
}

function getYearMonth($volume, $part)
{
	include("connect.php");

	$query = "select distinct year,month from article_maatukate where volume='$volume' and part='$part'";
	$result = $db->query($query);
	$num_rows = $result ? $result->num_rows : 0;
	if($num_rows > 0) {

		$row = $result->fetch_assoc();
		return($row);
	}
	else {

		$row['year'] = '';
		$row['month'] = '';
		return($row);
	}
}

function getYear($volume)
{
	include("connect.php");

	$query = "select distinct year from article where volume='$volume'";
	$result = $db->query($query);
	$num_rows = $result ? $result->num_rows : 0;
	if($num_rows > 0) {

		$year = '';
		while($row = $result->fetch_assoc()) {
	
			$year = $year . '-' . $row['year'];
		}
		$year = preg_replace('/^\-/', '', $year);
		$year = preg_replace('/\-[0-9][0-9]([0-9][0-9])/', '-$1', $year);
		return( $year );
	}
	else {

		return( '' );
	}
}

function getMonth($month)
{
	$month = preg_replace('/01/', 'ಜನವರಿ', $month);
	$month = preg_replace('/02/', 'ಫೆಬ್ರವರಿ', $month);
	$month = preg_replace('/03/', 'ಮಾರ್ಚಿ', $month);
	$month = preg_replace('/04/', 'ಏಪ್ರಿಲ್', $month);
	$month = preg_replace('/05/', 'ಮೇ', $month);
	$month = preg_replace('/06/', 'ಜೂನ್', $month);
	$month = preg_replace('/07/', 'ಜುಲೈ', $month);
	$month = preg_replace('/08/', 'ಆಗಸ್ಟ್', $month);
	$month = preg_replace('/09/', 'ಸೆಪ್ಟೆಂಬರ್', $month);
	$month = preg_replace('/10/', 'ಅಕ್ಟೋಬರ್', $month);
	$month = preg_replace('/11/', 'ನವಂಬರ್', $month);
	$month = preg_replace('/12/', 'ಡಿಸೆಂಬರ್', $month);
	
	return $month;
}
function getKannadaNumbers($number)
{
	$digitKan = array('0' => '೦', '1' => '೧', '2' => '೨', '3' => '೩', '4' => '೪', '5' => '೫', '6' => '೬', '7' => '೭', '8' => '೮', '9' => '೯');
	$digitEng = preg_split('//', $number, -1, PREG_SPLIT_NO_EMPTY);
	$returnStr = '';
	foreach ($digitEng as $dig)
	{
		$returnStr .= $digitKan[$dig];
	}
	return $returnStr;
}
function getMonth_part($month)
{
	$month = preg_replace('/01/', 'Jan', $month);
	$month = preg_replace('/02/', 'Feb', $month);
	$month = preg_replace('/03/', 'Mar', $month);
	$month = preg_replace('/04/', 'Apr', $month);
	$month = preg_replace('/05/', 'May', $month);
	$month = preg_replace('/06/', 'Jun', $month);
	$month = preg_replace('/07/', 'Jul', $month);
	$month = preg_replace('/08/', 'Aug', $month);
	$month = preg_replace('/09/', 'Sep', $month);
	$month = preg_replace('/10/', 'Oct', $month);
	$month = preg_replace('/11/', 'Nov', $month);
	$month = preg_replace('/12/', 'Dec', $month);
	
	return $month;
}
/*
isValidTitle, isValidFeature, isValidAuthor, isValidText
*/
?>
