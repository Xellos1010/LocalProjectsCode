
<?php
require('common.php');
$answer = $_REQUEST["answer"];
$questionID = $_REQUEST["questionID"];

$sqlSelectCategory = "SELECT `category`, `".$answer."` FROM `".QUESTIONS_TABLE."` WHERE id=".$questionID."";
//get the category the question falls under
$result = $mysqli->query($sqlSelectCategory);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
    //echo "<script type='text/javascript'>alert('row results are ".implode(" ",$row) ."');</script>";
        $sqlcurrentscore = "SELECT `points` FROM `category` WHERE `category`='".$row['category']."'";
        $currentScoreResult = $mysqli->query($sqlcurrentscore);

        //echo "<script type='text/javascript'>alert('".$sqlcurrentscore."');</script>";
        //Get the current points in tha category and add the points from the response
        if ($currentScoreResult->num_rows > 0) {
         while($row2 = $currentScoreResult->fetch_assoc()) {
         //echo "<script type='text/javascript'>alert('row results are ".implode(" ",$row2) ."');</script>";
         $combinedscore = intval($row2['points']) + intval($row[$answer]);
         //echo "<script type='text/javascript'>alert('combines score = ".$combinedscore."');</script>";
            $sqlupdatecategory = "UPDATE `category` SET `category`='".$row['category']."',`points`='".$combinedscore."' WHERE category='".$row['category']."'";
            //echo "<script type='text/javascript'>alert('".$sqlupdatecategory."');</script>";
            $mysqli->query($sqlupdatecategory);
          }
      }
      else{
      echo "<script type='text/javascript'>alert('Query no results for current score of ".$row['category']."');</script>";
      }
    }
}
else{
    echo "<script type='text/javascript'>alert('No results from Query Select Category');</script>";
}
?>