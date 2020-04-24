<div id="dashAddNewGame" class="container">
    <?php if($data['games']){ ?>
    <h3 class=" text-muted pt-2 pl-md-4 row justify-content-center justify-content-md-start"><?php echo ucwords($_SESSION['author_name']); ?> Games :</h3>
    <p class=" mb-md-3 text-info "><span class="h2 text-info font-weight-bolder">* </span>Your created games are publishe after evaluating. </p>
    <?php }else{ ?>
    <p class="display-4 text-justify">Let's create your first game on GaMa :)</p>
    <?php }?>
    <div id="dashGamesCardsDiv" class="pl-lg-5 pr-lg-5">
    
    <?php 
    if($data['games']){
        foreach($data['games'] as $game){ 
        ?>
        <div class="card mr-md-5 ml-md-5 mt-2 mb-4 mt-md-4" id="dashGameCardDiv">
            <img src="<?php genURL('public\uploads\games\\'.$game->TopImg) ?>" class="card-img-top" >
            <div class="card-body">
                <h5 class="card-title"><?php echo $game->title; ?></h5>
                <p class="card-text"><?php
                if(strlen($game->description)>100){
                    echo substr($game->description,0,100).'  . . .';
                }else{ 
                    echo $game->description;
                }
                ?></p>
                <div class="row justify-content-around">
                    <a href="#" id="dashGamesDeleteBtn" class="btn col col-sm-3 ">Delete</a>
                    <a href="<?php genURL('games/show/'.$game->id.'-'.str_replace(' ','-',$game->title)) ?>" id="dashGamesMoreBtn" class="btn col col-sm-3 <?php if($game->state !=2){ echo 'disabled'; } ?> ">More</a>
                    <?php if($game->state == 2){ ?>
                    <a href="#" id="dashGameAccepteddBtn" class="btn col col-sm-3 disabled">Published</a>
                    <?php }elseif($game->state == 3){ ?>
                    <a href="#" id="dashGameRejectedBtn" class="btn col col-sm-3 disabled" >Rejected</a>
                    <?php }else{ ?>
                    <a href="#" id="dashGameEvaluatingBtn" class="btn col col-sm-3  disabled" >Evaluating...</a>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php
        }
    }
    ?>
    

    
    

</div>