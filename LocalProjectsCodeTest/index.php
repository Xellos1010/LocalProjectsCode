<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript" src="js/dragdrop.js"></script>
</head>
<body>
<h3>Please answer all questions.</h3><br><br>

<form action="phpinfo.php" method="post">
<?php
require('php/common.php');

$sql = "SELECT * FROM `".QUESTIONS_TABLE."` WHERE 1";
$result = $mysqli->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    $var = "0";
    while($row = $result->fetch_assoc()) {
      echo '<p id="'.$row['id'].'" class="'.$row['id'].'" draggable="true" ondragstart="drag(event, this)">Question: '.$row['question'].'</p><br />';
   }
   echo '<div id="yes" ondrop="drop(event)" ondragover="allowDrop(event)">YES</div>';
   echo '<div id="no" ondrop="drop(event)" ondragover="allowDrop(event)">NO</div>';
   //After we process a drop event we need to update the Display table
}
else
{
echo "Query of questions had 0 results";
}
$mysqli->close();

function SelectQuestionFromDatabase()
{
//Write this out to select a question the user has not answered
//Write this out to select a question the user has not answered
}
?>
<input type="submit" name="Submit" value="Submit" /> //go to next page
<br>
</form>
</body>
</html>