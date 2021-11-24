<!DOCTYPE html>
<html lang="en">
    <?php // include "connection.php"; ?>
    <?php
    session_start();
    if (isset($_SESSION['ID'])) {
        
    } else {
//        header('Location:login.php');
    }
    $todaysDate = new MongoDB\BSON\UTCDateTime(strtotime(date('Y-m-d')) * 1000);
    $weekAgo = new MongoDB\BSON\UTCDateTime(strtotime(date('Y-m-d', strtotime('-1 Week'))) * 1000);
    $server = "mongodb+srv://admin:Passw0rd@ict2103.jbggf.mongodb.net/test?authSource=admin&replicaSet=atlas-lie30k-shard-0&readPreference=primary&appname=MongoDB%20Compass&ssl=true";
    $client = new MongoDB\Driver\Manager($server);
    ?>
    <head>
        <title>Weathercise</title>
        <?php include "head-dashboard.inc.php"; ?>
    </head>
    <body>
        <?php include "nav-top.inc.php"; ?>
        <div class="container-fluid">
            <div class="row">
                <?php include "nav-side.inc.php"; ?>    
                <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4 py-4">
                    <h1 class="h2">Dashboard</h1>
                    <div class="card">
                        <h5 class="card-header">Food Intake History (Past Week)</h5>
                        <div class="card-body" style='height: 350px'>
                            <?php
//                            figure out how to store the table variables
                            ?>
                            <div class="table-wrapper-scroll-y my-custom-scrollbar">
                                <table class="table table-bordered table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col">Date</th>
                                            <th scope="col">Food ID</th>
                                            <th scope="col">Servings</th>
                                            <th scope="col">Calories</th>
                                            <th scope="col">Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- PHP CODE TO FETCH DATA FROM ROWS-->
                                        <?php
                                        $totalCalories = 0;
                                        $filter = ["User_ID" => "1", "Date"=>['$gt'=>$weekAgo]];
//                                        $filter = ["User_ID" => $_SESSION['ID']];

                                        $options = []; /* put desired options here, should you need any */

                                        $query = new MongoDB\Driver\Query($filter, $options);

                                        $documents = $client->executeQuery('ICT2103.food_history', $query);
