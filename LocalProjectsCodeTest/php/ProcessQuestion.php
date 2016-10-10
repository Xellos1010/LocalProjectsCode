<html>
<body>


Welcome <?php echo $_POST["name"]; ?><br>
Your answer was: 
<?php

$selected_radio = $_POST['answer'];
print $selected_radio;

if (isset($answer) && $answer=="yes") echo "checked";?>
value="female">Female
<input type="radio" name="gender"
<?php if (isset($answer) && $answer=="no") echo "checked";?>
value="male">Male
</body>
</html>