<?php require_once SITE_ROOT.'app/views/includes/header.php'; ?>

    <div class="container" id="gamesPage">
        <h1 class="text-muted"> Games: </h1> 

    
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
            <p class="card-text text-justify" id="gamesCardDescription"><?php
            if(strlen($game->description)>100){
                echo substr($game->description,0,100).'  . . .';
            }else{ 
                echo $game->description;
            }
            ?></p>
            <div class="row justify-content-around">
                <a href="<?php genURL('games\show\\'.$game->id.'-'.str_replace(' ','-',$game->title)) ?>" id="GamesMoreBtn" class="btn col col-sm-3 ">More</a>
            </div>
        </div>
        
    </div>
    </div>
    <?php
    }
    ?>
 
    </div> 

    <nav aria-label="Page navigation example" class="row justify-content-center mt-3 mt-md-5 mb-md-5">
        <ul class="pagination">
            <?php foreach($data['pages'] as $page_num){ ?>
                <li class="page-item"><a class="page-link " href="<?php genURL('Pages/games/'.$page_num) ?>"><?php echo $page_num; ?></a></li>
            <?php } ?>
        </ul>
    </nav>



</div>
<?php require_once SITE_ROOT.'app/views/includes/footer.php'; ?>