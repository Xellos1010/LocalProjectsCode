<?php

	require('../FinalPHP/config.php');

	// Use SQLite file if it exists, otherwise connect to database.
	if (file_exists('scoreboard.db')) {
		$db = new PDO('sqlite:scoreboard.db');
	} else {
		$db = new PDO(DB_CONN, DB_USER, DB_PASS);
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

    function GetAllQuestions(){
        return get_all_rows(QUESTIONS_TABLE)
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

    function get_all_rows($table, $key, $value) {
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