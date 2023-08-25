<?php

$curl = curl_init();
date_default_timezone_set('Asia/Tehran');

$apiKey = "5869e7d1ceb6ed673cad2f7e0c7cc511";

$url = "https://api.openweathermap.org/data/2.5/weather?q=yazd&appid=$apiKey&units=metric";

curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($curl);
$data = json_decode($output, true);
curl_close($curl);
$hours = date("H");
$min = date("i");

if ($hours > 11) {
    $hours -= 0;
}
$rhours = 360 / 12 * $hours;
$rmin = 360 / 60 * $min;

$icon = $data['weather'][0]['icon'];
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>🌡️ Weather Time</title>
</head>
<body ng-app="Weather">
<div class="info">
    <h1>Minimalist Clock and Weather</h1>
    <span>
    Made with
    <i class="fa fa-beer"></i>
    by
    <a href="https://github.com/metidev">METI DEV</a>
    <div class="spoilers">
      Minimalist, Flat, Modern</a>
    </div>
  </span>
</div>

<div class="app-wrap">
    <div class="clock-face counter">
        <div class="analog">
            <span class="hours"><?= $hours ?></span>:<span class="mins"><?= $min ?></span>
        </div>

        <div class="hours counter" style="transform: rotate(<?= $rhours . 'deg' ?>)">
            <span class="hands"></span>
        </div>

        <div class="minutes counter" style="transform: rotate(<?= $rmin . 'deg' ?>)">
            <span class="hands"></span>
        </div>

    </div>

    <div class="weather" ng-controller="MainCtrl">
        <div class="locale-data">
            <div class="city"><?= $data['name'] ?></div>
            <div class="cond"><?= $data['weather'][0]['description'] ?></div>
            <div class="temp-block">
                <div class="temp"><?= round($data['main']['temp']) ?>
                    <div class="degree">&#176;</div>
                    <div class="temp">C</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--icons-->
<?php

switch ($icon) {
    case '01n':
        echo '<div class="night icon">
        <span class="moon"></span>
        <span class="spot1"></span>
        <span class="spot2"></span>
        <ul>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>

    </div>';
        break;
    case '01d':
        echo ' <div class="hot icon">
        <span class="sun icon"></span>
        <span class="sunx icon"></span>
    </div>';
        break;
    case '50d':
    case '50n':
    case '02d':
    case '02n':
    case '03d':
    case '03n':
    case '04d':
    case '04n':
        echo '<div class="cloudy icon">
        <span class="cloud"></span>
        <span class="cloudx"></span>
    </div>';
        break;
    case '13d':
    case '13n':
        echo '<div class="stormy icon">
        <ul>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
        <span class="snowe"></span>
        <span class="snowex"></span>
        <span class="stick"></span>
        <span class="stick2"></span>
    </div>';
        break;
    case '11d':
    case '11n':
    case '10d':
    case '10n':
    case '09d':
    case '09n':
        echo '<div class="breezy icon">
        <ul>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
        <span class="cloudr"></span>


    </div>';
        break;
}
?>
</body>
</html>