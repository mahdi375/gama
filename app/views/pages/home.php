<?php require_once SITE_ROOT.'app/views/includes/header.php'; ?>

    <div class="container" id="homePage">
        <h1>GaMa</h1>
        <p class="text-info">brief introductions of world popular games</p>

        <div id="homeNewGamesDiv" class="mt-4">
            <h2 class="h4 text-muted" >New Games :</h2>
            <div class="row justify-content-around ">
            <?php foreach($data['recent'] as $game){ ?>
                <div class="col-md-6 col-lg-3 mb-3 ">
                <div id="homeNewGamesCard" class="card shadow">
                    <img src="<?php genURL('public\uploads\games\\'.$game->TopImg); ?>" class="card-img-top" id="homeNewGameImage" >
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $game->title; ?></h5>
                        <p class="card-text text-justify" id="homeNewGameCardDescription"><?php echo $game->description; ?></p>
                    </div>
                    <div class="row justify-content-around mb-1">
                        <a href="<?php genURL('games\show\\'.$game->id.'-'.str_replace(' ','-',$game->title)) ?>"  class="btn col col-sm-4 ">More</a>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">created <?php 
                            if($game->date){ echo $game->date;?> days ago
                            <?php }else{ echo 'today'; }?>
                        </small>
                    </div>
                </div>
                </div>
            <?php } ?>               
            </div>
        </div>

        
        <div id="homeOwnerDiv" class="mb-4 row display-md-inline-flex">
            <div class="col-sm-8 mt-md-5">
                <h1 class="display-4 mt-md-2 row justify-content-center" id="homeOwnerMahdi">Mahdi Ghasemi</h1>
                <a href="<?php genURL('Pages/about') ?>" class=" row justify-content-center text-info text-decoration-none"><span>__Resume__</span></a>
            </div>
            <div class="col-sm-4 row justify-content-center mt-sm-5 ml-2 ml-sm-0 mt-lg-3">
                <img id="HomeOwnerImage" src="<?php genURL('public\img\mahdi_ghasemi.jpg') ?>" alt="mahdi_gahsemi">
            </div>
        </div>

        <div id="categories" class="mb-5 pb-4">
            <h2 class="h4 text-muted" >Categories :</h2>
            <div class="row justify-content-around mb-5">
            <?php foreach($data['categories'] as $item){ ?>
                <div class="col-md-6 col-lg-4 mb-3 " id="homeCategoryCard" ><a href="<?php genURL('games\category\\'.$item->id.'-'.$item->name) ?>" class="text-light">
                    <div class="card bg-dark text-white" id="homeCategoryInnerCard">
                        <img src="<?php genURL('public\img\\'.$item->name.'.jpg') ?>" class="card-img" >
                        <div class="card-img-overlay">
                            <h5 class="card-title"><?php echo $item->name; ?></h5>
                        </div>
                    </div></a>
                </div>
            <?php } ?>                
            </div>
        </div>



        <div id="homeRandomGamesDiv" >
            <h3 class="h4 text-muted" class="mt-5">Random Games :</h3>
            <div class="row justify-content-around mb-5">
            <?php  foreach($data['random'] as $game){?>
            <div class="col-md-6 col-lg-3 mb-3 ">
                <div id="homeRandomGamesCard" class="card shadow">
                    <img src="<?php genURL('public\uploads\games\\'.$game->TopImg); ?>" class="card-img-top" id="homeRandomGameImage" >
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $game->title ?></h5>
                        <p class="card-text text-justify" id="homeRandomGameCardDescription"><?php echo $game->description; ?></p>
                    </div>
                    <div class="row justify-content-around mb-1">
                        <a href="<?php genURL('games\show\\'.$game->id.'-'.str_replace(' ','-',$game->title)) ?>"  class="btn col col-sm-4 ">More</a>
                    </div>
                </div>
            </div>
            <?php } ?>
            </div>
        </div>




    </div>
<?php require_once SITE_ROOT.'app/views/includes/footer.php'; ?>