<?php
  error_reporting(E_ERROR | E_PARSE);
  $weather = ""; 
  $error = "";
 if(isset($_GET['city'])){
  $urlContent = file_get_contents('https://api.openweathermap.org/data/2.5/weather?q='.$_GET['city'].'&units=metric&appid=10d7fb319c90684e164ce737fbee51cf');
}

  $forcastArray = json_decode($urlContent, true);

  if($forcastArray['cod'] == 200) {
    $weather = $forcastArray['weather'][0]['description'];

  $weather = 'The weather in '.$_GET['city'].' '.$weather.'. The Temperature is '.$forcastArray['main']['temp'].'&#8451'.' The speed of wind is '.$forcastArray['wind']['speed'].'m/sec';
} else {
  $error = "The city name incorrect";
}

  

?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="styles/style.css">

    <title>Weather App</title>
  </head>
  <body>
    <div class="container" id="mainDiv">
      <h1>Weather in the city</h1>
      <form>
  <div class="mb-3">
    <label for="city" class="form-label">Input a city name</label>
    <input class="form-control" name="city" id="city" aria-describedby="Forcast city" placeholder="Enter city name">
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
    </div>
    <div id="forCastDiv">
        <?php
         if($weather) {
           echo'<div class="alert alert-primary" role="alert"> '.$weather.'</div>';
         } else if ($error) {
            echo'<div class="alert alert-danger" role="alert"> '.$error.'</div>';
         }
         ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

  </body>
</html>