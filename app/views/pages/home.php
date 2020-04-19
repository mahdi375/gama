<?php require_once SITE_ROOT.'app/views/includes/header.php'; ?>

    <div class="container" id="homePage">
        <h1>GaMa</h1>
        <p>Find your favorite games</p>

        <div id="homeNewGameDiv">
            <h5>New Games :</h5>
            <div class="row justify-content-around ">

                <div class="col-md-6 col-lg-3 mb-3 ">
                <div id="homeNewGamesCard" class="card shadow">
                    <img src="<?php genURL('public\uploads\img\46122850509814.jpeg'); ?>" class="card-img-top" >
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    </div>
                    <div class="row justify-content-around mb-1">
                        <a href="#"  class="btn col col-sm-4 ">More</a>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">Last updated 3 mins ago</small>
                    </div>
                </div>
                </div>
                
                
            </div>
        </div>

        
        <div id="homeNewGameDiv">
            <h5>Popular Games :</h5>
            <div class="row justify-content-around mb-5">

            <div class="col-md-6 col-lg-3 mb-3 ">
                <div id="homeNewGamesCard" class="card shadow">
                    <img src="<?php genURL('public\uploads\img\46122850509814.jpeg'); ?>" class="card-img-top" >
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    </div>
                    <div class="row justify-content-around mb-1">
                        <a href="#"  class="btn col col-sm-4 ">More</a>
                    </div>
                </div>
            </div>

            </div>
        </div>

        <div id="homeOwnerDiv" class="mb-4">
            <h1>OWNER MAHDI GHASEMI</h1>
        </div>
        
        <div id="categories" class="mb-4">
            


        <div class="row justify-content-around mb-5">

        <div class="col-md-6 col-lg-4 mb-3 ">
            <div class="card bg-dark text-white">
                <img src="<?php genURL('public\img\Adventure.jpg') ?>" class="card-img" >
                <div class="card-img-overlay">
                <a href="#" class="text-light"><h5 class="card-title">Adventure</h5></a>
            </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4 mb-3 ">
            <div class="card bg-dark text-white">
                <img src="<?php genURL('public\img\Action.jpg') ?>" class="card-img" >
                <div class="card-img-overlay">
                <a href="#" class="text-light"><h5 class="card-title">Action</h5></a>
            </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4 mb-3 ">
            <div class="card bg-dark text-white">
                <img src="<?php genURL('public\img\Combat.jpg') ?>" class="card-img" >
                <div class="card-img-overlay">
                <a href="#" class="text-light"><h5 class="card-title">Combat</h5></a>
            </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4 mb-3 ">
            <div class="card bg-dark text-white">
                <img src="<?php genURL('public\img\Puzzel.jpg') ?>" class="card-img" >
                <div class="card-img-overlay">
                <a href="#" class="text-light"><h5 class="card-title">Puzzel</h5></a>
            </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4 mb-3 ">
            <div class="card bg-dark text-white">
                <img src="<?php genURL('public\img\Racing.jpg') ?>" class="card-img" >
                <div class="card-img-overlay">
                <a href="#" class="text-light"><h5 class="card-title">Racing</h5></a>
            </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4 mb-3 ">
            <div class="card bg-dark text-white">
                <img src="<?php genURL('public\img\Simulation.jpg') ?>" class="card-img" >
                <div class="card-img-overlay">
                <a href="#" class="text-light"><h5 class="card-title">Simulation</h5></a>
            </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4 mb-3 ">
            <div class="card bg-dark text-white">
                <img src="<?php genURL('public\img\Sport.jpg') ?>" class="card-img" >
                <div class="card-img-overlay">
                <a href="#" class="text-light"><h5 class="card-title">Sport</h5></a>
            </div>
            </div>
        </div>

        </div>



        </div>

    </div>
<?php require_once SITE_ROOT.'app/views/includes/footer.php'; ?>