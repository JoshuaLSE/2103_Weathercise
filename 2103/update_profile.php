<?php
session_start();
if (empty($_SESSION['Username'])) {
    //echo "<h4>" . $_SESSION['user'] . "</h4>";
    //header("Location: index.php");
}
?>
<!Doctype html>
<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <?php
        $m = new MongoDB\Driver\Manager("mongodb+srv://admin:Passw0rd@ict2103.jbggf.mongodb.net/test?authSource=admin&replicaSet=atlas-lie30k-shard-0&readPreference=primary&appname=MongoDB%20Compass&ssl=true");

        $username = $_SESSION['Username'];

        $filter = ['UserName' => $username];
        $options = [];

        $query = new MongoDB\Driver\Query($filter, $options);
        $cursor = $m->executeQuery('ICT2103.user', $query);

        foreach ($cursor as $document) {
            $document;
        }
        $_SESSION['password'] = $document->Password;
        $_SESSION['firstName'] = $document->FirstName;
        $_SESSION['lastName'] = $document->LastName;
        $_SESSION['gender'] = $document->Gender;
        $_SESSION['age'] = $document->Age;
        $_SESSION['height'] = $document->Height;
        $_SESSION['weight'] = $document->Weight;
        $locationID = $document->location_id;


        $filter = ['location_id' => $locationID];
        $options = [];

        $query = new MongoDB\Driver\Query($filter, $options);
        $cursor = $m->executeQuery('ICT2103.locations', $query);

        foreach ($cursor as $document) {
            $document;
        }

        $location_name = $document->location_name;
        $_SESSION['location'] = $location_name;

        ?>

    </head>
    <body>
        <?php include "nav-top.inc.php"; ?>
        <div class="row">
            <?php include "nav-side.inc.php"; ?>  
            <div class="container bootstrap snippets bootdey">
                <h1 class="text-primary">Update Profile</h1>
                <hr>
                <div class="row">

                    <!-- edit form column -->
                    <div class="col-md-9 personal-info">
                        <h3>Personal info</h3>

                        <form class="form-horizontal" method="post" action="process_update.php">
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Username:</label>
                                <div class="col-lg-8">
                                    <input class="form-control" name="username" type="text" value="<?php echo $_SESSION['Username']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Password:</label>
                                <div class="col-lg-8">
                                    <input class="form-control" type="password" name="pwd" value="<?php echo $_SESSION['password']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">First Name:</label>
                                <div class="col-lg-8">
                                    <input class="form-control" type="text" name="fname" value="<?php echo $_SESSION['firstName']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Last Name:</label>
                                <div class="col-lg-8">
                                    <input class="form-control" type="text" name="lname" value="<?php echo $_SESSION['lastName']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Gender:</label>
                                <div class="col-lg-8">
                                    <div class="ui-select">
                                        <select id="user_time_zone" name="gender" class="form-control">
                                            <option value="M">Male</option>
                                            <option value="F">Female</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Age:</label>
                                <div class="col-lg-8">
                                    <input class="form-control" name="age" type="number" value="<?php echo $_SESSION['age']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Height:</label>
                                <div class="col-lg-8">
                                    <input class="form-control" type="number" step=".01" name="height" value="<?php echo $_SESSION['height']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Weight:</label>
                                <div class="col-lg-8">
                                    <input class="form-control" type="number" step=".01" name="weight" value="<?php echo $_SESSION['weight']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Location:</label>
                                <div class="col-lg-8">
                                    <div class="ui-select">
                                        <select id="user_time_zone" name="location" class="form-control">
                                            <option value="1">Ang Mo Kio</option>
                                            <option value="2">Bedok</option>
                                            <option value="3">Bishan</option>
                                            <option value="4">Boon Lay</option>
                                            <option value="5">Bukit Batok</option>
                                            <option value="6">Bukit Merah</option>
                                            <option value="7">Bukit Panjang</option>
                                            <option value="8">Bukit Timah</option>
                                            <option value="9">Central Water Catchment</option>
                                            <option value="10">Changi</option>
                                            <option value="11">Choa Chu Kang</option>
                                            <option value="12">Clementi</option>
                                            <option value="13">City</option>
                                            <option value="14">Geylang</option>
                                            <option value="15">Hougang</option>
                                            <option value="16">Jalan Bahar</option>
                                            <option value="17">Jurong East</option>
                                            <option value="18">Jurong Island</option>
                                            <option value="19">Jurong West</option>
                                            <option value="20">Kallang</option>
                                            <option value="21">Lim Chu Kang</option>
                                            <option value="22">Mandai</option>
                                            <option value="23">Marine Parade</option>
                                            <option value="24">Novena</option>
                                            <option value="25">Pasir Ris</option>
                                            <option value="26">Paya Lebar</option>
                                            <option value="27">Pioneer</option>
                                            <option value="28">Pulau Tekong</option>
                                            <option value="29">Pulau Ubin</option>
                                            <option value="30">Punggol</option>
                                            <option value="31">Queenstown</option>
                                            <option value="32">Seletar</option>
                                            <option value="33">Sembawang</option>
                                            <option value="34">Sengkang</option>
                                            <option value="35">Sentosa</option>
                                            <option value="36">Serangoon</option>
                                            <option value="37">Southern Islands</option>
                                            <option value="38">Sungei Kadut</option>
                                            <option value="39">Tampines</option>
                                            <option value="40">Tanglin</option>
                                            <option value="41">Tengah</option>
                                            <option value="42">Toa Payoh</option>
                                            <option value="43">Tuas</option>
                                            <option value="44">Western Islands</option>
                                            <option value="45">Western Water Catchment</option>
                                            <option value="46">Woodlands</option>
                                            <option value="47">Yishun</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success" name="reg_user">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <hr>
        </div>
    </body>
</html>