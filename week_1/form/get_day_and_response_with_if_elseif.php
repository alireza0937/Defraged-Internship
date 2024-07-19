<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Day Select</title>
</head>
<body>
    <br>
    <form action="get_day_and_response_with_if_elseif.php" method="POST">
    <label for="Day of the week">Pick a day</label>
    <br><br>
    <input type="text" name="day">
    <button>Send</button>
    </form>
    <br>
</body>
</html>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $day = strtolower(trim($_POST['day']));
        if ($day == "monday") {
            echo "Laugh on Monday, laugh for danger.";
        } elseif ($day == "tuesday") {
            echo "Laugh on Tuesday, kiss a stranger.";
        } elseif ($day == "wednesday") {
            echo "Laugh on Wednesday, laugh for a letter.";
        } elseif ($day == "thursday") {
            echo "Laugh on Thursday, something better.";
        } elseif ($day == "friday") {
            echo "Laugh on Friday, laugh for sorrow.";
        } elseif ($day == "saturday") {
            echo "Laugh on Saturday, joy tomorrow.";
        } else {
            echo "The day you enter is not valid.";
        }
    }
?>
