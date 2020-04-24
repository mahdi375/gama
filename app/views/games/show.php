<?php require_once SITE_ROOT.'app/views/includes/header.php'; ?>

    <div class="container">
    <div id="showSingleGame" >
        <div id="topNav" class="row mt-2 mt-md-4">
            <div id="titleDiv" class="col-9 col-md-10">
                <h1 id="title" class="display-3"><?php echo $data['game']->title; ?></h1>
            </div>
            <div id="author" class="col-3 col-md-2 ">
                <img id="authorImage" class=" ml-md-3" src="<?php genURL('public\uploads\img\\'.$data['game']->author_img) ?>" alt="">
            </div>
        </div>
        <div id="shortDescription" class="mt-1 mt-md-3 pb-1 pb-md-3">
            <p class="display-5 mb-0 text-justify mt-3 p-md-5 pb-md-3"><?php echo $data['game']->short_description; ?></p>
            <footer class="blockquote-footer text-center mt-4 mt-md-0"><?php echo $data['game']->author; ?></footer>
        </div>
        <div id="topImage" class="row justify-content-center mt-5 mb-5 pl-3 pr-3">
            <img class="col col-sm-10 col-md-8" id="showTopImageImg" src="<?php genURL('public\uploads\games\\'.$data['game']->TopImg) ?>" alt="">
        </div>
        <div id="fullDescription">
            <p class="display-5 mt-3 text-justify p-md-5"><?php echo $data['game']->description; ?></p>
        </div>
        <?php if($data['game']->BottImg){ ?>
        <div id="bottomImage" class="row justify-content-center mt-2 mb-4 pl-3 pr-3">
            <img class="col col-sm-10 col-md-8" id="showBottomImageImg" src="<?php genURL('public\uploads\games\\'.$data['game']->BottImg) ?>" alt="">
        </div>
        <?php } ?>
        <div id="relatedGames" class="mt-5 pt-5">
            <div id="showRelatedGamesDiv" >
                <h1 class="h5 md-3 text-muted ">Published Related Games :</h1>
                <div class="row justify-content-around mb-5">
                <?php  foreach($data['related'] as $game){?>
                <div class="col-6 col-md-3 mb-3 p-0 ">
                    <div id="showRelatedGamesCard" class="card shadow">
                        <img src="<?php genURL('public\uploads\games\\'.$game->TopImg); ?>" class="card-img-top" id="showRelatedGameImage" >
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $game->title ?></h5>
                            <p class="card-text text-justify" id="showRelatedGameCardDescription"><?php echo $game->description; ?></p>
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
    </div>  

    </div>
<?php require_once SITE_ROOT.'app/views/includes/footer.php'; ?>