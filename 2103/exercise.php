<?php
session_start();
if (empty($_SESSION['Username'])) {
    echo "<h4>" . $_SESSION['Username'] . "</h4>";
//    header("Location: login.php");
}

$m = new MongoDB\Driver\Manager("mongodb+srv://admin:Passw0rd@ict2103.jbggf.mongodb.net/test?authSource=admin&replicaSet=atlas-lie30k-shard-0&readPreference=primary&appname=MongoDB%20Compass&ssl=true");


if (isset($_SESSION['Username'])) {
    $username = $_SESSION['Username'];

    $filter = ['UserName' => $username];
    $options = [];

    $query = new MongoDB\Driver\Query($filter, $options);
    $cursor = $m->executeQuery('ICT2103.user', $query);

    foreach ($cursor as $document) {
        $document;
    }
    $_SESSION['burntCalories'] = $document->BurntCalories;
}
?>
<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    </head>
    <body>
        <?php include "nav-top.inc.php"; ?>
        <div class="row">
            <?php include "nav-side.inc.php"; ?>    
            <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4 py-4">
                <div class="col-sm">

                    <h2>New Discovery? Note it down below!</h2>

                    <div class="card">
                        <div class="card-header">
                            Create New Exercise
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" method="post" action="createExercise.php">
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Exercise:</label>
                                    <div class="col-lg-8">
                                        <input class="form-control" type="text" name="exercise" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Condition:</label>
                                    <div class="col-lg-8">
                                        <div class="ui-select">
                                            <select id="user_time_zone" type="text" name="condition" class="form-control">
                                                <option value="Indoor">Indoor</option>
                                                <option value="Outdoor">Outdoor</option>
                                                <option value="Anywhere">Anywhere</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Intensity:</label>
                                    <div class="col-lg-8">
                                        <label class="radio-inline"><input value="very light" type="radio" name="intensity" checked style="margin-right: 2px">Very Light</label>
                                        <label class="radio-inline"><input value="light" type="radio" name="intensity" style="margin-right: 2px">Light</label>
                                        <label class="radio-inline"><input value="moderate" type="radio" name="intensity" style="margin-right: 2px">Moderate</label>
                                        <label class="radio-inline"><input value="vigorous" type="radio" name="intensity" style="margin-right: 2px">Vigorous</label>
                                        <label class="radio-inline"><input value="very vigorous" type="radio" name="intensity" style="margin-right: 2px">Very Vigorous</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Calories/gram:</label>
                                    <div class="col-lg-8">
                                        <input class="form-control" type="number" step=".01" name="caloriesGram" required>
                                    </div>
                                </div>
                                <div class="form-group" style="text-align: center">
                                    <button type="submit" class="btn btn-success" name="reg_user">Create</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>  

                <div class="col">

                    <h2>Recommendations</h2>

                    <!-- Card -->
                    <div class="card">

                        <div class="card-header">
                            <?php echo "<p>You have burned a total of " . $_SESSION['burntCalories'] . " Calories! " . $_SESSION['Username'] . "</p>"; ?>
                        </div>
                        <div class="card-body">
                            <?php
                            $m = new MongoDB\Driver\Manager("mongodb+srv://admin:Passw0rd@ict2103.jbggf.mongodb.net/test?authSource=admin&replicaSet=atlas-lie30k-shard-0&readPreference=primary&appname=MongoDB%20Compass&ssl=true");

                            if ($_SESSION['burntCalories'] < 500) {
                                echo '<p> You are below average, need more training! </p>';
                                echo '<p> These are the top 3 most vigorous exercise for you to consider doing. </p>';
                                if (isset($_SESSION['Username'])) {
                                    $filter = ["intensity" => 'very vigorous'];
                                    $options = ['sort' => ['Calories/gram' => -1], 'limit' => 3];
                                    #constructing the querry
                                    $query = new MongoDB\Driver\Query($filter, $options);
                                    #executing
                                    $cursor = $m->executeQuery('ICT2103.exercise', $query);
                                    echo '<ul class=list-group>';
                                    foreach ($cursor as $document) {
                                        echo "<li class=list-group-item>" . $document->Type . "</li>";
                                    }
                                    echo '</ul>';
                                }
                            } else if ($_SESSION['burntCalories'] < 1000) {
                                echo ' <p> You are on average, can do better! </p>';
                                echo '<p> These are the top 3 moderate exercise for you to consider doing. </p>';
                                if (isset($_SESSION['Username'])) {
                                    $filter = ["intensity" => 'moderate'];
                                    $options = ['sort' => ['Calories/gram' => -1], 'limit' => 3];
                                    #constructing the querry
                                    $query = new MongoDB\Driver\Query($filter, $options);
                                    #executing
                                    $cursor = $m->executeQuery('ICT2103.exercise', $query);
                                    echo '<ul class=list-group>';
                                    foreach ($cursor as $document) {
                                        echo "<li class=list-group-item>" . $document->Type . "</li>";
                                    }
                                    echo '</ul>';
                                }
                            } else {
                                echo '<p> You are above average, keep it up! </p>';
                                echo '<p> These are the top 3 lightest exercise for you to consider doing. </p>';
                                if (isset($_SESSION['Username'])) {
                                    $filter = ["intensity" => 'very light'];
                                    $options = ['sort' => ['Calories/gram' => 1], 'limit' => 3];
                                    #constructing the querry
                                    $query = new MongoDB\Driver\Query($filter, $options);
                                    #executing
                                    $cursor = $m->executeQuery('ICT2103.exercise', $query);
                                    echo '<ul class=list-group>';
                                    foreach ($cursor as $document) {
                                        echo "<li class=list-group-item>" . $document->Type . "</li>";
                                    }
                                    echo '</ul>';
                                }
                            }
                            ?>
                        </div>

                    </div>
                    <!-- Card -->

                </div>
                <!--Grid column-->


                <div class="col">
                    <h2>Check out the calories count below!</h2>

                    <form method="post">
                        <label>Search</label>
                        <input type="text" name="search">
                        <input type="submit" name="submit">
                    </form>


                    <?php
                    $m = new MongoDB\Driver\Manager("mongodb+srv://admin:Passw0rd@ict2103.jbggf.mongodb.net/test?authSource=admin&replicaSet=atlas-lie30k-shard-0&readPreference=primary&appname=MongoDB%20Compass&ssl=true");

                    if (isset($_SESSION['Username'])) {
                        $username = $_SESSION['Username'];
                        $filter = ['UserName' => $username];
                        $options = [];

                        $query = new MongoDB\Driver\Query($filter, $options);
                        $cursor = $m->executeQuery('ICT2103.user', $query);

                        foreach ($cursor as $document) {
                            $document;
                        }
                        $_SESSION['burntCalories'] = $document->BurntCalories;
                    }

                    if (isset($_POST['delete'])) {
                        $did = (int)$_POST['deleteId'];

                        $bulk = new MongoDB\Driver\BulkWrite;
                        $bulk->delete(['Exercise_ID' => $did], ['limit' => 1]);

                        $result = $m->executeBulkWrite('ICT2103.exercise', $bulk);
                    }


                    if (isset($_POST['insert'])) {

                        $username = $_SESSION['Username'];
                        $filter = ['UserName' => $username];
                        $options = [];

                        $query = new MongoDB\Driver\Query($filter, $options);
                        $cursor = $m->executeQuery('ICT2103.user', $query);

                        foreach ($cursor as $document) {
                            $document;
                        }
                        $_SESSION['userID'] = $document->_id;
                        $burntCalories = $document->BurntCalories;

                        $userID = $_SESSION['userID'];
                        $exerciseId = (int)$_POST['insertId'];
                        $hours = $_POST['hours'];

                        $filter = ['_id' => $userID];
                        $options = [];

                        $query = new MongoDB\Driver\Query($filter, $options);
                        $cursor = $m->executeQuery('ICT2103.user', $query);

                        foreach ($cursor as $document) {
                            $document;
                        }
                        $_SESSION['weight'] = $document->Weight;

                        $filter = ['Exercise_ID' => $exerciseId];
                        $options = [];

                        $query = new MongoDB\Driver\Query($filter, $options);
                        $cursor = $m->executeQuery('ICT2103.exercise', $query);
                        foreach ($cursor as $document) {
                            $document;
                        }
                        $caloriesString = "Calories/gram";
                        $caloriesCount = $document->$caloriesString;


                        $bulkWrite = new MongoDB\Driver\BulkWrite;
                        $bulkWrite->update(['_id' => $userID],
                                ['$set' => ['BurntCalories' => $burntCalories + $_SESSION['weight'] * $hours * $caloriesCount]],
                                ['multi' => false, 'upsert' => false]);
                        $m->executeBulkWrite('ICT2103.user', $bulkWrite);
                    }


                    if (isset($_POST['edit'])) {
                        $did = (int)$_POST['editId'];
                        $type = $_POST['type'];
                        $condition = $_POST['condition'];
                        $intensity = $_POST['intensity'];
                        $calories = $_POST['calories'];
                        

                        $bulkWrite = new MongoDB\Driver\BulkWrite;
                        $bulkWrite->update(['Exercise_ID' => $did],
                                ['$set' => ['Type' => $type, 'Condition' => $condition, 'intensity' => $intensity, 'Calories/gram' => $calories]],
                                ['multi' => false, 'upsert' => false]);
                        $m->executeBulkWrite('ICT2103.exercise', $bulkWrite);
                    }



                    if (isset($_POST["submit"])) {
                        $search_param = $_POST['search'];

                        $testString = '/' . $search_param . '/';
                        
                        array('$regex' => 'm');

                        $caloriesString = "Calories/gram";


// Check connection
                        if ($m == null) {
                            $errorMsg = "Connection failed: ";
                            $success = false;
                            echo 'connection failed';
                        } else {

                            $filter = ['Type' => array('$regex' => $search_param)];
                            $options = [];

                            $query = new MongoDB\Driver\Query($filter, $options);
                            $cursor = $m->executeQuery('ICT2103.exercise', $query);

                            if ($cursor != null) {
                                ?>
                                <div class="card">
                                    <div class="card-header">
                                        Here are the listing!
                                    </div>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Exercise</th>
                                                <th scope="col">Condition</th>
                                                <th scope="col">Intensity</th>
                                                <th scope="col">Calories/gram</th>
                                                <th scope="col">Select</th>
                                                <th scope="col">Update</th>
                                                <th scope="col">Delete</th>
                                            </tr>
                                        </thead>
                                        <?php
                                        $a = "Hello";
                                        $a1 = "Helloo";
                                        $b = $a . 1; // now $b contains "Hello World!"
                                        $i = 1;
                                        foreach ($cursor as $document) {
                                            $i++;
                                            $b = $a . $i;
                                            $b1 = $a1 . $i;
                                            echo "<tr id=" . $document->Exercise_ID . ">";
                                            echo "<td>" . $document->Type . "</td>";
                                            echo "<td>" . $document->Condition . "</td>";
                                            echo "<td>" . $document->intensity . "</td>";
                                            echo "<td>" . $document->$caloriesString . "</td>";
                                            echo "<td><input type=submit data-toggle='modal' value=Select data-target='#$b'></td><!-- Modal -->
    <div class='modal fade' id='$b' role='dialog'>
        <div class='modal-dialog'>

            <!-- Modal content-->
            <div class='modal-content'>
                <form method='post'>
                    <div class='form-group'>
                        <input type=hidden name=insertId value=" . $document->Exercise_ID . " >
                        <div class='col-lg-8'>
                        <label control-label'>Exercise Done:</label>
                        <label control-label'>" . $document->Type . "</label>
                        </div>
                    </div>
                    <div class='form-group'>
                        <div class='col-lg-8'>
                        <label control-label'>Calories/gram:</label>
                        <label control-label'>" . $document->$caloriesString . "</label>
                        </div>
                    </div>
                    <div class='form-group'>
                        <label class='col-lg-3 control-label'>Number of hours:</label>
                        <div class='col-lg-8'>
                            <input class='form-control' type='number' step='.01' name='hours' required>
                        </div>
                    </div>
                    <div class='form-group' style='text-align: center';>
                        <button type='submit' class='btn btn-success' name='insert'>Confirm</button>
                    </div>
                </form>
            </div>

        </div>
    </div>";
                                            echo "
            <td><input type=submit data-toggle='modal' value=Edit data-target='#$b1'></td>

    <!-- Modal -->
    <div class='modal fade' id='$b1' role='dialog'>
        <div class='modal-dialog'>

            <!-- Modal content-->
            <div class='modal-content'>
                <form method='post'>
                    <div class='form-group'>
                        <input type=hidden name=editId value=" . $document->Exercise_ID . " >
                        <label class='col-lg-3 control-label'>Exercise:</label>
                        <div class='col-lg-8'>
                            <input class='form-control' type='text' name='type' value=" . $document->Type . " required>
                        </div>
                    </div>
                    <div class='form-group'>
                        <label class='col-lg-3 control-label'>Condition:</label>
                        <div class='col-lg-8'>
                            <div class='ui-select'>
                                <select id='user_time_zone' type='text' name='condition' class='form-control'>
                                    <option value='Indoor'>Indoor</option>
                                    <option value='Outdoor'>Outdoor</option>
                                    <option value='Anywhere'>Anywhere</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class='form-group'>
                        <label class='col-lg-3 control-label'>Intensity:</label>
                        <div class='col-lg-8'>
                            <label class='radio-inline'><input value='very light' type='radio' name='intensity' checked style='margin-right: 2px'>Very Light</label>
                            <label class='radio-inline'><input value='light' type='radio' name='intensity' style='margin-right: 2px'>Light</label>
                            <label class='radio-inline'><input value='moderate' type='radio' name='intensity' style='margin-right: 2px'>Moderate</label>
                            <label class='radio-inline'><input value='vigorous' type='radio' name='intensity' style='margin-right: 2px'>Vigorous</label>
                            <label class='adio-inline'><input value='very vigorous' type='radio' name='intensity' style='margin-right: 2px'>Very Vigorous</label>
                        </div>
                    </div>
                    <div class='form-group'>
                        <label class='col-lg-3 control-label'>Calories/gram:</label>
                        <div class='col-lg-8'>
                            <input class='form-control' type='number' step='.01' name='calories' value=" . $document->$caloriesString . " required>
                        </div>
                    </div>
                    <div class='form-group' style='text-align: center';>
                        <button type='submit' class='btn btn-success' name='edit'>Update</button>
                    </div>
                </form>
            </div>

        </div>
    </div>";
                                            echo "<form method='POST'><td><input type=hidden name=deleteId value=" . $document->Exercise_ID . " ><input type=submit value=Delete name=delete ></td></form>";
                                            echo "</tr>";
                                        }
                                        ?>
                                    </table>
                                </div>
                                <?php
                            } else {
                                echo "Name does not exist";
                            }
                        }
                    }
                    ?>
                </div>
            </main>
        </div>
    </body>
</html>
