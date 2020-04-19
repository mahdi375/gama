<?php require_once SITE_ROOT.'app/views/includes/header.php'; ?>

    <div class="container" id="gamesPage">
        <h1> Games: </h1> 

    
    <div id="GamesCardsDiv" class="row pl-lg-5 pr-lg-5 ">
    
    <?php 
        foreach($data['games'] as $game){ 
    ?>
    <div class="col-lg-6 " >
    <div class="card mr-md-5 ml-md-5 mt-2 mb-4 mt-md-4 " id="GameCardDiv">
        
        <div class="card-body">
            <h5 class=""><?php echo $game->title; ?></h5>
        </div>
        <img src="<?php genURL('public\uploads\games\\'.$game->TopImg) ?>" class=" " id="gamesCardImage" >   
        <div class="card-body">
            <p class="card-text" id="gamesCardDescription"><?php
            if(strlen($game->description)>100){
                echo substr($game->description,0,100).'  . . .';
            }else{ 
                echo $game->description;
            }
            ?></p>
            <div class="row justify-content-around">
                <a href="#" id="GamesMoreBtn" class="btn col col-sm-3 ">More</a>
            </div>
        </div>
        
    </div>
    </div>
    <?php
    }
    ?>
    

</div>

    </div>
<?php require_once SITE_ROOT.'app/views/includes/footer.php'; ?>