<!DOCTYPE html>
<html>
<head>
    <title>Day Select</title>
</head>
<body>
    <form action="get_day_and_response_with_switch.php" method="POST">
        <label for="day">Pick a day</label>
        <br><br>
        <select id="day" name="day">
            <option value="monday">Monday</option>
            <option value="tuesday">Tuesday</option>
            <option value="wednesday">Wednesday</option>
            <option value="thursday">Thursday</option>
            <option value="friday">Friday</option>
            <option value="saturday">Saturday</option>
        </select>
        <br><br>
        <button>Go</button>
    </form>
    <br>
</body>
</html>
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $day = strtolower(trim($_POST["day"]));
    switch ($day) {
        case 'monday':
            echo "Laugh on Monday, laugh for danger.";
            break;
        case 'tuesday':
            echo "Laugh on Tuesday, kiss a stranger.";
            break;
        case "wednesday":
            echo "Laugh on Wednesday, laugh for a letter.";
            break;
        case "thursday":
            echo "Laugh on Thursday, something better.";
            break;
        case "friday":
            echo "Laugh on Friday, laugh for sorrow.";
            break;
        case "saturday":
            echo "Laugh on Saturday, joy tomorrow.";
            break;
        default:
            echo "The day you enter is not valid.\n";
    }
}
?>


