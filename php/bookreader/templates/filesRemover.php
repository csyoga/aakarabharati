<?php
	$jpg = 'find ../../../Volumes/jpg/journals/1/ -mmin +10 -type f -name "*.jpg" -exec rm {} \;';
	exec($jpg);
	$tif = 'find "../../../Volumes/tif/journals/ -mmin +10 -type f -name "*.tif" -exec rm {} \;';
	exec($tif);
?>