//                                            FETCHING DATA FROM EACH ROW OF EVERY COLUMN
                                        ?>
                                        <!--FETCHING DATA FROM EACH 
                                            ROW OF EVERY COLUMN-->
                                        <?php
                                        foreach ($documents as $document) {
                                            $resultDate = new MongoDB\BSON\UTCDateTime(strval($document->Date));
                                            $resultDate = $resultDate->toDateTime()->format("d M Y");
                                            $document = json_decode(json_encode($document), true);
                                            $filter = ["Food_ID" => $document["Food_ID"],];
////                                                $filter = ["User_ID" => $_SESSION['ID']];
                                            $cal = new MongoDB\Driver\Query($filter);
                                            $calories = $client->executeQuery('ICT2103.food_calories', $cal);
                                            foreach ($calories as $calory) {
                                                $calory = json_decode(json_encode($calory), true);
                                                $calResult = $calory["Calories"];
                                                $foodName = $calory["Food"];
                                            }
                                            $calculatedCal = $document["Servings"] * $calResult;
                                            echo "<tr>";
                                            echo "<th>" . $resultDate . "</th>";
                                            echo "<td>" . $foodName . "</td>";
                                            echo "<td>" . $document["Servings"] . "</td>";
                                            echo "<td>" . $calculatedCal . "</td>";
                                            $totalCalories += $calculatedCal;
                                            // If action is to EDIT
                                            echo '<td>';
                                            echo '<form id = "EDITFORM" action = "" method = "post">';
                                            echo '<label for = "newQuantity">Input a Quantity:</label>';
                                            echo '<input type = "number" min = "1" max = "5" name = "newQuantity" id = "newQuantity" placeholder = "Update servings">';
                                            echo '<input type = "submit" name = "Edit" value = "Edit">';
                                            echo '<input type = "hidden" name = "id" value = "' . implode("", $document["_id"]) . '">';
                                            echo '</form>';
                                            // If action is to DELETE
                                            echo '<form id = "DELETEFORM" action = "" method = "post">';
                                            echo '<input type = "submit" name = "Delete" value = "Delete">';
                                            echo '<input type = "hidden" name = "id" value = "' . implode("", $document["_id"]) . '">';
                                            echo '</form>';
                                            echo '</td>';
                                            echo "</tr>";
                                        }
                                        $bulk = new MongoDB\Driver\BulkWrite;
                                        if (isset($_POST['Edit'])) {
                                            $entryID = new MongoDB\BSON\ObjectID($_POST['id']);
                                            $updateValue = $_POST['newQuantity'];
                                            $bulk->update(['_id' => $entryID], ['$set' => ['Servings' => $updateValue]], ['multi' => false, 'upsert' => false]);

                                            $result = $client->executeBulkWrite('ICT2103.food_history', $bulk);
                                        }
                                        // If action is to DELETE
                                        if (isset($_POST['Delete'])) {
                                            $entryID = new MongoDB\BSON\ObjectID($_POST['id']);
                                            $bulk->delete(['_id' => $entryID], ['limit' => 0]);

                                            $result = $client->executeBulkWrite('ICT2103.food_history', $bulk);
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <h1>Add your recent meals!</h1>
                                    <?php
                                    // SQL query to select data from database
                                    // If action is to EDIT
                                    if (isset($_POST['Submit'])) {
                                        $newFoodID = $_POST['foodOptions'];
                                        $newServings = $_POST['servings'];
                                        $bulk = new MongoDB\Driver\BulkWrite;
//                                        Creating the document
                                        $insertEntry = [
                                            'User_ID' => '1',
                                            'Food_ID' => $newFoodID,
                                            'Servings' => $newServings,
                                            'Date' => $todaysDate,
                                        ];
//                                        Insert into Food History here
                                        $bulk->insert($insertEntry);
                                        $result = $client->executeBulkWrite('ICT2103.food_history', $bulk);
                                    }
                                    ?>

                                    <form id="foodInsert" method="post" action="">
                                        <!--Making dropdown menu for food-->
                                        <select name="foodOptions" id = "foodOptions">
                                            <?php
                                            // LOOP TILL END OF DATA 
                                            $filter = [];

                                            $options = []; /* put desired options here, should you need any */

                                            $query = new MongoDB\Driver\Query($filter, $options);

                                            $documents = $client->executeQuery('ICT2103.food_calories', $query);
//                                            FETCHING DATA FROM EACH ROW OF EVERY COLUMN
                                            foreach ($documents as $document) {
                                                $document = json_decode(json_encode($document), true);
                                                echo "<option value=" . $document["Food_ID"] . ">" . $document["Food"] . "</option>";
                                            }
                                            ?>
                                            <!--                                            <option value=Food_ID>Food</option>-->
                                        </select>   

                                        <h3>Servings</h3>
                                        <label for="servings">Number of Servings:</label>
                                        <input type="number" id="servings" required name="servings"                   
                                               placeholder="Enter servings" min="1" max="5">           
                                        <input type="submit" name="Submit" value="Submit"> 
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Weekly Statistics</h5>
                                <p class="card-text">Total Calories: <?php echo $totalCalories; ?></p>
                                <p class="card-text">Average Calories/Day: <?php echo number_format($totalCalories /= 7, 2); ?></p>
                                <?php
                                if ($totalCalories <= 30) {
                                    echo"<img class='img-responsive' src='https://clasebcn.com/wp-content/uploads/2020/04/harold-03.jpg' width='150' height='150'>";
                                } else if ($totalCalories > 30 && $totalCalories < 50) {
                                    echo"<img class='img-responsive' src='https://i0.kym-cdn.com/photos/images/original/001/119/076/193.jpg' width='150' height='150'>";
                                } else {
                                    echo"<img class='img-responsive' src='https://www.dailydot.com/wp-content/uploads/2018/03/haroldmancity.png' width='150' height='150'>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
    </body>
</html>