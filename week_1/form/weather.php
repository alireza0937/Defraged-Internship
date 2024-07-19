<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather Condition</title>
</head>
<body>
    <form action="weather_response.php" method="post">
        <h2>How's Your Weather?</h2>
        <h4>Please enter your information:</h4><br>
        <label for="city">City:</label>
        <input type="text" name="city" required>
        <label for="month">Month:</label>
        <input type="text" name="month" required>
        <label for="year">Year:</label>
        <input type="text" name="year" required><br>
        <p>Select the weather conditions you experienced:</p>
        <input type="checkbox" name="weather[]" value="rain">Rain<br>
        <input type="checkbox" name="weather[]" value="sunshine">Sunshine<br>
        <input type="checkbox" name="weather[]" value="clouds">Clouds<br>
        <input type="checkbox" name="weather[]" value="hail">Hail<br>
        <input type="checkbox" name="weather[]" value="sleet">Sleet<br>
        <input type="checkbox" name="weather[]" value="snow">Snow<br>
        <input type="checkbox" name="weather[]" value="wind">Wind<br>
        <button>Go</button>

    </form>
</body>
</html>