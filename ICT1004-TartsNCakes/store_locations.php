<!DOCTYPE html>
<html lang="en">
    <head> <!--header-->
        <?php
        include "headcontents.inc.php"
        ?>
        <script defer src="js/ourstores.js"></script>
    </head>

    <body>
        <?php
        include "phpFiles/nav.inc.php"
        ;
        ?> 
        <header id="Content">
            <?php
            include "phpFiles/banner.php";
            ?>
        </header>
        <main>
            <article id="stores_info">
                <div class="container">
                    <div class="row">
                        <h2>Our Stores</h2>
                    </div>
                    <div class="row">
                        <!--LOCATION CARD-->
                        <div class="card" style="width: 18rem;">
                            <img id ="card-img" class="card-img-top" 
                                 src="http://images.nymag.com/images/2/daily/2010/09/20100917_fpbakery_190x190.jpg"
                                 alt="Default Bakery Img">
                            <div class="card-body">
                                <h5 id = "card-title" class="card-title">Bakery</h5>
                                <p id = "card-body" class="card-text">Click the countries for more Info!</p>
                                <p>Opening Hours:</p>
                                <p id = "card-operating" class="cardtext"> </p>
                                <a id = "phone-link" href="#">Call Us!</a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="btn-group" role="group" aria-label="Button_Countries">
                            <button id="myBtn1" class="btn btn-secondary">Singapore</button>
                            <button id="myBtn2" class="btn btn-secondary">Malaysia</button>
                            <button id="myBtn3" class="btn btn-secondary">Taiwan</button>
                        </div>
                    </div>
                </div>
            </article>
    </main>
    <?php include "phpFiles/footer.inc.php"; ?> 
</body>
</html>