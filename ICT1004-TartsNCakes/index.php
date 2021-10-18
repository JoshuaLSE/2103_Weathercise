<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
        include 'phpFiles/headcontents.inc.php';
        ?>
        <!--Google Fonts-->
        <link rel="preconnect" href="https://fonts.gstatic.com">
    </head>

    <body>
        <?php
        include "phpFiles/nav.inc.php";
        include "phpFiles/banner.php";
        ?> 
        <main>
            <section id="services" class="container">
                <div class="row text-center">
                    <div class="col-md-6 mb-6">
                        <div class="card h-75">
                            <img class="card-img-top RESIZER" src="images/Almond%20Buttercream%20Macaron.jpg" alt="Tarts">
                            <div class="card-body">
                                <h4 class="card-title">Tangy Tarts</h4>
                                <p class="card-text">
                                    A tart is small pie filled with fruit or custard, with no top crust,
                                    like the cherry tarts you bought at the bakery.
                                </p>
                            </div>
                            <div class="card-footer py-4">
                                <?php
                                if (!isset($_SESSION['whoami'])) {
                                    echo '<a class="btn btn-secondary" href="register.php">Tarts</a>';
                                } else {
                                    echo ' <a href="Store.php#Tarts" class="btn btn-secondary">Tarts</a>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-6">
                        <div class="card h-75">
                            <img class="card-img-top RESIZER" src="images/Chocolate%20Cake.jpg" alt="Cakes">
                            <div class="card-body">
                                <h4 class="card-title">Classic Cakes</h4>
                                <p class="card-text">
                                    A cake is a baked dessert that's often topped with frosting or decorations.
                                    For many people, it's not a proper birthday without a birthday cake.
                                </p>
                            </div>
                            <div class="card-footer py-4">
                                <?php
                                if (!isset($_SESSION['whoami'])) {
                                    echo '<a class="btn btn-secondary" href="register.php">Cakes</a>';
                                } else {
                                    echo '<a href="Store.php#Cakes" class="btn btn-secondary">Cakes</a>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
        <?php include "phpFiles/footer.inc.php"; ?> 
    </body>
</html>