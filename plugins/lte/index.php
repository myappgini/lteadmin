<?php
	include(dirname(__FILE__) . "/header.php");
	
	echo $lte_class->get_project(array(
		'pre_upload' => file_get_contents(dirname(__FILE__) . "/video-link.html"),
		'redirect_to' => 'project.php'
	));

	include(dirname(__FILE__) . "/footer.php");
?>
