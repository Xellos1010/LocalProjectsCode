<?php

	require('config.php');

	// Use SQLite file if it exists, otherwise connect to database.
	if (file_exists('scoreboard.db')) {
		$db = new PDO('sqlite:scoreboard.db');
	} else {
		//$db = new PDO(DB_CONN, DB_USER, DB_PASS);
		$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB);

		/*
		 * This is the "official" OO way to do it,
		 * BUT $connect_error was broken until PHP 5.2.9 and 5.3.0.
		 */
		if ($mysqli->connect_error) {
			die('Connect Error (' . $mysqli->connect_errno . ') '
					. $mysqli->connect_error);
		}

		/*
		 * Use this instead of $connect_error if you need to ensure
		 * compatibility with PHP versions prior to 5.2.9 and 5.3.0.
		 */
		if (mysqli_connect_error()) {
			die('Connect Error (' . mysqli_connect_errno() . ') '
					. mysqli_connect_error());
		}

		//echo 'Success... ' . $mysqli->host_info . "\n";

	}
   
    function get_row_column_info($table, $key, $value,$returncell){
		global $db;
		$stmt = $db->prepare('SELECT '.$returncell.' FROM '.$table.' WHERE '.$key.'=?');
		$stmt->bindParam(1, $value);
		if ($stmt->execute()) {
			if ($row = $stmt->fetch()) {
				return $row[$returncell];
			}
		}		
		return null;
	}

    function get_row_info($table, $key, $value) {
		global $db;
		
		$stmt = $db->prepare('SELECT * FROM '.$table.' WHERE '.$key.'=?');
		$stmt->bindParam(1, $value);
		if ($stmt->execute()) {
			if ($row = $stmt->fetch()) {
				return $row;
			}
		}
		
		return null;
	}


    function get_all_rows($table) {
		global $db;
		
		$stmt = $db->prepare('SELECT * FROM '.$table.' WHERE 1');
		$stmt->bindParam(1, $value);
		if ($stmt->execute()) {
			if ($rows = $stmt->fetchAll()) {
				return $rows;
			}
		}		
		return null;
	}

    function get_all_rows_with_key($table, $key, $value) {
		global $db;
		
		$stmt = $db->prepare('SELECT * FROM '.$table.' WHERE '.$key.'=?');
		$stmt->bindParam(1, $value);
		if ($stmt->execute()) {
			if ($rows = $stmt->fetchAll()) {
				return $rows;
			}
		}		
		return null;
	}

	function get_id($table, $key, $value) {
		global $db;
		
		$stmt = $db->prepare('SELECT id FROM '.$table.' WHERE '.$key.'=?');
		$stmt->bindParam(1, $value);
		if ($stmt->execute()) {
			if ($row = $stmt->fetch()) {
				return $row['id'];
			}
		}		
		return null;
	}
	
	function create_id($table, $key, $value) {
		global $db;
		
		$stmt = $db->prepare('INSERT INTO '.$table.' ('.$key.') VALUES (?)');
		$stmt->bindParam(1, $value);
		if ($stmt->execute()) {
			return $db->lastInsertId();
		}		
		return null;
	}

    function get_username($subscriptionNumber)
    {
        if (empty($subscriptionNumber)) return null;
        $user = get_row_column_info(USERS_TABLE,'subscriptionnumber',$subscriptionNumber,'username');
        if (empty($user)) {
			return null;
		} else {
			return $user;
		}
    }	

	function get_device_id($device_udid) {
		if (empty($device_udid)) return null;
		
		$device_id = get_id(DEVICES_TABLE, 'uuid', $device_udid);
		if (empty($device_id)) {
			return create_id(DEVICES_TABLE, 'uuid', $device_udid);
		} else {
			return $device_id;
		}
	}

    function get_device_subscription_devid($device_udid) {
		if (empty($device_udid)) return null;
		
		$subscriptionnumber = get_row_column_info(DEVICES_TABLE, 'uuid', $device_udid,'subscriptionnumber');
        if (empty($subscriptionnumber)) {
			return null;
		} else {
			return $subscriptionnumber;
		}
	}

    function get_device_subscription_user($username) {
		if (empty($username)) return null;
		
		$subscriptionnumber = get_row_column_info(USERS_TABLE, 'username', $username,'subscriptionnumber');
        if (empty($subscriptionnumber)) {
			return null;
		} else {
			return $subscriptionnumber;
		}
	}

    function get_user_subscription($username) {
		if (empty($username)) return null;
		$subscriptionnumber = get_row_column_info(USERS_TABLE, 'username', $username,'subscriptionnumber');
        if (empty($subscriptionnumber)) {
			return 'null';
		} else {
			return $subscriptionnumber;
		}
	}

    function get_device_subscription_levels($subscriptionnumber) {
		if (empty($subscriptionnumber)) return null;		
        $subscriptionlevel = get_row_column_info(SUBSCRIPTIONS_TABLE, 'subscriptionnumber', $subscriptionnumber,'subscriptionlevel');
        if (empty($subscriptionlevel)) {
			return null;
		} else {
			return $subscriptionlevel;
		}
	}

    function register_device($deviceID, $username)
    {
        
    }
?>