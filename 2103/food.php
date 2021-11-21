<!DOCTYPE html>
<html lang="en">
    <?php // include "connection.php"; ?>
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
                            $user = 'sqldev';
                            $password = 'P@55w0rd';
                            $database = 'ICT2103';
                            $servername = 'localhost';
                            $conn = new mysqli($servername, $user, $password, $database);
                            // Check connection
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }
                            // SQL query to select data from database
                            $sql = "SELECT * FROM food_history as a "
                                    . "LEFT JOIN food_calories AS b "
                                    . "ON a.Food_ID = b.Food_ID "
                                    . "WHERE timing between date_sub(now(),INTERVAL 1 WEEK) and now()"
                                    . "AND User_ID = 1;";
                            $result = $conn->query($sql);
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
                                        // LOOP TILL END OF DATA 
                                        while ($rows = $result->fetch_assoc()) {
                                            $totalCalories += ($rows['Calories'] * $rows['Servings']);
                                            ?>
                                            <tr>
                                                <!--FETCHING DATA FROM EACH 
                                                    ROW OF EVERY COLUMN-->
                                                <th><?php echo $rows['timing']; ?></th>
                                                <td><?php echo $rows['Food']; ?></td>
                                                <td><?php echo $rows['Servings']; ?></td>
                                                <td><?php echo $rows['Calories'] * $rows['Servings'] ?></td>
                                                <td>
                                                    <?php
                                                    $conn_edit = new mysqli($servername, $user, $password, $database);
                                                    if ($conn_edit->connect_error) {
                                                        die("Connection failed: " . $conn_edit->connect_error);
                                                    }
                                                    // If action is to EDIT
                                                    if (isset($_POST['Edit'])) {
                                                        $entryID = $_POST['id'];
                                                        $updateValue = $_POST['newQuantity'];
                                                        $update = mysqli_query($conn_edit,
                                                                "UPDATE food_history SET Servings =" . $updateValue . " WHERE EntryID = " . $entryID);
                                                        if (!$update) {
                                                            echo "Error updating entry" . $conn_edit->error;
                                                        } else {
                                                            header("Location: food.php");
                                                        }
                                                    }
                                                    // If action is to DELETE
                                                    if (isset($_POST['Delete'])) {
                                                        $entryID = $_POST['id'];
                                                        $del = mysqli_query($conn_edit,
                                                                "DELETE FROM food_history WHERE EntryID = " . $entryID);
                                                        if (!$del) {
                                                            echo "Error deleting entry" . $conn_edit->error;
                                                        } else {
                                                            header("Location: food.php");
                                                        }
                                                    }
                                                    ?>

                                                    <form id = "EDITFORM" action="" method="post">
                                                        <label for="newQuantity">Input a Quantity:</label>
                                                        <input type="number" min="1" max="5" name="newQuantity" id="newQuantity" placeholder="Update servings">
                                                        <input type="submit" name="Edit" value="Edit">
                                                        <input type="hidden" name="id" value="<?php echo $rows['EntryID']; ?>">
                                                    </form>
                                                    <form id = "DELETEFORM" action="" method="post">
                                                        <input type="submit" name="Delete" value="Delete">
                                                        <input type="hidden" name="id" value="<?php echo $rows['EntryID']; ?>">
                                                    </form>
                                                </td>
                                            </tr>
                                            <?php
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
                                    $sql_options = "SELECT Food, Food_ID FROM food_calories";
                                    $results = $conn->query($sql_options);

                                    // If action is to EDIT
                                    if (isset($_POST['Submit'])) {
                                        $newFoodID = $_POST['foodOptions'];
                                        $newServing = $_POST['servings'];
                                        $newInsert = mysqli_query($conn_edit,
                                                "INSERT INTO food_history (User_ID, Food_ID, timing, Servings)VALUES (1, " . $newFoodID . ", CURRENT_DATE(), " . $newServing . ");");
                                        if (!$newInsert) {
                                            echo "Error inserting entry foodID: " . $newFoodID . " error: " . $conn_edit->error;
                                        } else {
                                            header("Location: food.php");
                                        }
                                    }
                                    ?>

                                    <form id="foodInsert" method="post" action="">
                                        <!--Making dropdown menu for food-->
                                        <select name="foodOptions" id = "foodOptions">
                                            <?php
                                            // LOOP TILL END OF DATA 
                                            while ($rowd = $results->fetch_assoc()) {
                                                ?>
                                                <!--FETCHING DATA FROM EACH 
                                                    ROW OF EVERY COLUMN-->
                                                <option value = "<?php echo $rowd['Food_ID']; ?>"><?php echo $rowd['Food']; ?></option>
                                                <?php
                                            }
                                            ?>
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
                                $totalCalories = $totalCalories / 7;
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
<?php $conn->close(); ?>
</html>