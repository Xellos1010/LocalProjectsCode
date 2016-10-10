<?php
	
	require('../FinalPHP/common.php');
	
	function freak_out($message) {
		echo 'ER.'.$message."\n";
		exit;
	}
	$user = $_REQUEST['u'];
    $pass = $_REQUEST['p'];
    $userInfo = get_row_info(USERS_TABLE,'username',$user);
    if(empty($userInfo)) 
	{
        echo 'username|false';
    }
    else
    {   
        if ($userInfo['password'] == $pass)
        {            
            echo 'true';
        }
        else
        {
            echo 'password|false';
        }
    }
?>