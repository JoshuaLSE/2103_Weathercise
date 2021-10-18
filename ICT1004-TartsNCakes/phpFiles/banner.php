<div class="jumbotron jumbotron-fluid text-center bg-light">
    <div class="container">
        <h1>Tarts N' Cakes</h1>
        <p>Best thing since Sliced Bread</p>
        <?php
        if (!isset($_SESSION['whoami'])) {
            echo '<a class="btn btn-primary" href="register.php" role="button">Shop Here</a>';
        } else {
            echo ' <a class="btn btn-primary" href="Store.php" role="button">Shop Here</a>';
        }
        ?>
    </div>
</div>