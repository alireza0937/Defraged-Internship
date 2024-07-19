<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $user_inserted_day = $_POST["day"];
        $day = strtolower(trim($user_inserted_day));
        $all_valid_days = [
            "monday" => "Laugh on Monday, laugh for danger.",
            "tuesday" => "Laugh on Tuesday, kiss a stranger.",
            "wednesday" => "Laugh on Wednesday, laugh for a letter.",
            "thursday" => "Laugh on Thursday, something better.",
            "friday" => "Laugh on Friday, laugh for sorrow.",
            "saturday" => "Laugh on Saturday, joy tomorrow."
        ];
        if (empty($all_valid_days[$day])) {
            echo "The day you enter is not valid.\n";
        } else {
            echo $all_valid_days[$day];
        }
    }
?>