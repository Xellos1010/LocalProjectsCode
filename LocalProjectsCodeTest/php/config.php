<?php
	
	define('CACHE_FILE', 'scores.plist');
	define('CACHE_AGE_MAX', 30);
	
	//define('DB_CONN','mysql:dbname=localprojects;host=localhost');
	define('DB_HOST','localhost');
	define('DB_USER','root');
	define('DB_PASS','');
	define('DB','localprojects');
	define('QUESTIONS_TABLE', 'questions');
	define('STATISTICS_TABLE', 'categories');
	
	// On submission, map the 'v' parameter to an integer
	$VERSIONS = array(
					  '1.0' => 1,
					  );
	
	// map the version number to a secret word pair
	$HASHSALTS = array(
					   1 => '1337',
					   );

?>
