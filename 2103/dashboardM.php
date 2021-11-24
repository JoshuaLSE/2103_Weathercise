<?php
$server = "mongodb+srv://admin:Passw0rd@ict2103.jbggf.mongodb.net/test?authSource=admin&replicaSet=atlas-lie30k-shard-0&readPreference=primary&appname=MongoDB%20Compass&ssl=true";
$client = new MongoDB\Driver\Manager($server);
// check for session id
$_SESSION['ID'] = 1;
$_SESSION["Username"] = "Botato";
/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Weathercise</title>
        <!-- insert stylesheets here -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    </head>
    <body>
        <nav class="navbar navbar-light bg-light p-3">
            <div class="d-flex col-12 col-md-3 col-lg-2 mb-2 mb-lg-0 flex-wrap flex-md-nowrap justify-content-between">
                <a class="navbar-brand" href="/ICT2103/dashboard.php">
                    Weathercise Dashboard
                </a>
                <button class="navbar-toggler d-md-none collapsed mb-3" type="button" data-toggle="collapse" data-target="#sidebar" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="col-12 col-md-5 col-lg-8 d-flex align-items-center justify-content-md-end mt-3 mt-md-0">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                        Hello, <?php echo $_SESSION['Username'] ?>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item" href="/ICT2103/update_profile.php">Update Profile</a></li>
                        <li><a class="dropdown-item" href="/ICT2103/logout.php">Sign out</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container-fluid">
            <div class="row">
                <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                    <!-- sidebar content goes in here --><div class="position-sticky pt-md-5">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="/ICT2103/dashboard.php">
                                    <i class="fa fa-home"width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></i>
                                    <span class="ml-2">Dashboard</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="/ICT2103/food.php">
                                    <i class='fas fa-drumstick-bite' width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></i>
                                    <span class="ml-2">Food</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="/ICT2103/exercise.php">
                                    <i class='fas fa-running' width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></i>
                                    <span class="ml-2">Exercise</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
                <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4 py-4">
                    <h1 class="h2">Dashboard</h1>
                    <div class="card">
                        <h5 class="card-header">Weather Forecast</h5>
                        <div class="card-body" style='height: 350px'>
                            <iframe src="https://data.gov.sg/dataset/weather-forecast/resource/571ef5fb-ed31-48b2-85c9-61677de42ca9/view/4c127d9a-cba6-445a-8fc1-978b565f9bf7" frameBorder="0" id='weatherapi' style="overflow:hidden;height:100%;width:100%" height="100%" width="100%"> </iframe>
                        </div>
                    </div>


                    <div class="row mt-3">
                        <div class="card">
                            <div class="card-header">
                                <?php
                                $userlocation = "";
                                $location_id = "";
                                //query for user location_id using session
                                $filter = ["User_ID" => strval($_SESSION['ID'])];
                                $query = new MongoDB\Driver\Query($filter);

#executing
                                $cursor = $client->executeQuery('ICT2103.user', $query);

                                foreach ($cursor as $document) {
                                    $location_id = $document->location_id;
                                }

                                //store current user location
                                $filter = ["location_id" => $location_id];
                                $query = new MongoDB\Driver\Query($filter);

#executing
                                $cursor = $client->executeQuery('ICT2103.locations', $query);

                                foreach ($cursor as $document) {
                                    $userlocation = $document->location_name;
                                    echo "Recommended Exercise (" . $document->location_name . ")";
                                }
                                ?>
                            </div>

                            <table class="card-table table">
                                <thead>
                                    <tr>
                                        <th scope="col">Exercise</th>
                                        <th scope="col">Intensity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
// Return current date from the remote server
                                    date_default_timezone_set("Singapore");
                                    $date = date('Y-m-d\TH:i:s');
                                    $urldate = urlencode($date);

//retreive data from online API (data gov.sg)
                                    $json = file_get_contents('https://api.data.gov.sg/v1/environment/2-hour-weather-forecast?date_time=' . strval($urldate));
                                    $obj = json_decode($json);
                                    $items = $obj->items;
                                    $forecasts = null;

//store current user details                                    $user_location = '';
                                    $user_forecast = '';

//using for loop to split array to object after retrieving from online API JSON file
                                    foreach ($items as $value) {
                                        if ($value->forecasts) {
                                            $forecasts = $value->forecasts;
                                        }
                                    }

// check user current location weather forecast
                                    foreach ($forecasts as $v2) {
                                        //check if its the user location using the location that the user sets $_SESSION["location_id"]
                                        if ($v2->area == $userlocation) {
                                            $user_forecast = $v2->forecast;
                                        }
                                    }



                                    if ($userlocation != "") {
//check which exercise is recommended for current user
                                        if (strpos($user_forecast, 'rain') !== false) {
                                            echo "here";
                                            $filter = ["Condition" => "Indoor"];
                                            $query = new MongoDB\Driver\Query($filter, ['limit' => 10]);

#executing
                                            $cursor = $client->executeQuery('ICT2103.exercise', $query);

                                            foreach ($cursor as $document) {
                                                echo "<tr>" . "<td>" . $document->Type . "</td>" . "<td>" . $document->intensity . "</td>" . "</tr>";
                                            }
                                        } else {
                                            $filter = [];
                                            $query = new MongoDB\Driver\Query($filter, ['limit' => 10]);

#executing
                                            $cursor = $client->executeQuery('ICT2103.exercise', $query);

                                            foreach ($cursor as $document) {
                                                echo "<tr>" . "<td>" . $document->Type . "</td>" . "<td>" . $document->intensity . "</td>" . "</tr>";
                                            }
                                        }
                                    } else {
                                        echo "";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
            </div>
        </main>
    </div>

</div>


<!-- insert scripts here -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
<style>
    .sidebar {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        z-index: 100;
        padding: 90px 0 0;
        box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
        z-index: 99;
    }

    @media (max-width: 767.98px) {
        .sidebar {
            top: 11.5rem;
            padding: 0;
        }
    }

    .navbar {
        box-shadow: inset 0 -1px 0 rgba(0, 0, 0, .1);
    }

    @media (min-width: 767.98px) {
        .navbar {
            top: 0;
            position: sticky;
            z-index: 999;
        }
    }

    .sidebar .nav-link {
        color: #333;
    }

    .sidebar .nav-link.active {
        color: #0d6efd;
    }
</style>

</body>



</html>

