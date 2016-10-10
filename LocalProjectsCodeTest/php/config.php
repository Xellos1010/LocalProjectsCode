<?php
	
	define('CACHE_FILE', 'scores.plist');
	define('CACHE_AGE_MAX', 30);
	
	define('DB_CONN','mysql:host=web440.webfaction.com:3306;dbname=localprojects');
	define('DB_USER','localproject');
	define('DB_PASS','1234qwer');
	
	define('QUESTIONS_TABLE', 'Questions');
	define('STATISTICS_TABLE', 'Categories');
	
	// On submission, map the 'v' parameter to an integer
	$VERSIONS = array(
					  '1.0' => 1,
					  );
	
	// map the version number to a secret word pair
	$HASHSALTS = array(
					   1 => '1337',
					   );
	
	// map game ID ('g' parameter) to a table
	//$POINT_TABLES = array(
//						  1 => 'sb_scores_FarkleTower',
						  //);
?>
