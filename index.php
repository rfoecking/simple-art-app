<?php
// Check if the configuration file exists. If so, proceed to the main controller.
if(file_exists("config.php")) {
	header("Location: web/main");
// If not, run the install wizard.
} else {
	echo "Please create a config.php in the document root following the 
	guidelines in config.sample.php.";
}
?>