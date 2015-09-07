<?php
	//~ JPG and tiff files removing from journals
	$journalJpg = 'find ../../../Volumes/jpg/journals/1/ -mmin +10 -type f -name "*.jpg" -exec rm {} \;';
	exec($journalJpg);
	$journalTif = 'find ../../../Volumes/tif/journals/ -mmin +10 -type f -name "*.tif" -exec rm {} \;';
	exec($journalTif);
	
	//~ JPG and tiff files removing from books
	$bookJpg = 'find ../../../Volumes/jpg/books/1/ -mmin +10 -type f -name "*.jpg" -exec rm {} \;';
	exec($bookJpg);
	$bookTif = 'find ../../../Volumes/tif/books/ -mmin +10 -type f -name "*.tif" -exec rm {} \;';
	exec($bookTif);
?>
